<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
</head>
<body> 
	 <?php
    include("db_connection.php"); // Include the database connection file

    // Check if the employee ID is provided in the URL
    if (isset($_GET['id'])) {
        $employee_id = $_GET['id'];

        // Fetch the employee data from the database
        $sql = "SELECT * FROM employees WHERE id = $employee_id";
        $result = mysqli_query($conn, $sql);
        $employee = mysqli_fetch_assoc($result);
    }

    // Process form submission
    if (isset($_POST['submit'])) {
		$id = $_POST['id'];
        $name = $_POST['name'];
        $hours = $_POST['hours'];
        $money = $_POST['money'];
        $level = $_POST['level'];
        $poopoo = $_POST['poopoo'];
        $company = $_POST['company'];

        // Update the employee data in the database
        $sql = "UPDATE employees SET 
				id = '$id',
                Name='$name',
                Hours='$hours',
                Money='$money',
                Level='$level',
                Prestige='$poopoo',
                Company='$company'
                WHERE id=$employee_id";

        if (mysqli_query($conn, $sql)) {
            echo "Employee information updated successfully.";
        } else {
            echo "Error updating employee information: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
	<h2>Edit Employee</h2>
    <form method="post" action="">
		
        <input type="hidden" name="post_id" value="<?php echo $employee['id']; ?>">
		
		<label for="id">Employee ID:</label><br>
        <input type="text" name="id" value="<?php echo $employee['id']; ?>" required><br><br>
        
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="<?php echo $employee['Name']; ?>" required><br><br>

        <label for="hours">Hours:</label><br>
        <input type="text" name="hours" value="<?php echo $employee['Hours']; ?>" required><br><br>
		
		<label for="money">Money:</label><br>
        <input type="text" name="money" value="<?php echo $employee['Money']; ?>" required><br><br>
		
		<label for="level">Level:</label><br>
        <input type="text" name="level" value="<?php echo $employee['Level']; ?>" required><br><br>
		
		<label for="poopoo">Prestige:</label><br>
        <input type="text" name="poopoo" value="<?php echo $employee['Prestige']; ?>" required><br><br>

        <label for="company">Company:</label><br>
        <input type="text" name="company" value="<?php echo $employee['Company']; ?>" required><br><br>

        <input type="submit" name="submit" value="Update Post">
    </form>
	<a href="employees.php">Back</a>
</body>
</html>