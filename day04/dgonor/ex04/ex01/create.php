<?php
if ($_POST['submit'] === "OK") {
    if ($_POST['login']) {
        if (!$_POST['passwd']) {
            echo "ERROR" . PHP_EOL;
            exit;
        }
        if (!(file_exists("../private"))) {
            mkdir("../private", 0777, true);
        }
        $login = $_POST['login'];
        $passwd = hash("whirlpool", $_POST['passwd']);
        $arr_data = unserialize(file_get_contents("../private/passwd"));
        foreach ($arr_data as $key) {
            if ($key['login'] === $login) {
                echo "ERROR" . PHP_EOL;
                exit;
            }
        }
        $new_user = array('login' => $login, 'passwd' => $passwd);
        $arr_data[] = $new_user;
        file_put_contents("../private/passwd", serialize($arr_data));
        echo "OK" . PHP_EOL;
        exit;
    }
    else
    {
        echo "ERROR" . PHP_EOL;
        exit;
    }
}
else
{
    echo "ERROR" . PHP_EOL;
    exit;
}
?>