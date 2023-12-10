<?php
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$productname = $_POST['productname'];

$conn = new mysqli('localhost', 'root', '', 'cse309');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into customerinfo(name,email,contact, address, productname) values(?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $contact, $address, $productname);
    $stmt->execute();
    echo "<script>
    alert('Your submission has been successful! We will contact you soon. Stay healthy with our premium honey.');
    window.location.href = 'products.php';
  </script>";
    $stmt->close();
    $conn->close();
}
?>