<?php

/**
 * Auth
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Auth extends Controller
{
	function indexAction(array $params)
    {
        $this->Url_redirectToHome();
    }
    /**
     * Вход на сайт
     */
    function loginAction() 
    {
        if ($this->user->isLoggedIn())
            $this->Url_redirectToHome();
        
        /**
         * Загружаем обычную форму или форму с капчей, если были ошибки 
         * при вводе пароля.
         */
        if (isset($_SESSION['auth_check']) && $_SESSION['auth_check'])
        {
            $form = $this->load->form('auth/login/advanced');
            if (!empty($_SESSION['auth_login']))
                $form->setValues(array('email' => $_SESSION['auth_login']));
            unset($_SESSION['auth_login']);
            $this->tpl->assignBlockVars('if_captcha');
        }
        else $form = $this->load->form('auth/login/simple');
        $form->addErrorToAttr = true;
        if (!$form->isSubmit())
            $form->setValues(array('remember_me'=>'on'));
        if ($form->isSubmit() && $form->isValid())
        {
        	$data = new Entity($form->getData());
            $this->Auth_setSession();
            if ($data->remember_me)
                $this->Auth_setCookie();
            unset($_SESSION['auth_check'], $_SESSION['auth_login']);
            if ($this->user->checkIfLoggedIn()->isLoggedIn())
                $this->Url_redirectTo('admin');
        }
        else $form->renderErrors($this->tpl, 'login');
        
        $this->tpl->assignVar('RAND', rand(1,10000));
    }
    /**
     * Выход с сайта
     */
    function logoutAction() 
    {
        if ($this->user->isLoggedIn())
        	$this->model->user->logOut();
        	
        $this->Url_redirectToHome();
    }
    
    static function checkLoginForm($password)
    {
        if (empty($password)) return true;
        
        $auth = Auth::getInstance();
        $formData = array(
            'login'  => @$_POST['email'],
            'passwd' => $password
        );
        return $auth->checkLoginForm($formData);
    }
    
    static function checkFails($login)
    {
        if (empty($login)) return true;
        $auth = Auth::getInstance();
        if ($auth->getFails($login) >= Auth::COUNT_FAILS_TO_CHECK)
        {
            $_SESSION['auth_check'] = 1;
            $_SESSION['auth_login'] = $login;
            $url = Url::getInstance();
            $url->redirectTo('auth/login');
        }
        return true;
    }
}