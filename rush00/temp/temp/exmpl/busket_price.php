<?php
	session_start();
	// echo session_id();
	if ($_SESSION['authorized_user']) {
		if (!file_exists('../private/user_basket')) {
			mkdir('../private/user_basket');
		}
		$path1 = "../private/user_basket/" . $_SESSION['authorized_user'] . "_user_basket";
		if (!file_exists($path1)) {
			file_put_contents($path1, null);
		}
		echo $_SESSION['price'];
		$account = unserialize(file_get_contents($path1));
		if ($account) {
			$prize = 0;
			foreach ($account as $k =>$v) {
			   $price = (string)(intval($price) + intval($v['price']));
			}
		}
		$_SESSION['price'] = $price;
		header("Location: index.php",TRUE,301);

	} 
	else {
		if (!file_exists('../private/tmp_basket')) {
			mkdir("../private/tmp_basket");
		}
		$path1 = "../private/tmp_basket/" . session_id() . "_basket";
		if (!file_exists($path1)) {
			file_put_contents($path1, null);
		}
		$account = unserialize(file_get_contents($path1));
		if ($account) {
			$prize = 0;
			foreach ($account as $k =>$v) {
			   $price = (string)(intval($price) + intval($v['price']));
			}
		}
		$_SESSION['price'] = $price;
		header("Location: index.php",TRUE,301);
	}
?>