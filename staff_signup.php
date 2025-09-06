<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
// Prepare an SQL statement for inserting a new staff member
    $stmt = $conn->prepare("INSERT INTO staff (name, phone_number, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone_number, $password);
// Execute the statement and check for success
    if ($stmt->execute()) {
// If successful, alert the user and redirect to the login page
        echo "<script>alert('Staff registration successful!'); window.location.href = 'login.html';</script>";
    } else {
// If an error occurs, display the error message
        echo "Error: " . $stmt->error;
    }
    // Close the statement
    $stmt->close();
}

$conn->close();
?>
