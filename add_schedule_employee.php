<!DOCTYPE html>
<html>
<head>
    <title>Post Creation</title>
</head>
<body>
    <?php
    include("db_connection.php"); // Include the database connection file

    // Process form submission
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // Insert post into the database
		$sql1 = "INSERT INTO schedule (id, employee, status)
				 VALUES ('$id', '$name', 'OFF')";

				
        if (mysqli_query($conn, $sql1)) {
            echo "Post created successfully.";
        } else {
            echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <h2>Add new Employee</h2>
    <form method="post" action="">
	
		<label for="id">Employee ID:</label><br>
        <input type="id" name="id" required><br><br>
		
        <label for="name">Name:</label><br>
        <input type="text" name="name" required><br><br>

        <input type="submit" name="submit" value="Create Post">
    </form>
	<br>
	<a href="schedule.php">Back</a>
</body>
</html>