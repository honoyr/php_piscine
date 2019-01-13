<?php

/**
 * User Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_User extends Model_Default
{
    protected $table = 'users';
    protected $cacheTag = 'user';

	function logIn()
    {
        $this->Auth_setSession()->setCookie();
        return $this;
    }

    function logOut()
    {
        $this->Auth_cleanSession()->cleanCookie();
        return $this;
    }

    function getByName($name)
    {
    	$cacheKey = 'user_by_name_'.$name;
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow("SELECT * FROM ?_{$this->table} WHERE `User`=?", $name);
            $data = new Entity($data);
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return $data;
    }

    static function checkIfEmailExists($email)
    {
        if (empty($email))  return true;
        $db = Db::factory();
        return !(bool)$db->selectCell("SELECT COUNT(`email`) FROM ?_users WHERE `email`=?", $email);
    }

    function getIp()
    {
        if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        elseif (isset($_SERVER["HTTP_CLIENT_IP"]))
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else
            $ip = $_SERVER["REMOTE_ADDR"];
        return $ip;
    }
}