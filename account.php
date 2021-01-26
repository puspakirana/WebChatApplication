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
    <title>My Account</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/v4-shims.css">
    <link rel="stylesheet" href="css/navigation.css" />
    <link rel="stylesheet" href="css/account.css" />
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
      <div class="row">
          <div class="col-sm-2">
          </div>
          <?php
          $username = $_SESSION['username'];
          $get_user = "select * from user where username = '$username'";
          $run_user = mysqli_query($mysqli, $get_user);
          $row = mysqli_fetch_array($run_user);
          
          
          $username_ = $row['username'];
          $email = $row['email'];
          $password = $row['password'];
          $id = $row['id'];
          ?>
          
          <div style="color:white;" class="col-sm-8">
              <form action="" method="post" enctype="multipart/form-data">
                  <table class="table table-bordered table-hover">
                      <tr align="center">
                          <td colspan="6" class="active"><h2>Change Account Setting</h2></td>
                      </tr>
                      <tr>
                          <td style="font-weight: bold;">Change your username</td>
                          <td>
                              <input type="text" name="user_name" class="form-control" required value="<?php
                                    echo $username_;
                                ?>">
                          </td>
                      </tr>
                      
                      <tr>
                          <td style="font-weight: bold;">Change your email</td>
                          <td>
                              <input type="email" name="user_email" class="form-control" required value="<?php
                                    echo $email;
                                ?>">
                          </td>
                      </tr>
                      
                      <tr>
                          <td>
                          </td>
                          <td>
                              <a class="btn btn-default" style="color:white; text-decoration:none; font-size:15px;" href="change_password.php">
                                  <i class="fa fa-key fa-fw" aria-hidden="true"></i>
                                  Change Password
                              </a>
                          </td>
                      </tr>
                      
                      <tr align="center">
                          <td colspan="6">
                              <input type="submit" value="UPDATE" name="update" style="width: 50%; padding: 10px 30px; cursor: pointer; display: block; margin: 20px auto; background: linear-gradient(to right, #ff105f, #ffad06); border: 0; outline: none; border-radius: 30px">
                          </td>
                      </tr>
                      
                  </table>
              </form>
              <?php
              
                if(isset($_POST['update']))
                {
                    $username_ = htmlentities($_POST['user_name']);
                    $email = htmlentities($_POST['user_email']);
                    
                    $update = "update user set username='$username_', email='$email' where id='$id'";
                    $update2 = "UPDATE chat SET sender_username = '$username_' where sender_username='$username'";
                    $update3  = "update chat set reciever_username = '$username_' where reciever_username='$username'";
                    $run = mysqli_query($mysqli, $update);
                    $run2 = mysqli_query($mysqli, $update2);
                    $run3 = mysqli_query ($mysqli, $update3);
                    $_SESSION['username'] = $username_;
                    if($run2)
                    {
                        if($run3)
                        {
                            if($run)
                            {
                                echo "
                                <script>alert('Updated!');</script>
                                ";
                                echo "<script>window.open('account.php', '_self');</script>";
                            }
                        }
                    }
                    
                }
              
              ?>
          </div>
          <div class="col-sm-2">
          </div>
      </div>
          
    </body>
</html>
<?php } ?>