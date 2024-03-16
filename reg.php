<?php 

include('config.php');

$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$confirmpassword=$_POST["confirmpassword"];
$duplicate = mysqli_query($conn,"Select * from users WHERE username = '$username' OR email = '$email'");
if(mysqli_num_rows($duplicate)>0){
    echo"<script> alert ('Username or Email Has Already Taken');</script>";
}else{
    if($password==$confirmpassword){
        $query = "INSERT INTO `users`(`user id`, `username`, `email`, `password`) VALUES ('$id','$username','$email','$password')";
mysqli_query($conn,$query);
echo
"<script> alert ('Registration Sucessful');</script>";
header("Location: login.html");
    }else{
        echo
        "<script> alert ('Password Does not Match ');</script>";

    }
}
mysqli_close($conn);
?>