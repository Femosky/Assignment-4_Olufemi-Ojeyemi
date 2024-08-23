<?php

// starting the session to capture saved sessions (login)
session_start();

// initializing response variables
$user_type = '';
$message = '';
$login_error = '';

// including the connection file
include('../includes/db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // getting the username and password submitted by the user 
        $username = $_POST['username'];
        $password = $_POST['password'];

        //preparing the mysql query and result for checking if the username submitted exists in the database
        $query = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // this gets a single row's (user's) data
            $user = mysqli_fetch_assoc($result);
    
            // checking if the password is correct else, prints incorrect password to the webpage
            if ($password == $user['password']) {
                // sets the session to indicate the user has been logged in
                $_SESSION['username'] = $username;

                // getting the user type to know if they're an admin or shop manager and storing it in a session to be used in the header.php file
                $user_type = $user['user_type'];
                $_SESSION['userType'] = $user_type;
            } else {
                // prints to the webpage that the password was invalid
                $message = "<p class='error text-center'>Incorrect password.</p>";
                $login_error = 'password';
            }
        } else {
            // prints to the webpage that the provided username does not exist
            $message = "<p class='error text-center'>Username doesn't exist.</p>";
            $login_error = 'username';
        }
    }
}

// preparing the response to be sent back to AJAX
$response = array(
    'type' => $user_type,
    'message' => $message,
    'error' => $login_error,
);

// encoding the response into json and sending it to AJAX
echo json_encode($response);