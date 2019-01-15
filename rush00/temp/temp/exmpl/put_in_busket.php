<?php
	session_start();
	if ($_SESSION['authorized_user'])
	{
		if (!file_exists('../private/user_basket')) {
			mkdir("../private/user_basket");
		}
		$path1 = "../private/user_basket/" . $_SESSION['authorized_user'] . "_user_basket";
		if (!file_exists($path1)) {
			file_put_contents($path1, null);
		}
		$basket = unserialize(file_get_contents($path1));
		$tmp['name_of_product'] = $_POST['name_of_product'];
		$tmp['type_of_product'] = $_POST['type_of_product'];
		$tmp['price'] = $_POST['price'];
		$basket[] = $tmp;
		file_put_contents($path1, serialize($basket));
		header("Location: busket_price.php",TRUE,301);
	}
	else {
		if (!file_exists('../private/tmp_basket')) {
			mkdir("../private/tmp_basket");
		}
		$path1 = "../private/tmp_basket/" . session_id() . "_basket";
		if (!file_exists($path1)) {
			file_put_contents($path1, null);
		}
		$basket = unserialize(file_get_contents($path1));
		$tmp['name_of_product'] = $_POST['name_of_product'];
		$tmp['type_of_product'] = $_POST['type_of_product'];
		$tmp['price'] = $_POST['price'];
		$basket[] = $tmp;
		file_put_contents($path1, serialize($basket));
		header("Location: busket_price.php",TRUE,301);
	}
?>