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
      if (!isset($_SESSION['is_logged_in'])) {
        header("Location: index.php");
        exit();
      }
  
    $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

    $server = "localhost";
    $user = "root";
    $password = "Ssl12345#";
    $db = "AnimeInterestFloor";

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $suites = []; // Array to hold suite types

    // Fetch suite types from database
    $suiteQuery = "SELECT SuiteType FROM Suites";
    $suiteResult = $conn->query($suiteQuery);
    if ($suiteResult && $suiteResult->num_rows > 0) {
        while ($row = $suiteResult->fetch_assoc()) {
            $suites[] = $row['SuiteType'];
        }
    }

    include 'navbar.php';
    ?>
    <div class="container-shadow"></div>
    <div class="container">
      <div class="wrap">
        <div class="headingsContainer">
          <span class="headings">Create Housing Entry</span>
        </div>
        <div id="create-housing-entry-container">
          <form id="create-housing-entry-form">
            <label for="year">Year</label>
            <select id="year" name="year" required>
              <option value="Freshman">Freshman</option>
              <option value="Sophomore">Sophomore</option>
              <option value="Junior">Junior</option>
              <option value="Senior">Senior</option>
            </select>
            
            <label for="attendance">Number of Attendance</label>
            <input id="attendance" type="number" name="attendance" min="0" required>
            
            <label for="strikes">Number of Strikes</label>
            <input id="strikes" type="number" name="strikes" min="0" max="3" required>

            <label for="isOnEboard">Is On Eboard?</label>
            <input id="isOnEboard" type="checkbox" name="isOnEboard">

            <label for="roomSize">Room Size Preference</label>
            <select id="roomSize" name="roomSize" required>
              <option value="Double">Double</option>
              <option value="One-and-half">One-and-half</option>
              <option value="Single">Single</option>
            </select>
    
            <label for="suitePreference">Suite Preferences</label>
            <select id="suitePreference" name="suitePreference" required>
                <?php foreach ($suites as $suite): ?>
                    <option value="<?php echo htmlspecialchars($suite); ?>">
                        <?php echo htmlspecialchars($suite); ?>
                    </option>
                <?php endforeach; ?>
            </select>
    
            <label for="roomNumber">Room Number Preference</label>
            <input id="roomNumber" type="text" name="roomNumber" required>

            <input type="submit" class="button" name="submit" value="Submit">
          </form>
          <!-- <button id="signOutButton" onclick="goToUpdate(event)">Go To Update</button> -->
          <button id="signOutButton" onclick="signOut(event)">Sign Out</button>
        </div>
      </div>
    </div>
    <script src="form.js"></script>
    <script>
      document.getElementById('create-housing-entry-form').addEventListener('submit', function(e) {
            e.preventDefault(); 

            if (!validateRoomNumber()) {
                return; 
            }

            var formData = new FormData(this); 

            fetch('create.php', {
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

      function validateRoomNumber() {
          var roomNumberInput = document.getElementById('roomNumber').value;
          var roomNumbers = roomNumberInput.split(',').map(function(num) {
              return parseInt(num.trim(), 10); // Convert to number and trim whitespace
          });

          var validRanges = [[760, 760], [741, 745], [731, 735], [721, 725], [711, 715]];
          
          var isValid = roomNumbers.every(function(roomNumber) {
              return validRanges.some(function(range) {
                  return roomNumber >= range[0] && roomNumber <= range[1];
              });
          });

          if (!isValid) {
              alert('Please enter valid room numbers. Valid ranges are: 760, 741-745, 731-735, 721-725, 711-715.');
              return false; // Prevent form submission
          }
          return true; // Allow form submission
      }
      </script>
</body>
</html>