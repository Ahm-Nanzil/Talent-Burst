document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("jobpost").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        var featuredImageInput = document.getElementById("featuredImage");
        var featuredImageFile = featuredImageInput.files[0];
        var logoImageInput = document.getElementById("company-logo");
        var logoImageFile = logoImageInput.files[0];

        // Get form data
        var formData = new FormData();
        formData.append("experience", document.getElementById("experience").value);
        // ... (append other form fields similarly)

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
            try {
                // Handle the parsed JSON response from the server
                if (data.success) {
                    // Handle success
                    var jobpostId = data.jobpostId;

                    // Attach click event to the button
                    $("#previewpost").on("click", function() {
                        // Navigate to the preview-jobpost.php page with the jobpostId parameter
                        window.location.href = "preview-jobpost.php?jobpostId=" + jobpostId;
                    });

                    // Update responseMessage on successful form submission
                    var responseMessage = document.getElementById("responseMessage");
                    responseMessage.textContent = "Form submitted successfully!";
                    responseMessage.style.color = "green";
                } else {
                    // Handle failure
                    var responseMessage = document.getElementById("responseMessage");
                    responseMessage.textContent = "Form submission failed. " + data.message;
                    responseMessage.style.color = "";
                }
            } catch (error) {
                // Handle parsing error
                console.error("Error occurred while processing the response:", error);
            }
        })
        .catch(error => {
            // Update responseMessage on network or parsing error
            var responseMessage = document.getElementById("responseMessage");
            responseMessage.textContent = "Error occurred while processing the request: " + error.message;
            responseMessage.style.color = "";
            console.error("Error occurred while processing the request:", error);
        });
    });
});
