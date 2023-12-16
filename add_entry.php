<html>
<head>
    <title>Add Entry</title>
</head>
<body>
    <?php
    include("db_connection.php"); // Include the database connection file

    // Process form submission
    if (isset($_POST['submit'])) {
        $entryID = $_POST['entryID'];
        $emp1 = $_POST['emp1'];
		$emp2 = $_POST['emp2'];
		$date = $_POST['date'];
		$departure = $_POST['departure'];
		$arrival = $_POST['arrival'];
		$time = $_POST['time'];
		$flight = $_POST['flight'];
		$aircraft = $_POST['aircraft'];
		$pay = $_POST['pay'];

        // Insert post into the database
        $sql = "INSERT INTO entries (entryID, empID1, empID2, date, departure, arrival, flTime, flight, aircraft, pay) 
				VALUES ('$entryID', '$emp1', '$emp2', '$date', '$departure', '$arrival', '$time', '$flight', '$aircraft', '$pay')";
        if (mysqli_query($conn, $sql)) {
            echo "Post created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <h2>Add new Entry</h2>
    <form method="post" action="">
	
		<label for="entryID">Entry ID:</label><br>
        <input type="id" name="entryID" required><br><br>
		
        <label for="emp1">Employee 1:</label><br>
        <input type="text" name="emp1" required><br><br>

        <label for="emp2">Employee 2:</label><br>
        <input type="text" name="emp2" required><br><br>
		
		<label for="date">Date:</label><br>
        <input type="text" name="date" required><br><br>
		
		<label for="departure">Departure:</label><br>
        <input type="text" name="departure" required><br><br>
		
		<label for="arrival">Arrival:</label><br>
        <input type="text" name="arrival" required><br><br>
		
		<label for="time">Flight time:</label><br>
        <input type="text" name="time" required><br><br>
		
		<label for="flight">Flight number:</label><br>
        <input type="text" name="flight" required><br><br>
		
		<label for="aircraft">Aircraft:</label><br>
        <input type="text" name="aircraft" required><br><br>
		
		<label for="pay">Pay:</label><br>
        <input type="text" name="pay" required><br><br>

        <input type="submit" name="submit" value="Create Post">
		
    </form>
	<br>
	<a href="entries.php">Back</a>
</body>
</html>