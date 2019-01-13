<?php

/**
 * Default Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Default extends Model
{
    protected $table;
    protected $cacheTag;

    function getById($id)
    {
    	if (is_null($id)) return new Entity();
    	$cacheKey = $this->table.'_'.$this->cacheTag.'_id_'.$id;
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow("SELECT * FROM ?_{$this->table} WHERE `id`=?", $id);
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getAll()
    {
        $cacheKey = $this->table.'_'.$this->cacheTag.'_all';
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select("SELECT * FROM ?_{$this->table}");
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function add($data)
    {
        $id = $this->db->query(
            "INSERT INTO ?_{$this->table}(?#) VALUES(?a)",
            array_keys($data),
            array_values($data)
        );
        $this->cache->clean(array($this->cacheTag));
        return $id;
    }

    function edit($data, $id)
    {
    	if ($this->getById($id)->isEmpty())
    	    return $this;

        $this->db->query(
            "UPDATE ?_{$this->table} SET ?a WHERE id=?",
            $data, $id
        );
        $this->cache->clean(array($this->cacheTag));
        return $this;
    }

    function delete($id)
    {
        $this->db->query("DELETE FROM ?_{$this->table} WHERE id=?", $id);
        $this->cache->clean(array($this->cacheTag));
        return $this;
    }
}