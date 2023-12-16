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
		$hours = $_POST['hours'];
		$money = $_POST['money'];
		$level = $_POST['level'];
		$prestige = $_POST['prestige'];
        $company = $_POST['company'];

        // Insert post into the database
        $sql = "INSERT INTO employees (id, Name, Hours, Money, Level, Class, Prestige, Company, Job) 
				VALUES ('$id', '$name', '$hours', '$money', '$level', '$class', '$prestige', '$company')";
        if (mysqli_query($conn, $sql)) {
            echo "Post created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <h2>Add new Employee</h2>
    <form method="post" action="">
	
		<label for="id">Employee ID:</label><br>
        <input type="id" name="id" required><br><br>
		
        <label for="title">Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label for="hours">Hours:</label><br>
        <input type="text" name="hours" required><br><br>
		
		<label for="money">Money:</label><br>
        <input type="text" name="money" required><br><br>
		
		<label for="level">Level:</label><br>
        <input type="text" name="level" required><br><br>

		<label for="prestige">Prestige:</label><br>
        <input type="text" name="prestige" required><br><br>

        <label for="company">Company:</label><br>
        <input type="text" name="company" required><br><br>
        
        <input type="submit" name="submit" value="Create Post">
		
    </form>
	<br>
	<a href="employees.php">Back</a>
</body>
</html>