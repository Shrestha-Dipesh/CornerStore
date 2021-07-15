<?php
session_start();
if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>CornerStore | Shop</title>
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include 'connection.php';

    //Display the list of products of given category and shop
    $category = $_GET['category'];
    if (isset($_GET['shop'])) {
        $sql = "SELECT * FROM cornerstore.product p, cornerstore.shop s WHERE s.shop_id = p.shop_id AND category = '$category' AND shop_name = '$_GET[shop]'";
    } else {
        $sql = "SELECT * FROM cornerstore.Product WHERE category = '$category'";
    }

    //Display the list of products within the price range
    if (isset($_POST['Submit'])) {
        if (isset($_POST['min']) && isset($_POST['max'])) {
            $min = $_POST['min'];
            $max = $_POST['max'];

            if ($min < $max) {
                $sql = $sql . "AND price >= $min AND price <= $max";
            } else if ($min > $max) {
                echo "<script>alert('Invalid Range')</script>";
            }
        }
    }

    //Sorting the list of products
    if (isset($_POST['arrival'])) {
        $sql = $sql . "ORDER BY product_id DESC";
    } else if (isset($_POST['low'])) {
        $sql = $sql . "ORDER BY price";
    } else if (isset($_POST['high'])) {
        $sql = $sql . "ORDER BY price DESC";
    } else if (isset($_POST['rating'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.product p, cornerstore.shop s, cornerstore.review r WHERE p.shop_id = s.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category ORDER BY avg(rating) DESC";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.product p, cornerstore.review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category ORDER BY avg(rating) DESC";
        }
    }

    //Display the list of products based on selected ratings
    if (isset($_POST['5-star'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Shop s, cornerstore.Review r WHERE s.shop_id = p.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) = 5";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) = 5";
        }
    } else if (isset($_POST['4-star'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Shop s, cornerstore.Review r WHERE s.shop_id = p.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 4";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 4";
        }
    } else if (isset($_POST['3-star'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Shop s, cornerstore.Review r WHERE s.shop_id = p.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 3";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 3";
        }
    } else if (isset($_POST['2-star'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Shop s, cornerstore.Review r WHERE s.shop_id = p.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 2";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 2";
        }
    } else if (isset($_POST['1-star'])) {
        if (isset($_GET['shop'])) {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Shop s, cornerstore.Review r WHERE s.shop_id = p.shop_id AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 1";
        } else {
            $sql = "SELECT r.product_id, product_name, price, stock, discount, category, avg(rating) FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 1";
        }
    }

    $result = oci_parse($conn, $sql);
    oci_execute($result);
    ?>
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0">
            <?php include 'nav_bar.php' ?>
            <div class="shop-container">
                <div class="page-wrapper chiller-theme toggled">
                    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                    <nav id="sidebar" class="sidebar-wrapper">
                        <div class="sidebar-content">
                            <div class="sidebar-brand">
                                <a href="shop.php?category=<?php echo $_GET['category'] ?>">Shop</a>
                                <div id="close-sidebar">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                            <ul class="nav flex-column bg-white mb-0">
                                <?php
                                $sql1 = "SELECT DISTINCT shop_name FROM cornerstore.Product p, cornerstore.Shop s WHERE p.shop_id = s.shop_id AND category = '$_GET[category]'";
                                $result1 = oci_parse($conn, $sql1);
                                oci_execute($result1);
                                if ($result1) {
                                    while ($data = oci_fetch_array($result1)) {
                                        echo "<li class='nav-item'>
                                            <a href='shop.php?category=$_GET[category]&shop=$data[SHOP_NAME]' class='nav-link text-dark'>
                                            $data[SHOP_NAME]
                                            </a>
                                        </li>";
                                    }
                                }
                                ?>
                            </ul>

                            <div class="sidebar-brand mt-3">
                                <a>Ratings</a>
                            </div>
                            <ul class="nav flex-column bg-white mb-0">
                                <form action="" method="POST" class="rating_form">
                                    <li class="nav-item">
                                        <button type="submit" name="5-star" class="nav-link text-dark">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="submit" name="4-star" class="nav-link text-dark">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="far fa-star"></span> & Up
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="submit" name="3-star" class="nav-link text-dark">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span> & Up
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="submit" name="2-star" class="nav-link text-dark">
                                            <span class="fas fa-star"></span>
                                            <span class="fas fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span> & Up
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="submit" name="1-star" class="nav-link text-dark">
                                            <span class="fas fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span>
                                            <span class="far fa-star"></span> & Up
                                        </button>
                                    </li>
                                </form>
                            </ul>

                            <div class="sidebar-brand mt-3">
                                <a>Price Range</a>
                            </div>
                            <form action="" method="POST">
                                <input type="number" name="min" placeholder="Min" value="<?php if (isset($_POST['min'])) echo $_POST['min'] ?>"> -
                                <input type="number" name="max" placeholder="Max" value="<?php if (isset($_POST['max'])) echo $_POST['max'] ?>">
                                <button type="submit" class="submit-btn" name="Submit"><i class="fas fa-play"></i></button>
                            </form>
                        </div>
                    </nav>
                    <!-- sidebar-wrapper  -->
                    <main class="page-content">
                        <!-- Count the total number of products returned -->
                        <div class="result-header">
                            <span class="total_result">
                                <?php
                                $count = 0;
                                while ($data = oci_fetch_array($result)) {
                                    $count++;
                                }
                                if ($count > 0) {
                                    echo $count;
                                } else {
                                    echo "no";
                                } ?> item(s) found for <span><strong>"<?php echo $_GET['category'] ?>"</strong></span>
                            </span>
                            <!-- Dropdown menu for sorting products -->
                            <a class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Sort by:
                                    <?php
                                    // Display the current sort setting
                                    if (isset($_POST['low'])) {
                                        echo $_POST['low'];
                                    } else if (isset($_POST['high'])) {
                                        echo $_POST['high'];
                                    } else if (isset($_POST['rating'])) {
                                        echo $_POST['rating'];
                                    } else if (isset($_POST['arrival'])) {
                                        echo $_POST['arrival'];
                                    } else {
                                        echo "Featured";
                                    }
                                    ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action="" method="POST" class="sort_form">
                                    <li><input type="submit" value="Featured" name="featured" class="dropdown-item"></li>
                                    <li><input type="submit" value="Price: Low to High" name="low" class="dropdown-item"></li>
                                    <li><input type="submit" value="Price: High to Low" name="high" class="dropdown-item"></li>
                                    <li><input type="submit" value="Average Customer Rating" name="rating" class="dropdown-item"></li>
                                    <li><input type="submit" value="Newest Arrival" name="arrival" class="dropdown-item"></li>
                                </form>
                            </ul>
                        </div>
                        <?php
                        if (isset($_SESSION['cart_success'])) {
                            echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['cart_success'] . '</p>';
                        } else if (isset($_SESSION['cart_fail'])) {
                            echo '<p style = "color: red; text-align: center;">' . $_SESSION['cart_fail'] . '</p>';
                        }
                        ?>
                        <div class="result-container">
                            <?php
                            $result5 = oci_parse($conn, $sql);
                            oci_execute($result5);
                            if ($count > 0) {
                                while ($data = oci_fetch_array($result5)) {
                                    echo '<div class="product-container">
                            <div class="pbox">
                                <div class="img-box">
                                <img src="images/' . $data['PRODUCT_NAME'] . '.jpg">
                                    <div class="overlay">
                                        <div class="icons">
                                        <a href = "product_details.php?id=' . $data['PRODUCT_ID'] . '"><i class="mr-2 fas fa-eye"></i></a>';
                                        if (isset($user_id))
                                        {
                                            echo '<a href = "add_to_cart.php?destination=shop.php&category=' . $category . '&id=' . $data['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                        }
                                        else
                                        {
                                            echo '<a href = "unregistered_cart.php?destination=shop.php&category=' . $category . '&id=' . $data['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                        }
                                        echo '</div>
                                    </div>
                                </div>
                                <div class="ratings text-center mt-2">';
                                    // Display the average rating of the product
                                    $sql2 = "SELECT avg(rating) AS avg FROM cornerstore.Review GROUP BY product_id HAVING product_id = $data[PRODUCT_ID]";
                                    $result2 = oci_parse($conn, $sql2);
                                    oci_execute($result2);
                                    $data2 = oci_fetch_array($result2);
                                    if ($data2) {
                                        $rating = $data2['AVG'];
                                        $i = 0;
                                        while ($i < 5) {
                                            if ($rating > 0) {
                                                if ($rating == 0.5) {
                                                    echo '<span class="fas fa-star-half-alt"></span> ';
                                                } else {
                                                    echo '<span class="fas fa-star"></span> ';
                                                }
                                            } else {
                                                echo '<span class="far fa-star"></span> ';
                                            }
                                            $rating--;
                                            $i++;
                                        }
                                    } else {
                                        echo '<span class="far fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="far fa-star"></span>';
                                    }
                                    // Display the total number of ratings
                                    $sql3 = "SELECT count(rating) AS count FROM cornerstore.Review GROUP BY product_id HAVING product_id = $data[PRODUCT_ID]";
                                    $result3 = oci_parse($conn, $sql3);
                                    oci_execute($result3);
                                    $data3 = oci_fetch_array($result3);
                                    if ($data3) {
                                        echo " ($data3[COUNT])";
                                    } else {
                                        echo '(0)';
                                    }

                                    //Display the product stock, name and price
                                    echo '</div>';
                                    if ($data['STOCK'] > 0) {
                                        echo '<p class="text-center" style = "color: #1abc9c;margin-bottom:0;">(' . $data['STOCK'] . ' available)</p>';
                                    } else {
                                        echo '<p class="text-center" style = "color: red;margin-bottom:0;">(Out of Stock)</p>';
                                    }
                                    echo '<h6 class=" mt-2 text-center">' . $data['PRODUCT_NAME'] . '</h6>';
                                    if ($data['DISCOUNT']) {
                                        $price = $data['PRICE'] - ($data['DISCOUNT'] / 100) * $data["PRICE"];
                                        echo '<p class="text-center"  style = "margin-bottom: 0;">&pound' . number_format($price, 2) . '</p>';
                                        echo '<p class="text-center"><del>&pound' . number_format($data['PRICE'], 2) . '</del> (' . $data['DISCOUNT'] . '% Off)</p>';
                                    } else {
                                        echo '<p class="text-center">&pound' . number_format($data['PRICE'], 2) . '</p>';
                                    }
                                    echo '</div>
                                        </div>';
                                }
                            } else {
                                echo "No result found";
                            }
                            ?>
                        </div>
                    </main>
                    <!-- page-content" -->
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <!-- page-wrapper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        jQuery(function($) {

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                    .parent()
                    .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
            });
        });
    </script>

    <?php
    unset($_SESSION['cart_success']);
    unset($_SESSION['cart_fail']);
    ?>
</body>

</html>