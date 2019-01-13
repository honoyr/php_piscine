<?php
/**
 * User
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_User
 */
class App_Admin_User extends Controller
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

        $user = $this->model->user->getById($id);
        $this->tpl->assignBlockVars('user', array(
            'ID'       => $user->id,
            'EMAIL'    => $user->email,
            'NAME'     => $user->name,
            'ROLE'     => $user->role
        ));
    }

    function tableAction(array $params = array())
    {
        $users = $this->model->user->getAll();
        foreach ($users as $user)
        {
            if ($user->email=='root')
                continue;
            $this->tpl->assignBlockVars('user', array(
	            'ID'       => $user->id,
	            'EMAIL'    => $user->email,
	            'NAME'     => $user->name,
	            'ROLE'     => $user->role
            ));
        }
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/user/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'name'  => $data->name,
                'email' => $data->email,
                'role'  => $data->role,
                'passwd_hash'=> $this->Auth_crypt($data->passwd),
            );
            $this->model->user->add($dataToInsert);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }

    function editAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die('fail1');

        $user = $this->model->user->getById($id);
        if ($user->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/user/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($user->asArray());
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'name'  => $data->name,
                'role'  => $data->role
            );
            if ($data->passwd)
                $dataToInsert['passwd_hash'] = $this->Auth_crypt($data->passwd);
            $this->model->user->edit($dataToInsert,$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);

        $this->tpl->assignVars(array('ID'=>$id, 'EMAIL'=>$user->email));
    }

    function deleteAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id))
            die('fail');

        $this->model->user->delete($id);
        die('ok');
    }
}