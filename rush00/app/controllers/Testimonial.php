<?php
/**
 * Testimonial
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Testimonial
 */
class App_Testimonial extends Controller
{
    CONST DIR_PICTURES_S = 'people/s';
    CONST DIR_PICTURES_L = 'people/l';
    
    const PHOTO_WIDTH = 80;
    const PHOTO_HEIGHT = 100;
    
    function indexAction(array $params)
    {
        $form = $this->load->form('testimonial');
        if ($form->isSubmit() && $form->isValid())
        {
            $data = new Entity($form->getData());
            /**
             * Сохранение данных
             */
            $id = $this->model->testimonial->add(array(
                'name'  => strip_tags($data->name),
                'phone' => strip_tags($data->phone),
                'city' => strip_tags($data->city),
                'duties' => strip_tags($data->duties),
                'website' => strip_tags($data->website),
                'message' => trim(strip_tags($data->message)),
                'timestamp'  => time()
            ));
            if ($data->file && $data->file->tmp_name)
            {
                $source = $data->file->tmp_name;
                $filename = $id.substr(uniqid(),-5).'.jpg';
                $destS = DIR_IMAGES.'/'.self::DIR_PICTURES_S.'/'.$filename;
                $destL = DIR_IMAGES.'/'.self::DIR_PICTURES_L.'/'.$filename;
                if (move_uploaded_file($data->file->tmp_name,$destL))
                {
                    $image = $this->model->image->load($destL);
                    $image->make(self::PHOTO_WIDTH,self::PHOTO_HEIGHT)->save($destS,IMAGETYPE_JPEG);
                    $this->model->testimonial->edit(array(
                        'picture' => $filename
                    ),$id);
                }
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
Город: $data->city
Должность: $data->duties
Отзыв: $data->message");
                $mail->AltBody = strip_tags(str_replace("<br/>", "\n", $mail->Body));
                $mail->Subject = 'Новый отзыв';//$data->subject;
                $emails = array_map('trim',explode(',',$this->var->email));
                foreach ($emails as $email)
                   $mail->AddAddress($email);
                if ($data->file && $data->file->tmp_name)
                    $mail->AddAttachment($destS);

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