<?php

// Starts the session
session_start();

// Checks if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroys the session
    session_destroy();

    // Redirects the user to the login page
    header("Location: ../login-page.php");
    exit();
} else {
    // displays an error page if the logout post wasn't sent for some reason
    echo "Error";
    echo "Go back to the <a href='/'>Homepage</a>";
    exit();
}