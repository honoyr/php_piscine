<?php
	include 'auth.php';
		
	if ($_POST['submit'] === "OK") {
		if ($_POST['login']) {
			if (!$_POST['passwd']) {
				header("Location: index.php?create=errorempty",TRUE,301);
				exit ;
			}
			if (!(file_exists("../private")))
				mkdir("../private", 0777, true);
			$login = $_POST['login'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$passwd = hash("whirlpool", $_POST['passwd']);
			$arr = unserialize(file_get_contents("../private/passwd"));
			foreach ($arr as $inarr) {
				if ($inarr['login'] === $login) {
					header("Location: index.php?create=erroroldlogin",TRUE,301);
				exit ;
				}
			}
			$new_arr = array('login' => $login, 'passwd' => $passwd, 'email' => $email, 'phone' => $phone, 'admin' => 2);
			$arr[] = $new_arr;
			file_put_contents('../private/passwd', serialize($arr));
			echo "OK" . PHP_EOL;
			header("Location: index.php?create=success",TRUE,301);
			exit ;
		}
		else {
			header("Location: index.php?create=errorempty",TRUE,301);
			exit ;
		}
	}
	else {
		header("Location: index.php?create=errorempty",TRUE,301);
		exit ;
	}
?>
