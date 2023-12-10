<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "cse309"; // Correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure 'uploads' directory exists
$uploadDirectory = "uploads/";

if (!file_exists($uploadDirectory) && !is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

// Process the form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file is set and there is no error
    if (isset($_FILES["productImageFile"]) && $_FILES["productImageFile"]["error"] == UPLOAD_ERR_OK) {
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productDetails = $_POST['productDetails'];

     // Ensure unique filenames to avoid conflicts
$uniqueFilename = uniqid() . "_" . basename($_FILES["productImageFile"]["name"]);
$targetFile = __DIR__ . "/uploads/" . $uniqueFilename;

// Construct the complete URL
$baseURL = "http://localhost/cse309/";
$imageURL = $baseURL . str_replace(__DIR__, '', $targetFile);

// Now $imageURL contains the complete URL to the image
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["productImageFile"]["tmp_name"], $targetFile)) {
            // File upload successful
            // Insert data into the database
            $insertQuery = "INSERT INTO products (productName, productPrice, productDetails, productImage) VALUES ('$productName', '$productPrice', '$productDetails', '$targetFile')";

            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('Product added successfully!'); window.location.href = 'adminproducts.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error: " . $insertQuery . "\\n" . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error uploading file. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('File not uploaded or an error occurred.');</script>";
    }
}

// Close the database connection
$conn->close();
?>
