<?php

session_start();
$page = 'index.php';

if (isset($_GET['add']))
{
    $_SESSION['cart_'.(int)$_GET['add']] += '1';
    header('Location: '.$page);
}

if (isset($_GET['minus']))
{
    if ($_SESSION['cart_'.(int)$_GET['minus']] > 0)
        $_SESSION['cart_'.(int)$_GET['minus']] -= '1';
    header('Location: '.$page);
}

if (isset($_GET['del']))
{
    $_SESSION['cart_'.(int)$_GET['del']] = '0';
    header('Location: '.$page);
}

// header('Location: index.php');

function    products()
{
    $product_array = unserialize(file_get_contents("./products/products_list"));
    // print_r($product_array);
    // if all product quantity are at 0, there are no images to display
    // else display the images
    echo "Available Products: ";
    echo "<br><br>";
    foreach ($product_array as $product)
    {
        echo $product['name']."<br>"."price ".number_format($product['price'], 2)."<br>";
        echo '<a href="cart.php?add='.$product['id'].'">Add</a>';
        echo '<a href="cart.php?minus='.$product['id'].'">Minus</a>';
        echo '<a href="cart.php?del='.$product['id'].'">Delete</a>';
        echo "<br><br>";
    }
    echo "<br>";
}

function    paypal_items()
{
    $product_array = unserialize(file_get_contents("./products/products_list"));
    $num = 0;
    foreach ($_SESSION as $name => $value)
    {
        if (substr($name, 0, 5) == "cart_" && $value > 0)
        {
            $id = substr($name, 5, strlen($name) - 5);
            $num++;
            foreach ($product_array as $product)
            {
                if ($product['id'] == $id)
                {
                    echo '<input type="hidden" name="item_number_'.$num.'" value="'.$id.'">';
                    echo '<input type="hidden" name="item_name_'.$num.'" value="'.$product['name'].'">';
                    echo '<input type="hidden" name="amount_'.$num.'" value="'.$product['price'].'">';
                    echo '<input type="hidden" name="shipping_'.$num.'" value="0">';
                    echo '<input type="hidden" name="shipping2_'.$num.'" value="0">';
                    echo '<input type="hidden" name="quantity_'.$num.'" value="'.$value.'">';
                }
            }
        }
    }
}

// creating the cart itself to display what is in the cart
function    cart()
{
    $product_array = unserialize(file_get_contents("./products/products_list"));
    $total = 0;
    foreach ($_SESSION as $name=>$value)
    {
        if (substr($name, 0, 5) == "cart_" && $value > 0)
        {
            $id = substr($name, 5, strlen($name) - 5);
            foreach ($product_array as $product)
            {
                if ($product['id'] == $id)
                {
                    echo "Product ".$id.": ".$value." x $".$product['price']." = $".number_format($product['price'] * $value, 2)."<br>";
                    $total += number_format($product['price'] * $value, 2);
                }
            }
        }
    }
    if ($total == 0)
        echo "<br><br><p>Your cart is empty</p>";
    else
    {
        // display checkout button (validate button)
        // for here, you will need to add a check if there is a logged in user
        echo "<br>TOTAL: $".$total;
        ?>
        <p>
            <form action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value"1">
                <input type="hidden" name="business" value="42SportingGoods@yahoo.com">

                <!-- create items here; list each item in the shopping cart and add it to paypal-->
                <?php paypal_items(); ?>

                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="amount" value="<?php echo $total.":" ?>">
                <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
            </form>
        </p>
        <?php
    }
}

?>