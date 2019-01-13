<?php
/**
 * Index
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Index extends Controller
{
    function indexAction(array $params)
    {
    	/**
    	 * Может статическая страница?
    	 */
    	if (!empty($params))
    		return $this->loadStaticPage(join('/', $params));
        /**
         * Контент страницы
         */
        $page = $this->model->page->get('index');
        if (!$page->isEmpty())
        {
            $this->page->setTitle($page->title)
                       ->setKeywords($page->keywords)
                       ->setDescription($page->description);
            if ($page->content_html)
            $this->tpl->assignBlockVars('page', array(
                'TITLE'   => $page->title,
                'CONTENT' => $page->content_html
            ));
        }

        $i=0;
        $entries = $this->model->product->getMain($total);
        foreach ($entries as $product)
        {
            $i++;
            $this->tpl->assignBlockVars('product', array(
                'ID'   => $product->id,
                'NAME' => $product->name,
                'BRIEF' => nl2br($product->brief),
                'LABEL' => $product->label,
                'PRICE' => $product->price,
                'PRICE_OLD' => $product->price_old
            ));
            if ($product->picture)
            {
                $this->tpl->assignBlockVars('product.picture', array(
                    'SRC'   => $product->picture
                ));
                $photos = explode('|',$product->album);
                foreach ($photos as $photo)
                {
                	if ($photo)
                    $this->tpl->assignBlockVars('product.album', array(
                        'SRC'   => $photo
                    ));
                }
            }
            if ($product->price)
                $this->tpl->assignBlockVars('product.price');
            if ($product->price_old)
                $this->tpl->assignBlockVars('product.price_old');
        }
    }

    /**
     * Загружаем статическую страницу
     */
    private function loadStaticPage($name)
    {
    	$page = $this->model->page->get($name);
        if (!$page->isEmpty())
        {
            $this->page->setTitle($page->title)
                       ->setKeywords($page->keywords)
                       ->setDescription($page->description);
            $this->tpl->assignBlockVars('page', array(
                'TITLE'   => $page->title,
                'CONTENT' => $page->content_html
            ));
            if (is_file(DIR_TEMPLATES.'/'.$name.EXT_TPL))
                $this->load->view($name);
            else
                $this->load->view('page');
        }
        else $this->setPage404();
    }
}