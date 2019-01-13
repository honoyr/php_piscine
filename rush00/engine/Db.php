<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * DataBase
 * @author dandelion <web.dandelion@gmail.com>
 * @package Db
 */
class Db extends Object
{
	static function factory()
    {
        static $instance;
        
    	if (null === $instance)
        {
        	require DIR_CONFIG.'/db.php';
            $instance = DbSimple_Generic::connect($dbms.'://'.$dbuser.':'.$dbpasswd.'@'.$dblocation.'/'.$dbname);
            $instance->setIdentPrefix(PREFIX_TABLE_NAME); 
            $instance->query("SET NAMES utf8 collate utf8_unicode_ci");
        }
        return $instance;
    }
}