<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// get messages
$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .msg-container {
            max-width: 900px;
            margin: 30px auto;
        }

        .msg-card {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .msg-card h3 {
            color: #b76e79;
            margin-bottom: 5px;
        }

        .msg-card small {
            color: gray;
        }
    </style>
</head>

<body>

<h1 style="text-align:center; color:#b76e79;">📩 Contact Messages</h1>

<div class="msg-container">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="msg-card">
        <h3><?php echo $row['name']; ?></h3>
        <small><?php echo $row['email']; ?> | <?php echo $row['created_at']; ?></small>
        <p><?php echo $row['message']; ?></p>
        <div style="margin-top:15px;">

    <a href="mailto:<?php echo $row['email']; ?>?
subject=Reply from Rosy Quilling Arts"
    
    style="
    background:#b76e79;
    color:white;
    padding:8px 15px;
    border-radius:20px;
    text-decoration:none;
    display:inline-block;
    ">
        ✉️ Reply
    </a>

</div>
<a href="delete_message.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Delete this message?')"

   style="
   background:#d9534f;
   color:white;
   padding:8px 15px;
   border-radius:20px;
   text-decoration:none;
   margin-left:10px;
   display:inline-block;
   ">
   🗑 Delete
</a>
    </div>

<?php } ?>

</div>

</body>
</html>