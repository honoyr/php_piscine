<?php

if (!defined('VIEW')) 
    die("Hacking attempt");

/**
 * Семантическое представление хранилища данных
 * 
 * @author RoX <web.dandelion@gmail.com>
 * @version 0.3
 * @package Store
 */
class Store extends Object
{
    private $db;
    
    protected $table;
    protected $statement = array();
	
	function __construct() 
    {
        $this->db = Db::factory();
    }
    
    function entity($results)
    {
    	return new Entity($results);
    }
    
    /**
     * Выборка одной ячейки 
     *
     * @param string $key
     * @return string
     */
    public function findCell($key)
    {
        $query = "SELECT value FROM ?_".$this->table.$this->_prepare();
        if (isset($this->statement[0]))
        {
        	$query.= " AND `key`=?";
        }
        else
        {
        	$query.= " WHERE `key`=?";
        }
    	$params = array_merge((array)$query, array($key));
        return call_user_func_array(array($this->db, 'selectCell'), $params);
    }
    
    /**
     * Выборка одной строки
     *
     * @return array
     */
    public function findRow()
    {
    	$params = array("SELECT * FROM ?_".$this->table.$this->_prepare()." ORDER BY id");
        $rows = call_user_func_array(array($this->db, 'select'), $params);
    	list($id, $result) = each($this->_convertRows($rows));
        return $this->entity($result);
    }
    
    /**
     * Выборка одного столбца
     *
     * @param string $key
     * @return array
     */
    public function findCol($key)
    {
        $query = "SELECT value FROM ?_".$this->table.$this->_prepare();
        if (isset($this->statement[0]))
        {
            $query.= " AND `key`=?";
        }
        else
        {
            $query.= " WHERE `key`=?";
        }
        $params = array_merge((array)$query, array($key));
        return call_user_func_array(array($this->db, 'selectCol'), $params);
    }
    
    /**
     * Выборка значений
     *
     * @return array
     */
    public function findAll()
    {
    	$params = array("SELECT * FROM ?_".$this->table.$this->_prepare()." ORDER BY id");
    	$rows = call_user_func_array(array($this->db, 'select'), $params);
        return $this->entity($this->_convertRows($rows));
    }
    
    /**
     * Выборка значений с заданным интервалом
     *
     * @param int $count
     * @param int $start
     * @return array
     */
    public function find($count, $start = 0)
    {
    	$params = array("SELECT * FROM ?_".$this->table.$this->_prepare()." ORDER BY id");
        $rows = call_user_func_array(array($this->db, 'select'), $params);
    	return $this->entity(array_slice($this->_convertRows($rows), $start, $count, true));
    }
    
    /**
     * Заявка на проверку равенства
     *
     * @param string $key
     * @param mixed $value 
     * @return object
     */
    public function where($key, $value)
    {
        if ($key == 'id' && !is_null($value))
        {
            $this->statement[] = array('string' => "`id` = ?d", 'values' => (array)$value);
            return $this;
        }
    	return $this->_statementHandler($key, $value, '=');
    }
    
    /**
     * Заявка на проверку подобия
     *
     * @param string $key
     * @param mixed $value 
     * @return object
     */
    public function like($key, $value)
    {
    	return $this->_statementHandler($key, $value, 'LIKE');
    }
    
    /**
     * Заявка на проверку не подобия
     *
     * @param string $key
     * @param mixed $value 
     * @return object
     */
    public function notLike($key, $value)
    {
        return $this->_statementHandler($key, $value, 'NOT LIKE');
    }
    
    /**
     * Вставка значений.
     * При наличии идентификатора произойдет обновление имеющихся значений.
     * Третий параметр характеризует добавление значений, независимо от того,
     * есть они там или нет. При выборке в этом случае вернется массив значений.
     *
     * @param array $values
     * @param int $id
     * @param bool $add
     * @return bool
     */
    public function insert($values, $id = null, $add = false)
    {
        if (null === $id)
            $id = $this->db->selectCell("SELECT MAX(id) FROM ?_".$this->table) + 1;
        foreach ($values as $key=>$value)
        {
            if (!is_null($value) && !empty($key))
            {
                $update = (!$add && $this->db->query("SELECT `value` FROM ?_".$this->table." WHERE `id`=? AND `key`=?", $id, $key)) ? true : false;
                foreach ((array)$value as $v)
                {
                    if ($update)
                        $this->db->query("UPDATE ?_".$this->table." SET `value`=? WHERE `id`=? AND `key`=? LIMIT 1", $v, $id, $key);
                    else
                        $this->db->query("INSERT INTO ?_".$this->table." VALUES (?, ?, ?)", $id, $key, $v);
                }
            }
        }
        return $id;
    }
    
