<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$success = "";

// GET CURRENT PROFILE INFO
$result = mysqli_query($conn, "SELECT * FROM admins WHERE username='{$_SESSION['admin']}'");
$admin = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $about = $_POST['about'];
    $whatsapp = $_POST['whatsapp'];
    $instagram = $_POST['instagram'];

    $query = "UPDATE admins 
              SET email='$email', about='$about', 
                  whatsapp='$whatsapp', instagram='$instagram'
              WHERE username='{$_SESSION['admin']}'";
    mysqli_query($conn, $query);
    $success = "Profile updated successfully!";

    // Refresh data
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE username='{$_SESSION['admin']}'");
    $admin = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background: #faf7f5; }

        .profile-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(183,110,121,0.15);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-header .avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #b76e79, #8c4c55);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 15px;
        }

        .profile-header h2 {
            color: #b76e79;
            margin-bottom: 5px;
        }

        .profile-header p {
            color: #888;
            font-size: 14px;
        }

        label {
            color: #b76e79;
            font-weight: bold;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea { height: 100px; }

        .btn-save {
            width: 100%;
            padding: 12px;
            background: #b76e79;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-save:hover { background: #8c4c55; }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #888;
            text-decoration: none;
            background: none;
            padding: 0;
        }

        .btn-back:hover { color: #b76e79; background: none; }

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

<div class="profile-container">
    <div class="profile-card">

        <div class="profile-header">
            <div class="avatar">🌸</div>
            <h2><?php echo $_SESSION['admin']; ?></h2>
            <p>Administrator — Rosy Quilling Arts</p>
        </div>

        <?php if($success) echo "<div class='success'>✅ $success</div>"; ?>

        <form method="POST">

            <label>📧 Email</label>
            <input type="email" name="email"
                   value="<?php echo isset($admin['email']) ? $admin['email'] : ''; ?>"
                   placeholder="your@email.com">

            <label>📱 WhatsApp Number</label>
            <input type="text" name="whatsapp"
                   value="<?php echo isset($admin['whatsapp']) ? $admin['whatsapp'] : ''; ?>"
                   placeholder="+977-98XXXXXXXX">

            <label>📸 Instagram Username</label>
            <input type="text" name="instagram"
                   value="<?php echo isset($admin['instagram']) ? $admin['instagram'] : ''; ?>"
                   placeholder="@rosyquilling.arts">

            <label>💖 About Me</label>
            <textarea name="about"
                      placeholder="Tell visitors about yourself and your art...">
<?php echo isset($admin['about']) ? $admin['about'] : ''; ?>
            </textarea>

            <button type="submit" name="update" class="btn-save">
                💾 Save Profile
            </button>

        </form>

        <a href="dashboard.php?view=full" class="btn-back">← Back to Dashboard</a>

    </div>
</div>

</body>
</html>