<?php
    session_start();
    include 'connection.php';
    if (isset($_POST['product_submit']))
    {
        $product_id = $_POST['product_id'];
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
        $sql = "UPDATE cornerstore.product SET product_name = '$product_name', description = '$description', price = '$price', stock = $stock, allergy_info = '$allergy', discount = $discount, category = '$category', shop_id = $shop_id WHERE product_id = $product_id";
        $result = oci_parse($conn, $sql);
        oci_execute($result);
        $_SESSION['product_success'] = "Changes saved successfully";

        header('location: trader_interface.php');
    }
?>