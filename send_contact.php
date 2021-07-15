<?php
session_start();
if (isset($_POST['contact_submit'])) {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name= htmlentities($_POST['name']);
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email= htmlentities($_POST['email']);
    }
    if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message= htmlentities($_POST['message']);
    }

    $receiver = "cornerstore.chf@gmail.com";
    $subject = "New Message Submission";
    $body = "Sender Name: $name.\n".
            "Email: $email.\n".
            "Message: $message.\n";

    $header = "From:$email";
    if(mail($receiver, $subject, $body, $header)){ 
               
        $_SESSION['contact_success'] = "Email sent successfully";       
    }
    else{    
        $_SESSION['contact_failure'] = "Error while sending mail";      
    }
    header("location: contact.php");  
}

?>