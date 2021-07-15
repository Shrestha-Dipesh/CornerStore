<div class="top d-flex pt-1 align-items-center main-navbar">
    <div class="logo">
        <a href="trader_interface.php"><img src="images/logo_text.png" alt="website-logo" id="logo"></a>
    </div>

    <div class="btns ms-auto d-flex align-items-center">
        <?php
        if (isset($_COOKIE['id'])) {
            $id = $_COOKIE['id'];
        } else if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
        }
        if (isset($_COOKIE['name']) || isset($_SESSION['name'])) {
            if (isset($_COOKIE['name'])) {
                $name = explode(' ', $_COOKIE['name']);
            } else if (isset($_SESSION['name'])) {
                $name = explode(' ', $_SESSION['name']);
            }

            echo '<div class="dropdown top-dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class = "fas fa-user-circle"></i> ' .
                    $name[0]
                    . '</a>
                
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="trader_profile.php?id=' . $id . '"><i class = "fas fa-cog"></i> Manage Profile</a></li>
                    <li><a class="dropdown-item" href="manage_shop.php"><i class = "fas fa-store-alt"></i> Manage Shops</a></li>
                    <li><a class="dropdown-item" href="trader_interface.php"><i class = "fas fa-archive"></i> Manage Products</a></li>
                    <li><a class="dropdown-item" href="view_order.php"><i class = "fas fa-box-open"></i> View Orders</a></li>
                    <li><a class="dropdown-item" href="logout.php"><i class = "fas fa-sign-out-alt"></i> Logout</a></li>

                    </ul>
                </div>';
        } else {
        ?>
            <a href="login_form.php" class="log">Login</a>
            <a href="register_form.php" class="reg">Sign Up</a>
        <?php
        }
        ?>
    </div>
</div>