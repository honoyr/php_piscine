<?php
    function    auth($login, $passwd)
    {
        if (!(file_exists("../private")))
            return false;
        $exist_user = $login;
        $hash_pw = hash("whirlpool", $passwd);
        $arr_data = unserialize(file_get_contents("../private/passwd_adm"));
        foreach ($arr_data as $key => $val) {
            if (($val['login'] === $exist_user))
                if(($val['passwd'] === $hash_pw))
                    return true;
        }
        return false;
    }
?>