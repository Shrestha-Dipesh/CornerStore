<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CornerStore | Customer Profile</title>
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

      <h3 class="h3 ps-4 text-center mt-4">Manage Account</h3>
      <div class="row mt-4 p-4">
        <?php
        //Include connection.php file to connect to Oracle database
        include 'connection.php';
        //Get the user id from the url
        $id = $_GET['id'];
        //Query to fetch all the details of the user
        $sql = "SELECT * FROM cornerstore.users WHERE user_id = $id";
        $result = oci_parse($conn, $sql);
        oci_execute($result);
        $data = oci_fetch_array($result);
        //Extract the first name of the user from full name
        if (isset($data['USER_NAME'])) {
          $name = explode(' ', $data['USER_NAME']);
        }
        ?>
        <!-- Side image container starts here -->
        <div class="col-md-3">
          <div class="img-part customer_image">
            <img class="img-fluid" src="images/user.png" alt="user profile">
            <h4 class="name mt-2 h4 text-center"><?php echo $data['USER_NAME']; ?></h4>
          </div>
        </div>
        <!-- Form detail container starts here -->
        <div class="col-md-9">
          <div class="form-part ">
            <form method = "POST" action = "update_customer.php" class="row g-3">
              <?php 
              //Display the success or error message stored in session
                if (isset($_SESSION['profile_error']))
                {
                  echo '<p style = "color: red; text-align: center;">'.$_SESSION['profile_error'].'</p>';
                }
                else if (isset($_SESSION['profile_successful']))
                {
                  echo '<p style = "color: #00b894; text-align: center;">'.$_SESSION['profile_successful'].'</p>';
                }
              ?>
              <div class="col-md-6">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name ="first_name" value = "<?php if (isset($name)) echo $name[0]; ?>">
              </div>
              <div class="col-md-6">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" name ="last_name" class="form-control" id="lname" value = "<?php if (isset($name)) echo $name[1]; ?>">
              </div>
              <input type="hidden" name="user_id" value = "<?php echo $id; ?>">
              <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name ="email" class="form-control" id="email" value = "<?php if (isset($data['EMAIL'])) echo $data['EMAIL']; ?>">
              </div>
              <div class="col-12">
                <label for="opass" class="form-label">Old Password</label>
                <input type="password" class="form-control" name="old_password" >
              </div>
              <div class="col-md-6">
                <label for="newpass" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password">
              </div>
              <div class="col-md-6">
                <label for="newpassconfirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password">
              </div>

              <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name = "address" value = "<?php if (isset($data['ADDRESS'])) echo $data['ADDRESS']; ?>">
              </div>

              <div class="col-12">
                <label for="contact" class="form-label">Contact</label>
                <input type="number" name = "contact" class="form-control" id="contact" value = "<?php if (isset($data['CONTACT'])) echo $data['CONTACT']; ?>">
              </div>

              <div class="col-12">
              <?php
                $year = date('Y') - 16;
                $month = date('m');
                $day = date('d');
                $date = explode('-', date("y-m-d", strtotime($data['USER_DATE'])));
                if ($date[0] < 50)
                {
                  $date[0] = '20'. $date[0];
                }
                else {
                  $date[0] = '19'. $date[0];
                }
                ?>
                <label for="dob" class="form-label">Date Of Birth</label>
                <input type="date" name = "user_date" class="form-control" id="dob" value = "<?php if (isset($date)) echo $date[0].'-'.$date[1].'-'.$date[2]; ?>" max='<?php echo "$year-$month-$day" ?>'>
              </div>
              <div class="col-12">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="male" <?php if (isset($data['GENDER'])){if ($data['GENDER'] == 'Male') echo 'checked';} ?> value="Male">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" <?php if (isset($data['GENDER'])){if ($data['GENDER'] == 'Female') echo 'checked';} ?> id="female" value="Female">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="other" <?php if (isset($data['GENDER'])){if ($data['GENDER'] == 'Other') echo 'checked';} ?> value="Other">
                  <label class="form-check-label" for="inlineRadio2">Other</label>
                </div>
              </div>

              <div class="col-12 profile_button">
                <button class="btn cancel-btn me-3" formaction="index.php">Cancel</button>
                <button type = "submit" name = "change_button" class="btn me-3">Save Changes</button>
              </div>
            </form>
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
  unset($_SESSION['profile_error']);
  unset($_SESSION['profile_successful']);
  ?>

</body>

</html>