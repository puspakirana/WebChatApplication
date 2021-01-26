<?php

session_start();
include "connection.php";

if(!isset($_SESSION['username']))
{
    header("location:loginregist.php");
}

else
{
?>
<html>
    
    <head>
        <title>My Chat - HOME</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/v4-shims.css">
        <link rel="stylesheet" type="text/css" href="css/chat.css">
        <link rel="stylesheet" href="css/navigation.css" />
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
        
        <div class="container main-section">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                    <div class="input-group searchbox">
                        <div class="input-group-btn">
                            <center>
                                    <p style='font-size: 32px; color:white; margin: 0; padding: 0;'>USERS :</p>
                            </center>
                        </div>
                    </div>
                    <div class="left-chat">
                        <ul>
                            <?php
                                include ("get_user_data.php");
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                    <div class="row">
                        <!-- getting the user information who is logged in -->
                        <?php
                        $username = $_SESSION['username'];
                        $get_user = "select * from user where username = '$username'";
                        $run_user = mysqli_query($mysqli, $get_user);
                        $row = mysqli_fetch_array($run_user);
          
          
                        $username = $row['username'];
                        $id = $row['id'];
                        ?>
                        <!-- getting user data on which user click -->
                        <?php
                        if(isset($_GET['username']))
                        {
                            global $mysqli;
                            
                            $get_username = $_GET["username"];
                            $get_user = "select * from user where username='$get_username'";
                            
                            $run_user = mysqli_query($mysqli, $get_user);
                            
                            $row_user = mysqli_fetch_array($run_user);
                            
                            $users = $row_user['username'];
                        }
                        
                        $total_messages = "select * from chat where (sender_username='$username' AND reciever_username='$users') OR (reciever_username='$username' AND sender_username='$users')";
                        $run_messages = mysqli_query($mysqli, $total_messages);
                        $total = mysqli_num_rows($run_messages);
                        
                        ?>
                        <div class="col-md-12 right-header">
                            <div class="right-header-detail">
                                <form method="post">
                                    <p><?php echo "$users"; ?></p>
                                    <span><?php echo $total;?> messages</span>
                                    &nbsp;
                                    &nbsp;
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="height: 450px;" id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                            <?php
                            
                            $update_msg = mysqli_query($mysqli, "update chat set msg_status='read' where sender_username='$users' AND reciever_username='$username'");
                            
                            $sel_msg = "select * from chat where (sender_username='$username' AND reciever_username = '$users') OR (reciever_username='$username' AND sender_username='$users') ORDER by 1 ASC";
                            
                            $run_msg = mysqli_query($mysqli, $sel_msg);
                            
                            while($row = mysqli_fetch_array($run_msg))
                            {
                                $sender_username = $row['sender_username'];
                                $reciever_username = $row['reciever_username'];
                                $msg_content = $row['msg_content'];
                                $msg_date = $row['msg_date'];
                                $msg_status = $row['msg_status'];
                                
                            ?>
                            <ul>
                                <?php
                                    if($username == $sender_username AND $users == $reciever_username)
                                    {
                                        echo "
                                            <li>
                                                <div class='rightside-right-chat'>
                                                <span style='padding-left: 10px;'>$username &nbsp; <small>$msg_date | $msg_status</small></span>
                                                <p>$msg_content</p>
                                                </div>
                                            </li>
                                        ";
                                    }
                                
                                    else if($username == $reciever_username AND $users == $sender_username)
                                    {
                                        echo "
                                            <li>
                                                <div class='rightside-left-chat'>
                                                <span style='padding-right: 10px;'>$users &nbsp; <small>$msg_date | $msg_status</small></span>
                                                <br>
                                                <p>$msg_content</p>
                                                </div>
                                            </li>
                                        ";
                                    }
                                        
                                ?>
                            </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 right-chat-textbox">
                            <form method="post">
                                <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
                                <button class="btn" name="submit" id="btnSubmit">
                                    <i class="fa fa-telegram" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php
        if(isset($_POST['submit']))
        {
            $msg = htmlentities($_POST['msg_content']);
            
            if($msg == "")
            {
                echo "
                    <div class='alert alert-danger'>
                        <strong><center>Message was unable to send</center></strong>
                    </div>
                ";
            }
            
            else if(strlen($msg)>100)
            {
                echo "
                    <div class='alert alert-danger'>
                        <strong><center>Message is too long. Use only 100 characters</center></strong>
                    </div>
                ";
            }
            
            else
            {
                $insert = "insert into chat(sender_username, reciever_username, msg_content, msg_status, msg_date) values('$username', '$users', '$msg', 'unread', NOW())";
                
                $run_insert = mysqli_query($mysqli, $insert);
                
                if($run_insert)
                {
                    echo "<script>window.open('home.php?username=$users', '_self');</script>";
                }
                
            }
        }
        ?>
        
        
    </body>
    
</html>
<?php
}
?>