<?php
    session_start();
     if(isset($_POST["submit"])){
        include("connection.php");
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row){
            if(password_verify($password, $row["Password"])){
                $_SESSION["username"] = $username;
                $_SESSION["user_id"] = $row["Id"]; // Store user_id in session
                header("Location: home.php");
            }
        }
        else{
            echo "<script>
                    alert('User already exists');
                    window.location.href = 'index.php';
                </script>";
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="mediaqueries.css">
</head>
<body>
    <div class="container">
        <!-- <div class="image">
            <img src="logo.png" alt="image">
        </div> -->
        <div class="container-text">
            <h1 style="font-family: Delicious Handrawn;"> SelfSculp</h1>
            <p id="sub-text">make your life better!</p>
        </div>
       
        <div class="box form-box">
            <header>Login</header>
            <form action="index.php" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    
                    <input type="submit" class= "btn " name="submit" value="Login" required>
                </div>
                <div class="link" style="color: aliceblue;">
                    Don't have account <a href="signup.php">Sign-up Now</a>
                </div>
            </form>
            
        </div>
    </div>
    
</body>
</html>