<?php
include 'safe/dbh.php';
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
$sql = "SELECT * FROM credentials WHERE user = '$usn'";
$result = mysqli_query($dbc_2, $sql);
$row = mysqli_fetch_array($result);
$email = $row['email'];
define('TO', $email);


if (mysqli_num_rows($result) == 0) {
  echo("That username does not exist. You will be redirected shortly...");
  header("Refresh: 4; url='index.php'");
} else {
  //delete old veri code
  $sql_old = "DELETE FROM verification_codes WHERE user = '$usn'";
  mysqli_query($dbc_2, $sql_old);

  $veri = rand(100000,1000000000);
  // store veri code in database
  $sql_veri = "INSERT INTO verification_codes (user, verification_code) VALUES ('$usn', '$veri')";
  mysqli_query($dbc, $sql_veri);
  $link = "https://traderbuzzforum.com/update_password.php?user=" . $usn . "";
  $title = "Password reset link";
  $from = "JoshMelanox114@gmail.com";
  $name = "JoshMelanox114@gmail.com";

  $subject = "Reset Password: Trader Buzz Forum";
  $text = "Here is the link and verifiaction-code to reset your password: <html><a href='". $link. "'>" .$title. "</a></html>\n\n Verification-Code:" . $veri . "";
  //$text = "Here is the link and verifiaction-code to reset your password: https://traderbuzzforum.com/update_password.php?user=" . $usn . "\n\n Verification-Code:" . $veri . "";

  require 'php_mailer/PHPMailerAutoload.php';
  require 'php_mailer/credential.php';

  $mail = new PHPMailer;

  $mail->isSMTP();
  $mail->isHTML(true);
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
      echo ('<br>');
      echo ('<b>Please contact us directly to have your password reset</b>');
  } else {
      echo("A link and one-time varifiaction code has been sent to your account email. Click the link and use the verification code to reset your password. It may appear in the spam folder.");
    }
}
?>
