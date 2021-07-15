<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Edit Shop</title>
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
            <h3 class="h3 ps-4 text-center mt-4 mb-4">Edit Shop</h3>
            <form action="edit_shop.php" method="POST" class = "trader_form edit_product_form">
                <?php
                include 'connection.php';
                $shop_id = $_GET['id'];
                $sql = "SELECT * FROM cornerstore.shop WHERE shop_id = $shop_id";
                $result = oci_parse($conn, $sql);
                oci_execute($result);
                $data = oci_fetch_array($result);
                ?>
                <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                <label for="shop_name" class="form-label">Shop Name</label>
                <input type="text" id="shop_name" name="shop_name" class="form-control" value="<?php if (isset($data['SHOP_NAME'])) echo $data["SHOP_NAME"]; ?>" required>
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" value="<?php if (isset($data['ADDRESS'])) echo $data["ADDRESS"]; ?>" class="form-control" required>
                <label for="shop_name" class="form-label">Contact</label>
                <input type="text" id="contact" name="contact" class="form-control" value="<?php if (isset($data['CONTACT'])) echo $data["CONTACT"]; ?>" required>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='manage_shop.php'">Close</button>
                    <button type="submit" name="shop_submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
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
    unset($_SESSION['login_error']);
    ?>

</body>

</html>