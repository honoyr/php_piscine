<?php

/**
 * Пользователь
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package User
 */
class User extends Object implements iSingleton
{
    private static $instance;
    
    protected $userId;
    public $data = array();
    private $loggedIn;
    private $actions;
    
    const ROLE_GUEST = 'guest';
    const ROLE_USER  = 'user';
    const ROLE_ADMIN = 'admin';
    
    const TABLE_NAME = 'users';
    
    private function __construct(){}
    private function __clone() {}
    
    public static function getInstance() 
	{
	    if (self::$instance === null)
	        self::$instance = new self;
	    return self::$instance;
	}
    
    /**
     * Получить данные о пользователе по его имени.
     *
     * @param string $name
     * @return array
     */
    public function getByName($name) 
    {
    	$db = Db::factory();
    	$data = new Entity($db->selectRow("
            SELECT * FROM ?_users
            WHERE `email`=?", $name));
        return $data;
    }
    
    /**
     * Получить данные о пользователе по его идентификатору.
     *
     * @param int $id
     * @return array
     */
    public function getById($id) 
    {
        $db = Db::factory();
        $data = new Entity($db->selectRow("
            SELECT * FROM ?_users
            WHERE `id`=?", $id));
		return $data;
    }
    
    /**
     * Залогинен ли пользователь?
     *
     * @return bool
     */
    public function isLoggedIn() 
    {
        if (null === $this->loggedIn)
            $this->checkIfLoggedIn();
        return $this->loggedIn;
    }
    
    /**
     * Проверить, залогинен ли пользователь...
     *
     * @return object
     */
    public function checkIfLoggedIn()
    {
    	if ($this->Auth_checkSession() || $this->Auth_checkCookie())
        {
            $this->loggedIn = true;
            return $this;
        } 
        $this->loggedIn = false;
        return $this;
    }
    
    /**
     * Получить роль пользователя
     *
     * @return string
     */
    public function getRole() 
    {
        return (!empty($this->data) && !is_null($this->data->role)) ? $this->data->role : 'guest';
    }
    
    /**
     * Получить разрешение на выполнение определенного действия
     * 
     * @param string $action
     * @return bool
     */
    public function isAllowedTo($action)
    {
    	if (null === $this->actions)
    	    $this->_loadActions();
    	    
    	return in_array($action, $this->actions);
    }
    
    /**
     * Загрузить разрешенные действия
     */
    private function _loadActions()
    {
        $store = new Store;
    	$store->setTable('roles');
    	$roles = (array)$this->getRole();
    	sort($roles);
    	
    	$cache = Cache::getInstance();
    	if (false === ($this->actions = $cache->get('actions_by_roles_'.join('+', $roles))))
    	{
	        foreach ($roles as $role)
	        {
	        	$draw = clone $store;
	        	$actions = $draw->where('role', $role)->findRow()->action->asArray();
	        	$this->actions = array_merge((array)$this->actions, $actions);
	        }
	    	$this->actions = array_unique($this->actions);
	    	$cache->set($this->actions, 'actions_by_roles_'.join('+', $roles), array('roles'));
        }
    }
}