<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <!--Entire Page Container starts here-->
    <div class="container-fluid">
        <div class="body-wrapper m-0 p-0">
            <?php include 'nav_bar.php' ?>
            <!-- checkout -->
            <?php
                //Display the slot full message
                if (isset($_SESSION['slot_limit']))
                {
                    echo '<p style = "color: red; text-align: center;">' . $_SESSION['slot_limit'] . '</p>';
                }
            ?>
            
            <!-- Form to store and send the collection slot day and time -->
            <form action="insert_order.php" method="POST">
                <section class="checkout">
                    <div class="row mx-2 my-4">
                        <div class="col-md-8">
                            <h4>Pickup Details</h4>
                            <hr class="mt-2 mb-4" />
                            <p class="mb-4">Address: <span style="font-weight: lighter;">Cleckhuddersfax</span></p>
                            <p>Contact: <span style="font-weight: lighter;">053-51115111</span></P>
                            <hr class="mb-3" />
                            <p>Choose Pickup Day</P>
                            <div class="mb-3">
                                <!-- Code to display the allocated slot day and their available slot time -->
                                <?php
                                //Get the date in day, date and month format
                                $date = date('l jS F'); 
                                $count = 0;
                                while ($count < 7) {
                                    //Increment the date by 1 day
                                    $date = date('l jS F', strtotime($date . '+1day'));
                                    //Change the format of date to Oracle standards
                                    $oracle_date = date("m/d/Y", strToTime($date));
                                    $day = date('l', strtotime($date));
                                    if ($day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') {
                                        echo '<div class="form-check form-check-inline">
                                        <input class="form-check-input day-radio" type="radio" name="day" id="'.$count.'" value="'.$oracle_date.'" required />
                                        <label class="form-check-label" for="'.$date.'">'.$date.'</label>
                                    </div>';
                                    }
                                    $count++;
                                }
                                ?>
                            </div>
                            <p>Choose Pickup Time</P>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-time" type="radio" name="time" id="10" value="10am - 1pm" required />
                                    <label class="form-check-label" for="10">10am - 1pm</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-time" type="radio" name="time" id="13" value="1pm - 4pm" required />
                                    <label class="form-check-label" for="13">1pm - 4pm</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-time" type="radio" name="time" id="16" value="4pm - 7pm" required />
                                    <label class="form-check-label" for="16">4pm - 7pm</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Order Summary</h4>
                            <hr class="mt-2 mb-2" />
                            <ul class="list-group list-group-flush">
                                <?php
                                $quantity = $_GET['quantity'];
                                if (isset($_POST['qty']))
                                {
                                    $price = number_format(($_GET['price'] * $_POST['qty']), 2);
                                }
                                else
                                {
                                    $price = $_GET['price'];
                                }    
                                ?>
                                <input type="hidden" name="quantity" value = "<?php echo $quantity; ?>">
                                <input type="hidden" name="price" value = "<?php echo $price; ?>">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    TOTAL QTY:
                                    <span><?php echo $quantity; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    SUBTOTAL:
                                    <span>&pound;<?php echo $price; ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    DISCOUNT:
                                    <span>&pound;0.00</span>
                                </li>
                                <hr class="mt-2 mb-2" />
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    TOTAL:
                                    <span><strong>&pound;<?php echo $price; ?></strong></span>
                                </li>
                            </ul>
                            <p class="mt-5" style="text-align: right;">
                                <button type="button" class="btn btn-primary btn-block mt-1" onclick="window.location.href='cart.php'">Edit Cart</button>
                                <?php
                                    if (isset($_POST['qty']) && isset($_POST['product_id']))
                                    {
                                        echo '<button type="submit" formaction = "insert_order.php?product_id='.$_POST['product_id'].'&quantity='.$_POST['qty'].'" class="btn btn-primary btn-block mt-1 cart-buy">Buy Now</button>';
                                    }
                                    else
                                    {
                                        echo '<button type="submit" class="btn btn-primary btn-block mt-1 cart-buy">Buy Now</button>';
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </section>
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

    <script>
        const day_checkboxes = document.querySelectorAll('.day-radio');
        const time_checkboxes = document.querySelectorAll('.radio-time');
        const checkout_btn = document.querySelector('.cart-buy');
        const currentTime = new Date().getHours();
        day_checkboxes.forEach((dbox, i) => {
            dbox.addEventListener('click', ()=> {
                if (i == 0 && dbox.id == '0') {
                    time_checkboxes.forEach(tbox => {
                        if (tbox.id <= currentTime)
                        {
                            tbox.checked = false;
                            tbox.disabled = true;
                            checkout_btn.style.pointerEvents = 'none';
                        }
                    })
                }
                else
                {
                    time_checkboxes.forEach(tbox => {
                        tbox.disabled = false;
                        checkout_btn.style.pointerEvents = 'all';
                    })
                }
            })
        });
        time_checkboxes.forEach(tbox => {
            tbox.addEventListener('click', ()=> {
                if (tbox.checked == true)
                {
                    checkout_btn.style.pointerEvents = 'all';
                }
            })
        })
    </script>

    <?php
    unset($_SESSION['login_error']);
    unset($_SESSION['slot_limit']);
    ?>

</body>

</html>