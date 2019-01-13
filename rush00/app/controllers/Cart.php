<?php
/**
 * Shopping Cart
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Cart
 */
class App_Cart extends Controller
{
    function indexAction(array $params)
    {
        $items = (array)json_decode(stripslashes(@$_COOKIE['cart']),true);
        
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
    
    function totalAction(array $params)
    {
        $items = (array)json_decode(stripslashes(@$_COOKIE['cart']),true);
        
        $total = 0;
        $products = $this->model->product->getByIds(array_keys($items));
        foreach ($products as $product)
        {
            $count = array_key_exists($product->id,$items) ? $items[$product->id] : 1;
            $count = preg_match('@^[0-9]+$@i',$count) ? $count : 1;
            $total+= $count*$product->price;
        }
        die((string)$total);
    }
    
    function orderAction(array $params)
    {
        $items = (array)json_decode(stripslashes(@$_COOKIE['cart']),true);
        if (empty($_COOKIE['cart']) || empty($items))
            return $this->Url_redirectTo('cart');
        $products = $this->model->product->getByIds(array_keys($items));
        if ($products->isEmpty())
            die('products dont exist');
        
        $form = $this->load->form('cart/order');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $id = $this->model->order->add(array(
                'cart' => stripslashes(@$_COOKIE['cart']),
                'name'  => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'message' => $data->message,
                'step' => 1,
                'timestamp'  => time()
            ));
            /**
             * Смета
             */
            $total = 0;
            $orders = array();
	        foreach ($products as $product)
	        {
	            $count = array_key_exists($product->id,$items) ? $items[$product->id] : 1;
	            $count = preg_match('@^[0-9]+$@i',$count) ? $count : 1;
	            $total+= $count*$product->price;
	            $orders[] = $product->name.' ('.$count.' шт) - '.($count*$product->price).' грн.';
	        }
            /**
             * Отправка на мыло
             */
            $sent = false;
            if ($this->var->email)
            {
                require_once DIR_LIB.'/phpmailer/class.phpmailer.php';

                $mail = new PHPMailer();
                $mail->From     = 'no-reply@'.$_SERVER['SERVER_NAME'];//$data->email;
                $mail->FromName = $_SERVER['SERVER_NAME'];//$data->name;
                $mail->Host     = $_SERVER['HTTP_HOST'];
                $mail->Mailer   = "mail";
                $mail->Body    = nl2br(
"Имя: $data->name
Телефон: $data->phone
E-mail: $data->email
Комментарии: $data->message

Заказ:
".join(PHP_EOL,$orders)."

ИТОГО: $total грн.");
                $mail->AltBody = strip_tags(str_replace("<br/>", "\n", $mail->Body));
                $mail->Subject = 'Заказ #'.$id;//$data->subject;
                $emails = array_map('trim',explode(',',$this->var->email));
                foreach ($emails as $email)
                   $mail->AddAddress($email);

                $sent = $mail->Send();
            }
            /**
             * Результат
             */
            if ($id || $sent)
            {
            	die('ok');
                $this->Url_redirectTo('cart/shipping/'.$id);
                //$this->tpl->assignBlockVars('success');
                //unset($_POST);
                //$this->Url_redirectTo('cart/shipping/'.$id);
            }
            else
            {
                //$this->tpl->assignBlockVars('fail');
            }
        }
        else $form->renderErrors($this->tpl);
    }
    
    function shippingAction(array $params)
    {
        $id = (int)@$params[0];
        if (!$id)
            die('id error');
        
        $form = $this->load->form('cart/shipping');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $this->model->order->edit(array(
                'name'  => $data->name,
                'step' => 2,
                'address' => $data->zipcode.', '.$data->state.', '.$data->city.', '.$data->address
            ),$id);
            /**
             * Результат
             */
            if (isset($params[1]) && $params[1]=='pay')
            {
                $this->Url_redirectTo('cart/payment/'.$id);
            }
            else
            {
                die('ok');
            }
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVar('ID',$id);
    }
    
    function paymentAction(array $params)
    {
        $id = (int)@$params[0];
        if (!$id)
            die('id error');
            
        if (isset($params[1]) && $params[1]=='pay')
        {
            $this->Url_redirectTo('cart/payment2/'.$id);
        }
            
        $order = $this->model->order->getById($id);

        $form = $this->load->form('cart/payment');
        $form->setValues(array('phone'=>preg_replace('@[^0-9]@i','',str_replace('+7','',$order->phone))));
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $this->model->order->edit(array(
                'paymethod'  => 'qiwi',
                'step' => 3,
            ),$id);
            /**
             * Перенаправление на страницу оплаты
             */
            $items = (array)json_decode($order->cart,true);
            $products = $this->model->product->getByIds(array_keys($items));
            $total = 0;
            foreach ($products as $product)
            {
                $count = array_key_exists($product->id,$items) ? $items[$product->id] : 1;
                $count = preg_match('@^[0-9]+$@i',$count) ? $count : 1;
                $total+= $count*$product->price;
            }
            die("<meta http-equiv=\"refresh\" content=\"0; url=http://w.qiwi.ru/setInetBill_utf.do?".http_build_query(array(
                'from' => QIWI_LOGIN,
                'lifetime' => '72.0',
                'check_agt' => 'false',
                'txn_id' => $id,
                'to' => $data->phone,
                'summ' => $total,
                'com' => $product->name,
            ))."\"/><p>Пожалуйста, подождите, идет перенаправление на QIWI Кошелек...</p>");
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVar('ID',$id);
    }
    
    function payment2Action(array $params)
    {
        $id = (int)@$params[0];
        if (!$id)
            die('id error');
            
        if (isset($params[1]) && $params[1]=='pay')
        {
            $this->Url_redirectTo('cart/payment/'.$id);
        }
        $paymethodtext = array(
            'alfabank' => 'Альфабанк',
            'sberbank' => 'Сбербанк',
            'contact' => 'платежные системы Contact, Migom, Золотая Корона'
        );
            
        if (false === ($stuff = $this->cache->get('stuff')))
        {
            $stuff = $this->model->stuff->get();
        }
        $order = $this->model->order->getById($id);
        $product = $this->model->product->getById($order->product_id);
        
        $form = $this->load->form('cart/payment2');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $this->model->order->edit(array(
                'paymethod'  => $data->paymethod
            ),$id);
            /**
             * Отправка на мыло
             */
            $sent = false;
            if ($order->email)
            {
                require_once DIR_LIB.'/phpmailer/class.phpmailer.php';

                $mail = new PHPMailer();
                $mail->From     = 'info@'.$_SERVER['SERVER_NAME'];//$data->email;
                $mail->FromName = $_SERVER['SERVER_NAME'];//$data->name;
                $mail->Host     = $_SERVER['HTTP_HOST'];
                $mail->Mailer   = "mail";
                $mail->Body    = nl2br(
"Ваш заказ: {$product->name}
Стоимость: {$product->price} руб

Реквизиты для оплаты через {$paymethodtext[$data->paymethod]}:
".$stuff->{'pay_'.$data->paymethod}."");
                $mail->AltBody = strip_tags(str_replace("<br/>", "\n", $mail->Body));
                $mail->Subject = 'Заказ '.$product->name;//$data->subject;
                $mail->AddAddress($order->email);

                $sent = $mail->Send();
            }
            /**
             * Результат
             */
            die('ok');
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVars(array(
            'ID'=>$id,
            'PAY_ALFABANK' => nl2br($stuff->pay_alfabank),
            'PAY_SBERBANK' => nl2br($stuff->pay_sberbank),
            'PAY_CONTACT'  => nl2br($stuff->pay_contact)
        ));
    }
}