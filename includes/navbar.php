<?php
// GET CURRENT PAGE NAME
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="navbar">

    <!-- LOGO -->
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" alt="logo">
        Rosy Quilling Arts
    </a>

    <!-- NAV LINKS -->
    <div class="nav-links">
        <a href="index.php" 
           style="<?php echo ($currentPage == 'index.php') ? 'background:#8c4c55;' : ''; ?>">
           Home
        </a>

        <a href="about.php" 
           style="<?php echo ($currentPage == 'about.php') ? 'background:#8c4c55;' : ''; ?>">
           About
        </a>

        <a href="gallery.php" 
           style="<?php echo ($currentPage == 'gallery.php') ? 'background:#8c4c55;' : ''; ?>">
           Gallery
        </a>

        <a href="contact.php" 
           style="<?php echo ($currentPage == 'contact.php') ? 'background:#8c4c55;' : ''; ?>">
           Contact
        </a>

        <a href="https://www.instagram.com/rosyquilling.arts" target="_blank">
            📸 Instagram
        </a>

        <a href="login.php"
           style="<?php echo ($currentPage == 'login.php') ? 'background:#8c4c55;' : ''; ?>">
           Login
        </a>
    </div>

    <!-- SEARCH -->
    <form action="gallery.php" method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search art...">
    </form>

</div>