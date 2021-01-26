<?php

include 'connection.php';

$username = $_POST["username_"];
$email = $_POST["email_"];
$password = $_POST["password_"];


$sql = $mysqli->query("INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");

header ("location:loginregist.php");

?>
