<?php

/**
 * Абстрактный класс поля формы
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 */
abstract class Form_FromXml_Field extends Object
{
    protected $form;
	protected $field;
	protected $name;
	protected $type;
	protected $properties;
	
	protected $tpl;
    
    abstract function build();
    abstract function handle($tpl, $block);
    abstract function isSubmit();

    function __construct($form, $field)
    {
    	$this->form = $form;
        $this->field = $field;
        $this->name = str_replace('[]','',(string)$field['name']);
        $this->type = (string)$field['type'];
    }
    
    function __call($name, array $args)
    {
    	if (strpos($name, 'Checker') && method_exists($this->form->validator, $name))
    	{
    		if (in_array(str_replace('Checker','',$name), $this->possibleProperties))
    		    return call_user_func_array(array($this->form->validator, $name), $args);
    		else
    		    throw new Exception('Метод валидации '.$name.'() нельзя применить к полю типа '.$this->type);
    	}
    	return parent::__call($name, $args);
    }
    
	function isFieldSubmit()
    {
        if ($this->isSubmitVisible)
        {
        	return $this->isSubmit();
        }
        else return true;
    }
    
    function getValue()
    {
        return array($this->name => stripSlashesExtra($this->form->formArray[$this->name]));
    }
    
    protected function getProperties()
    {
    	$properties = array();
    	foreach ($this->field->property as $property)
    	{
    		$property = (array)$property;
    		$properties = array_merge($properties, $property["@attributes"]);
    	}
    	return $properties;
    }
    
    protected function preBuild()
    {
    	$this->tpl->setFile($this->form->options['template']['dir'].'/'.$this->form->options['template']['field'][$this->type]);
        $this->properties = $this->getProperties();
    }
    
    protected function setAttributes(array $attributes)
    {
    	foreach ($attributes as $name => $value)
        {
            if (empty($name) || empty($value))
                continue;
            $this->tpl->assignBlockVars('attr', array(
                'NAME'  => $name,
                'VALUE' => $value
            ));
        }
        return $this;
    }
}

function stripSlashesExtra($handle){return is_array($handle)?array_map('stripSlashesExtra',$handle):stripslashes($handle);}