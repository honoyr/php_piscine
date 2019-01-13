<?php
    session_start();
    if ($_SESSION['authorization_ur'])
        echo $_SESSION['authorization_ur'] . PHP_EOL;
    else
        echo "ERROR" . PHP_EOL;
?>