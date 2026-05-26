<?php
session_start();
include("includes/db.php");

$success = "";

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (name, email, message) 
              VALUES ('$name', '$email', '$message')";
    mysqli_query($conn, $query);

    $success = "Message sent successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact - Rosy Quilling Arts</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .contact-container {
            max-width: 600px;
            margin: 40px auto;
            text-align: center;
            color: #555;
            padding: 20px;
        }

        .contact-info {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(183,110,121,0.1);
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .contact-form {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(183,110,121,0.1);
            text-align: left;
        }

        .contact-form h3 {
            color: #b76e79;
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .contact-form textarea {
            height: 120px;
        }

        .contact-form label {
            color: #b76e79;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-send {
            width: 100%;
            padding: 12px;
            background: #b76e79;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-send:hover { background: #8c4c55; }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include("includes/navbar.php"); ?>

<h1 class="section-title">📞 Contact Us</h1>

<div class="contact-container">

    <!-- CONTACT INFO -->
    <div class="contact-info">
        <p>📸 Instagram: 
            <a href="https://www.instagram.com/rosyquilling.arts" 
               target="_blank" 
               style="background:none; color:#b76e79; padding:0;">
               @rosyquilling.arts
            </a>
        </p>
        <p>📱 WhatsApp: +977-98XXXXXXXX</p>
        <p>📧 Email: rosyquilling@gmail.com</p>
    </div>

    <!-- CONTACT FORM -->
    <div class="contact-form">
        <h3>✉️ Send a Message</h3>

        <?php if($success) echo "<div class='success'>$success</div>"; ?>

        <form method="POST">
            <label>Your Name</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label>Your Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Message</label>
            <textarea name="message" placeholder="Write your message..." required></textarea>

            <button type="submit" name="send" class="btn-send">Send Message</button>
        </form>
    </div>

</div>

<?php include("includes/footer.php"); ?>

</body>
</html>