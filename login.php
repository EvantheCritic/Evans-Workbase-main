<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
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
    <div class="register">
        <h2>Sign In</h2>
        <?php
        include("db_connection.php"); // Include the database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                // Retrieve the user's data from the database based on email
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $user_data = $result->fetch_assoc();
                    $hashed_password = $user_data['Password'];

                    // Verify the password
                    if (password_verify($password, $hashed_password)) {
                        // Start a session and store user's email in it
                        session_start();
                        $_SESSION['email'] = $email;

                        // Redirect to the index page
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<p style='color: red;'>Invalid password.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>User not found.</p>";
                }
            } else {
                echo "<p style='color: red;'>Both email and password fields are required.</p>";
            }
        }

        // Close the database connection
        $conn->close();
        ?>
        <form class="form-register" method="post" action="">
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>