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
        include 'navbar.php';
    ?>
    <div class="container-shadow"></div>
    <div class="container">
        <div class="wrap">
            <div class="headingsContainer">
                <span class="headings">Update Housing Entry</span>
            </div>
            <div id="update-housing-entry-container">
                <form id="update-housing-entry-form" onsubmit="updateHousingEntry(event);">
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

                    <label for="isOnEboard">Are you an Eboard now</label>
                    <input id="isOnEboard" type="checkbox" name="isOnEboard">

                    <input type="submit" class="button" name="update" value="Update">
                </form>
                <button id="createEntryButton" onclick="goToCreate(event)">Go To Create</button>
                <button id="signOutButton" onclick="signOut(event)">Sign Out</button>
            </div>
        </div>
    </div>
    <script src="form.js"></script>
</body>
</html>
