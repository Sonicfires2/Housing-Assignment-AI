<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Suite Entry</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
  <?php
    session_start();
    $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || !$isAdmin) {
        // If not logged in or not an admin, redirect to the login page or another appropriate page
        header("Location: index.php");
        exit();
    }
    include 'navbar.php';
  ?>
    <div class="container-create-suit-shadow"></div>
    <div class="container-create-suite">
      <div class="wrap">
        <div class="headingsContainer">
          <span class="headings">Create Suite Entry</span>
        </div>
        <div id="create-suite-entry-container">
          <form id="create-suite-entry-form" method="post" action="suite.php"">
            
            <label for="suiteType">Suite Type</label>
            <input id="suiteType" type="text" name="suiteType" required>

            <label for="suiteDescription">Suite Description</label>
            <input id="suiteDescription" type="text" name="suiteDescription" required>
    
            <input type="submit" class="button" name="submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
    <script src="form.js"></script>
</body>
</html>
