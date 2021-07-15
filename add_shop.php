<?php
    session_start();
    include 'connection.php';
    if (isset($_POST['shop_submit']))
    {
        if (isset($_COOKIE['id']))
        {
            $user_id = $_COOKIE['id'];
        }
        else if (isset($_SESSION['id']))
        {
            $user_id = $_SESSION['id'];
        }
        $shop_name = $_POST['shop_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $statement = "SELECT COUNT(*) AS COUNT FROM cornerstore.shop WHERE user_id = $user_id";
        $result1 = oci_parse($conn, $statement);
        oci_execute($result1);
        $data1 = oci_fetch_array($result1);
        if ($data1['COUNT'] < 10)
        {
            $sql = "SELECT MAX(shop_no) AS shop_no FROM cornerstore.shop WHERE user_id = $user_id";
            $result = oci_parse($conn, $result);
            oci_execute($result);
            $data = oci_fetch_array($result);
            $shop_no = $data['SHOP_NO'] + 1;
    
            $sql1 = "INSERT INTO cornerstore.shop (user_id, shop_no, shop_name, address, contact, authorized) VALUES ($user_id, $shop_no, '$shop_name', '$address', $contact, 'False')";
            $result1 = oci_parse($conn, $sql1);
            oci_execute($result1);
            $_SESSION['shop_success'] = 'Shop added successfully';
        }
        else
        {
            $_SESSION['shop_delete'] = 'Shop limit exceeded (10)';
        }
        
    }
    header('location: manage_shop.php');
?>