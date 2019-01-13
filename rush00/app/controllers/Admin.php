<?php

/**
 * Admin
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin extends Controller
{
    function init()
    {
    	if (!$this->user->isLoggedIn())
    	    $this->Url_redirectTo('auth/login');
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

	function indexAction(array $params)
    {
        /**
         * Может статическая страница?
         */
        if (!empty($params))
            return $this->loadStaticPage('admin/'.join('/', $params));


        $this->Url_redirectTo('admin/product/all');
    }
    /**
     * Загружаем статическую страницу
     */
    private function loadStaticPage($name)
    {
        $page = $this->model->page->get($name);
        if (!$page->isEmpty())
        {
            $this->page->setTitle($page->title)
                       ->setKeywords($page->keywords)
                       ->setDescription($page->description);
            $this->tpl->assignBlockVars('page', array(
                'TITLE'   => $page->title,
                'CONTENT' => $page->content_html
            ));
            if (is_file(DIR_TEMPLATES.'/'.$name.EXT_TPL))
                $this->load->view($name);
            else
                $this->load->view('admin/page');
        }
        else $this->setPage404();
    }
}