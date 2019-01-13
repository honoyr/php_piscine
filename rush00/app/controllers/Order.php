<?php
/**
 * Order
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Order
 */
class App_Order extends Controller
{
    function indexAction(array $params)
    {
        $product_id = (int)@$params[0];
        if (!$product_id)
            die('id error');
        $product = $this->model->product->getById($product_id);
        if ($product->isEmpty())
            die('product doesnt exist');
    	
        $form = $this->load->form('order');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
	        /**
	         * Сохранение данных
	         */
	        $id = $this->model->order->add(array(
                'product_id' => $product_id,
	            'name'  => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
	            'message' => $data->message,
	            'timestamp'  => time()
	        ));
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
"Товар: $product->name
Имя: $data->name
Телефон: $data->phone
E-mail: $data->email
Комментарии: $data->message");
	            $mail->AltBody = strip_tags(str_replace("<br/>", "\n", $mail->Body));
	            $mail->Subject = 'Заказ '.$product->name;//$data->subject;
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
	        	//$this->tpl->assignBlockVars('success');
	        	//unset($_POST);
                //$this->Url_redirectTo('order/shipping/'.$id);
	        }
	        else
	        {
	        	//$this->tpl->assignBlockVars('fail');
	        }
        }
        else $form->renderErrors($this->tpl);
        
        $this->tpl->assignVars(array(
            'ID'=>$product_id,
            'PRODUCT_NAME'=>$product->name
        ));
    }
    
    function shippingAction(array $params)
    {
        $id = (int)@$params[0];
        if (!$id)
            die('id error');
        
        $form = $this->load->form('order2');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $this->model->order->edit(array(
                'name'  => $data->name,
                'address' => $data->zipcode.', '.$data->state.', '.$data->city.', '.$data->address
            ),$id);
            /**
             * Результат
             */
            if (isset($params[1]) && $params[1]=='pay')
            {
                $this->Url_redirectTo('order/payment/'.$id);
            }
            else
            {
                $this->Url_redirectTo('order/payment2/'.$id);
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
            $this->Url_redirectTo('order/payment2/'.$id);
        }
            
        $order = $this->model->order->getById($id);

        $form = $this->load->form('order3');
        $form->setValues(array('phone'=>preg_replace('@[^0-9]@i','',str_replace('+7','',$order->phone))));
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
            /**
             * Сохранение данных
             */
            $this->model->order->edit(array(
                'paymethod'  => 'qiwi'
            ),$id);
            /**
             * Перенаправление на страницу оплаты
             */
            $product = $this->model->product->getById($order->product_id);
            die("<meta http-equiv=\"refresh\" content=\"0; url=http://w.qiwi.ru/setInetBill_utf.do?".http_build_query(array(
                'from' => QIWI_LOGIN,
                'lifetime' => '72.0',
                'check_agt' => 'false',
                'txn_id' => $id,
                'to' => $data->phone,
                'summ' => $product->price,
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
            $this->Url_redirectTo('order/payment/'.$id);
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
        
        $form = $this->load->form('order3b');
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