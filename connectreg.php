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

// Process the form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM registration WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please choose a different email.');</script>";
    } elseif ($password !== $confirmPassword) {
        echo "<script>alert('Password and confirm password do not match. Please try again.');</script>";
    } else {
        // Insert data into the database

        $insertQuery = "INSERT INTO registration (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Registration successful!'); window.location.href = 'login.html';</script>";
            exit();
        } else {
            echo "<script>alert('Error: " . $insertQuery . "\\n" . $conn->error . "');</script>";
        }
    }

}


// Close the database connection
$conn->close();


?>