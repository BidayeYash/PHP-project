<?php 
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])){
    header("Location:adminlogin.html");
}
?>
<?php
// Include the database configuration file
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $mrp = $_POST["mrp"];
    $description = $_POST["description"];
    $file = $_FILES['file']['name'];

    // Specify the target directory for file upload
    $target_dir = "breakfast/";
    $target_name = $target_dir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $target_name);

    // Check for existing entry with the same name
    $checkQuery = "SELECT * FROM breakfast WHERE name = '$name'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Duplicate entry found, handle accordingly (e.g., show an error message)
        echo "Duplicate entry: $name already exists!";
    } else {
        // No duplicate entry found, proceed with the insertion
        $sql = "INSERT INTO breakfast (id, name, mrp, description, image) VALUES (NULL, '$name', '$mrp', '$description', '$file')";

        if (mysqli_query($conn, $sql)) {
            header("Location:addbreakfast.html"); // Redirect to the same page or another appropriate location
            exit();
        } else {
            echo "Something went wrong: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

