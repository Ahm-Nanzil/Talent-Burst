document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    var email = document.getElementById("emailLogin").value;
    var password = document.getElementById("passwordLogin").value;
    var loginMessageElement = document.getElementById("loginMessage");

    console.log(email);

    if (email.trim() === "" || password.trim() === "") {
        loginMessageElement.textContent = "Please fill out all fields.";
    } else {
        loginMessageElement.textContent = ""; // Clear previous error message

        // Prepare data to send to the server
        var data = new FormData();
        data.append("email", email);
        data.append("password", password);

        // Make an AJAX request to the login script
        fetch("login.php", {
            method: "POST",
            body: data
        })
        .then(response => response.json()) // Assuming the PHP script returns JSON data
        .then(data => {
            // Handle the response from the server (data contains response from PHP script)
            if (data.success) {
                // Redirect to dashboard or perform other actions upon successful login
                window.location.href = "index.php";
            } else {
                loginMessageElement.textContent = data.message; // Display login error message
            }
        })
        .catch(error => {
            // Handle errors that occurred during the fetch operation
            loginMessageElement.textContent = "Error occurred during login.";
            console.error(error);
        });
    }
});
