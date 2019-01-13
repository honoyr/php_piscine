<?php
/**
 * Order Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Order extends Model_Default
{
    protected $table = 'orders';
    protected $cacheTag = 'order';

    function get($start = 0, $count = 1000)
    {
        $cacheKey = $this->cacheTag."_limit_{$start}_{$count}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT o.*,p.name as 'product' FROM ?_{$this->table} o
                LEFT JOIN ?_{$this->model->product->getTable()} p ON o.product_id=p.id
                ORDER BY o.`timestamp` DESC
                LIMIT ?d,?d", $start, $count
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getCount()
    {
        $cacheKey = $this->cacheTag."_count";
        if (false === ($count = $this->cache->get($cacheKey)))
        {
            $count = $this->db->selectCell("SELECT COUNT(`id`) FROM ?_{$this->table}");
            $this->cache->set($count, $cacheKey, array($this->cacheTag));
        }
        return $count;
    }

    function deleteAll()
    {
        $this->db->query("DELETE FROM ?_{$this->table}");
        $this->cache->clean(array($this->cacheTag));
        return $this;
    }
    
    static function checkEmail($value)
    {
        return !empty($value) || !empty($_POST['phone']);
    }
}