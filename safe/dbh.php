<?php

$dbServername = "";
$dbUsername = "";
$dbUsername_2 = "";
$dbPassword = "";
$dbPassword_2 = "";
$dbName = "";

$dbc = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
$dbc_2 = mysqli_connect($dbServername, $dbUsername_2, $dbPassword_2, $dbName);
$connect = new PDO('mysql:host=localhost;dbname=dbname', 'table user', 'password');
