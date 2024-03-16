<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php 

$id=$_GET["id"];

include "config.php";

$sql = "DELETE FROM `users` WHERE `users`.`user id` = $id";

if (mysqli_query($conn,$sql)) {
    header("Location: usermanage.php");
} else {
    echo "something went wrong".mysqli_error($conn);
}


mysqli_close($conn);

?>