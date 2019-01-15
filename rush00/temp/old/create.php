<?php

include 'create.html';

function    account_exists($big_arr, $login)
{
    foreach ($big_arr as $elem)
        if ($login === $elem['login'])
            return (1);
    return (0);
}

function    lastwords($message)
{
    echo $message."\n";
    exit();
}

if ($_POST['submit'] === "OK")
{
    if ($_POST['login'] && $_POST['passwd'])
    {
        mkdir("./private");
        $arr = unserialize(file_get_contents("./private/passwd"));
        if (!account_exists($arr, $_POST['login']))
        {
            $temp['login'] = $_POST['login'];
            $temp['passwd'] = hash("whirlpool", $_POST['passwd']);
            $arr[] = $temp;
            file_put_contents("./private/passwd", serialize($arr));
        }
        else
            lastwords("ERROR: username already exists\n");
    }
    else
        lastwords("ERROR: Missing username or password\n");
}
else
    exit();

?>