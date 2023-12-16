<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["employeeId"]) && isset($_POST["newStatus"])) {
    include("db_connection.php"); // Include the database connection file

    $employeeId = $_POST["employeeId"];
    $newStatus = $_POST["newStatus"];

    // Update the status in the database
    $updateQuery = "UPDATE schedule SET status = '$newStatus' WHERE id = $employeeId";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>