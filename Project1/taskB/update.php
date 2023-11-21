<?php
session_start();
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || !$isAdmin) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $conn->real_escape_string($_POST['studentID']);
    $year = $conn->real_escape_string($_POST['year']);
    $attendance = (int) $_POST['attendance'];
    $strikes = (int) $_POST['strikes'];
    $isOnEboard = isset($_POST['isOnEboard']) ? 1 : 0;

    // Update query to update student information
    $updateQuery = "UPDATE Students SET 
                    Seniority = '$year', 
                    NumberOfAttendance = $attendance, 
                    NumberOfStrikes = $strikes, 
                    isInEboard = $isOnEboard 
                    WHERE ID = '$studentID'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
