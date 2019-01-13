<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Captcha
 * @author dandelion <web.dandelion@gmail.com>
 * @package Captcha
 */
class Captcha extends Object
{
    static function factory()
    {
    	return new kCaptcha;
    }
    
    static function check($code = null)
    {
        return ($code == @$_SESSION['captcha']);
    }
}