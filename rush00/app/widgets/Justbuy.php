<?php
/**
 * Виджет только что купленных товаров
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Justbuy extends aWidget
{
	function init()
    {
        if (false === ($stuff = $this->cache->get('stuff')))
        {
            $this->load->model('stuff');
            $stuff = $this->model->stuff->get();
        }
        if (!$stuff->justbuy_on || !$stuff->justbuy_products)
            return;
        
        $this->load->model('product');
        /**
         * Данные
         */
        $items = $this->model->product->getByIds(explode('|',$stuff->justbuy_products));
        if ($items->isEmpty())
            return;
        $this->tpl->assignBlockVars('widget.justbuy',array(
            'NAME' => $stuff->justbuy_header
        ));
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('widget.justbuy.item', array(
                'NAME' => $item->name,
                'ID'  => $item->id,
                'BRIEF'=> nl2br($item->brief),
            ));
            if ($item->picture)
            {
                $this->tpl->assignBlockVars('widget.justbuy.item.picture', array(
                    'SRC' => $item->picture
                ));
            }
        }
    }
}