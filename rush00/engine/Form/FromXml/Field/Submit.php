<?php

/**
 * Submit field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Submit
 */
class Form_FromXml_Field_Submit extends Form_FromXml_Field
{
    protected $isSubmitVisible = false;
    protected $possibleProperties = array();
	
	function isSubmit()
    {
    	return isset($this->form->formArray[$this->name]);
    }
    
    function build()
    {
    	$this->preBuild();
    	$attributes = array(
    	    'type'    => 'submit',
            'value'   => (string)@$this->field['value']
        );
        $this->setAttributes($attributes);
    }
    
    function handle($tpl, $block)
    {
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'VALUE' => (string)@$this->field['value']
        ));
    }
    
    function getValue()
    {
    	return null;
    }
}