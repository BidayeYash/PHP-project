<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];



if (!$conn) {
    echo "Not Connected" . mysqli_connect_error();
}

$sql = "SELECT * FROM admin_user WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header("Location: index.php");
} else {
    echo "Invalid Credentials <a href='adminlogin.html'>Try Again</a>";
}




mysqli_close($conn);

?>