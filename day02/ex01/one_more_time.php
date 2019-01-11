#!/usr/bin/php
<?php

    function    get_month($month)
    {
        $month = preg_replace("/[Jj]anvier/", '01', $month);
        $month = preg_replace('/[Ff][eé]vrier/', '02', $month);
        $month = preg_replace('/[Mm]ars/', '03', $month);
        $month = preg_replace('/[Aa]vril/', '04', $month);
        $month = preg_replace('/[Mm]ai/', '05', $month);
        $month = preg_replace('/[Jj]uin/', '06', $month);
        $month = preg_replace('/[Jj]uillet/', '07', $month);
        $month = preg_replace('/[Aa]out/', '08', $month);
        $month = preg_replace('/[Ss]eptembre/', '09', $month);
        $month = preg_replace('/[Oo]ctobre/', '10', $month);
        $month = preg_replace('/[Nn]ovembre/', '11', $month);
        $month = preg_replace('/[Dd][eé]cembre/', '12', $month);
        return $month;
    }

    if ($argc > 1 && $argc < 3)
    {
        if ((preg_match("/(^[L|l]undi|^[M|m]ardi|^[M|m]ercredi|^[J|j]eudi|^[V|v]endredi|^[S|s]amedi|^[D|d]imanche) {1}([0-9]{1,2}) {1}([J|j]anvier|[F|f][e|é]vrier|[M|m]ars|[A|a]vril|[M|m]ai|[J|j]uin|[J|j]uillet|[A|a]o[u|û]t|[S|s]eptembre|[O|o]ctobre|[N|n]ovembre|([Dd][eé]cembre)) {1}[0-9]{4} {1}[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $argv[1])) != 0)
        {

            date_default_timezone_set("Europe/Paris");

            $result = preg_split("/[\s\r\t\n\f]+/", $argv[1]);
            $clock =  preg_split("/:/", $result[4]);
            $hours = intval($clock[0]);
            $minets = intval($clock[1]);
            $seconds = intval($clock[2]);
            $days = intval($result[1]);
            $month = intval(get_month($result[2]));
            $year = intval($result[3]);
            echo mktime($hours, $minets, $seconds, $month, $days, $year). PHP_EOL;
        }
        else
            print("Wrong Format"). PHP_EOL;
    }
    else
            print("Wrong Format"). PHP_EOL;
    ?>