<?php

if (!defined('VIEW'))
    die("Hacking attempt");

abstract class aCaptcha extends Object
{
    protected $code;
    protected $symbols = "23456789abcdefghkmnpqrstuvxyz";
    protected $length = 6;
    
    function __construct(){}
    
    function getCode()
    {
        return $this->code;
    }
    
    function generateCode()
    {
        $this->code = '';
        for ($i = 0; $i < $this->length; $i++)
            $this->code .= substr($this->symbols, rand(0,strlen($this->symbols)-1), 1);
        return $this;
    }
    
    function saveCode()
    {
        $_SESSION['captcha'] = $this->code;
        return $this;
    }
    
    function check($code)
    {
        return ($code == @$_SESSION['captcha']);
    }
    
    abstract function render();
}