<?php

/**
 * Виджет входа на сайт
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package loginWidget
 */
class Widget_Login extends aWidget
{
    function init()
    {
        $this->tpl->appendBlockVars('widget');
        $this->tpl->assignBlockVars('widget.login');
        if ($this->user->isLoggedIn())
            $this->userInside();
        else
            $this->userOutside();
    }
    
    function userInside()
    {
    	$this->tpl->assignVar('USERNAME', $this->user->data->name);
        $this->tpl->assignBlockVars('widget.login.inside');
        $this->tpl->assignBlockVars('widget.login.'.$this->user->getRole());
        $this->tpl->assignBlockVars('i_am_'.$this->user->data->type);
    }
    
    function userOutside()
    {
        $this->tpl->assignBlockVars('widget.login.outside');
    }
}