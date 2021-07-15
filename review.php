<?php 
    session_start();
    include 'connection.php';
    if (isset($_POST['review_submit']))
    {
        $rating = $_POST['rating'];

        if (isset($_POST['comments']))
        {
            $comments = $_POST['comments'];
        }
        else
        {
            $comments;
        }

        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];
        
        $sql = "SELECT review_id FROM cornerstore.Review WHERE product_id = $product_id AND user_id = $user_id";
        $result = oci_parse($conn, $sql);
        oci_execute($result);
        $data = oci_fetch_array($result);

        if ($data)
        {
            $_SESSION['review_status'] = 'false';
        }
        else
        {
            $sql1 = "INSERT INTO cornerstore.Review (rating, comments, product_id, user_id) VALUES ($rating, '$comments', $product_id, $user_id)";
            $result1 = oci_parse($conn, $sql1);
            oci_execute($result1);
            $_SESSION['review_status'] = 'true';
        }
    }
    header("location: product_details.php?id=$product_id");
?>