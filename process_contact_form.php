<?php
// Database connection settings
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'ip_project';

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve and process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    // $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // Insert data into the table using prepared statements
    $sql = "INSERT INTO contact_messages (name, date, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $name, $date, $message);

        if (mysqli_stmt_execute($stmt)) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
