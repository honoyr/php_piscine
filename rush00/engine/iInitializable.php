<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Интерфейс инициализации
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package iInitializable
 */
interface iInitializable
{
    public function init();
}