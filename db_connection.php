<?php
$db_host = "localhost"; // Replace with your database host
$db_user = "root"; // Replace with your database username
$db_pass = "mysql"; // Replace with your database password
$db_name = "evandb"; // Replace with your database name

// Establish database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>