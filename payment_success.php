<?php
include 'connection.php';
$cart_id = $_GET['cart_id'];
$user_id = $_GET['user_id'];
$order_id = $_GET['order_id'];
$date = date('n/d/Y');

$sql1 = "SELECT * FROM cornerstore.orders WHERE order_id = $order_id";
$result1 = oci_parse($conn, $sql1);
oci_execute($result1);
$data1 = oci_fetch_array($result1);

if (isset($_GET['product_id']))
{
    $sql4 = "INSERT INTO cornerstore.order_product(order_quantity, order_id, product_id) VALUES ($_GET[quantity], $order_id, $_GET[product_id])";
    $result4 = oci_parse($conn, $sql4);
    oci_execute($result4);
}
else
{
    $sql4 = "INSERT INTO cornerstore.order_product (order_quantity, order_id, product_id) SELECT quantity, $order_id, product_id FROM cornerstore.cart_product WHERE cart_id = $cart_id AND wishlist = 'False'";
    $result4 = oci_parse($conn, $sql4);
    oci_execute($result4);

    $sql = "DELETE FROM cornerstore.cart_product WHERE cart_id = $cart_id AND wishlist = 'False'";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
}

$sql2 = "INSERT INTO cornerstore.payment (payment_amount, payment_date, order_id, user_id) VALUES ('$data1[TOTAL_PRICE]', to_date('$date', 'MM/DD/YYYY'), $order_id, $user_id)";
$result2 = oci_parse($conn, $sql2);
oci_execute($result2);

$sql3 = "UPDATE cornerstore.orders SET status = 'Purchased' WHERE order_id = $order_id";
$result3 = oci_parse($conn, $sql3);
oci_execute($result3);

$sql5 = "SELECT * FROM cornerstore.order_product WHERE order_id = $order_id";
$result5 = oci_parse($conn, $sql5);
oci_execute($result5);
while ($data5 = oci_fetch_array($result5))
{
    $sql6 = "SELECT * FROM cornerstore.product WHERE product_id = $data5[PRODUCT_ID]";
    $result6 = oci_parse($conn, $sql6);
    oci_execute($result6);
    $data6 = oci_fetch_array($result6);

    $new_stock = $data6['STOCK'] - $data5['ORDER_QUANTITY'];

    $sql7 = "UPDATE cornerstore.product SET stock = $new_stock WHERE product_id = $data5[PRODUCT_ID]";
    $result7 = oci_parse($conn, $sql7);
    oci_execute($result7);
}

header("location: receipt.php?order_id=$order_id&user_id=$user_id");
?>