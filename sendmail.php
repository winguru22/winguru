<?php
$otp = 1234;
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->SMTPDebug = 2;
$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;                               
$mail->Username = 'winguruinfo@gmail.com';   //sender email Id             
$mail->Password = 'Winguru@95';            //sender email's password               
$mail->SMTPSecure = 'tls';                       
$mail->Port = 587;

$mail->From = 'winguruinfo@gmail.com';
$mail->FromName = 'Win Guru';
$mail->addAddress('raoshsbh6@gmail.com');                                

$mail->IsHTML(true);
$mail->Subject = 'credentials';
$mail->Body    = 'This is your otp:'.$otp;                              
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}  
?>