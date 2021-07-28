<?php
  include 'safe/dbh.php';
  session_start();
  $usn = mysqli_real_escape_string ($dbc, $_GET['user']);
  $board = mysqli_real_escape_string ($dbc, $_GET['board']);
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
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Dreamers Board</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="uploads/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
        <div class="container">
          <h1> Dreamers
            <br />
      <?php if(@$_GET['thread'] == ''){?>
          <p><a style="color: black; border-color: black; background-color: #18ff00;" class="btn btn-outline-success my-2 my-sm-0" href="dreamers.php?user=<?php echo $usn ?>&board=<?php echo $board ?>&thread=start" role="button">Create New Thread &raquo;</a></p>
      <?php } ?>

      <?php if (@$_GET['thread'] == 'start'){?>
          <form action="php/create_thread.php?user=<?php echo($usn); ?>&board=<?php echo($board) ?>" method="POST">
            <div class="input-group">
            <input style="margin-top: 30px;" class="thread_input" name="thread_title" type="text" placeholder="Title" rows="1" required/>
          </div>
            <div class="input-group">
                <div style="margin-top: 20px;" class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-lightbulb"></i></div>
                </div>
            <textarea style="margin-top: 20px;" class="thread_input" name="thread" type="text" placeholder="New Thread" rows="3" required></textarea>
          </div>
          <br>
          <input style="color: black; border-color: black; background-color: #18ff00; margin-left: 30px;" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="SUBMIT" value="Create"/>
          </form>
      <?php } ?>
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
      $sql = "SELECT * FROM threads WHERE date <= '$date' and board = '$board' order by id desc";
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
            <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&vote=like">
                <img src="uploads/arrow_up.png"></a>&nbsp;'
                . $vote .'
            <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&vote=dislike">
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
