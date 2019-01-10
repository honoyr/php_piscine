#!/usr/bin/php
<?php
function  ft_is_alpha($str)
{
    $s = ord($str);
    if (($s >= 60 && $s <= 90) || (($s >= 97 && $s <= 122)))
        return true;
    else
        return false;
}

if ($argc > 1)
{
    $result = array();
    $num = array();
    $char = array();
    $other = array();
    for ($n = 1; $n < $argc; $n++)
    {
        $arr = preg_split("/[\s\r\t\n\f]+/", $argv[$n]);
        $result == 0 ? ($result = $arr) : ($result = array_merge($result, $arr));
    }
    $max = sizeof($result);
    for ($n = 0; $n < $max; $n++)
    {
        if (is_numeric($result[$n]))
            $num[] = $result[$n];
        else if (ft_is_alpha($result[$n]))
            $char[] = $result[$n];
        else
            $other[] = $result[$n];
    }
    // $order = SORT_ASC;
    // switch($order)
    // {
    //     case SORT_ASC:
    // }

    // if (is_numeric())

    // sort($char, SORT_STRING);
    natcasesort($char);
    $max = sizeof($char);
    for ($n = 0; $n < $max; $n++)
        echo $char[$n] , PHP_EOL;

    // sort($num, SORT_STRING);
    // $max = sizeof($num);
    // for ($n = 0; $n < $max; $n++)
    //     echo $num[$n] , PHP_EOL;

    // sort($other, SORT_STRING);
    // $max = sizeof($other);
    // for ($n = 0; $n < $max; $n++)
    //     echo $other[$n] , PHP_EOL;
}
?>