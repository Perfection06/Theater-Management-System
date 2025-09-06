<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the URL parameter
$query = $_GET['q'];
// SQL query to search for movies by name
$sql = "SELECT id, movieName, movieImage FROM movies WHERE movieName LIKE '%$query%' LIMIT 10";
$result = $conn->query($sql);
// Initialize an array to store the movie results
$movies = [];
// Check if the query returned any results
if ($result->num_rows > 0) {
// Fetch each row as an associative array and add it to the movies array
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}
// Output the movies array as a JSON-encoded string
echo json_encode($movies);

$conn->close();
?>
