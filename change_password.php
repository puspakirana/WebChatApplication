<?php

session_start();
include 'connection.php';

if(!isset($_SESSION["username"])) {
  echo '<h1>Invalid Login! Redirecting...</h1>';
  header("Refresh: 1; url=loginregist.php");
}

else{ ?>
<html>
  <head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/navigation.css" />
    <link rel="stylesheet" href="css/pass.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.min.js"></script>
  </head>
  <body>

   <!--navigation-->
                <div class="container">
                        <nav>
                                
                                <input type="checkbox" id="nav" class="hidden">
                                <label for="nav" class="nav-btn">
                                    <i></i>
                                    <i></i>
                                    <i></i>
                                </label>
                                
                                <div class="nav-wrapper">
                                    <ul>
                                        <li><a href="home.php?username">MY CHAT</a></li>
                                        <?php

                                            if(isset($_SESSION['username'])){
                                                echo '<li class="active"><a href="account.php">ACCOUNT</a></li>';
                                                echo '<li><a href="contact.php">CONTACT US</a></li>';
                                                echo '<li><a href="logout.php">LOGOUT</a></li>';
                                            }
                                            else{
                                                echo '<li><a href="loginregist.php">LOGIN / REGISTER</a></li>';
                                            }
                                        ?>
                                        
                                    </ul>
                                </div>

                                
                            </nav>
                </div>
      <br>
      <br>
      <br>
      <div class="row">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-8">
              <form action="" method="post" enctype="multipart/form-data">
                  <table class="table table-bordered table-hover">
                      <tr align="center">
                          <td colspan="6" class="active"><h2>Change Password</h2></td>
                      </tr>
                      
                      <tr>
                          <td style="font-weight: bold;">Change Password</td>
                          <td>
                              <input id="mypass" type="password" name="current_pass" class="form-control" required placeholder="Current Password">
                          </td>
                      </tr>
                      
                      <tr>
                          <td style="font-weight: bold;">New Password</td>
                          <td>
                              <input id="mypass" type="password" name="new_pass1" class="form-control" required placeholder="New Password">
                          </td>
                      </tr>
                      
                      <tr>
                          <td style="font-weight: bold;">Confirm Password</td>
                          <td>
                              <input id="mypass" type="password" name="new_pass2" class="form-control" required placeholder="Confirm Password">
                          </td>
                      </tr>
                      
                      <tr align="center">
                          <td colspan="6">
                              <input type="submit" value="CHANGE PASSWORD" name="change" style="width: auto; padding: 10px 30px; cursor: pointer; display: block; margin: 20px auto; background: linear-gradient(to right, #ff105f, #ffad06); border: 0; outline: none; border-radius: 30px">
                          </td>
                      </tr>
                      
                  </table>
              </form>
              <?php
                if(isset($_POST['change']))
                {
                    $current_pass = $_POST['current_pass'];
                    $new_pass1 = $_POST['new_pass1'];
                    $new_pass2 = $_POST['new_pass2'];
                    
                    $username = $_SESSION['username'];
                    $get_user = "select * from user where username = '$username'";
                    $run_user = mysqli_query($mysqli, $get_user);
                    $row = mysqli_fetch_array($run_user);
          
          
                    $password = $row['password'];
                    $id = $row['id'];
                    
                    if($current_pass !== $password)
                    {
                        echo "
                        <div class='alert alert-danger'>
                            <center><strong style='color: red;'>Your old password didn't match</strong></center>
                        </div>
                        ";
                    }
                    
                    if($new_pass1 != $new_pass2)
                    {
                        echo "
                        <div class='alert alert-danger'>
                            <center><strong style='color: red;'>Your new password didn't match with confirm password</strong></center>
                        </div>
                        ";
                    }
                    
                    if($new_pass1 == $new_pass2 AND $current_pass == $password)
                    {
                        $update_pass = mysqli_query($mysqli, "UPDATE user SET password='$new_pass1' WHERE id='$id'");
                        echo "
                        <div class='alert alert-danger'>
                            <center><strong style='color: red;'>Your password has been changed</strong></center>
                        </div>
                        ";
                    }
                }
              ?>
          </div>
          <div class="col-sm-2">
          </div>
      </div>
      
    </body>
</html>
<?php
}
?>