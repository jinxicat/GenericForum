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
    echo("You liked this thread!");
  }
  if($up == 1 && $isTouch_up == 1){
    echo("You already liked this thread!");
  }
  if($down == 1 && $isTouch_down == 1){
    echo("You already disliked this thread!");
  }
  if($down == 1 && $isTouch_down == 0){
    echo("You disliked this thread!");
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }
  if($up == 1 && $isTouch_down == 1){
    echo("&nbsp;");
    echo("Your old vote was replaced.");
    $sql_2 = "DELETE FROM voting WHERE thread_id = '$thread_id' and user = '$usn'";
    mysqli_query($dbc_2, $sql_2);
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }
  if ($down == 1 && $isTouch_up == 1){
    echo("&nbsp;");
    echo("Your old vote was replaced.");
    $sql_2 = "DELETE FROM voting WHERE thread_id = '$thread_id' and user = '$usn'";
    mysqli_query($dbc_2, $sql_2);
    $sql_3 = "INSERT INTO voting (thread_id, user, up, down) VALUES ('$thread_id', '$usn', '$up', '$down')";
    mysqli_query($dbc_2, $sql_3);
  }

header("Refresh:2; url='../thread.php?user=$usn&id=$thread_id&board=$board'");
