<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Page
 * @author dandelion <web.dandelion@gmail.com>
 * @package Page
 */
class Page extends Object implements iSingleton
{
    private static $instance;
    
    private function __construct(){}
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Выходные данные, все содержимое страницы
     *
     * @var string
     */
    protected $content;
    
    /**
     * Страничные переменные
     */
    protected $title;
    protected $keywords;
    protected $description;

    /**
     * Экземпляры обьектов страницы
     */
    protected $template;
    protected $user;
    protected $application;
    protected $lang = 'ru';
    
    /**
     * Ключ кеша страницы
     */
    private $key;
    
    /**
     * Собираем страницу
     *
     * @return object
     */
    public function build()
    {
    	/**
         * Создаем пользователя
         */
        $user = User::getInstance();
        $user->checkIfLoggedIn();
        $this->setUser($user);
        
        /**
         * Проверяем наличие данной страницы в кеше
         */
        /*$cache = Cache::getInstance();
        $cache->cleanStick = array('general');
        if (!$this->isCachable() || false === ($this->content = $cache->get($this->getKey())))
        {*/
	        /**
	         * Загружаем шаблонизатор
	         */
	        $template = Template::factory();
	        $template->setFile(DIR_TEMPLATES.'/default'.EXT_TPL);
	        $this->setTemplate($template);
	        
	        /**
	         * Загружаем приложение
	         */
	        $application = Application::factory();
	        $this->setApplication($application);
	        
	        /**
	         * Подгружаем виджеты
	         */
	        $widgets = include DIR_CONFIG.'/widgets'.EXT_PHP;
	        foreach ($widgets as $widget)
	        	Widget::factory((string)$widget); 
	            
	        /**
	         * Получаем содержимое страницы от шаблонизатора
	         */
	        $this->content = $this->template->compile()->getOutput();
	        
	        /**
	         * Кешируем страницу
	         */
	        /*if ($this->isCachable())
	            $cache->set($this->content, $this->getKey(), array('general'));
        }
        else debug($this->getKey(), 'Страница взята из кеша с ключом');*/

        Timer::finish();
        return $this;
    }
    
    function isCachable()
    {
    	return (empty($_POST) && empty($_GET) && empty($_FILES) && PRODUCTION);
    }
    
    function getKey()
    {
    	if (null === $this->key)
    	{
    		$page = URL_APP;
    		$roles = $this->user->getRole();
    		$lang = $this->lang;
    		$this->key = "site_content_of_page_{$page}_for_roles_{$roles}_in_language_{$lang}";
    	}
    	return $this->key;
    }
}