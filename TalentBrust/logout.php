<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the home page or any other page after logout
    header("Location: index.php");
    exit();
} else {
    // Redirect to the home page or any other page if the user is not logged in
    header("Location: index.php");
    exit();
}
?>
