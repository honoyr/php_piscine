<?php
/**
 * Upload
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Upload extends Controller
{
    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function imageAction(array $params)
    {
        $form = $this->load->form('admin/upload/image');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            if ($data->source == 'computer' && (!$data->file || !$data->file->name))
            {
                return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Прикрепите файл'));
            }
            elseif ($data->source == 'url' && !$data->url)
            {
                return $this->tpl->assignBlockVars('error_url',array('MESSAGE'=>'Напишите ссылку'));
            }
            elseif (!$data->source)
            {
                return $this->tpl->assignBlockVars('error_source',array('MESSAGE'=>'Выберите способ загрузки изображения'));
            }
            if ($data->source == 'computer')
            {
                $file = DIR_ROOT.'/images/upload/'.$data->file->name;
                if (is_file($file) && !$data->rewrite)
                {
                    return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Такой файл уже есть на сервере. Перезаписать?'));
                }
                move_uploaded_file($data->file->tmp_name, $file);
                if (is_file($file))
                {
                    $this->tpl->assignVars(array(
                        'LINK' => URL_HOME.'images/upload/'.str_replace(' ','%20',$data->file->name)
                    ));
                    $this->load->view('admin/upload/imginfo');
                }
                else
                {
                    return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Ошибка при загрузке файла'));
                }
            }
            elseif ($data->source == 'url')
            {
                $image = @file_get_contents($data->url);
                $filename = substr($data->url,strrpos($data->url,'/')+1);
                if ($image)
                {
                    $file = DIR_ROOT.'/images/upload/'.$filename;
                    if (is_file($file))
                    {
                        $filename = uniqid().$filename;
                        $file = DIR_ROOT.'/images/upload/'.$filename;
                    }
                    file_put_contents($file,$image);
                    $imginfo = (bool)@getimagesize($file);
                    if (!$imginfo)
                    {
                        @unlink($file);
                        return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'То - что вы пытаетесь загрузить - не изображение'));
                    }
                }
                else return $this->tpl->assignBlockVars('error_url',array('MESSAGE'=>'Не получается скачать изображение по вашей ссылке'));

                if (is_file($file))
                {
                    $this->tpl->assignVars(array(
                        'LINK' => URL_HOME.'images/upload/'.str_replace(' ','%20',$filename)
                    ));
                    $this->load->view('admin/upload/imginfo');
                }
                else
                {
                    return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Ошибка при загрузке файла'));
                }
            }
        }
        else $form->renderErrors($this->tpl);
    }

    function fileAction(array $params)
    {
        $form = $this->load->form('admin/upload/file');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $file = DIR_ROOT.'/files/'.$data->file->name;
            if (is_file($file) && !$data->rewrite)
            {
                return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Такой файл уже есть на сервере. Перезаписать?'));
            }
            move_uploaded_file($data->file->tmp_name, $file);
            if (is_file($file))
            {
                $this->tpl->assignVars(array(
                    'LINK' => URL_HOME.'files/'.str_replace(' ','%20',$data->file->name)
                ));
                $this->load->view('admin/upload/info');
            }
            else
            {
                return $this->tpl->assignBlockVars('error_file',array('MESSAGE'=>'Ошибка при загрузке файла'));
            }
        }
        else $form->renderErrors($this->tpl);
    }
}