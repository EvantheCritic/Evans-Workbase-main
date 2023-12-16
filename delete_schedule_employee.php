<?php
include("db_connection.php"); // Include the database connection file

// Check if the employee ID is provided in the URL
if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Get the current order of employee IDs from both tables
    $current_order_schedule = array();
    $current_order_availability = array();

    $result_schedule = mysqli_query($conn, "SELECT id FROM schedule ORDER BY id");
    while ($row = mysqli_fetch_assoc($result_schedule)) {
        $current_order_schedule[] = $row['id'];
    }

    $result_availability = mysqli_query($conn, "SELECT id FROM availability ORDER BY id");
    while ($row = mysqli_fetch_assoc($result_availability)) {
        $current_order_availability[] = $row['id'];
    }

    // Delete the employee from both tables
    $sql1 = "DELETE FROM schedule WHERE id=$employee_id";
    $sql2 = "DELETE FROM availability WHERE id=$employee_id";

    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "Employee deleted successfully.";

        // Update the order of remaining employees in both tables
        $new_order_schedule = array_values(array_diff($current_order_schedule, array($employee_id)));
        for ($i = 0; $i < count($new_order_schedule); $i++) {
            mysqli_query($conn, "UPDATE schedule SET id=$i+1 WHERE id=$new_order_schedule[$i]");
        }

        $new_order_availability = array_values(array_diff($current_order_availability, array($employee_id)));
        for ($i = 0; $i < count($new_order_availability); $i++) {
            mysqli_query($conn, "UPDATE availability SET id=$i+1 WHERE id=$new_order_availability[$i]");
        }
    } else {
        echo "Error deleting employee: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>