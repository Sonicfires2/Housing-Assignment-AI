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

      $server = "localhost";
    $user = "root";
    $password = "Ssl12345#";
    $db = "AnimeInterestFloor";
    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $studentIDs = [];
    $query = "SELECT ID FROM Students";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $studentIDs[] = $row['ID'];
        }
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
          <form id="create-housing-entry-form">
            <label for="studentID">Select Student ID to Delete*</label>
            <select id="studentID" name="studentID">
                <?php foreach ($studentIDs as $id): ?>
                    <option value="<?php echo htmlspecialchars($id); ?>">
                        <?php echo htmlspecialchars($id); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" class="button" name="submit" value="Submit">
          </form>
          <button id="signOutButton" onclick="signOut(event)">Sign Out</button>
        </div>
      </div>
    </div>
    <script src="form.js"></script>
    <script>
        document.getElementById('create-housing-entry-form').addEventListener('submit', function(e) {
            e.preventDefault(); 

            var formData = new FormData(this); 
            fetch('delete.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) 
            .then(text => {
                alert(text); 
                // this.reset(); 
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred'); 
            });
        });
    </script>
</body>
</html>