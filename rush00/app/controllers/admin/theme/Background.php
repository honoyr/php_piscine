<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Theme_Background extends Controller
{
    const DIR_PICTURES = 'background';

    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
    	foreach (array('bg','pattern') as $key)
    	{
	        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$key.'.png'))
	        {
	            $this->tpl->assignBlockVars('img_'.$key);
	        }
	        else
	        {
	            $this->tpl->assignBlockVars('no_img_'.$key);
	        }
    	}
    	$stuff = $this->model->stuff->get();
    	$this->tpl->assignVars(array(
    	   'BG_FIXED' => $stuff->body_bg_fixed ? 'checked="checked"' : '',
           'PATTERN_FIXED' => $stuff->body_pattern_fixed ? 'checked="checked"' : '',
    	));
    }

    function addAction(array $params)
    {
    	$key = @$params[0];
    	if (!$key)
    	    die();
    	    
    	$this->tpl->assignVar('KEY',$key);
    	
        $form = $this->load->form('admin/theme/background');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $filename = "$key.png";
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

        if (is_file(DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$key.'.png'))
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
        $key = @$params[0];
        if (!$key)
            die();
            
        $this->tpl->assignVar('KEY',$key);
        
        $filename = "$key.png";
        $dest = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        @unlink($dest);
    }

    function fixedAction(array $params)
    {
        $key = @$params[0];
        if (!$key)
            die('fail');
            
        $this->model->stuff->save(array(
            'body_'.$key.'_fixed' => (int)(bool)@$_POST['fixed']
        ),1);
        
        die('ok');
    }
}