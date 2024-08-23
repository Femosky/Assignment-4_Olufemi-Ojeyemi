<?php

// DB connection needs servername, username, password, database name
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'database';

// create a connection
$db = new mysqli($servername, $username, $password, $dbname);

// check for errors
if($db->connect_error)
{
    die('Error');
}
