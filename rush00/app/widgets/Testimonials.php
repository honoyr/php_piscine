<?php
/**
 * Виджет отзывов
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Testimonials extends aWidget
{
	function init()
    {
    	if (URL_APP == 'testimonials')
    		return;
    	
        $this->load->model('testimonial');
        /**
         * Данные
         */
        $items = $this->model->testimonial->getRandom(3);
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('widget.tst', array(
                'NAME' => $item->name,
                'CITY'  => $item->city,
                'DUTIES'  => $item->duties,
                'WEBSITE'  => $item->website,
                'MESSAGE' => mb_strlen($item->message,'UTF-8')>200 ? nl2br(mb_substr($item->message,0,200,'UTF-8')).'<i>... </i><a href="javascript:;" class="go-on">[читать далее]</a><span class="bullshit">'.nl2br(mb_substr($item->message,200,mb_strlen($item->message,'UTF-8'),'UTF-8')).'</span>' : nl2br($item->message),
            ));
            if ($item->picture)
            {
                $this->tpl->assignBlockVars('widget.tst.picture', array(
                    'SRC' => $item->picture
                ));
            }
            if ($item->website)
                $this->tpl->assignBlockVars('widget.tst.website');
        }
        $this->tpl->assignBlockVars('widget.testimonials',array(
            'TOTAL' => $this->model->testimonial->getCount()
        ));
    }
}