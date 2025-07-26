<?php

// Define the database connection parameters
$hostName = "localhost";      // Host where the database server is located (usually 'localhost' for local server)
$dbUser = "root";             // Database username (default for local MySQL is often 'root')
$dbPassword = "jyoti";        // Password for the database user
$dbName = "login-register";   // Name of the database you want to connect to

// Attempt to establish a connection to the MySQL database
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    // If the connection failed, output an error message and terminate the script
    die("Something went wrong;");
}

?>
