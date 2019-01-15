<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	if ($_POST['type_of_product'] && $_POST['name_of_product']  && ($_POST['new_price'] || $_POST['new_url']  || $_POST['new_description'] || $_POST['new_name_of_product']) && $_POST['submit'] === "OK") {
		if (!file_exists('../private/product')) {
			mkdir("../private/product");
		}
		if (!file_exists('../private/product/product')) {
			file_put_contents('../private/product/product', null);
		}
		if (!file_exists('../private/p_l')) {
			mkdir("../private/p_l");
		}
		if (!file_exists('../private/p_l/p_l')) {
			file_put_contents('../private/p_l/p_l', null);
		}
		$account = unserialize(file_get_contents('../private/product/product'));
		$list = unserialize(file_get_contents('../private/p_l/p_l'));
		$exist = 0;
		foreach ($account as $k =>$v) {
			if ($v['name_of_product'] == $_POST['name_of_product']) {
				foreach ($v['type_of_product'] as $key => $value) {
					if ($value == $_POST['type_of_product'])
					{
						if ($_POST['new_price']) {
							$account[$k]['price'] = $_POST['new_price'];
						}
						if ($_POST['new_name_of_product']) {
							$account[$k]['name_of_product'] = $_POST['new_name_of_product'];
						}
						if ($_POST['new_url']) {
							$account[$k]['url'] = $_POST['new_url'];
						}
						if ($_POST['new_description']) {
							$account[$k]['description'] = $_POST['new_description'];
						}
						file_put_contents('../private/product/product', serialize($account));
						file_put_contents('../private/p_l/p_l', serialize($list));
						header("Location: admin.php",TRUE,301);
					}
				}
			}
		}
		if ($exist > 0) {
			echo "such product already exists\n";
		} else {
		header("Location: admin.php",TRUE,301);
		}
	} else {
			header("Location: admin.php",TRUE,301);
	}
?>