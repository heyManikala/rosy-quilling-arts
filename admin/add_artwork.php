<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";
$error = "";

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];

    // GET FILE EXTENSION
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    // ALLOWED EXTENSIONS
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed)) {
        $error = "❌ Only JPG, PNG, GIF, WEBP images are allowed!";

    } elseif ($imageSize > 5000000) {
        $error = "❌ Image size must be less than 5MB!";

    } else {
        $folder = "../assets/images/" . $image;
        move_uploaded_file($tmp, $folder);

        $query = "INSERT INTO gallery (title, description, price, image, category)
                  VALUES ('$title', '$description', '$price', '$image', '$category')";
        mysqli_query($conn, $query);

        $message = "✅ Artwork added successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Artwork</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .add-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(183,110,121,0.15);
        }

        .add-container h2 {
            color: #b76e79;
            text-align: center;
            margin-bottom: 20px;
        }

        .add-container input,
        .add-container textarea,
        .add-container select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .add-container textarea { height: 100px; }

        label {
            color: #b76e79;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-upload {
            width: 100%;
            padding: 12px;
            background: #b76e79;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-upload:hover { background: #8c4c55; }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
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

        .btn-back:hover { color: #b76e79; background: none; }
    </style>
</head>
<body>

<div class="add-container">

    <h2>➕ Add New Artwork</h2>

    <?php if($message) echo "<div class='success'>$message</div>"; ?>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Title</label>
        <input type="text" name="title" placeholder="Enter artwork title" required>

        <label>Price (Rs.)</label>
        <input type="text" name="price" placeholder="e.g. 500">

        <label>Category</label>
        <select name="category">
            <option value="">-- Select Category --</option>
            <option value="flower">Flower</option>
            <option value="gift">Gift</option>
            <option value="wedding">Wedding</option>
            <option value="other">Other</option>
        </select>

        <label>Description</label>
        <textarea name="description" placeholder="Describe the artwork..."></textarea>

        <label>Image (JPG, PNG, GIF, WEBP — max 5MB)</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="submit" class="btn-upload">
            Upload Artwork
        </button>

    </form>

    <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</div>

</body>
</html>