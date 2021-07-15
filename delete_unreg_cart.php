<?php
    session_start();
    $product_id = $_GET['id'];
    unset($_SESSION['product'][$product_id]);
    $_SESSION['cart_removed'] = "Product removed successfully";
    header('location: cart.php');
?>