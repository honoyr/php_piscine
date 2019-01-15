<?php

include 'login.html';

session_start();
print_r($_SESSION);

function    lastwords($message)
{
    echo $message."\n";
    exit();
}

function    account_exists($big_arr, $login)
{
    foreach ($big_arr as $elem)
        if ($login === $elem['login'])
            return (1);
    return (0);
}

function    auth($login, $passwd)
{
    if (!$login || !$passwd)
        return (false);
    $big_array = unserialize(file_get_contents("./private/passwd"));
    if ($big_array)
    {
        foreach ($big_array as $k => $v)
        {
            if ($v['login'] === $login && hash("whirlpool", $passwd) === $v['passwd'])
                return (true);
        }
    }
    return (false);
}

if ($_GET['submit'] === 'OK')
{
    $serialized_text = file_get_contents("./private/passwd");
    $big_array = unserialize($serialized_text);
    // check if user exists
    if (account_exists($big_array, $_GET['login']))
    {
        // check if valid user
        if (auth($_GET['login'], $_GET['passwd']))
        {
            echo $_GET['login']." has just logged on\n";
            $_SESSION['loggued_on_user'] = $_GET['login'];
        }
        else
            lastwords("Invalid username/password");
    }
    else
        lastwords("Account with username does not exist");
}
else
    exit();

?>