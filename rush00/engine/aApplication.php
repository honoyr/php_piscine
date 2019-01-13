<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Абстрактный класс приложения
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package aApplication
 */
abstract class aApplication extends Object implements iSingleton
{
    private static $instance;
    
	protected $page;
    protected $user;
    protected $cache;
    
    function __construct() 
    {
        $this->page  =& Page::getInstance();
        $this->user  =& $this->page->getUser();
        $this->cache =& Cache::getInstance();
    }
    
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }
}