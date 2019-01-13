<?php

/**
 * Captcha
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Captcha
 */
class App_Captcha extends Controller
{
    function indexAction(array $params)
    {
        require_once DIR_LIB.'/captcha/kCaptcha/kCaptcha.class.php';
        Captcha::factory()->generateCode()->saveCode()->render();
        die();
    }
}