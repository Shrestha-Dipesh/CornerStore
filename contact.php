<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CornerStore | Contact</title>
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
            <?php include 'nav_bar.php' ?>
            <section class="contact_page mt-2">
                <div class="container">
                    <div class="content">
                        <h2>Contact</h2>
                        <p>Got questions? We would love to hear from you. Send us message and we will respond to it
                            as soon as possible. Thank you for visiting us!
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-6 contact-col">
                            <div class="contactInfo">
                                <div id="box">
                                    <div id="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="text">
                                        <h5>Address</h5>
                                        <h6>Cleckhuddersfax</h6>
                                    </div>
                                </div>
                                <div id="box">
                                    <div id="icon1">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="text">
                                        <h5>Phone</h5>
                                        <h6>053-51131515</h6>
                                    </div>
                                </div>
                                <div id="box">
                                    <div id="icon1">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="text">
                                        <h5>Email</h5>
                                        <h6>cornerstore.chf@gmail.com</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="social_media mt-3">
                                <h4>Follow us</h4>
                                <div class="social">
                                    <div class="social_icon"><i class="fab fa-facebook-f"></i></div>
                                    <div class="social_icon1"><i class="fab fa-instagram"></i></div>
                                    <div class="social_icon2"><i class="fab fa-twitter"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Form container starts here -->
                        <div class="col-6 contact-form-col">
                            <!-- Form to store and send the name, email and message -->
                            <form action="send_contact.php" method="POST" class="contact-form">
                                <h3 class = "mt-2">Send Message</h3>
                                <?php
                                    //Display the success or error message stored in session
                                    if (isset($_SESSION['contact_success'])) {
                                        echo '<p style = "color: #00b894; text-align: center;">' . $_SESSION['contact_success'] . '</p>';
                                    }
                                    else if (isset($_SESSION['contact_delete'])) {
                                        echo '<p style = "color: red; text-align: center;">' . $_SESSION['contact_failure'] . '</p>';
                                    }
                                ?>
                                <!-- User name text field -->
                                <div class="form-input full">
                                    <input type="text" id="name" name="name" autocomplete="off" required>
                                    <label for="email" class="label-name">
                                        <span class="content-name">User Name</span>
                                    </label>
                                </div>
                                <!-- Email text field -->
                                <div class="form-input full">
                                    <input type="text" id="email" name="email" autocomplete="off" required>
                                    <label for="email" class="label-name">
                                        <span class="content-name">Email Address</span>
                                    </label>
                                </div>
                                <!-- Message text box -->
                                <div class="text-input">
                                    <textarea name="message" id="msg" cols="30" rows="10" required></textarea>
                                    <label for="msg" class="message-label"><span class="message-content">Message</span></label>
                                </div>
                                <div class="inputBox">
                                    <button type="submit" name = "contact_submit" class="btn btn-primary btn-block">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d150788.90157917945!2d-1.6758143576752904!3d53.80592089177427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48793e4ada64bd99%3A0x51adbafd0213dca9!2sLeeds%2C%20UK!5e0!3m2!1sen!2snp!4v1624714460663!5m2!1sen!2snp" width="100%" height="450" style="border:0; margin-top:20px" allowfullscreen="" loading="lazy"></iframe>

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
    unset($_SESSION['contact_success']);
    unset($_SESSION['contact_failure']);
    ?>

</body>

</html>