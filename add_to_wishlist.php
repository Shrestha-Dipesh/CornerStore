<?php
    session_start();
    include 'connection.php';
    $product_id = $_GET['product_id'];
    $cart_id = $_GET['cart_id'];
    $statement1 = "SELECT * FROM cornerstore.cart_product WHERE cart_id = $cart_id AND product_id = $product_id";
    $result1 = oci_parse($conn, $statement1);
    oci_execute($result1);
    $data1 = oci_fetch_array($result1);

    if ($data1)
    {
        if ($data1['WISHLIST'] == "True")
        {
            $statement2 = "DELETE FROM cornerstore.cart_product WHERE cart_id = $cart_id AND product_id = $product_id AND wishlist = 'True'";
            $_SESSION['cart_fail'] = "Product removed from wishlist";
        }
        else
        {
            $_SESSION['cart_fail'] = "Product already in cart";
        }
    }
    else
    {
        $statement2 = "INSERT INTO cornerstore.cart_product (quantity, wishlist, product_id, cart_id) VALUES (1, 'True', $product_id, $cart_id)";
        $_SESSION['cart_success'] = "Product added to wishlist";
    }
    $result2 = oci_parse($conn, $statement2);
    oci_execute($result2);
    header("location: product_details.php?id=$product_id");
?>