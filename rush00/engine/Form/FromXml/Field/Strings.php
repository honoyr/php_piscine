<?php

/**
 * Strings field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Strings
 * FIXME не работает field strings
 */
class Form_FromXml_Field_Strings extends Form_FromXml_Field
{
    protected $isSubmitVisible = false;
    protected $possibleProperties = array(
        'notnull', 'callback'
    );
	
	function isSubmit()
    {
    	return null;
    }
    
    function build()
    {
    	$this->preBuild();
    	$key1 = (string)$this->field->options['array1'];
        $key2 = (string)$this->field->options['array2'];
    	$this->tpl->assignVars(array(
    	    'NAME'  => $this->name,
            'NAME1' => $key1,
            'NAME2' => $key2
        ));
	    $values1 = (array)@$_POST[$key1];
	    $values2 = (array)@$_POST[$key2];
	    ksort($values1); ksort($values2); 
        foreach ($values1 as $i => $value1)
        {
            $this->tpl->assignBlockVars('array', array(
                'VALUE1' => $value1,
                'VALUE2' => @$values2[$i]
            ));
        }
    }
    
    function handle($tpl, $block)
    {
        $this->properties = $this->getProperties();
        $this->handleOptions($tpl, $block.'.'.$this->name.'.');
    }
    
    function getValue()
    {
    	$name1 = (string)$this->field->options['array1'];
    	$name2 = (string)$this->field->options['array2'];
    	return array($this->name => $this->form->formArray[$this->name]);
    }
    
    function handleOptions($tpl, $block = '')
    {
        foreach ($this->field->option as $option)
        {
            $tpl->assignBlockVars($block.'array', array(
                'VALUE' => (string)@$option['value']
            ));
        }
    }
}