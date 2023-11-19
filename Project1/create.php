<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $attendance = $_POST['attendance'];
    $strikes = $_POST['strikes'];
    $isOnEboard = isset($_POST['isOnEboard']) ? 1 : 0; 

    $server = "localhost";
    $user = "root";
    $password = "Ssl12345#"; 
    $db = "AnimeInterestFloor"; 

    $conn = new mysqli($server, $user, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO HousingEntries (Year, Attendance, Strikes, IsOnEboard) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siib", $year, $attendance, $strikes, $isOnEboard);

    if ($stmt->execute()) {
        echo "New housing entry created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
