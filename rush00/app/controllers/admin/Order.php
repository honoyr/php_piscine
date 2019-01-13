<?php
/**
 * Order
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Order
 */
class App_Admin_Order extends Controller
{
	const ITEMS_PER_PAGE = 25;

    function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();
    }

    function indexAction(array $params)
    {
        /**
         * Параметры
         */
        $page = 1;
        if (isset($params[0]) && $params[0]=='page')
            $page = (!empty($params[1]))?(int)$params[1]:1;
        if (!$page)
            $page = 1;
        /**
         * Выборка данных
         */
        $start = ($page-1)*self::ITEMS_PER_PAGE;
        $orders = $this->model->order->get($start, self::ITEMS_PER_PAGE);
        foreach ($orders as $order)
        {
        	global $qiwi_statuses;
        	if (array_key_exists($order->status,$qiwi_statuses))
        	{
        		$status = $qiwi_statuses[$order->status];
        	}
        	else
        	{
	        	if (!$order->status)
	        	{
	        		$status = 'Счет&nbsp;не&nbsp;выставлен';
	        	} else if ($order->status > 100) {
			        $status = 'Не оплачен ('.$order->status.')';
			    } else if ($order->status >= 50 && $order->status < 60) {
                    $status = 'Cчет в процессе проведения ('.$order->status.')';
			    } else {
                    $status = 'Неизвестный статус заказа ('.$order->status.')';
			    }
        	}
            $this->tpl->assignBlockVars('order', array(
                'ID'    => $order->id,
                'EMAIL' => $order->email,
                'PRODUCT' => $order->cart ? 'см.&nbsp;<a href="javascript:;" class="show_cart">корзину</a>&nbsp;&darr;' : ($order->product ? str_replace(' ','&nbsp;',$order->product) : 'заказ звонка'),
                'PHONE' => $order->phone,
                'NAME'  => $order->name,
                'DATE'  => date('j ',$order->timestamp).$this->model->date->getOfMonthText(date('m',$order->timestamp)).date(' Y, H:i',$order->timestamp),
                'STATUS' => $status,
                'STEP'  => !$order->step ? "" : ($order->step==4 ? 'Оплачено' : 'Шаг '.$order->step),
            ));
        }
        /**
         * Навигация
         */
        $paginator = new Paginator(array(
           'countPerPage'  => self::ITEMS_PER_PAGE,
           'countOfEntries'=> $this->model->order->getCount(),
           'currentPage' => $page,
           'countOfFirstPages'=> 5,
           'countOfLastPages' => 5,
           'countOfMiddlePages'=> 4,
           'template' => $this->tpl
        ));
        $paginator->compile();

        if ($this->byAjax())
        {
        	$this->load->view('admin/order/table');
        }
        else
        {
	        /**
	         * Блок настроек
	         */
	        $var = $this->model->page->get('order');
	        $form = $this->load->form('admin/order/settings');
	        $form->setValues(array(
	            'email' => $var->email
            ));
        }
    }

    function expandAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id)) die();

        $order = $this->model->order->getById($id);
        $this->tpl->assignBlockVars('order', array(
            'MESSAGE' => nl2br($order->message),
            'PAYMETHOD' => $order->paymethod,
            'ADDRESS' => $order->address,
        ));
        
        $items = (array)json_decode($order->cart,true);
        $total = 0;
        $products = $this->model->product->getByIds(array_keys($items));
        foreach ($products as $product)
        {
            $count = array_key_exists($product->id,$items) ? $items[$product->id] : 1;
            $count = preg_match('@^[0-9]+$@i',$count) ? $count : 1;
            $this->tpl->assignBlockVars('product', array(
                'ID'   => $product->id,
                'NAME' => $product->name,
                'PRICE' => $product->price,
                'COUNT' => $count,
            ));
            $total+= $count*$product->price;
        }
        $this->tpl->assignVars(array(
            'PRICE_TOTAL'=>$total
        ));
    }

    function settingsAction(array $params)
    {
    	$var = $this->model->page->get('order');
        $var2 = $this->model->page->get('cart/order');
        $form = $this->load->form('admin/order/settings');
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
            {
                $this->model->page->edit($dataToInsert,$var->id);
            }
            else
            {
            	$dataToInsert['name'] = 'order';
                $dataToInsert['dynamic'] = 'on';
            	$this->model->page->add($dataToInsert);
            }
            if ($var2->id)
            {
                $this->model->page->edit($dataToInsert,$var2->id);
            }
            else
            {
                $dataToInsert['name'] = 'cart/order';
                $dataToInsert['dynamic'] = 'on';
                $this->model->page->add($dataToInsert);
            }
            die('ok');
        }
        else $form->renderErrors($this->tpl);
    }

    function deleteAction(array $params)
    {
        $id = (int)@$params[0];
        if (empty($id))
            die('fail');

        $this->model->order->delete($id);
        die('ok');
    }

    function delete_allAction(array $params)
    {
        $this->model->order->deleteAll();
        die('ok');
    }
}