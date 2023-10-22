document.getElementById("jobpost").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way


    
    // Get form data
    var formData = new FormData();
    formData.append("featuredImage", document.getElementById("featuredImage").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("jobTitle", document.getElementById("job-title").value);
    formData.append("location", document.getElementById("job-location").value);
    formData.append("jobRegion", document.getElementById("job-region").value);
    formData.append("jobType", document.getElementById("job-type").value);
    formData.append("jobDescription", document.getElementById("editor-1").value);
    formData.append("companyName", document.getElementById("company-name").value);
    formData.append("tagline", document.getElementById("company-tagline").value);
    formData.append("companyDescription", document.getElementById("editor-2").value);
    formData.append("website", document.getElementById("company-website").value);
    formData.append("facebookUsername", document.getElementById("fb-username").value);
    formData.append("twitterUsername", document.getElementById("twitter-username").value);
    formData.append("linkedinUsername", document.getElementById("linkedin-username").value);
    formData.append("logo", document.getElementById("company-logo").value);

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
        return response.json();
    })
    .then(data => {
        // Handle the response from the server (data contains response from PHP script)
        console.log("Server Response:", data);
        if (data.success) {
            // Do something on success
        } else {
            // Handle error case
        }
    })
    .catch(error => {
        console.error("Error occurred while processing the request:", error);
    });
});