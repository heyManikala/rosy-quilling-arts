<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

// get existing data
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $query = "UPDATE gallery 
          SET title='$title', 
              description='$description',
              price='$price'
          WHERE id=$id";

    mysqli_query($conn, $query);

    header("Location: ../gallery.php");
    exit();
}
?>

<h2>Edit Artwork</h2>

<form method="POST">
<input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>

<input type="text" name="price" value="<?php echo $row['price']; ?>"><br><br>

<textarea name="description"><?php echo $row['description']; ?></textarea><br><br>
    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="../gallery.php">Back</a>