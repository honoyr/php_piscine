<?php

/**
 * Radio field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Radio
 */
class Form_FromXml_Field_Radio extends Form_FromXml_Field
{
    protected $isSubmitVisible = false;
    protected $possibleProperties = array(
        'callback',
        'notnull',
        'listsafe'
    );
	
	function isSubmit()
    {
    	return null;
    }
    
    function build()
    {
    	$this->preBuild();
    	$attributes = array(
            'type'  => 'radio'
        );
        $this->setAttributes($attributes);
        $this->handleOptions($this->tpl);
    }
    
    function handle($tpl, $block)
    {
        $tpl->appendBlockVars($block.'.'.$this->name, array(
            'VALUE' => (string)@$this->field['value']
        ));
        $this->handleOptions($tpl, $block.'.'.$this->name.'.');
    }
    
    function handleOptions($tpl, $block = '')
    {
        foreach ($this->field->option as $option)
        {
            $tpl->assignBlockVars($block.'radio', array(
                'TITLE' => (string)@$option['title'],
                'VALUE' => (string)@$option['value']
            ));
        }
    }
}