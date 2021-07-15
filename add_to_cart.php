<?php
    session_start();
    include 'connection.php';
    $product_id = $_GET['id'];
    if (isset($_COOKIE['id'])) {
        $user_id = $_COOKIE['id'];
    } else if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    }
    if (isset($_POST['add_cart']))
    {
        $quantity = $_POST['qty'];
    }
    else
    {
        $quantity = 1;
    }
    $statement = "SELECT cart_id FROM cornerstore.cart WHERE user_id = $user_id";
    $result = oci_parse($conn, $statement);
    oci_execute($result);
    $data = oci_fetch_array($result);

    $statement1 = "SELECT COUNT(*) AS COUNT FROM cornerstore.cart_product WHERE cart_id = $data[CART_ID]";
    $result1 = oci_parse($conn, $statement1);
    oci_execute($result1);
    $data1 = oci_fetch_array($result1);

    if ($data1['COUNT'] < 20)
    {
        $statement2 = "SELECT * FROM cornerstore.cart_product WHERE cart_id = $data[CART_ID] AND product_id = $product_id";
        $result2 = oci_parse($conn, $statement2);
        oci_execute($result2);
        $data2 = oci_fetch_array($result2);

        if (!$data2)
        {
            
            $statement3 = "INSERT INTO cornerstore.cart_product (quantity, product_id, cart_id, wishlist) VALUES ($quantity, $product_id, $data[CART_ID], 'False')";
            $result3 = oci_parse($conn, $statement3);
            oci_execute($result3);
            $_SESSION['cart_success'] = "Product added to cart successfully";
        }
        else
        {
            $_SESSION['cart_fail'] = "Product already in cart";
        }
    }
    else
    {
        $_SESSION['cart_fail'] = "Cart limit exceeded (20)";
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