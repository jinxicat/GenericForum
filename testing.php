<?php
include 'safe/dbh.php';
//$usn = "johnson";
//$password = "";
//$veri = rand(100000,1000000000);
// store veri code in database
//$sql_veri = "INSERT INTO verification_codes (user, verification_code) VALUES ('$usn', '$veri')";
//mysqli_query($dbc, $sql_veri);

//$sql_old = "DELETE FROM verification_codes WHERE user = '$usn'";
//mysqli_query($dbc_2, $sql_old);

//$psw = hash("sha512",md5(sha1($password)));
//$sql_2 = "UPDATE credentials SET password = '$psw' WHERE user = '$usn'";
//mysqli_query($dbc, $sql_2);

//echo $psw;


$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

$sql = "INSERT INTO site_visits (ip) VALUES ('$ip')";
mysqli_query($dbc, $sql);

echo $ip;
?>
