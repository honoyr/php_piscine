<?php

if (!defined('VIEW'))
	die("Hacking attempt");

/**
 * NullObject
 *
 * Uses for break the sequence executed functions such as $this->func1()->func2() without error.
 * Send an resource of empty class. 
 * Every functions of this class will be canceled.
 * @author RoX <web.dandelion@gmail.com>
 * @package NullObject
 */
class NullObject
{
	function __construct() {}
	
	function __call($method, $args)
	{
		return $this;
	}
	
	function __get($property)
	{
		return $this;
	}
	
	function __set($property, $value)
	{
		return $this;
	}
}