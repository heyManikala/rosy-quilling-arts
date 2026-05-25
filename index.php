<?php
include("includes/db.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Rosy Quilling Arts</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
         body {
            margin: 0;
            font-family: Arial;
            background: #faf7f5;
        }

        html {
            scroll-behavior: smooth;
        }

        /* HERO */
        .hero {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg,#fff0f5,#ffffff);
        }

        .hero h1 {
            color: #b76e79;
            font-size: 45px;
        }

        .hero p {
            font-size: 18px;
            color: #555;
        }

        .hero a {
            display: inline-block;
            margin-top: 15px;
            background: #b76e79;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
        }

        /* SECTIONS */
        .section-title {
            text-align: center;
            margin: 40px 0 20px;
            color: #b76e79;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .about, .contact {
            max-width: 700px;
            margin: auto;
            text-align: center;
            padding: 20px;
            color: #555;
            line-height: 1.6;
        }

        .view-btn {
            text-align: center;
            margin: 20px;
        }

        .view-btn a {
            background: #b76e79;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .view-btn a:hover {
            background: #8c4c55;
        }

    </style>
</head>

<body>

<!-- NAVBAR -->
<?php include("includes/navbar.php"); ?>

<!-- HERO SECTION -->
<div class="hero">
    <h1>🌸 Rosy Quilling Arts</h1>
    <p>Handmade Paper Quilling Art with Love & Creativity</p>
    <a href="gallery.php">Explore Gallery</a>
</div>

<!-- ABOUT US (MOVED UP) -->
<h2 class="section-title">💖 About Us</h2>
<div class="about">
    <p>
        Rosy Quilling Arts is a handmade craft studio creating unique paper quilling designs
        for gifts, decoration, and special occasions. Every artwork is made with creativity,
        patience, and love.
    </p>
    <div style="text-align:center; margin-top:15px;">
        <a href="about.php" class="btn-pink">Read More About Us</a>
    </div>
</div>

<!-- FEATURED GALLERY -->
<h2 class="section-title" id="featured">✨ Featured Artworks</h2>

<div class="grid">

<?php
$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC LIMIT 6");

while($row = mysqli_fetch_assoc($result)) {
?>

<div class="card">
    <img src="assets/images/<?php echo $row['image']; ?>">
    <h3><?php echo $row['title']; ?></h3>
    <p>Rs. <?php echo $row['price']; ?></p>
</div>

<?php } ?>

</div>

<!-- VIEW FULL GALLERY BUTTON -->
<div class="view-btn">
    <a href="gallery.php">View Full Gallery →</a>
</div>

<!-- CONTACT SECTION -->
<h2 class="section-title">📞 Contact</h2>
<div class="contact">
    <p>📸 Instagram: @rosyquilling.arts</p>
    <p>📱 WhatsApp: +977-98XXXXXXXX</p>
    <p>📧 Email: rosyquilling@gmail.com</p>
    <div style="margin-top:15px;">
        <a href="contact.php" class="btn-pink">Get In Touch</a>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <p>© 2026 Rosy Quilling Arts | All Rights Reserved</p>
</div>

</body>
</html>