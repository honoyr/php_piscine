<?php
/**
 * Product Main Page
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Product_Main
 */
class App_Admin_Product_Main extends Controller
{
    const ITEMS_PER_PAGE = 250;

    CONST DIR_PICTURES_S = 'product/s';
    CONST DIR_PICTURES_L = 'product/l';
    CONST DIR_PICTURES_TEMP = 'product/temp';

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
            $this->load->view('admin/product/main/table');
        }
    }

    function tableAction(array $params = array())
    {
        $catOptions = array();
        $cats = $this->model->product->category->getTree(true);
        foreach ($cats as $cat)
        {
            $catOptions[$cat->id] = $cat->name;
            if ($cat->children)
            foreach ($cat->children as $subcat)
            {
                $catOptions[$subcat->id] = '-- '.$subcat->name;
                if ($subcat->children)
                foreach ($subcat->children as $subsubcat)
                {
                    $catOptions[$subsubcat->id] = '---- '.$subsubcat->name;
                }
            }
        }
        $form = $this->load->form('admin/category');
        $form->setOptions(array('cats'=>$catOptions));
        $form->setValues(array('category'=>'main'));
        /**
         * Параметры
         */
        $page = 1;
        if (isset($params[1]) && $params[1]=='page')
            $page = (!empty($params[2]))?(int)$params[2]:1;
        if (!$page)
            $page = 1;

        $start = ($page-1)*self::ITEMS_PER_PAGE;
        $product = $this->model->product->getMain($total, $start, self::ITEMS_PER_PAGE, true);
        foreach ($product as $item)
        {
            $this->tpl->assignBlockVars('product', array(
                'ID'    => $item->id,
                'NAME'  => $item->name,
                'PRICE' => $item->price,
                'PRICE_OLD' => $item->price_old,
                'BRIEF' => $item->brief
            ));
            if ($item->picture)
            {
                $src = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$item->picture;
                if (is_file($src))
                {
                    $imageInfo = getimagesize($src);
                    $this->tpl->assignBlockVars('product.picture',array(
                        'SRC' => $item->picture,
                        'WIDTH'  => $imageInfo[0],
                        'HEIGHT' => $imageInfo[1]
                    ));
                }
            }
            if (!$item->disabled)
                $this->tpl->assignBlockVars('product.enabled');
            else
                $this->tpl->assignBlockVars('product.disabled');
            if ($item->main)
                $this->tpl->assignBlockVars('product.mark');
            else
                $this->tpl->assignBlockVars('product.unmark');
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
                $this->model->product->edit(array('position_main' => $count-$position), $id);
            }
        }
    }
}