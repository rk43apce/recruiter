<?php 

$to = 'rk43apce@gmail.com';
$otp = '1234';
$subject = 'OTP to Login';
$message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
// Set content-type for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// Additional headers
$headers .= 'From: Theblueyed<admin@theblueyed.com>' . "\r\n";
// Send email

var_dump(mail($to,$subject,$message_body,$headers));