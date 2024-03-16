<?php 
session_start();
include('config.php');

// Check if form fields are set and not empty
if(isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    session_start();

    if (!$conn) {
        echo "Not Connected" . mysqli_connect_error();
    } 

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        header("Location: index.php");
        exit; // Always exit after redirection
    } else {
        echo "Invalid Credentials <a href='login.html'>Try Again</a>";
    }

    mysqli_close($conn);
} else {
    // If form fields are not set or empty, handle the error
    echo "Username and Password are required fields. <a href='login.html'>Try Again</a>";
}
?>
