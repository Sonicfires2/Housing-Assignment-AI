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

        $query = "SELECT * FROM Students WHERE ID = '$ID' AND Password = '$Password'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['is_admin'] = $user['isAdmin'];

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Access Denied: Wrong Credentials.";
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
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $conn->error;
            header("Location: index.php"); 
            exit();
        }
    }
}

$conn->close();
?>
