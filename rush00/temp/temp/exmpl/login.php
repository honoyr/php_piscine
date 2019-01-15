<?php
	session_start();
	function auth($login, $passwd) {
		$arr = unserialize(file_get_contents("../private/passwd"));
		foreach ($arr as $key => $inarr) {
			if ($inarr['login'] === $login && $inarr['passwd'] === $passwd) {
				return (true);
			}
		}
		return (false);
	}
	if (auth($_POST['login'], hash("whirlpool", $_POST['passwd']))) {
		$_SESSION['authorized_user'] = $_POST['login'];
		if ($_SESSION['price'] != 0) {
			$path1 = "../private/tmp_basket/" . session_id() . "_basket";
			if (!file_exists($path1)) {
				file_put_contents($path1, null);
			}
			$basket = unserialize(file_get_contents($path1));
			$tmp['name_of_product'] = $_POST['name_of_product'];
			$tmp['type_of_product'] = $_POST['name_of_product'];
			$tmp['price'] = $_POST['price'];
			$basket[] = $tmp;
			file_put_contents($path1, serialize($basket));
		}
		header("Location: index.php?signin=success",TRUE,301);
	}
	else {
		$_SESSION['authorized_user'] = "";
		header("Location: index.php?signin=error",TRUE,301);
	}

?>
