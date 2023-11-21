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
      session_start();
      $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
      if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || !$isAdmin) {
          // If not logged in or not an admin, redirect to the login page or another appropriate page
          header("Location: index.php");
          exit();
      }
      include 'navbar.php';
    ?>
    <div class="container-shadow"></div>
    <div class="container">
      <div class="wrap">
        <div class="headingsContainer">
          <span class="headings">Delete Housing Entry</span>
        </div>
        <div id="create-housing-entry-container">
          <form id="create-housing-entry-form" method="post" action="delete.php" onsubmit="deleteHousingEntry(event);">
            <label for="username">School ID To Delete*</label>
            <input type="text" name="username" required/>
            <input type="submit" class="button" name="submit" value="Submit">
          </form>
          <button id="signOutButton" onclick="signOut(event)">Sign Out</button>
        </div>
      </div>
    </div>
    <script src="form.js"></script>
</body>
</html>