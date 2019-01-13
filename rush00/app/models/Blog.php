<?php
/**
 * Blog Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Blog extends Model_Default
{
    protected $table = 'blog';
    protected $cacheTag = 'blog';

    function get(&$total=null, $start = 0, $count = 1000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_limit_{$start}_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT b.*,u.name as 'author' FROM ?_{$this->table} b
                LEFT JOIN ?_{$this->model->user->getTable()} u ON u.id=b.user_id
                { WHERE b.`disabled`=? }
                ORDER BY b.`timestamp` DESC
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
    
    function getByKey($key)
    {
        if (is_null($key)) return new Entity();
        $cacheKey = $this->table.'_'.$this->cacheTag.'_key_'.$key;
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow(
                "SELECT  b.*,u.name as 'author' FROM ?_{$this->table} b
                JOIN ?_{$this->model->user->getTable()} u ON u.id=b.user_id
                WHERE b.`key`=?", 
                $key
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function search($query, &$total=null, $start = 0, $count = 1000)
    {
        $data = $this->db->selectPage($total,
            "SELECT * FROM ?_{$this->table}
            WHERE `brief` LIKE ?
            ORDER BY `timestamp` DESC
            LIMIT ?d,?d",
            '%'.$query.'%', $start, $count
        );
        return new Entity($data);
    }
    
    static function checkIfKeyExists($key)
    {
        if (isset($_POST['my_key']) && $_POST['my_key']==$key)
            return true;
        if (in_array($key,array('index')))
            return false;
        return !Db::factory()->selectCell("SELECT COUNT(`id`) FROM ?_blog WHERE `key`=?",$key);
    }
}