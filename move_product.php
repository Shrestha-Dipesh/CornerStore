<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id'];
    $destination = $_GET['destination'];
    if ($destination == 'wishlist')
    {
        $sql = "UPDATE cornerstore.cart_product SET wishlist = 'False' WHERE cart_product_id = $id";
        $_SESSION['cart_success'] = "Product moved to cart";
    }
    else if ($destination == 'cart')
    {
        $sql = "UPDATE cornerstore.cart_product SET wishlist = 'True' WHERE cart_product_id = $id";
        $_SESSION['list_success'] = "Product moved to wishlist";
    }
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    header("location: $destination.php");
?>