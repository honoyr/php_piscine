#!/usr/bin/php
<?php
    while (1)
    {
        echo "Enter a number: ";
        $n = trim(fgets(STDIN));
        if (feof(STDIN))
        {
            echo "\n";
            exit;
        }
        if (is_numeric($n)) {
            echo "The number $n ";
        if  (fmod($n, 2))
            echo "is odd", PHP_EOL;
        else
            echo "is even", PHP_EOL;
        } else {
            echo var_export($n, true) . " is not a number", PHP_EOL;
        }
    }
?>