document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var responseMessage = document.getElementById("responseMessage");

    if (email.trim() === "" || password.trim() === "" || confirmPassword.trim() === "") {
        responseMessage.textContent = "Please fill out all fields.";
    } else if (password !== confirmPassword) {
        responseMessage.textContent = "Passwords do not match!";
    } else {
        responseMessage.textContent = ""; // Clear error message if passwords match

        // Prepare data to send to the server
        var data = new FormData();
        data.append("email", email);
        data.append("password", password);

        // Make an AJAX request to the PHP script
        fetch("signup.php", {
            method: "POST",
            body: data
        })
        .then(response => response.json()) // Assuming the PHP script returns JSON data
        .then(data => {
            // Check if the server response indicates success or failure
            if (data.success) {
                responseMessage.className = "text-success mb-3"; // Set the class to show a success message
                responseMessage.textContent = data.message; // Display the success message
            } else {
                responseMessage.className = "text-danger mb-3"; // Set the class to show an error message
                responseMessage.textContent = data.message; // Display the error message
            }
        })
        .catch(error => {
            responseMessage.textContent = "An error occurred while processing your request.";
            console.error(error);
        });
    }
});
