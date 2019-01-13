<?php
/**
 * Blog
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Blog extends Controller
{
    const ITEMS_PER_PAGE = 25;

	CONST DIR_PICTURES = 'blog';
    CONST DIR_PICTURES_TEMP = 'temp';

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
            $this->load->view('admin/blog/table');
        }
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $item = $this->model->blog->getById($id);
        $this->tpl->assignBlockVars('blog', array(
            'CONTENT' => $item->content_html
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
        $items = $this->model->blog->get($total, $start, self::ITEMS_PER_PAGE, true);
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('blog', array(
                'ID'    => $item->id,
                'NAME'  => $item->name,
                'AUTHOR'=> $item->author,
                'BRIEF' => $item->brief_html,
                'DATE'  => date('j ',$item->timestamp).$this->model->date->getOfMonthText(date('m',$item->timestamp)).date(' Y',$item->timestamp)
            ));
            if ($item->picture)
            {
                $src = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
                if (is_file($src))
                {
                    $imageInfo = getimagesize($src);
                    $this->tpl->assignBlockVars('blog.picture',array(
                        'SRC' => $item->picture,
                        'WIDTH'  => $imageInfo[0],
                        'HEIGHT' => $imageInfo[1]
                    ));
                }
            }
	        if (!$item->disabled)
	            $this->tpl->assignBlockVars('blog.enabled');
	        else
	            $this->tpl->assignBlockVars('blog.disabled');
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
        $form = $this->load->form('admin/blog/add');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
        	$dataToInsert = array(
                'user_id'    => $this->user->data->id, 
                'name'      => $data->name,
        	    'key'    => $data->key,
        	    'brief_wiki'  => $data->brief_wiki,
                'brief_html'  => $this->model->wiki->parseArticle($data->brief_wiki),
                'content_wiki'  => $data->content_wiki,
                'content_html'  => $this->model->wiki->parseArticle($data->content_wiki),
                'title'      => $data->title,
                'keywords'   => $data->keywords,
                'description'=> $data->description,
        	    'timestamp'  => time()
        	);
        	$id = $this->model->blog->add($dataToInsert);
        	if ($data->pictureKey)
        	{
        		$source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = substr(uniqid(),0,5).$id.'.png';
        		$dest   = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$filename;
        		if (is_file($source))
        		{
        			copy($source, $dest);
        			unlink($source);
                    $this->model->blog->edit(array(
                        'picture' => $filename
                    ),$id);
        		}
        	}
            //$this->model->blog->edit(array('key'=>$id),$id);
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

        $item = $this->model->blog->getById($id);
        if ($item->isEmpty())
            die('fail2');

        $form = $this->load->form('admin/blog/edit');
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
            function get_timestamp($date) {
                list($d, $m, $y) = explode('.', $date);
                return mktime(0, 0, 0, $m, $d, $y);
            }
            $dataToInsert = array(
                'name'      => $data->name,
                'brief_wiki'  => $data->brief_wiki,
                'brief_html'  => $this->model->wiki->parseArticle($data->brief_wiki),
                'content_wiki'  => $data->content_wiki,
                'content_html'  => $this->model->wiki->parseArticle($data->content_wiki),
                'title'      => $data->title,
                'keywords'   => $data->keywords,
                'description'=> $data->description,
                'timestamp' => get_timestamp($data->date),
            );
            /**
             * Сохраняем логотип
             */
            if ($data->pictureKey)
            {
                $source = DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP.'/'.$data->pictureKey;
                $filename = substr(uniqid(),-5).$id.'.png';
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
			            /**
			             * Удаляем из корзины
			             */
			            $this->model->bin->delete('blogPicture',$data->pictureKey);
                    }
                }
            }
            $this->model->blog->edit($dataToInsert,$id);
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

    	$item = $this->model->blog->getById($id);
        if ($item->isEmpty())
            die('fail');

    	$this->model->blog->delete($id);
    	if ($item->picture)
    	{
    	    $src = DIR_IMAGES.'/'.self::DIR_PICTURES.'/'.$item->picture;
            if (is_file($src))
                unlink($src);
    	}
    	die('ok');
    }

    function disableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->blog->edit(array('disabled'=>1),$id);
        die('ok');
    }

    function enableAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $this->model->blog->edit(array('disabled'=>0),$id);
        die('ok');
    }

    function cancelAction(array $params)
    {
        //$this->model->dir->clean(DIR_IMAGES.'/'.self::DIR_PICTURES_TEMP);
        if (@$params[0]=='add')
            $this->Url_redirectTo('admin/blog/add');
    }

    function pictureAction(array $params)
    {
    	$form = $this->load->form('admin/blog/picture/upload');
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
            /**
             * Кидаем ее в корзину
             */

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
        	/**
        	 * Удаляем из корзины
        	 */
        	$this->model->bin->delete('blogPicture',$_POST['pictureKey']);
        }
    }
}