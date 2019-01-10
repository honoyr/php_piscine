#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $result = preg_split("/[\s\r\t\n\f]+/", $argv[1]);
        $str = implode(" ", $result);
        $str = trim($str);
        print($str) . PHP_EOL;
    }
?>