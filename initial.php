<!DOCTYPE html>
<?php

$from = $_POST['email'];
$name = $_POST['name'];
$subject = "Contact form";
$text = $name . " " . " wrote:" . "\n\n" . $_POST['text'] . "\n\n" . $from;

require 'php_mailer/PHPMailerAutoload.php';
require 'php_mailer/credential.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->SMTPAutoTLS = false;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = EMAIL;
$mail->Password = PASS;

$mail->setFrom($from, $name);
$mail->addAddress(TO);
$mail->addReplyTo($from, $name);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body    = $text;
$mail->AltBody = $text;

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
  }
?>
