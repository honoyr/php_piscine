<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Создает виджет и делегирует ему все запросы
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Widget
 */
class Widget extends Object
{
    const PREFIX_WIDGET_CLASSNAME = 'Widget_';
    
    static function factory($name) 
    {
        $name = strtoupper($name{0}).substr($name, 1);
    	require_once DIR_WIDGETS.'/'.$name.EXT_PHP;
    	$widgetClass = self::PREFIX_WIDGET_CLASSNAME.$name;
        $widget = new $widgetClass;
        $widget->init();
        return $widget;
    }
}