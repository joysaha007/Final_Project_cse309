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
                <li class="nav-item ">
                    <a class="nav-link" href="adminproducts.php">PRODUCTS</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="adminorder.html">ORDERS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">USERS</a>
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


    <div class="container " style="margin-top: 100px; ">
        <br> <h1 style="text-align: center;">TOTAL USER ACCOUNT</h1><br>
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

$query = "SELECT id, name, email FROM registration";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $productCount = 0;

// Inside the while loop
while ($row = $result->fetch_assoc()) {
    if ($productCount % 3 == 0) {
        echo '<div class="row">';
    }

    // Correct path separator and simplify path construction

    echo '<div class="col-md-4">';
    echo '<div class="container p-2" style="height: 250px; background-color: white; border: 5px solid #F1C40F; border-radius: 10px; text-align: center;">';

        
        echo '<div class="ml-2 mt-2">';
        echo '<h4 name="id" class="mt-2">' . $row['id'] . '</h4>';
        echo '<h4 name="name" class="mt-2">' . $row['name'] . '</h4>';
        echo '<h4 name="email" class="mt-2">' . $row['email'] . '</h4>';
        echo '<h4 class="mt-2">'. "User Type: User" . '</h4>';
        echo '<button class="btn btn-outline-danger ml-2" onclick="deleteProduct(' . $row['id'] . ')">Delete</button>';
        echo '</div>';
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



<br>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>