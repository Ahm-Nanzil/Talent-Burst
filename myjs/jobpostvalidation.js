const questionsElements = document.querySelectorAll(".question-group");



document.getElementById("jobpost").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const questions = [

    ]    
    questionsElements.forEach((qElement, index)=>{

        questions.push({
            question_number:index+1,
            question:qElement.children[1].value,
            options:{
                one:qElement.children[2].children[0].children[1].value,
                two:qElement.children[2].children[1].children[1].value,
                three:qElement.children[3].children[0].children[1].value,
                answer:qElement.children[3].children[1].children[1].value
            },
            
        })
    
    });
   

    var featuredImageInput = document.getElementById("featuredImage");
    var featuredImageFile = featuredImageInput.files[0];
    var logoImageInput= document.getElementById("company-logo");
    var logoImageFile =logoImageInput.files[0];

    // Get form data
    var formData = new FormData();
    formData.append("experience", document.getElementById("experience").value); 
    formData.append("salary", document.getElementById("salary").value);
    formData.append("vacancy", document.getElementById("vacancy").value);
    formData.append("gender", document.getElementById("gender").value);
    formData.append("applicationDeadline", document.getElementById("applicationDeadline").value);
    formData.append("featuredImage", featuredImageFile);
    formData.append("email", document.getElementById("email").value);
    formData.append("jobTitle", document.getElementById("job-title").value);
    formData.append("location", document.getElementById("job-location").value);
    formData.append("jobRegion", document.getElementById("job-region").value);
    formData.append("jobType", document.getElementById("job-type").value);
    formData.append("jobDescription", document.getElementById("editor-1").innerHTML);
    formData.append("companyName", document.getElementById("company-name").value);
    formData.append("tagline", document.getElementById("company-tagline").value);
    formData.append("companyDescription", document.getElementById("editor-2").innerHTML);
    formData.append("website", document.getElementById("company-website").value);
    formData.append("facebookUsername", document.getElementById("fb-username").value);
    formData.append("twitterUsername", document.getElementById("twitter-username").value);
    formData.append("linkedinUsername", document.getElementById("linkedin-username").value);
    formData.append("company-logo", logoImageFile);
    //append question
    formData.append("questions",JSON.stringify(questions));

    
    var responseMessage = document.getElementById("responseMessage");

     // Log form data to console
     console.log("Form Data:", formData);

      // Make an AJAX request to jobpost.php
    fetch("jobpost.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        // Parse the JSON response
        return response.json();
    })
    .then(data => {
        // Handle the parsed JSON response from the server
        console.log("Server Response:", data);
        if (data.success) {
             // Handle success
             var jobpostId = data.jobpostId;

             // Attach click event to the button
             document.getElementById("previewpost").addEventListener("click", function() {
                 // Navigate to the preview-jobpost.php page with the jobpostId parameter
                 window.location.href = "preview-jobpost.php?jobpostId=" + jobpostId;
             });
            // Update responseMessage on successful form submission
            responseMessage.textContent = "Form submitted wow successfully!";
            responseMessage.style.color = "green";
            // Do additional actions on success if needed
        } else {
            // Update responseMessage with the server's error message
            responseMessage.textContent = "Form submission failed. " + data.message;
            responseMessage.style.color = "";
            // Handle other error cases if needed
        }
    })
    .catch(error => {
        // Update responseMessage on network or parsing error
        responseMessage.textContent = "Error occurred while processing the request: " + error.message;
        responseMessage.style.color = "";
        console.error("Error occurred while processing the request:", error);
    });
    
});