<?php
include("db_connection.php"); // Include the database connection file

if (isset($_GET['id'])) {
    $emp_id = $_GET['id'];

    // Fetch post data from the "posts" table
    $sql = "SELECT * FROM emplyoees WHERE id=$emp_id";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    // Close the database connection
    mysqli_close($conn);

    // Send the post data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($post);
}
?>