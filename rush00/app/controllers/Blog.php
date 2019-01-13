<?php
/**
 * Blog
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Blog extends Controller
{
    const ITEMS_PER_PAGE = 1000;
    
    const VK_API_SECRET = '';

    function indexAction(array $params)
    {
        /**
         * Параметры
         */
        $page = 1;
        if (isset($params[0]) && $params[0]=='page')
            $page = (!empty($params[1]))?(int)$params[1]:1;
        if (!$page)
            $page = 1;
        /**
         * Выборка данных
         */
        $start = ($page-1)*self::ITEMS_PER_PAGE;
        $entries = $this->model->blog->get($total, $start, self::ITEMS_PER_PAGE);
        foreach ($entries as $entry)
        {
            $this->tpl->assignBlockVars('blog', array(
                'ID'    => $entry->id,
                'KEY'   => $entry->key,
                'NAME'  => $entry->name,
                'AUTHOR'=> $entry->author,
                'CONTENT' => $entry->brief_html,
                'DATE'  => date('d ',$entry->timestamp).$this->model->date->getOfMonthText(date('m',$entry->timestamp)).date(' Y',$entry->timestamp),
            ));
        }
        /**
         * Навигация
         */
        $paginator = new Paginator(array(
           'countPerPage'  => self::ITEMS_PER_PAGE,
           'countOfEntries'=> $total,
           'currentPage' => $page,
           'countOfFirstPages'=> 5,
           'countOfLastPages' => 5,
           'countOfMiddlePages'=> 4,
           'template' => $this->tpl
        ));
        $paginator->compile();
    }

    function noteAction(array $params)
    {
        /**
         * Параметры
         */
        if (isset($params[0]))
            $key = $params[0];
        else
            return $this->setPage404();
        /**
         * Выборка данных
         */
        $blog = $this->model->blog->getByKey($key);
        if ($blog->isEmpty())
            return $this->setPage404();
        $this->tpl->assignBlockVars('blog', array(
            'ID'    => $blog->id,
            'KEY'   => $blog->key,
            'NAME'  => $blog->name,
            'AUTHOR'=> $blog->author,
            'CONTENT' => $blog->content_html,
            'DATE'  => date('d ',$blog->timestamp).$this->model->date->getOfMonthText(date('m',$blog->timestamp)).date(' Y',$blog->timestamp),
        ));

        $this->setTitle(array('NOTE_TITLE'=>$blog->name));
        if ($blog->title)
            $this->page->setTitle($blog->title);
        $this->page->setKeywords($blog->keywords)
                   ->setDescription($blog->description);
    }

    function rssAction(array $params)
    {
        $i = 0;
        $blog = $this->model->blog->get($total,0,25);
        foreach ($blog as $entry)
        {
            if (!$i)
            {
                $this->tpl->assignVar('DATE', date('r', $entry->timestamp));
                $i++;
            }
            $this->tpl->assignBlockVars('entry',array(
                'KEY'    => $entry->key,
                'TITLE'  => $entry->title,
                'AUTHOR' => $entry->author,
                'DATE'   => date('r ',$entry->timestamp),
                'CONTENT'=> $entry->content_html,
                //'CATEGORY' => $entry->category
            ));
        }
    }
    
    function countVkCommentsAction(array $params)
    {
        /**
         * Параметры
         */
    	$id = (int)@$params[0];
    	if (!$id)
    	    die();
        /**
         * Проверка
         */
    	if (@$_POST['sign'] != md5(self::VK_API_SECRET.@$_POST['date'].@$_POST['num'].@$_POST['last_comment']))
    	    die('fail');
        /**
         * Сохранение
         */
        $this->model->blog->edit(array('comments'=>$_POST['num']),$id);
    }
}