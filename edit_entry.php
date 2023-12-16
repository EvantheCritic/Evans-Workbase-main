<!DOCTYPE html>
<html>
<head>
    <title>Update Post</title>
</head>
<body> 
	 <?php
    include("db_connection.php"); // Include the database connection file

    // Check if the entry ID is provided in the URL
    if (isset($_GET['id'])) {
        $entry_id = $_GET['id'];

        // Fetch the entry data from the database
        $sql = "SELECT * FROM entries WHERE entryID=$entry_id";
        $result = mysqli_query($conn, $sql);
        $entry = mysqli_fetch_assoc($result);
    }

    // Process form submission
    if (isset($_POST['submit'])) {
        $emp1 = $_POST['emp1'];
        $emp2 = $_POST['emp2'];
        $date = $_POST['date'];
        $departure = $_POST['departure'];
        $arrival = $_POST['arrival'];
        $time = $_POST['time'];
        $aircraft = $_POST['aircraft'];
        $pay = $_POST['pay'];

        // Update the entry data in the database
        $sql = "UPDATE entries SET 
                empID1='$emp1',
                empID2='$emp2',
                date='$date',
                departure='$departure',
                arrival='$arrival',
                flTime='$time',
                aircraft='$aircraft',
                pay='$pay'
                WHERE entryID=$entry_id";

        if (mysqli_query($conn, $sql)) {
            echo "Entry information updated successfully.";
        } else {
            echo "Error updating entry information: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
	<h2>Edit Entry</h2>
    <form method="post" action="">
		
        <input type="hidden" name="post_id" value="<?php echo $entry['id']; ?>">
        
        <label for="emp1">Employee 1:</label><br>
        <input type="text" name="emp1" value="<?php echo $entry['empID1']; ?>" required><br><br>

        <label for="emp2">Employee 2:</label><br>
        <input type="text" name="emp2" value="<?php echo $entry['empID2']; ?>" required><br><br>
		
		<label for="date">Date:</label><br>
        <input type="text" name="date" value="<?php echo $entry['date']; ?>" required><br><br>
		
		<label for="departure">Departure:</label><br>
        <input type="text" name="departure" value="<?php echo $entry['departure']; ?>" required><br><br>
		
		<label for="arrival">Arrival:</label><br>
        <input type="text" name="arrival" value="<?php echo $entry['arrival']; ?>" required><br><br>
		
		<label for="time">Flight Time:</label><br>
        <input type="text" name="time" value="<?php echo $entry['flTime']; ?>" required><br><br>
		
		<label for="aircraft">Aircraft:</label><br>
        <input type="text" name="aircraft" value="<?php echo $entry['aircraft']; ?>" required><br><br>
		
		<label for="pay">Pay:</label><br>
        <input type="text" name="pay" value="<?php echo $entry['pay']; ?>" required><br><br>

        <input type="submit" name="submit" value="Update Post">
    </form>
	<a href="entries.php">Back</a>
</body>
</html>