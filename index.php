<?php
// Start the session to access session variables
session_start();

// Check if the user is not logged in (i.e., 'user' is not set in session)
if (!isset($_SESSION["user"])) {
    // Redirect to login page if the session variable 'user' is not set
    header("Location: login.php");
    exit(); // It's good practice to call exit after a redirect
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set character encoding -->
    <meta charset="UTF-8">
    
    <!-- Ensure compatibility with Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Make page responsive on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link to Bootstrap 5 CSS via CDN for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
          crossorigin="anonymous">
    
    <!-- Link to custom CSS file (optional) -->
    <link rel="stylesheet" href="style.css">

    <!-- Page Title -->
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <!-- Heading for the dashboard -->
        <h1>Welcome to Dashboard</h1>

        <!-- Logout button that links to logout.php -->
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>
