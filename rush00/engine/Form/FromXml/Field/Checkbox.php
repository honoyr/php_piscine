<?php

/**
 * Checkbox field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Checkbox
 */
class Form_FromXml_Field_Checkbox extends Form_FromXml_Field
{
    protected $isSubmitVisible = false;
    protected $possibleProperties = array(
        'notnull','callback'
    );
	
	function isSubmit()
    {
    	return null;
    }
    
    function build()
    {
    	$this->preBuild();
    	$attributes = array(
            'type'    => 'checkbox',
            'value'   => (string)@$this->field['value']
        );
        $this->setAttributes($attributes);
    }
    
    function handle($tpl, $block)
    {
        $this->properties = $this->getProperties();
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'VALUE' => (string)@$this->field['value']
        ));
    }
}