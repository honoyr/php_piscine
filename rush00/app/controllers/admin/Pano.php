<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Pano extends Controller
{
    const ITEMS_PER_PAGE = 1000;

	const DIR_BANNER = 'images/pano';
    const DIR_BANNER_TEMP = 'images/pano/temp';

    const IMG_WIDTH  = 300;
    const IMG_HEIGHT = 165;

	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

	function indexAction(array $params)
    {
    	$this->tableAction();
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
        $panos = $this->model->pano->get($total, $start, self::ITEMS_PER_PAGE, true);
        foreach ($panos as $pano)
        {
            $this->tpl->assignBlockVars('pano', array(
                'ID'    => $pano->id,
                'FILE'  => $pano->file,
                'TEXT1' => nl2br($pano->text1),
                'TEXT2' => nl2br($pano->text2),
                'LINK'  => $pano->link
            ));
            if ($pano->link)
                $this->tpl->assignBlockVars('pano.link');
            else
                $this->tpl->assignBlockVars('pano.no_link');
            if ($pano->disabled)
                $this->tpl->assignBlockVars('pano.disabled');
            else
                $this->tpl->assignBlockVars('pano.enabled');
        }
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
        $key = @$_SESSION['pano_img'];
        if (!$key)
            $this->Url_redirectTo('admin/pano/resize');

        $form = $this->load->form('admin/pano/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
        	$dataToInsert = array(
                'link'  => $data->link,
                'timestamp' => time()
        	);
            $id = $this->model->pano->add($dataToInsert);
        	if ($key)
        	{
        		$source = DIR_ROOT.'/'.self::DIR_BANNER_TEMP.'/'.$key;
        		$filename = $id.substr(uniqid(),-6);
                if (false !== strrpos($key,'.'))
                {
                    $filename.= substr($key,strrpos($key,'.'));
                }
        		$dest   = DIR_ROOT.'/'.self::DIR_BANNER.'/'.$filename;
        		if (is_file($source))
        		{
        			copy($source, $dest);
        			unlink($source);
        			$dataToInsert['file'] = $filename;
                    $this->model->pano->edit($dataToInsert,$id);
        		}
        	}

            unset($_SESSION['pano_img']);
            $this->model->dir->clean(DIR_ROOT.'/'.self::DIR_BANNER_TEMP);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        /**
         * Отображаем ранее загруженный файл
         */
        $this->tpl->assignVar('KEY',$key);
        $this->tpl->assignVar('RAND2',rand(1,1000));
    }

    function editAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die('fail1');

        $pano = $this->model->pano->getById($id);
        if ($pano->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/pano/edit');
        if (!$form->isSubmit())
        {
            $form->setValues($pano->asArray());
        }
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            $dataToInsert = array(
                'link'  => $data->link
            );
            $this->model->pano->edit($dataToInsert,$id);
            die('ok');
        }
        else $form->renderErrors($this->tpl);

        $this->tpl->assignVar('ID',$id);
    }

    function deleteAction(array $params)
    {
    	$id = (int)@$params[0];
    	if (empty($id))
    	    die('fail');

    	$pano = $this->model->pano->getById($id);
        if ($pano->isEmpty())
            die('fail');

    	$this->model->pano->delete($id);
    	if ($pano->file)
    	{
    	    $src = DIR_ROOT.'/'.self::DIR_BANNER.'/'.$pano->file;
            if (is_file($src))
                unlink($src);
    	}
    	die('ok');
    }

    function cancelAction(array $params)
    {
        unset($_SESSION['pano_img']);
        $this->model->dir->clean(DIR_ROOT.'/'.self::DIR_BANNER_TEMP);
        /*if (@$params[0]=='add')
            $this->Url_redirectTo('admin/pano/add');*/
    }

    function uploadAction(array $params)
    {
        $key = @$_SESSION['pano_img'];
        $source = DIR_ROOT.'/'.self::DIR_BANNER_TEMP.'/'.$key;
        if ($key)
            $this->tpl->assignBlockVars('img_exists');
        else
        {
            unset($_SESSION['pano_img']);
            $key = null;
        }

    	$form = $this->load->form('admin/pano/upload');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            if (true || !$key)
            {
                $key = uniqid().'.png';
                $source = DIR_ROOT.'/'.self::DIR_BANNER_TEMP.'/'.$key;
                move_uploaded_file($data->file->tmp_name, $source);

                $image = $this->model->image->load($source);
                /*if ($image->getHeight()*(self::IMG_WIDTH/$image->getWidth())<self::IMG_HEIGHT)
                    $image->shrinkToHeight(self::IMG_HEIGHT);
                else*/
                    $image->shrinkToWidth(1000);
                $image->save($source,IMAGETYPE_PNG);

                $_SESSION['pano_img'] = $key;
            }
            else
            {
                $image1 = $this->model->image->load($source);
                $w1 = $image1->getWidth();
                $h = $image1->getHeight();
                $image1_src = $image1->getImage();
                $image2 = $this->model->image->load($data->file->tmp_name)->resizeToHeight($h);
                $w2 = $image2->getWidth();
                $image2_src = $image2->getImage();
                $new = imagecreatetruecolor($w1+$w2, $h);
                imagecopy($new, $image1_src, 0, 0, 0, 0, $w1, $h);
                imagecopy($new, $image2_src, $w1, 0, 0, 0, $w2, $h);
                $image = $this->model->image->setImage($new);
                if ($image->getHeight()*(self::IMG_WIDTH/$image->getWidth())<self::IMG_HEIGHT)
                    $image->shrinkToHeight(self::IMG_HEIGHT);
                else
                    $image->shrinkToWidth(self::IMG_WIDTH);
                $image->save($source,IMAGETYPE_PNG);
            }
            $this->Url_redirectTo('admin/pano/resize');
        }
        else $form->renderErrors($this->tpl);
    }

    function resizeAction(array $params)
    {
        $key = @$_SESSION['pano_img'];
        if ($key)
            $this->tpl->assignBlockVars('img_exists');

        $form = $this->load->form('admin/pano/resize');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());

            $source = DIR_ROOT.'/'.self::DIR_BANNER_TEMP.'/'.$key;
            $image = $this->model->image->load($source);
            $image->crop($data->x,$data->y,$data->w,$data->h)->resizeToWidth(self::IMG_WIDTH);
            $image->save($source);

            $this->Url_redirectTo('admin/pano/add');
        }
        else $form->renderErrors($this->tpl);

        $this->tpl->assignVar('KEY',$key);
        $this->tpl->assignVar('RAND',rand(1,1000));
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
                $this->model->pano->edit(array('position' => $count-$position), $id);
            }
        }
    }

    function disableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->pano->edit(array('disabled'=>1),$id);
        die('ok');
    }

    function enableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->pano->edit(array('disabled'=>0),$id);
        die('ok');
    }
}