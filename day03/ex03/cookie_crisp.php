<?php
    if ($_GET[action] === "set")
    {
        if ($_GET[name] && $_GET[value])
            setcookie($_GET[name], $_GET[value]);
        elseif ($_GET[name])
            setcookie($_GET[name], "");
    }
    if ($_GET[action] === "get")
    {
        if ($_COOKIE[$_GET[name]])
            echo $_COOKIE[$_GET[name]] . PHP_EOL;
    }
    if ($_GET[action] === "del")
        setcookie($_GET[name], "", time() - 3600);
?>