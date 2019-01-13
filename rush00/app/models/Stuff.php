<?php

/**
 * Stuff Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Stuff extends Model
{
    protected $table = 'stuff';
	
	function get()
    {
        $store = $this->Store_setTable($this->table);
        $this->data = $store->findRow();
        return $this->data;
    }
    
    function save($data, $id = null) 
    {
        $dataToInsert = array();
    	foreach ($data as $key => $value)
        {
        	//if (!strpos($key, 'html') === 0)
        	//    $value = strip_tags($value);
        	$dataToInsert[$key] = $value;
        }
        //$dataToInsert = array_map('strip_tags', $dataToInsert);
        $this->cache->clean(array('stuff'));
        return $this->Store_setTable($this->table)->insert($dataToInsert, $id);
    }
}