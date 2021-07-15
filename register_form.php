<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CornerStore | Register</title>
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

      <!-- Register container with image starts here -->
      <div class="login-section register-section mt-4">
        <div class="row">
          <div class="col-md-6">
            <div class="login-form register-form">
              <div class="form-links">
                <div class="link-span">
                  <!-- Links to switch the user form -->
                  <span class="form_span span1 active-form">Customer Form</span>
                  <span class="form_span span2 inactive-form">Trader Form</span>
                </div>
              </div>
              <h3 class="text-center">Become a member</h3>
              
              <!-- Customer Form -->
              <form action="validate_register.php" method="POST" class="customer_form">
                <div class="half-container">
                  <!-- First name input field -->
                  <div class="input-div half first">
                    <div>
                      <h5>First Name</h5>
                      <input type="text" name="first_name" class="input" id="first_name" required>
                    </div>
                  </div>
                  <!-- Last name input field -->
                  <div class="input-div half">
                    <div>
                      <h5>Last Name</h5>
                      <input type="text" name="last_name" class="input" id="last_name" required>
                    </div>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Email Address</h5>
                    <input type="email" name="email" class="input" id="email" required>
                  </div>
                </div>
                <div class="half-container">
                  <div class="input-div half first">
                    <div>
                      <h5>Password</h5>
                      <input type="password" name="password" class="input" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Minimum 8 characters with at least 1 uppercase, 1 lowercase and 1 number" required>
                    </div>
                  </div>
                  <div class="input-div half">
                    <div>
                      <h5>Confirm Password</h5>
                      <input type="password" name="confirm_password" class="input" id="confirm_password" required>
                    </div>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Address</h5>
                    <input type="text" name="address" class="input" id="address" required>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Contact</h5>
                    <input type="number" name="contact" class="input" id="contact" required>
                  </div>
                </div>

                <!-- Age validation for customer -->
                <?php
                $year = date('Y') - 16;
                $month = date('m');
                $day = date('d');
                ?>
                <div class="input-div full">
                  <div>
                    <h5>Date of Birth</h5>
                    <input type="text" name="user_date" class="input" id="user_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" max='<?php echo "$year-$month-$day" ?>' required>
                  </div>
                </div>
                <div class="gender-div">
                  <span><input type="radio" name="gender" value="Male" checked required> Male</span>
                  <span><input type="radio" name="gender" value="Female" required> Female</span>
                  <span><input type="radio" name="gender" value="Other" required> Other</span>
                </div>
                <p class="text-center">By creating an account, you agree to CornerStore's <a href="#">Condition of Use</a> and <a href="#">Privacy notice</a></p>
                <div class="btn-membership text-center">
                  <?php
                    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                    {
                      echo '<button class="btn me-3" name="customer_register" type="submit" formaction = "validate_register.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'">Create Account</button>';
                    }
                    else
                    {
                      echo '<button class="btn me-3" name="customer_register" type="submit">Create Account</button>';
                    }
                  ?>
                  
                  <p>Already a member? <?php if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])) echo '<a href="login_form.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'">Sign in</a>'; else echo '<a href="login_form.php">Sign in</a>'; ?></p>
                </div>
              </form>

              <!-- Trader Form -->
              <form action="validate_register.php" method="POST" class="trader_form">
                <div class="input-div full">
                  <div>
                    <h5>Trader Name</h5>
                    <input type="text" name="first_name" class="input" id="first_name" required>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Email Address</h5>
                    <input type="email" name="email" class="input" id="email" required>
                  </div>
                </div>
                <div class="half-container">
                  <div class="input-div half first">
                    <div>
                      <h5>Password</h5>
                      <input type="password" name="password" class="input" id="password_trader" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Minimum 8 characters with at least 1 uppercase, 1 lowercase and 1 number" required>
                    </div>
                  </div>
                  <div class="input-div half">
                    <div>
                      <h5>Confirm Password</h5>
                      <input type="password" name="confirm_password" class="input" id="confirm_password_trader" required>
                    </div>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Address</h5>
                    <input type="text" name="address" class="input" id="address" required>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Contact</h5>
                    <input type="number" name="contact" class="input" id="contact" required>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Date of Establishment</h5>
                    <input type="text" name="user_date" class="input" id="user_date" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                  </div>
                </div>
                <div class="input-div full">
                  <div>
                    <h5>Shop</h5>
                    <input type="text" name="shop" class="input" id="shop" required>
                  </div>
                </div>
                <p class="text-center">By creating an account, you agree to CornerStore's <a href="#">Condition of Use</a> and <a href="#">Privacy notice</a></p>
                <div class="btn-membership text-center">
                  <button class="btn me-3" name="trader_register" type="submit">Create Account</button>
                  <p>Already a trader? <a href="login_form.php">Sign in</a></p>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="image-part">
              <img src="images/side-image.svg" alt="illustration" class="illustrate2 img-fluid">
            </div>
          </div>
        </div>
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
  unset($_SESSION['login_error']);
  ?>

</body>

</html>