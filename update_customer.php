<?php
session_start();
include 'connection.php';
if (isset($_POST['change_button'])) {
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['contact']) && isset($_POST['user_date']) && isset($_POST['gender'])) {
        $user_name = $_POST['first_name'] . ' ' . $_POST['last_name'];
        $user_id = $_POST['user_id'];
        if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $sql = "SELECT password FROM cornerstore.users WHERE user_id = $user_id";
            $result = oci_parse($conn, $sql);
            oci_execute($result);
            $data = oci_fetch_array($result);
            if (sha1($_POST['old_password']) == $data['PASSWORD']) {
                $uppercase = preg_match('@[A-Z]@', $_POST['new_password']);
                $lowercase = preg_match('@[a-z]@', $_POST['new_password']);
                $number = preg_match('@[0-9]@', $_POST['new_password']);
                if ($uppercase && $lowercase && $number && strlen($_POST['new_password']) >= 8) {
                    if ($_POST['new_password'] == $_POST['confirm_password']) {
                        $password = htmlentities(sha1($_POST['new_password']));

                        $sql1 = "UPDATE cornerstore.users SET user_name = '$user_name', email = '$_POST[email]', password = '$password', address = '$_POST[address]', contact = $_POST[contact], user_date = TO_DATE('$_POST[user_date]', 'YYYY-MM-DD'), gender = '$_POST[gender]' WHERE user_id = $user_id";
                        $result1 = oci_parse($conn, $sql1);
                        oci_execute($result1);
                        $_SESSION['profile_successful'] = 'Changes Saved';
                        $_SESSION['name'] = $_POST['first_name'];
                        setcookie('name', $_POST['first_name'], time() + 86400);
                    } else {
                        $_SESSION['profile_error'] = 'Password does not match';
                    }
                } else {
                    $_SESSION['profile_error'] = 'Password must contain at least 8 characters, one uppercase, one lowercase and a number';
                }
            } else {
                $_SESSION['profile_error'] = 'Incorrect Password';
            }
        } else {
            $sql2 = "UPDATE cornerstore.users SET user_name = '$user_name', email = '$_POST[email]', address = '$_POST[address]', contact = $_POST[contact], user_date = TO_DATE('$_POST[user_date]', 'YYYY-MM-DD'), gender = '$_POST[gender]' WHERE user_id = $user_id";
            $result2 = oci_parse($conn, $sql2);
            oci_execute($result2);
            $_SESSION['profile_successful'] = 'Changes Saved';
            $_SESSION['name'] = $_POST['first_name'];
            setcookie('name', $_POST['first_name'], time() + 86400);
        }
    }
}
header("location: customer_profile.php?id=$_POST[user_id]");
