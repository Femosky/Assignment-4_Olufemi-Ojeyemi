<?php
// including the database connection code
include('../includes/db_connection.php');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the user already exists
        $confirmQuery = "SELECT * FROM `users` WHERE `username` = '$username'";
        $confirmResult = mysqli_query($db, $confirmQuery);

        // Check if any rows (data) were returned
        if (mysqli_num_rows($confirmResult) > 0) {
            // prints a messages to let the admin know the user already exists
            echo "<p class='error text-center'>User already exists.</p>";
        } else {
            // if the user does not exist, it proceeds with inserting new user
            $query = "INSERT INTO `users` (`username`, `password`, `user_type`) VALUES ('$username', '$password', 'manager')";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo "<p class='success text-center'>Shop manager successfully created</p>";
            } else {
                echo "<p class='error text-center'>Error while creating Shop manager. Please refresh the page and try again.</p>";
            }
        }
    }
}