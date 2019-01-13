<?php

/**
 * Paginator.
 * @author dandelion <web.dandelion@gmail.com>
 * @package Paginator
 */
class Paginator
{
	protected $options = array();
	private $defaults = array(
	   'countPerPage'  => 10,
	   'countOfEntries'=> 0,
	   'currentPage' => 1,
	   'countOfFirstPages'=> 1,
	   'countOfLastPages' => 1,
	   'countOfMiddlePages'=> 2,
	   'block' => 'paginator',
	   'template' => ''
	);
	
	function __construct($options = array()) 
	{
		$options = array_merge($this->defaults, $options);
		$this->setOptions($options);
	}
	
	function setOptions($options)
	{
		$this->options = array_merge($this->options, $options);
		return $this;
	}
	
	function compile()
	{
		extract($this->options);
		$countOfPages = ceil($countOfEntries/$countPerPage);
		/**
		 * Если нет записей или записей всего на одну страницу,
		 * то не будем показывать навигатор
		 */
		if ($countOfPages <= 1)
		    return;
		    
		$template->assignBlockVars($block);
		$middleLeft  = $currentPage - $countOfMiddlePages;
        $middleRight = $currentPage + $countOfMiddlePages;
        /**
         * Первый блок
         */
		if ($middleLeft > 1)
		{
            $start = 1;
			$finish = $countOfFirstPages;
            $difference = $countOfFirstPages - $middleLeft + 1;
			if ($difference > 0)
			{
				$finish-= $difference;
			}
			elseif ($difference < 0)
			{
                $template->assignBlockVars($block.'.separator1');
			}
			for ($i=$start; $i<=$finish; $i++)
			{
				$template->assignBlockVars($block.'.first', array('NUM'=>$i));
			}
		}
	   /**
         * Левый средний блок
         */
        if ($currentPage > 1)
        {
            $start = $middleLeft;
            $finish = $currentPage - 1;
            $difference = 1 - $middleLeft;
            if ($difference > 0)
            {
                $start+= $difference;
            }
            for ($i=$start; $i<=$finish; $i++)
            {
                $template->assignBlockVars($block.'.middle1', array('NUM'=>$i));
            }
        }
		$template->assignBlockVars($block.'.current', array('NUM'=>$currentPage));
        /**
         * Правый средний блок
         */
        if ($currentPage < $countOfPages)
        {
            $start = 1 + $currentPage;
            $finish = $middleRight;
            $difference = $middleRight - $countOfPages;
            if ($difference > 0)
            {
                $finish-= $difference;
            }
            for ($i=$start; $i<=$finish; $i++)
            {
                $template->assignBlockVars($block.'.middle2', array('NUM'=>$i));
            }
        }
        /**
         * Последний блок
         */
        if ($middleRight < $countOfPages)
        {
            $start = 1 + $countOfPages - $countOfLastPages;
            $finish = $countOfPages;
            $difference = $countOfLastPages - ($countOfPages - $middleRight);
            if ($difference > 0)
            {
                $start+= $difference;
            }
            elseif ($difference < 0)
            {
                $template->assignBlockVars($block.'.separator2');
            }
            for ($i=$start; $i<=$finish; $i++)
            {
                $template->assignBlockVars($block.'.last', array('NUM'=>$i));
            }
        }
        return $this;
	}
}