<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User Data to Database</title>
</head>
<body>

    <h2>Add User Data to Database</h2>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection details
        $host = 'db';
        $user = 'db_user';
        $pass = 'db_password';
        $db = 'mydatabase';
        $charset = 'utf8mb4';

        // Create a connection
        $mysqli = new mysqli($host, $user, $pass, $db);

        // Check the connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Get data from the request
        $name = $mysqli->real_escape_string($_POST['name']);
        $email = $mysqli->real_escape_string($_POST['email']);

        // Insert data into the database
        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

        if ($mysqli->query($sql) === TRUE) {
            echo '<p>Data inserted successfully!</p>';
            
            // Redirect to index.php after successful submission
            echo '<a href="index.php">Go To Main Page!</p>';
            exit(); // Make sure to exit to prevent further execution
        } else {
            echo '<p>Error: ' . $sql . '<br>' . $mysqli->error . '</p>';
        }

        // Close the connection
        $mysqli->close();
    }
    ?>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
