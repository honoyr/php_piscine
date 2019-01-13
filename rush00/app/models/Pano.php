<?php
/**
 * Pano Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Pano extends Model_Default
{
    protected $table = 'pano';
    protected $cacheTag = 'pano';

    function get(&$total=null,$start=0,$count=1000,$disabled=false)
    {
        $cacheKey = $this->cacheTag."_limit_{$start}_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `position` DESC, `timestamp` DESC
                LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP,
                $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    function getActive()
    {
        $cacheKey = $this->cacheTag.'_active';
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                WHERE `disabled`=0
                ORDER BY RAND() DESC"
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function disableAll()
    {
        $data = $this->db->query(
            "UPDATE ?_{$this->table} SET `disabled`=1"
        );
    }
}