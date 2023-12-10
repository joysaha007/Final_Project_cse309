<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cse309";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    $checkEmailQuery = "SELECT * FROM registration WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }
}

$conn->close();
?>
