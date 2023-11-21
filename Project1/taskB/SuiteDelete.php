<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Suite Entry</title>
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

        $suiteTypes = [];
        $sql = "SELECT SuiteType FROM Suites";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $suiteTypes[] = $row['SuiteType'];
            }
        }

        include 'navbar.php';
    ?>
    <div class="container-delete-suite-shadow"></div>
    <div class="container-delete-suite">
      <div class="wrap">
        <div class="headingsContainer">
          <span class="headings">Delete Suite Entry</span>
        </div>
        <div id="delete-suite-entry-container">
          <form id="delete-suite-entry-form">
            
            <label for="suiteTypeToDelete">Suite Type to Delete</label>
            <select id="suiteTypeToDelete" name="suiteTypeToDelete" required>
                <?php foreach ($suiteTypes as $type): ?>
                    <option value="<?php echo htmlspecialchars($type); ?>">
                        <?php echo htmlspecialchars($type); ?>
                    </option>
                <?php endforeach; ?>
            </select>
    
            <input type="submit" class="button" name="submit" value="Delete">
          </form>
        </div>
      </div>
    </div>
    <script src="form.js"></script>
    <script>
        document.getElementById('delete-suite-entry-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            fetch('suite.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) 
            .then(text => {
                alert(text);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred'); 
                document.getElementById('responseMessage').innerText = 'An error occurred';
            });
        });
    </script>
</body>
</html>
