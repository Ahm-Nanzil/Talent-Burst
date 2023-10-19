<?php
require 'connection/database.php';
?>
<?php
// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert data into the database
$sql = "INSERT INTO jobseeker (email, password) VALUES ('$email', '$hashedPassword')";

if ($connection->query($sql) === TRUE) {
    // Return a success message (this will be sent back to the client-side JavaScript)
    echo json_encode(array("success" => true, "message" => "User registered successfully"));
} else {
    // Return an error message if the insertion fails
    echo json_encode(array("success" => false, "message" => "Error: " . $sql . "<br>" . $connection->error));
}

// Close the connection
$connection->close();
?>
