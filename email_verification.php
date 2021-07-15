<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Success</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    include 'connection.php';

    if (isset($_GET['email'])) {
        $email = $_GET['email'];

        $query = "UPDATE cornerstore.users SET verified = 'True' WHERE email = '$email'";
        $result = oci_parse($conn, $query);
        oci_execute($result);

        $query1 = "SELECT * FROM cornerstore.users WHERE email = '$email'";
        $result1 = oci_parse($conn, $query1);
        oci_execute($result1);
        $data = oci_fetch_array($result1);

        if ($data['USER_ROLE'] == 'Customer') {
            $query2 = "INSERT INTO cornerstore.cart (user_id) VALUES ($data[USER_ID])";
            $result2 = oci_parse($conn, $query2);
            oci_execute($result2);
        }


        if ($result) {
            echo "<div class = 'verified-container'><img src = 'images/verify.svg'><p>You have succesfully verified your email.</p></div><p style='text-align:center'>This window will close automatically within <span id='counter' style = 'color: red;'>10</span> second(s).</p>";
            
        }
    } else {
        echo 'Unknown error';
    }
    ?>
    <script type="text/javascript">
        function countdown() {

            var i = document.getElementById('counter');

            i.innerHTML = parseInt(i.innerHTML) - 1;

            if (parseInt(i.innerHTML) <= 0) {

                window.close();

            }

        }

        setInterval(function() {
            countdown();
        }, 1000);
    </script>
</body>

</html>