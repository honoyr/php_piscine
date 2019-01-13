<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Form factory
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form
 */
class Form extends Object
{
    static function factory($options = array())
    {
    	return new Form_FromXml($options);
    }
}