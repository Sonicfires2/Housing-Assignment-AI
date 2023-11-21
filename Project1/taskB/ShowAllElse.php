<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Tables Display</title>
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

        $server = "localhost";
        $user = "root";
        $password = "Ssl12345#"; 
        $db = "AnimeInterestFloor"; 

        $conn = new mysqli($server, $user, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Function to query and display table data
        function displayTableData($conn, $tableName, $columns) {
            $sql = "SELECT * FROM $tableName";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($columns as $col) {
                        echo "<td>".$row[$col]."</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='".count($columns)."'>No data found</td></tr>";
            }
        }
    ?>

    <!-- Room Table Display -->
    <div class="containerOfAllDataElse">
        <h2 style="color: white;">Room Table</h2>
        <table>
            <thead>
                <tr>
                    <th>RoomNumber</th>
                    <th>SuiteType</th>
                    <th>Double</th>
                    <th>OnePointFive</th>
                </tr>
            </thead>
            <tbody>
                <?php displayTableData($conn, "Room", ["RoomNumber", "SuiteType", "Doubles", "OnePointFive"]); ?>
            </tbody>
        </table>
    </div>

    <div class="containerOfAllDataElse">
        <h2 style="color: white;">Room Preferences Table</h2>
        <table>
            <thead>
                <tr>
                    <th>StudentID</th>
                    <th>PreferredRoomNumber</th>
                    <th>PreferencesID</th>
                </tr>
            </thead>
            <tbody>
                <!-- RoomPreferences data rows go here -->
                <?php displayTableData($conn, "RoomPreferences", ["PreferencesID", "StudentID", "PreferredRoomNumber"]); ?>
            </tbody>
        </table>
    </div>

    <div class="containerOfAllDataElse">
        <h2 style="color: white;" >Assignments Table</h2>
        <table>
            <thead>
                <tr>
                    <th>AssignmentID</th>
                    <th>StudentID</th>
                    <th>AssignedRoomNumber</th>
                </tr>
            </thead>
            <tbody>
                <!-- Assignments data rows go here -->
                <?php displayTableData($conn, "Assignments", ["AssignmentID", "StudentID", "AssignedRoomNumber"]); ?>
            </tbody>
        </table>
    </div>

    <div class="containerOfAllDataElse">
        <h2 style="color: white;">Suites Table</h2>
        <table>
            <thead>
                <tr>
                    <th>SuiteType</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Suites data rows go here -->
                <?php displayTableData($conn, "Suites", ["SuiteType", "Description"]); ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>