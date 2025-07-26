<?php
// Start a new or resume existing session
session_start();

// If the user is already logged in, redirect to dashboard
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit(); // Always good practice after header redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Compatibility for IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->

    <title>Login Form</title>

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
          crossorigin="anonymous">
    
    <!-- Optional: your custom styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        // Check if form is submitted
        if (isset($_POST["login"])) {
            $email = $_POST["email"];       // Get email from POST
            $password = $_POST["password"]; // Get password from POST

            require_once "database.php";    // Include DB connection

            // Fetch user by email
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                // Verify password using password_verify() for hashed passwords
                if (password_verify($password, $user["password"])) {
                    session_start();                // Start session again (optional here since already started at top)
                    $_SESSION["user"] = "yes";      // Set session variable to mark user as logged in
                    header("Location: index.php");  // Redirect to dashboard
                    die();                          // Stop further script execution
                } else {
                    // Password incorrect
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                // Email not found
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <!-- Login form -->
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>
            <div class="form-btn mt-3">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>

        <!-- Link to registration page -->
        <div class="mt-3">
            <p>Not registered yet? <a href="registration.php">Register Here</a></p>
        </div>
    </div>
</body>
</html>
