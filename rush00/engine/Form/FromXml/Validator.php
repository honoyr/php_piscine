<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Валидатор формы
 *
 * Функции валидации имеют вид Form_FromXml_Validator::<name>Checker()
 * Вы также можете переопределить функцию валидации для конкретного поля, 
 * добавив ее в соответствующий класс поля (потомок Form_FromXml_Field)
 * @author dandelion <web.dandelion@gmail.com>
 * @package Form_FromXml
 */
class Form_FromXml_Validator extends Object
{
    protected $form;
    
    function __construct(Form_FromXml $form)
    {
        $this->form = $form;
    }
    
    /**
     * Return result of validation.
     * 
     * @throw FormException
     * @return bool
     */
    public function isValid()
    {
        return $this->validate();
    }
    
    /**
     * Провести валидацию формы
     *
     * @return bool
     */
    private function validate()
    {
    	$isValid = null;
    	foreach ($this->form->data->field as $field)
        {
        	foreach ($field->property as $property)
            {
                $propertyArray = (array)$property;
                $fieldName = (string)$field['name'];
            	list($name, $value) = each($propertyArray['@attributes']);
            	if (!$this->form->fields[$fieldName]->{$name.'Checker'}($value, $this->form->formArray[$fieldName], $field))
            	{
            	    if (!isset($property->error))
                        $property->addChild('error', 'Error!');
                    $property->error->addAttribute('show', '1');
                    $isValid = false;
                    
                    if ($this->form->addErrorToAttr)
                    {
                    	if (!isset($field['error']))
                    	    $field->addAttribute('error', $property->error);
                    	else
                    	    $field['error'] = $field['error'].PHP_EOL.$property->error;
                    }
            	}
            }
        }
        return (is_null($isValid)) ? true : $isValid;
    }
    
    /**
     * Checker.
     * Check min length of string types.
     * @return bool
     */
    function minlengthChecker($param, $toCheck, $field)
    {
        return !(strlen($toCheck) < $param);
    }
    
    /**
     * Checker.
     * Check max length of string types.
     * @return bool
     */
    function maxlengthChecker($param, $toCheck, $field)
    {
        return !(strlen($toCheck) > $param);
    }
    
    /**
     * Checker.
     * Check if value is not null.
     * @return bool
     */
    function notnullChecker($param, $toCheck, $field)
    {
        if (!$param) return true;
        return ($toCheck !== '');
    }
    
    /**
     * Checker.
     * Check using regular expressions.
     * @return bool
     */
    function regexpChecker($param, $toCheck, $field)
    {
        return preg_match($param, $toCheck);
    }
    
    /**
     * Checker.
     * Check captcha code.
     * @return bool
     */
    function captchaChecker($param, $toCheck, $field)
    {
        if (!$param || empty($toCheck)) return true;
        $captcha = new Captcha;
        return $captcha->check($toCheck);
    }
    
    /**
     * Checker.
     * Check using callback function.
     * Might to be static function of some class or just a function.
     * @return bool
     */
    function callbackChecker($param, $toCheck, $field)
    {
        if (!$param) return true;
        if (strpos($param, '::'))
            $param = explode('::', $param);
        return call_user_func($param, $toCheck);
    }
    
    /**
     * Checker.
     * Check if value from select or radio is contained in initial options.
     * Protect against changing initial form state.
     * @return bool
     */
    function listsafeChecker($param, $toCheck, $field)
    {
    	if (!$param || empty($toCheck)) return true;
        $options = array();
        
        foreach ($field->option as $option)
            $options[] = (string)$option['value'];
            
        return in_array($toCheck, $options);
    }
    
    /**
     * Checker.
     * Check if file is attached.
     * @return bool
     */
    function filenotnullChecker($param, $toCheck, $field)
    {
        $name = $toCheck['name'];
        return !empty($name);
    }
    
    /**
     * Checker.
     * Check if file has only allowed extensions.
     * @return bool
     */
    function extensionsChecker($param, $toCheck, $field)
    {
        if (!$this->isloadedChecker($param, $toCheck, $field) 
            || !$this->filenotnullChecker($param, $toCheck, $field)) return true;
        
        $mimes = include(DIR_CONFIG.'/mimes.php');
        $mime = $toCheck['type'];
        
        $extensions = explode('|', $param);
        $allowedMimes = array();
        foreach ($extensions as $extension)
            if (array_key_exists($extension, $mimes))
                $allowedMimes = array_merge($allowedMimes, (array)$mimes[$extension]);
        
        return in_array($mime, $allowedMimes);
    }
    
    /**
     * Checker.
     * Check max file size.
     * @return bool
     */
    function maxfilesizeChecker($param, $toCheck, $field)
    {
        if (!$this->filenotnullChecker($param, $toCheck, $field)) return true;
        if ($toCheck['error'] == 2) return false;
        return !($toCheck['size'] > $param);
    }
    
    /**
     * Checker.
     * Check if file is uploaded and it has no errors during uploading.
     * @return bool
     */
    function isloadedChecker($param, $toCheck, $field)
    {
        if (!$this->filenotnullChecker($param, $toCheck, $field)) return true;
        if (!is_uploaded_file($toCheck['tmp_name'])) return false;
        if ($toCheck['error'] == 0) return true;
        return false;
    }
    
    function urlChecker($param, $toCheck, $field)
    {
        if (strtoupper((string)$this->form->data['method']) == 'POST')
    	    unset($_POST[(string)$field['name']]);
    	else
    	    unset($_GET[(string)$field['name']]);
    	return true;
    }
}