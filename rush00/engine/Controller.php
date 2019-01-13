<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Controller
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Controller
 */
abstract class Controller extends aApplication
{
    public $model;
    public $var;

    final function __construct()
    {
    	parent::__construct();
        $this->tpl   =& $this->page->getTemplate();
        $this->model = new Entity_Model;
        $this->model->controller = $this;
        $this->load  =& $this;

        /**
         * Set template file, according to fact that templates and applications
         * have the same structure. It might be overwritten if it need.
         */
        $appRouter = AppRouter::getInstance();
        $appPath = str_replace(DIR_CONTROLLERS, '', $appRouter->getAppDir()).
            (($appRouter->getAppName() !== AppRouter::APP_DEFAULT_CLASSNAME)
                ?'/'.strtolower($appRouter->getAppName())
                :'');
        $filename = DIR_TEMPLATES.$appPath.'/'.$appRouter->getAppAction().EXT_TPL;
        if (file_exists($filename))
            $this->tpl->setFile($filename);

        /**
         * Loading page vars
         */
        $pagenameParts[] = (0 === strpos($appPath, '/')) ? substr($appPath, 1) : $appPath;
        $pagenameParts[] = ($appRouter->getAppAction() !== AppRouter::APP_DEFAULT_ACTION)
            ? $appRouter->getAppAction() : null;
        foreach ($pagenameParts as $i=>$part)
            if (empty($part))
                unset($pagenameParts[$i]);
        $pagename = join('/',$pagenameParts);
        if (!$pagename) $pagename = strtolower(AppRouter::APP_DEFAULT_CLASSNAME);
        if (false === ($var = $this->cache->get('page_by_pagename_'.$pagename)))
        {
            $var = $this->model->page->get($pagename);
            $this->cache->set($var, 'page_by_pagename_'.$pagename, array('page'));
        }
        $this->var = $var;
        if ($var->title)
            $this->page->setTitle($var->title);
        if ($var->keywords)
            $this->page->setKeywords($var->keywords);
        if ($var->description)
            $this->page->setDescription($var->description);

        /**
         * Инициализация контроллера приложения
         */
        if (method_exists($this, 'init'))
            $this->init();
    }

    final function byAjax()
    {
    	return @$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    function setPage404()
    {
header("HTTP/1.0 404 Not Found");
    	$this->tpl->setFile(DIR_TEMPLATES.'/page/not/found'.EXT_TPL);
    }

    function setPage403()
    {
        $this->tpl->setFile(DIR_TEMPLATES.'/access/forbidden'.EXT_TPL);
        if ($this->user->isLoggedIn())
            $this->tpl->assignBlockVars('in');
        else
            $this->tpl->assignBlockVars('out');
    }

    final function model($name)
    {
    	$realname = strtoupper($name{0}).substr($name, 1);
    	$class = 'Model_'.$realname;
    	if (!class_exists($class))
    	{
    		$file = DIR_MODELS.'/'.$realname.EXT_PHP;
	    	if (!file_exists($file))
	    	    throw new Exception('Не найдена модель '.$name);
	    	else
	    	    include_once $file;
    	}
    	$this->model->$name = new $class($this);
    	return $this;
    }

    final function view($name)
    {
    	$this->tpl->setFile(DIR_TEMPLATES.'/'.$name.EXT_TPL);
    	return $this;
    }

    final function form($name, $options = array())
    {
        return Form::factory($options)->handle(DIR_FORMS.'/'.$name.'.xml');
    }

    function setTitle($title)
    {
        if (is_array($title))
        {
            function addBraces($value) {
                return '{'.$value.'}';
            }
            $this->page->setTitle(str_replace(array_map('addBraces',array_keys($title)),array_values($title),$this->page->getTitle()));
        }
        else $this->page->setTitle($title);
    }
}