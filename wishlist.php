<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    if (isset($_COOKIE['id'])) {
        $user_id = $_COOKIE['id'];
    } else if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    }
    ?>
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0">
            <?php include 'nav_bar.php' ?>
            <!-- Shopping cart -->
            <section class="cart-section" style = "min-height: 270px;">
                <div class="row">
                    <div class="col-md-8" style = "width: 95%;margin: auto;">
                        <h4 style="display: inline;">My Wishlist</h4>
                        <?php
                            if (isset($user_id))
                            {
                                echo '<a href="delete_all_cart.php?destination=wishlist&id='.$user_id.'" class="remove-all">Remove all product</a>';
                            }
                        ?>
                        <?php
                        if (isset($_SESSION['cart_removed'])) {
                            echo '<p style = "color: red; text-align: center;">' . $_SESSION['cart_removed'] . '</p>';
                        }
                        else if (isset($_SESSION['cart_success']))
                        {
                            echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['cart_success'] . '</p>';
                        }
                        ?>
                        <?php
                        include 'connection.php';
                        if (isset($user_id)) {
                            $sql = "SELECT cart_product_id, product_name, price, stock, quantity, shop_name, discount FROM cornerstore.cart_product c, cornerstore.product p, cornerstore.shop s WHERE c.product_id = p.product_id AND s.shop_id = p.shop_id AND wishlist = 'True' AND cart_id = (SELECT cart_id FROM cornerstore.cart WHERE user_id = $user_id)";
                            $result = oci_parse($conn, $sql);
                            oci_execute($result);
                            $count = 0;
                            $total_price = 0.0;
                            $has_product = false;
                            while ($data = oci_fetch_array($result)) {
                                $count++;
                                echo '<hr class="mt-2 mb-3" />
                                    <div class="row mb-4">
                                        <div class="col-md-3 col-lg-3 col-xl-2 cart-col">
                                            <img class="img-fluid" src="images/' . $data['PRODUCT_NAME'] . '.jpg" alt="Maine Lobster">
                                        </div>
                                        <div class="col-md-7 col-lg-9 col-xl-9 cart-details-col">
                                            <div class="column2">
                                                <div class="d-flex justify-content-between">
                                                    <div class="description" style = "min-width: 200px;">
                                                        <h5 class="mt-2 mb-3">' . $data['PRODUCT_NAME'] . '</h5>
                                                        <p class="mb-1 text-muted small">' . $data['SHOP_NAME'] . '</p>';
                                                    if ($data['STOCK'] > 0) {
                                                        echo '<p class="mb-1" style = "color: #00b894;">Only ' . $data['STOCK'] . ' item(s) in stock</p>';
                                                    } else {
                                                        echo '<p style = "color: red">Out of Stock</p>';
                                                    }
                                                    echo '</div>
                                                    <div class="button">
                                                        <p class="unitprice text-center mb-1 mt-3"><span><strong>&pound';
                                if ($data['STOCK'] > 0) {
                                    if ($data['DISCOUNT']) {
                                        $price = ($data['PRICE'] - (($data["DISCOUNT"] / 100) * $data['PRICE'])) * $data['QUANTITY'];
                                        echo number_format($price, 2);
                                    } else {
                                        $price = number_format($data['PRICE'] * $data['QUANTITY'], 2);
                                        echo number_format($price, 2);
                                    }
                                } else {
                                    $price = number_format(0, 2);
                                    echo $price;
                                }
                                $total_price += $price;
                                echo '</strong></span></p>
                                        <div style = "text-align: center;">
                                            <a href="move_product.php?id='.$data['CART_PRODUCT_ID'].'&destination=wishlist" type="button" class="like-item"><i class="fas fa-shopping-cart" id="cart"></i></a>
                                            <a href="delete_cart_product.php?destination=wishlist&id=' . $data['CART_PRODUCT_ID'] . '" type="button" class="remove-item"><i class="fas fa-trash-alt mx-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>';
                                $has_product = true;
                            }
                            if ($has_product == false) {
                                echo '<div style = "height: 225px;display: flex;justify-content: center;align-items: center;"><h5>No product in wishlist</h5></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

            <?php include 'footer.php' ?>
        </div>
        <!--body wrapper ends here-->
    </div>
    <!--container-fluid ends here-->

    <!--bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--bootstrap script-->

    <script src="scripts/main.js"></script>
    <?php
    unset($_SESSION['cart_removed']);
    unset($_SESSION['cart_success']);
    ?>


</body>

</html>