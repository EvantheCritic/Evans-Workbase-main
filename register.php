<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
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
        <h2>Sign Up</h2>
        <?php
        include("db_connection.php"); // Include the database connection file

        // Check if the registration form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            // Check if passwords match
            if ($password !== $confirm_password) {
                echo "<p style='color: red;'>Passwords do not match.</p>";
            } else {
                // Check if email is already taken
                $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
                $email_check_result = $conn->query($email_check_sql);

                if ($email_check_result->num_rows > 0) {
                    echo "<p style='color: red;'>Email is already taken.</p>";
                } else {
                    // Get the next available ID
                    $next_id_sql = "SELECT MAX(id) AS max_id FROM users";
                    $next_id_result = $conn->query($next_id_sql);

                    if ($next_id_result) {
                        $row = $next_id_result->fetch_assoc();
                        $new_id = ($row["max_id"] !== null) ? $row["max_id"] + 1 : 1;

                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Insert the user information into the database with the new ID
                        $insert_sql = "INSERT INTO users (id, first_name, last_name, email, password)
                                   VALUES ('$new_id', '$first_name', '$last_name', '$email', '$hashed_password')";

                        if ($conn->query($insert_sql) === TRUE) {
                            // Create a session for the newly registered user
                            session_start();
                            $_SESSION['email'] = $email; // Set the user's email in the session
                            header("Location: index.php");
                            exit();
                        } else {
                            echo "Error: " . $insert_sql . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error retrieving next ID: " . $conn->error;
                    }
                }
            }
        }

        // Close the database connection
        $conn->close();
        ?>
        <form class="form-register" method="post" action="">
            First Name: <input type="text" name="first_name" required><br>
            Last Name: <input type="text" name="last_name" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            Confirm Password: <input type="password" name="confirm_password" required><br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>