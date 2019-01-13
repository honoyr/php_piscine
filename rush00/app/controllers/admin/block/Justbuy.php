<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Admin_Block_Justbuy extends Controller
{
    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        $this->settingsAction($params);
    }

    function settingsAction(array $params)
    {
        $data = $this->model->stuff->get();
        $form = $this->load->form('admin/stuff/justbuy');
        if (!$form->isSubmit())
        {
            $form->setValues($data->asArray());
            $form->setValues(array('justbuy_products'=>explode('|',$data->justbuy_products)));
        }    
        $optionsAll = array();
        /*$cats = $this->model->product->category->getTree();
        foreach ($cats as $cat)
        {
            $this->tpl->assignBlockVars('cat',array(
               'ID' => $cat->id,
               'NAME' => $cat->name
            ));
            if (!$cat->children->isEmpty())
            {
                $options = array();
                foreach ($cat->children as $subcat)
                {
                    $optionsAll[] = $options[$subcat->id] = $subcat->name;
                }
                $form->setOptions(array('cat'.$cat->id => $options));
            }
        }*/
        $products = $this->model->product->get($total);
        foreach ($products as $product)
        {
        	$optionsAll[$product->id] = $product->name;
        }
        $form->setOptions(array('products' => $optionsAll));
        if ($form->isSubmit() && $form->isValid())
        {
        	$data = $form->getData();
        	$data['justbuy_products'] = join('|',$_POST['justbuy_products']);
            $this->model->stuff->save($data,1);
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }
}