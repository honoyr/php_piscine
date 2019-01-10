#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $result = preg_split("/[\s\r\t\n\f]+/", $argv[1]);
        array_push($result, $result[0]);
        array_shift($result);
        $str = implode(" ", $result);
        $str = trim($str);
        print($str) . PHP_EOL;
    }
?>