<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('vendor/phpmailer/phpmailer/src/Exception.php');
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


function sendmail($Subject,$body,$user,$firstname){

$sender_email = "prolinkpc02@gmail.com";

// Recipient's email address (user's email)
$user_email = $user; // $email contains the user's email address

// Your Gmail credentials
$smtp_username = "prolinkpc02@gmail.com";
$smtp_password = "ccgu newu ycke qikf"; // Use the App Password if you generated one

// Create a PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = 0;

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Specify the SMTP server
    $mail->Host = 'smtp.gmail.com';

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // SMTP username and password
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;

    // Enable TLS encryption
    $mail->SMTPSecure = 'tls';

    // Set the port
    $mail->Port = 587;

    // Set the sender and recipient addresses
    $mail->setFrom($sender_email, 'Lotus Electicals');
    $mail->addAddress($user_email, $firstname);

    

    // Set the email subject and body
    $mail->Subject = $Subject;
    $mail->Body = $body;
           
    $mail->send();
    } catch (Exception $e) {
        echo $e;
    echo '<script> alert("Message could not be sent. No Internet Connection Found. Please Go Online");</script>';
}
}

function sendsms($number,$message){
    $apiEndpoint = 'https://app.notify.lk/api/v1/send';

// Replace these values with your actual user ID, API key, and sender ID
$userId = '26551';
$apiKey = 'wHv9lFirIyeaEigL7WOG';
$senderId = 'NotifyDEMO';


// Get custom content from the form or any source
//$number = $modifiedNumber; // Assuming you have a form field named 'number'
//$message = $body; // Assuming you have a form field named 'message'

// Prepare the API URL with parameters
$apiUrl = "$apiEndpoint?user_id=$userId&api_key=$apiKey&sender_id=$senderId&to=$number&message=$message";

// Make the HTTP request
$response = file_get_contents($apiUrl);

}
?>