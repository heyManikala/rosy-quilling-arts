<?php
include("includes/db.php");
session_start();

$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM gallery 
              WHERE title LIKE '%$search%' 
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM gallery ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery - Rosy Quilling Arts</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* SEARCH BOX */
        .search-box {
            text-align: center;
            margin: 20px;
        }

        .search-box input {
            padding: 8px;
            width: 220px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        /* FILTERS */
        .filters {
            text-align: center;
            margin: 10px;
        }

        .filters a {
            margin: 5px;
            padding: 8px 12px;
            background: #b76e79;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .filters a:hover {
            background: #8c4c55;
        }

        /* GRID (Instagram Style) */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        /* CARD */
        .card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.03);
        }

        /* IMAGE */
        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: 0.3s;
            cursor: pointer;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        /* OVERLAY */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 220px;
            background: rgba(0,0,0,0.4);
            opacity: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
        }

        .card:hover .overlay {
            opacity: 1;
        }

        .overlay a {
            color: white;
            background: #b76e79;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

    </style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<h1 class="section-title">🖼 Gallery</h1>

<!-- SEARCH -->
<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Search artwork..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<!-- FILTERS -->
<div class="filters">
    <a href="gallery.php">All</a>
    <a href="gallery.php?search=flower">Flower</a>
    <a href="gallery.php?search=gift">Gift</a>
    <a href="gallery.php?search=wedding">Wedding</a>
</div>


<!-- GALLERY GRID -->
<div style="max-width:1200px; margin:0 auto;">
<div class="grid">

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<div class="card">
    <img src="assets/images/<?php echo htmlspecialchars($row['image']); ?>"
         onclick="openLightbox(this.src)">
    <div class="overlay">
        <a href="view.php?id=<?php echo $row['id']; ?>">View Details</a>
    </div>
    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
    <p>Rs. <?php echo htmlspecialchars($row['price']); ?></p>
</div>
<?php } ?>

</div>
</div>

<!-- LIGHTBOX POPUP -->
<div id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-img">
</div>

<script>
function openLightbox(imgSrc) {
    document.getElementById("lightbox").style.display = "flex";
    document.getElementById("lightbox-img").src = imgSrc;
}

function closeLightbox() {
    document.getElementById("lightbox").style.display = "none";
}
</script>

<style>
#lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

#lightbox img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}
</style>

</body>
</html>