<?php

/**
 * Captcha field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Captcha
 */
class Form_FromXml_Field_Captcha extends Form_FromXml_Field
{
    protected $isSubmitVisible = true;
    protected $possibleProperties = array(
        'callback',
        'notnull',
        'captcha',
        'url'
    );
    
    function isSubmit()
    {
    	return isset($this->form->formArray[$this->name]);
    }
    
    function build()
    {
    	$this->preBuild();
    	$this->tpl->assignVars(array(
            'URL' => @$this->properties['url']
        ));
    }
    
    function handle($tpl, $block)
    {
        $this->properties = $this->getProperties();
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'URL' => @$this->properties['url']
        ));
    }
    
    function getValue()
    {
    	return null;
    }
}