<?php 
    session_start();
    include 'connection.php';
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        if (isset($_GET['destination']))
        {
            $sql = "DELETE FROM cornerstore.cart_product WHERE cart_id = (SELECT cart_id FROM cornerstore.cart WHERE user_id = $id) AND wishlist = 'True'";
        }
        else
        {
            $sql = "DELETE FROM cornerstore.cart_product WHERE cart_id = (SELECT cart_id FROM cornerstore.cart WHERE user_id = $id) AND wishlist = 'False'";
        }
        
        $result = oci_parse($conn, $sql);
        oci_execute($result);
    }
    else
    {
        unset($_SESSION['product']);
    }
    $_SESSION['cart_removed'] = "All products removed successfully";
    if (isset($_GET['destination']))
    {
        header('location: wishlist.php');
    }
    else
    {
        header('location: cart.php');
    }
    
?>