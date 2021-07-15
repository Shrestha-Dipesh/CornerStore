<?php
    session_start();
    include 'connection.php';
    if (isset($_POST['product_submit']))
    {
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category = $_POST['category'];
        $shop_id = $_POST['shop_id'];
        if (isset($_POST['allergy']) && !empty($_POST['allergy']))
        {
            $allergy = $_POST['allergy'];
        }
        else
        {
            $allergy = '';
        }
        if (isset($_POST['discount']) && !empty($_POST['discount']))
        {
            $discount = $_POST['discount'];
        }
        else
        {
            $discount = 0;
        }
        $sql = "INSERT INTO cornerstore.product (product_name, description, price, stock, allergy_info, discount, category, approved, shop_id) VALUES ('$product_name', '$description', '$price', $stock, '$allergy', $discount, '$category', 'False', $shop_id)";
        $result = oci_parse($conn, $sql);
        oci_execute($result);

        $_SESSION['product_success'] = 'Produce added successfully';

        header('location: trader_interface.php');
    }
?>