<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";
// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get the current date
$currentDate = date("Y-m-d");
// Query to select upcoming movies that have a release date on or before the current date
$sql = "SELECT * FROM upcoming_movies WHERE releaseDate <= '$currentDate'";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {

    // Loop through each movie in the results
    while ($row = $result->fetch_assoc()) {

// Prepare SQL query to insert the movie into the now_showing table
        $sql_insert = "INSERT INTO now_showing (name, image, description, showing_date, ending_date, showing_time1, showing_time2, showing_time3, dimension, genre, rating, trailer_link, release_date)
                       VALUES ('".$row['name']."', '".$row['image']."', '".$row['description']."', '".$row['showing_date']."', '".$row['ending_date']."', '".$row['showing_time1']."', '".$row['showing_time2']."', '".$row['showing_time3']."', '".$row['dimension']."', '".$row['genre']."', '".$row['rating']."', '".$row['trailer_link']."', '".$row['release_date']."')";
// Execute the insert query and check if it was successful
        if ($conn->query($sql_insert) === TRUE) {

// If insert was successful, prepare SQL query to delete the movie from the upcoming_movies table
            $sql_delete = "DELETE FROM upcoming_movies WHERE id=".$row['id'];
            $conn->query($sql_delete);
        }
    }
}

$conn->close();
?>
