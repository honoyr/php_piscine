<?php

/**
 * Directory Model
 * 
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Dir extends Model
{
    private $exceptions = array('.', '..', '.htaccess');
	
	protected $dir;
	
	function countFiles($dir = null)
    {
        return count($this->getFiles($dir));
    }
    
    function size($dir = null, $convert = false)
    {
        $size = 0;
    	$files = $this->getFiles($dir);
        foreach ($files as $file)
        {
        	$size += (int)sprintf("%u", filesize($file));
        }
        return ($convert)?$this->formatBytes($size):$size;
    }
    
    function clean($dir = null)
    {
        $files = $this->getFiles($dir);
        foreach ($files as $file)
        {
            unlink($file);
        }
    }
    
    function getFiles($dir = null)
    {
        if (is_null($dir)) $dir = $this->dir;
        if (empty($dir) || !is_dir($dir)) return;
        
        $files = array();
        if ($handle = opendir($dir)) 
        {
            while (false !== ($file = readdir($handle))) 
            { 
                if (!in_array($file, $this->exceptions))
                { 
                    $someObject = $dir.'/'.$file;
                    if (is_dir($someObject))
                        $files = array_merge($files, $this->getFiles($someObject));
                    else
                        $files[] = $someObject;
                } 
            }
            closedir($handle); 
        }
        return $files;
    }
    
    function formatBytes($bytes, $precision = 2) 
    {
	    $units = array('B', 'KB', 'MB', 'GB', 'TB');
	  
	    $bytes = max($bytes, 0);
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	    $pow = min($pow, count($units) - 1);
	  
	    $bytes /= pow(1024, $pow);
	  
	    return round($bytes, $precision) . ' ' . $units[$pow];
	} 
}