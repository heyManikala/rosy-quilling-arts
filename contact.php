<?php include("includes/db.php"); session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include("includes/navbar.php"); ?>

<h1 class="section-title">Contact Us</h1>

<div style="max-width:600px;margin:auto;text-align:center;color:#555;">

<p>
📸 Instagram:
<a href="https://www.instagram.com/rosyquilling.arts" target="_blank">
    @rosyquilling.arts
</a>
</p>
<p>📱 WhatsApp: +977-98XXXXXXXX</p>
<p>📧 Email: rosyquilling@gmail.com</p>

<form>
    <input type="text" placeholder="Name"><br><br>
    <input type="email" placeholder="Email"><br><br>
    <textarea placeholder="Message"></textarea><br><br>
    <button type="submit">Send</button>
</form>

</div>

</body>
</html>