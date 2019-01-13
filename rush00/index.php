<?php
/**
 * Index.
 * Единственный доступный исполняемый файл.
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 */
/**
 * Определяем константу, чтобы потом проверять ее в файлах,
 * предназначенных только для подключения изнутри системы.
 * Исключаем прямой доступ ко всем файлам кроме index.php
 */
define("VIEW", true);
/**
 * Начальная загрузка
 */
define('INDEX_PHP', 'index.php');
define('DIR_ROOT',    dirname(__FILE__));
define('DIR_HOME',    dirname(__FILE__));
define('DIR_PRIVATE', DIR_HOME);
define('DIR_PUBLIC',  DIR_ROOT);
require 'engine/include/bootstrap.php';

try
{
	$page = Page::getInstance();
	$content = $page->build()->getContent();
	die($content);
}
catch (Exception $error)
{
    if (!PRODUCTION)
	    die($error->getFile().' <b>[line '.$error->getLine().']</b> '.$error->getMessage());
}