<?php
$server = "localhost";
$user = "root";
$password = "Ssl12345#"; 
$db = "AnimeInterestFloor"; 

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $studentID = $conn->real_escape_string($_GET['id']);

    // Query to fetch student data
    $dataQuery = "SELECT * FROM Students WHERE ID = '$studentID'";
    $dataResult = $conn->query($dataQuery);
    if ($dataResult && $dataResult->num_rows > 0) {
        $data = $dataResult->fetch_assoc();
        echo json_encode($data); // Return data in JSON format
    } else {
        echo json_encode(["error" => "No data found"]);
    }
}
?>