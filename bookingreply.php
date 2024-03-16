<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php
require_once "config.php";
// require_once "vendor/autoload.php"; // Include PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['Id'])) {
    $queryId = $_GET['Id'];

    // Fetch user query based on the ID
    $query = "SELECT * FROM reservations WHERE Id = $queryId";
    $result = mysqli_query($conn, $query);
    $queryData = mysqli_fetch_assoc($result);
} else {
    // Redirect to show_query.php if no ID is provided
    header("Location: booking.php");
    exit();
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
 

    <!-- ***** Header Area Start ***** -->
    <div class="container border border-1 border-dark my-5 p-3">
    <h2>Reply to booking Query</h2>
    <form action="bookingreply_process.php" method="post">
        <input type="hidden" name="Id" value="<?php echo $queryData['Id']; ?>">
        <div class="row g-3">
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Enter reply" id="reply" name="reply" style="height: 150px"></textarea>
                    <label for="reply">Reply</label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary w-100 py-3" type="submit">Send Reply</button>
    </form>
</div>


    <!-- ****** Footer Area Start ****** -->
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
    <!-- ****** Footer Area End ****** -->

    <!-- Jquery-2.2.4 js -->
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