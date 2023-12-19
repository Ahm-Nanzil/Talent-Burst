<?php
require 'connection/database.php';
//error_reporting(0);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data from the AJAX request
    $featuredImage = $_FILES["featuredImage"]; // Use $_FILES to access the uploaded file
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
    $logo = $_FILES["company-logo"];

    $publishedDate = date("Y-m-d");
    $vacancy = $_POST['vacancy'];
    $experience = $_POST['experience'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];
    $applicationDeadline = $_POST['applicationDeadline'];



    // Check if a file is uploaded (both featured image and logo)
    if ($featuredImage['error'] === UPLOAD_ERR_OK && $logo['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file locations
        $featuredImageTempFilePath = $featuredImage['tmp_name'];
        $logoTempFilePath = $logo['tmp_name'];

        // Generate unique filenames for the uploaded files
        $featuredImageNewFileName = uniqid() . '_' . basename($featuredImage['name']);
        $logoNewFileName = uniqid() . '_' . basename($logo['name']);

        // Set the directory where you want to save the uploaded images
        $targetDir = "postjob/";

        // Set the complete file paths where the images will be saved
        $featuredImageTargetFilePath = $targetDir . $featuredImageNewFileName;
        $logoTargetFilePath = $targetDir . $logoNewFileName;

        // Move the uploaded files to the desired directory
        if (move_uploaded_file($featuredImageTempFilePath, $featuredImageTargetFilePath) &&
            move_uploaded_file($logoTempFilePath, $logoTargetFilePath)) {

            // Insert data into the database
            // $sql = "INSERT INTO jobpost (featured_image, email, job_title, location, job_region, job_type, job_description, company_name, tagline, company_description, website, facebook_username, twitter_username, linkedin_username, logo, published_date)
            // VALUES ('$featuredImageTargetFilePath', '$email', '$jobTitle', '$location', '$jobRegion', '$jobType', '$jobDescription', '$companyName', '$tagline', '$companyDescription', '$website', '$facebookUsername', '$twitterUsername', '$linkedinUsername', '$logoTargetFilePath', '$publishedDate')";
            
            //generate a job id;
            $job_id = random_int(1000, 7000);
            $sql = "INSERT INTO jobpost (id, featured_image, email, job_title, location, job_region, job_type, job_description, company_name, tagline, company_description, website, facebook_username, twitter_username, linkedin_username, logo, published_date, vacancy, experience, salary, gender, application_deadline)
            VALUES ('$job_id', '$featuredImageTargetFilePath', '$email', '$jobTitle', '$location', '$jobRegion', '$jobType', '$jobDescription', '$companyName', '$tagline', '$companyDescription', '$website', '$facebookUsername', '$twitterUsername', '$linkedinUsername', '$logoTargetFilePath', '$publishedDate', '$vacancy', '$experience', '$salary', '$gender', '$applicationDeadline')";


            //get questionaries
            $questions = json_decode($_POST['questions'], true);
            //generate random question id;

            foreach($questions as $question){

                $qn = $question['question_number'];
                $q = $question['question'];
                $q_options = $question['options'];
                $option_one = $q_options['one'];
                $option_two = $q_options['two'];
                $option_three = $q_options['three'];
                $answer = $q_options['answer'];

                $sql2 = "INSERT INTO questions(job_id, question_number, question, option1, option2, option3, answer)
                VALUES ('$job_id', '$qn', '$q', '$option_one', '$option_two', '$option_three', '$answer');";

                $connection->query($sql2);
            }
            // Perform the SQL query
            if ($connection->query($sql) === TRUE) {


                $jobpostId = $connection->insert_id;

                // Return a success message (this will be sent back to the client-side JavaScript)
                $response['success'] = true;
                $response['message'] = "Data successfully processed.";
                $response['condition'] = "query_success";
                $response['jobpostId'] = $jobpostId;

                
            } else {
                // If the query fails, set success to false and provide an error message
                $response['success'] = false;
                $response['message'] = "Error: " . $sql . "<br>" . $connection->error;
                $response['condition'] = "query_error";
            }
        } else {
            // Handle file upload error
            $response['success'] = false;
            $response['message'] = "Failed to move the uploaded files.";
            $response['condition'] = "file_upload_error";
        }
    } else {
        // Handle file upload errors
        $response['success'] = false;
        $response['message'] = "File upload failed.";
        $response['condition'] = "file_upload_error";
    }

    // Return JSON response
    header('Content-Type: application/json');
    
    echo json_encode($response);

    // Close the database connection
    $connection->close();
}

?>
