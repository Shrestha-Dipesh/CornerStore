<?php
    include 'connection.php';
    $cart_product_id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $stock = $_GET['stock'];
    $type = $_GET['type'];
    if ($type == 'increase')
    {
        if ($stock >= 20)
        {
            $max = 20;
        }
        else if ($stock < 20)
        {
            $max = $stock;
        }
        if ($quantity < $max)
        {
            $quantity++;
        }
    }
    else if ($type == 'decrease')
    {
        if ($quantity > 1)
        {
            $quantity--;
        }
    }
    $sql = "UPDATE cornerstore.cart_product SET quantity = $quantity WHERE cart_product_id = $cart_product_id";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    header('location: cart.php');
?>