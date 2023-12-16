<?php
session_start(); // Start the session

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the desired page after logout (e.g., index.php)
header("Location: index.php");
exit();
?>