<?php
    session_start();
    // echo"welcome". $_SESSION["username"];
    ?>
<?php   
    include('../general/connection.php'); 
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
    
            // Insert the note with the user_id
            $sql = "INSERT INTO `data` (`user_id`, `title`, `content`) VALUES ('$user_id', '$title', '$content')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                // Redirect to the same page to prevent resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                die(mysqli_error($conn));
            }
        } else {
           // echo "User ID not found in session";
        }
    }
    // Update note logic
    if (isset($_POST['update'])) {
        if (isset($_SESSION['user_id'])) {
            $note_id = mysqli_real_escape_string($conn, $_POST['note_id']);
            $title = mysqli_real_escape_string($conn, $_POST['edit_title']);
            $content = mysqli_real_escape_string($conn, $_POST['edit_content']);

            // Update the note
            $sql = "UPDATE `data` SET `title` = '$title', `content` = '$content' WHERE `id` = '$note_id' AND `user_id` = '{$_SESSION['user_id']}'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Redirect to the same page to prevent resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                die(mysqli_error($conn));
            }
        } else {
            // echo "User ID not found in session";
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <!-- Boxicons CSS -->
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/template.css">
    <link rel="stylesheet" href="../general/home.css">
    <link rel="stylesheet" href="notes.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
    
    
     <!-- Include the JavaScript file -->
     <script src="../general/common.js" defer></script>
    <title>Notes</title>
</head>
<body>
    <?php include('../general/template.php'); ?>


    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <span class="text">Notes</span>
        </div>
        <!-- button -->
        <div class="btn_container">
            <button id="open-popup" class="btn_add">New Note</button>
        </div>
       
        

        <!-- Diplaying part -->
          <div class="card_container">
          <?php
            // Fetch only the notes for the logged-in user
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `data` WHERE `user_id` = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($fetch = mysqli_fetch_assoc($result)) {
                    echo '
                        <div class="card">
                            <div class="card-body">
                                <div class="scrollable-content">
                                    <h5 class="card-title">' . htmlspecialchars($fetch["title"]) . '</h5>
                                    <p class="card-text">' . htmlspecialchars($fetch["content"]) . '</p>
                                </div>
                                <div class="card-buttons">
                                      <button class="btn edit-button" data-id="' . $fetch['id'] . '" data-title="' . htmlspecialchars($fetch["title"]) . '" data-content="' . htmlspecialchars($fetch["content"]) . '">Edit</button>
                                    <button class="btn"><a href="delete.php?id=' . $fetch['id'] . '" class="card-link">Delete</a></button>
                                </div>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo "No notes found.";
            }
            ?>

        </div>
       
        


        <!-- pop-up part -->
        <div class="next-content" id="popup">
            <div class="box form-box">
                <form method="POST">
                    <div class="button_cancel">
                        <button type="button" id="close-popup" class="cancel_icon"><i class='bx bx-x'></i></button>
                    </div>
                
                    <div class="field input">
                        <label for="id">Title</label>
                        <input type="text" id="title" name="title" placeholder="Your title" autocomplete="off" required>
                    </div>
                    
                    <div class="field input">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" rows="4" autocomplete="off" placeholder="your content..."></textarea>
                    </div>     
                    <div class="field-btn">
                        <input type="submit" class="btn1" name="submit" value="Submit">
                        <input type="reset" class="btn1" name="cancel" value="Cancel"> 
                    </div>
                </form>
            </div>
        </div>
    
        <!-- Edit pop-up part -->
    <div class="next-content" id="edit-popup">
        <div class="box form-box">
            <form method="POST">
                <div class="button_cancel">
                    <button type="button" id="close-edit-popup" class="cancel_icon"><i class='bx bx-x'></i></button>
                </div>
                
                <input type="hidden" id="note_id" name="note_id">
                
                <div class="field input">
                    <label for="edit_title">Title</label>
                    <input type="text" id="edit_title" name="edit_title" placeholder="Your title" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label for="edit_content">Content</label>
                    <textarea id="edit_content" name="edit_content" rows="4" autocomplete="off" placeholder="your content..."></textarea>
                </div>     
                <div class="field-btn">
                    <input type="submit" class="btn1" name="update" value="Update">
                    <input type="reset" class="btn1" name="cancel" value="Cancel"> 
                </div>
            </form>
        </div>
    </div>



    </section>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const openPopupButton = document.getElementById('open-popup');
        const closePopupButton = document.getElementById('close-popup');
        const popup = document.getElementById('popup');

        openPopupButton.addEventListener('click', function() {
            popup.classList.add('active');
        });

        closePopupButton.addEventListener('click', function() {
            popup.classList.remove('active');
        });
        });

    </script>

    <!-- edit pop up JavaScript -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const openPopupButton = document.getElementById('open-popup');
    const closePopupButton = document.getElementById('close-popup');
    const popup = document.getElementById('popup');

    openPopupButton.addEventListener('click', function() {
        popup.classList.add('active');
    });

    closePopupButton.addEventListener('click', function() {
        popup.classList.remove('active');
    });

    const editButtons = document.querySelectorAll('.edit-button');
    const editPopup = document.getElementById('edit-popup');
    const closeEditPopupButton = document.getElementById('close-edit-popup');
    const noteIdInput = document.getElementById('note_id');
    const editTitleInput = document.getElementById('edit_title');
    const editContentInput = document.getElementById('edit_content');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const noteId = this.getAttribute('data-id');
            const noteTitle = this.getAttribute('data-title');
            const noteContent = this.getAttribute('data-content');

            noteIdInput.value = noteId;
            editTitleInput.value = noteTitle;
            editContentInput.value = noteContent;

            editPopup.classList.add('active');
        });
    });

    closeEditPopupButton.addEventListener('click', function() {
        editPopup.classList.remove('active');
    });
});
    </script>

</body>
</html>