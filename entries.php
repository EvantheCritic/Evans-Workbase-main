<!DOCTYPE html>
<html>
<head>
    <title>Evan's Workbase</title>
	<link rel="stylesheet" href="styles.css">
	<script>
		function deleteEntry(entryID) {
			if (confirm("Are you sure you want to delete this entry?")) {
				const xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState === 4 && this.status === 200) {
						location.reload(); // Reload the page after successful deletion
					}
				};

				xhttp.open('GET', 'delete_entry.php?entryID=' + entryID, true);
				xhttp.send();
			}
		}
	</script>
</head>
<body>
    <?php
	include("db_connection.php"); // Include the database connection file

    // Fetch data from the "entries" table
    $sql = "SELECT * FROM entries";
    $res = mysqli_query($conn, $sql);
	?>   

	<h1><img src="logo.png" alt="Ampps logo" height="78">Evan's Workbase</h1>
    <nav class="navbar">
		<div id="trapezoid">
			<a href="index.php">Home</a>
			<a href="employees.php">Employees</a>
			<a href ="schedule.php">Schedule</a>
			<a href="entries.php">Flight Entries</a>
		</div>
	</nav>
	<div class="subHeader">
    <h2>Flight Entries</h2>
    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION['email'])) {
        // Check if the user is the administrator
        if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
            echo '<a class="addNew" href="add_entry.php">+ Add new Entry</a>';
        }
    } else {
        echo "<h2 style='text-align: center'>You are not logged in.</h2>";
        exit;
    }
    ?>
    </div>
	<?php
	if (mysqli_num_rows($res) > 0) {
        echo "<table>";
        echo "<tr><th>Entry ID</th><th>Employee Id 1</th><th>Employee Id 2</th><th>Date</th><th>Departure</th><th>Arrival</th><th>Flight time</th><th>Aircraft</th><th>Pay</th><th>options</th></tr>";
        
        // Output data of each row
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>" . $row["entryID"] . "</td>";
            echo "<td>" . $row["empID1"] . "</td>";
			echo "<td>" . $row["empID2"] . "</td>";
			echo "<td>" . $row["date"] . "</td>";
			echo "<td>" . $row["departure"] . "</td>";
			echo "<td>" . $row["arrival"] . "</td>";
			echo "<td>" . $row["flTime"] . "</td>";
			echo "<td>" . $row["aircraft"] . "</td>";
			echo "<td>" . $row["pay"] . "</td>";
			echo "<td>
                      <button class='editButton' onclick=\"deleteEntry(" . $row["entryID"] . ")\">Delete</button>
                      <a class='deleteButton' href=\"edit_entry.php?id=" . $row["entryID"] . "\">Edit</a>
                  </td>";
            echo "</tr>";
			
        }
        
        echo "</table>";
    } else {
        echo "No posts found in the database.";
    }

    // Close the database connection
    mysqli_close($conn);
	?>
</body>
</html>