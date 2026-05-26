<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM gallery");
$data = mysqli_fetch_assoc($result);
$total = $data['total'];

$msgResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM messages");
$msgData = mysqli_fetch_assoc($msgResult);
$totalMessages = $msgData['total'];

$recentResult = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC LIMIT 4");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial;
            background: #faf7f5;
            min-height: 100vh;
        }

        /* TOP BAR */
        .admin-topbar {
            background: linear-gradient(135deg, #b76e79, #8c4c55);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .admin-topbar h1 {
            font-size: 22px;
            color: white;
            margin: 0;
            text-align: left;
        }

        .admin-topbar .welcome {
            font-size: 14px;
            opacity: 0.9;
        }

        .admin-topbar a {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .admin-topbar a:hover {
            background: rgba(255,255,255,0.3);
        }

        /* MAIN CONTENT */
        .dashboard-main {
            padding: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* STATS ROW */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(183,110,121,0.1);
            border-left: 4px solid #b76e79;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(183,110,121,0.2);
        }

        .stat-card .icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: bold;
            color: #b76e79;
        }

        .stat-card .label {
            color: #888;
            font-size: 14px;
            margin-top: 5px;
        }

        /* ACTION CARDS */
        .section-title {
            color: #b76e79;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f0e0e3;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(183,110,121,0.1);
            transition: 0.3s;
            text-decoration: none;
            color: #333;
            display: block;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(183,110,121,0.2);
            background: #fff5f7;
            color: #333;
        }

        .action-card .icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .action-card h3 {
            color: #b76e79;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .action-card p {
            color: #888;
            font-size: 13px;
        }

        /* RECENT ARTWORKS */
        .recent-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .recent-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(183,110,121,0.1);
            transition: 0.3s;
        }

        .recent-card:hover {
            transform: translateY(-3px);
        }

        .recent-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .recent-card .info {
            padding: 10px;
        }

        .recent-card .info h4 {
            color: #b76e79;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .recent-card .info p {
            color: #888;
            font-size: 13px;
        }
    </style>
</head>
<body>

<!-- TOP BAR -->
<div class="admin-topbar">
    <div>
        <h1>🎨 Admin Dashboard</h1>
        <div class="welcome">Welcome back, <b><?php echo $_SESSION['admin']; ?></b></div>
    </div>
    <div style="display:flex; gap:10px;">
        <a href="../index.php">🌐 View Site</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>
</div>

<div class="dashboard-main">

    <!-- STATS -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="icon">🖼</div>
            <div class="number"><?php echo $total; ?></div>
            <div class="label">Total Artworks</div>
        </div>
        <div class="stat-card">
            <div class="icon">📩</div>
            <div class="number"><?php echo $totalMessages; ?></div>
            <div class="label">Total Messages</div>
        </div>
        <div class="stat-card">
            <div class="icon">🌸</div>
            <div class="number">Rosy</div>
            <div class="label">Admin Account</div>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <h2 class="section-title">⚡ Quick Actions</h2>
    <div class="actions-grid">
        <a href="add_artwork.php" class="action-card">
            <div class="icon">➕</div>
            <h3>Add Artwork</h3>
            <p>Upload new quilling designs</p>
        </a>
        <a href="manage_artworks.php" class="action-card">
            <div class="icon">🗂</div>
            <h3>Manage Artworks</h3>
            <p>Edit or delete artworks</p>
        </a>
        <a href="messages.php" class="action-card">
            <div class="icon">📩</div>
            <h3>Messages</h3>
            <p>View contact form messages</p>
        </a>
        <a href="../gallery.php" class="action-card">
            <div class="icon">🖼</div>
            <h3>View Gallery</h3>
            <p>See public gallery</p>
        </a>
    </div>

    <!-- RECENT ARTWORKS -->
    <h2 class="section-title">🕐 Recently Added</h2>
    <div class="recent-grid">
        <?php while($row = mysqli_fetch_assoc($recentResult)) { ?>
        <div class="recent-card">
            <img src="../assets/images/<?php echo $row['image']; ?>">
            <div class="info">
                <h4><?php echo $row['title']; ?></h4>
                <p>Rs. <?php echo $row['price'] ? $row['price'] : '...'; ?></p>
            </div>
        </div>
        <?php } ?>
    </div>

</div>

</body>
</html>