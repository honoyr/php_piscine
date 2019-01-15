<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    if ($_POST['price'] && $_POST['price'] && $_POST['url'] && $_POST['type_of_product'] && $_POST['name_of_product']  && $_POST['submit'] && $_POST['submit'] === "OK") {
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
        if ($account) {
            $exist = 0;
            foreach ($account as $k =>$v) {
                if ($v['name_of_product'] === $_POST['name_of_product']) {
                    foreach ($v['type_of_product'] as $key => $value) {
                        if ($value == $_POST['type_of_product'])
                            $exist = 1;
                    }
                }
            }
        }
        if ($exist > 0) {
            echo "such product already exists\n";
        } else {
            $arrayName = preg_split("/ *, */", $_POST['type_of_product']);
            $tmp['type_of_product'] = $arrayName;
            $tmp['name_of_product'] = $_POST['name_of_product'];
            $tmp['price'] = $_POST['price'];
            $tmp['url'] = $_POST['url'];
            $tmp['description'] = $_POST['description']; 
            $account[] = $tmp;
            $f_mas;
            foreach ($arrayName as $key => $value) {
                {
                        $list[] = $value;
                }
            }
            $list = array_unique($list);
            file_put_contents('../private/product/product', serialize($account));
            file_put_contents('../private/p_l/p_l', serialize($list));
            header("Location: admin.php",TRUE,301);
        }
    } else {
    	header("Location: admin.php",TRUE,301);
    }
?>