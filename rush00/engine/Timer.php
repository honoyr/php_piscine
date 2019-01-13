<?php

/**
 * Таймер
 * 
 * Измеряет промежутки времени. Возможно многократное включение/выключение, 
 * чтобы игнорировать ненужные промежутки.
 * Поддерживается задание ключей для измеряемых промежутков времени, но можно 
 * их и опускать если промежуток времени один.
 * 
 * <code>
 * ...
 * Timer::start('key');
 * somefunc();
 * Timer::finish('key');
 * echo Timer::getPeriod('key');
 * ...
 * </code>
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Timer
 */
class Timer
{
	static $period = array();
	static $timestamp = array();
	
	/**
	 * Количество знаков после запятой
	 */
	const DECIMALS = 3;
	
	private function __construct() {}
	private function __clone() {}
	
	/**
	 * Запустить таймер
	 *
	 * @param string $key
	 */
	static function start($key = '.')
	{
		self::$timestamp[$key] = microtime(true);
	}
	
	/**
     * Остановить таймер
     *
     * @param string $key
     */
	static function finish($key = '.')
	{
		if (!isset(self::$timestamp[$key]))
            return false;
		
		if (!isset(self::$period[$key]))
		    self::$period[$key] = 0;
		    
		self::$period[$key] +=  microtime(true) - self::$timestamp[$key];
		
		unset(self::$timestamp[$key]);
	}
	
	/**
     * Вернуть результат
     *
     * @param string $key
     */
	static function getPeriod($key = '.')
	{
		if (!isset(self::$period[$key]))
		    return null;
		return number_format(self::$period[$key], self::DECIMALS);
	}
}