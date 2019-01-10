#!/usr/bin/php
<?php
if ($argc > 1)
    for ($n = 1; $n < $argc; $n++)
        echo $argv[$n] , PHP_EOL;
?>