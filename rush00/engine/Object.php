<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Высший класс в иерархии наследования.
 * Предполагается наследование его всеми классами системы.
 * 
 * @author dandelion <web.dandelion@gmail.com>
 * @package Object
 */
abstract class Object
{
    /**
     * Перехватывает обращения к несуществующим методам.
     * Используется для реализации на верхнем уровне таких фич, как:
     * - установка свойства класса, например $this->setVar(123) запишет 
     *   значение 123 в $this->var;
     * - получение свойства класса, например $this->getVar() вернет 
     *   значение $this->var;
     * - метод $this->Class_Method()
     * - ...
     * 
     * @param string $name Имя метода
     * @param array $args Аргументы
     * @return mixed
     */
    public function __call($name, array $args)
    {
        /**
         * Реализация методов, начинающихся на set, get
         */
        if (strlen($name) > 3) 
        {
            $paramName = strtolower($name{3}).substr($name, 4);
            switch (substr($name, 0, 3)) 
            {
                case 'get':
                    return $this->_getParam($paramName);
                case 'set':
                    if (empty($args))
                        throw new oneMoreException('Не указано значение для присваивания параметру '.$paramName);
                    return $this->_setParam($paramName, $args[0]);
            }
        }
        
        /**
         * Реализация методов вида $this->Class_Method()
         */
        if (strpos($name, '_'))
        {
            $aName = explode("_", $name);
            $class = $aName[0];
            $method = $aName[1];
            if (class_exists($class))
            {
            	if (in_array('iSingleton', class_implements($class)))
                    $obj = call_user_func(array($class, 'getInstance'));
                else
            	    $obj = new $class;  
                return call_user_func_array(array($obj, $method), $args);   
            }
        }
        
        throw new Exception('Вызван отсутствующий метод класса '.__CLASS__.'::'.$name.'()');
    }

    /**
     * Установка значения в переменную класса
     * 
     * @param string $name Имя переменной
     * @param mixed $value Значение
     * @return resource
     */
    final private function _setParam($name, $value)
    {
        $this->$name = $value;
        return $this;
    }
    
    /**
     * Получение значения переменной класса
     * 
     * @param string $name Имя переменной
     * @return mixed
     */
    final private function _getParam($name)
    {
        return (isset($this->$name)) ? $this->$name : null;
    }
}