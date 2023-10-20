<?php
require 'connection/database.php';


// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get form data from the AJAX request
$featuredImage = $_POST["featuredImage"];
$email = $_POST['email'];
$jobTitle = $_POST['jobTitle'];
$location = $_POST['location'];
$jobRegion = $_POST['jobRegion'];
$jobType = $_POST['jobType'];
$jobDescription = $_POST['jobDescription'];
$companyName = $_POST['companyName'];
$tagline = $_POST['tagline'];
$companyDescription = $_POST['companyDescription'];
$website = $_POST['website'];
$facebookUsername = $_POST['facebookUsername'];
$twitterUsername = $_POST['twitterUsername'];
$linkedinUsername = $_POST['linkedinUsername'];
$logo = $_POST["logo"];

    // Insert data into the database
    $sql = "INSERT INTO jobpost (featured_image, email, job_title, location, job_region, job_type, job_description, company_name, tagline, company_description, website, facebook_username, twitter_username, linkedin_username, logo)
    VALUES ('$featuredImage', '$email', '$jobTitle', '$location', '$jobRegion', '$jobType', '$jobDescription', '$companyName', '$tagline', '$companyDescription', '$website', '$facebookUsername', '$twitterUsername', '$linkedinUsername', '$logo')";
    
    
if ($connection->query($sql) === TRUE) {
    // Return a success message (this will be sent back to the client-side JavaScript)
   // Example response
   $response['success'] = true;
   $response['message'] = "Data successfully processed."; } 

    // Example response
    $response['success'] = true;
    $response['message'] = "Data successfully processed.";
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$connection->close();
?>




