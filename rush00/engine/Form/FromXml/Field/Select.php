<?php

/**
 * Select field
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * @subpackage Field_Select
 */
class Form_FromXml_Field_Select extends Form_FromXml_Field
{
    protected $isSubmitVisible = true;
    protected $possibleProperties = array(
        'callback',
        'notnull',
        'listsafe'
    );
    
    function isSubmit()
    {
        if (isset($this->field["multiple"]) && $this->field["multiple"])
           return true;
        return isset($this->form->formArray[$this->name]);
    }
    
    function build()
    {
        $this->preBuild();
        $this->tpl->assignVars(array(
            'VALUE' => (string)@$this->field['value']
        ));
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
            $tpl->assignBlockVars($block.'option', array(
                'TITLE' => (string)@$option['title'],
                'VALUE' => (string)@$option['value']
            ));
        }
        foreach ($this->field->options as $options)
        {
            $tpl->assignBlockVars($block.'optionArray', array(
                'VAR' => (string)@$options['array']
            ));
        }
    }
    
    function listsafeChecker($param, $toCheck, $field)
    {
        if (!$param) return true;
        $values = array();
        
        foreach ($field->option as $option)
            $values[] = (string)$option['value'];
        foreach ($field->options as $options)
        {
            $varName = str_replace('$','',(string)$options['array']);
            if (array_key_exists($varName, $GLOBALS))
                $values = array_merge($values, $this->recursiveGetValues($GLOBALS[$varName]));
        }
        return in_array($toCheck, $values);
    }
    
    private function recursiveGetValues($array)
    {
        $values = array();
        if (is_array($array))
        {
            $output = array();
            $values = array_keys($array);
            foreach ($values as $toCheck)
                $output = array_merge($output, $this->recursiveGetValues($toCheck));
        }
        else return (array)$array;
        return $output;
    }
}