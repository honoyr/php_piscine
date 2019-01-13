<?php

/**
 * String field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_String
 */
class Form_FromXml_Field_String extends Form_FromXml_Field
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
            'type'      => 'text',
            'default'   => (string)@$this->field['value'],
            'maxlength' => (isset($this->properties['maxlength'])) ? $this->properties['maxlength'] : null
        );
        $this->setAttributes($attributes);
    }
    
    function handle($tpl, $block)
    {
        $this->properties = $this->getProperties();
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'VALUE' => (string)@$this->field['value']
        ));
        if (isset($this->properties['maxlength']))
        {
            $tpl->assignBlockVars($block.'.'.$this->name.'.maxlength', array('NUM' => $this->properties['maxlength']));
        }
    }
}