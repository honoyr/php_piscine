<?php
/**
 * News Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_News extends Model_Default
{
    protected $table = 'news';
    protected $cacheTag = 'news';

    function getByKey($key)
    {
        if (is_null($key)) return new Entity();
        $cacheKey = $this->cacheTag.'_key_'.$key;
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow("SELECT * FROM ?_{$this->table} WHERE `key`=?", $key);
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
                ORDER BY `timestamp` DESC
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
            WHERE `brief` LIKE ?
            ORDER BY `timestamp` DESC
            LIMIT ?d,?d",
            '%'.$query.'%', $start, $count
        );
        return new Entity($data);
    }

    function getCount($search = null, $disabled = false)
    {
        $count = $this->db->selectCell(
            "SELECT COUNT(`id`) FROM ?_{$this->table}
            {WHERE `brief` LIKE ?}",
            !empty($search)? '%'.$search.'%' : DBSIMPLE_SKIP
        );
        return $count;
    }
}