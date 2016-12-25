<?php 
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = "Pricing information has been sent to: \r\n Name: " .$fname ." ". $lname ."\r\n" 
."Phone: " .$phone  ."\r\n" ."Email: " .$email ."\r\n"."Message: " .$_POST['message'];

require 'PHPMailerAutoload.php';
$mail = new PHPMailer();

//$mail->SMTPDebug = 3; // Enable verbose debug output
$mail->isSMTP();   // Set mailer to use SMTP
$mail->Host = 'localhost';      
$mail->SMTPDebug  = 0;
$mail->SMTPAuth   = false;                 
$mail->Port = 25;
//$mail->SMTPSecure = 'tls';
$mail->Username = 'info@nyrecourse.com';                 // SMTP username
$mail->Password = 'Nyrec1969';  

// $mail->Host = 'a2plcpnl0528.prod.iad2.secureserver.net';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
 //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
 //$mail->Port = 25;                                    // TCP port to connect to


$mail->addReplyTo($email, $fname ." ". $lname);
$mail->setFrom('info@nyrecourse.com', $fname ." ". $lname);
$mail->isHTML(true);  
$mail->Subject = "NY Real Estate Course Pricing Request From ".$fname ." ". $lname;
$mail->Body = $message;
$mail->addAddress('draisy@gmail.com', 'NYRE Course');     // Add a recipient
$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}    

?> 

