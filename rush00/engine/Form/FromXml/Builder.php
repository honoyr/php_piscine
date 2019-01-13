<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Строитель форм
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * 
 * TODO: разобраться с кодировкой... simplexml_string может заменить на domdocument
 */
class Form_FromXml_Builder extends Object
{
    protected $form;
    
    function __construct(Form_FromXml $form)
    {
        $this->form = $form;
    }
	
    public function build()
    {
    	$main_tpl = Template::factory();
    	$main_tpl->setFile($this->form->options['template']['dir'].'/'.$this->form->options['template']['form']);
    	foreach ($this->form->data->field as $field)
        {
        	$tpl = Template::factory();
        	$this->form->fields[(string)$field['name']]->setTpl($tpl)->build();
        	
	        $errors = array();
	        foreach ($field->property as $property)
	        {
	            if (isset($property->error['show']) && $property->error['show'])
	                $errors[] = (string)$property->error;
	        }
        	if (empty($errors))
                $tpl->assignBlockVars('noerror');
            else
            {
                $tpl->assignBlockVars('error');
                foreach ($errors as $error)
                    $tpl->assignBlockVars('error.messages', array('ENTRY' => $error));
            }
	        $tpl->assignVars(array(
                'TITLE'       => @$field['title'],
                'DESCRIPTION' => @$field['description']
            ));
            $aField = (array)$field;
            $attributes = $aField['@attributes'];
	        foreach ($attributes as $name => $value)
	        {
	            if (in_array(strtolower($name), array('type', 'title', 'description', 'value'))) 
	                continue;
	            $tpl->assignBlockVars('attr', array(
	                'NAME'  => $name,
	                'VALUE' => $value
	            ));
	        }
            $main_tpl->assignBlockVars('field', array('ENTRY' => $tpl->compile()->getOutput()));
            
            /**
             * Проверить, есть ли в форме поле загрузки файла.
             */
            if ((string)$field['type'] == 'file')
                $fileExists = true;
                
            unset($attributes, $tpl, $aField);
        }
        $aForm = (array)$this->form->data;
        $attributes = $aForm['@attributes'];
        $attributes['enctype'] = (isset($fileExists) && $fileExists) ? 'multipart/form-data' : null;
        foreach ($attributes as $name => $value)
        {
        	if (empty($name) || empty($value))
                continue;
        	$main_tpl->assignBlockVars('attr', array(
	            'NAME'  => $name,
	            'VALUE' => $value
	        ));
        }
        
        return $main_tpl->compile()->getOutput();
    }
    
    public function handleTemplate($tpl, $block)
    {
        $tpl->assignBlockVars($block);
        
    	foreach ($this->form->data->field as $field)
        {
            $name = (string)$field['name'];
            
            $tpl->assignBlockVars($block.'.'.$name, array(
                'TITLE'       => (string)@$field['title'],
                'DESCRIPTION' => (string)@$field['description'],
                'NAME'        => (string)@$field['name'],
                'ID'          => (string)@$field['id'],
                'CLASS'       => (string)@$field['class']
            ));
            $this->form->fields[$name]->handle($tpl, $block);
            
            $errors = array();
            foreach ($field->property as $property)
            {
                if (isset($property->error['show']) && $property->error['show'])
                    $errors[] = (string)$property->error;
            }
            if (empty($errors))
                $tpl->assignBlockVars($block.'.'.$name.'.noerror');
            else
            {
                $tpl->assignBlockVars($block.'.'.$name.'.error');
                foreach ($errors as $error)
                    $tpl->assignBlockVars($block.'.'.$name.'.error.messages', array('ENTRY' => $error));
            }
            
            /**
             * Проверить, есть ли в форме поле загрузки файла.
             */
            if ((string)$field['type'] == 'file')
                $fileExists = true;
        }
        
        $tpl->appendBlockVars($block, array(
            'ACTION' => (string)@$this->form->data['action'],
            'METHOD' => strtolower((string)@$this->form->data['method']),
            'ENCTYPE' => (isset($fileExists) && $fileExists) ? ' enctype="multipart/form-data"' : ''
        ));
    }
}