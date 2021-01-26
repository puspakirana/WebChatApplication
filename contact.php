
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
        <link rel="stylesheet" type="text/css" href="css/contact.css">
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

        
                
<!--contact form-->
        
            <div class="container contact">
                
                <h1>Report error or Send a message!</h1>
                <div class="fileopen">
                    <?php $myfile = fopen("index.txt", "r") or die ("Unable to open file!");
                    echo fread($myfile, filesize("index.txt"));
                    fclose($myfile); ?>
                </div>
                <hr>
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <p>e-mail: chatmyprivate@gmail.com</p>
                        
                        
                    </div>
                    
                    <?php
                    $username = $_SESSION['username'];
                    $get_user = "select * from user where username = '$username'";
                    $run_user = mysqli_query($mysqli, $get_user);
                    $row = mysqli_fetch_array($run_user);
          
          
                    $username_ = $row['username'];
                    $email = $row['email'];
                    ?>
                    
                    <div class="col-md-6">
                        <form name="form" method="get" action="send.php">
                        
                            <div class="form-group">
                                <label>Username:</label>
                                <input name="name" type="text" class="form-control" value="<?php echo $username_; ?>">
                            </div>
                        
                            <div class="form-group">
                                <label>e-mail:</label>
                                <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                        
                            <div class="form-group">
                                <label>Phone:</label>
                                <input name="phone" type="text" class="form-control">
                            </div>
                        
                            <div class="form-group">
                                <label>Message:</label>
                                <textarea name="msg" class="form-control" row="5"></textarea>
                            </div>
                        
                            <div class="form-group">
                                <button onclick="send()" class="btn btncolor2" name="submit">Send</button>
                            </div>
                        
                        </form>
                        
                    </div>
                    
                
                </div>
            </div>
        
        
        
        <script>
            function send()
            {
                var xhtt = new XMLHttpRequest();
                xhttp.onreadystatechange = function()
                {
                    if(this.readyState == 4 && this.status == 200)
                        {
                            document.getElementById("contact").innerHTML = this.responseText;
                        }
                };
                xhttp.open("GET", "send.php", true);
                xhttp.send();
                
            }
        </script>
    </body>
    
</html>
<?php } ?>