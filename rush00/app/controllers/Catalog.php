<?php
/**
 * Catalog
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Catalog extends Controller
{
    protected $itemsPerPage = 30; 

    function indexAction(array $params)
    {
        if (empty($params))
        {
            $this->load->view('catalog/main');
            return $this->mainAction($params);
        }
        /**
         * Параметры
         */
        $page = 1;
        if(in_array('page',$params))
        {
            $pageInd = array_search('page',$params);
            if(isset($params[$pageInd+1]))
                $page = $params[$pageInd+1];
            unset($params[$pageInd]);
            unset($params[$pageInd+1]);
        }
        if (!$page)
            $page = 1;
            
        $key = @$params[0];
        if (empty($key))
        {
            return $this->Url_redirectToHome();
        }

        $category = $this->model->product->category->getByKey($key);
        $this->tpl->assignBlockVars('category', array(
            'ID'    => $category->id,
            'KEY'   => $category->key,
            'NAME' => $category->name,
            'SEOTEXT' => $category->seotext_html,
            'DESCRIPTION' => $category->description_html
        ));
        if ($category->seotext_html)
            $this->tpl->assignBlockVars('category.seotext');
        if ($category->block)
            $this->tpl->assignBlockVars('category_block',array(
                'HTML' => $category->block,
            ));
        if ($category->title)
            $this->page->setTitle($category->title);
        $this->page->setKeywords($category->keywords)
                   ->setDescription($category->description);
        // Subcats
        $subcats = $this->model->product->category->getSub($category->id);
        foreach ($subcats as $subcat)
        {
            $this->tpl->assignBlockVars('subcat', array(
                'ID'    => $subcat->id,
                'KEY'   => $subcat->key,
                'NAME'  => $subcat->name,
                'COUNT' => $this->model->product->getCount($subcat->id)
            ));
        }
        if (!$subcats->isEmpty())
            $this->tpl->assignBlockVars('if_subcats');
        // Upper cats
        $uppercats = array();
        if ($category->parent_id)
        {
            $uppercat = $this->model->product->category->getById($category->parent_id);
            $uppercats[] = $uppercat;
            if ($uppercat->parent_id)
            {
                $uppercat = $this->model->product->category->getById($uppercat->parent_id);
                $uppercats[] = $uppercat;
            }
        }
        $uppercats = array_reverse($uppercats);
        foreach ($uppercats as $uppercat)
        {
            $this->tpl->assignBlockVars('uppercat', array(
                'KEY'   => $uppercat->key,
                'NAME'  => $uppercat->name
            ));
        }
        if (!empty($uppercats))
            $this->tpl->assignBlockVars('if_uppercats');
        /**
         * Выборка данных
         */
        if ($this->var->itemsPerPage)
            $this->itemsPerPage = $this->var->itemsPerPage;
        $start = ($page-1)*$this->itemsPerPage;
        $entries = $this->model->product->getByCategory($category->id, $total, $start, $this->itemsPerPage);
        $i=0;
        foreach ($entries as $product)
        {
            $i++;
            $this->tpl->assignBlockVars('product', array(
                'ID'   => $product->id,
                'NAME' => $product->name,
                'BRIEF' => $product->brief,
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
        if (!$entries->isEmpty())
            $this->tpl->assignBlockVars('products');
        /**
         * Навигация
         */
        $paginator = new Paginator(array(
           'countPerPage'  => $this->itemsPerPage,
           'countOfEntries'=> $total,
           'currentPage' => $page,
           'countOfFirstPages'=> 5,
           'countOfLastPages' => 5,
           'countOfMiddlePages'=> 4,
           'template' => $this->tpl
        ));
        $paginator->compile();

        $this->setTitle(array('CATEGORY_NAME'=>$category->name));
        $this->tpl->assignVar('CATEGORY_KEY',$category->key);
    }

    function itemAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id))
        {
            return $this->Url_redirectToHome();
        }

        $product = $this->model->product->getById($id);
        $this->tpl->assignBlockVars('product', array(
            'ID'   => $product->id,
            'NAME' => $product->name,
            'DESCRIPTION' => $product->description_html,
            'SEOTEXT' => $product->seotext_html,
            'PRICE' => $product->price,
            'PRICE_OLD' => $product->price_old,
            'LABEL' => $product->label
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
        if ($product->album)
            $this->tpl->assignBlockVars('product.if_album');
        if ($product->price)
            $this->tpl->assignBlockVars('product.price');
        if ($product->price_old)
            $this->tpl->assignBlockVars('product.price_old');
        if ($product->seotext_html)
            $this->tpl->assignBlockVars('product.seotext');
            
        if ($product->title)
            $this->page->setTitle($product->title);
        $this->page->setKeywords($product->keywords)
                   ->setDescription($product->description);
        // Sizes
        $sizes = (array)json_decode($product->sizes,true);
        foreach ($sizes as $color=>$size)
        {
        	$this->tpl->assignBlockVars('product.size', array(
                'COLOR'   => $color,
                'SIZE'   => $size,
            ));
        }
        if (!empty($sizes))
            $this->tpl->assignBlockVars('product.sizes');
            
        $flag = '_prev';
        $entries = $this->model->product->getByCategory($product->category_id, $total);
        foreach ($entries as $entry)
        {
            if ($entry->picture && $entry->id!=$product->id)
            $this->tpl->assignBlockVars('products'.$flag, array(
                'SRC_BIG'   => is_file(DIR_IMAGES.'/product/l/'.$entry->picture) ? 'l/'.$entry->picture : $entry->picture,
                'NAME' => $entry->name,
            ));
            if ($entry->id==$product->id)
                $flag = '_next';
        }

        $this->setTitle(array('PRODUCT_NAME'=>$product->name));
        
        // Upper cats
        $uppercats = array();
        $parent_cats = $product->category->asArray();
        $parent_id = (int)@$parent_cats[0]['id'];
        if ($parent_id)
        do
        {
            $uppercat = $this->model->product->category->getById($parent_id);
            $uppercats[] = $uppercat;
            $parent_id = $uppercat->parent_id;
        }
        while ($parent_id);
        $uppercats = array_reverse($uppercats);
        foreach ($uppercats as $uppercat)
        {
            $this->tpl->assignBlockVars('uppercat', array(
                'KEY'   => $uppercat->key,
                'NAME'  => $uppercat->name
            ));
        }
        if (!empty($uppercats))
            $this->tpl->assignBlockVars('if_uppercats');
            
        $category = @$uppercats[0];
        if ($category && $category->block)
            $this->tpl->assignBlockVars('category_block',array(
                'HTML' => $category->block,
            ));
        
        /**
         * See also
         */
        if ($product->also)
        {
            $entries = $this->model->product->getByIds(explode('|',$product->also), $total);
            $i=0;
            foreach ($entries as $product)
            {
                $i++;
                $this->tpl->assignBlockVars('also', array(
                    'ID'   => $product->id,
                    'NAME' => $product->name,
                    'BRIEF' => $product->brief,
                    'LABEL' => $product->label,
                    'PRICE' => $product->price,
                    'PRICE_OLD' => $product->price_old
                ));
                if ($product->picture)
                {
                    $this->tpl->assignBlockVars('also.picture', array(
                        'SRC'   => $product->picture
                    ));
                }
                if ($product->price)
                    $this->tpl->assignBlockVars('also.price');
                if ($product->price_old)
                    $this->tpl->assignBlockVars('also.price_old');
            }
            if (!$entries->isEmpty())
                $this->tpl->assignBlockVars('see_also');  
        }
    }
    
    function searchAction(array $params)
    {
        /**
         * Параметры
         */
        $page = 1;
        if(in_array('page',$params))
        {
            $pageInd = array_search('page',$params);
            if(isset($params[$pageInd+1]))
                $page = $params[$pageInd+1];
            unset($params[$pageInd]);
            unset($params[$pageInd+1]);
        }
        if (!$page)
            $page = 1;
            
        $query = empty($_POST['query']) ? urldecode(@$params[0]) : $_POST['query'];
        $query = strip_tags($query);
        if (empty($query))
        {
            return $this->Url_redirectToHome();
        }
        $this->tpl->assignVar('SEARCH_QUERY',$query);
        $this->tpl->assignVar('SEARCH_QUERY2',urlencode($query));
        /**
         * Выборка данных
         */
        if ($this->var->itemsPerPage)
            $this->itemsPerPage = $this->var->itemsPerPage;
        $start = ($page-1)*$this->itemsPerPage;
        $entries = $this->model->product->search($query, $total, $start, $this->itemsPerPage);
        foreach ($entries as $product)
        {
            $this->tpl->assignBlockVars('product', array(
                'ID'   => $product->id,
                'NAME' => $product->name,
                'BRIEF' => $product->brief,
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
        $this->tpl->assignVar('SEARCH_TOTAL',$total);
        if (!$entries->isEmpty())
            $this->tpl->assignBlockVars('products');
        /**
         * Навигация
         */
        $paginator = new Paginator(array(
           'countPerPage'  => $this->itemsPerPage,
           'countOfEntries'=> $total,
           'currentPage' => $page,
           'countOfFirstPages'=> 5,
           'countOfLastPages' => 5,
           'countOfMiddlePages'=> 4,
           'template' => $this->tpl
        ));
        $paginator->compile();
    }
    
    function mainAction(array $params)
    {
        $entries = $this->model->product->getMain($total);
        foreach ($entries as $product)
        {
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
}