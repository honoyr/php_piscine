<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Представление данных в виде обьекта, сущности
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Entity_Model
 */
class Entity_Model extends Entity
{
    public $controller;
	
	function __get($key)
    {
    	$instance = parent::__get($key);
    	if (!$instance)
    	{
	    	$realname = strtoupper($key{0}).substr($key, 1);
	        $class = 'Model_'.$realname;
	        if (class_exists($class) && $this->controller)
	            $this->data[$key] = $instance = new $class($this->controller);
    	}
	    return $instance;
    }
}