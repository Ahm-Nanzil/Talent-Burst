<?php
require 'connection/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate and sanitize the input data (for security)
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    // Check if the email and hashed password match in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedHashedPassword = $row['password'];
        $userId = $row['ID']; // Retrieve user ID from the $row array
        $role = $row['role'];

        if (password_verify($password, $storedHashedPassword)) {
            // Passwords match, login successful

            session_start(); // Start the session
            $_SESSION['user_id'] = $userId; // Store user ID in the session
            $_SESSION['pass'] = $storedHashedPassword;
            $_SESSION['role'] = $role;

            echo json_encode(array("success" => true, "message" => "Login successful.", "user_id" => $_SESSION['user_id']));
        } else {
            // Passwords do not match, login failed
            echo json_encode(array("success" => false, "message" => "Invalid credentials."));
        }
    } else {
        // Email not found in the database, login failed
        echo json_encode(array("success" => false, "message" => "Invalid credentials."));
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
