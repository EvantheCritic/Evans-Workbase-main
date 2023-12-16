<?php
include("db_connection.php"); // Include the database connection file

// Check if the entry ID is provided in the URL
if (isset($_GET['entryID'])) {
    $entry_id = $_GET['entryID'];
    echo "Entry ID to delete: " . $entry_id; // Debug statement

    // Delete the entry from the database
    $sql = "DELETE FROM entries WHERE entryId = '$entry_id'";
    echo "SQL query: " . $sql; // Debug statement

    if (mysqli_query($conn, $sql)) {
        echo "Entry deleted successfully.";
    } else {
        echo "Error deleting entry: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>