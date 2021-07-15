<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Edit Product</title>
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
            <h3 class="h3 ps-4 text-center mt-4 mb-4">Edit Product</h3>
            <form action="edit_product.php" method="POST" class = "edit_product_form">
                <?php
                    include 'connection.php';
                    $product_id = $_GET['id'];
                    $sql = "SELECT * FROM cornerstore.product WHERE product_id = $product_id";
                    $result = oci_parse($conn, $sql);
                    oci_execute($result);
                    $data = oci_fetch_array($result);
                ?>
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value = "<?php if (isset($data['PRODUCT_NAME'])) echo $data['PRODUCT_NAME']; ?>" required>
                <input type="hidden" name="product_id" value = "<?php echo $product_id; ?>">
                <label for="description" class="form-label">Description</label>
                <input type="text" id="description" name="description" class="form-control" value = "<?php if (isset($data['DESCRIPTION'])) echo $data['DESCRIPTION']; ?>" required>
                <label for="price" class="form-label">Price</label>
                <input type="text" id="price" name="price" class="form-control" value = "<?php if (isset($data['PRICE'])) echo number_format($data['PRICE'], 2); ?>" required>
                <label for="stock" class="form-label">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" value = "<?php if (isset($data['STOCK'])) echo $data['STOCK']; ?>" required>
                <label for="allergy" class="form-label">Allergy Info</label>
                <input type="text" id="allergy" name="allergy" class="form-control" value = "<?php if (isset($data['ALLERGY_INFO'])) echo $data['ALLERGY_INFO']; ?>">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" id="discount" name="discount" class="form-control" value = "<?php if (isset($data['DISCOUNT'])) echo $data['DISCOUNT']; ?>">
                <label for="category" class="form-label">Category</label>
                <input type="text" id="category" name="category" class="form-control" value = "<?php if (isset($data['CATEGORY'])) echo $data['CATEGORY']; ?>" required>
                <label for="shop_id" class="form-label">Shop Id</label>
                <input type="number" id="shop_id" name="shop_id" class="form-control" value = "<?php if (isset($data['SHOP_ID'])) echo $data['SHOP_ID']; ?>" required>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='trader_interface.php'">Close</button>
            <button type="submit" name="product_submit" class="btn btn-primary">Save Changes</button>
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