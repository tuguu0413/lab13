<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Data to Database</title>
</head>
<body>

    <h2>Add Product Data to Database</h2>

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
        $conn = new mysqli($host, $user, $pass, $db);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the request
        $name = $conn->real_escape_string($_POST['name']);
        $user_id = $conn->real_escape_string($_POST['user_id']);

        // Insert data into the database
        $sql = "INSERT INTO orders (user_id, product_name) VALUES ($user_id, '$name')";

        if ($conn->query($sql) === TRUE) {
            echo '<p>Data inserted successfully!</p>';
            
            // Redirect to index.php after successful submission
            echo '<a href="index.php">Go To Main Page!</p>';
            exit(); // Make sure to exit to prevent further execution
        } else {
            echo '<p>Error: ' . $sql . '<br>' . $conn->error . '</p>';
        }

        // Close the connection
        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="name">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
