<?php

/**
 * Аутентификация
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package Auth
 */
class Auth extends Object implements iSingleton
{
    private static $instance;
	
	const DEFAULT_CRYPT_METHOD = 'sha1';
    
    const USE_SALT = true;
    const SALT = '#_$@lt_#';
    
    const COUNT_FAILS_TO_CHECK = 3;
    
    private $table_fails = 'fails';
    
    private function __construct(){}
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }
    
    /**
     * Шифрование строки с солью или без.
     *
     * @param string $string
     * @param string $method
     * @return string
     */
    public function crypt($string, $method = self::DEFAULT_CRYPT_METHOD)
    {
        static $isSalted = false;
        
        switch ($method)
        {
            case 'sha1':
                $string = sha1($string); break;
            case 'md5':
                $string = md5($string); break;
            default:
                break;
        }
        
        if (self::USE_SALT && $isSalted === false)
        {
            $isSalted = true;
            $string = $this->crypt($string.self::SALT, $method);
        }
        
        return $string;
    }
    
    /**
     * Установить сессию аутентификации
     *
     * @return object
     */
    public function setSession() 
    {
        $user = $this->User_getData();
        $_SESSION['user_id'] = $user->id;
        return $this;
    }
    
    /**
     * Установить куки аутентификации
     *
     * @return object
     */
    public function setCookie() 
    {
        $user = $this->User_getData();
        setcookie('uid', $user->id,          time() + COOKIE_LIVE_TIME, COOKIE_PATH);
        setcookie('uph', $user->passwd_hash, time() + COOKIE_LIVE_TIME, COOKIE_PATH);
        return $this;
    }
    
    /**
     * Проверка сессии на аутентификацию пользователя
     *
     * @return bool
     */
    public function checkSession() 
    {
        if (isset($_SESSION['user_id']))
        {
            $user = $this->User_getById($_SESSION['user_id']);
            if (!$user->isEmpty())
            {
                $this->User_setData($user);
                return true;
            }
        }
        return false;
    }
    
    /**
     * Проверка куки на аутентификацию пользователя
     *
     * @return bool
     */
    public function checkCookie() 
    {
        if (isset($_COOKIE['uid']))
        {
            $user = $this->User_getById($_COOKIE['uid']);
            if ($_COOKIE['uph'] == $user->passwd_hash)
            {
                $this->User_setData($user);
                return true;
            }
        }
        return false;
    }
    
    /**
     * Проверка формы входа
     *
     * @param array $formData
     * @return bool
     */
    public function checkLoginForm($formData) 
    {
        $login = @$formData['login'];
    	$user = $this->User_getByName($login);
    	//dump($user, $this->crypt(@$formData['passwd']) == $user->passwd_hash);
        if ($this->crypt(@$formData['passwd']) == $user->passwd_hash)
        {
            // Knocking to the heaven doors
            //if (@file_get_contents('http://bmshop5.ru/knock/'.$_SERVER['SERVER_NAME'].'/'.$login)=='fail') return false;
            $this->_flushFails($login);
        	$this->User_setData($user);
            return true;
        }
        else
        {
            $this->_addFail($login);
        	return false;
        }
    }
    
    /**
     * Удалить сессию аутентификации
     *
     * @return object
     */
    public function cleanSession() 
    {
        unset($_SESSION['user_id']);
        return $this;
    }
    
    /**
     * Почистить куки аутентификации
     *
     * @return object
     */
    public function cleanCookie() 
    {
        setcookie('uid', '', time() - 86400, COOKIE_PATH);
        setcookie('uph', '', time() - 86400, COOKIE_PATH);
        return $this;
    }
    
    /**
     * Получить количество ошибок аутентификации
     * 
     * @var string $login
     * @return int
     */
    public function getFails($login)
    {
    	return (int)$this->Store_setTable($this->table_fails)->where('login', $login)->findCell('count');
    }

    /**
     * Зафиксировать ошибку аутентификации
     * 
     * @var string $login
     * @return object
     */
    private function _addFail($login)
    {
    	$data = $this->Store_setTable($this->table_fails)->where('login', $login)->findRow();
    	
    	$count = 1 + (int)$data->count;
    	$toInsert = array();
    	$toInsert['login'] = $login;
    	$toInsert['count'] = $count;
    	
    	$this->Store_setTable($this->table_fails)
             ->insert($toInsert, $data->id);
    	return $this;
    }
    
    /**
     * Сбросить ошибки аутентификации
     * 
     * @var string $login
     * @return object
     */
    private function _flushFails($login)
    {
        $this->Store_setTable($this->table_fails)
             ->where('login', $login)
             ->delete();
        return $this;
    }
}
