<?php
    session_start();
    include ("auth.php");
    if (auth($_GET['login'], $_GET['passwd'])=== true){
        $_SESSION['authorization_ur'] = $_GET['login'];
        echo "OK" . PHP_EOL;
    }
    else
    {
        $_SESSION['authorization_ur'] = "";
        echo "ERROR" . PHP_EOL;
    }
?>