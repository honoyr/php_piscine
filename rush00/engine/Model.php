<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Model
 */
abstract class Model extends aApplication
{
    protected $app;
    protected $db;
    
    final function __construct(Controller $app = null)
    {
        parent::__construct();
        $this->app =& $app;
        $this->db  =& Db::factory();
        $this->model =& $app->model;
        
        if (method_exists($this, 'init'))
            $this->init();
    }
}