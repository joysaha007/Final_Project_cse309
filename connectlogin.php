<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "cse309";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the login form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user data based on the entered email
    $getUserQuery = "SELECT * FROM registration WHERE email = '$email'";
    $result = $conn->query($getUserQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['is_admin'] == 1 && $password === $row['password']) {
            // Admin login successful, redirect to admin dashboard
            echo "<script>alert('Admin login successful!'); window.location.href = 'admin.html';</script>";
            exit();
        } elseif ($row['is_admin'] == 0 && $password === $row['password']) {
            // Regular user login successful, redirect to user dashboard
            echo "<script>alert('User login successful!'); window.location.href = 'indexhome.html';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('User not found. Please register.');</script>";
    }
}



// Close the database connection
$conn->close();


?>