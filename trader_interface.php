<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Manage Product</title>
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
                <span>Manage Products</span>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Product
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add_product.php" method="POST">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" id="product_name" name="product_name" class="form-control" required>
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" id="description" name="description" class="form-control" required>
                                    <label for="price" class="form-label">Price (&pound;)</label>
                                    <input type="text" id="price" name="price" class="form-control" required>
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" id="stock" name="stock" class="form-control" required>
                                    <label for="allergy" class="form-label">Allergy Info</label>
                                    <input type="text" id="allergy" name="allergy" class="form-control">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" id="discount" name="discount" class="form-control">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" id="category" name="category" class="form-control" required>
                                    <label for="shop_id" class="form-label">Shop Id</label>
                                    <input type="number" id="shop_id" name="shop_id" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="product_submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                if (isset($_SESSION['product_success'])) {
                    echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['product_success'] . '</p>';
                }
                else if (isset($_SESSION['product_delete'])) {
                    echo '<p style = "color: red; text-align: center;">' . $_SESSION['product_delete'] . '</p>';
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover product-table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price (&pound;)</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Allergy Info</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Approved</th>
                            <th scope="col">Actions</th>
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
                        $sql = "SELECT * FROM cornerstore.Shop s, cornerstore.Product p WHERE s.shop_id = p.shop_id AND user_id = $id";
                        $result = oci_parse($conn, $sql);
                        oci_execute($result);
                        while ($data = oci_fetch_array($result)) {
                            echo "<tr>
                                <td scope='row'>$data[PRODUCT_ID]</td>
                                <td>$data[PRODUCT_NAME]</td>
                                <td>$data[DESCRIPTION]</td>
                                <td>" . number_format($data['PRICE'], 2) . "</td>
                                <td>$data[STOCK]</td>
                                <td>$data[ALLERGY_INFO]</td>
                                <td>$data[SHOP_NAME]</td>
                                <td>$data[DISCOUNT]</td>
                                <td>$data[APPROVED]</td>
                                <td><a href = 'edit_product_form.php?id=$data[PRODUCT_ID]'>Edit</a><a href = 'delete_product.php?id=$data[PRODUCT_ID]'>Delete</a></td>
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
    <?php
    unset($_SESSION['product_success']);
    unset($_SESSION['product_delete']);
    ?>

</body>

</html>