<?php
    session_start();
    include 'connection.php';

    if (isset($_POST['shop_submit']))
    {
        $shop_id = $_POST['shop_id'];
        $shop_name = $_POST['shop_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $sql = "UPDATE cornerstore.shop SET shop_name = '$shop_name', address = '$address', contact = $contact WHERE shop_id = $shop_id";
        $result = oci_parse($conn, $sql);
        oci_execute($result);
        $_SESSION['shop_success'] = "Changes saved successfully";
    }
    header('location: manage_shop.php');
?>