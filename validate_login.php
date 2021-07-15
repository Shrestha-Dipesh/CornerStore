<?php
session_start();
include 'connection.php';

if (isset($_POST['login'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = htmlentities($_POST['email']);
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = htmlentities(sha1($_POST['password']));
    }

    $query = "SELECT user_id, user_name, verified, user_role FROM cornerstore.users WHERE email = '$email' AND password = '$password'";

    $result = oci_parse($conn, $query);
    oci_execute($result);
    $data = oci_fetch_array($result);
    
    if (oci_num_rows($result) > 0) {
        if ($data['VERIFIED'] == 'True')
        {
            //Set cookie to store credentials for longer time
            if (isset($_POST['remember'])) {
                setcookie('name', $data['USER_NAME'], time() + 86400);
                setcookie('id', $data['USER_ID'], time() + 86400);
                setcookie('role', $data['USER_ROLE'], time() + 86400);
                if ($data['USER_ROLE'] == 'Customer')
                {
                    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                    {
                        $statement = "SELECT cart_id FROM cornerstore.cart WHERE user_id = $data[USER_ID]";
                        $result = oci_parse($conn, $statement);
                        oci_execute($result);
                        $data = oci_fetch_array($result);

                        $statement1 = "DELETE FROM cornerstore.cart_product WHERE cart_id = $data[CART_ID]";
                        $result1 = oci_parse($conn, $statement1);
                        oci_execute($result1);

                        foreach($_SESSION['product'] as $id => $qty)
                        {
                            $statement2 = "INSERT INTO cornerstore.cart_product (quantity, product_id, cart_id, wishlist) VALUES ($qty, $id, $data[CART_ID], 'False')";
                            $result2 = oci_parse($conn, $statement2);
                            oci_execute($result2);
                        }

                        header("location: checkout.php?quantity=$_GET[quantity]&price=$_GET[price]");
                    }
                    else
                    {
                        header('Location: index.php');
                    } 
                }
                else if ($data['USER_ROLE'] == 'Trader')
                {
                    header('Location: trader_interface.php');
                }
            } else {
                //Set session variable to store credentials for active session
                $_SESSION['name'] = $data['USER_NAME'];
                $_SESSION['id'] = $data['USER_ID'];
                $_SESSION['role'] = $data['USER_ROLE'];
                if ($data['USER_ROLE'] == 'Customer')
                {
                    if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                    {
                        $statement = "SELECT cart_id FROM cornerstore.cart WHERE user_id = $_SESSION[id]";
                        $result = oci_parse($conn, $statement);
                        oci_execute($result);
                        $data = oci_fetch_array($result);

                        $statement1 = "DELETE FROM cornerstore.cart_product WHERE cart_id = $data[CART_ID]";
                        $result1 = oci_parse($conn, $statement1);
                        oci_execute($result1);

                        foreach($_SESSION['product'] as $id => $qty)
                        {
                            $statement2 = "INSERT INTO cornerstore.cart_product (quantity, product_id, cart_id, wishlist) VALUES ($qty, $id, $data[CART_ID], 'False')";
                            $result2 = oci_parse($conn, $statement2);
                            oci_execute($result2);
                        }

                        header("location: checkout.php?quantity=$_GET[quantity]&price=$_GET[price]");
                    }
                    else
                    {
                        header('Location: index.php');
                    } 
                }
                else if ($data['USER_ROLE'] == 'Trader')
                {
                    header('Location: trader_interface.php');
                }
            }
        }
        else
        {
            $_SESSION['login_error'] = '<h5 class = "session_error">Verification Required</h5>';
            if (isset($_GET['quantity']) && isset($_GET['price']))
            {
                header("location: login_form.php?quantity=$_GET[quantity]&price=$_GET[price]");
            }
            else
            {
                header('location: login_form.php');
            }
        }
    } else {
        $_SESSION['login_error'] = '<h5 class = "session_error">Invalid Credentials</h5>';
        if (isset($_GET['quantity']) && isset($_GET['price']))
            {
                header("location: login_form.php?quantity=$_GET[quantity]&price=$_GET[price]");
            }
            else
            {
                header('location: login_form.php');
            }
    }
} else {
    echo 'Something went wrong. <a href = "login.php">Please try again</a>';
}
