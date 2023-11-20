<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['is_logged_in'])) {
            header("Location: index.php");
            exit();
        }
        include 'navbar.php';
    ?>
    <table class="containerOfAllData">
        <thead>
            <tr>
                <th>ID</th>
                <th>Password</th>
                <th>Is Admin</th>
                <th>Name</th>
                <th>Class</th>
                <th>Is Eboard</th>
                <th>Suite Pref</th>
                <th>Rooms Pref</th>
                <th>Room Type</th>
                <th>Points</th>
                <th>No. of Strikes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $server = "localhost";
            $user = "root";
            $password = "Ssl12345#"; 
            $db = "AnimeInterestFloor"; 

            $conn = new mysqli($server, $user, $password, $db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $studentID = $_SESSION['user_id']; // Get the logged-in user's ID from the session
            $sql = "SELECT * FROM Students WHERE ID = '$studentID'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                // Output data of the logged-in student
                $row = $result->fetch_assoc();
                echo "<tr>
                        <td>".$row["ID"]."</td>
                        <td>".$row["Password"]."</td>
                        <td>".($row["isAdmin"] ? "True" : "False")."</td>
                        <td>".$row["Name"]."</td>
                        <td>".$row["Seniority"]."</td>
                        <td>".($row["isInEboard"] ? "True" : "False")."</td>
                        <td>".$row["SuitePreference"]."</td>
                        <td>".$row["RoomSizePreference"]."</td>
                        <td>".$row["RoomType"]."</td>
                        <td>".$row["NumberOfAttendance"]."</td>
                        <td>".$row["NumberOfStrikes"]."</td>
                      </tr>";
            } else {
                echo "<tr><td colspan='11'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
