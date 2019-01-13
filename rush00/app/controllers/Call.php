<?php
/**
 * Order
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Order
 */
class App_Call extends Controller
{
    function indexAction(array $params)
    {
        $this->var = $this->model->page->get('order');
        
        $form = $this->load->form('call');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity(array_map('strip_tags',$form->getData()));
	        /**
	         * Сохранение данных
	         */
	        $id = $this->model->order->add(array(
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
"Имя: $data->name
Телефон: $data->phone
E-mail: $data->email
Комментарии: $data->message");
	            $mail->AltBody = strip_tags(str_replace("<br/>", "\n", $mail->Body));
	            $mail->Subject = 'Заказ звонка';//$data->subject;
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
	        	$this->tpl->assignBlockVars('success');
	        	unset($_POST);
	        }
	        else
	        {
	        	$this->tpl->assignBlockVars('fail');
	        }
        }
        else $form->renderErrors($this->tpl);
    }
}