<?php
/**
 * Theme Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Theme extends Model_Default
{
    protected $table = 'themes';
    protected $cacheTag = 'theme';

    function get(&$total=null, $start=0, $count=100000)
    {
        $cacheKey = $this->cacheTag."_start_{$start}_count_{$count}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                ORDER BY `name` ASC LIMIT ?d,?d",
                $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }
}