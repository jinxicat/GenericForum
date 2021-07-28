<?php
if (isset($_POST)){
  include '../safe/dbh.php';
  $usn = mysqli_real_escape_string ($dbc, $_GET['user']);
  $test_veri_code = mysqli_real_escape_string ($dbc, $_POST['verification_code']);
  $password = mysqli_real_escape_string ($dbc, $_POST['password']);
  $password_2 = mysqli_real_escape_string ($dbc, $_POST['password_2']);
  //test passwords
  if($password == $password_2){
  // get real verification code
  $sql = "SELECT * FROM verification_codes WHERE user = '$usn'";
  $result = mysqli_query($dbc, $sql);
  $row = mysqli_fetch_array($result);
  $true_veri_code = $row['verification_code'];

  // test veri codes
  if($true_veri_code == $test_veri_code){
    $psw = hash("sha512",md5(sha1($password)));
    $sql_2 = "UPDATE credentials SET password = '$psw' WHERE user = '$usn'";
    mysqli_query($dbc, $sql_2);
    echo("Your password was reset, you can now login. You will be redirected shortly...");
    echo '<script> setTimeout(function(){location.href="../index.php"} , 5000); die; </script>';
  } else {
    echo("Your verification code did not match with ours. Please try again. You will be redirected shortly...");
    echo '<script> setTimeout(function(){location.href="../index.php"} , 5000); die; </script>';
    }
  } else {
    echo("Your passwords did not match. Please try again. You will be redirected shortly...");
    echo '<script> setTimeout(function(){location.href="../reset_password.php?user=' . $usn . '"} , 5000); die; </script>';
  }
}


?>
