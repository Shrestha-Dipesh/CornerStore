<?php
session_start();
include 'connection.php';
if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore</title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    //Check if the role of the user stored in cookie or session is Trader
    if (isset($_COOKIE['role'])) {
        if ($_COOKIE['role'] == 'Trader') {
            header('location: trader_interface.php');
        }
    } else if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'Trader') {
            header('location: trader_interface.php');
        }
    }
    ?>

    <!--Entire Page Container starts here-->
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0">
            <?php include 'nav_bar.php' ?>
            <!--category box and caraousal starts-->
            <div class="container-fluid ">
                <?php
                //Display the success or error message stored in session
                if (isset($_SESSION['cart_success'])) {
                    echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['cart_success'] . '</p>';
                } else if (isset($_SESSION['cart_fail'])) {
                    echo '<p style = "color: red; text-align: center;">' . $_SESSION['cart_fail'] . '</p>';
                }
                ?>
                <!--Carousel Container starts here-->
                <div class="row category-carausal mb-4">
                    <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                        <div class="wrapper-container">
                            <div class="wrapper">
                                <div class="outer">
                                    <!--Category Card starts here-->
                                    <div class="card" style="--delay:-1;">
                                        <div class="content">
                                            <div class="img"><img src="images/bakery.jpg" alt=""></div>
                                            <div class="details">
                                                <span class="name">Bakery</span>
                                            </div>
                                        </div>
                                        <a href="shop.php?category=Bakery">Shop</a>
                                    </div>
                                    <div class="card" style="--delay:0;">
                                        <div class="content">
                                            <div class="img"><img src="images/grocery.jpg" alt=""></div>
                                            <div class="details">
                                                <span class="name">Grocery</span>
                                            </div>
                                        </div>
                                        <a href="shop.php?category=Grocery">Shop</a>
                                    </div>
                                    <div class="card" style="--delay:1;">
                                        <div class="content">
                                            <div class="img"><img src="images/meat.jpg" alt=""></div>
                                            <div class="details">
                                                <span class="name">Meat</span>
                                            </div>
                                        </div>
                                        <a href="shop.php?category=Meat">Shop</a>
                                    </div>
                                    <div class="card" style="--delay:2;">
                                        <div class="content">
                                            <div class="img"><img src="images/delicacy.jpg" alt=""></div>
                                            <div class="details">
                                                <span class="name">Delicacy</span>
                                            </div>
                                        </div>
                                        <a href="shop.php?category=Delicacy">Shop</a>
                                    </div>
                                    <div class="card" style="--delay:2;">
                                        <div class="content">
                                            <div class="img"><img src="images/fish.jpg" alt=""></div>
                                            <div class="details">
                                                <span class="name">Fish</span>
                                            </div>
                                        </div>
                                        <a href="shop.php?category=Fish">Shop</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-9 home-slider">
                        <!--  ol style bottom -80%, a--margin top 15%-->
                        <!--carousal starts-->
                        <div id="carouselExampleCaptions" class="carousel h-50 mb-4 slide" data-bs-ride="carousel">
                            <div style="bottom:-80%" class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/banner1.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/banner2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/banner3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button style="margin-top:15%" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button style="margin-top:15%" class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!--carousal ends-->
                    </div>
                    <!--product display section starts-->
                    <!--Products start here-->
                    <div class="prod my-4 ">
                        <div class="container">
                            <h2 class="h2 my-4 text-center">Top Rated Products</h2>
                            <div class="row products">
                                <div class="multiple-items">
                                    <?php
                                    $sql11 = "SELECT r.product_id, product_name, price, discount, category, avg(rating) as avg FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id GROUP BY r.product_id, product_name, price, discount, category ORDER BY avg(rating) DESC";
                                    $result11 = oci_parse($conn, $sql11);
                                    oci_execute($result11);
                                    $count = 1;
                                    while ($data11 = oci_fetch_array($result11)) {
                                        if ($count <= 6) {
                                            echo '<div id="product">
                                            <div class="product-container" id="product-slide">
                                                <div class="pbox">
                                                    <div class="img-box">
                                                        <img src="images/' . $data11['PRODUCT_NAME'] . '.jpg">
                                                        <div class="overlay">
                                                            <div class="icons">
                                                            <a href = "product_details.php?id=' . $data11['PRODUCT_ID'] . '"><i class="mr-2 fas fa-eye"></i></a>';
                                                            if (isset($user_id))
                                                            {
                                                                echo '<a href = "add_to_cart.php?destination=index.php&id=' . $data11['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                                            }
                                                            else
                                                            {
                                                                echo '<a href = "unregistered_cart.php?destination=index.php&id=' . $data11['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                                            }
                                                            echo '</div>
                                                        </div>
                                                    </div>
                                                    <div class="ratings text-center mt-2">';
                                            if ($data11) {
                                                $rating = $data11['AVG'];
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
                                            echo '</div>
                                                    <h6 class=" mt-2 text-center">' . $data11['PRODUCT_NAME'] . '</h6>';
                                            if ($data11['DISCOUNT']) {
                                                $price = $data11['PRICE'] - ($data11['DISCOUNT'] / 100) * $data11["PRICE"];
                                                echo '<p class="text-center" style = "margin-bottom: 0;">&pound' . number_format($price, 2) . '</p>';
                                                echo '<p class="text-center"><del>&pound' . number_format($data11['PRICE'], 2) . '</del> (' . $data11['DISCOUNT'] . '% Off)</p>';
                                            } else {
                                                echo '<p class="text-center">&pound' . number_format($data11['PRICE'], 2) . '</p>';
                                            }

                                            echo '</div>
                                            </div>
                                        </div>';
                                        } else {
                                            break;
                                        }
                                        $count++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--products ends here-->
                    <!--product display section ends-->
                    <!--Products start here-->
                    <div class="prod">
                        <h3 class="h2 text-center my-4">Explore Products</h3>
                        <div class="row products my-4 more-products">

                            <?php
                            $sql1 = "SELECT r.product_id, product_name, price, discount, category, avg(rating) as avg FROM cornerstore.Product p, cornerstore.Review r WHERE p.product_id = r.product_id GROUP BY r.product_id, product_name, price, discount, category";
                            $result1 = oci_parse($conn, $sql1);
                            oci_execute($result1);
                            $count = 1;
                            while ($data = oci_fetch_array($result1)) {
                                if ($count <= 12) {
                                    echo '<div class="product-container">
                                        <div class="pbox">
                                            <div class="img-box">
                                                <img src="images/' . $data['PRODUCT_NAME'] . '.jpg" alt = "' . $data['PRODUCT_NAME'] . '">
                                                <div class="overlay">
                                                    <div class="icons">
                                                        <a href = "product_details.php?id=' . $data['PRODUCT_ID'] . '"><i class="mr-2 fas fa-eye"></i></a>';
                                                        if (isset($user_id))
                                                            {
                                                                echo '<a href = "add_to_cart.php?destination=index.php&id=' . $data['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                                            }
                                                            else
                                                            {
                                                                echo '<a href = "unregistered_cart.php?destination=index.php&id=' . $data['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                                            }
                                                    echo '</div>
                                                </div>
                                            </div>
                                            <div class="ratings text-center mt-2">';
                                    if ($data) {
                                        $rating = $data['AVG'];
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
                                    echo '</div>
                                            <h6 class=" mt-2 text-center">' . $data['PRODUCT_NAME'] . '</h6>';
                                    if ($data['DISCOUNT']) {
                                        $price = $data['PRICE'] - ($data['DISCOUNT'] / 100) * $data["PRICE"];
                                        echo '<p class="text-center" style = "margin-bottom: 0;">&pound' . number_format($price, 2) . '</p>';
                                        echo '<p class="text-center"><del>&pound' . number_format($data['PRICE'], 2) . '</del> (' . $data['DISCOUNT'] . '% Off)</p>';
                                    } else {
                                        echo '<p class="text-center">&pound' . number_format($data['PRICE'], 2) . '</p>';
                                    }
                                    echo '</div>
                                    </div>';
                                    $count++;
                                } else {
                                    break;
                                }
                            }
                            ?>
                        </div>
                        <i class="fas fa-chevron-down load-more"></i>
                    </div>
                    <!--products ends here-->
                </div>
            </div>
            <div class="flash-sales">
                <a href="shop.php?category=Bakery"><img src="images/sales.png" alt="Flash Sales"></a>
                <div class="countdown">

                    <div class="countdown-block">
                        <span class="days time-elem">
                            <span class="top">00</span>
                            <span class="top-back">
                                <span>00</span>
                            </span>
                            <span class="bottom">00</span>
                            <span class="bottom-back">
                                <span>00</span>
                            </span>
                        </span>
                        <span class="title">Days</span>
                    </div>


                    <div class="countdown-block">
                        <span class="hours time-elem">
                            <span class="top">00</span>
                            <span class="top-back">
                                <span>00</span>
                            </span>
                            <span class="bottom">00</span>
                            <span class="bottom-back">
                                <span>00</span>
                            </span>
                        </span>
                        <span class="title">Hours</span>
                    </div>


                    <div class="countdown-block">
                        <span class="minutes time-elem">
                            <span class="top">00</span>
                            <span class="top-back">
                                <span>00</span>
                            </span>
                            <span class="bottom">00</span>
                            <span class="bottom-back">
                                <span>00</span>
                            </span>
                        </span>
                        <span class="title">Minutes</span>
                    </div>

                    <div class="countdown-block">
                        <span class="seconds time-elem">
                            <span class="top">00</span>
                            <span class="top-back">
                                <span>00</span>
                            </span>
                            <span class="bottom">00</span>
                            <span class="bottom-back">
                                <span>00</span>
                            </span>
                        </span>
                        <span class="title">Seconds</span>
                    </div>

                </div>
            </div>

            <!--category box and carausal ends-->
            <?php include 'footer.php' ?>
        </div>
        <!--body wrapper ends here-->
    </div>
    <!--container-fluid ends here-->

    <!--bootstrap script-->
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--bootstrap script-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>

    <script src="scripts/main.js"></script>
    <!--Top rated product slide-->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.multiple-items').slick({
            nextArrow: '<span class="next-arrow"><i class="fas fa-chevron-right"></i></span>',
            prevArrow: '<span class="prev-arrow"><i class="fas fa-chevron-left"></i></span>',

            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1068,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 668,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
    <?php
        unset($_SESSION['cart_success']);
        unset($_SESSION['cart_fail']);
    ?>

</body>

</html>