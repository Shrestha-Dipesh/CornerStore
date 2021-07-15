<div class="top d-flex pt-1 align-items-center main-navbar">
    <div class="logo">
        <a href = "index.php"><img src="images/logo_text.png" alt="website-logo" id="logo"></a>
    </div>
    <form class="ms-auto search-container" action="search.php" id = "my_form" method = "GET">
        <input type="text" placeholder="Search…" name="keyword" value = "<?php if (isset($_SESSION['keyword'])) echo $_SESSION['keyword']; ?>">
        <a href="javascript:{}" onclick="document.getElementById('my_form').submit();" class = "search-button"><i class="fas fa-search search-icon"></i></a>
    </form>
    
    <div class="btns ms-auto d-flex align-items-center">
        <?php
        if (isset($_COOKIE['id']))
        {
            $nav_user_id = $_COOKIE['id'];
        }
        else if (isset($_SESSION['id']))
        {
            $nav_user_id = $_SESSION['id'];
        }
        if (isset($_COOKIE['name']) || isset($_SESSION['name'])) {
            if (isset($_COOKIE['name']))
            {
                $name = explode(' ', $_COOKIE['name']);
            }
            else if (isset($_SESSION['name']))
            {
                $name = explode(' ', $_SESSION['name']);
            }
            
            echo '<div class="dropdown top-dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class = "fas fa-user-circle" style = "font-size: 20px;transform: translateY(2px)";></i> '.
              $name[0]
            .'</a>
          
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="customer_profile.php?id='.$nav_user_id.'"><i class = "fas fa-cog"></i> Manage Profile</a></li>
              <li><a class="dropdown-item" href="customer_order.php"><i class = "fas fa-box-open"></i> My Orders</a></li>
              <li><a class="dropdown-item" href="wishlist.php"><i class = "fas fa-heart"></i> My WishList</a></li>
              <li><a class="dropdown-item" href="customer_review.php"><i class = "fas fa-comments"></i> My Reviews</a></li>
              <li><a class="dropdown-item" href="#"><i class = "far fa-times-circle"></i> My Returns & Cancellations</a></li>
              <li><a class="dropdown-item" href="logout.php"><i class = "fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
          </div>';
        } else {
        ?>
            <a href="login_form.php" class = "log">Login</a>
            <a href="register_form.php" class = "reg">Sign Up</a>
        <?php
        }
        ?>
        <div class="cart-icon">
            <?php 
                include 'connection.php';
                if (isset($nav_user_id))
                {
                    $nav_sql = "SELECT COUNT(*) AS COUNT FROM cornerstore.cart_product WHERE wishlist = 'False' AND cart_id = (SELECT cart_id FROM cornerstore.cart WHERE user_id = $nav_user_id)";
                    $nav_result = oci_parse($conn, $nav_sql);
                    oci_execute($nav_result);
                    $nav_data = oci_fetch_array($nav_result);
                    $count = $nav_data['COUNT'];
                }
                else
                {
                    if (isset($_SESSION['product']))
                    {
                        $count = count($_SESSION['product']);
                    }
                    else
                    {
                        $count = 0;
                    }
                }
            ?>
            <span class = "cart_quantity"><?php echo $count; ?></span>
            <a class="me-3" href="cart.php"><i class="fab fa-opencart cart"></i></a>
        </div>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-light bg-none secondary-navbar">
    <div class="container-fluid p-0 m-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-4">
                <li class="nav-item me-4">
                    <a class="nav-link ps-0" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Shop
                    </a>
                    <ul class="dropdown-menu m-0 p-0" aria-labelledby="navbarDropdownMenuLink">
                    <?php
                            include 'connection.php';
                            $nav_sql1 = "SELECT DISTINCT category, shop_name FROM cornerstore.product p, cornerstore.shop s WHERE p.shop_id = s.shop_id";
                            $nav_result1 = oci_parse($conn, $nav_sql1);
                            oci_execute($nav_result1);
                            while ($nav_data1 = oci_fetch_array($nav_result1))
                            {
                                echo '<li><a class="dropdown-item" href="shop.php?category='.$nav_data1['CATEGORY'].'&shop='.$nav_data1['SHOP_NAME'].'">'.$nav_data1['SHOP_NAME'].'</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu m-0 p-0" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="shop.php?category=Bakery"><img src = 'images/bakery.jpg' style = "width: 50px; height:50px;border-radius: 50%;"> Bakery</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=Grocery"><img src = 'images/grocery.jpg' style = "width: 50px; height:50px;border-radius: 50%;"> Grocery</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=Meat"><img src = 'images/meat.jpg' style = "width: 50px; height:50px;border-radius: 50%;"> Meat</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=Delicacy"><img src = 'images/delicacy.jpg' style = "width: 50px; height:50px;border-radius: 50%;"> Delicacy</a></li>
                        <li><a class="dropdown-item" href="shop.php?category=Fish"><img src = 'images/fish.jpg' style = "width: 50px; height:50px;border-radius: 50%;"> Fish</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>