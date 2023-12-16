<?php
include("db_connection.php"); // Include the database connection file

// Check if the employee ID is provided in the URL
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Get the current employee list order
    $current_order = array();
    $result = mysqli_query($conn, "SELECT id FROM employees ORDER BY id");
    while ($row = mysqli_fetch_assoc($result)) {
        $current_order[] = $row['id'];
    }

    // Delete the employee from the database
    $sql = "DELETE FROM employees WHERE id=$employee_id";

    if (mysqli_query($conn, $sql)) {
        echo "Employee deleted successfully.";

        // Update the order of remaining employees
        $new_order = array_values(array_diff($current_order, array($employee_id)));
        for ($i = 0; $i < count($new_order); $i++) {
            mysqli_query($conn, "UPDATE employees SET id=$i+1 WHERE id=$new_order[$i]");
        }
    } else {
        echo "Error deleting employee: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>