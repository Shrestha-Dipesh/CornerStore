<?php
    include 'connection.php';
    $order_id = $_GET['order_id'];

    $statement = "SELECT * FROM cornerstore.orders WHERE order_id = $order_id";
    $result = oci_parse($conn, $statement);
    oci_execute($result);
    $data = oci_fetch_array($result);

    $statement1 = "DELETE FROM cornerstore.orders WHERE order_id = $order_id";
    $result1 = oci_parse($conn, $statement1);
    oci_execute($result1);

    $statement2 = "SELECT * FROM cornerstore.slot WHERE slot_id = $data[SLOT_ID]";
    $result2 = oci_parse($conn, $statement2);
    oci_execute($result2);
    $data2 = oci_fetch_array($result2);

    $data2['TOTAL_ORDERS']--;

    $statement3 = "UPDATE cornerstore.slot SET total_orders = $data2[TOTAL_ORDERS] WHERE slot_id = $data[SLOT_ID]";
    $result3 = oci_parse($conn, $statement3);
    oci_execute($result3);

    header('location: cart.php');
?>