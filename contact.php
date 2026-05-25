<?php
include("includes/db.php");
session_start();

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    mysqli_query($conn, "INSERT INTO messages (name, email, message)
    VALUES ('$name', '$email', '$message')");
}
?>
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

<form method="POST" action="contact.php">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <textarea name="message" placeholder="Message" required></textarea><br><br>
    <button type="submit" name="send">Send</button>
</form>

</div>

</body>
</html>