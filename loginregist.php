<html>
    
    <head>
        <title>Login | Register Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        
        <div class="whole">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toogle-btn" onclick="login()">Login</button>
                    <button type="button" class="toogle-btn" onclick="register()">Register</button>
                </div>
                <form action= "login.php" method="post" id="login" class="input-group">
                    <input type="text" name="username" class="input-field" placeholder="User ID" required>
                    <input type="password" name="password" class="input-field" placeholder="Enter Password" required>
                    <button type="submit" class="submit-btn">Login</button>
                </form>
                <form action="registration.php" method="post" id="register" class="input-group">
                    <input type="text" name="username_" class="input-field" placeholder="User ID" required>
                    <input type="email" name="email_" class="input-field" placeholder="Email" required>
                    <input type="password" name="password_" class="input-field" placeholder="Enter Password" required>
                    <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
            
        </div>
        
        <script>
            var x = document.getElementById("login");
            var y = document.getElementById("register");
            var z = document.getElementById("btn");
            
            function register()
            {
                x.style.left="-400px";
                y.style.left="50px";
                z.style.left="110px";
            }
            
            function login()
            {
                x.style.left="50px";
                y.style.left="450px";
                z.style.left="0px";
            }
        </script>
        
    </body>
    
</html>