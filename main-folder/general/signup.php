
<?php
if (isset($_POST["submit"])) {
    include('connection.php'); // Adjust this path if necessary

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "select * from users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $count_user = mysqli_num_rows($result);
    
    $sql = "select * from users where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    if ($count_user == 0 || $count_email == 0) {
          // Hash the password before storing
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
         // Insert the new user into the database
         $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
         if (mysqli_query($conn, $sql)) {
            echo "<div class='message'>
                    <p>Registration successful!!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
        } else {
            echo "<div class='message'>
                    <p>Error: " . mysqli_error($conn) . "</p>
                  </div> <br>";
        }
    
    
        }else{
        // If either username or email exists, show an alert and redirect
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
    <title>Sign-up</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="mediaqueries.css">
</head>
<body>
    <div class="container">
        <div class="container-text">
            <h1 style="font-family: Delicious Handrawn;"> SelfSculp</h1>
            <p id="sub-text">make your life better!</p>
        </div>
        <div class="box form-box">

            <header>Sign-up</header>
            <form action="signup.php" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off"  required>
                </div>
                <div class="field">
                    
                    <input type="submit" class= "btn " name="submit" value="Sign-Up" required>
                </div>
                <div class="link" style="color: aliceblue;">
                    Already an member <a href="index.php">Log-in Now</a>
                </div>
                
            </form>
            
        </div>
    </div>
    
    
</body>
</html>