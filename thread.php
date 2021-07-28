<?php
include 'safe/dbh.php';
$id = mysqli_real_escape_string ($dbc, $_GET['id']);
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
$board = mysqli_real_escape_string ($dbc, $_GET['board']);
// comment count
$sql_2 = "SELECT * FROM comments WHERE thread_id = '$id'";
$result_2 = mysqli_query($dbc_2, $sql_2);
$num = mysqli_num_rows($result_2);
// vote count
$sql_up = "SELECT * FROM voting WHERE thread_id = '$id' and up = '1'";
$result_up = mysqli_query($dbc_2, $sql_up);
$vote = mysqli_num_rows($result_up);
$sql_down = "SELECT * FROM voting WHERE thread_id = '$id' and down = '1'";
$result_down = mysqli_query($dbc_2, $sql_down);
$down_count = mysqli_num_rows($result_down);
$vote -= $down_count;
$sql_vote = "UPDATE threads SET vote = '$vote' WHERE id = '$id'";
mysqli_query($dbc_2, $sql_vote);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Thread - b/ <?php echo $board ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="uploads/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
.test_button{width: 200px; background-color: orange; cursor: pointer;}
.reply_button{border-radius: 5px; background-color: black; color: white;}
.comment{border-radius: 5px; background-color: black; color: white;}
.comment_form{width: 65vw; margin-left: 15%; margin-top: 2%; display: inline-block;}
.dropdown-item:hover{background-color: gray;}
.thread{vertical-align: top; width: 95%; margin-left: 1%; padding-left: 3%; display: inline-block; color: black;word-wrap: break-word;}
.thread_row{width: 100%; margin-left: 2.5%; margin-right: 2.5%; background-color: white; border-radius: 5px; opacity: 0.8; border: 1px solid black;}
.comrow{width: 70%; margin-right: 2.5%; background-color: white; border-radius: 5px; opacity: 0.8; border: 1px solid black;}
.comcol{width: 100%; margin-right: 2.5%; display: inline-block; color: black; word-wrap: break-word;}
.rowrow{width: 100%; margin-left: 2.5%; margin-right: 2.5%; background-color: white; border-radius: 5px; opacity: 0.8; border: 1px solid black;}
.colcol{vertical-align: top; display: inline-block; width: 95%; padding-left: 1%; padding: 10px; margin-left: 1%; color: black;word-wrap: break-word;}
.voting_block{width: 2.5%; display: inline-block; padding-left: 5px;}
.thread_content{font-size: 1.1rem;}
.thread_title{font-size: 1.3rem;}
p{line-height: 25px;}
a.thread_links{color: Black;}
#img {position: fixed; top: -50%; left: -50%; width: 200%; height: 200%; z-index: -1; opacity: 0.9; background-repeat: repeat-y;}
#img img{position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; min-width: 50%; min-height: 50%;}
@media screen and (max-width : 1200px){.thread{padding-left: 3%;}}
@media screen and (max-width : 980px){.thread{padding-left: 4%;}.colcol{font-size: 1rem;}.thread_content{font-size: 1.1rem;}.thread_title{font-size: 1.25rem;}.comrow{}.comcol{}}
@media screen and (max-width : 800px){.thread{padding-left: 6%;}.colcol{font-size: 0.95rem;}.thread_content{font-size: 1rem;}.thread_title{font-size: 1.15rem;}.comrow{}.comcol{font-size: 0.9rem}}
@media screen and (max-width : 600px){.thread{padding-left: 8%;}.colcol{font-size: 0.85rem;}.thread_content{font-size: 0.95rem;}.thread_title{font-size: 1.05rem;}.comrow{}.comcol{font-size: 0.8rem}}
@media screen and (max-width : 400px){.thread{padding-left: 10%; width: 80%}.colcol{font-size: 0.75rem;}.thread_content{font-size: 0.9rem;}.thread_title{font-size: 1rem;}.comrow{width: 70%}.comcol{font-size: 0.7rem}}
</style>
</head>

<script type="text/javascript">  sessionStorage.removeItem('thread_id'); sessionStorage.setItem('thread_id', <?php echo $id ?>); sessionStorage.removeItem('board'); sessionStorage.setItem('board', "<?php echo $board ?>"); sessionStorage.removeItem('user'); sessionStorage.setItem('user', "<?php echo $usn ?>")</script>
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
<br>
<br>
<?php
// comment Count
$sql_2 = "SELECT * FROM comments WHERE thread_id = '$id'";
$result_2 = mysqli_query($dbc_2, $sql_2);
$num = mysqli_num_rows($result_2);

