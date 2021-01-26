<?php

$con = mysqli_connect("localhost", "root", "", "dataproject");

    $userdata= "select * from user";

    $run_user = mysqli_query($con, $userdata);

    while ($row_user=mysqli_fetch_array($run_user))
    {
        $username = $row_user['username'];
        $id = $row_user['id'];
        
        echo "
        
            <li>
                <div class='chat-left-detail'>
                    <p><a style='color:white;' href='home.php?username=$username' ><strong>$username</strong></a></p>
                </div>
            </li>
        
        ";
    }
?>