    /**
     * Удалить значения
     *
     * @return mixed
     */
    public function delete()
    {
        $params = array("DELETE FROM ?_".$this->table.$this->_prepare());
        return call_user_func_array(array($this->db, 'query'), $params);
    }
    
    /**
     * Сортировка значений. Меняет ключи ассоциативного массива на те, 
     * по которым идет сортировка.
     * 
     * @param array $results
     * @param string $key
     */
    public function sort(&$results, $key, $direction = 'ASC')
    {
    	$output = array();
        $output_snd = array();
        $i = array();
        foreach ($results as $result)
        {
            if (isset($result->$key) && !array_key_exists($result->$key, $output))
                $output[(string)$result->$key] = $result;
            else
            {
            	if (!isset($i[$result->$key]))
            	    $i[$result->$key] = 0;
            	$i[$result->$key]++;
            	$output[$result->$key.'-'.$i[$result->$key]] = $result;
            	//$output_snd[] = $result;
            }
        }
        if ($direction == 'DESC') krsort($output);
        else ksort($output);
        //$output = array_merge($output, $output_snd);
        $results = $this->entity($output);
    }
    
    /**
     * Рекурсивно проверяем условия where
     *
     * @param int $i Итератор
     * @return string
     */
    private function _recExecCond($i)
    {
    	$query = "SELECT DISTINCT id FROM ?_".$this->table." 
    	          WHERE ";
    	if (isset($this->statement[$i+1]))
    	{
    		$query.= $this->_recExecCond($i+1);
    	}
    	$query.= $this->statement[$i]['string'];
    	$ids = call_user_func_array(array($this->db, 'selectCol'), array_merge(array($query),$this->statement[$i]['values']));
    	return (!empty($ids)) ? "id IN (".join(',',$ids).") AND "
    	                      : "1=0 AND ";
    }
    
    /**
     * Обработчик проверок равенства и подобия
     *
     * @param string $key
     * @param mixed $value
     * @param string $different
     * @return object
     */
    private function _statementHandler($key, $value, $different)
    {
        if (empty($key) || is_null($value)) return $this;
        
        $statement = "`key`=? AND ";
        if (is_array($value))
        {
            $pairs = array();
            for ($i=1;$i<=count($value);$i++)
                $pairs[] = "`value` ".$different." ?";
            $statement.= '('.join(' OR ', $pairs).')';
        }
        else
        {
            if ($key == 'id')
                $statement.= "`id` ".$different." ?";
        	$statement.= "`value` ".$different." ?";
        }
        
        $this->statement[] = array('string' => $statement, 'values' => array_merge((array)$key, (array)$value));
        return $this;
    }
    
    /**
     * Подготовить запрос для финальной выборки
     *
     * @return string
     */
    private function _prepare()
    {
        $query = '';
        if (isset($this->statement[0]))
        {
            $query.= " WHERE ".$this->_recExecCond(0)." 1=1";
        }
        return $query;
    }
    
    /**
     * Конвертировать выходной поток данных в удобный вид.
     *
     * @param array $rows
     * @return array
     */
    private function _convertRows($rows)
    {
    	$output = array();
    	foreach ((array)$rows as $row)
        {
        	extract($row);
        	if (!isset($output[$id]))
                $output[$id] = array('id' => $id);
            if (strpos($key, '|'))
            {
            	$subkeys = explode('|', $key);
            	$suboutput =& $output[$id];
                foreach ($subkeys as $subkey)
                {
	                if ($subkey === '') continue;
	                if (!isset($suboutput[$subkey]) || !is_array($suboutput[$subkey]))
	                    $suboutput[$subkey] = array();
	                $suboutput =& $suboutput[$subkey];
                }
                $suboutput = $value;
            }
            elseif (isset($output[$id][$key]))
            {
                if (!is_array($output[$id][$key]))
                    $output[$id][$key] = array($output[$id][$key]);
                $output[$id][$key][] = $value;
            }
            else $output[$id][$key] = $value;
        }
        return $output;
    }
}