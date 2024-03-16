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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $mrp = $_POST['mrp'];

    $name = mysqli_real_escape_string($conn, $name);
    $description = mysqli_real_escape_string($conn, $description);
    $mrp = mysqli_real_escape_string($conn, $mrp);

    $targetDir = "breakfast/";
    $fileName = uniqid() . "_" . basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    $sql = "UPDATE breakfast SET name='$name', description='$description', mrp='$mrp', image='$fileName' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: editproductB.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$id) {
        echo "Error: Missing or invalid 'id' parameter.";
        exit();
    }

    $sql = "SELECT * FROM breakfast WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
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
    <div class="container border border-1 border-dark my-5 p-3">
        <h1 class="text-center">Edit Breakfast</h1>
        <form action="editbreakfast.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">MRP</label>
                <input type="number" class="form-control" name="mrp" value="<?php echo $row['mrp']; ?>" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Current Image</label><br>
                <img src="breakfast/<?php echo $row['image']; ?>" alt="Current Image" style="max-width: 150px; max-height: 150px;">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Choose New Image</label>
                <input type="file" class="form-control" name="file" id="" placeholder="" aria-describedby="fileHelpId">
                <div id="fileHelpId" class="form-text">Help text</div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    
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

    <?php
}

mysqli_close($conn);
?>
