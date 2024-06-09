<?php
session_start();
include('../general/connection.php');

if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $note_id = $_GET['id'];

    $sql = "DELETE FROM `data` WHERE `id` = '$note_id' AND `user_id` = '$user_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Redirect back to the notes page after deletion
        header("Location: notes.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Note ID or user ID not found.";
}
?>
