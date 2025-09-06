<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "savoy_cinema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for booking cards */
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
        /* Glass effect for navbar */
        .glass-effect {
            background: rgba(31, 41, 55, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'navbar.php';
    ?>

    <!-- Main Content -->
    <main class="container mx-auto px-6 pt-24 pb-12">
        <header class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-purple-400 animate-pulse">Booking Details</h1>
            <p class="text-gray-400 mt-3 text-lg">View and manage all bookings in the system</p>
        </header>

        <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "savoy_cinema";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT `booking`.`id`, `booking`.`booking_date`, `users`.`name`, `users`.`phone_number`, `movies`.`movieName`, `booking`.`date`, `booking`.`time`, `movies`.`dimension`, `booking`.`parking_slots` FROM `booking` INNER JOIN `users` ON `booking`.`users_id` = `users`.`id` INNER JOIN `movies` ON `booking`.`moive_id` = `movies`.`id`";
            $booking_rs = $conn->query($sql);

            if ($booking_rs->num_rows > 0) {
                $delay = 0;
                while ($booking_data = $booking_rs->fetch_assoc()) {
                    $seatcount_rs = $conn->query("SELECT COUNT(id) AS `seat_num` FROM `booking_seat` WHERE `booking_id` = '" . $booking_data["id"] . "'");
                    $seatcount_data = $seatcount_rs->fetch_assoc();
                    $totalPrice = $seatcount_data["seat_num"] * 500;
            ?>
                <div class="bg-gray-900 rounded-2xl shadow-2xl p-6 transform transition-all duration-300 hover:shadow-purple-500/50 hover:-translate-y-2 animate-slide-up" style="animation-delay: <?php echo $delay; ?>s">
                    <div class="bg-purple-900 text-white text-center p-4 rounded-t-xl">
                        <h3 class="text-xl font-bold"><?php echo $booking_data["movieName"]; ?></h3>
                        <p class="text-sm text-gray-300"><strong>Date of Booking:</strong> <?php echo $booking_data["booking_date"]; ?></p>
                    </div>
                    <div class="p-4 space-y-3">
                        <p><strong class="text-purple-300">Customer Name:</strong> <?php echo $booking_data["name"]; ?></p>
                        <p><strong class="text-purple-300">Phone Number:</strong> <?php echo $booking_data["phone_number"]; ?></p>
                        <p><strong class="text-purple-300">Movie Date:</strong> <?php echo $booking_data["date"]; ?></p>
                        <p><strong class="text-purple-300">Movie Time:</strong> <?php echo $booking_data["time"]; ?></p>
                        <p><strong class="text-purple-300">Dimension:</strong> <?php echo $booking_data["dimension"]; ?></p>
                        <p><strong class="text-purple-300">Seats:</strong> <?php echo $seatcount_data["seat_num"]; ?></p>
                        <p><strong class="text-purple-300">Parking Spaces:</strong> <?php echo $booking_data["parking_slots"]; ?></p>
                        <p><strong class="text-purple-300">Total Price:</strong> Rs<?php echo $totalPrice; ?></p>
                    </div>
                    <div class="p-4 text-center">
                        <form method="POST" action="delete_booking.php">
                            <input type="hidden" name="booking_id" value="<?php echo $booking_data['id']; ?>">
                            <button type="submit" class="bg-purple-900 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105">Delete</button>
                        </form>
                    </div>
                </div>
            <?php
                    $delay += 0.1; // Incremental delay for staggered animation
                }
            } else {
                echo "<p class='text-center text-gray-400 col-span-full'>No bookings found</p>";
            }

            $conn->close();
            ?>
        </section>
    </main>
</body>
</html>