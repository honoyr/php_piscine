<?php
	session_start();
    if ($_SESSION['authorized_user'] && $_SESSION['price'] > 0)
    {
        if (!file_exists('../private/user_basket')) {
            mkdir("../private/user_basket");
        }
        $path1 = "../private/user_basket/" . $_SESSION['authorized_user'] . "_user_basket";
        if (!file_exists($path1)) {
            file_put_contents($path1, null);
        }
        $basket = unserialize(file_get_contents($path1));
        
        if (!file_exists('../private/user_order')) {
            mkdir("../private/user_order");
        }
        if (!file_exists('../private/user_order/user_order')) {
            file_put_contents('../private/user_order/user_order', null);
        }
        $basket[] = array('login' => $_SESSION['authorized_user']);
        $all_order = unserialize(file_get_contents('../private/user_order/user_order'));
        $all_order[] = $basket;
        file_put_contents('../private/user_order/user_order', serialize($all_order));
        file_put_contents($path1, null);
        header("Location: index.php",TRUE,301);
    }
    else {
    	echo "lololol";
        header("Location: index.php",TRUE,301);
    }
?>