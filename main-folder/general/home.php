<?php
session_start()

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Include the JavaScript file -->
     <script src="common.js" defer></script>
    <title>Home</title>
</head>
<body>
    <?php include('template.php'); ?>

    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <span class="text">Welcome  <?php echo $_SESSION["username"];?>  </span>
           
            
        </div>
       
    </section>

</body>
</html>
