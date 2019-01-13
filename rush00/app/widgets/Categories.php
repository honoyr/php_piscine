<?php
/**
 * Виджет категорий
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Categories extends aWidget
{
	function init()
    {
        $this->load->model('product');
        /**
         * Данные
         */
        $cats = $this->model->product->category->getTree();
        foreach ($cats as $cat)
        {
            $this->tpl->assignBlockVars('widget.cat', array(
                'KEY'  => $cat->key,
                'NAME' => $cat->name
            ));
            if ($cat->children)
            {
                $this->tpl->assignBlockVars('widget.cat.has_child');
                foreach ($cat->children as $sub)
                {
	                $this->tpl->assignBlockVars('widget.cat.sub', array(
	                    'KEY'  => $sub->key,
	                    'NAME' => $sub->name
	                ));
		            if ($sub->children)
		            {
		                $this->tpl->assignBlockVars('widget.cat.sub.has_child');
		                foreach ($sub->children as $subsub)
		                $this->tpl->assignBlockVars('widget.cat.sub.sub2', array(
		                    'KEY'  => $subsub->key,
		                    'NAME' => $subsub->name
		                ));
		            }
                }
            }
        }
        if (!$cats->isEmpty())
            $this->tpl->assignBlockVars('widget.cats');
    }
}