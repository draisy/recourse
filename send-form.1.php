<?php 
require 'PHPMailerAutoload.php';
$mail = new PHPMailer();

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host       = "smtp.gmail.com";
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


$mail->addReplyTo($_POST['email'], $_POST['name']);
$mail->setFrom('info@nyrecourse.com', $_POST['name']);
$mail->isHTML(true);                                  // Set email format to HTML
if (isset($_POST[subjet])) {
  $mail->Subject = $_POST['subject'];
} else {
  $mail->Subject = "NY Real Estate Hiring Submission From ".$_POST['name'];
}
$mail->Body    = $_POST['message'];
$mail->AltBody = $_POST['message'];
$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}    

?> 

