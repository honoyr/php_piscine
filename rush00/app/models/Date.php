<?php
/**
 * Date Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Date extends Model
{
    private $months = array(
        'Январь','Февраль','Март','Апрель','Май','Июнь',
        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'
    );
    private $ofMonths = array(
        'января','февраля','марта','апреля','мая','июня',
        'июля','августа','сентября','октября','ноября','декабря'
    );

    function getMonthText($m)
    {
        return $this->months[(int)--$m];
    }

    function getOfMonthText($m)
    {
        return $this->ofMonths[(int)--$m];
    }
}