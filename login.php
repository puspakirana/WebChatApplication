<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'connection.php';

$username = $_POST["username"];
$password = $_POST["password"];
$flag = 'true';

$result = $mysqli->query('SELECT username, password from user order by id asc');

if($result === FALSE){
  die(mysql_error());
}

if($result){
  while($obj = $result->fetch_object()){
    if($obj->username === $username && $obj->password === $password) {
		//kalau bener
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      header("location:home.php?username");
    } else {

        if($flag === 'true'){
          redirect();
          $flag = 'false';
        }
    }
  }
}

function redirect() {
  echo '<h1>Invalid Login! Redirecting...</h1>';
  header("Refresh: 3; url=loginregist.php");
}

?>
