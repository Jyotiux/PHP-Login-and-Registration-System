<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <title>Registration</title>

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php
// Show all errors for debugging during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Get submitted form values
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

    // Hash the password before storing
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Initialize an array to hold validation errors
    $errors = array();

    // Basic validations
    if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "Passwords do not match");
    }

    // Connect to the database
    require_once "database.php";

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        array_push($errors, "Email already exists!");
    }

    // Display any validation errors
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // If no errors, insert the new user into the database using a prepared statement
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            // If prepare fails, show error
            die("Something went wrong: " . mysqli_error($conn));
        }
    }

    // Optional debug message
    echo "<div class='alert alert-info'>Form submitted</div>";
}
?>
<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "database.php";

$sql = "INSERT INTO users (full_name, email, password) VALUES ('Test User', 'test@example.com', 'testpass')";

if (mysqli_query($conn, $sql)) {
    echo "Inserted successfully!";
} else {
    echo "Insert failed: " . mysqli_error($conn);
}
*/
?>
    <!-- Registration Form -->
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
        </div>
        <div class="form-btn mt-3">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
    </form>
</div>
</body>
</html>
