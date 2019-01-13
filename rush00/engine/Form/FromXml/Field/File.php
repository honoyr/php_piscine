<?php

/**
 * File field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_File
 */
class Form_FromXml_Field_File extends Form_FromXml_Field
{
    protected $isSubmitVisible = false;
    protected $possibleProperties = array(
        'filenotnull',
        'extensions',
        'maxfilesize',
        'isloaded',
        'isimage'
    );
	
	function isSubmit()
    {
    	return null;
    }
    
    function build()
    {
    	$this->preBuild();
    	$attributes = array(
            'type'      => 'file'
        );
        $this->setAttributes($attributes);
        if (isset($this->properties['maxfilesize']))
        {
            $this->tpl->assignBlockVars('maxfilesize', array(
                'SIZE' => @$this->properties['maxfilesize']
            ));
        }
    }
    
    function handle($tpl, $block)
    {
        $this->properties = $this->getProperties();
        if (isset($this->properties['maxfilesize']))
            $tpl->assignBlockVars($block.'.'.$this->name.'.maxfilesize', array(
                'SIZE' => @$this->properties['maxfilesize']
            ));
    }
    
    function getValue()
    {
        return array($this->name => $this->form->formArray[$this->name]);
    }
    
    function isimageChecker($param, $toCheck, $field)
    {
        if (!$this->isloadedChecker(1, $toCheck, $field) 
            || !$this->filenotnullChecker(1, $toCheck, $field)) return true;
    	$result = @getimagesize($toCheck['tmp_name']);
    	return (bool)(($param) ? $result : !$result);
    }
    
    function isvideoChecker($param, $toCheck, $field)
    {
        if (!$this->isloadedChecker(1, $toCheck, $field) 
            || !$this->filenotnullChecker(1, $toCheck, $field)) return true;
        $ffmpeg = @new ffmpeg_movie($toCheck['tmp_name']);
        $result = $ffmpeg;
        if ($result)
        {
        	// pervert, but most reliable way I've ever know
        	$isImage = $this->isimageChecker(1, $toCheck, $field);
            $isAudio = $this->isaudioChecker(1, $toCheck, $field);
        	$result = ($result && !$isImage && !$isAudio);
        }
        return (bool)(($param) ? $result : !$result);
    }
    
    function isaudioChecker($param, $toCheck, $field)
    {
        if (!$this->isloadedChecker(1, $toCheck, $field) 
            || !$this->filenotnullChecker(1, $toCheck, $field)) return true;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $result = preg_match('@^audio\/@i', finfo_file($finfo, $toCheck['tmp_name']));
        finfo_close($finfo);
        return (bool)(($param) ? $result : !$result);
    }
}