$sql = "SELECT * FROM threads WHERE id = '$id'";
$result = mysqli_query($dbc_2, $sql);
while ($row = mysqli_fetch_array($result)){
  $date = gmdate("m-d", $row['time']);
  $time = gmdate("H:i", $row['time']);
    echo ('
    <div class="container">
      <div class="rowrow" style="background-color: #00ff36">
        <div class="colcol" style="color: black;">
          <b>b/' . $row['board'] . '</b>&nbsp;&nbsp;&nbsp;<b>Posted by:</b>&nbsp;' . $row['user'] .'
        </div>
      </div>
    </div>');

    echo ('<div class="container">
      <div class="rowrow">
      <div class="voting_block">
      <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&vote=like&thread=1">
          <img src="uploads/arrow_up.png"></a>&nbsp;'
          . $row['vote'] .'
      <a href="php/vote_on.php?user=' . $usn . '&id=' . $row['id'] . '&board=' . $row['board'] . '&vote=dislike&thread=1">
          <img src="uploads/arrow_down.png"></a></div>
        <div class="thread"><b><p class="thread_title">' . $row['thread_title'] . '</p></b><p class="thread_content">' . $row['thread'] . '</p></div><br><br>
        <div class="colcol">
          <i class="far fa-comments"></i>&nbsp;&nbsp;' . $num .'&nbsp;&nbsp;&nbsp;<b>On:</b>&nbsp;' . $date .'&nbsp;&nbsp;&nbsp;<b>At:</b>&nbsp;' . $time .'UTC<br>
          <b><a class="comment" style="justify-content: center;" href="thread.php?user=' . $usn . '&id=' . $id . '&board=' . $board . '&comment=start" role="button">Comment on Thread&raquo;</a></b>
        </div></div></div>
');
}
if (@$_GET['comment'] == 'start'){ ?>
  <form id="comment_form" method="POST">
  <div class="form_group">
      <input class="form_control" type="hidden" name="name" id="name" value="<?php echo $usn ?>"/>
      <input class="form_control" type="hidden" name="thread_id" id="thread_id" value="<?php echo $id ?>"/>
  </div>
  <div class="form_group">
    <textarea class="form_control comment_form" style="margin-left: 5%; width: 60%" name="comment_content" id="comment_content" placeholder="Comment" rows="3"></textarea>
  </div>
  <div class="form_group" style="margin-left: 50%">
    <input type="hidden" name="comment_id" id="comment_id" value="0"/>
    <input class="btn btn-success btn-sm" type="submit" name="submit" onclick="javascript:location='thread.php?user=<?php echo $usn ?>&id=<?php echo $id ?>&board=<?php echo $board ?>';void(0)" id="submit" value="Comment"/>
  </div>
  </form> <?php
}
?>
<br>
<br>
<script src="js/track_mouse.js"></script>
<span id="comment_message"></span>
<br />
<div id="display_comment"></div>

<!--Display and Update Comments-->
<script type="text/javascript">
window.onload = load_comment;
var thread_id = sessionStorage.getItem('thread_id');
var user = sessionStorage.getItem('user');
var board = sessionStorage.getItem('board');
  function load_comment()
  {
    $.ajax({
      url:"php/fetch_comment.php?user="+user+"&id="+thread_id+"&board="+board+"",
      method:"POST",
      success:function(data)
      {
        $('#display_comment').html(data);
      }
    })
  }
  $(document).on('click', '.reply', function(){
    var comment_id = $(this).attr("id");
    $('#comment_id').val(comment_id);
    //$('#name').focus();
});

var showForm = function(id){
  document.getElementById(id).style.display = '';
}

</script>
<script src="js/comments.js"></script>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
</body>

<footer class="container footer">
  <b><p style="color: white">&copy; Copyright 2019 Trader Buzzz, LLC.™</p></b>
  <br>
  <b><p style="color: white"><i class="fab fa-btc"></i>&nbsp;&nbsp;1LD33TQbQ9LGSXcRQnD73u6hFE7imFkjDs</p></b>
</footer>
</html>
