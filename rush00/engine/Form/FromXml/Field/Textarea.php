<?php

/**
 * Textarea field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Textarea
 */
class Form_FromXml_Field_Textarea extends Form_FromXml_Field
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
    	if ((string)@$this->field['submitinvisible']==1)
    	    return true;
    	else
    	    return isset($this->form->formArray[$this->name]);
    }
    
    function build()
    {
    	$this->preBuild();
        $attributes = array(
            'default'   => (string)@$this->field['value']
        );
        $this->setAttributes($attributes);
        if (@$this->field->editor)
            $this->tpl->assignBlockVars('editor');
    }
    
    function handle($tpl, $block)
    {
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'VALUE' => (string)@$this->field['value']
        ));
    }
}