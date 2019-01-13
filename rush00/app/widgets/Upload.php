<?php

/**
 * Окошко загрузки файлов
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Widget_Upload
 */
class Widget_Upload extends aWidget
{
    function init()
    {
    	$this->tpl->assignBlockVars('widget.upload');
    }
}