<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php

include('config.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $_POST['user id']; // Corrected form field name
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);




    // Update item details in the database
    $sql = "UPDATE users SET username = '$username', password = '$password', email ='$email' WHERE 'user id' = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location:usermanage.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    $id = isset($_GET['user id']) ? $_GET['user id'] : null; 
    
    if (!$id) {
        echo "Error: Missing or Invalid 'user id' parameter.";
        exit();
    }
    $sql = "SELECT * FROM users WHERE 'user id' = $id"; // Corrected column name in SQL query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Caviar - Premium Restaurant Template</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

  </head>

  <body>
     <!-- Preloader -->
    <div id="preloader">
        <div class="caviar-load"></div>
        <div class="preload-icons">
            <img class="preload-1" src="img/core-img/preload-1.png" alt="">
            <img class="preload-2" src="img/core-img/preload-2.png" alt="">
            <img class="preload-3" src="img/core-img/preload-3.png" alt="">
        </div>
    </div>

    <!-- ***** Search Form Area ***** -->
    <div class="caviar-search-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-close-btn" id="closeBtn">
                        <i class="pe-7s-close-circle" aria-hidden="true"></i>
                    </div>
                    <form action="#" method="get">
                        <input type="search" name="caviarSearch" id="search" placeholder="Search Your Favourite Dish ...">
                        <input type="submit" class="d-none" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area" id="header">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg align-items-center">
                        <a class="navbar-brand" href="index.html">caviar</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#caviarNav" aria-controls="caviarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                        <div class="collapse navbar-collapse" id="caviarNav">
                            <ul class="navbar-nav ml-auto" id="caviarMenu">
                               
                                <li class="nav-item dropdown">
                            
                                        <a class="nav-link" href="usermanage.php">Usermanage</a>
    
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="addproduct.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Product</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="addbreakfast.html">Breakfast</a>
                                        <a class="dropdown-item" href="addlunch.html">Lunch</a>
                                        <a class="dropdown-item" href="adddinner.html">Dinner</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="editproduct.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Edit Product</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="editproductB.php">Breakfast</a>
                                        <a class="dropdown-item" href="editproductL.php">Lunch</a>
                                        <a class="dropdown-item" href="editproductD.php">Dinner</a>
                                    </div>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="booking.php">Booking</a>
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                            </ul>
                            <!-- Search Btn -->
                            <div class="caviar-search-btn">
                                <a id="search-btn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    
                <!-- Slider Nav -->
                <div class="hero-slides-nav bg-img" style="background-image: url(img/bg-img/hero-1.jpg);"></div>
            </div>
        </div>
    </section>
    <br><br><br><br>
    
    <main>
      <div class="container border border-5 border-dark my-5 p-5">
        <form action="ediituser.php" method="post">
            
          <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              name="name"
              id="user id"
              aria-describedby="helpId"
              placeholder="Name"
              value = "<?php echo "{$row['username']}"?>"
            />
            <small id="helpId" class="form-text text-muted">Help text</small>
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id=""
              aria-describedby="emailHelpId"
              placeholder="abc@mail.com"
              value = "<?php echo "{$row['email']}"?>"
            />
            <small id="emailHelpId" class="form-text text-muted"
              >Help text</small
            >
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              name="pass"
              id="user id"
              placeholder=""
              value = "<?php echo "{$row['password']}"?>"
            />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </main>
    <footer class="caviar-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-text">
                        <a href="#" class="navbar-brand">caviar</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
</body>
</html>
