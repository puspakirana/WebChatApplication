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
        
        <br>
        <br>        

            <div class="respond">
                <?php
                if(isset($_POST['submit']))
                {
                    $name=$_POST['name'];
                    $email=$_POST['email'];
                    $phone=$_POST['phone'];
                    $msg=$_POST['msg'];
    
                    $to='chatmyprivate@gmail.com';
                    $subject='My Private Chat Question/Suggestion/Report Error';
                    $message="Name: ". $name ."\n". "Phone: ".$phone."\n"."Dear Nike Preloved Store,"."\n\n".$msg;
                    $headers="From: ".$email;
    
                    if($mail->send)
                    {
                        echo "Sent Succesfully! Thank you"." ".$name.". We will contact you shortly!";
                    }
    
                    else
                    {
                        echo "Something went wrong! Please try again!";
                    }
                }
                ?>
                
            </div>
    </body>
</html>

<?php } ?>