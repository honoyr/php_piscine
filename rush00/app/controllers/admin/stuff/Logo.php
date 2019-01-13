<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Stuff_Logo extends Controller
{
    const DIR_PICTURES = 'logo';

    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/logo.png'))
        {
            $this->tpl->assignBlockVars('img');
        }
        else
        {
            $this->tpl->assignBlockVars('no_img');
        }
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/stuff/logo');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $filename = "logo.png";
            $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
            /**
             * Сохраняем картинку
             */
            @unlink($dest);
            $image = $this->model->image->load($data->file->tmp_name);
            $image->save($dest,IMAGETYPE_PNG);
            $this->cache->clean(array('stuff'));
        }
        else
        {
            if ($form->isSubmit())
                $form->renderErrors($this->tpl);
        }

        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/logo.png'))
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
        $filename = "logo.png";
        $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        @unlink($dest);
    }
}