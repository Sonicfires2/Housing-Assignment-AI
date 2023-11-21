<?php
session_start();
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || !$isAdmin) {
    echo "Access Denied";
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
    // Determine whether the request is for creation or deletion
    if (!empty($_POST['suiteType']) && !empty($_POST['suiteDescription'])) {
        // Suite creation
        $suiteType = $conn->real_escape_string($_POST['suiteType']);
        $suiteDescription = $conn->real_escape_string($_POST['suiteDescription']);

        $sql = "INSERT INTO Suites (SuiteType, Description) VALUES ('$suiteType', '$suiteDescription')";

        if ($conn->query($sql) === TRUE) {
            echo "Suite entry created successfully";
        } else {
            echo "Error creating suite: " . $conn->error;
        }
    } elseif (!empty($_POST['suiteTypeToDelete'])) {
        // Suite deletion
        $suiteType = $conn->real_escape_string($_POST['suiteTypeToDelete']);
        
        $sql = "DELETE FROM Suites WHERE SuiteType = '$suiteType'";

        if ($conn->query($sql) === TRUE) {
            echo "Suite entry deleted successfully";
        } else {
            echo "Error deleting suite: " . $conn->error;
        }
    } else {
        echo "Invalid request";
    }
}

$conn->close();
?>
