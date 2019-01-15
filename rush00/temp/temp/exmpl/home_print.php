<?php
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
	foreach ($list as $key => $value) {
		foreach ($account as $k =>$v) {
			foreach ($v['type_of_product'] as $key => $value2) {
				if ($value2 == $value])
					$exist = 1;
			}
			if ($exist == 1) {
				foreach ($v as $key => $value2) {
					echo $value2;
				}
			}
		}
	}	
?>
