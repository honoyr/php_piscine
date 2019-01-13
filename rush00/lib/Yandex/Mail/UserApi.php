<?php   
/**
 * Created by IntelliJ IDEA.
 * User: ilazarev
 * Date: 12.04.2010
 * Time: 18:18:41
 * To change this template use File | Settings | File Templates.
 */


class Yandex_Mail_UserApi extends Yandex_Mail_Api_Base
{
    private $_token;

    /**
     * @param string $token
     * @param handler $curl
     * @param bool $debug
     * @return void
     */
    public function __construct($token, $curl = null, $debug = false)
    {
        $this->_token = $token;
        parent::__construct($curl, $debug);
    }

    protected function invokeHandler($handler_name, array $params)
    {
        if (!in_array('token', $params)) {
              $params['token'] = $this->_token;
        }
        return parent::invokeHandler($handler_name, $params);
    }

    /**
     * @param string $login
     * @param string $password
     * @return SimpleXMLElement
     */
    public function createUser($login, $password)
    {
        return $this->invokeHandler('reg_user_token',
            array('u_login' => $login, 'u_password' => $password)
        );
    }

    /**
     * @param string $login
     * @return SimpleXMLElement
     */
    public function deleteUser($login)
    {
        return $this->invokeHandler('delete_user',
            array('login' => $login)
        );
    }

    /**
     * @param string $login
     * @param string $new_password
     * @param string $first_name
     * @param string $last_name
     * @param int $sex 1 - male, 2 - female
     * @return SimpleXMLElement
     */
    public function editUserDetails($login, $new_password = null, $first_name = null, $last_name = null, $sex = null)
    {

        return $this->invokeHandler('edit_user',
            array(
                'login' => $login,
                'password' => $new_password,
                'iname' => $first_name,
                'fname' => $last_name,
                'sex' => $sex
            )
        );
    }

    /**
     * @param string  $method - [imap, pop3]
     * @param string $extern_host
     * @param string $extern_port
     * @param string $is_ssl - [yes, no]
     * @param string $callback
     * @return SimpleXMLElement
     */
    public function setImportSettings($method, $extern_host, $extern_port = null, $is_ssl = "no", $callback = null)
    {
        return $this->invokeHandler('set_domain', array(
            'method' => $method,
            'ext_srv' => $extern_host,
            'ext_port' => $extern_port,
            'isssl' => $is_ssl,
            'callback' => $callback,
        ));
    }

    /**
     * @param string $inner_login
     * @param string $extern_login
     * @param string $exten_password
     * @return SimpleXMLElement
     */
    public function startImport($inner_login, $extern_login, $exten_password)
    {
        return $this->invokeHandler('start_import', array(
            'login' => $inner_login,
            'ext_login' => $extern_login,
            'password' => $exten_password
        ));
    }

    /**
     * @param string $login
     * @return SimpleXMLElement
     */
    public function getImportState($login)
    {
        return $this->invokeHandler('check_import', array(
            'login' => $login,
        ));
    }

    /**
     * @param string $inner_login
     * @param string $inner_password
     * @param string $extern_login
     * @param string $extern_password
     * @return SimpleXMLElement
     */
    public function registerAndStartImport($inner_login, $inner_password, $extern_login, $extern_password) 
    {
        return $this->invokeHandler('reg_and_imp', array(
            'login' => $inner_login,
            'ext_login' => $extern_login,
            'inn_password' => $inner_password,
            'ext_password' => $extern_password
        ));
    }

    /**
     * @param string $login
     * @return SimpleXMLElement
     */
    public function getUnreadMessagesCount($login)
    {
        return $this->invokeHandler('get_mail_info', array('login' => $login));
    }

    /**
     * @param string $login
     * @return SimpleXMLElement
     */
    public function getUserInfo($login)
    {
        return $this->invokeHandler('get_user_info', array('login' => $login));
    }

    /**
     * @param int $page
     * @param int $perpage
     * @return SimpleXMLElement
     */
    public function getUsersList($page = 1, $perpage = 100)
    {
        return $this->invokeHandler('get_domain_users', array('page' => $page, 'perpage' => $perpage));
    }

    /**
     * @param string $login
     * @return SimpleXMLElement
     */
    public function stopImport($login)
    {
        return $this->invokeHandler('stop_import', array('login' => $login));
    }

}