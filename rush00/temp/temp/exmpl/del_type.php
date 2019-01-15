<?php
    if($_POST['type_of_product'])
    {
        if (!file_exists('../private/p_l')) {
            mkdir("../private/p_l");
        }
        if (!file_exists('../private/p_l/p_l')) {
            file_put_contents('../private/p_l/p_l', null);
        }
        $list = unserialize(file_get_contents('../private/p_l/p_l'));
    $i= -1;
    foreach ($list as $key => $value) {
        if ($value === $_POST['type_of_product'])
        {
            $i = $key;
        }
    }
    if ($i != -1)
    {
        echo $i;
        unset($list[$i]);
        $list = file_put_contents('../private/p_l/p_l', serialize($list));
    }
    header("Location: admin.php",TRUE,301);
}
    header("Location: admin.php",TRUE,301);
?>