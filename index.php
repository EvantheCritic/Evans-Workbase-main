<!DOCTYPE html>
<html>
<head>
    <title>Evan's Workbase</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><img src="logo.png" alt="Ampps logo" height="78">Evan's Workbase</h1>
    <nav class="navbar">
        <div id="trapezoid">
            <a href="index.php">Home</a>
            <a href="employees.php">Employees</a>
            <a href="schedule.php">Schedule</a>
            <a href="entries.php">Flight Entries</a>
        </div>
    </nav>

    <?php
    session_start(); // Start the session

    // Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // User is logged in
        $user_email = $_SESSION['email'];
        
        // Retrieve the user's first name from the database (replace with your database retrieval code)
        include("db_connection.php"); // Include the database connection file
        $sql = "SELECT first_name FROM users WHERE email = '$user_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $user_name = $user_data['first_name'];
        } else {
            $user_name = "User"; // Default name if not found
        }

        echo '<div class="subHeader">';
        echo '<h2>Hi, ' . $user_name . '</h2>';
        echo '<a class="addNew" href="logout.php">Sign out</a>';
        echo '<a class="addNew" href="https://www.realtor.com/realestateandhomes-detail/34446-Ivy-Bend-Rd_Stover_MO_65078_M99087-03920?from=srp-map-list">Go to house</a>';
        echo '</div>';
        if ($_SESSION['email'] === "johnsonjevane@hotmail.com") {
            ?>
            <div class="register">
                <h2>Evan's Bills</h2>
                    <h4>Groceries: 2400</h4>
                    <h4>Insurance: 3500</h4>
                    <h4>House Bills: 900</h4>
                    <h4>Other: 2000</h4>
                <h4>Total: 8800</h4>
            </div>
            <?php
        }
    } else {
        // User is not logged in
        echo '<div class="subHeader">';
        echo '<h2>You are not Signed in</h2>';
        echo '<a class="addNew" href="login.php">Sign in</a>';
        echo '<a class="addNew" href="register.php">Sign up</a>';
        echo '</div>';
    }
    ?>

</body>
</html>










