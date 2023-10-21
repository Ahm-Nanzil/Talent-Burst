<?php
require '../connection/database.php';

$TableName = "jobpost";

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
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    featured_image VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    job_region VARCHAR(255) NOT NULL,
    job_type VARCHAR(255) NOT NULL,
    job_description TEXT NOT NULL,
    company_name VARCHAR(255) NOT NULL,
    tagline VARCHAR(255),
    company_description TEXT,
    website VARCHAR(255),
    facebook_username VARCHAR(255),
    twitter_username VARCHAR(255),
    linkedin_username VARCHAR(255),
    logo VARCHAR(255),
    
    published_date DATE
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
