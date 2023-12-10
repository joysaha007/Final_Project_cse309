<?php
// deleteProduct.php

// Database configuration (similar to your existing code)
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];

    // Prepare and execute SQL statement to delete the product
    $deleteQuery = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('i', $productId);

    if ($stmt->execute()) {
        // Return success response
        echo "<script>
        alert('Product deleted successfully');
        window.location.href = 'adminproducts.php';
      </script>";
exit();
    } else {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    // Invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
