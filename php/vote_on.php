<?php
include '../safe/dbh.php';

$vote = mysqli_real_escape_string ($dbc, $_GET['vote']);
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
$thread_id = mysqli_real_escape_string ($dbc, $_GET['id']);
$board = mysqli_real_escape_string ($dbc, $_GET['board']);

if($vote == 'like'){
  $up = 1; $down = 0;
} else {
  $up = 0; $down = 1;
}

// determine if user has alread voted
$sql = "SELECT * FROM voting WHERE thread_id = '$thread_id' and user = '$usn'";
$result = mysqli_query($dbc_2, $sql);
$row = mysqli_num_rows($result);

// delete old vote and determine if voter liked or disliked
if($row == 1){
  $sql_up_check = "SELECT * FROM voting WHERE thread_id = '$thread_id' and user = '$usn' and up = '1'";
  $result_up_check = mysqli_query($dbc_2, $sql_up_check);
  if (mysqli_num_rows($result_up_check) == 1){
  $up_check = 1;
}
  $sql_down_check = "SELECT * FROM voting WHERE thread_id = '$thread_id' and user = '$usn' and down = '1'";
  $result_down_check = mysqli_query($dbc_2, $sql_down_check);
  if (mysqli_num_rows($result_down_check) == 1){
  $down_check = 1;
}
}

// add vote and alert user
  $isTouch_up = isset($up_check);
  $isTouch_down = isset($down_check);
  if($up == 1 && $isTouch_up == 0){
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }
  if($up == 1 && $isTouch_up == 1){
    //echo("You already liked this thread!");
  }
  if($down == 1 && $isTouch_down == 1){
    //echo("You already disliked this thread!");
  }
  if($down == 1 && $isTouch_down == 0){
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }
  if($up == 1 && $isTouch_down == 1){
    $sql_2 = "DELETE FROM voting WHERE thread_id = '$thread_id' and user = '$usn'";
    mysqli_query($dbc_2, $sql_2);
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }
  if ($down == 1 && $isTouch_up == 1){
    $sql_2 = "DELETE FROM voting WHERE thread_id = '$thread_id' and user = '$usn'";
    mysqli_query($dbc_2, $sql_2);
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }

  if ($_GET['member'] == '' && $board == 'trading' && $_GET['thread'] == ''){
  header('Location: ../trading.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'random' && $_GET['thread'] == ''){
  header('Location: ../random.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == 1 && $_GET['thread'] == ''){
  header('Location: ../members-index.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'dreamers' && $_GET['thread'] == ''){
  header('Location: ../dreamers.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'stocks' && $_GET['thread'] == ''){
  header('Location: ../stocks.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'options' && $_GET['thread'] == ''){
  header('Location: ../options.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'futures' && $_GET['thread'] == ''){
  header('Location: ../futures.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $board == 'cryptocurrencies' && $_GET['thread'] == ''){
  header('Location: ../futures.php?user=' . $usn . '&board=' . $board . '');
  }
  if ($_GET['member'] == '' && $_GET['thread'] == '1'){
  header('Location: ../thread.php?user=' . $usn . '&id=' . $thread_id . '&board=' . $board . '');
  }
