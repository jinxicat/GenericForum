<?php
  include 'safe/dbh.php';
  session_start();
  $usn = mysqli_real_escape_string ($dbc, $_GET['user']);
// vote count
  $sql = "SELECT * FROM threads";
  $result = mysqli_query($dbc_2, $sql);
  while ($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $sql_3 = "SELECT * FROM voting WHERE thread_id = '$id' AND up = '1'";
    $sql_4 = "SELECT * FROM voting WHERE thread_id = '$id' AND down = '1'";
    $result_3 = mysqli_query($dbc_2, $sql_3);
    $result_4 = mysqli_query($dbc_2, $sql_4);
    $vote = mysqli_num_rows($result_3);
    $down = mysqli_num_rows($result_4);
    $vote -= $down;
    $sql_5 = "UPDATE threads SET vote = '$vote' WHERE id = '$id'";
    mysqli_query($dbc_2, $sql_5);
}
// kick out non users
$sql = "SELECT * FROM credentials WHERE user = $usn";
$result = mysqli_query($dbc_2, $sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Members Area</title>
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
  .thread_title{font-size: 1.3rem}
  .thread_content{font-size: 1.1rem}
  .header{vertical-align: top; display: inline-block; border-radius: 5px; z-index: 10; padding: 2%; width: 60%; opacity: 0.9; background-color: gray; color: black; margin-left: 1.5%; margin-right: 1.5%; margin-top: 3vh; border: 1px solid black;}
  .heading {font-family: "Impact", "Charcoal", sans-serif; font-size: 3rem;}
  .heading_p{font-family: "Impact", "Charcoal", sans-serif; font-size: 1.5rem; line-height: normal;}
  .side_box{position: absolute; color: black; background-image: "uploads/image.png"; background-size: cover; padding-top: 10vh; text-align: center; position: absolute; vertical-align: top; display: inline-block; width: 35%; margin-top: 3vh; height: 40vh; border-radius: 5px; border: 1px solid black; background-color: gray; opacity: 0.9;}
  .btn{color: white;border-color: white;}
  .dropdown-item:hover{background-color: gray;}
  .rowrow{vertical-align: top; display: inline-block; width: 60%; margin-top: 1%; margin-left: 2.5%; margin-right: 2.5%; background-color: white; border-radius: 5px; opacity: 0.8; border: 1px solid black;}
  .colcol{vertical-align: top; display: inline-block; width: 92%; padding-left: 6%; padding-bottom: 10px; margin-left: 1%; color: black;word-wrap: break-word;}
  .voting_block{width: 2.5%; display: inline-block; padding-left: 5px;}
  a.thread_links{color: Black;}
  p{line-height: 20px;}
  #img {position: fixed; top: -50%; left: -50%; width: 200%; height: 200%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
  #img img{position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
  #img_2 {border-radius: 5px; position: absolute;; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
  #img_2 img{top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
  @media screen and (max-width : 1200px){.side_box{font-size: 0.9rem} .colcol{font-size: 0.9rem;} .heading{font-size: 2.2rem;}}
  @media screen and (max-width : 980px){.side_box{font-size: 0.8rem} .header_col{width: 50%; margin-left: 60%; margin-top: -4vw} .colcol{font-size: 0.8rem;} .heading{font-size: 2rem;} .heading_p{font-size: 1.2rem;}}
  @media screen and (max-width : 800px){.side_box{font-size: 0.7rem} .header_col{width: 50%; margin-left: 25%; margin-top: 0vw} .colcol{font-size: 0.7rem;}.header{width: 90%; position: relative;}.side_box{width: 90%; position: relative; margin-left: 1.5%} .rowrow{width: 95%; margin-top: 3vh;}}
  @media screen and (max-width : 600px){.side_box{font-size: 0.6rem} .header_col{width: 50%; margin-left: 25%; margin-top: 0vw} .colcol{font-size: 0.6rem;} .heading_p{font-size: 1rem;}.thread_title{font-size: 1rem}.thread_content{font-size: 0.9rem}}
  @media screen and (max-width : 400px){.side_box{font-size: 0.5rem} .header_col{width: 50%; margin-left: 0%; margin-top: 2vw} .colcol{font-size: 0.5rem;} .heading{font-size: 1.4rem;}.thread_title{font-size: 0.8rem}.thread_content{font-size: 0.7rem}}
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

    <main role="main">
      <div class="header">
        <p class="heading_p">
          <?php
          if (@$_GET['signup'] == 'success'){
            echo("Awesome! Your account was created $usn.");
          }
          if (@$_GET['rules'] == 'violation'){
            echo("However, you have created an account before. More violations will result in termination...");
          }
          ?>
        </p>
        <div class="container">
          <h1 class="heading"><i class="fa fa-fire"></i> Most Popular Threads This Month</h1>
        </div>
      </div>
      <div class="side_box">
        <div class="container">
          <img id="img_2" src="uploads/image_2.jpg"></img>
          <p style="padding: 5px; background-color: white; border-radius: 5px; border: 1px solid black;">Gain an edge on market moves with Trader Buzz Forum! Connect with other traders to stay informed, post and read content and updates in real-time!</p>
        </div>
          <p><a style="color: black; border-color: black; background-color: #18ff00;" class="btn btn-outline-success my-2 my-sm-0" href="suggest_form.php?user=<?php echo $usn ?>" role="button">Suggest New Board &raquo;</a></p>
      </div>
    </main>
    <main role="main">
  <?php
  include 'safe/dbh.php';
  date_default_timezone_set('America/Denver');
  $date = date('y/m/d');
  $sql = "SELECT * FROM threads WHERE date <= '$date' order by vote desc LIMIT 100";
  $result = mysqli_query($dbc_2, $sql);
  while ($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $vote = $row['vote'];
    //$date = date("m-d",strtotime($row['date']));
    $date = gmdate("m-d", $row['time']);
    $time = gmdate("H:i", $row['time']);
    //$date = date_create_from_format ('m/d h:i' , $row['time'], 'EST');
    $sql_2 = "SELECT * FROM comments WHERE thread_id = '$id'";
    $result_2 = mysqli_query($dbc_2, $sql_2);
    $num = mysqli_num_rows($result_2);
    $sql_4 = "UPDATE threads SET num = '$num' WHERE id = '$id'";
    mysqli_query($dbc_2, $sql_4);
      echo ('<div class="thread_col_container">
        <div class="rowrow">
        <div class="voting_block">
        <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&member=1&vote=like">
            <img src="uploads/arrow_up.png"></a>&nbsp;'
            . $vote .'
        <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&member=1&vote=dislike">
            <img src="uploads/arrow_down.png"></a>
        </div>
          <div class="colcol"><a href="thread.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '" class="thread_links"><b>b/' . $row['board'] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Posted by:</b>' . $row['user'] . '
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
