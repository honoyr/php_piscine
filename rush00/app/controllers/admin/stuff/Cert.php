<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Stuff_Cert extends Controller
{
    const DIR_PICTURES = 'cert';
    const DIR_PICTURES_SMALL = 'cert/s';

    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        for ($num=1;$num<=10;$num++)
        {
            $this->tpl->assignBlockVars('img',array('NUM'=>$num));
            $this->tpl->assignVars(array('NUM'=>$num));
            if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES_SMALL.'/'.$num.".jpg"))
            {
                $this->tpl->assignBlockVars('img.yes');
            }
            else
            {
                $this->tpl->assignBlockVars('img.no');
            }
        }
    }

    function addAction(array $params)
    {
        $num = $params[0];
        if (!$num)
            die();

        $form = $this->load->form('admin/stuff/cert/upload');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $filename = $num.".jpg";
            $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
            $destSmall = DIR_IMAGES.'/'.self::DIR_PICTURES_SMALL.'/'.$filename;
            /**
             * Сохраняем картинку
             */
            @unlink($dest);
            @unlink($destSmall);
            $image = $this->model->image->load($data->file->tmp_name);
            $image->save($dest,IMAGETYPE_JPEG);
            $image->make(70,100)->save($destSmall,IMAGETYPE_JPEG);
            $this->cache->clean(array('stuff'));
        }
        else
        {
            if ($form->isSubmit())
                $form->renderErrors($this->tpl);
        }

        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES_SMALL.'/'.$num.'.jpg'))
        {
            $this->tpl->assignBlockVars('img');
        }
        else
        {
            $this->tpl->assignBlockVars('no_img');
        }
        $this->tpl->assignVars(array(
            'NUM'=>$num,
            'RAND'=>rand(1,1000)
        ));
    }

    function deleteAction(array $params)
    {
        $num = $params[0];
        if (!$num)
            die();

        $filename = $num.".jpg"; 
        $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        $destSmall = DIR_IMAGES.'/'.self::DIR_PICTURES_SMALL.'/'.$filename;
        @unlink($dest);
        @unlink($destSmall);

        $this->tpl->assignVars(array(
            'NUM'=>$num,
            'RAND'=>rand(1,1000)
        ));
    }
}