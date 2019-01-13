<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Block extends Controller
{
    function indexAction(array $params)
    {
	    return $this->Url_redirectTo('admin/block/guarantee');
    }
}