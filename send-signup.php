<?php 
// require 'PHPMailerAutoload.php';
// $mail = new PHPMailer();

// //$mail->SMTPDebug = 3;                               // Enable verbose debug output
// $mail->isSMTP();                                      // Set mailer to use SMTP
// //$mail->Host       = "smtp.gmail.com";
// $mail->Host = 'localhost';      
// $mail->SMTPDebug  = 0;
// $mail->SMTPAuth   = false;                 
// $mail->Port = 25;
// //$mail->SMTPSecure = 'tls';
// $mail->Username = 'info@nyrecourse.com';                 // SMTP username
// $mail->Password = 'Nyrec1969';  

// // $mail->Host = 'a2plcpnl0528.prod.iad2.secureserver.net';  // Specify main and backup SMTP servers
// // $mail->SMTPAuth = true;                               // Enable SMTP authentication
//  //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//  //$mail->Port = 25;                                    // TCP port to connect to
// $data = $_POST['image'];
// $uri = substr($data,strpos($data,",")+1);
// $date = date('Y-m-d H:i:s');
// file_put_contents('images/signatures/signedimage'.$date.'.svg', file_get_contents($data));

// //$mail->addReplyTo($_POST['email'], $_POST['name']);
// $mail->setFrom('info@nyrecourse.com', 'Draisy');
// $mail->isHTML(true);                                  // Set email format to HTML
// if (isset($_POST[subjet])) {
//   $mail->Subject = $_POST['subject'];
// } else {
//   $mail->Subject = "NY Real Estate Course Signature for ".$_POST['fname']." ".$_POST['lname'];
// }
// $mail->AddEmbeddedImage('signedimage.svg', 'my-attach');
// $mail->addAttachment('signedimage.svg', 'signature.svg'); 
// $mail->Body = '<img alt="signature" src="cid:my-attach"/> The signed registration for the previous form is attached.';

// //$mail->Body    = $_POST['message'];
// //$mail->AltBody = $_POST['message'];
// //$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient
// $mail->addAddress('draisy@gmail.com', 'NYRE Course');     // Add a recipient

// if(!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Message has been sent';
// }    

?> 


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
 $signature = $_POST['signature'];
 
 $referralMethods = array();
 if(isset($referrals)) {
     foreach($referrals as $x => $x_value) {
         $referralMethods[] = $x_value;
     }
}

echo 'print referrals ';
print_r($referralMethods);
 
 $information = array("First Name: " => $fname, "Last Name: " => $lname, "Email Address: " => $email, "Street Address: " => $address, "City: " => $city, 
                        "State: " => $state, "Zip Code: " => $zip, "Home Phone: " => $phone, "Cell Phone: " => $cell, "If classes change: " => $classChange, 
                        "Contact for change: " => $contactChange, "English Level: " => $level, "Read and understand English: " => $eng, 
                        "Read and understand Yiddish? " => $yid, "Time preference: " => $time, "Business Name: " => $business, 
                        "Occupation: " => $occupation, "Kollel: " => $kollel, "Currently in real estate? " => $re, "If so, how long? " => $length, 
                        "Emergency Contact Name: " => $ecname, "Emergency Contact Phone: " => $ecphone, 
                        "Emergency Contact Name 2: " => $ecname2, "Emergency Contact Phone 2: " => $ecphone2, "Signature: " => $signature);
 $messageBody = '<p>A new user has submitted the the final confirmation for the registration. The following are the details:</p><ul>';
 $altBody = '';
 
foreach($information as $x => $x_value) {
   $messageBody = $messageBody.'<li>'.$x.$x_value.'</li>';
   $altBody = "\r\n".$altBody.$x.$x_value;
}

foreach($referrals as $referral) {
    $messageBody = $messageBody.'<li> Referral Method: '.$referral.'</li>';
}
$messageBody = $messageBody.'</ul>';

// $imageData = $_POST['image'];
// $uri = substr($data,strpos($imageData,",")+1);
$date = date('Y-m-d H:i:s');
// file_put_contents('images/signatures/signedimage'.$date.'.svg', file_get_contents($imageData));

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
 


$mail->addReplyTo($_POST['email'], $fname);
$mail->setFrom('info@nyrecourse.com', $fname);
$mail->isHTML(true);   
$mail->Subject = "Final signup from " .$fname. " " .$lname; 
//$mail->AddEmbeddedImage('images/signatures/signedimage'.$date.'.svg', 'my-attach');
// $mail->addAttachment('images/signatures/signedimage'.$date.'.svg', $fname.$lname.'signature.svg'); 
$mail->Body    = $messageBody;
$mail->AltBody = $altBody;
$mail->addAddress('draisy@gmail.com', 'NYRE Course');     // Add a recipient
$mail->addAddress('nyrealestatecourse@gmail.com', 'NYRE Course');     // Add a recipient
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}    

?> 




