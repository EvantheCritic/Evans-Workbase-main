<html>
<head>
    <title>Evan's Workbase</title>
	<link rel="stylesheet" href="styles.css">
	<script>
        function deleteEmployee(employeeId) {
            if (confirm("Are you sure you want to delete this employee?")) {
                const script_js = new XMLHttpRequest();
                script_js.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload(); // Reload the page after successful deletion
                    }
                };

                script_js.open('GET', 'delete_employee.php?id=' + employeeId, true);
                script_js.send();
            }
        }
    </script>
</head>
<body>
    <?php
	include("db_connection.php"); // Include the database connection file

    // Fetch data from the "posts" table
    $sql = "SELECT * FROM employees";
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
    <h2>Employees</h2>
    <?php
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION['email'])) {
        // Check if the user is the administrator
        if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
            echo '<a class="addNew" href="add_employee.php">+ Add new Employee</a>';
        }
    } else {
        echo "<h2 style='text-align: center'>You are not logged in.</h2>";
        exit;
    }
    ?>
    </div>

<?php
// Assuming you have already established a database connection and executed your query
if (mysqli_num_rows($res) > 0) {
    echo "<div class='card-list'>";
    // Output data
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<div class='card'>";
        echo "<h3 class='card-title'>" . $row["Name"] . "</h3>";
        echo "<ul class='card-info'>";
        echo "<li>Employee ID: " . $row["id"] . "</li>";
        echo "<li>Hours: " . $row["Hours"] . "</li>";
        echo "<li>Money: " . $row["Money"] . "</li>";
        echo "<li>Level: " . $row["Level"] . "</li>";
        echo "<li>Prestige: " . $row["Prestige"] . "</li>";
        echo "<li>Company: " . $row["Company"] . "</li>";
        echo "</ul>";
        if ($_SESSION['email'] === 'johnsonjevane@hotmail.com') {
            echo "<div class='card-footer'>
                <button class='editButton' onclick=\"deleteEmployee(" . $row["id"] . ")\">Delete</button>
                <a class='deleteButton' href=\"edit_employee.php?id=" . $row["id"] . "\">Edit</a>
                </div>";
        }
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<h2 style='text-align: center'>No posts found in the database.</h2>";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>