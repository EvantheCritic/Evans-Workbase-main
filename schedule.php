<!DOCTYPE html>
<html>
<head>
    <title>Evan's Workbase</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		function changeStatus(employeeId, newStatus) {
			$.ajax({
				type: "POST",
				url: "update_status.php", // Create this PHP file to handle the database update
				data: { employeeId: employeeId, newStatus: newStatus },
				success: function(response) {
					location.reload(); // Refresh the page to reflect the updated status
				},
				error: function(error) {
					alert("Error updating status: " + error.responseText);
				}
			});
		}
		
		function deleteScheduleEmployee(employeeId) {
            if (confirm("Are you sure you want to delete this employee?")) {
                const script_js = new XMLHttpRequest();
                script_js.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload(); // Reload the page after successful deletion
                    }
                };

                script_js.open('GET', 'delete_schedule_employee.php?id=' + employeeId, true);
                script_js.send();
            }
        }
	</script>
</head>
<body>
    <?php
	include("db_connection.php"); // Include the database connection file

    // Fetch data from the "schecule" table
    $sql = "SELECT * FROM schedule";
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
    <h2>Schedule</h2>
    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION['email'])) {
        // Check if the user is the administrator
        if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
            echo '<a class="addNew" href="add_schedule_employee.php">+ Add new Employee</a>';
        }
    } else {
        echo "<h2 style='text-align: center'>You are not logged in.</h2>";
        exit;
    }
    ?>
    </div>
	<?php
	if (mysqli_num_rows($res) > 0) {
    echo "<table class='schedule'>";
    echo "<tr><th>Employee</th><th>Status</th>";
	if (isset($_SESSION['email'])) {
        // Check if the user is the administrator
        if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
			"<th>Change Status</th><th>Delete?</th></tr>";
        }
    }
    // Output data of each row
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>" . $row["employee"] . "</td>";

        // Apply different background colors based on status
        $status = $row["status"];
        $backgroundColor = '';
		$color = '';

        if ($status == "ON") {
            $backgroundColor = "#FFF"; // White background for ON status
			$color = "#000";
        } 
		elseif ($status == "OFF") {
            $backgroundColor = "#007705"; // Green background for OFF status
			$color = "#000";
        }
		elseif ($status == "STBY") {
			$backgroundColor = "#0010cb"; // Blue background for PERM status
			$color = "#FFF";
		}
		elseif ($status == "REQ") {
			$backgroundColor = "#000"; // Black background for REQ status
			$color = "#FFF";
		}
		elseif ($status == "TRIP") {
			$backgroundColor = "#FF0000"; // Red background for TRIP status
			$color = "#000";
		}
		elseif ($status == "SICK") {
			$backgroundColor = "#FF9EFC"; // Pink background for SICK status
			$color = "#000";
		}
		else {
			$backgroundColor = "#666"; // Grey Default background
			$color = "#000";
		}

		// Apply the background color to the <td> element
		echo "<td style='background-color: $backgroundColor; color: $color;'>" . $status . "</td>";
		
		if (isset($_SESSION['email'])) {
			// Check if the user is the administrator
			if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
				
				// Adding buttons for each status
				echo "<td class='buttons'>";
				$statuses = ["ON", "OFF", "STBY", "REQ", "TRIP", "SICK"];
				foreach ($statuses as $newStatus) {
					echo "<button onclick=\"changeStatus(" . $row["id"] . ", '$newStatus')\">$newStatus</button>";
				}
				echo "</td>";
				echo "<td><button class='editButton' onclick=\"deleteScheduleEmployee(" . $row["id"] . ")\">Delete</button></td>";
			}
		} 
        echo "</tr>";
	}
    } else {
        echo "No schedule found in the database.";
    }

    // Close the database connection
    mysqli_close($conn);
	?>
</body>
</html>

