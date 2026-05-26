<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // CHECK IF NEW IMAGE WAS UPLOADED
    if ($_FILES['image']['name'] != '') {

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $folder = "../assets/images/" . $image;
        move_uploaded_file($tmp, $folder);

        $query = "UPDATE gallery 
                  SET title='$title', 
                      description='$description',
                      price='$price',
                      category='$category',
                      image='$image'
                  WHERE id=$id";
    } else {

        // NO NEW IMAGE — keep old one
        $query = "UPDATE gallery 
                  SET title='$title', 
                      description='$description',
                      price='$price',
                      category='$category'
                  WHERE id=$id";
    }

    mysqli_query($conn, $query);

    header("Location: manage_artworks.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Artwork</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .edit-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(183,110,121,0.15);
        }

        .edit-container h2 {
            color: #b76e79;
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-container input,
        .edit-container textarea,
        .edit-container select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .edit-container textarea {
            height: 100px;
        }

        .current-img {
            text-align: center;
            margin-bottom: 15px;
        }

        .current-img img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #f0e0e3;
        }

        .current-img p {
            color: #888;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn-update {
            width: 100%;
            padding: 12px;
            background: #b76e79;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-update:hover {
            background: #8c4c55;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #888;
            text-decoration: none;
            background: none;
            padding: 0;
        }

        .btn-back:hover {
            color: #b76e79;
            background: none;
        }

        label {
            color: #b76e79;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="edit-container">

    <h2>✏️ Edit Artwork</h2>

    <!-- CURRENT IMAGE PREVIEW -->
    <div class="current-img">
        <img src="../assets/images/<?php echo $row['image']; ?>" 
             alt="current image">
        <p>Current Image</p>
    </div>

    <form method="POST" enctype="multipart/form-data">

        <label>Title</label>
        <input type="text" name="title" 
               value="<?php echo $row['title']; ?>" required>

        <label>Price (Rs.)</label>
        <input type="text" name="price" 
               value="<?php echo $row['price']; ?>">

        <label>Category</label>
        <select name="category">
            <option value="">-- Select Category --</option>
            <option value="flower" <?php echo ($row['category']=='flower') ? 'selected' : ''; ?>>Flower</option>
            <option value="gift" <?php echo ($row['category']=='gift') ? 'selected' : ''; ?>>Gift</option>
            <option value="wedding" <?php echo ($row['category']=='wedding') ? 'selected' : ''; ?>>Wedding</option>
            <option value="other" <?php echo ($row['category']=='other') ? 'selected' : ''; ?>>Other</option>
        </select>

        <label>Description</label>
        <textarea name="description"><?php echo $row['description']; ?></textarea>

        <label>Update Image (optional)</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" name="update" class="btn-update">
            Update Artwork
        </button>

    </form>

    <a href="manage_artworks.php" class="btn-back">← Back to Manage Artworks</a>

</div>

</body>
</html>