#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        if (preg_match('/(\s*)(([Ll]undi)|([M,m]ardi)|([M,m]ercredi)|
        ([J,j]eudi)|([V,v]endredi)|([S,s]amedi)|([D,d]imanche))(\s*)
        ([0-9]{2})(\s*)(([Jj]anvier)|([Ff][ée]vrier)|([Mm]ars)|
        ([Aa]vril)|([Mm]ai)|([Jj]uin)|([Jj]uillet)|([Aa]out)|
        ([Ss]eptembre)|([Oo]ctobre)|([Nn]ovembre)|([Dd][eé]cembre))
        (\s*)([0-9]{4})(\s*)([0-9]{2}:[0-9]{2}:[0-9]{2})(\s*)/', $argv[1]))
        {
            $result = preg_split("/[\s\r\t\n\f]+/", $argv[1]);
            print_r($result);
            $str = implode(" ", $result);
            $str = trim($str);
            print($str) . PHP_EOL;
        }
        else
        {
            print("Wrong Format");
            print($argv[1]);
        }

    }
?>
