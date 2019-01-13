<?php
/**
 * Menu
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Menu
 */
class App_Admin_Menu extends Controller
{
	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }
    
    function indexAction(array $params)
    {
        $this->tableAction($params);
    }
    
    function expandAction(array $params) 
    {
        $id = (int)@$params[0];
        if (empty($id)) die();
        
        $item = $this->model->menu->getById($id);
        $this->tpl->assignBlockVars('menu', array(
            'TITLE' => $item->title,
            'LINK'  => $item->link
        ));
    }
    
    function tableAction(array $params = array()) 
    {
        $items = $this->model->menu->getAll();
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('menu', array(
                'ID'    => $item->id,
                'TITLE' => $item->title,
                'LINK'  => $item->link
            ));
            if ($item->disabled)
                $this->tpl->assignBlockVars('menu.disabled');
            else
                $this->tpl->assignBlockVars('menu.enabled');
        }
    }
    
    function addAction(array $params) 
    {
        $form = $this->load->form('admin/menu/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'title' => $data->title,
                'link' => $data->link
            );
            $id = $this->model->menu->add($dataToInsert);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }
    
    function editAction(array $params) 
    {
        $id = (int)@$params[0];
        if (empty($id)) die('fail');
        
        $items = $this->model->menu->getById($id);
        if ($items->isEmpty())
            die('fail');
            
        $form = $this->load->form('admin/menu/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($items->asArray());
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'title' => $data->title,
                'link' => $data->link
            );
            $this->model->menu->edit($dataToInsert,$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVars(array(
            'ID'=>$id
        ));
    }
    
    function deleteAction(array $params) 
    {
        $id = (int)@$params[0];
        if (empty($id))
            die('fail');
            
        $this->model->menu->delete($id);
        die('ok');
    }
    
    function cancelAction(array $params)
    {
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/menu/add');
    }
    
    function reorderAction(array $params) 
    {
    	$positions = (array)@$_GET['list'];
    	$count = count($positions);
        foreach ($positions as $position => $id)
        {
        	$id = (int)$id;
            if ($id > 0)
            {
                $this->model->menu->edit(array('position' => $count-$position), $id);
            }
        }
    }    
    
    function disableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();
        
        $this->model->menu->edit(array('disabled'=>1),$id);
        die('ok');
    }
    
    function enableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();
        
        $this->model->menu->edit(array('disabled'=>0),$id);
        die('ok');
    }
}