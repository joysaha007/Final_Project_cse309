<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Shop</title>
    <link rel="stylesheet" href="products.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ml-4" href="#"><img src="logo.png" alt="Image" height="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="margin-left: 300px;">
                <li class="nav-item ">
                    <a class="nav-link " href="indexhome.html">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">SHOP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.html">ORDERS</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="FinalAboutUs/indexAbout.html">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">CONTACT</a>
                </li>

            </ul>
            <div class=" my-2 my-lg-0 ">
                <div class="nav-item dropdown mr-3">
                    <a class="nav-link" style="margin-right: 80px;" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="login.html"><button type="button" class="btn btn-outline-warning">Logout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <h1 style="text-align: center; margin-top:100px; color:antiquewhite">SHOP</h1>
    <h6 style="text-align: center;"><i>"Here are all our Products"</i></h6>

    <div class="container mt-4" style="margin-top: 50vh;">
    <br>
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

$query = "SELECT id, productName, productPrice, productDetails, productImage FROM products";
$result = $conn->query($query);
$baseURL = "http://localhost/cse309/";

if ($result->num_rows > 0) {
    $productCount = 0;

// Inside the while loop
while ($row = $result->fetch_assoc()) {
    if ($productCount % 3 == 0) {
        echo '<div class="row">';
    }

    // Correct path separator and simplify path construction
    $imageURL = '/cse309/uploads/' . basename(str_replace("\\", "/", $row['productImage']));
    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/cse309/uploads/' . basename(str_replace("/", "\\", $row['productImage']));

    echo '<div class="col-md-4">';
    echo '<div class="container p-2" style="height: 300px; background-color: white; border: 5px solid #F1C40F; border-radius: 10px; text-align: center;">';

    if (file_exists($absolutePath)) {
        echo '<img src="' . $imageURL . '" alt="Product Image" class="img-fluid mx-auto"  style="height: 150px;">';
        echo '<div class="ml-2">';
        echo '<h4 name="productName">' . $row['productName'] . '</h4>';
        echo '<p name="productPrice">Price: $' . number_format($row['productPrice'], 2) . '</p>';
        echo '<button class="btn btn-warning ml-2" onclick="deleteProduct(' . $row['id'] . ')">Add To Cart</button>';
        echo '</div>';
    } else {
        echo '<p>Image not found: ' . $absolutePath . '</p>';
    }

    echo '</div>';
    echo '</div>';

    if ($productCount % 3 == 2 || $productCount == $result->num_rows - 1) {
        echo '</div>';
    }

    $productCount++;
}}
else {
    echo "0 results";
}

$conn->close();
?>


            <br> 

    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>