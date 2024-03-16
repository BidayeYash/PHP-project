<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php 
include "config.php";
$id=$_POST["user id"];
$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];


$sql="UPDATE `users` SET `user id`='$id',`username`='$username',`email`='$email',`password`='$password' WHERE `user id`='$id'";

if (mysqli_query($conn,$sql)) {
    header("Location: updateuser.php");
} else {
    echo "something went wrong".mysqli_error($conn);
}


mysqli_close($conn);

?>