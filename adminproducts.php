<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Admin</title>
</head>

<body style="background: url('backadmin.jpg') no-repeat center center fixed;background-size: cover;">

    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand ml-4" href="#"><img src="logo.png" alt="Image" height="80"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="margin-left: 300px;">
                <li class="nav-item ">
                    <a class="nav-link" href="admin.html">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminorder.html">ORDERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminuser.php">USERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminmessage.html">MESSAGES</a>
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

    <h1 style="text-align: center; margin-top:100px; color:aliceblue">Admin Dashboard</h1>
    <h6 style="text-align: center;"><i>"Sweetness Unveiled: Pure and Golden  Your One-Stop Honey Shop for Nature's Nectar Delights!"</i></h6>

    <div class="container" style="margin-top: 100px; background-color:antiquewhite; width:600px; text-align:center; border:4px solid #F1C40F; border-radius:15px;">
        <br>
        <form class="m-3" style="text-align: left;" method="post" action="connectproduct.php" enctype="multipart/form-data">
            <div class=" form-group ">
                <label for="ProductName ">Product Name</label>
                <input type="text " class="form-control " name="productName" id="productName " placeholder="Enter product name " required>
            </div>
            <div class="form-group ">
                <label for="productPrice ">Product Price:</label>
                <input type="number " class="form-control " name="productPrice" id="productPrice " placeholder="Enter product price " required>
            </div>
            <div class="form-group ">
                <label for="productDetails ">Product Details:</label>
                <textarea class="form-control " name="productDetails" id="productDetails " rows="3 " placeholder="Enter product details " required></textarea>
            </div>
            <div class="form-group">
                <label for="productImageFile">Upload Product Image:</label>
                <input type="file" class="form-control-file" id="productImageFile" name="productImageFile" accept="image/*" required>
            </div><br>
            <button type="submit " class="btn btn-outline-warning btn-block ">Add Product</button>
        </form><br>
    </div>
    <div class="container " style="margin-top: 100px; ">
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
        
        echo '<form id="deleteForm' . $row['id'] . '" method="post" action="deleteproduct.php">';
    echo '  <input type="hidden" name="productId" value="' . $row['id'] . '">';
    echo '  <button type="button" class="btn btn-outline-danger ml-2" onclick="submitDeleteForm(' . $row['id'] . ')">Delete</button>';
    echo '</form>';
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

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        function submitDeleteForm(productId) {
        // Submit the corresponding form for the product with the given productId
        document.getElementById('deleteForm' + productId).submit();
    }
        function showDetails(productId) {
            // Implement the logic to show details for the product with the given productId
            alert('Showing details for product with ID ' + productId);
        }

        function editProduct(productId) {
            // Implement the logic to edit the product with the given productId
            alert('Editing product with ID ' + productId);
        }

        function deleteProduct(productId) {
            // Implement the logic to delete the product with the given productId
            alert('Deleting product with ID ' + productId);
        }
    </script>
    <script src="path/to/your/jquery.min.js"></script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct " crossorigin="anonymous "></script>
    
   
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js " integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js " integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+ " crossorigin="anonymous "></script>
    -->
</body>

</html>