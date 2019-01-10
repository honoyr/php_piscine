#!/usr/bin/php
<?php
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
        else if (ctype_alpha($result[$n]))
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

    sort($char, SORT_STRING);
    $max = sizeof($char);
    for ($n = 0; $n < $max; $n++)
        echo $char[$n] , PHP_EOL;

    sort($num, SORT_STRING);
    $max = sizeof($num);
    for ($n = 0; $n < $max; $n++)
        echo $num[$n] , PHP_EOL;

    sort($other, SORT_STRING);
    $max = sizeof($other);
    for ($n = 0; $n < $max; $n++)
        echo $other[$n] , PHP_EOL;
}
?>