<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Синдром одиночки.
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package iSingleton
 */
interface iSingleton
{
    static function getInstance();
}