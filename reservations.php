<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:login.html");
}
?>
<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST["date"];
    $time = $_POST["time"];
    $number = $_POST["number"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // You can perform further validation and sanitization here

    // Insert data into the database
    $sql = "INSERT INTO reservations (date, time, number, fname, lname,email, message) VALUES ('$date', '$time', '$number', '$fname', '$lname','$email' ,'$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservation successful!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>






