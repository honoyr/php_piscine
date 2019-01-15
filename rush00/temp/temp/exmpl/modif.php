<?php
	function exiterror() {
		header("Location: admin.php",TRUE,301);
		exit ;
	}
	if ($_POST['submit'] === "OK" && $_POST['login'])
	{
		if (!(file_exists("../private")))
			mkdir("../private", 0777, true);
		$login = $_POST['login'];
		if ($_POST['email']) {
			$email = $_POST['email'];
		}
		if ($_POST['phone']) {
			$phone = $_POST['phone'];
		}
		if (htmlspecialchars($_POST["select"])) {
			$admin = htmlspecialchars($_POST["select"]);
		}
		$arr = unserialize(file_get_contents("../private/passwd"));
		foreach ($arr as $key => $inarr) {
			if ($inarr['login'] === $login && $email) {
				$arr[$key]['email'] = $email;
			}
			if ($inarr['login'] === $login && $phone) {
				$arr[$key]['phone'] = $phone;
			}
			if ($inarr['login'] === $login && $admin != 0) {
				$arr[$key]['admin'] = $admin;
			}
			if ($inarr['login'] === $login)
			{
				file_put_contents('../private/passwd', serialize($arr));
				header("Location: admin.php",TRUE,301);
				exit ;
			}
		}
	}
	else
		exiterror();
?>
