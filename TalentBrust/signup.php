<?php
require 'connection/database.php';

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert data into the "users" table
$sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$hashedPassword', '$role')";

if ($connection->query($sql) === TRUE) {
    // Get the last inserted user ID
    $lastUserId = $connection->insert_id;

    // Insert only the user_id into the "profile" table
    $profileSql = "INSERT INTO profile (user_id,email) VALUES ('$lastUserId','$email')";

    if ($connection->query($profileSql) === TRUE) {
        // Return a success message
        echo json_encode(array("success" => true, "message" => "User registered successfully"));
    } else {
        // Return an error message if creating a profile fails
        echo json_encode(array("success" => false, "message" => "Error creating profile: " . $connection->error));
    }
} else {
    // Return an error message if the user registration fails
    echo json_encode(array("success" => false, "message" => "Error registering user: " . $connection->error));
}

// Close the connection
$connection->close();
?>
