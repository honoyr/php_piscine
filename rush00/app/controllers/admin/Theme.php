<?php
/**
 * Theme
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Theme extends Controller
{
    const ITEMS_PER_PAGE = 100;

	const DIR_PICTURES = 'themes';
    const DIR_PICTURES_BG = 'themes/bg';
    const DIR_PICTURES_TEMP = 'themes/temp';

	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

	function indexAction(array $params)
    {
    	$this->tableAction($params);

        if ($this->byAjax())
        {
            $this->load->view('admin/theme/table');
        }
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $item = $this->model->theme->getById($id);
        $this->tpl->assignBlockVars('theme', array(
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
        $items = $this->model->theme->get($total, $start, self::ITEMS_PER_PAGE, true);
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('theme', array(
                'ID'    => $item->id,
                'NAME'  => $item->name,
                'DESCRIPTION' => nl2br($item->description),
            ));
            if ($item->picture)
            {
                $src = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
                if (is_file($src))
                {
                    $imageInfo = getimagesize($src);
                    $this->tpl->assignBlockVars('theme.picture',array(
                        'SRC' => $item->picture,
                        'WIDTH'  => $imageInfo[0],
                        'HEIGHT' => $imageInfo[1]
                    ));
                }
            }
	        if (!$item->disabled)
	            $this->tpl->assignBlockVars('theme.enabled');
	        else
	            $this->tpl->assignBlockVars('theme.disabled');
        }
        $this->tpl->assignVars(array('RAND'=>rand(1,1000)));
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
        $form = $this->load->form('admin/theme/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $stuff = $this->model->stuff->get();
                
        	$dataToInsert = array(
                'name'   => $data->name,
                'description' => $data->description
        	);
            $id = $this->model->theme->add($dataToInsert);
            /**
             * Theme settings
             */
            $bg_image = $bg_pattern = '';
            $source = DIR_IMAGES.'/background/bg.png';
            $filename = 'bg'.substr(uniqid(),0,5).$id.'.png';
            $dest   = DIR_IMAGES.'/'.self::DIR_PICTURES_BG.'/'.$filename;
            if (is_file($source))
            {
                copy($source, $dest);
                $bg_image = $filename;
            }
            $source = DIR_IMAGES.'/background/pattern.png';
            $filename = 'pattern'.substr(uniqid(),0,5).$id.'.png';
            $dest   = DIR_IMAGES.'/'.self::DIR_PICTURES_BG.'/'.$filename;
            if (is_file($source))
            {
                copy($source, $dest);
                $bg_pattern = $filename;
            }
            $dataToInsert = array(
                'settings' => json_encode(array(
                    'body_bg_color' => $stuff->body_bg_color,
                    'body_bg_image' => $bg_image,
                    'body_bg_pattern' => $bg_pattern,
                    'body_pattern_fixed' => $stuff->body_pattern_fixed,
                    'body_bg_fixed' => $stuff->body_bg_fixed,
            
                    'menu_link_color' => $stuff->menu_link_color,
                    'menu_bg_color' => $stuff->menu_bg_color,
                    'menu_bg_opacity' => $stuff->menu_bg_opacity,
            
                    'text_color' => $stuff->text_color,
                    'header_color' => $stuff->header_color,
                    'price_color' => $stuff->price_color,
                    'block_bg_color' => $stuff->block_bg_color,
                    'phone_color' => $stuff->phone_color,
                    'link_color' => $stuff->link_color,
            
                    'foot_bg_color' => $stuff->foot_bg_color,
                    'foot_font_color' => $stuff->foot_font_color,
                    'foot_link_color' => $stuff->foot_link_color,
            
                    'button_bg_color' => $stuff->button_bg_color,
                    'button2_bg_color' => $stuff->button2_bg_color,
                    'button_font_color' => $stuff->button_font_color,
                    'button2_font_color' => $stuff->button2_font_color,
                ))
            );
            $this->model->theme->edit($dataToInsert,$id);
            /**
             * Theme picture
             */
        	if ($data->pictureKey)
        	{
        		$source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = substr(uniqid(),0,5).$id.'.jpg';
        		$dest   = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        		if (is_file($source))
        		{
        			copy($source, $dest);
        			unlink($source);
                    $this->model->theme->edit(array(
                        'picture' => $filename
                    ),$id);
        		}
        	}
            //$this->model->theme->edit(array('key'=>$id),$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        /**
         * Отображаем ранее загруженный файл
         */
        if (!empty($_POST['pictureKey']))
        {
            $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$_POST['pictureKey'];
            $this->tpl->assignBlockVars('picture',array('KEY'=>$_POST['pictureKey']));
        }
        else $this->tpl->assignBlockVars('no_picture');
    }

    function editAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die('fail1');

        $item = $this->model->theme->getById($id);
        if ($item->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/theme/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($item->asArray());
            $form->setValues(array(
                'date'  => date('d.m.Y',$item->timestamp)
            ));
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'name'   => $data->name,
                'description' => $data->description
            );
            /**
             * Сохраняем логотип
             */
            if ($data->pictureKey)
            {
                $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = substr(uniqid(),-5).$id.'.jpg';
                $dest   = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
                $old    = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
                if (is_file($source))
                {
                    if (copy($source, $dest))
                    {
                        $dataToInsert['picture'] = $filename;
	                    unlink($source);
                        if (is_file($old))
                            unlink($old);
                    }
                }
            }
            $this->model->theme->edit($dataToInsert,$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        /**
         * Отображаем ранее загруженный файл
         */
        if (empty($_POST['pictureKey']))
        {
	        if ($item->picture)
	        {
	            $source = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
	            $this->tpl->assignBlockVars('picture',array('FILE'=>$item->picture));
	        }
	        else $this->tpl->assignBlockVars('no_picture');
        }

        $this->tpl->assignVars(array('ID'=>$id,'RAND'=>rand(1,1000)));
        /**
         * Отображаем ранее загруженный файл
         */
        if (!empty($_POST['pictureKey']))
        {
            $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$_POST['pictureKey'];
            $this->tpl->assignBlockVars('picture2',array('KEY'=>$_POST['pictureKey']));
        }
    }

    function deleteAction(array $params)
    {
    	$id = (int)@$params[0];
    	if (empty($id))
    	    die('fail');

    	$item = $this->model->theme->getById($id);
        if ($item->isEmpty())
            die('fail');

    	$this->model->theme->delete($id);
    	if ($item->picture)
    	{
    	    $src = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
            if (is_file($src))
                unlink($src);
    	}
    	die('ok');
    }

    function cancelAction(array $params)
    {
        //$this->model->dir->clean(DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP);
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/theme/add');
    }

    function pictureAction(array $params)
    {
    	$form = $this->load->form('admin/theme/picture/upload');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $key = uniqid();
            $dest = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$key;
            /**
             * Сохраняем картинку
             */
            $image = $this->model->image->load($data->file->tmp_name);
            $image->cropAuto()->resizeToWidth(100)->save($dest,IMAGETYPE_JPEG);

            $this->tpl->assignVar('KEY',$key);
            $this->tpl->assignBlockVars('success');
        }
        else
        {
        	$form->renderErrors($this->tpl);
            $this->tpl->assignBlockVars('fail');
        }
        /**
         * Удаляем ранее загруженный файл
         */
        if (!empty($_POST['pictureKey']))
        {
            $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$_POST['pictureKey'];
            if (is_file($source))
                unlink($source);
        }
    }
    
    function setAction(array $params)
    {
        $id = (int)@$params[0];
    	
    	$item = $this->model->theme->getById($id);
        if ($item->isEmpty())
            die('fail');
            
        $settings = new Entity(json_decode($item->settings,true));
        
        $dest = DIR_IMAGES.'/background/bg.png';
        @unlink($dest);
        if ($settings->body_bg_image)
        {
            $source = DIR_IMAGES.'/'.self::DIR_PICTURES_BG.'/'.$settings->body_bg_image;
            if (is_file($source))
            {
                copy($source, $dest);
            }
        }
        
        $dest = DIR_IMAGES.'/background/pattern.png';
        @unlink($dest);
        if ($settings->body_bg_pattern)
        {
            $source = DIR_IMAGES.'/'.self::DIR_PICTURES_BG.'/'.$settings->body_bg_pattern;
            if (is_file($source))
            {
                copy($source, $dest);
            }
        }
        $this->model->stuff->save($settings->asArray(),1);
        
        die('ok');
    }
}