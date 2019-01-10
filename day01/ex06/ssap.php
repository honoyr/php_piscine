#!/usr/bin/php
<?php
if ($argc > 1)
{
    $result = 0;
    for ($n = 1; $n < $argc; $n++)
    {
        $arr = preg_split("/[\s\r\t\n\f]+/", $argv[$n]);
        $result == 0 ? ($result = $arr) : ($result = array_merge($result, $arr));
    }
    sort($result);
    $max = sizeof($result);
    for ($n = 0; $n < $max; $n++)
        echo $result[$n] , PHP_EOL;
}
?>