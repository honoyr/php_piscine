<?php

/**
 * Bin Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Bin extends Model_Default
{
	function init()
    {
        $this->table = 'bin';
    }
    
    function add($sentence, $category, $object_id, $table = null)
    {
    	$this->delete($category, $object_id);
    	$key = md5(uniqid(mt_rand(), true));
        parent::add(array(
            'timestamp' => time() + $sentence,
            'category'  => $category,
            'object_id' => $object_id,
            'key'       => $key
        ));
        if ($table)
        {
        	$this->db->query("CREATE TABLE IF NOT EXISTS ?_{$this->table}_{$table} LIKE ?_{$table}");
        	$this->db->query(
        	   "INSERT INTO ?_{$this->table}_{$table}
        	   SELECT * FROM ?_{$table} WHERE id=?", $object_id
        	);
        	$this->db->query("DELETE FROM ?_{$table} WHERE id=?", $object_id);
        }
        return $key;
    }
    
    function getForErase($category) 
    {
        $data = $this->db->selectCol(
            "SELECT `object_id` FROM ?_{$this->table}
            WHERE `category`=? AND `timestamp`<?
            ORDER BY `timestamp` ASC", 
            $category, time()
        );
        return $data;
    }
    
    function getByTrashId($table, $id) 
    {
        $data = new Entity($this->db->selectRow(
            "SELECT * FROM ?_{$this->table}_{$table}
            WHERE `id`=?", $id
        ));
        return $data;
    }
    
    function getTrashId($category, $key)
    {
    	return $this->db->selectCell(
           "SELECT `object_id` FROM ?_{$this->table}
           WHERE `key`=? AND `category`=?", $key, $category
        );
    }
    
    function undo($category, $object_id, $table = null)
    {
    	if ($table)
        {
            $this->db->query(
               "INSERT INTO ?_{$table}
               SELECT * FROM ?_{$this->table}_{$table} WHERE id=?", $object_id
            );
            $this->db->query("DELETE FROM ?_{$this->table}_{$table} WHERE id=?", $object_id);
        }
        $this->delete($category, $object_id);
        return $this;
    }
    
    function delete($category, $object_id) 
    {
        $this->db->query(
            "DELETE FROM ?_{$this->table}
            WHERE `category`=? AND `object_id`=?", 
            $category, $object_id
        );
        return $this;
    }
}