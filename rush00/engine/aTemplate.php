<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * abstract Template
 * @author dandelion <web.dandelion@gmail.com>
 * @package aTemplate
 */
abstract class aTemplate extends Component
{
    function __construct(){}
    
    abstract function setFile($filename);
    
    abstract function assignVar($var, $value);
    abstract function assignVars($vars = array());
    
    abstract function assignBlockVars($blockname, $vars = array());
    abstract function appendBlockVars($blockname, $vars = array());
    
    abstract function compile();
    
    abstract function getOutput();
    abstract function display();
}
