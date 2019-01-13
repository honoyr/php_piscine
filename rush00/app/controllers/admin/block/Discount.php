<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Block_Discount extends Controller
{
    const DIR_PICTURES = 'stuff';

    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/discount.png'))
        {
            $this->tpl->assignBlockVars('img');
        }
        else
        {
            $this->tpl->assignBlockVars('no_img');
        }
        $this->settingsAction($params);
    }

    function settingsAction(array $params)
    {
        $data = $this->model->stuff->get();
        $form = $this->load->form('admin/stuff/discount');
        if (!$form->isSubmit())
            $form->setValues($data->asArray());
        if ($form->isSubmit() && $form->isValid())
        {
            $this->model->stuff->save($form->getData(),1);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/stuff/upload');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $filename = "discount.png";
            $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
            /**
             * Сохраняем картинку
             */
            @unlink($dest);
            $image = $this->model->image->load($data->file->tmp_name);
            $image->shrink(90,120)->save($dest,IMAGETYPE_PNG);
            $this->cache->clean(array('stuff'));
        }
        else
        {
            if ($form->isSubmit())
                $form->renderErrors($this->tpl);
        }

        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/discount.png'))
        {
            $this->tpl->assignBlockVars('img');
        }
        else
        {
            $this->tpl->assignBlockVars('no_img');
        }
    }

    function deleteAction(array $params)
    {
        $filename = "discount.png";
        $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        @unlink($dest);
    }
}