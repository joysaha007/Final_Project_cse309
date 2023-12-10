<?php
// deleteproduct.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration (same as in your main file)
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

    // Get the productId from the form
    $productId = $_POST["productId"];

    // SQL to delete a product by id
    $sql = "DELETE FROM products WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $conn->close();
}
?>
