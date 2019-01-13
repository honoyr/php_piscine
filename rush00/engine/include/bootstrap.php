<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Начальная загрузка
 * @author dandelion <web.dandelion@gmail.com>
 */
include "engine/Timer.php";
Timer::start();

/**
 * Запускаем сессию
 */
@session_start();

/**
 * Выставляем заголовки и локаль
 */
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL, "ru_RU.UTF-8");

/**
 * Константы
 */
require DIR_PRIVATE.'/config/paths.php';
require DIR_CONFIG.'/config.php';
require DIR_CONFIG.'/custom.php';
require 'constants.php';

/**
 * Обработка ошибок и debug
 */
error_reporting(E_ALL);

/**
 * Автозагрузка классов/интерфейсов
 * 
 * @param string $className Имя класса/интерфейса
 */
function __autoload($objName)
{
	$fileName = str_replace('_', '/', $objName).EXT_PHP;
    	// ищем в папке с внутренними классами системы
    if (false !== (@include 'engine/'.$fileName)) {}
    elseif (false !== (@include 'lib/'.$fileName)) {}
    else
    {
    	$parts = explode('_', $objName);
    	if ($parts[0] == 'Model')
        {
            // это модель
            $file = DIR_MODELS.'/'.join('/', array_slice($parts, 1)).EXT_PHP;
        }
        elseif ($parts[0] == 'App')
        {
            // это контроллер
            $file = DIR_CONTROLLERS.'/'.join('/', array_slice($parts, 1)).EXT_PHP;
        }
        elseif ($parts[0]{0} == 'i')
        {
            // это интерфейс
            $file = DIR_APP.'/interfaces/'.substr($fileName, 1);
        }
        if (isset($file) && file_exists($file))
            include $file;
    }  
}