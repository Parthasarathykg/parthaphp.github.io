<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//$to_mail = "architects@palavin.com,t.lavin@palavin.com,12yorkcourt@gmail.com";
$to_mail = "parthukg1@gmail.com";
//$cc="paul@enhance.ie";
$mail_sent = 0;
//if(isset($_POST['submit'])){
    //echo "the form was submitted";

$name = trim(strip_tags($_POST['name']));
if($name == "")
    $error = true;

$email = trim(strip_tags($_POST['email']));
if($email == "")
    $error = true;

if($error != true){
    $headers = 'From: ' . $email . "\r\n";

    $subject = "New contact message";

    $message = "New Contact message, received from: <br /> \n ";
    $message .= "<b>Name :</b> ".$name."<br /> \n";
    $message .= "<b>Email :</b> ".$email."<br /> \n";
    $message .= "<b>Message :</b> ".$_POST['message'];
    echo 'test - > ' . $to_mail .$subject. $message . $headers;
    if(@mail($to_mail,$subject,$message,$headers))
    {
        echo "mail sent";
        $mail_sent = 1;
    }
    else echo "mail not sent";
    print_r(error_get_last()['message']);
} else {
    echo 'validation error';
}
//}

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "parthukg1@gmail.com";                 
$mail->Password = "ecyfkszdlutxsxos";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;                                   

$mail->From = "test@gmail.com";
$mail->FromName = "Partha";

$mail->addAddress($email, $name);

$mail->isHTML(true);

$mail->Subject = "Thank you from Parthu";
$mail->Body = "<i>Thank you for taking your time and writing in! I Will try to get in touch with you soon.</i>";
$mail->AltBody = "Thank you for taking your time and writing in! I Will try to get in touch with you soon.";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

$mail2 = new PHPMailer(true);

//Enable SMTP debugging.
$mail2->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail2->isSMTP();            
//Set SMTP host name                          
$mail2->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail2->SMTPAuth = true;                          
//Provide username and password     
$mail2->Username = "parthukg1@gmail.com";                 
$mail2->Password = "ecyfkszdlutxsxos";                           
//If SMTP requires TLS encryption then set it
$mail2->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail2->Port = 587;                                   

$mail2->From =  $email;
$mail2->FromName = $name;

$mail2->addAddress('parthukg1@gmail.com', 'Parthu');

$mail2->isHTML(true);
$mail2->Subject = $name . " sent you a message";
$mail2->Body = $message; 
$mail2->AltBody = "<i>Thank you for taking your time and writing in! I Will try to get in touch with you soon.</i>";

try {
    $mail2->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
}
?>  
