<?php
// Start or resume the session
session_start();

// Destroy all session data (logs the user out)
session_destroy();

// Redirect to login page
header("Location: login.php");
exit(); // Always good practice after a header redirect
?>
