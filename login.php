<?php
session_start();
include("includes/db.php");

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if ($row && $password == $row['password']) {
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <style>
        /* ===== BODY BACKGROUND ===== */
        body {
            margin: 0;
            font-family: Arial;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: url("assets/images/background.jpg") no-repeat center center/cover;
            position: relative;
            overflow: hidden;
        }

        /* DARK OVERLAY */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1;
        }

        /* ===== GLOWING PARTICLES ===== */
        .bg-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .bg-particles::before,
        .bg-particles::after {
            content: "";
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255,255,255,0.8);
            border-radius: 50%;
            box-shadow:
                0 0 10px rgba(255,255,255,0.8),
                0 0 20px rgba(255,182,193,0.6);
            animation: floatParticles 12s linear infinite;
        }

        .bg-particles::before {
            top: 20%;
            left: 20%;
        }

        .bg-particles::after {
            top: 60%;
            left: 70%;
            animation-duration: 16s;
        }

        @keyframes floatParticles {
            0% { transform: translateY(0); opacity: 0.8; }
            50% { opacity: 1; }
            100% { transform: translateY(-120px); opacity: 0; }
        }

        /* ===== FALLING PETALS ===== */
        .petal-container {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .petal {
            position: absolute;
            top: -50px;
            width: 18px;
            height: 18px;

            background: radial-gradient(circle, #e6478c, #a71cab);
            border-radius: 60% 40% 60% 40%;
            opacity: 0.9;

            animation: fallPetals linear infinite;
        }

        .petal:nth-child(1) { left: 5%; animation-duration: 8s; }
        .petal:nth-child(2) { left: 15%; animation-duration: 10s; }
        .petal:nth-child(3) { left: 30%; animation-duration: 7s; }
        .petal:nth-child(4) { left: 45%; animation-duration: 9s; }
        .petal:nth-child(5) { left: 60%; animation-duration: 11s; }
        .petal:nth-child(6) { left: 75%; animation-duration: 8s; }
        .petal:nth-child(7) { left: 90%; animation-duration: 12s; }

        @keyframes fallPetals {
            0% {
                transform: translateY(-50px) rotate(0deg);
                opacity: 0;
            }
            20% { opacity: 1; }
            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* ===== LOGIN BOX ===== */
        .login-box {
            position: relative;
            z-index: 2;
            background: white;
            padding: 40px;
            width: 320px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
        }

        h2 {
            color: #b76e79;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 22px;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #b76e79;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #8c4c55;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<!-- BACKGROUND EFFECTS -->
<div class="bg-particles"></div>

<div class="petal-container">
    <span class="petal"></span>
    <span class="petal"></span>
    <span class="petal"></span>
    <span class="petal"></span>
    <span class="petal"></span>
    <span class="petal"></span>
    <span class="petal"></span>
</div>

<!-- LOGIN BOX -->
<div class="login-box">

    <div class="logo">🌸 Rosy Quilling Arts</div>

    <h2>Admin Login</h2>

    <?php if($error != "") echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

</div>

</body>
</html>