<?php
header("Content-Type: text/html");
if ($_POST['submit'] === "OK") {
    if ($_POST['login']) {
        if (!$_POST['passwd']) {
            echo "ERROR" . PHP_EOL;
        }
        if (!(file_exists("../private"))) {
            mkdir("../private", 0777, true);
        }
        $login = $_POST['login'];
        $passwd = hash("whirlpool", $_POST['passwd']);
        $masterkey = hash("whirlpool", $_POST['masterkey']);
        if ($masterkey === "cb0f378122f416fffe37843335959fad92d0f92b4a7981b3877d76c8972e8f8e6e63e523cc239aa1107af7ce8bb80fa528551ea490f943194649749b784ab359"){
            $arr_data = unserialize(file_get_contents("../private/passwd_adm"));
            foreach ($arr_data as $key) {
                if ($key['login'] === $login) {
                    echo "ERROR" . PHP_EOL;
                }
            }
            $new_user = array('login' => $login, 'passwd' => $passwd);
            $arr_data[] = $new_user;
            file_put_contents("../private/passwd_adm", serialize($arr_data));
            echo "OK" . PHP_EOL;
        }
        else
            echo "ERROR" . PHP_EOL;
    }
    else
        echo "ERROR" . PHP_EOL;
}
else
{
    echo "ERROR" . PHP_EOL;
}
?>
<html>
<body>
<p>
    <head>
        <meta http-equiv="refresh" content="1;login_admin.html" />
    </head>
</p>
</body>
</html>
