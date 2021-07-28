<?php
require '../safe/dbh.php';

$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

if(isset($_POST)){
  $usn = mysqli_real_escape_string ($dbc, $_POST['user']);
  $email = mysqli_real_escape_string($dbc, $_POST['email']);
  $psw = mysqli_real_escape_string ($dbc, $_POST['password']);
  $psw_2 = mysqli_real_escape_string ($dbc, $_POST['password_2']);
  $psw_hash = hash("sha512",md5(sha1($psw)));

  // sql query to find used usernames
  $sql = "SELECT * FROM credentials WHERE user = '$usn'";
  $result = mysqli_query($dbc, $sql);

  // check if passwords match
  if($psw !== $psw_2){
    echo '<script> setTimeout(function(){location.href="../index.php"} , 3000); die; </script>';
    echo("Your passwords did not match!");
    //header("Refresh:3; url='../index.php'");
  } else{
  //check if password is long enough
  if(strlen($psw) < 8){
    echo '<script> setTimeout(function(){location.href="../index.php"} , 3000); die; </script>';
    echo("Your passwords must be 8 characters long!");
    //header("Refresh:3; url='../index.php'");
  } else {
  // check if username is taken
  if(mysqli_num_rows($result) > 0){
    echo '<script> setTimeout(function(){location.href="../index.php"} , 3000); die; </script>';
    echo("That username has been taken. You will be redirected shortly...");
    //header( "Refresh:3; url='../index.php'");
  } else {

//validate email
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //check ip
    $sql_ip = "SELECT * FROM credentials WHERE ip = '$ip'";
    $result_ip = mysqli_query($dbc, $sql_ip);
    if(mysqli_num_rows($result_ip) > 0){
      echo '<script> setTimeout(function(){location.href="../members-index.php?signup=success&rules=violation&user=' . $usn . '"} , 2000);</script>';
      $sql = "INSERT INTO credentials (user, email, password, ip) VALUES ('$usn', '$email', '$psw_hash', '$ip')";
      mysqli_query($dbc,$sql);
      session_start();
      $_SESSION['user'] = "$usn";
      echo("Creating Account...");
      //header( "Refresh:2 ../members-index.php?signup=success&rules=violation&user=$usn");
    } else {
    echo '<script> setTimeout(function(){location.href="../members-index.php?signup=success&user=' . $usn . '"} , 2000);</script>';
    $sql = "INSERT INTO credentials (user, email, password, ip) VALUES ('$usn', '$email', '$psw_hash', '$ip')";
    mysqli_query($dbc,$sql);
    session_start();
    $_SESSION['user'] = "$usn";
    echo("Creating Account...");
    //header( "Refresh:2 ../members-index.php?signup=success&user=$usn");
  }
  } else {
    echo '<script> setTimeout(function(){location.href="../index.php"} , 4000);</script>';
    header( "Refresh:5; url='../index.php'");
    echo("You email is invalid. You will be redirected shortly...");
    //header( "Refresh:5; url='../index.php'");
}
}
}
}
}
