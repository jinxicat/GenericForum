<?php
include '../safe/dbh.php';

if(isset($_POST)){
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
$suggested_board = mysqli_real_escape_string ($dbc, $_POST['suggestion']);
$message = mysqli_real_escape_string ($dbc, $_POST['message']);

// check how many suggestions user trader_made

$sql = "SELECT * FROM suggestions WHERE user = '$usn'";
$result = mysqli_query($dbc_2, $sql);
$num = mysqli_num_rows($result);

if($num > 5){
echo ("You can only make 5 suggestions per month. You will be redirected shortly...");
header("Refresh:5; ../members-index.php?user=$usn");

} else {
echo ("Thank you for your suggestion. You will be redirected shortly...");
$sql_2 = "INSERT INTO suggestions (user, suggested_board, message) VALUES ('$usn', '$suggested_board', '$message')";
mysqli_query($dbc_2, $sql_2);
header("Refresh:5; ../members-index.php?user=$usn");
}
}

?>
