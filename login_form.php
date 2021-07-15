<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CornerStore | Login</title>
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
      <!-- Login form with image starts here -->
      <div class="login-section mt-4">
        <div class="row">
          <!-- Banner image container -->
          <div class="col-md-6">
            <div class="image-part">
              <img src="images/login.png" alt="illustration" class="illustrate img-fluid">
            </div>
          </div>
          <!-- Form container starts here -->
          <div class="col-md-6">
            <div class="login-form">
              <h3 class="text-center">Welcome to CornerStore</h3>

              <!-- Display message for invalid credentials -->
              <?php
              if (isset($_SESSION['login_error'])) {
                echo $_SESSION['login_error'];
              }
              ?>
              <!-- Form to store and validate the user credentials -->
              <form action="validate_login.php" method="POST">
                <!-- Email input field -->
                <div class="input-div one">
                  <div class="i">
                    <i class="fas fa-envelope"></i>
                  </div>
                  <div>
                    <h5>Email Address</h5>
                    <input type="email" name="email" class="input" id="username" required>
                  </div>
                </div>
                <!-- Password input field -->
                <div class="input-div two">
                  <div class="i">
                    <i class="fas fa-lock"></i>
                  </div>
                  <div>
                    <h5>Password</h5>
                    <input type="password" name="password" class="input" id="password" required>
                  </div>
                </div>
                <div class="check-forgetp">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="remember">
                    <label class="form-check-label" for="inlineCheckbox1">Remember me</label>
                  </div>
                  <a class="ms-auto" href="#">Forgot password?</a>
                </div>
                <div class="btn-membership text-center">
                  <?php
                    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                    {
                      echo '<button formaction = "validate_login.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'" class="btn me-3" name="login" type="submit">LOGIN</button>';
                    }
                    else
                    {
                      echo '<button class="btn me-3" name="login" type="submit">LOGIN</button>';
                    }
                  ?>
                  <p>New here? <?php if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])) echo '<a href="register_form.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'">Become a member</a>'; else echo '<a href="register_form.php">Become a member</a>'; ?></p>
                </div>
              </form>
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