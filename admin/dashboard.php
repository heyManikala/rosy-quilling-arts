<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../includes/db.php");  // ✅ ADD THIS

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// ✅ ADD THIS (IMPORTANT)
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM gallery");
$data = mysqli_fetch_assoc($result);
$total = $data['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div style="padding:20px;">

<h1>🎨 Admin Dashboard</h1>

<p>Welcome, <b><?php echo $_SESSION['admin']; ?></b></p>

<hr>

<div class="dashboard-container">

    <div class="card">
        <h3>➕ Add Artwork</h3>
        <p>Upload new quilling designs</p>
        <a href="add_artwork.php">Go</a>
    </div>

    <div class="card">
        <h3>🖼 View Gallery</h3>
        <p>Check all artworks</p>
        <a href="../gallery.php">Open</a>
    </div>

    <div class="card">
        <h3>🚪 Logout</h3>
        <p>End admin session</p>
        <a href="../logout.php">Logout</a>
    </div>

  <div class="card">
    <h3>📊 Total Artworks</h3>
    <p><?php echo $total; ?></p>
</div>  

<div class="card">
    <h3>📩 Messages</h3>
    <p>View contact form messages</p>
    <a href="messages.php">Open</a>
</div>

</div>

</div>

</body>
</html>