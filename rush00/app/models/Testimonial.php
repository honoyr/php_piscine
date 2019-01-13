<?php
/**
 * Testimonial Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Testimonial extends Model_Default
{
    protected $table = 'testimonials';
    protected $cacheTag = 'testimonial';

    function get($start=0, $count=100000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_start_{$start}_count_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `timestamp` DESC
                LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP, $start, $count
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getRandom($count)
    {
        $data = $this->db->select(
            "SELECT * FROM ?_{$this->table}
            WHERE `disabled`=0
            ORDER BY RAND() LIMIT ?d,?d", 0, $count
        );
        return new Entity($data);
    }

    function getCount($disabled = false)
    {
        $cacheKey = $this->cacheTag."_count_disabled_".((int)$disabled);
        if (false === ($count = $this->cache->get($cacheKey)))
        {
            $count = $this->db->selectCell("SELECT COUNT(`id`) FROM ?_{$this->table} { WHERE `disabled`=? }", !$disabled ? 0 : DBSIMPLE_SKIP);
            $this->cache->set($count, $cacheKey, array($this->cacheTag));
        }
        return $count;
    }
}