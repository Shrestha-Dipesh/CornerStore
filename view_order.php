<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0">
            <?php include 'trader_nav.php' ?>
            <div class="product-top-container">
                <span>View Orders</span>
            </div>
            <div class="table-responsive" style="min-height: 232px">
                <table class="table table-striped table-hover shop-table">
                    <thead>
                        <tr>
                            <th scope="col">Order Id</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price (&pound;)</th>
                            <th scope="col">Slot Day</th>
                            <th scope="col">Slot Time</th>
                            <th scope="col">User Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connection.php';
                        if (isset($_COOKIE['id'])) {
                            $id = $_COOKIE['id'];
                        } else if (isset($_SESSION['id'])) {
                            $id = $_SESSION['id'];
                        }
                        $sql = "SELECT * FROM cornerstore.orders o, cornerstore.order_product op, cornerstore.product p, cornerstore.slot s, cornerstore.shop sh, cornerstore.users u, cornerstore.cart c
                        WHERE o.order_id = op.order_id AND op.product_id = p.product_id AND o.slot_id = s.slot_id AND p.shop_id = sh.shop_id AND o.cart_id = c.cart_id AND c.user_id = u.user_id
                        AND op.product_id IN (SELECT product_id FROM cornerstore.product WHERE shop_id IN (SELECT shop_id FROM cornerstore.shop WHERE user_id = $id))";
                        $result = oci_parse($conn, $sql);
                        oci_execute($result);
                        while ($data = oci_fetch_array($result)) {
                            echo "<tr>
                            <td scope='row'>$data[ORDER_ID]</td>
                            <td>$data[SHOP_NAME]</td>
                            <td>$data[PRODUCT_NAME]</td>
                            <td>$data[ORDER_QUANTITY]</td>
                            <td>".number_format($data['PRICE'] * $data['ORDER_QUANTITY'], 2)."</td>
                            <td>$data[SLOT_DAY]</td>
                            <td>$data[SLOT_TIME]</td>
                            <td>$data[USER_NAME]</td>
                            </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <?php include 'footer.php' ?>
        </div>
        <!--body wrapper ends here-->
    </div>
    <!--container-fluid ends here-->

    <!--bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--bootstrap script-->

    <script src="scripts/main.js"></script>

</body>

</html>