<?php

/**
 * Маршрутизатор приложений.
 * Для запуска приложения URL соотносится с файловой системой
 * в папке приложений, находится нужный класс, вызывается требуемый метод.
 * Все оставшиеся части URL передаются в приложение в качестве параметров.
 * 
 * Возможные варианты URL:
 * - /dir1/dir2/../dirN/class/action/param1/param2/../paramN
 *      Наиболее общий вариант.
 * - /class
 *      Минимальный вариант. В данном случае будет вызван класс из корня каталога.
 * - /dir/class
 *      В этом случае в классе приложения вызовется действие по умолчанию.
 * - /dir/class/action
 * - /dir/class/action/param
 * - /dir/class/param
 *      В этом случае в классе приложения вызовется действие по умолчанию.
 * - /dir/action
 *      В этом случае вызовется приложение по умолчанию (соответствует имени родительской папки)
 * 
 * TODO: Найти где тут бывает зацикливание (done.) и вообще, к черту, упростить...
 * @author dandelion <web.dandelion@gmail.com>
 * @package AppRouter
 */
class AppRouter extends Object implements iSingleton
{
    private static $instance;
	
	protected $app;
    
    protected $appName;
    protected $appDir;
    protected $appAction;
    protected $appParams;
    
    protected $urlParts = array();
    
    /**
     * Корневая директория приложений
     *
     * @var string
     */
    private $rootDir = DIR_CONTROLLERS;
    
    const APP_CLASSNAME_PREFIX = 'App_';
    const APP_FILE_POSTFIX = '.php';
    const APP_ACTION_POSTFIX = 'Action';
    
    /**
     * Приложение по умолчанию в корневой папке.
     * (Во вложенных папках название приложения по умолчанию соответствует
     * названию папки)
     */
    const APP_DEFAULT_CLASSNAME = 'Index';
    const APP_DEFAULT_ACTION = 'index';

    private function __construct(){}
    
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }
    
    /**
     * Пошагово выясним какое приложение и как будем запускать
     *
     * @return object
     */
    public function defineApp() 
    {
        $this->iMax = count($this->urlParts) - 1;
        
        if (empty($this->urlParts))
        {
            $this->setAppDir($this->rootDir)
                 ->setAppName(self::APP_DEFAULT_CLASSNAME)
                 ->setAppAction(self::APP_DEFAULT_ACTION)
                 ->setAppParams(array())
                 ->loadAppClass();
        }
        else
            $this->dirStep(0);

        return $this;
    }
    
    /**
     * Определим в какой папке будем работать
     *
     * @param int $i
     * @return mixed
     */
    private function dirStep($i)
    {
        if ($i > $this->iMax)
            return $this->setAppDir($this->makeDirPath($this->iMax))->appStep($this->iMax+1);
        
        $dirPath = $this->makeDirPath($i);
        if (file_exists($dirPath))
            $this->dirStep($i+1);
        else
            $this->setAppDir($this->makeDirPath($i-1))->appStep($i);
    }
    
    /**
     * Определим с каким приложением будем работать
     *
     * @param int $i
     * @return mixed
     */
    private function appStep($i)
    {//dump($i, $this->appDir);
        if ($i < 0)
            return $this->setAppDir($this->rootDir)
                        ->setAppName(self::APP_DEFAULT_CLASSNAME)
                        ->loadAppClass()
                        ->actionStep(0);

        if ($i > $this->iMax)
            return $this->setAppDir($this->makeDirPath($i-2))->appStep($i-1);
        else
            $appName = strtoupper($this->urlParts[$i]{0}).substr($this->urlParts[$i], 1);
            
        while (true)
        {
        	$fileName = $this->appDir.'/'.$appName.self::APP_FILE_POSTFIX;
        	//dump($fileName, file_exists($fileName));
            if (file_exists($fileName))
            {
                include_once $fileName;
                //dump($this->getAppClassName($appName));
                if (class_exists($this->getAppClassName($appName)))
                   return $this->setAppName($appName)->actionStep($i+1);
            }
            return $this->setAppDir($this->makeDirPath($i-2))->appStep($i-1);
        }
    }
    
    /**
     * Определим какое действие будем выполнять в приложении
     *
     * @param int $i
     * @return mixed
     */
    private function actionStep($i)
    {
        if ($i > $this->iMax)
            return $this->setAppAction(self::APP_DEFAULT_ACTION)->paramsStep($i);
        
        $action = $this->urlParts[$i];
        
        $reflection = new ReflectionClass($this->getAppClassName($this->appName));
        if (!method_exists($reflection->getName(), $action.self::APP_ACTION_POSTFIX))
            $this->setAppAction(self::APP_DEFAULT_ACTION)->paramsStep($i);
        else
        	$this->setAppAction($action)->paramsStep($i+1);  
    }
    
    /**
     * Определим какие параметры будем передавать в приложение
     *
     * @param int $i
     * @return mixed
     */
    private function paramsStep($i)
    {
        if ($i > $this->iMax)
            return $this->setAppParams(array());
        
        $params = array_slice($this->urlParts, $i);
        $this->setAppParams($params);
    }
    
    /**
     * Возвращает путь к папке
     *
     * @param int $i
     * @return string
     */
    private function makeDirPath($i)
    {
        $str = implode('/', array_slice($this->urlParts, 0, $i+1));
    	return $this->rootDir.((!empty($str))?'/':'').$str;
    }
    
    /**
     * Возвращает имя папки
     *
     * @param int $i
     * @return string
     */
    private function makeDirName($i)
    {
        if ($i < 0)
            return self::APP_DEFAULT_CLASSNAME;
        if ($i > $this->iMax)
            return $this->urlParts[$this->iMax];
            
        return $this->urlParts[$i];
    }
    
    /**
     * Подключает класс приложения
     *
     * @return object
     */
    private function loadAppClass()
    {
    	require_once $this->appDir.'/'.$this->appName.self::APP_FILE_POSTFIX;
    	return $this;
    }
    
    /**
     * Вернуть имя класса
     */
    private function getAppClassName($name)
    {
    	$remains = explode('/', str_replace($this->rootDir, '', $this->appDir));
    	$cleaned_remains = array();
        foreach ($remains as $part)
        {
        	if (!empty($part))
        	    $cleaned_remains[] = strtoupper($part{0}).substr($part, 1);
        }
        $middle = join('_', $cleaned_remains);
    	return self::APP_CLASSNAME_PREFIX.((!empty($middle))?$middle.'_':'').$name;
    }

    /**
     * Запускает приложение
     *
     * @return object
     */
    function initApp()
    {//dump($this->getAppClassName($this->appName), $this->appName);
    	$class = $this->getAppClassName($this->appName);
    	//$action = $class.'_'.strtoupper($this->appAction{0}).substr($this->appAction, 1);
    	$this->app = new $class;
    	//if ($this->User_isAllowedTo($action))
            $this->app->{$this->appAction.self::APP_ACTION_POSTFIX}($this->appParams);
        //else
        //    $this->app->setPage403();
        
        return $this;
    }
}