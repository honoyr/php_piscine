<?php
/**
 * Menu Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Menu extends Model_Default
{
    protected $table = 'menu';
    protected $cacheTag = 'menu';
    
    function getAll()
    {
        $cacheKey = $this->cacheTag.'_all';
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                ORDER BY `position` DESC"
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }
    
    function getEnabled()
    {
        $cacheKey = $this->cacheTag.'_enabled';
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                WHERE `disabled`=0
                ORDER BY `position` DESC"
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }
}