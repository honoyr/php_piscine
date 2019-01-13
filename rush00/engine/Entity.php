<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Представление данных в виде обьекта, сущности
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Entity
 */
class Entity implements Iterator
{
    protected $data = array();

    function __construct($values = array())
    {
    	foreach ((array)$values as $key => $value)
    	{
    		if (is_array($value))
    		    $value = new Entity($value);
    		$this->data[(string)$key] = $value;
    	}
    }

    function __get($key)
    {
    	return (array_key_exists($key, $this->data)) ? $this->data[$key] : null;
    }

    function __set($key, $value)
    {
    	return ($this->data[$key] = $value);
    }

    function __isset($key)
    {
    	return array_key_exists($key, $this->data);
    }

    function __toString()
    {
    	return null;
    }

    public function isEmpty()
    {
    	return empty($this->data);
    }

    public function asArray()
    {
    	$result = array();
    	foreach ($this->data as $key => $data)
    		$result[$key] = ($data instanceof Entity) ? $data->asArray() : $data;
    	return $result;
    }

    function rewind()
    {
        reset($this->data);
    }

    function current()
    {
        return current($this->data);
    }

    function key()
    {
        return key($this->data);
    }

    function next()
    {
        next($this->data);
    }

    function valid()
    {
        return (isset($this->data[key($this->data)]));
    }

    function count()
    {
        return count($this->data);
    }
}