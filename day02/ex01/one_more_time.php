#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $result = preg_split("/[\s\r\t\n\f]+/", $argv[1]);
        print_r($result);
        $str = implode(" ", $result);
        $str = trim($str);
        print($str) . PHP_EOL;
    }
?>