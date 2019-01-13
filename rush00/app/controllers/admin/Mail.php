<?php
/**
 * Mail
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Mail extends Controller
{
    const ITEMS_PER_PAGE = 100;

	const DIR_PICTURES = 'mails';
    const DIR_PICTURES_BG = 'mails/bg';
    const DIR_PICTURES_TEMP = 'mails/temp';

	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
            
        $domain = $this->model->mail->getDomain();
        if ($domain)
        $this->tpl->assignVars(array(
            'MAIL_DOMAIN' => $domain->name
        ));
    }

	function indexAction(array $params)
    {
    	if (!$this->model->mail->isConnected())
    	{
    		return $this->tpl->assignBlockVars('mail_is_not_connected'); 
    	}
    	else $this->tpl->assignBlockVars('mail_is_connected'); 
    	
    	$this->tableAction($params);

        if ($this->byAjax())
        {
            $this->load->view('admin/mail/table');
        }
        
        //var_dump($this->model->mail->add('webmaster','123'));
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $item = $this->model->mail->getById($id);
        $this->tpl->assignBlockVars('mail', array(
            'DESCRIPTION' => $item->description
        ));
    }

    function tableAction(array $params = array())
    {
        /**
         * Параметры
         */
        $page = 1;
        if (isset($params[0]) && $params[0]=='page')
            $page = (!empty($params[1]))?(int)$params[1]:1;
        if (!$page)
            $page = 1;

        $start = ($page-1)*self::ITEMS_PER_PAGE;
        $items = $this->model->mail->get($total);
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('mail', array(
                'ID'    => $item->name,
                'NAME'  => $item->name,
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

        $this->tpl->assignVars(array(
            'CURRENT_PAGE' => $page
        ));
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/mail/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $id = $this->model->mail->add($data->login,$data->password);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }

    function editAction(array $params)
    {
        $id = @$params[0];
        if (empty($id)) die('fail1');

        $item = $this->model->mail->getById($id);
        if ($item->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/mail/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($item->asArray());
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $id = $this->model->mail->edit($id,$data->password);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVars(array(
            'ID' => $id
        ));
    }

    function deleteAction(array $params)
    {
    	$id = @$params[0];
    	if (empty($id))
    	    die('fail');

    	$item = $this->model->mail->getById($id);
        if ($item->isEmpty())
            die('fail');

    	$this->model->mail->delete($id);
    	die('ok');
    }

    function cancelAction(array $params)
    {
        //$this->model->dir->clean(DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP);
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/mail/add');
    }
}