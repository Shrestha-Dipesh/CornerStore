<?php
    // $host = 'localhost';
    // $name = 'root';
    // $pass = '';
    // $dbname = 'cornerstore';

    // $conn = mysqli_connect($host, $name, $pass, $dbname) or EXIT("Cannot connect to database");
    $conn = oci_connect('system', 'lilfiterz', '//localhost/xe');
    if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } 
    // oci_close($conn); 
?>