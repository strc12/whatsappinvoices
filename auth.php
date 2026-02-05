<?php
session_start();

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['Loggedin']) || $_SESSION['Loggedin'] !== true) {
    // You can redirect to the main page (with login modal)
    header("Location: index.php");
    exit;
}
?>