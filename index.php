<?php
require 'safe/dbh.php';

$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

$sql = "INSERT INTO site_visits (ip) VALUES ('$ip')";
mysqli_query($dbc, $sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Home - Trader Buzz Forum</title>
    <meta name="keywords" content="trading, stocks, options, cryptocurrencies, futures, forum, threads, chatroom, chatboard">
    <meta name="description" content="Gain an edge on market moves with Trader Buzz Forum! Connect with other traders to stay informed, post and read content and updates in real-time!">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="uploads/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
  .thread_col_container{left: 0; width: 95%}
  .heading{font-family: "Impact", "Charcoal", sans-serif; font-size: 5rem;}
  .input-group-prepend{width: 50px; display: inline-block;}
  .password{color: white; background-color: #3E363F; border-radius: 5px; margin-left: 55px; display: inline-block; position: absolute;}
  .email{color: white; background-color: #3E363F; border-radius: 5px; margin-left: 55px; display: inline-block; position: absolute;}
  .username{color: white; background-color: #3E363F; border-radius: 5px; margin-left: 55px; display: inline-block; position: absolute;}
  .input-group{margin-bottom: 5px;}
  .header_col{width: 50%; margin-left: 70%; margin-top: -4vw; padding-bottom: 5vw;}
  .header{border-radius: 5px; z-index: 10; padding: 2%; width: 97%; opacity: 0.9; background-color: #00ff36; color: black; margin-left: 1.5%; margin-right: 1.5%; margin-top: 1.5%; border: 1px solid black;}
  .btn{color: white;border-color: white;}
  .dropdown-item:hover{background-color: gray;}
  .rowrow{vertical-align: top; display: inline-block; width: 60%; margin-top: 1%; margin-left: 2.5%; margin-right: 2.5%; background-color: white; border-radius: 5px; opacity: 0.8; border: 1px solid black;}
  .colcol{vertical-align: top; display: inline-block; width: 92%; padding-left: 6%; padding-bottom: 10px; margin-left: 1%; color: black;word-wrap: break-word;}
  .voting_block{width: 2.5%; display: inline-block; padding-left: 5px;}
  .side_box{right: 0; margin-right: 1.5%; color: black; background-image: "uploads/image.png"; background-size: cover; padding-top: 10vh; text-align: center; position: absolute; vertical-align: top; display: inline-block; width: 35%; margin-top: 3vh; height: 40vh; border-radius: 5px; border: 1px solid black; background-color: gray; opacity: 0.9;}
  .thread_title{font-size: 1.3rem}
  .thread_content{font-size: 1.1rem}
  p{line-height: 20px;}
  a.thread_links{color: Black;}
  #signup_form {width: 50%}
  #img {position: fixed; top: -50%; left: -50%; width: 200%; height: 200%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
  #img img{position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
  #img_2 {border-radius: 5px; position: absolute;; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
  #img_2 img{top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
  @media screen and (max-width : 1200px){.side_box{font-size: 0.9rem} .colcol{font-size: 0.9rem;}}
  @media screen and (max-width : 980px){.side_box{font-size: 0.8rem} .header_col{width: 50%; margin-left: 60%; margin-top: -4vw} .colcol{font-size: 0.8rem;} .heading{font-size: 3rem;}}
  @media screen and (max-width : 800px){.side_box{font-size: 0.7rem} .header_col{width: 50%; margin-left: 25%; margin-top: 0vw} .colcol{font-size: 0.7rem;} .header{width: 90%; position: relative;}.side_box{width: 90%; position: relative; margin-left: 1.5%} .rowrow{width: 95%; margin-top: 3vh;}}
  @media screen and (max-width : 600px){.side_box{font-size: 0.6rem} .header_col{width: 50%; margin-left: 25%; margin-top: 0vw} .colcol{font-size: 0.6rem;} .thread_title{font-size: 1rem}.thread_content{font-size: 0.9rem}}
  @media screen and (max-width : 400px){.side_box{font-size: 0.5rem} .header_col{width: 50%; margin-left: 0%; margin-top: 2vw} .colcol{font-size: 0.5rem;} .heading{font-size: 2rem;} .thread_title{font-size: 1rem}.thread_content{font-size: 0.9rem}}
    </style>
  </head>

  <body>
    <img id="img" src="uploads/Trading1.jpg">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" onClick="alert('please log in')" href="index.php"><img src="uploads/favicon.png"></img> Home </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Boards</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" onClick="alert('please log in')">Stocks</a>
              <a class="dropdown-item" onClick="alert('please log in')">Options</a>
              <a class="dropdown-item" onClick="alert('please log in')">Futures</a>
              <a class="dropdown-item" onClick="alert('please log in')">Cryptocurrencies</a>
              <a class="dropdown-item" onClick="alert('please log in')">Trading</a>
              <a class="dropdown-item" onClick="alert('please log in')">Random</a>
              <a class="dropdown-item" onClick="alert('please log in')">Dreamers</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Extra</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" onClick="alert('please log in')">Rules</a>
              <a class="dropdown-item" onClick="alert('please log in')">Contact</a>
            </div>
          </li>
        </ul>
        <form action="php/login_handler.php" class="form-inline my-2 my-lg-0" method="POST">
          <input class="form-control-sm mr-sm-2" type="text" name= "user" placeholder="Username">
          <input class="form-control-sm mr-sm-2" type="password" name= "password" placeholder="Password">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="SUBMIT" value="Log In">Log In</button>
        </form>
      </div>
    </nav>

    <main role="main">
      <div class="header">
        <div class="header_col_1">
          <h1 class="heading"><b>Trader Buzz Forum</b></h1>
          <p><b>The exclusive real-time forum for top traders!</b></p>
        <?php if(@$_GET['signup'] == ''){?>
          <p><a style="color: black; border-color: black; background-color: #18ff00;" class="btn btn-outline-success my-2 my-sm-0" href="index.php?signup=start" role="button">Sign Up &raquo;</a></p>
        <?php } ?>
        </div>


        <?php
        if (@$_GET['signup'] == 'start'){ ?>
            <div class="header_col">
              <div class="form_container">
                <form id="signup_form" action="php/signup.php" method="POST">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                      </div>
                  <input name="user" type="text" class="username" placeholder="Handle" required/></br>
                </div>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-at"></i></div>
                      </div>
                    <input name="email" type="text" class="email" placeholder="Email" required/></br>
                  </div>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                      </div>
                  <input name="password" type="password" class="password" placeholder="Password" required/></br>
                </div>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                      </div>
                  <input name="password_2" type="password" class="password" placeholder="Confirm Password" required/></br>
                </div>
                  <input style="color: black; border-color: black; background-color: #18ff00; margin-left: 30px;" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="SUBMIT" value="SIGN UP"/>
                </form>
              </div></div><?php
        }
        ?>
      </div>
      <div class="side_box">
        <div class="container">
          <img id="img_2" src="uploads/image_2.jpg"></img>
          <p style="padding: 5px; background-color: white; border-radius: 5px; border: 1px solid black;">Gain an edge on market moves with Trader Buzz Forum! Connect with other traders to stay informed, post and read content and updates in real-time!</p>
        </div>
          <p><a style="color: black; border-color: black; background-color: #18ff00;" class="btn btn-outline-success my-2 my-sm-0" onClick="alert('please log in')">Suggest New Board &raquo;</a></p>
      </div>
    </main>
    </main>
    <main role="main">
  <?php
  include 'safe/dbh.php';
  date_default_timezone_set('America/Denver');
  $date = date('y/m/d');
  $sql = "SELECT * FROM threads WHERE date <= '$date' order by vote desc LIMIT 80";
  $result = mysqli_query($dbc_2, $sql);
  while ($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $vote = $row['vote'];
    $date = gmdate("m-d", $row['time']);
    $time = gmdate("H:i", $row['time']);
    $sql_2 = "SELECT * FROM comments WHERE thread_id = '$id'";
    $result_2 = mysqli_query($dbc_2, $sql_2);
    $num = mysqli_num_rows($result_2);
    $sql_4 = "UPDATE threads SET num = '$num' WHERE id = '$id'";
    mysqli_query($dbc_2, $sql_4);
    echo ('<div class="thread_col_container">
      <div class="rowrow">
      <div class="voting_block">
      <a onClick="alert(\'please log in\')">
          <img src="uploads/arrow_up.png"></a>&nbsp;'
          . $vote .'
      <a onClick="alert(\'please log in\')">
          <img src="uploads/arrow_down.png"></a>
      </div>
        <div class="colcol"><a onClick="alert(\'please log in\')" class="thread_links"><b>b/' . $row['board'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Posted by:</b>' . $row['user'] . '
        <b><p class="thread_title">' . $row['thread_title'] . '</p></b><p class="thread_content">' . $row['thread'] . '</p></a><br>');
   echo ('<i class="far fa-comments"></i>&nbsp;&nbsp;' . $num .'&nbsp;&nbsp;&nbsp;<b>On:</b>&nbsp;' . $date . '&nbsp;&nbsp;&nbsp;<b>At:</b>&nbsp;' . $time . 'UTC
    </div></div></div>');
  }
  ?>
</main>
    <br>
    <br>
    <br>
    <footer class="container footer">
      <b><p style="color: white">&copy; Copyright 2019 Trader Buzzz, LLC.™</p></b>
      <br>
      <b><p style="color: white"><i class="fab fa-btc"></i>&nbsp;&nbsp;1LD33TQbQ9LGSXcRQnD73u6hFE7imFkjDs</p></b>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>
