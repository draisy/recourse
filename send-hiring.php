<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$position = $_POST['position'];
$location = $_POST['location'];
$experience = $_POST['experience'];
$reqExp = $_POST['hire'];
$days = $_POST['days'];
$hours = $_POST['hours'];
$compensation = $_POST['compensation'];
$contact = $_POST['contact'];
$message = $_POST['message'];

$information = array("Name: " => $name, "Email Address: " => $email, "Position: " => $position, "Company Location: " => $location, 
                    "Experience: " => $experience, "Previous experience required? " => $reqExp, "Days and Hours: " => $days. ", and ".$hours." hours",
                    "Compensation: " => $compensation, "Contact: " => $contact, "Additional Message: " => $message);

 $messageBody = '<p>A user has submitted a hiring form. The following are the details:</p><ul>';
 $altBody = '';
 
foreach($information as $x => $x_value) {
   $messageBody = $messageBody.'<li>'.$x.$x_value.'</li>';
   $altBody = "\r\n".$altBody.$x.": ".$x_value;
}

$messageBody = $messageBody.'</ul>';

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
$mail->Subject = "NY Real Estate Hiring Submission From ".$_POST['name'];
$mail->Body    = $messageBody;
$mail->AltBody = $altBody;
$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}    

?> 

