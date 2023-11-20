<?php
session_start();
$server = "localhost";
$user = "root";
$password = "Ssl12345#"; 
$db = "AnimeInterestFloor"; 

$conn = new mysqli($server, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submit"] === "Sign in") {
        $ID = $conn->real_escape_string($_POST['schoolID']);
        $Password = $conn->real_escape_string($_POST['password']);

        // Query to check the existence of user
        $query = "SELECT * FROM Students WHERE ID = '$ID' AND Password = '$Password'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            // echo "<h2>Login Successful</h2>";
            header("Location: Create.html");
            exit();
        } else {
            // echo "<h2>Login Failed</h2>";
            header("Location: index.php");
            exit();
        }

    } else if ($_POST["submit"] === "Create Account") {
        $ID = $conn->real_escape_string($_POST['schoolID']);
        $Name = $conn->real_escape_string($_POST['username']);
        $Password = $conn->real_escape_string($_POST['password']); 
        $typeOfUser = isset($_POST['typeOfUser']) ? 1 : 0; 

        // Insert new user data into the database
        $insertQuery = "INSERT INTO Students (ID, Name, Password) VALUES ('$ID', '$Name', '$Password')";
        if ($conn->query($insertQuery) === TRUE) {
            // echo "<h2>Account Created Successfully</h2>";
            header("Location: index.php");
            exit();
        } else {
            // echo "<h2>Error: " . $conn->error . "</h2>";
            header("Location: index.php");
            exit();
        }
    }
}

$conn->close();

?>
