<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}

if (isset($_SESSION["username"])) {header ("location:loginregist.php");}

?>

<!doctype html>
<html>
  <head>
      <title>Captcha</title>
      <link rel="stylesheet" href="css/captcha.css">
  </head>
  <body>
    <div class="robotcheck">
      <div>
        <div>
            <center><h3><b>Robot Checking Captcha</b></h3></center>

            <center><p>Fill the captcha below to see if you're robot or human</p></center>
            <br>
        </div>
      </div>
	
        <div>             
              <div>
              <?php 
              if(isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["ttcapt"] == $_POST["captcha"])
              {
                  header ("location:loginregist.php");
              }
              else {
                  if(isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["ttcapt"] != $_POST["captcha"])
                  {
                      echo "<script>
								alert('Wrong captcha');
							</script>";
                  }
              ?>
              </div>
              <div>
				<div>
					<div>
                  <form action="" method="post">
                      <center><img id="tt_capimage" src="captcha.php" /></center>
                      <center><input class="input" id="tt_capvalue" name="captcha" type="text"/></center>
                      <center><button name="submit" type="submit" id="tt_capsubmit" class="btn">SUBMIT</button></center>
                      <center><button onclick="window.location=loginregist.php" class="btn">CHANGE CHAPTA</button></center>
                  </form>
              <?php
              }
              ?>
              </div>
			  </div>
			  </div>
          </div>
      </div>
  </body>
</html>
