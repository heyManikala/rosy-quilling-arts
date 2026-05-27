<?php
session_start();
include("includes/db.php");
$adminQuery = mysqli_query($conn, "SELECT * FROM admins LIMIT 1");
$adminData = mysqli_fetch_assoc($adminQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include("includes/navbar.php"); ?>

<h1 class="section-title">About Us</h1>

<div style="max-width:800px;margin:auto;padding:20px;color:#555;line-height:1.8;">

   <?php echo nl2br($adminData['about']); ?>

</div>

<?php include("includes/footer.php"); ?>
</body>
</html>

