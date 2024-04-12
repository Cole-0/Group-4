<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'script/src/Exception.php';
require 'script/src/PHPMailer.php';
require 'script/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true); 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
       
    ),
);
$to = $_SESSION['email'];
$activation_code = $_SESSION['activation_code'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

try {
 
    // Server settings
  
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'facultyseminarmonitoring@gmail.com';          // SMTP username
    $mail->Password   = 'ebjffjritegqgtgv';                    // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable implicit TLS encryption
    $mail->Port       = 587;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('facultyseminarmonitoring@gmail.com', 'Faculty Seminars Monitoring');
    $mail->addAddress($to);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Faculty Registration - Email Confirmation';
    $mail->Body    = "Dear $fname $lname,<br><br><br><br>

    To continue accessing the system, Please register your account to verify that  you're not a robot.<br><br>

    Your verification code is: $activation_code <br><br>
   
    If you have any questions or need assistance, feel free to reach out to our technical support team at Central Laboratory (CL) Building. <br><br>
    Best regards,<br><br>
    Group 4 IT Team.
    ";





    $mail->send();
    echo "Please check your email to complete registration!";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>





