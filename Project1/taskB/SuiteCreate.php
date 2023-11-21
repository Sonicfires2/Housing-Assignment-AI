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
          <form id="create-suite-entry-form">
            
            <label for="suiteType">Suite Type</label>
            <input id="suiteType" type="text" name="suiteType" required>

            <label for="suiteDescription">Suite Description</label>
            <input id="suiteDescription" type="text" name="suiteDescription" required>
    
            <input type="submit" class="button" name="submit" value="Submit">
          </form>
=        </div>
      </div>
    </div>
    <script>
        document.getElementById('create-suite-entry-form').addEventListener('submit', function(e) {
            e.preventDefault(); 

            var formData = new FormData(this); 
            fetch('suite.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) 
            .then(text => {
                alert(text); 
                this.reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred');
            });
        });
    </script>
</body>
</html>
