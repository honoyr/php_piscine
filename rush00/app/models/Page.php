<?php

/**
 * Page Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Page extends Model
{
    protected $table = 'pages';
    protected $cacheTag = 'page';

	function get($name)
    {
    	$cacheKey = 'page_by_name_'.$name;
        if (false === ($page = $this->cache->get($cacheKey)))
        {
            $page = $this->Store_setTable($this->table)->where('name', $name)->findRow();
            $this->cache->set($page, $cacheKey, array($this->cacheTag));
        }
        return $page;
    }

    function getById($id)
    {
        return $this->Store_setTable($this->table)->where('id', $id)->findRow();
    }

    function getAll()
    {
        if (false === ($pages = $this->cache->get('page_all')))
        {
            $store = $this->Store_setTable($this->table);
	        $pages = $store->findAll();
	        $store->sort($pages, 'name');
            $this->cache->set($pages, 'page_all', array($this->cacheTag));
        }
        return $pages;
    }

    function add($data, $id = null)
    {
    	foreach ($data as $key => $value)
    	{
            $dataToInsert[$key] = $value;
    	}
        $this->cache->clean(array('page'));
        return $this->Store_setTable($this->table)->insert($dataToInsert, $id);
    }

    function edit($data, $id)
    {
    	return $this->add($data, $id);
    }

    function delete($id)
    {
    	$this->cache->clean(array('page'));
        return $this->Store_setTable($this->table)->where('id',$id)->delete();
    }

    static function checkIfPageExists($name)
    {
        if (empty($name)) return true;
        $store = new Store;
        $pageEmpty = $store->setTable('pages')->where('name',$name)->findRow()->isEmpty();
        $fileExists = false;//file_exists(DIR_CONTROLLERS.'/'.strtoupper($name{0}).substr($name,1).EXT_PHP);
        return (bool)($pageEmpty && !$fileExists);
    }
}