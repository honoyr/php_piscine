<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Абстрактный класс виджета
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package aWidget
 */
abstract class aWidget extends Object implements iSingleton
{
    private static $instance;
	
	protected $page;
    protected $user;
    protected $tpl;
    
    function __construct() 
    {
        $this->page  =& Page::getInstance();
        $this->user  =& $this->page->getUser();
        $this->tpl   =& $this->page->getTemplate();
        $this->store = new Store;
        $this->cache = new Cache;
        $this->model = new Entity;
        $this->load  =& $this;
        
        static $blockLoaded;
        if (null === $blockLoaded)
        {
            $blockLoaded = true;
            $this->tpl->assignBlockVars('widget');
        }
    }
    
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }
    
    final function model($name)
    {
        $realname = strtoupper($name{0}).substr($name, 1);
        $file = DIR_MODELS.'/'.$realname.EXT_PHP;
        if (!file_exists($file))
            throw new Exception('Не найдена модель '.$name);
        else
            include_once $file;
        $class = 'Model_'.$realname;
        $this->model->$name = new $class;
        return $this;
    }
}