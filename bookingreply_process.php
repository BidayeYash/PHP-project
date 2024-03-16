<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php
require_once "config.php"; // Include PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs/Caviar-master\admin/PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs/Caviar-master\admin/PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs/Caviar-master\admin/PHPMailer-master\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $queryId = $_POST['Id'];
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    // Update user query with the reply in the database
    $updateQuery = "UPDATE reservations SET reply='$reply' WHERE Id='$queryId'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Reply sent successfully!";

        // Fetch user email from the original query
        $fetchEmailQuery = "SELECT email FROM reservations WHERE Id = $queryId";
        $emailResult = mysqli_query($conn, $fetchEmailQuery);
        $emailData = mysqli_fetch_assoc($emailResult);
        $userEmail = $emailData['email'];

        // Send reply to the user using PHPMailer
        $mail = new PHPMailer(true);


        $email = 'phpdemo6969@gmail.com';
        $password = 'tioq pezc zdsv lmwm';


        try {
            // Configure SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $email;
            $mail->Password = $password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, 'Caviar-master');
            $mail->addAddress($email);
            $mail->addReplyTo($email, 'Support Email');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Regarding Booking Confirmation';
            $mail->Body = $reply;

            $mail->send();
            header("Location:booking.php");
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        echo "Error sending reply: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}