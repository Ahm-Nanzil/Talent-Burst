<?php
// Include the file where the $connection is defined
require '../connection/database.php';

// Table name
$TableName = "messages";  // Replace with the desired table name

// Drop Table
$dropTable = 'DROP TABLE IF EXISTS ' . $TableName;
if ($connection->query($dropTable)) {
    echo 'Table Dropped.<br /><br />';
} else {
    echo '<span style="color:red; ">FAILED to DROP table ' . $TableName . '.</span><br /><br />';
    echo $connection->error;
}

// Create Table
$createTable = 'CREATE TABLE ' . $TableName . ' (
    msg_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    incoming_msg_id INT(255) NOT NULL,
    outgoing_msg_id INT(255) NOT NULL,
    msg VARCHAR(1000) NOT NULL,
    iv TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci';

if ($connection->query($createTable)) {
    echo '<br />Table ' . $TableName . ' Added.<br /><br />';
} else {
    echo '<span style="color:red; "><br />FAILED to Add table ' . $TableName . '.</span><br /><br />';
    echo $connection->error;
}

// Close database connection
$connection->close();
?>
