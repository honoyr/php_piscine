#!/usr/bin/php
<?php
    function ft_split($str)
    {
        $result = preg_split("/[\s\r\t\n\f]+/", $str);
        sort($result);
        return $result;
    }
?>