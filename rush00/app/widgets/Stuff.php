<?php
/**
 * Виджет подгрузки всяких мелких параметров
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Widget_Stuff
 */
class Widget_Stuff extends aWidget
{
    function init()
    {
    	$this->tpl->assignVars(array( 
            'TITLE'     => $this->page->getTitle(),
            'KEYWORDS'  => $this->page->getKeywords(),
            'DESCRIPTION' => $this->page->getDescription(),
            'BASEURL'   => URL_HOME,
            'URL_THIS'  => URL_THIS,
            'DOMAIN'    => $_SERVER['SERVER_NAME']
        ));

        if (false === ($stuff = $this->cache->get('stuff'))) 
        {
            $this->load->model('stuff')->model('wiki')->model('email');
            $stuff = $this->model->stuff->get();
            /**
             * Обработка данных
             */
            foreach (array('guarantee_body','promo_body','discount_body','special_body') as $wiki2html)
            {
                $stuff->$wiki2html  = $this->model->wiki->parseArticle($stuff->$wiki2html);
            }
            $stuff->mailto = $this->model->email->crypt($stuff->email);
            $stuff->phone  = str_replace(') ', ') <span>', $stuff->phone).'</span>';
            $stuff->phone2  = str_replace(') ', ') <span>', $stuff->phone2).'</span>';
            if (!$stuff->year)
                $stuff->year = date('Y');
            elseif ($stuff->year < date('Y'))
                $stuff->year  .= '-'.date('Y');

            $stuff->rand = rand(1,1000);

            $this->cache->set($stuff, 'stuff', array('stuff'));
        }
        $this->tpl->assignVars(array(
            'MAILTO' => $stuff->mailto,
            'SKYPE' => $stuff->skype,
            'ICQ' => $stuff->icq,
            'PHONE' => $stuff->phone,
            'PHONE2' => $stuff->phone2,
            'PHONE3' => $stuff->phone3,
            'OGRN' => $stuff->ogrn,
            'WORK_HOURS' => $stuff->work_hours,
            'DESCRIPT' => $stuff->descript,
        
            'GOOGLE_ANALYTICS' => $stuff->google_analytics,
            'YANDEX_METRIKA' => $stuff->yandex_metrika,
            'GOOGLE_VERIFICATION' => $stuff->google_verification,
            'YANDEX_VERIFICATION' => $stuff->yandex_verification,
            'COUNTER' => $stuff->counter,
        
            'SITE_NAME' => $stuff->site_name,
            'YEAR'  => $stuff->year,
            'TITLE_POSTFIX'  =>  (URL_APP) ? $stuff->title_postfix : '',

            'TIMESTAMP' => time()+3600,
            'RAND' => $stuff->rand,
        ));
        foreach (array('skype','icq','email','ogrn','counter','descript') as $block)
        {
        	if ($stuff->$block)
                $this->tpl->assignBlockVars($block);
        }
        if (is_file(DIR_IMAGES.'/logo/logo.png'))
            $this->tpl->assignBlockVars('logo');
        if ($stuff->guarantee_on)
        {
            $this->tpl->assignBlockVars('guarantee',array(
                'HEADER' => $stuff->guarantee_header,
                'BODY'   => $stuff->guarantee_body,
                'LINK'   => $stuff->guarantee_link ? $stuff->guarantee_link : 'javascript:;',
            ));
            if (is_file(DIR_IMAGES.'/stuff/guarantee.png'))
                $this->tpl->assignBlockVars('guarantee.img');
        }
        if ($stuff->promo_on)
        {
            $this->tpl->assignBlockVars('promo',array(
                'HEADER' => $stuff->promo_header,
                'BODY'   => $stuff->promo_body,
                'LINK'   => $stuff->promo_link ? $stuff->promo_link : 'javascript:;',
            ));
            if (is_file(DIR_IMAGES.'/stuff/promo.png'))
                $this->tpl->assignBlockVars('promo.img');
            if ($stuff->promo_timer)
            {
                $this->tpl->assignBlockVars('promo.timer');
                $interval = 3600*$stuff->promo_interval;
                $timestamp = $stuff->promo_timestamp+$interval;
                if ($timestamp<time())
                {
                    $timestamp = $timestamp + ceil((time()-$timestamp)/$interval)*$interval;
                }
                $this->tpl->appendBlockVars('promo',array(
                    'TIMESTAMP'   => $timestamp,
                ));
            }
        }
        if ($stuff->discount_on)
        {
            $this->tpl->assignBlockVars('discount',array(
                'HEADER' => $stuff->discount_header,
                'BODY'   => $stuff->discount_body,
                'LINK'   => $stuff->discount_link ? $stuff->discount_link : 'javascript:;',
            ));
            if (is_file(DIR_IMAGES.'/stuff/discount.png'))
                $this->tpl->assignBlockVars('discount.img');
        }
        if ($stuff->guarantee_on || $stuff->promo_on || $stuff->discount_on)
            $this->tpl->assignBlockVars('blocks');
        
        if ($stuff->vk_app_id)
            $this->tpl->assignBlockVars('vk',array(
                'APP_ID'=>$stuff->vk_app_id,
                'GROUP_ID'=>$stuff->vk_group_id,
            ));
    }
}
