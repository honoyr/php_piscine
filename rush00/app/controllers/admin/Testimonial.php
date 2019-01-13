<?php
/**
 * Testimonial
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Testimonial
 */
class App_Admin_Testimonial extends Controller
{
    const ITEMS_PER_PAGE = 50;
    
    CONST DIR_PICTURES_S = 'people/s';
    CONST DIR_PICTURES_L = 'people/l';
    CONST DIR_PICTURES_TEMP = 'people/temp';
    
    const PHOTO_WIDTH = 80;
    const PHOTO_HEIGHT = 100;
    
    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        $this->tableAction($params);
        $this->settingsAction($params);

        if ($this->byAjax())
        {
            $this->load->view('admin/testimonial/table');
        }
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $item = $this->model->testimonial->getById($id);
        $this->tpl->assignBlockVars('testimonial', array(
            'MESSAGE' => $item->message
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

        $search = null;
        if(in_array('search',$params))
        {
            $searchInd = array_search('search',$params);
            if(isset($params[$searchInd+1]))
                $search = $params[$searchInd+1];
        }

        $start = ($page-1)*self::ITEMS_PER_PAGE;
        if ($search)
            $testimonials = $this->model->testimonial->search($search, $start, self::ITEMS_PER_PAGE);
        else
            $testimonials = $this->model->testimonial->get($start, self::ITEMS_PER_PAGE, true);

        foreach ($testimonials as $testimonial)
        {
            $this->tpl->assignBlockVars('testimonial', array(
                'ID'    => $testimonial->id,
                'CITY' => $testimonial->city,
                'DUTIES' => $testimonial->duties,
                'PHONE' => $testimonial->phone,
                'NAME'  => $testimonial->name,
                'WEBSITE'  => $testimonial->website,
                'DATE'  => date('j ',$testimonial->timestamp).$this->model->date->getOfMonthText(date('m',$testimonial->timestamp)).date(' Y, H:i',$testimonial->timestamp),
                'MESSAGE' => nl2br($testimonial->message)
            ));
            if ($testimonial->picture)
            {
                $src = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$testimonial->picture;
                if (is_file($src))
                {
                    $imageInfo = getimagesize($src);
                    $this->tpl->assignBlockVars('testimonial.picture',array(
                        'SRC' => $testimonial->picture,
                        'WIDTH'  => $imageInfo[0],
                        'HEIGHT' => $imageInfo[1]
                    ));
                }
            }
            if (!$testimonial->disabled)
                $this->tpl->assignBlockVars('testimonial.enabled');
            else
                $this->tpl->assignBlockVars('testimonial.disabled');
            if ($testimonial->website)
                $this->tpl->assignBlockVars('testimonial.website');
        }
        $this->tpl->assignVars(array('RAND'=>rand(1,1000)));
        /**
         * Навигация
         */
        $paginator = new Paginator(array(
           'countPerPage'  => self::ITEMS_PER_PAGE,
           'countOfEntries'=> $this->model->testimonial->getCount($search),
           'currentPage' => $page,
           'countOfFirstPages'=> 5,
           'countOfLastPages' => 5,
           'countOfMiddlePages'=> 4,
           'template' => $this->tpl
        ));
        $paginator->compile();

        if ($search)
        {
            $this->tpl->assignVars(array(
                'SEARCH_QUERY' => htmlentities($search),
                'URL_POSTFIX'  => '/search/'.$search
            ));
        }
        $this->tpl->assignVars(array(
            'CURRENT_PAGE' => $page
        ));
    }

    function addAction(array $params)
    {
        $form = $this->load->form('admin/testimonial/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'name'  => $data->name,
                'phone' => $data->phone,
                'city' => $data->city,
                'duties' => $data->duties,
                'website' => $data->website,
                'message' => trim($data->message),
                'timestamp'  => time()
            );
            $id = $this->model->testimonial->add($dataToInsert);
            if ($data->pictureKey)
            {
                $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = $id.substr(uniqid(),-5).'.jpg';
                $destS = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$filename;
                $destL = DIR_IMAGES.'/'.self::DIR_PICTURES_L.'/'.$filename;
                if (is_file($source))
                {
                    $image = $this->model->image->load($source);
                    $image->save($destL);
                    $image->make(self::PHOTO_WIDTH,self::PHOTO_HEIGHT)->save($destS,IMAGETYPE_JPEG);
                    unlink($source);
                    $this->model->testimonial->edit(array(
                        'picture' => $filename
                    ),$id);
                }
            }
            $this->model->dir->clean(DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP);
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

        $item = $this->model->testimonial->getById($id);
        if ($item->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/testimonial/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($item->asArray());
            $form->setValues(array(
                'enable'  => !$item->disabled
            ));
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'name'  => $data->name,
                'phone' => $data->phone,
                'city' => $data->city,
                'duties' => $data->duties,
                'website' => $data->website,
                'message' => trim($data->message),
            );
            /**
             * Сохраняем логотип
             */
            if ($data->pictureKey)
            {
                $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = $id.substr(uniqid(),-5).'.jpg';
                $destS = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$filename;
                $destL = DIR_IMAGES.'/'.self::DIR_PICTURES_L.'/'.$filename;
                $oldS  = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$item->picture;
                $oldL  = DIR_IMAGES.'/'.self::DIR_PICTURES_L.'/'.$item->picture;
                if (is_file($source))
                {
                    $image = $this->model->image->load($source);
                    $image->save($destL);
                    $image->make(self::PHOTO_WIDTH,self::PHOTO_HEIGHT)->save($destS,IMAGETYPE_JPEG);
                    $dataToInsert['picture'] = $filename;
                    unlink($source);
                    if (is_file($old))
                        unlink($old);
                    if (is_file($oldBig))
                        unlink($oldBig);
                }
            }
            $this->model->testimonial->edit($dataToInsert,$id);
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
                $source = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$item->picture;
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

        $item = $this->model->testimonial->getById($id);
        if ($item->isEmpty())
            die('fail');

        $this->model->testimonial->delete($id);
        if ($item->picture)
        {
            $src = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$item->picture;
            if (is_file($src))
                unlink($src);
            $src = DIR_IMAGES.'/'.self::DIR_PICTURES_L.'/'.$item->picture;
            if (is_file($src))
                unlink($src);
        }
        die('ok');
    }

    function disableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->testimonial->edit(array('disabled'=>1),$id);
        die('ok');
    }

