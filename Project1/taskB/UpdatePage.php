<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Housing Information</title>
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
        $idQuery = "SELECT ID FROM Students";
        $idResult = $conn->query($idQuery);
        if ($idResult && $idResult->num_rows > 0) {
            while ($row = $idResult->fetch_assoc()) {
                $studentIDs[] = $row['ID'];
            }
        }

        include 'navbar.php';
    ?>
    <div class="container-shadow"></div>
    <div class="container">
        <div class="wrap">
            <div class="headingsContainer">
                <span class="headings">Update Housing Entry</span>
            </div>
            <div id="update-housing-entry-container">
                <form id="update-housing-entry-form">
                    <label for="studentID">Select Student ID</label>
                    <select id="studentID" name="studentID" onchange="loadStudentData()">
                        <option value="">Select a Student ID</option>
                        <?php foreach ($studentIDs as $id): ?>
                            <option value="<?php echo htmlspecialchars($id); ?>">
                                <?php echo htmlspecialchars($id); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="year">Update Year</label>
                    <select id="year" name="year" required>
                        <option value="Freshman">Freshman</option>
                        <option value="Sophomore">Sophomore</option>
                        <option value="Junior">Junior</option>
                        <option value="Senior">Senior</option>
                    </select>
                    
                    <label for="attendance">Update Number of Attendance</label>
                    <input id="attendance" type="number" name="attendance" min="0" required>
                    
                    <label for="strikes">Update Number of Strikes</label>
                    <input id="strikes" type="number" name="strikes" min="0" max="3" required>

                    <label for="isOnEboard">Is Eboard Now?</label>
                    <input id="isOnEboard" type="checkbox" name="isOnEboard">

                    <input type="submit" class="button" name="update" value="Update">
                </form>
                <!-- <button id="createEntryButton" onclick="goToCreate(event)">Go To Create</button> -->
                <button id="signOutButton" onclick="signOut(event)">Sign Out</button>
            </div>
        </div>
    </div>
    <script src="form.js"></script>
    <script>
        document.getElementById('update-housing-entry-form').addEventListener('submit', function(e) {
            e.preventDefault(); 

            var formData = new FormData(this);
            fetch('update.php', {
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

        function loadStudentData() {
            var studentID = document.getElementById('studentID').value;

            if (!studentID) {
                document.getElementById('year').value = '';
                document.getElementById('attendance').value = '';
                document.getElementById('strikes').value = '';
                document.getElementById('isOnEboard').checked = false;
                return; 
            }

            fetch('fetch.php?id=' + studentID)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('year').value = data.Seniority || '';
                    document.getElementById('attendance').value = data.NumberOfAttendance || 0;
                    document.getElementById('strikes').value = data.NumberOfStrikes || 0;
                    document.getElementById('isOnEboard').checked = data.isInEboard === '1';
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
