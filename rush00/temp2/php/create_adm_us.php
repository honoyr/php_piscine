<?php
header("Content-Type: text/html");
if ($_POST['submit'] === "OK") {
    if ($_POST['login']) {
        if (!$_POST['passwd']) {
            {
//                echo "ERROR" . PHP_EOL;
                header("Location: ../admin/admin.php?create=errorempty",TRUE,301);
                exit ;
            }
        }
        if (!(file_exists("../private"))) {
            mkdir("../private", 0777, true);
        }
        $login = $_POST['login'];
        $passwd = hash("whirlpool", $_POST['passwd']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $arr_data = unserialize(file_get_contents("../private/passwd"));
        foreach ($arr_data as $key) {
            if ($key['login'] === $login) {
//                echo "ERROR" . PHP_EOL;
                header("Location: admin.php?create=erroroldlogin",TRUE,301);
                exit ;
            }
        }
        $new_user = array('login' => $login, 'passwd' => $passwd, 'email' => $email, 'phone' => $phone);
        $arr_data[] = $new_user;
        file_put_contents("../private/passwd", serialize($arr_data));
//        echo "OK" . PHP_EOL;
        header("Location: ../admin/admin.php?create=success",TRUE,301);
        exit ;
    }
    else
    {
//        echo "ERROR" . PHP_EOL;
        header("Location: ../admin/admin.php?create=errorempty",TRUE,301);
        exit ;
    }

}
else
{
//    echo "ERROR" . PHP_EOL;
    header("Location: ../admin/admin.php?create=errorempty",TRUE,301);
    exit ;
}

?>
<!--<html>-->
<!--<body>-->
<!--<p>-->
<!--    <head>-->
<!--        <meta http-equiv="refresh" content="1;../admin/login_admin.php" />-->
<!--    </head>-->
<!--</p>-->
<!--</body>-->
<!--</html>-->
