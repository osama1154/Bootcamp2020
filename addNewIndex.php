<?php
// Create database connection
$db = mysqli_connect("localhost", "root", "", "cricsl");

// Initialize message variable
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['Description']);

    // image file directory
    $target = "Images/".basename($_FILES["image"]["name"]);

    $sql = "INSERT INTO home_page (Title,Description,Image) VALUES ('$title','$description','$image')";
    // execute query
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CricSL</title>
    <link rel="icon" href="Images/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="CricSL.css">
</head>
<body>
<div id="content">
    <!--    --><?php
    //    while ($row = mysqli_fetch_array($result)) {
    //        echo "<div id='img_div'>";
    //        echo "<img src='images/".$row['Image']."' >";
    //        echo "</div>";
    //    }
    //

    include "nav.php"
    ?>
    <div class="container mt-4 mb-5 col-8 p-3" style="border: 1px solid darkgrey;border-radius: 20px">
        <div align="center" class="mt-4 mb-4">
            <h1>Add New News Feed</h1>
        </div>
    <form method="POST" action="addNewIndex.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div class="form-group">
            <label>Title: </label>
            <input type="text" name="title" placeholder="Title" required value="<?php if (isset($_POST['title'])){echo $_POST['title'];} ?>" class="form-control" style="border:1px solid black; border-radius: 10px">
        </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="Description" rows="5" id="description" style="border:1px solid black; border-radius: 10px"></textarea>
            </div>
        <div class="form-group">
            <label>Image: </label>
            <input type="file" name="image" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" name="upload">Save</button>
        </div>
    </form>
</div>
</div>
</body>
</html>