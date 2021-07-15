<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie('name', '', time() - 100);
    setcookie('id', '', time() - 100);
    setcookie('role', '', time() - 100);
    header('location: index.php');
?>