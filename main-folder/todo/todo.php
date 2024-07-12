<?php
    session_start();
    // echo"welcome". $_SESSION["username"];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/template.css">
    <link rel="stylesheet" href="../general/home.css">
    <link rel="stylesheet" href="todo.css">
    
     <!-- Include the JavaScript file -->
     <script src="../general/common.js" defer></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <title>Todo</title>
</head>
<body>
<?php include('../general/template.php'); ?>


    <section class="home-section">
        <div class="home-content">
            <i class="bx bx-menu"></i>
            <span class="text">To-do</span>


        </div>
        <div class="next">
            <div class="calender">
                <div class="header">
                <div id="prev" class="btn"><i class="fa-solid fa-arrow-left"></i></div>
                <div id="month-year"></div>
                <div id="next" class="btn"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
                <div class="weekdays">
                    <div>sun</div>
                    <div>mon</div>
                    <div>tue</div>
                    <div>wed</div>
                    <div>thu</div>
                    <div>fri</div>
                    <div>sat</div>
                </div>
                <div class="days" id="days"></div>
            </div>
        
<!-- Start popup dialog box -->
<form method="POST" action="save.php">
        <div class="modal-container" id="modal-container" style="display: none;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="event_name">Event name</label>
                    <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                </div>
                <div class="form-group">
                    <label for="event_start_date">Event start</label>
                    <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                </div>
                <div class="form-group">
                    <label for="event_end_date">Event End</label>
                    <input type="date" name="event_end_date" id="event_end_date" class="form-control onlydatepicker" placeholder="Event end date">
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="save_event">Save Event</button>
            </div>
        </div>
    </form>
    </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="todo.js"></script>

</body>
</html>