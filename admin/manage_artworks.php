<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Artworks</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .manage-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .manage-title {
            color: #b76e79;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(183,110,121,0.1);
        }

        th {
            background: #b76e79;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }

        td {
            padding: 10px 15px;
            border-bottom: 1px solid #f0e0e3;
            color: #555;
            vertical-align: middle;
        }

        tr:hover {
            background: #fff5f7;
        }

        td img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-edit {
            background: #f0ad4e;
            color: white;
            padding: 6px 14px;
            border-radius: 15px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-delete {
            background: #d9534f;
            color: white;
            padding: 6px 14px;
            border-radius: 15px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-edit:hover { background: #e09b3a; }
        .btn-delete:hover { background: #c9302c; }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-add {
            background: #b76e79;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
        }

        .btn-add:hover {
            background: #8c4c55;
        }

        .btn-back {
            background: #888;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
        }

        .btn-back:hover { background: #666; }
    </style>
</head>

<body>

<div class="manage-container">

    <h1 class="manage-title">🖼 Manage Artworks</h1>

    <div class="top-bar">
        <a href="dashboard.php" class="btn-back">← Dashboard</a>
        <a href="add_artwork.php" class="btn-add">➕ Add New Artwork</a>
    </div>

    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td>
                <img src="../assets/images/<?php echo $row['image']; ?>" 
                     alt="<?php echo $row['title']; ?>">
            </td>
            <td><?php echo $row['title']; ?></td>
            <td>Rs. <?php echo $row['price'] ? $row['price'] : '...'; ?></td>
            <td><?php echo $row['category'] ? $row['category'] : '-'; ?></td>
            <td>
                <a href="../admin/edit_artwork.php?id=<?php echo $row['id']; ?>" 
                   class="btn-edit">✏️ Edit</a>

                <a href="../admin/delete_artwork.php?id=<?php echo $row['id']; ?>"
                   class="btn-delete"
                   onclick="return confirm('Delete this artwork?')">
                   🗑️ Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>