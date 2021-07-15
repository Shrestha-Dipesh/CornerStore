<?php 
    session_start();
    include 'connection.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM cornerstore.cart_product WHERE cart_product_id = $id";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    $_SESSION['cart_removed'] = "Product removed successfully";
    if (isset($_GET['destination']))
    {
        header("location:wishlist.php");
    }
    else
    {
        header('location: cart.php');
    }
?>