<?php

/**
 * Access
 *
 * @author dandelion <web.dandelion@gmail.com
 * @package App_Access
 */
class App_Access extends Controller
{
    function indexAction(array $params)
    {
        $this->Url_redirectTo('access/forbidden');
    }

    function forbiddenAction(array $params)
    {
    	$this->page->setTitle('403 | Access forbidden');
    	if ($this->user->isLoggedIn())
            $this->tpl->assignBlockVars('in');
        else
            $this->tpl->assignBlockVars('out');
    }
}