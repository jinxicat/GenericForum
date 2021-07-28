<?php
include 'safe/dbh.php';
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
?>
<html lang="en" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="uploads/favicon.png">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<style>
#img {position: fixed; top: -50%; left: -50%; width: 200%; height: 200%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
#img img{position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
.thread_input{color: white; background-color: gray; border-radius: 5px; font-size: 1rem; width: 20%}
.form_container{vertical-align: top; display: inline-block; border-radius: 5px; z-index: 10; padding: 2%; width: 95%; opacity: 0.9; background-color: #00ff36; color: black; margin-left: 1.5%; margin-right: 1.5%; margin-top: 3vh; border: 1px solid black;}
</style>
</head>

<body>
<img id="img" src="uploads/Trading1.jpg">
<div class="form_container">
  <h1> Password Reset </h1>
  <br>
<form action="php/update_password.php?user=<?php echo $usn ?>" method="POST">
  <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fa fa-user-secret"></i></div>
      </div>
  <input name="verification_code" type="password" class="thread_input password" placeholder="Verification-Code" required/></br>
</div>
  <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fa fa-lock"></i></div>
      </div>
  <input name="password" type="password" class="thread_input password" placeholder="New Password" required/></br>
</div>
  <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fa fa-lock"></i></div>
      </div>
  <input name="password_2" type="password" class="thread_input password" placeholder="Confirm New Password" required/></br>
</div>
  <input style="color: black; border-color: black; background-color: #18ff00; margin-left: 30px;" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="SUBMIT" value="Submit"/>
</form>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
</body>

<footer class="container footer">
  <b><p style="color: white">&copy; Copyright 2019 Trader Buzzz, LLC.™</p></b>
  <br>
  <b><p style="color: white"><i class="fab fa-btc"></i>&nbsp;&nbsp;1LD33TQbQ9LGSXcRQnD73u6hFE7imFkjDs</p></b>
</footer>

</html>
