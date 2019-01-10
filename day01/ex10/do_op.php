#!/usr/bin/php
<?php
if ($argc > 1 && $argc < 5)
{
    $result = 0;
    for ($n = 1; $n < $argc; $n++)
    {
        $arr = preg_split("/[\s\r\t\n\f]+/", $argv[$n]);
        $result == 0 ? ($result = $arr) : ($result = array_merge($result, $arr));
    }
    // print($result[1]) . PHP_EOL;
    if (!strcmp($result[1], "+"))
        print((intval($result[0]) + intval($result[2]))) . PHP_EOL;
    if (!strcmp($result[1], "*"))
        print((intval($result[0]) * intval($result[2]))) . PHP_EOL;
    if (!strcmp($result[1], "%"))
        print(fmod(intval($result[0]), intval($result[2]))) . PHP_EOL;
}
else
    print("Incorrect Parameters") . PHP_EOL;
?>