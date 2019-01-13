<?php
/**
 * Виджет меню
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Menu extends aWidget
{
    protected $table = 'menu';
	protected $items;
	
	function init()
    {
        $this->load->model('menu');
        $this->tpl->assignBlockVars('widget.menu');
        
        $items = $this->model->menu->getEnabled();
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('widget.menu.item', array(
                'TITLE' => $item->title,
                'LINK'  => $item->link
            ));
        }
    }
}