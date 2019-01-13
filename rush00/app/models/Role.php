<?php

/**
 * Role Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Role extends Model
{
    private $table = 'roles';
	
	function getAll()
	{
		$store = new Store;
        $store->setTable($this->table);
        return $store->findAll();
	}
	
    function get($role)
    {
        $store = new Store;
        $store->setTable($this->table);
        return $store->where('role', $role)->findRow();
    }
    
    function getById($id)
    {
        $store = new Store;
        $store->setTable($this->table);
        return $store->where('id', $id)->findRow();
    }
	
	function add($data, $id = null)
	{
		$dataToInsert = array(
            'role' => @$data['role']
        );
        $this->cache->clean(array('roles'));
        return $this->Store_setTable($this->table)->insert($dataToInsert, $id);
	}
	
    function delete($id) 
    {
        $this->cache->clean(array('roles'));
        return $this->Store_setTable($this->table)->where('id',$id)->delete();
    }
    
    function alterActions($id, array $actions)
    {
    	$store = new Store;
        $store->setTable($this->table);
        $this->db->query('DELETE FROM ?_'.$this->table.' WHERE id=? AND `key`=?', $id, 'action');
        $store->insert(array('action' => $actions), $id, true);
    }
	
	function parseActions($file)
	{
	    $actions = array();
		$class = substr($file, strlen(DIR_CONTROLLERS));
        $code = file_get_contents($file);
        if (preg_match('@class (?P<class>[0-9a-z_]+)@i', $code, $matches))
        {
            $class = $matches['class'];
            if (preg_match_all('@function (?P<action>[0-9a-z]+)Action@i', $code, $matches))
            {
                foreach ($matches['action'] as $action)
                    $actions[] = $class.'_'.strtoupper($action{0}).substr($action, 1);
            }
        }
        return $actions;
	}
	
    static function checkIfRoleExists($name)
    {
        if (empty($name)) return true;
        $store = new Store;
        return $store->setTable('roles')->where('role', $name)->findRow()->isEmpty(); 
    }
}