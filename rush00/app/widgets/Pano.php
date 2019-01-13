<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Pano extends aWidget
{
	function init()
    {
        $this->load->model('pano');
        /**
         * Данные
         */
        $panos = $this->model->pano->getActive();
        if ($panos->isEmpty())
            return;

        $i = 0;
        foreach ($panos as $pano)
        {
        	$i++;
        	if ($i==1)
        	{
	            $this->tpl->assignBlockVars('widget.pano', array(
	                'ID'    => $pano->id,
	                'FILE'  => $pano->file,
	                'LINK'  => ($pano->link)?$pano->link:'javascript:;',
	            ));
        	}
        	$this->tpl->assignBlockVars('widget.pano.page', array(
                'ID'    => $pano->id,
                'FILE'  => $pano->file,
                'LINK'  => ($pano->link)?$pano->link:'javascript:;',
            ));
        }
        $this->tpl->assignBlockVars('widget.if_pano');
        
        if ($i>1)
        {
        	$this->tpl->assignBlockVars('widget.pano.pages');
        }
    }
}