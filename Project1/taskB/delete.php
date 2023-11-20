<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: index.php');
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $schoolID = $conn->real_escape_string($_POST['username']);

    $sql = "DELETE FROM Students WHERE ID = '$schoolID'";

    if ($conn->query($sql) === TRUE) {
        echo "Housing entry deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
