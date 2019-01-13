<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * Обработчик форм
 *
 * Позволяет строить и валидировать формы с помощью правил,
 * описанных в XML файле.
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package Form_FromXml
 * FIXME починить поля с name="var[]"
 */
class Form_FromXml extends Object
{
    protected $file;
    protected $string;

    public $data;
    public $fields;

    public $formArray;

    public $builder;
    public $validator;

    protected $submitInvisibleTypes = array('reset', 'file', 'checkbox', 'radio', 'strings');
    public $options;
    public $addErrorToAttr = true;

    private $isValid;
    private $isSubmit;

    function __construct($options = array())
    {
        //$this->options = array_merge(include(DIR_CONFIG.'/ffx.php'), $options);
        ob_start(array('HTML_FormPersister', 'ob_formPersisterHandler'));
    }

    /**
     * Строим форму.
     *
     * @throw FormException
     * @return object
     */
    function build()
    {
        if (empty($this->data))
            throw new Exception("XML data is null.");

        $this->builder = new Form_FromXml_Builder($this);
        return $this->builder->build();
    }

    /**
     * Обрабатываем готовый шаблон формы
     *
     * @param object $tpl
     * @param string $block
     */
    function handleTemplate($tpl, $block)
    {
    	if (empty($this->data))
            throw new Exception("XML data is null.");

        $this->builder = new Form_FromXml_Builder($this);
        return $this->builder->handleTemplate($tpl, $block);
    }

    /**
     * Проводим валидацию полей формы
     *
     * @throw FormException
     * @return bool
     */
    function isValid()
    {
        if (empty($this->data))
            throw new Exception("XML data is null.");

        if (null === $this->isValid)
        {
	        $this->validator = new Form_FromXml_Validator($this);
	        $this->isValid = ($this->isSubmit())
	            ? $this->validator->isValid()
	            : false;
	    }
        return $this->isValid;
    }

	/**
	 * Установить значения формы по умолчанию (всех кроме option).
	 *
	 * @param array $values
	 * handleTemplate($this->tpl, 'form')
	 */
    public function setValues($values = array())
    {
        //if ($this->isSubmit()) return $this;

    	if (strtoupper(@$this->data['method']) == 'POST')
    	    $_POST = array_merge($_POST, $values);
    	else
    	    $_GET = array_merge($_GET, $values);
        return $this;
    }

    /**
     * Установить значения по умолчанию для полей option.
     *
     * @param array $values
     * @return object
     */
    public function setOptions($values = array())
    {
    	foreach ($values as $key => $value)
    	    $GLOBALS[$key] = $value;
        return $this;
    }

    /**
     * Установить значение action для формы
     *
     * @param string $action
     * @return object
     */
    public function setAction($action)
    {
    	$this->data['action'] = $action;
    	return $this;
    }

    /**
     * Обработать правила построения и валидации формы из XML файла.
     * Синоним handleFile().
     *
     * @param string $file
     * @return object
     */
    public function handle($file)
    {
    	return $this->handleFile($file);
    }

    /**
     * Обработать правила построения и валидации формы из XML файла.
     *
     * @param string $file
     * @return object
     */
    public function handleFile($file)
    {
    	$this->data = $this->setFile($file)->getCollection();
    	$this->getFieldsInstances();
    	$this->formArray = $this->getFormArray();
    	return $this;
    }

    /**
     * Обработать правила построения и валидации формы из строки XML.
     *
     * @param string $string
     * @return object
     */
    public function handleString($string)
    {
        $this->data = $this->setString($string)->getCollection('string');
        $this->getFieldsInstances();
        $this->formArray = $this->getFormArray();
        return $this;
    }

    /**
     * Определить, отправлены ли данные формы и отправлены ли они правильно.
     *
     * @return bool
     */
    public function isSubmit()
    {
    	if (null === $this->isSubmit)
    	{
	    	foreach ($this->data->field as $field)
	    	{
	    		if (!$this->fields[(string)$field['name']]->isFieldSubmit())
	    		{
                    //var_dump((string)$field['name']);
	    			$this->isSubmit = false;
	    			return false;
	    		}
	    	}
	    	$this->isSubmit = true;
	    	return true;
    	}
    	else return $this->isSubmit;
    }

    /**
     * Получить коллекцию XML элементов
     *
     * @var string $from file|string
     * @return object
     */
    private function getCollection($from = 'file')
    {
        switch ($from)
        {
        	case 'file':
        		return simplexml_load_file($this->file);
        	case 'string':
        		return simplexml_load_string($this->string);
        	default:
        		break;
        }
    }

    /**
     * Создать экземпляры классов для обработки полей формы
     *
     * @return object
     */
    private function getFieldsInstances()
    {
    	foreach ($this->data->field as $field)
    	{
    		$type = (string)$field['type'];
    		$className = __CLASS__.'_Field_'.strtoupper($type{0}).substr($type, 1);
    		if (class_exists($className))
    		{
    			$this->fields[(string)$field['name']] = new $className($this, $field);
    		}
    		else throw new Exception('Class "'.$className.'" does not exist.');
    	}
    	return $this;
    }

    /**
     * Вернуть массив значений формы
     *
     * @return array
     */
    function getData()
    {
        $values = array();
        foreach ($this->data->field as $field)
        {
            $name = (string)$field['name'];
        	$values = array_merge($values, (array)$this->fields[$name]->getValue());
        }
        return $values;
    }

    function getFormArray()
    {
        $result = array();
    	foreach ($this->data->field as $field)
        {
            $name = (string)$field['name'];
            $type = (string)$field['type'];
            if ($type == 'file')
                $result[$name] = @$_FILES[$name];
            elseif (strtoupper(@$this->data['method']) == 'POST')
                $result[$name] = @$_POST[$name];
            else
                $result[$name] = @$_GET[$name];
        }
    	return $result;
    }

    function renderErrors($tpl, $block = null)
    {
    	$errors = array();
        foreach ($this->data->field as $field)
        {
            $error = (string)$field['error'];
            if (!empty($error))
            {
            	//var_dump($error);
            	if (is_null($block))
                    $tpl->assignBlockVars('error_'.$field['name'], array('MESSAGE' => nl2br($error)));
                else
                    $errors[] = nl2br($error);
            }
        }
        if (!is_null($block) && !empty($errors))
        {
        	$tpl->assignBlockVars('error_'.$block, array('MESSAGE' => join('<br/>',$errors)));
        }
    }
}