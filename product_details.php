<?php
//Start the session to store and retrieve the variables stored in session
session_start();
//Include connection.php to connect to Oracle database
include_once 'connection.php';

//Get the user id stored in cookie or session
if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

//Retrieve the cart id from the database if the user is logged in
if (isset($user_id))
{
    $statement200 = "SELECT cart_id FROM cornerstore.cart WHERE user_id = $user_id";
    $result200 = oci_parse($conn, $statement200);
    oci_execute($result200);
    $data200 = oci_fetch_array($result200);
}

//Get the product id from the url
$id = $_GET['id'];

//Query to fetch all the details of the selected product with reviews
$sql = "SELECT r.product_id, product_name, shop_name, price, discount, category, stock, description, allergy_info, avg(rating) as avg FROM cornerstore.Product p, cornerstore.Review r, cornerstore.Shop s WHERE p.product_id = r.product_id AND s.shop_id = p.shop_id GROUP BY r.product_id, product_name, shop_name, price, discount, category,  stock, description, allergy_info HAVING r.product_id = $id";
$result = oci_parse($conn, $sql);
oci_execute($result);
$data = oci_fetch_array($result);

//Query to fetch all the details of the selected product without reviews
if (!$data) {
    $sql = "SELECT * FROM cornerstore.Product p, cornerstore.Shop s WHERE s.shop_id = p.shop_id AND p.product_id = $id";
    $result = oci_parse($conn, $sql);
    oci_execute($result);
    $data = oci_fetch_array($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | <?php echo $data['PRODUCT_NAME'] ?></title>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <div class="overlays">
        <div class="popup">
            <img src="images/pop-up.png" alt="popup">
            <div class="content">
                <p>Your review was sucessful.</p>
                <button type="button" class="btn btn-primary btn-block cancel">Cancel</button>
            </div>
        </div>
    </div>
    <div class="overlays-second">
        <div class="popup">
            <img src="images/pop-up-alt.png" alt="popup">
            <div class="content">
                <p>Your have already reviewed this product.</p>
                <button type="button" class="btn btn-primary btn-block cancel2">Cancel</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0 desc-wrapper">
            <?php include 'nav_bar.php' ?>
            <div class="container mt-5 pt-5 details-container">
                <?php
                if (isset($_SESSION['cart_success'])) {
                    echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['cart_success'] . '</p>';
                } else if (isset($_SESSION['cart_fail'])) {
                    echo '<p style = "color: red; text-align: center;">' . $_SESSION['cart_fail'] . '</p>';
                }
                ?>
                <?php $result1 = oci_parse($conn, $sql);
                oci_execute($result1);
                $data1 = oci_fetch_array($result1);
                ?>
                <div id="content-wrapper" class = "main-content-wrapper">
                    <div class="column">
                        <div id="img-container">
                            <img id=featured src="images/<?php echo $data1['PRODUCT_NAME']; ?>.jpg" alt="<?php echo $data1['PRODUCT_NAME']; ?>">
                        </div>
                        <div id="slider-wrapper">
                            <img id="slideLeft" class="arrow" src="images/left.png">
                            <div id="slider">
                                <img class="thumbnail active" src="images/<?php echo $data1['PRODUCT_NAME']; ?>.jpg" alt="<?php echo $data1['PRODUCT_NAME']; ?>">
                                <?php
                                $query = "SELECT image_name FROM cornerstore.image WHERE product_id = $id";
                                $result3 = oci_parse($conn, $query);
                                oci_execute($result3);
                                while ($data3 = oci_fetch_array($result3)) {
                                    echo '<img class="thumbnail" src="images/' . $data3['IMAGE_NAME'] . '.jpg" alt = "' . $data1["PRODUCT_NAME"] . '">';
                                }
                                ?>
                            </div>
                            <img id="slideRight" class="arrow" src="images/right.png">
                        </div>
                    </div>

                    <div class="column2">

                        <h2><?php echo $data1['PRODUCT_NAME']; ?></h2>
                        <h4><strong>Shop: </strong><?php echo $data1['SHOP_NAME']; ?></h4>
                        <?php
                        if ($data1 && isset($data1["AVG"])) {
                            $rating = $data1['AVG'];
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
                        ?>
                        <?php
                        $sql2 = "SELECT count(rating) AS count FROM cornerstore.Review GROUP BY product_id HAVING product_id = $data1[PRODUCT_ID]";
                        $result2 = oci_parse($conn, $sql2);
                        oci_execute($result2);
                        $data2 = oci_fetch_array($result2);
                        if ($data2) {
                            echo "<span class = 'rating'>($data2[COUNT])</span>";
                        } else {
                            echo '<span class = "rating">(0)</span>';
                        }
                        if (isset($user_id))
                        {
                            $statement300 = "SELECT * FROM cornerstore.cart_product WHERE cart_id = $data200[CART_ID] AND product_id = $_GET[id] AND wishlist = 'True'";
                            $result300 = oci_parse($conn, $statement300);
                            oci_execute($result300);
                            $data300 = oci_fetch_array($result300);
                            if ($data300)
                            {
                                echo '<a href = "add_to_wishlist.php?product_id='.$_GET['id'].'&cart_id='.$data200['CART_ID'].'"><i class = "fas fa-heart wishlist-heart"></i></a>';
                            }
                            else
                            {
                                echo '<a href = "add_to_wishlist.php?product_id='.$_GET['id'].'&cart_id='.$data200['CART_ID'].'"><i class = "far fa-heart wishlist-heart"></i></a>';
                            }
                        }
                        ?>
                        <br>
                        <hr>
                        <?php
                        if ($data1['DISCOUNT']) {
                            $price = $data1['PRICE'] - ($data1['DISCOUNT'] / 100) * $data1["PRICE"];
                            echo '<h5 class="main-price"><strong>&pound' . number_format($price, 2) . '</strong></h5>';
                            echo '<p><del>&pound' . number_format($data1['PRICE'], 2) . '</del> (' . $data1['DISCOUNT'] . '% Off)</p>';
                        } else {
                            $price = number_format($data1['PRICE'], 2);
                            echo '<h5 class="main-price">&pound' . $price . '</h5>';
                        }
                        ?>
                        <?php
                        if ($data1['STOCK'] != 0) {
                            if ($data1['STOCK'] > 20) {
                                echo "<h5><strong style = 'color: #1abc9c;'>In Stock ($data1[STOCK]).</strong> Limit 20 per Customer</h5>";
                            } else {
                                echo "<h5><strong style = 'color: #1abc9c;'>In Stock ($data1[STOCK]).</strong> Limit $data1[STOCK] per Customer</h5>";
                            }
                        } else {
                            echo "<h5 style = 'color: red;'><strong>Out of Stock</strong></h5>";
                        }
                        ?>
                        <form action="add_to_cart.php?id=<?php echo $id; ?>" method="POST">
                            <div class="qty">
                                <h5><strong>Quantity:</strong></h5>
                                <span class="minus bg-light">-</span>

                                <input type="number" class="count" name="qty" value="1" min="1" max="20" style="pointer-events:none;">
                                <input type="hidden" name="stock" class="stock" value="<?php echo $data1['STOCK'] ?>">
                                <span class="plus bg-light">+</span>
                            </div>
                            <input type="hidden" name="product_id" value = "<?php echo $data1['PRODUCT_ID']; ?>">
                            <?php
                                if (!isset($user_id))
                                {
                                    echo '<button type="submit" name="add_cart" formaction="unregistered_cart.php" class="btn btn-primary btn-block mt-3">Add to cart</button>
                                    <button type="button" class="btn btn-primary btn-block mt-3">Buy Now</button>';
                                }
                                else
                                {
                                    echo '<button type="submit" name="add_cart" class="btn btn-primary btn-block mt-3">Add to cart</button>
                                    <button type="submit" formaction="checkout.php?quantity=1&price='.$price.'" class="btn btn-primary btn-block mt-3">Buy Now</button>';
                                }
                            ?>
                        </form>
                    </div>
                </div>

                <div class="classic-tabs mt-4">
                    <ul class="tabs">
                        <li class="tab active" data-content-id="tab-content-1">Description</li>
                        <li class="tab" data-content-id="tab-content-2">Allergy Information</li>
                        <li class="tab" data-content-id="tab-content-3">Ratings</li>
                    </ul>

                    <div id="tab-content-1" class="tab-content active">
                        <p>
                            <?php echo $data1['DESCRIPTION']; ?>
                        </p>
                    </div>
                    <div id="tab-content-2" class="tab-content">
                        <p>
                            <?php if ($data1['ALLERGY_INFO']) echo $data1['ALLERGY_INFO'];
                            else echo "No Information to provided" ?>
                        </p>
                    </div>
                    <div id="tab-content-3" class="tab-content">
                        <div class="row ms-md-2">
                            <div class="col-md-3 col-sm-6 prod-rate">
                                <h2 class="d-inline"><?php if (isset($data1['AVG'])) echo number_format($data1['AVG'], 1);
                                else echo '0' ?></h2>
                                <h5 class="d-inline">out of 5 star </h5> <br>
                                <?php
                                if ($data1 && isset($data1['AVG'])) {
                                    $rating = $data1['AVG'];
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
                                if ($data2) {
                                    echo "<span class = 'rating'>($data2[COUNT])</span>";
                                } else {
                                    echo '<span class = "rating">(0)</span>';
                                }
                                ?>

                            </div>
                            <div class="col-md-3 col-sm-6 prod-rate">
                                <h3>Ratings</h3>
                                <div id="rating-1">
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                </div>
                                <div id="rating-2">
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate far fa-star"></span>
                                </div>
                                <div id="rating-3">
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                </div>
                                <div id="rating-4">
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                </div>
                                <div id="rating-5">
                                    <span class="rate fas fa-star checked"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                    <span class="rate far fa-star"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $sql4 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM cornerstore.Review WHERE product_id = $id and round(rating) = 5 GROUP BY rating";
                                $sql5  = "SELECT count(*) AS Total FROM cornerstore.review WHERE product_id = $id";
                                $result5 = oci_parse($conn, $sql5);
                                oci_execute($result5);
                                $data5 = oci_fetch_array($result5);

                                $result4 = oci_parse($conn, $sql4);
                                oci_execute($result4);
                                $data4 = oci_fetch_array($result4);

                                if ($data4) {
                                    $actualRating = ($data4['COUNT'] / $data5['TOTAL']) * 100;
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ' . $actualRating . '%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . $actualRating . '%</div>
                                        </div>';
                                } else {
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                    </div>';
                                }

                                $sql6 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM cornerstore.Review WHERE product_id = $id and round(rating) = 4 GROUP BY rating";
                                $result6 = oci_parse($conn, $sql6);
                                oci_execute($result6);
                                $data6 = oci_fetch_array($result6);
                                if ($data6) {
                                    $actualRating = ($data6['COUNT'] / $data5['TOTAL']) * 100;
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ' . $actualRating . '%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . $actualRating . '%</div>
                                        </div>';
                                } else {
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                    </div>';
                                }

                                $sql7 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM cornerstore.Review WHERE product_id = $id and round(rating) = 3 GROUP BY rating";
                                $result7 = oci_parse($conn, $sql7);
                                oci_execute($result7);
                                $data7 = oci_fetch_array($result7);

                                if ($data7) {
                                    $actualRating = ($data7['COUNT'] / $data5['TOTAL']) * 100;
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ' . $actualRating . '%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . $actualRating . '%</div>
                                        </div>';
                                } else {
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>';
                                }

                                $sql8 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM cornerstore.Review WHERE product_id = $id and round(rating) = 2 GROUP BY rating";
                                $result8 = oci_parse($conn, $sql8);
                                oci_execute($result8);
                                $data8 = oci_fetch_array($result8);

                                if ($data8) {
                                    $actualRating = ($data8['COUNT'] / $data5['TOTAL']) * 100;
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ' . $actualRating . '%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . $actualRating . '%</div>
                                        </div>';
                                } else {
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>';
                                }

                                $sql9 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM cornerstore.Review WHERE product_id = $id and round(rating) = 1 GROUP BY rating";
                                $result9 = oci_parse($conn, $sql9);
                                oci_execute($result9);
                                $data9 = oci_fetch_array($result9);

                                if ($data9) {
                                    $actualRating = ($data9['COUNT'] / $data5['TOTAL']) * 100;
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: ' . $actualRating . '%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' . $actualRating . '%</div>
                                        </div>';
                                } else {
                                    echo '<div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>';
                                }
                                ?>


                            </div>
                        </div>
                        <h5 class="review-h5">Customer Reviews</h5>
                        <div class="customer-reviews">

                            <?php
                            $sql10 = "SELECT user_name, rating, comments FROM cornerstore.Review r, cornerstore.Users u WHERE u.user_id = r.user_id AND product_id = $id ORDER BY rating DESC";
                            $result10 = oci_parse($conn, $sql10);
                            oci_execute($result10);
                            $comment = false;
                            while ($data10 = oci_fetch_array($result10)) {
                                if ($data10) {
                                    if ($data10['COMMENTS']) {
                                        $comment = true;
                                        echo '<div class="individual-review">
                                        <div class="top-user">
                                            <img src="images/user.png" alt="user">
                                            <span>' . $data10['USER_NAME'] . '</span>
                                        </div>
                                        <div>';
                                        if ($data10) {
                                            $rating = $data10['RATING'];
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
                                        <p>' . $data10['COMMENTS'] . '</p>
                                    </div>';
                                    }
                                } else {
                                    $comment = false;
                                }
                            }
                            if ($comment == false) {
                                echo 'No reviews yet';
                            }
                            ?>
                            <div class="user-review">
                                <h5 class="review-h5">Review this product</h5>
                                <?php
                                if (isset($user_id)) {
                                    echo '<form method = "POST" action = "review.php"><div id="content-wrapper">
                                        <div class="column2">
                                            <div class="rate-area">
                                                <input type="radio" id="5-star" name="rating" value="5" required /><label for="5-star" title="Amazing">5 stars</label>
                                                <input type="radio" id="4-star" name="rating" value="4" required /><label for="4-star" title="Good">4 stars</label>
                                                <input type="radio" id="3-star" name="rating" value="3" required /><label for="3-star" title="Average">3 stars</label>
                                                <input type="radio" id="2-star" name="rating" value="2" required /><label for="2-star" title="Not Good">2 stars</label>
                                                <input type="radio" id="1-star" name="rating" value="1" required /><label for="1-star" title="Bad">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type = "hidden" name = "product_id" value = "' . $id . '">
                                    <input type = "hidden" name = "user_id" value = "' . $user_id . '">
                                    <textarea name="comments" id="comments" placeholder="Write a review"></textarea><br>
                                    <button type="submit" class="btn btn-primary btn-block" name = "review_submit"style = "float: right;">Submit</button></form>';
                                } else {
                                    echo "<p><a href = 'login_form.php'>Login</a> or <a href = 'register_form.php'>Register</a> to give review.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prod my-0 desc-prod">
                    <div class="container">
                        <h5 class="view mt-5">People who bought this item also bought</h5>
                        <div class="row products">
                            <div class="multiple-items">
                                <?php
                                $sql11 = "SELECT r.product_id, product_name,category, price, discount, AVG(rating) AS avg FROM cornerstore.Product p, cornerstore.Review r where p.product_id = r.product_id AND r.product_id != $id GROUP BY r.product_id, product_name, category, price, discount ORDER BY dbms_random.value";
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
                                                                echo '<a href = "add_to_cart.php?destination=product_details.php&product_id='.$_GET['id'].'&id=' . $data11['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
                                                            }
                                                            else
                                                            {
                                                                echo '<a href = "unregistered_cart.php?destination=product_details.php&product_id='.$_GET['id'].'&id=' . $data11['PRODUCT_ID'] . '"><i class=" mr-2 fas fa-x fa-cart-plus"></i></a>';
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

                            <!--<img id="Right" class="arrow" src="images/right.png">-->
                            <!-- <button id="right" class="arrow"><i class="fas fa-chevron-right"></i></button>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
        <!--body wrapper ends here-->
    </div>
    <!--container-fluid ends here-->

    <?php
    if (isset($_SESSION['review_status'])) {
        if ($_SESSION['review_status'] == 'true') {
            echo '<script>
                    const modal = document.querySelector(".overlays");
                    modal.style.opacity = 1;
                    modal.style.pointerEvents = "all";
                </script>';
        } else if ($_SESSION['review_status'] == 'false') {
            echo '<script>
                    const modal2 = document.querySelector(".overlays-second");
                    modal2.style.opacity = 1;
                    modal2.style.pointerEvents = "all";
                </script>';
        }
    }
    ?>

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
    unset($_SESSION['login_error']);
    unset($_SESSION['review_status']);
    unset($_SESSION['cart_success']);
    unset($_SESSION['cart_fail']);
    ?>

    <script>
        const button = document.querySelector('.cancel');
        const button2 = document.querySelector('.cancel2');
        button.addEventListener('click', function() {
            modal.style.opacity = 0;
            modal.style.pointerEvents = 'none';
        });
        button2.addEventListener('click', function() {
            modal2.style.opacity = 0;
            modal2.style.pointerEvents = 'none';
        });
    </script>

</body>

</html>