    function enableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->testimonial->edit(array('disabled'=>0),$id);
        die('ok');
    }
    /**
     * Отмена
     *
     * @param $params
     */
    function cancelAction(array $params)
    {
        //$this->model->dir->clean(DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP);
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/testimonial/add');
    }

    function pictureAction(array $params)
    {
        $form = $this->load->form('admin/testimonial/picture/upload');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $key = uniqid();
            $dest = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$key;
            /**
             * Сохраняем картинку
             */
            $image = $this->model->image->load($data->file->tmp_name);
            $image->shrink(1600,1200)->save($dest,IMAGETYPE_JPEG);

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
    /**
     * Перестановка
     *
     * @param $params
     */
    function reorderAction(array $params)
    {
        $positions = (array)@$_GET['list'];
        $count = count($positions);
        foreach ($positions as $position => $id)
        {
            $id = (int)$id;
            if ($id > 0)
            {
                $this->model->testimonial->edit(array('position' => $count-$position), $id);
            }
        }
    }
    
    function settingsAction(array $params)
    {
        $var = $this->model->page->get('testimonial');
        $form = $this->load->form('admin/testimonial/settings');
        if (!$form->isSubmit() && !$var->isEmpty())
            $form->setValues(array(
                'email'    => $var->email
            ));
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'email'     => $data->email
            );
            if ($var->id)
                $this->model->page->edit($dataToInsert,$var->id);
            else
            {
                $dataToInsert['name'] = 'testimonial';
                $dataToInsert['dynamic'] = 'on';
                $this->model->page->add($dataToInsert);
            }
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }
}