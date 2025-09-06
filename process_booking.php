<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Retrieve data from the form submission
    $uid = $_SESSION["user_id"];
    $mid = $_POST['mid'];
    $date = $_POST['date'];
    $btime = $_POST['btime'];
    $parkingSlot = $_POST['parkingSlot'];
    $seats = isset($_POST['seats']) ? $_POST['seats'] : [];
    $booking_date = date('Y-m-d H:i:s');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "savoy_cinema";
// Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Retrieve the movie details from the database
    $sql = "SELECT * FROM `movies` WHERE `id` = '" . $mid . "'";
    $result = $conn->query($sql);
// Prepare the SQL statement to insert a new booking
    $stmt = $conn->prepare("INSERT INTO `booking` (`moive_id`, `date`, `time`,`parking_slots`,`users_id`,`booking_date`) VALUES (?, ?, ?,?,?,?)");
    $stmt->bind_param("ssssss", $mid, $date, $btime, $parkingSlot, $uid,$booking_date);
// Execute the booking insertion
    if ($stmt->execute()) {
// Get the booking ID of the newly inserted booking
        $booking_id = $stmt->insert_id;
        $stmt->close();
// Prepare the SQL statement to insert seats for the booking
        $stmt = $conn->prepare("INSERT INTO `booking_seat` (`booking_id`, `seat_id`) VALUES (?, ?)");
        foreach ($seats as $seat_id) {
            $stmt->bind_param("ii", $booking_id, $seat_id);
            $stmt->execute();
        }
        $stmt->close();
// Display a success message
        echo "Booking successful!";
    } else {
// Display an error message if the booking insertion failed
        echo "Error: " . $stmt->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
