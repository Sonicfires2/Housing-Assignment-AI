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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (isset($_POST['suiteType']) && isset($_POST['suiteDescription'])) {
        // Handle suite creation
        $suiteType = $conn->real_escape_string($_POST['suiteType']);
        $suiteDescription = $conn->real_escape_string($_POST['suiteDescription']);
        $sql = "INSERT INTO Suites (SuiteType, Description) VALUES ('$suiteType', '$suiteDescription')";
    } elseif (isset($_POST['suiteTypeToDelete'])) {
        // Handle suite deletion
        $suiteType = $conn->real_escape_string($_POST['suiteTypeToDelete']);
        $sql = "DELETE FROM Suites WHERE SuiteType = '$suiteType'";
    }

    if ($conn->query($sql) === TRUE) {
        echo (isset($_POST['suiteType']) ? "Suite entry created successfully" : "Suite entry deleted successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
