<?php

/**
 * Parser
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Parser
 */
class App_Admin_Parser extends Controller
{
    function indexAction(array $params)
    {
        die();
    }
    
    function wikiAction(array $params)
    {
    	$html = $this->model->wiki->parseArticle(@$_POST['data']);
        die($html);
    }
}