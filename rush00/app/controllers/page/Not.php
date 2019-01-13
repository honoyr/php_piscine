<?php

/**
 * Page Not Found
 * 
 * @author dandelion <web.dandelion@gmail.com
 * @package App_Page_Not
 */
class App_Page_Not extends Controller
{
    function indexAction(array $params)
    {
        $this->Url_redirectTo('page/not/found');
    }
    
    function foundAction(array $params)
    {
        $this->load->view('page/not/found');
        $this->page->setTitle('404 | Page not found');
    }
}