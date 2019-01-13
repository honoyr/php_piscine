<?php
/**
 * Виджет темы оформления
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Widget_Theme
 */
class Widget_Theme extends aWidget
{
    function init()
    {
        if (false === ($stuff = $this->cache->get('stuff'))) 
        {
            $this->load->model('stuff');
            $stuff = $this->model->stuff->get();
        }
        $this->tpl->assignVars(array(
            'BODY_BG_COLOR' => $stuff->body_bg_color ? 'background-color:'.$stuff->body_bg_color.';' : '',
            'BODY_BG_PATTERN' => is_file(DIR_IMAGES.'/background/pattern.png') ? 'background:url(images/background/pattern.png?rand='.$stuff->rand.');' : '',
            'BODY_BG_IMAGE' => is_file(DIR_IMAGES.'/background/bg.png') ? 'background:url(images/background/bg.png?rand='.$stuff->rand.') top center no-repeat;' : '',
            'BODY_BG_IMAGE_ATTACMENT' => $stuff->body_bg_fixed ? 'background-attachment: fixed;' : '',
            'BODY_BG_PATTERN_ATTACMENT' => $stuff->body_pattern_fixed ? 'background-attachment: fixed;' : '',
            'MENU_LINK_COLOR' => $stuff->menu_link_color ? 'color:'.$stuff->menu_link_color.';' : '',
            'MENU_BG_COLOR' => 'background-color:'.(!$stuff->menu_bg_color ? 'rgba(255,255,255':'rgba(0,0,0').','.($stuff->menu_bg_opacity!=''&&!is_null($stuff->menu_bg_opacity) ? $stuff->menu_bg_opacity : '0.3').');',
            'PHONE_COLOR' => $stuff->phone_color ? 'color:'.$stuff->phone_color.';' : '',
            'LINK_COLOR' => $stuff->link_color ? 'color:'.$stuff->link_color.';' : '',
            'TEXT_COLOR' => $stuff->text_color ? 'color:'.$stuff->text_color.' !important;' : '',
            'HEADER_COLOR' => $stuff->header_color ? 'color:'.$stuff->header_color.' !important;' : '',
            'PRICE_COLOR' => $stuff->price_color ? 'color:'.$stuff->price_color.' !important;' : '',
            'BLOCK_BG_COLOR' => $stuff->block_bg_color ? 'background-color:'.$stuff->block_bg_color.' !important;' : '',
            'FOOT_BG_COLOR' => $stuff->foot_bg_color ? 'background-color:'.$stuff->foot_bg_color.';' : '',
            'FOOT_FONT_COLOR' => $stuff->foot_font_color ? 'color:'.$stuff->foot_font_color.';' : '',
            'FOOT_LINK_COLOR' => $stuff->foot_link_color ? 'color:'.$stuff->foot_link_color.';' : '',
            'BUTTON_BG_COLOR' => $stuff->button_bg_color ? 'background-color:'.$stuff->button_bg_color.';' : '',
            'BUTTON_FONT_COLOR' => $stuff->button_font_color ? 'color:'.$stuff->button_font_color.';' : '',
            'BUTTON2_BG_COLOR' => $stuff->button2_bg_color ? 'background-color:'.$stuff->button2_bg_color.';' : '',
            'BUTTON2_FONT_COLOR' => $stuff->button2_font_color ? 'color:'.$stuff->button2_font_color.';' : '',
        ));
    }
}
