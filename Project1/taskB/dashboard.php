<?php
session_start();

if (!isset($_SESSION['is_logged_in'])) {
    header("Location: index.php");
    exit();
}

// Determine if the user is an admin
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css"> 
</head>
<body>
    <?php 
        include 'navbar.php'; 
    ?>
    <!-- ... [rest of the page content] -->
    <div class="content">
        <!-- Your page content goes here -->
        <h1>Welcome to the Dashboard</h1>
        <p>Here you can manage your housing entries and view data.</p>
    </div>
</body>
</html>
