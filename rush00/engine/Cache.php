<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Кеширование
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Cache
 */
class Cache extends Object implements iSingleton
{
    private static $instance;
    
	protected $cache;
    public static $stats = array(
	    'time'      => 0,
	    'count'     => 0,
	    'count_get' => 0,
	    'count_set' => 0,
	);
	
	public $cleanStick = array();
	
	function __construct()
	{
		if (!CACHE_USE) return false;
		
		if (CACHE_TYPE == 'file') 
		{
            $cache = new Zend_Cache_Backend_File(
                array(
                    'cache_dir' => DIR_CACHE,
                    'file_name_prefix'  => CACHE_PREFIX,
                    'read_control_type' => 'adler32',
                    'read_control' => true,
                    'file_locking' => true,
                )
            );
        } 
        elseif (CACHE_TYPE == 'memory') 
        {
            $cache = new Zend_Cache_Backend_Memcached(
                array(
                    'servers' => array(
                        'host' => 'localhost',
                        'port' => 11211,
                        'persistent' => true
                        ),
                    'compression' => false,
                )
            );
        } 
        else throw new Exception("Неверный тип кеширования: ".CACHE_TYPE.". Доступны: file, memory");
        
        $cache->setDirectives(array('lifetime' => null));
        
        /**
         * Обертки для работы с тегами и для профилирования
         */
        $this->cache = new Dklab_Cache_Backend_TagEmuWrapper(
            new Dklab_Cache_Backend_Profiler($cache, array($this, '_stats'))
        );
        
        /**
         * Автоматическая очистка устаревшего кеша
         */
	    if (rand(1,500)==333)          
            $this->cleanOld();
	}
    
    private function __clone() {}
    
    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }
	
	/**
	 * Получить значение из кеша
	 * 
	 * @return mixed
	 */
	public function get($name)
	{
		if (!CACHE_USE) return false;
		$hash = sha1($name);
		return $this->cache->load($hash);
	}
	
	/**
	 * Записать значение в кеш
	 * 
	 * @param mixed $data
	 * @param string $name
	 * @param array $tags
	 * @param int $lifetime
	 * @return bool
	 */
	public function set($data, $name, $tags = array(), $lifetime = false)
	{
		if (!CACHE_USE) return false;
		$hash = sha1($name);
		return $this->cache->save($data, $hash, $tags, $lifetime);
	}
	
	/**
	 * Удалить значение из кеша
	 * 
     * @param string $name
     * @return bool
	 */
    public function delete($name)
    {
        if (!CACHE_USE) return false;
        $hash = sha1($name);
        return $this->cache->remove($hash);
    }
    
    /**
     * Очистить весь кеш
     * 
     * @return bool
     */
	public function cleanAll()
	{
		if (!CACHE_USE) return false;
		return $this->cache->clean(Zend_Cache::CLEANING_MODE_ALL);
	}
	
	/**
	 * Очистить кеш по тегам
	 * 
	 * @param array $tags
	 * @return bool
	 */
    public function clean($tags = array())
    {
        if (!CACHE_USE) return false;
        $tags = array_merge($tags, $this->cleanStick);
        return $this->cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, $tags);
    }
    
    /**
     * Очистить устаревший кеш
     * 
     * @return bool
     */
    public function cleanOld()
    {
        if (!CACHE_USE) return false;
        return $this->cache->clean(Zend_Cache::CLEANING_MODE_OLD);
    }
	
    /**
     * Расчет статистики использования кеша
     * 
     * @param int $time
     * @param string $method
     * @see Dklab_Cache_Backend_Profiler
     */
	static function _stats($time, $method)
	{
	    self::$stats['time'] += $time;
        self::$stats['count']++;   
        if ($method == 'Dklab_Cache_Backend_Profiler::load')
            self::$stats['count_get']++;
        if ($method == 'Dklab_Cache_Backend_Profiler::save')
            self::$stats['count_set']++;
	}
}