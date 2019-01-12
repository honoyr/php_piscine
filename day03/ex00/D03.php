#!/usr/bin/php
<?php
?>


<?php
if ($_GET[login] && $_GET[passwd] && $_GET[submit] === "OK")
{
    setcookie($_GET[login], $_GET[passwd]);
}
if ($_GET[action] === "get")
{
    if ($_COOKIE[$_GET[login]])
        echo $_COOKIE[$_GET[login]] . PHP_EOL . $_COOKIE[$_GET[passwd]] . PHP_EOL;
}
if ($_GET[action] === "del")
    setcookie($_GET[name], "", time() - 3600);
?>

