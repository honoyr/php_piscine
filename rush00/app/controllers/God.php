<?php
 
defined('VIEW') or die("Hacking attempt");

/**
 * SuperAdmin
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_God extends Controller
{
    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }
	
	function indexAction(array $params)
    {
        $this->Url_redirectTo('god/menu');
    }
}