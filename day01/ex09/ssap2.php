#!/usr/bin/php
<?php

function type($str)
{
	$ch = ord($str);
	if(($ch >= 65 && $ch <= 90) || ($ch >= 97 && $ch <= 122))
		return (1);
	else if($ch >= 48 && $ch <= 57)
		return(2);
	else 
		return(3);
}

function ft_sorting($val1, $val2)
{
	$a_type = type($val1);
	$b_type = type($val2);
	if($a_type == $b_type)
	{
		if (ord($val1) ==  ord($val2))
			return 0;
		if ($a_type == 1)
			return strcasecmp($val1, $val2);
		return ord($val1) > ord($val2) ? 1 : -1;
	}
	return $a_type > $b_type ? 1 : -1;
}

if ($argc > 1)
{
    $result = array();
    for ($n = 1; $n < $argc; $n++)
    {
        $arr = preg_split("/[\s\r\t\n\f]+/", $argv[$n]);
        $result == 0 ? ($result = $arr) : ($result = array_merge($result, $arr));
    }
    usort($result, "ft_sorting");
    $max = sizeof($result);
    for ($n = 0; $n < $max; $n++)
        echo $result[$n] . PHP_EOL;
}
?>