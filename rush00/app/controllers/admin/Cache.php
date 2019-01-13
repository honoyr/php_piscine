<?php
/**
 * Cache
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Cache
 */
class App_Admin_Cache extends Controller
{
	private $dirs = array(DIR_CACHE);

	function init()
    {
        if ($this->User_getRole() !== 'admin')
            $this->Url_redirectTo403();

        $this->dirs = array_merge($this->dirs, array(
            DIR_SCRIPTS.'/mix',
            DIR_SCRIPTS.'/custom',
            DIR_STYLES.'/mix',
            DIR_STYLES.'/custom'
        ));
    }

	function indexAction(array $params)
    {
    	foreach ($this->dirs as $dir)
    	{
            $this->tpl->assignBlockVars('cache', array(
                'PATH'  => $dir,
                'SIZE'  => $this->model->dir->size($dir, true),
                'FILES' => $this->model->dir->countFiles($dir)
            ));
    	}
    }

    function deleteAction(array $params)
    {
    	$this->cache->cleanAll();
    	foreach ($this->dirs as $dir)
    	    $this->model->dir->clean($dir);
    	$this->Url_redirectTo("admin/cache");
    }

    function refreshAction(array $params)
    {
    	clearstatcache();
    	$this->Url_redirectTo("admin/cache");
    }
}