<?php
session_start();
include 'connection.php';

if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
    $first_name = htmlentities($_POST['first_name']);
}
if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
    $last_name = htmlentities($_POST['last_name']);
}
if (isset($last_name)) {
    $user_name = $first_name . ' ' . $last_name;
} else {
    $user_name = $first_name;
}
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = htmlentities($_POST['email']);
}
if (isset($_POST['contact']) && !empty($_POST['contact'])) {
    $contact = htmlentities($_POST['contact']);
}
if (isset($_POST['address']) && !empty($_POST['address'])) {
    $address = htmlentities($_POST['address']);
} else {
    $address = null;
}
if (isset($_POST['user_date']) && !empty($_POST['user_date'])) {
    $user_date = htmlentities($_POST['user_date']);
}
if (isset($_POST['gender'])) {
    $gender = htmlentities($_POST['gender']);
} else {
    $gender = null;
}
if (isset($_POST['customer_register'])) {
    $user_role = 'Customer';
} else {
    $user_role = 'Trader';
}
$verified = 'False';

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $password = htmlentities(sha1($_POST['password']));
}

$query = "INSERT INTO cornerstore.users (user_name, user_role, email, password, contact, address, user_date, gender, verified) VALUES ('$user_name', '$user_role', '$email', '$password', $contact, '$address', TO_DATE('$user_date', 'YYYY-MM-DD'), '$gender', '$verified')";

$result = oci_parse($conn, $query);
oci_execute($result);

if ($user_role == 'Trader')
{
    $query1 = "SELECT * FROM cornerstore.users WHERE email = '$email'";
    $result1 = oci_parse($conn, $query1);
    oci_execute($result1);
    $data = oci_fetch_array($result1);

    $shop = $_POST['shop'];
    $id = $data['USER_ID'];

    $query2 = "INSERT INTO cornerstore.shop (user_id, shop_no, shop_name, authorized) VALUES ($id, 1, '$shop', 'False')";
    $result2 = oci_parse($conn, $query2);
    oci_execute($result2);
}

if ($result) {

    //Send verfication mail to the email after successful registration
    $to_email = "$email";
    $subject = "Verification of email address";
    $body = "Please, click me";
    $body = "Please, click on the link below to verify your email address: <br> <a href = 'localhost/cornerstore/email_verification.php?email=$email'>Verify Email</a>";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
    echo '<script>window.open("verify_email.php")</script>';
    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
    {
        echo '<script>window.location = "login_form.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'"</script>';
    }
    else
    {
        echo '<script>window.location = "login_form.php"</script>';
    }
    
} else {
    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
    {
        header("location: register_form.php?quantity=$_GET[quantity]&price=$_GET[price]");
    }
    else
    {
        header('location: register_form.php');
    }
}
?>
