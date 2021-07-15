<?php
    session_start();
    $already_in_cart = false;
    if (isset($_POST['add_cart']))
    {
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
    }
    else
    {
        $product_id = $_GET['id'];
        $qty = 1;
    }
    if (!isset($_SESSION['product']))
    {
        $_SESSION['product'] = array();
    }
    if (count($_SESSION['product']) > 0)
    {
        if (count($_SESSION['product']) < 20)
        {
            foreach($_SESSION['product'] as $id => $quantity)
            {
                if ($id == $product_id)
                {
                    $already_in_cart = true;
                    break;
                }
            }
            if ($already_in_cart == true)
            {
                $_SESSION['cart_fail'] = "Product already in cart";
            }
            else
            {
                $_SESSION['product'][$product_id] = $qty;
                $_SESSION['cart_success'] = "Product added to cart successfully";
            }
        }
        else
        {
            $_SESSION['cart_fail'] = "Cart limit exceeded (20)";
        }
    }
    else
    {
        $_SESSION['product'][$product_id] = $qty;
        $_SESSION['cart_success'] = "Product added to cart successfully";
    }
    if (isset($_POST['add_cart']))
    {
        header("location: product_details.php?id=$product_id");
    }
    else
    {
        $desination = $_GET['destination'];
        if (isset($_GET['category']))
        {
            header("location:$desination?category=$_GET[category]");
        }
        else if (isset($_GET['keyword']))
        {
            header("location:$desination?keyword=$_GET[keyword]");
        }
        else if (isset($_GET['product_id']))
        {
            header("location: $desination?id=$_GET[product_id]");
        }
        else
        {
            header("location: $desination");
        }
    }
    
?>