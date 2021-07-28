<?php
require '../safe/dbh.php';
date_default_timezone_set('America/Denver');

if(isset($_POST)){
  $thread_title = mysqli_real_escape_string ($dbc, $_POST['thread_title']);
  $thread = mysqli_real_escape_string ($dbc, $_POST['thread']);
  $board = mysqli_real_escape_string ($dbc, $_GET['board']);
  $usn = mysqli_real_escape_string ($dbc, $_GET['user']);
  $date = date('y/m/d');
  $time = time();

$sql_1 = "SELECT * FROM threads WHERE time < '$time' and user = '$usn' order by time desc";
$result_1 = mysqli_query($dbc, $sql_1);

if(mysqli_num_rows($result_1) > 0){
  $row = mysqli_fetch_array($result_1);
  $test_time = $row['time'] + 300;
  if($time > $test_time){
    $sql = "INSERT INTO `threads` (`date`, `time`, `user`, `thread_title`, `thread`, `board`, `vote`) VALUES ('$date', '$time', '$usn', '$thread_title', '$thread', '$board', '0')";
    mysqli_query($dbc, $sql);
    echo("Creating Thread...");
    echo '<script> setTimeout(function(){location.href="../' . $board . '.php?user=' . $usn . '&board=' . $board . '"} , 2000);</script>';
    //header("Refresh:2 ../$board.php?user=$usn&board=$board");
} else {
  echo("You must wait 5 minutes before creating a new thread...");
  echo '<script> setTimeout(function(){location.href="../' . $board . '.php?user=' . $usn . '&board=' . $board . '"} , 2000);</script>';
  //header("Refresh:3 ../$board.php?user=$usn&board=$board");
}
} else {
  $sql = "INSERT INTO `threads` (`date`, `time`, `user`, `thread_title`, `thread`, `board`, `vote`) VALUES ('$date', '$time', '$usn', '$thread_title', '$thread', '$board', '0')";
  mysqli_query($dbc, $sql);
  echo("Creating Thread...");
  echo '<script> setTimeout(function(){location.href="../' . $board . '.php?user=' . $usn . '&board=' . $board . '"} , 2000);</script>';
  //header("Refresh:2 ../$board.php?user=$usn&board=$board");
}
}
