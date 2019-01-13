<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Template
 * @author dandelion <web.dandelion@gmail.com>
 * @package Template
 */
class Template extends Object
{
    static function factory()
    {
        return new Template_OneMore;
    }
}