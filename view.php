<?php
session_start();
include("includes/db.php");

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: gallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['title']; ?> - Rosy Quilling Arts</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="description" content="Buy <?php echo $row['title']; ?> handmade paper quilling art by Rosy Quilling Arts. Perfect for gifts, decoration, and special occasions.">

    <style>
        .view-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(183,110,121,0.15);
        }

        .view-image {
            flex: 1;
            min-width: 280px;
        }

        .view-image img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
        }

        .view-details {
            flex: 1;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .view-details h2 {
            color: #b76e79;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .view-details .price {
            font-size: 22px;
            color: #8c4c55;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .view-details .description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .back-btn {
            display: inline-block;
            background: #b76e79;
            color: white;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            transition: 0.3s;
            width: fit-content;
        }

        .back-btn:hover {
            background: #8c4c55;
            transform: translateY(-2px);
        }

        /* Admin buttons - only show if logged in */
        .admin-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background: #f0ad4e;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-delete {
            background: #d9534f;
            color: white;
            padding: 8px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-edit:hover { background: #e09b3a; }
        .btn-delete:hover { background: #c9302c; }
    </style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="view-container">

    <!-- IMAGE -->
    <div class="view-image">
        <img src="assets/images/<?php echo $row['image']; ?>" 
             alt="<?php echo $row['title']; ?>">
    </div>

    <!-- DETAILS -->
    <div class="view-details">

        <h2><?php echo $row['title']; ?></h2>

        <div class="price">Rs. <?php echo $row['price']; ?></div>

        <div class="description">
            <?php echo $row['description']; ?>
        </div>

        <!-- SHARE BUTTONS -->
<div style="margin-top:20px;">

    <a href="https://wa.me/?text=<?php echo urlencode($row['title'] . ' - http://localhost/rosy-quilling-arts/view.php?id=' . $row['id']); ?>" target="_blank">
        WhatsApp
    </a>

    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://localhost/rosy-quilling-arts/view.php?id=' . $row['id']); ?>" target="_blank">
        Facebook
    </a>

    <button onclick="copyLink()">Copy Link</button>

</div>

        <a href="gallery.php" class="back-btn">← Back to Gallery</a>

        <!-- SHOW EDIT/DELETE ONLY IF ADMIN IS LOGGED IN -->
        <?php if(isset($_SESSION['admin'])) { ?>
        <div class="admin-actions">
            <a href="admin/edit_artwork.php?id=<?php echo $row['id']; ?>" 
               class="btn-edit">✏️ Edit</a>
            <a href="admin/delete_artwork.php?id=<?php echo $row['id']; ?>" 
               class="btn-delete"
               onclick="return confirm('Delete this artwork?')">🗑️ Delete</a>
        </div>
        <?php } ?>

    </div>

</div>

<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    alert("Link copied!");
}
</script>

</body>
</html>