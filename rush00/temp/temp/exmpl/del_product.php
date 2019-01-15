<?php
    if ($_POST['type_of_product'] && $_POST['name_of_product'] && $_POST['submit'] && $_POST['submit'] === "OK") {
        if (!file_exists('../private/product')) {
            mkdir("../product");
        }
        if (!file_exists('../private/product/product')) {
            file_put_contents('../private/product/product', null);
        }
        $account = unserialize(file_get_contents('../private/product/product'));
        if ($account) {
            $exist = -1;
            foreach ($account as $k =>$v) {
                if ($v['name_of_product'] === $_POST['name_of_product']) {
                    foreach ($v['type_of_product'] as $key => $value) {
                                                    echo"<p>$value<p>";
                        if ($value == $_POST['type_of_product'])
                        {
                            $exist = $k;
                        }
                    }
                }
            }
        }
        if ($exist != -1) {
            unset($account[$exist]);
            file_put_contents('../private/product/product', serialize($account));
            header("Location: admin.php",TRUE,301);
        } else {
            header("Location: admin.php",TRUE,301);
        }
    } else {
       header("Location: admin.php",TRUE,301);
    }
?>