<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";

if (isset($_POST['submit'])) {

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../assets/images/" . $image;

    move_uploaded_file($tmp, $folder);

    $query = "INSERT INTO gallery (title, description, price, image, category)
VALUES ('$title', '$description', '$price', '$image', '$category')";
    mysqli_query($conn, $query);

    $message = "Artwork added successfully!";
}
?>

<h2>Add Artwork</h2>

<?php if($message) echo "<p style='color:green'>$message</p>"; ?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Title"><br><br>

<input type="text" name="price" placeholder="Price"><br><br>

<input type="text" name="category" placeholder="Category (flower/gift/wedding)"><br><br>

<textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="file" name="image" required><br><br>

    <button type="submit" name="submit">Upload</button>
</form>
x
<br>
<a href="dashboard.php">Back</a>