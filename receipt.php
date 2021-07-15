<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cornerstore | Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="images/logo.svg" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!--Entire Page Container starts here-->
    <div class="container-fluid">

        <div class="invoice-wrapper">
            <?php
                //Include connection.php file to connect to Oracle database
                include 'connection.php';

                //Get the order and user id from url
                $order_id = $_GET['order_id'];
                $user_id = $_GET['user_id'];
                $date = date('n/d/Y');

                //Query to fetch all the details of the ordered product
                $statement = "SELECT product_name, price, order_quantity FROM cornerstore.order_product o, cornerstore.product p WHERE o.product_id = p.product_id AND order_id = $order_id";
                $result = oci_parse($conn, $statement);
                oci_execute($result);

                //Query to fetch all the details of the customer
                $statement1 = "SELECT * FROM cornerstore.users WHERE user_id = $user_id";
                $result1 = oci_parse($conn, $statement1);
                oci_execute($result1);
                $data1 = oci_fetch_array($result1);

                //Query to fetch the total price of the ordered product
                $statement2 = "SELECT total_price FROM cornerstore.orders WHERE order_id = $order_id";
                $result2 = oci_parse($conn, $statement2);
                oci_execute($result2);
                $data2 = oci_fetch_array($result2);
            ?>
            <!--invoice details begins here-->
            <div class="invoice-header">
                <h1 class="display-1 m-0 p-0 text-end">Receipt</h1>
                <div class="invoice-details d-flex justify-content-end me-4">
                    <div class="invoice-no me-4">
                        <p class="m-0 p-0 fw-bold ">Receipt No</p>
                        <p class=" text-center m-0 p-0"><?php echo $order_id; ?></p>
                    </div>
                    <div class="invoice-date">
                        <p class="m-0 p-0 fw-bold">Receipt Date</p>
                        <p class="m-0 p-0 text-center"><?php echo $date; ?></p>
                    </div>
                </div>
            </div>
            <!--invoice header ends here-->

            <!--company details begins here-->
            <div class="company-details mb-4">
                <img class="mb-3" src="images/logo.svg" alt="cornerstore logo">
                <p class="m-0 p-0">Cleckhudderfax</p>
                <p class="m-0 p-0">053-51131515</p>
            </div>
            <!--company details ends here-->

            <!--customer details begins here-->
            <div class="customer-details">
                <p class="m-0 p-0 fw-bold">Receipt to:</p>
                <p class="m-0 p-0"><?php echo $data1['USER_NAME']; ?></p>
                <p class="m-0 p-0"><?php echo $data1['ADDRESS']; ?></p>
                <p class="m-0 p-0"><?php echo $data1['CONTACT']; ?></p>
                <p class="m-0 p-0"><?php echo $data1['EMAIL']; ?></p>
            </div>
            <!--customer details ends here-->

            <!--table begins here-->
            <table class="table table-striped">
                <thead>
                    <tr style="color: #0984e3;">
                        <th scope="col">Item No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($data = oci_fetch_array($result)) {
                        echo "<tr>
                            <th scope='row'>$count</th>
                            <td>$data[PRODUCT_NAME]</td>
                            <td>&pound;" . number_format($data['PRICE'], 2) . "</td>
                            <td>$data[ORDER_QUANTITY]</td>
                            <td>&pound;" . number_format(($data['PRICE'] * $data['ORDER_QUANTITY']), 2) . "</td>
                            </tr>";
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
            <!--table ends here-->

            <!--bill calculation begins here-->
            <div class="bill-calc">

                <div class="topic-amt d-flex justify-content-end">
                    <p class="topic m-0 p-0  fw-bold">Sub Total:</p>
                    <p class="amt m-0 p-0">&pound;<?php echo number_format($data2['TOTAL_PRICE'], 2); ?></p>
                </div>

                <div class="topic-amt d-flex justify-content-end">
                    <p class="topic m-0 p-0 fw-bold">Discount:</p>
                    <p class="amt m-0 p-0">&pound;0.00</p>
                </div>


                <div class="topic-amt d-flex justify-content-end" style = "text-align: right;">
                    <p class="topic m-0 p-0 fw-bold">Grand Total:</p>
                    <p class="amt m-0 p-0">&pound;<?php echo number_format($data2['TOTAL_PRICE'], 2); ?></p>
                </div>

            </div>
            <!--bill calculation ends here-->

            <!--bill footer starts-->
            <div class="bill-footer">
                <p class="h3 text-center">Thank you for shopping with us !</p>
                <p class="m-0 p-0 text-center">For questions cornerning this invoice, please contact:</p>
                <p class="m-0 p-0 text-center">CornerStore,053-51131515, cornerstore.chf@gmail.com</p>
            </div>

            <!--bill footer ends-->
        </div>
        <div class="receipt-links">
                <button id = "pdf-btn">Download PDF</button>
                <button onclick="window.location.href='index.php'">Return Home</button>
            </div>
        <!--wrapper ends here-->
    </div>
    <!--container-fluid ends here-->
    
    <!--bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--bootstrap script-->
    
    <script>
        const btn = document.querySelector('#pdf-btn');
        const receipt = document.querySelector('.invoice-wrapper');
        btn.addEventListener('click', ()=> {
            html2pdf().from(receipt).save();
        })
    </script>

</body>

</html>