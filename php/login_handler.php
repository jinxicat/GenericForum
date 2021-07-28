<?php
require_once '../safe/dbh.php';

if(isset($_POST)){
  // protection
  $usn = mysqli_real_escape_string ($dbc, $_POST['user']);
  $psw = mysqli_real_escape_string ($dbc, $_POST['password']);
  $psw_hash = hash("sha512",md5(sha1($psw)));


  // sql query
  $sql = "SELECT * FROM credentials WHERE user = '$usn' and password = '$psw_hash'";
  $result = mysqli_query($dbc_2, $sql);
  $count = mysqli_num_rows($result);

  if($count==1){
    session_start();
    $_SESSION['user'] = "$usn";
    header('Location: ../members-index.php?user='.$usn);
  } else {
    echo("Your username or password was incorrect. You will be redirected shortly...");
    echo('<br>');
    echo('<br>');
    echo("Please click the link if you forgot your password");
    echo('<br>');
    echo('<a href="../reset_password.php?user=' . $usn . '">Reset Password</a>');
    header("Refresh: 5; url='../index.php'");
  }
  }
