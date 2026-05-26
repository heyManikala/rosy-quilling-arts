<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

$query = "DELETE FROM gallery WHERE id=$id";
mysqli_query($conn, $query);

header("Location: manage_artworks.php");
exit();
?>