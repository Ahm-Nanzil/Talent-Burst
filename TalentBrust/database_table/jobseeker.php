<?php
require '../connection/database.php';

$TableName = "jobseeker";

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
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(70) NOT NULL,
    UNIQUE (email)
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
