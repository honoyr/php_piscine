<?php
/**
 * People Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_People extends Model_Default
{
    protected $table = 'people';
    protected $cacheTag = 'people';

    function getAll($disabled = false)
    {
        $cacheKey = $this->cacheTag."_all_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `position` DESC",
                !$disabled ? 0 : DBSIMPLE_SKIP
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function get($start = 0, $count = 1000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_limit_{$start}_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `position` DESC
                LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP,
                $start, $count
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function search($query, $start = 0, $count = 1000)
    {
        $data = $this->db->select(
            "SELECT * FROM ?_{$this->table}
            WHERE `name` LIKE ?
            ORDER BY `position` DESC
            LIMIT ?d,?d",
            '%'.$query.'%', $start, $count
        );
        return new Entity($data);
    }

    function getCount($search = null, $disabled = false)
    {
        $count = $this->db->selectCell(
            "SELECT COUNT(`id`) FROM ?_{$this->table}
            {WHERE `name` LIKE ?}",
            !empty($search)? '%'.$search.'%' : DBSIMPLE_SKIP
        );
        return $count;
    }
}