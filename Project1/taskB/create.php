<?php
session_start();

if (!isset($_SESSION['is_logged_in']) || !isset($_SESSION['user_id'])) {
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userID = $_SESSION['user_id']; // Get the logged-in user's ID
    $year = $conn->real_escape_string($_POST['year']);
    $attendance = (int) $_POST['attendance'];
    $strikes = (int) $_POST['strikes'];
    $isOnEboard = isset($_POST['isOnEboard']) ? 1 : 0;

    // Update query
    $query = "UPDATE Students SET Seniority = '$year', NumberOfAttendance = $attendance, NumberOfStrikes = $strikes, isInEboard = $isOnEboard WHERE ID = '$userID'";

    if ($conn->query($query) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
