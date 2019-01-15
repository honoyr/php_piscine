<?php
	function admcheck($login) {
		$arr = unserialize(file_get_contents("../private/passwd"));
		foreach ($arr as $key => $inarr) {
			if ($inarr['login'] === $login && $inarr['admin'] == 1) {
				return (true);
			}
		}
		return (false);
	}
	session_start();
	if (admcheck($_SESSION['authorized_user'])) {
        if (!file_exists('../private')) {
            mkdir("../private");
        }
        if (!file_exists('../private/passwd')) {
            file_put_contents('../private/passwd', null);
        }
        $account = unserialize(file_get_contents('../private/passwd'));
        $akk;
        foreach ($account as $key => $value) {
            if ($value = $_POST['login']) {
                $akk = $key;
            }
        }            unset($account[$akk]);
            file_put_contents('../private/passwd', serialize($account));
            header("Location: admin.php",TRUE,301);
    }
?>