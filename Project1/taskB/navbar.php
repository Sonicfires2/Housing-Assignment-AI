<?php
// Assuming session_start() is called in the parent file
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
?>

<nav>
    <?php if ($isAdmin): ?>
        <!-- Navbar for Admin Users -->
        <a href="UpdatePage.php">Update</a>
        <a href="DeletePage.php">Delete</a>
        <a href="showAllData.php">Show All Data</a>
    <?php else: ?>
        <!-- Navbar for Regular Users -->
        <a href="CreatePage.php">Create</a>
        <a href="individualData.php">Personal Data</a>
    <?php endif; ?>
</nav>
