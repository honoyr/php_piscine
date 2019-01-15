<?php
if ($_POST['submit'] === "OK"){
    if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'])
    {
        if (!(file_exists("../private")))
        {
            echo "ERROR" . PHP_EOL;
        }
        $exist_user = $_POST['login'];
        $old_pw = hash("whirlpool", $_POST['oldpw']);
        $new_pw = hash("whirlpool", $_POST['newpw']);
        $arr_data = unserialize(file_get_contents("../private/passwd_adm"));
        foreach ($arr_data as $key => $val) {
            if (($val['login'] === $exist_user)){
                if(($val['passwd'] === $old_pw)) {
                    $arr_data[$key]['passwd'] = $new_pw;
                    file_put_contents("../private/passwd_adm", serialize($arr_data));
                    echo "OK" . PHP_EOL;
                }
                else
                {
                    echo "ERROR" . PHP_EOL;
                }
            }
        }
    }
    else
    {
        echo "ERROR" . PHP_EOL;
    }
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
        <meta http-equiv="refresh" content="1;modif_admin.html" />
    </head>
</p>
</body>
</html>
