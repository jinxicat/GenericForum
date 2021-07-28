<?php
include 'safe/dbh.php';
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
?>
<html>
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
.thread_input{color: white; background-color: gray; border-radius: 5px; margin-left: 10%; font-size: 1rem; width: 70%}
.form_container{vertical-align: top; display: inline-block; border-radius: 5px; z-index: 10; padding: 2%; width: 95%; opacity: 0.9; background-color: #00ff36; color: black; margin-left: 1.5%; margin-right: 1.5%; margin-top: 3vh; border: 1px solid black;}
.text_container{color: black; width: 30%; margin-left: 10%; margin-top: 5%}
.dropdown-item:hover{background-color: gray;}
</style>
</head>


<body>
<img id="img" src="uploads/Trading1.jpg">

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="members-index.php?user=<?php echo($usn) ?>"><img src="uploads/favicon.png"></img> Home </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Boards</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="stocks.php?user=<?php echo($usn); ?>&board=stocks">Stocks</a>
          <a class="dropdown-item" href="options.php?user=<?php echo($usn); ?>&board=options">Options</a>
          <a class="dropdown-item" href="futures.php?user=<?php echo($usn); ?>&board=futures">Futures</a>
          <a class="dropdown-item" href="cryptocurrencies.php?user=<?php echo($usn); ?>&board=cryptocurrencies">Cryptocurrencies</a>
          <a class="dropdown-item" href="trading.php?user=<?php echo($usn); ?>&board=trading">Trading</a>
          <a class="dropdown-item" href="random.php?user=<?php echo($usn); ?>&board=random">Random</a>
          <a class="dropdown-item" href="dreamers.php?user=<?php echo($usn); ?>&board=dreamers">Dreamers</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Extra</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="rules.php?user=<?php echo $usn ?>">Rules</a>
          <a class="dropdown-item" href="contact.php?user=<?php echo $usn ?>">Contact</a>
        </div>
      </li>
    </ul>
      <p style="color: white; margin-right: 20px;">Welcome, <?php echo $usn ?><p>
      <button class="btn btn-outline-success my-2 my-sm-0" onClick="javascript:location='index.php'">Log Out</button>
  </div>
</nav>

<div class="form_container">
  <div class="text_container">
    <p>Help us to expand! Please provide your ideas on new boards that will generate buzz on our forum. We appreciate your input.</p>
  </div>
  <br>
<form action="php/suggestions.php?user=<?php echo($usn); ?>" method="POST">
  <div class="input-group">
    <textarea style="margin-top: 30px;" class="thread_input" name="suggestion" type="text" placeholder="Suggested Board" rows="1" required></textarea>
  </div>
  <div class="input-group">
    <textarea style="margin-top: 30px;" class="thread_input" name="message" type="text" placeholder="Quick Message" rows="2" ></textarea>
  </div>
  <br>
  <input style="color: black; border-color: black; background-color: #18ff00; margin-left: 20%;" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="SUBMIT" value="Submit"/>
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
