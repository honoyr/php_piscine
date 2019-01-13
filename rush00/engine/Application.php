<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Класс приложения
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Application
 */
class Application extends Object
{
    static function factory() 
    {
        $appRouter = AppRouter::getInstance();
        $url = Url::getInstance();
        $appRouter->setUrlParts($url->split()->getParts())->defineApp()->initApp();
        return $appRouter->getApp();
    }
}