#!/usr/bin/php
<?php
    function ft_is_sort($tab)
    {
        $tmp = $tab;
        sort($tab);
        $max = sizeof($tab);
        for($n = 0; $n < $max; $n++)
        {
            if ($tmp[$n] != $tab[$n])
                return false;
        }
        return(true);
    }
?>