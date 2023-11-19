<?php

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
        $schoolID = $_POST['schoolID'];
        $password = $_POST['password'];

        // Perform login validation, SQL queries, etc.

        echo "<h2>Login Form Submitted</h2>";
        echo "School ID: " . $schoolID . "<br>";
        echo "Password: " . $password . "<br>";
        // Continue with your login logic

    } else if ($_POST["submit"] === "Create Account") {
        $schoolID = $_POST['schoolID'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $typeOfUser = isset($_POST['typeOfUser']) ? 'Student' : 'Non-Student';

        // Perform account creation, SQL queries, etc.

        echo "<h2>Signup Form Submitted</h2>";
        echo "School ID: " . $schoolID . "<br>";
        echo "Full Name: " . $username . "<br>";
        echo "Password: " . $password . "<br>";
        echo "User Type: " . $typeOfUser . "<br>";
        // Continue with your signup logic
    }
}

$conn->close();

?>
