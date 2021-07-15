<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Manage Shop</title>
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
                <span>Manage Shops</span>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Shop
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add_shop.php" method="POST">
                                    <label for="shop_name" class="form-label">Shop Name</label>
                                    <input type="text" id="shop_name" name="shop_name" class="form-control" required>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                    <label for="shop_name" class="form-label">Contact</label>
                                    <input type="text" id="contact" name="contact" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="shop_submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['shop_success'])) {
                echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['shop_success'] . '</p>';
            } else if (isset($_SESSION['shop_delete'])) {
                echo '<p style = "color: red; text-align: center;">' . $_SESSION['shop_delete'] . '</p>';
            }
            ?>
            <div class="table-responsive" style="min-height: 232px">
                <table class="table table-striped table-hover shop-table">
                    <thead>
                        <tr>
                            <th scope="col">Shop Id</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Shop No</th>
                            <th scope="col">Shop Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Authorized</th>
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
                        $sql = "SELECT * FROM cornerstore.Shop WHERE user_id = $id";
                        $result = oci_parse($conn, $sql);
                        oci_execute($result);
                        while ($data = oci_fetch_array($result)) {
                            echo "<tr>
                                <td scope='row'>$data[SHOP_ID]</td>
                                <td>$data[USER_ID]</td>
                                <td>$data[SHOP_NO]</td>
                                <td>$data[SHOP_NAME]</td>
                                <td>$data[ADDRESS]</td>
                                <td>$data[CONTACT]</td>
                                <td>$data[AUTHORIZED]</td>
                                <td><a href = 'edit_shop_form.php?id=$data[SHOP_ID]'>Edit</a><a href = 'delete_shop.php?id=$data[SHOP_ID]'>Delete</a></td>
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
    unset($_SESSION['shop_success']);
    unset($_SESSION['shop_delete']);
    ?>

</body>

</html>