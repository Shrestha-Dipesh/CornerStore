<?php
    session_start();
    include 'connection.php';
    $product_id = $_GET['id'];
    $statement = "DELETE FROM cornerstore.order_product WHERE product_id = $product_id";
    $result2 = oci_parse($conn, $statement);
    oci_execute(($result2));

    $statement1 = "DELETE FROM cornerstore.cart_product WHERE product_id = $product_id";
    $result3 = oci_parse($conn, $statement1);
    oci_execute($result3);

    $statement2 = "DELETE FROM cornerstore.image WHERE product_id = $product_id";
    $result4 = oci_parse($conn, $statement2);
    oci_execute($result4);

    $sql = "DELETE FROM cornerstore.review WHERE product_id = $product_id";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    $sql1 = "DELETE FROM cornerstore.product WHERE product_id = $product_id";
    $result1 = oci_parse($conn, $sql1);
    oci_execute($result1);
    $_SESSION['product_delete'] = "Product removed successfully";
    header('location: trader_interface.php');
?>