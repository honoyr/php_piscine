<?php
/**
 * Виджет новостей
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_News extends aWidget
{
    protected $table = 'news';
	protected $items;

	function init()
    {
        $this->load->model('news')->model('date');
        /**
         * Данные
         */
        $news = $this->model->news->get(0,2);
        if ($news->isEmpty())
            return;
        $this->tpl->assignBlockVars('widget.news');
        foreach ($news as $entry)
        {
            $this->tpl->assignBlockVars('widget.news.entry', array(
                'ID'     => $entry->id,
                'KEY'    => $entry->key,
                'BRIEF'  => $entry->brief,
                'DATE'  => ucwords($this->model->date->getMonthText(date('m',$entry->timestamp))).date(', Y',$entry->timestamp)
            ));
            if ($entry->content_html)
                $this->tpl->assignBlockVars('widget.news.entry.more');
        }
    }
}