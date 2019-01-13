<?php
/**
 * Static pages
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Page
 */
class App_Admin_Page extends Controller
{
	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

	function indexAction(array $params)
    {
    	$this->tableAction();
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $page = $this->model->page->getById($id);
        $this->tpl->assignBlockVars('page', array(
            'TITLE'   => $page->title,
            'CONTENT' => $page->content_html
        ));
    }

    function tableAction(array $params = array())
    {
        $pages = $this->model->page->getAll();
        foreach ($pages as $page)
        {
        	if ($page->dynamic=='on' || 0===strpos($page->name,'admin/')) continue;
            $this->tpl->assignBlockVars('page', array(
                'ID'       => $page->id,
                'NAME'     => $page->name,
                'TITLE'    => str_replace(array('{','}'),array('&#123;','&#125;'),$page->title)
            ));
        }
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/page/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
        	$dataToInsert = array(
                'name'    => $data->name,
        	    'title'   => $data->title,
                'content_wiki' => $data->content,
                'content_html' => $this->model->wiki->parseArticle($data->content),
                'keywords'   => $data->keywords,
                'description'=> $data->description,
                'dynamic' => (int)(bool)$data->dynamic,
        	);
            $id = $this->model->page->add($dataToInsert);
            die('ok');
        }
        else $form->renderErrors($this->tpl);

        if (PRODUCTION)
            $this->tpl->assignBlockVars('production');
    }

    function editAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die('fail1');

        $page = $this->model->page->getById($id);
        if ($page->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/page/edit');
        if (!$form->isSubmit())
        {
            $form->setValues(array(
                'title' => $page->title,
                'content' => $page->content_wiki,
                'keywords'   => $page->keywords,
                'description'=> $page->description,
                'dynamic' => $page->dynamic
            ));
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'title'   => $data->title,
                'content_wiki' => $data->content,
                'content_html' => $this->model->wiki->parseArticle($data->content),
                'keywords'   => $data->keywords,
                'description'=> $data->description,
                'dynamic' => (int)(bool)$data->dynamic,
            );
            $this->model->page->edit($dataToInsert,$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);

        $this->tpl->assignVars(array(
            'PAGE_NAME'=>$page->name,
            'ID'=>$id
        ));

        if (PRODUCTION)
            $this->tpl->assignBlockVars('production');
        if ($page->dynamic)
            $this->tpl->assignBlockVars('dynamic');
    }

    function deleteAction(array $params)
    {
    	$id = (int)@$params[0];
    	if (empty($id))
    	    die('fail');

    	$page = $this->model->page->getById($id);
        if ($page->isEmpty())
            die('fail');

    	$this->model->page->delete($id);
    	die('ok');
    }

    function cancelAction(array $params)
    {
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/page/add');
    }

    static function checkIfNameExists($name)
    {
        if (empty($name)) return true;
        $db = Db::factory();
        $pageEmpty = !(bool)$db->selectCell("SELECT COUNT(id) FROM ?_pages WHERE `name`=? LIMIT 1",$name);
        return $pageEmpty;
    }
}