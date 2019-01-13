<?php

/**
 * Hidden field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Hidden
 */
class Form_FromXml_Field_Hidden extends Form_FromXml_Field
{
    protected $isSubmitVisible = true;
    protected $possibleProperties = array(
        'callback',
        'notnull',
        'minlength',
        'maxlength',
        'regexp'
    );
	
	function isSubmit()
    {
    	return isset($this->form->formArray[$this->name]);
    }
    
    function build()
    {
    	$this->preBuild();
    	$attributes = array(
            'type'      => 'hidden',
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