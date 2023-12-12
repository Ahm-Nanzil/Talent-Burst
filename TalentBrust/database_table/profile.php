<?php
require '../connection/database.php';

$TableName = "profile";

// Drop Table
$dropTable = 'DROP TABLE IF EXISTS ' . $TableName;
if ($connection->query($dropTable)) {
    echo 'Table Dropped.<br /><br />';
} else {
    echo '<span style="color:red; ">FAILED to DROP table.' . $TableName . '</span><br /><br />';
    echo $connection->error;
}

// Create Table
$createTable = 'CREATE TABLE ' . $TableName . ' (
    profile_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    name VARCHAR(255),
    email VARCHAR(255),
    birth_date DATE,
    FOREIGN KEY (user_id) REFERENCES users (ID)
)';

if ($connection->query($createTable)) {
    echo '<br />Table ' . $TableName . ' Added.<br /><br />';
} else {
    echo '<span style="color:red; "><br />FAILED to Add table ' . $TableName . '.</span><br /><br />';
    echo $connection->error;
}

// Close database connection
$connection->close();
?>
