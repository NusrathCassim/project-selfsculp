<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php include('template.php'); ?>

    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <span class="text">Welcome</span>
        </div>
    </section>

    <!-- Ensure the sidebar script is included here to have access to DOM elements -->
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e)=>{
                let arrowParent =  e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        sidebarBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
        });
    </script>
</body>
</html>
