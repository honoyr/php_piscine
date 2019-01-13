<?php

/**
 * Stuff
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Stuff
 */
class App_Admin_Stuff extends Controller
{
    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        $this->settingsAction($params);
    }

    function settingsAction(array $params)
    {
        $data = $this->model->stuff->get();
        $form = $this->load->form('admin/stuff');
        if (!$form->isSubmit())
            $form->setValues($data->asArray());
        if ($form->isSubmit() && $form->isValid())
        {
            $this->model->stuff->save($form->getData(),1);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }
}