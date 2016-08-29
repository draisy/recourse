<?php 

 $fname = $_POST['firstName'];
 $lname = $_POST['lastName'];
 $email = $_POST['email'];
 $address = $_POST['address'];
 $city = $_POST['city'];
 $state = $_POST['state'];
 $zip = $_POST['zip'];
 $phone = $_POST['phone'];
 $cell = $_POST['cell'];
 $classChange = $_POST['classChange'];
 $contactChange = $_POST['contactChange'];
 $level = $_POST['level'];
 $eng = $_POST['eng'];
 $yid = $_POST['yid'];
 $time = $_POST['time'];
 $business = $_POST['business'];
 $occupation = $_POST['occupation'];
 $kollel = $_POST['kollel'];
 $re = $_POST['re'];
 $length = $_POST['length']; //if isset
 $ecname = $_POST['ecname'];
 $ecphone = $_POST['ecphone'];
 $ecname2 = $_POST['ecname2'];
 $ecphone2 = $_POST['ecphone2'];
 $referrals = $_POST['referrals'];
 
 $referralMethods = array();
 if(isset($referrals)) {
     foreach($referrals as $x => $x_value) {
         $referralMethods[] = $x_value;
     }
}
 
 $information = array("First Name: " => $fname, "Last Name: " => $lname, "Email Address: " => $email, "Street Address: " => $address, "City: " => $city, 
                        "State: " => $state, "Zip Code: " => $zip, "Home Phone: " => $phone, "Cell Phone: " => $cell, "If classes change: " => $classChange, 
                        "Contact for change: " => $contactChange, "English Level: " => $level, "Read and understand English: " => $eng, 
                        "Read and understand Yiddish? " => $yid, "Course Location: " => $time, "Business Name: " => $business, 
                        "Occupation: " => $occupation, "Kollel: " => $kollel, "Currently in real estate? " => $re, "If so, how long? " => $length, 
                        "Emergency Contact Name: " => $ecname, "Emergency Contact Phone: " => $ecphone, 
                        "Emergency Contact Name 2: " => $ecname2, "Emergency Contact Phone 2: " => $ecphone2);
 $messageBody = '<p>A new user has submitted page 1 of the signup form. The following are the details:</p><ul>';
 $altBody = '';
 
foreach($information as $x => $x_value) {
   $messageBody = $messageBody.'<li>'.$x.$x_value.'</li>';
   $altBody = "\r\n".$altBody.$x.": ".$x_value;
}

foreach($referrals as $referral) {
    $messageBody = $messageBody.'<li> Referral Method: '.$referral.'</li>';
}
$messageBody = $messageBody.'</ul>';

echo $messageBody;

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
 


$mail->addReplyTo($_POST['email'], $_POST['fname']);
$mail->setFrom('info@nyrecourse.com', $_POST['fname']);
$mail->isHTML(true);   
$mail->Subject = "New initial signup from " .$fname. " " .$lname; 
$mail->Body    = $messageBody;
$mail->AltBody = $messageBody;
$mail->addAddress('draisy@gmail.com', 'NYRE Course');     // Add a recipient
$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}    

?> 

