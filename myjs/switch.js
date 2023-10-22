$(document).ready(function(){
    $("#showSignupLink").click(function(e){
        e.preventDefault(); // Prevents the default behavior of the link
        // Show the signup form and hide the login form
        $("#signupForm").show();
        $("#loginForm").hide();
    });

    // jQuery click event for showing login form and hiding signup form
    $("#showLoginLink").click(function(e){
        e.preventDefault(); // Prevents the default behavior of the link
        // Show the login form and hide the signup form
        $("#loginForm").show();
        $("#signupForm").hide();
    });
});