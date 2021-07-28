<?php
include '../safe/dbh.php';
date_default_timezone_set('America/Denver');

$error = '';
$name = '';
$thread_id = '';
$comment_content = '';
$time = time();

if(empty($_POST["name"]))
{
  $error .= '<p class="text_danger">Name is required</p>';
} else {
  $name = mysqli_real_escape_string ($dbc, $_POST["name"]);
}

if(empty($_POST["comment_content"]))
{
  $error .= '<p class="text_danger">Comment is required</p>';
} else {
  $comment_content = mysqli_real_escape_string ($dbc, $_POST["comment_content"]);
}

if($error == '')
{
  $query = "INSERT INTO comments (parent_comment_id, thread_id, comment, user, time_stamp)
  VALUES (:parent_comment_id, :thread_id, :comment, :name, :time_stamp)";
  $statement = $connect->prepare($query);
  $statement->execute(
    array(
      ':parent_comment_id' => mysqli_real_escape_string ($dbc, $_POST["comment_id"]),
      ':thread_id'         => mysqli_real_escape_string ($dbc, $_POST["thread_id"]),
      ':comment'           => $comment_content,
      ':name'              => $name,
      ':time_stamp'        => $time
    )
  );
  $error = '<label class="text_success"></label>';
}

$data = array(
    'error'     => $error
);

echo json_encode($data);
