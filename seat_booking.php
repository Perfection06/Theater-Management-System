<?php
if (isset($_GET["id"])) {

    $mid = $_GET["id"];
    $bdate = $_GET["date"];
    $btime = $_GET["time"];


    // PHP code to fetch and display movies from database
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

    $sql = "SELECT * FROM `movies` WHERE `id` = '" . $mid . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $movieName = $row["movieName"];
        $movieImage = $row["movieImage"];
        $movieDescription = $row["movieDescription"];
        $movieLanguages = $row["movieLanguage"];
        $showingDate = $row["showingDate"];
        $endingDate = $row["endingDate"];
        $showingTime1 = $row["showingTime1"];
        $showingTime2 = $row["showingTime2"];
        $showingTime3 = $row["showingTime3"];
        $dimension = $row["dimension"];
        $genre = $row["genre"];
        $rating = $row["rating"];
        $trailerLink = $row["trailerLink"];
        $status = $row["status"];
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking - Savoy Cinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom animations */
        @keyframes neonGlow {
            0%, 100% { box-shadow: 0 0 5px rgba(147, 51, 234, 0.5), 0 0 20px rgba(147, 51, 234, 0.3); }
            50% { box-shadow: 0 0 10px rgba(147, 51, 234, 0.8), 0 0 30px rgba(147, 51, 234, 0.5); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleUp {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .animate-neon-glow { animation: neonGlow 1.5s infinite; }
        .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
        .animate-scale-up { animation: scaleUp 0.5s ease-out forwards; }
        /* Glass effect */
        .glass-effect {
            background: rgba(31, 41, 55, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        /* Glow effect */
        .glow:hover { box-shadow: 0 0 20px rgba(147, 51, 234, 0.8); }
        /* Input focus glow */
        input:focus { box-shadow: 0 0 10px rgba(147, 51, 234, 0.7); }
        /* Custom seat styles */
        .seat {
            background-color: #fffdfd;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .seat:hover:not(.booked) {
            background-color: #bd58e6;
            transform: scale(1.1);
        }
        .seat.booked {
            background-color: #600086;
            color: white;
            cursor: not-allowed;
        }
        .seat.selected {
            background-color: #9333ea;
            color: white;
        }
        .seat-checkbox { display: none; }
        .seat-checkbox:checked + .seat {
            background-color: #9333ea;
            color: white;
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'I_navbar.php';
    ?>

    <!-- Main Seat Booking Section -->
    <section class="max-w-7xl mx-auto px-6 pt-24 pb-12">
        <div class="glass-effect rounded-2xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.1s">
            <h1 class="text-4xl font-bold text-purple-300 mb-8 text-center border-b-2 border-purple-600 pb-2 animate-fade-in" style="animation-delay: 0.2s">Book Your Seat</h1>

            <!-- Screen -->
            <div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden rounded-xl mb-8 animate-scale-up" style="animation-delay: 0.3s">
                <div class="absolute inset-0 bg-cover bg-center filter blur-lg" style="background-image: url('<?php echo $movieImage; ?>'); z-index: 1;"></div>
                <img src="<?php echo $movieImage; ?>" alt="<?php echo $movieName; ?>" class="h-[90%] rounded-xl z-10 transition duration-300 transform hover:scale-105 glow">
            </div>

            <!-- Seat Status Legend -->
            <div class="flex justify-center gap-8 mb-8 animate-fade-in" style="animation-delay: 0.4s">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-white rounded"></div>
                    <p class="text-gray-300 font-semibold">Available</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-purple-900 rounded"></div>
                    <p class="text-gray-300 font-semibold">Booked</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-gray-600 rounded"></div>
                    <p class="text-gray-300 font-semibold">Unavailable</p>
                </div>
            </div>

            <!-- Seat Selection -->
            <div class="flex justify-center gap-12 mb-12 animate-fade-in" style="animation-delay: 0.5s">
                <!-- Left Seats -->
                <div class="flex flex-col items-center">
                    <h3 class="text-xl text-purple-300 mb-4">Left Section</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <?php
                        $bookedSeats_query = "SELECT `booking_seat`.`seat_id` FROM `booking` INNER JOIN `booking_seat` ON `booking`.`id`=`booking_seat`.`booking_id` WHERE `booking`.`date`='" . $bdate . "' AND `booking`.`time`='" . $btime . "'";
                        $bookedSeats_rs = $conn->query($bookedSeats_query);
                        $bookedSeats = [];
                        while ($row = $bookedSeats_rs->fetch_assoc()) {
                            $bookedSeats[] = $row['seat_id'];
                        }
                        $leftSeats_query = "SELECT * FROM `seat` WHERE `seat_type_id`='1'";
                        $leftSeats_rs = $conn->query($leftSeats_query);
                        $leftSeats_num = $leftSeats_rs->num_rows;
                        $delay = 0.6;
                        for ($i = 0; $i < $leftSeats_num; $i++) {
                            $leftSeats_data = $leftSeats_rs->fetch_assoc();
                            $seat_id = $leftSeats_data["id"];
                            $isBooked = in_array($seat_id, $bookedSeats);
                            echo '<div class="animate-scale-up" style="animation-delay: ' . $delay . 's">';
                            if ($isBooked) {
                                echo '<div class="seat booked w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg" style="background-color: #600086;">' . $leftSeats_data["name"] . '</div>';
                            } else {
                                echo '<input class="seat-checkbox" type="checkbox" id="' . $leftSeats_data["id"] . '" name="seats" value="' . $leftSeats_data["id"] . '" onchange="updateTotalPrice(this)">';
                                echo '<label class="seat w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg cursor-pointer" for="' . $leftSeats_data["id"] . '">' . $leftSeats_data["name"] . '</label>';
                            }
                            echo '</div>';
                            $delay += 0.05;
                        }
                        ?>
                    </div>
                </div>

                <!-- Middle Seats -->
                <div class="flex flex-col items-center">
                    <h3 class="text-xl text-purple-300 mb-4">Middle Section</h3>
                    <div class="grid grid-cols-5 gap-2">
                        <?php
                        $middleSeats_query = "SELECT * FROM `seat` WHERE `seat_type_id`='2'";
                        $middleSeats_rs = $conn->query($middleSeats_query);
                        $middleSeats_num = $middleSeats_rs->num_rows;
                        $delay = 0.8;
                        for ($i = 0; $i < $middleSeats_num; $i++) {
                            $middleSeats_data = $middleSeats_rs->fetch_assoc();
                            $seat_id = $middleSeats_data["id"];
                            $isBooked = in_array($seat_id, $bookedSeats);
                            echo '<div class="animate-scale-up" style="animation-delay: ' . $delay . 's">';
                            if ($isBooked) {
                                echo '<div class="seat booked w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg" style="background-color: #600086;">' . $middleSeats_data["name"] . '</div>';
                            } else {
                                echo '<input class="seat-checkbox" type="checkbox" id="' . $middleSeats_data["id"] . '" name="seats" value="' . $middleSeats_data["id"] . '" onchange="updateTotalPrice(this)">';
                                echo '<label class="seat w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg cursor-pointer" for="' . $middleSeats_data["id"] . '">' . $middleSeats_data["name"] . '</label>';
                            }
                            echo '</div>';
                            $delay += 0.05;
                        }
                        ?>
                    </div>
                </div>

                <!-- Right Seats -->
                <div class="flex flex-col items-center">
                    <h3 class="text-xl text-purple-300 mb-4">Right Section</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <?php
                        $rightSeats_query = "SELECT * FROM `seat` WHERE `seat_type_id`='3'";
                        $rightSeats_rs = $conn->query($rightSeats_query);
                        $rightSeats_num = $rightSeats_rs->num_rows;
                        $delay = 1.0;
                        for ($i = 0; $i < $rightSeats_num; $i++) {
                            $rightSeats_data = $rightSeats_rs->fetch_assoc();
                            $seat_id = $rightSeats_data["id"];
                            $isBooked = in_array($seat_id, $bookedSeats);
                            echo '<div class="animate-scale-up" style="animation-delay: ' . $delay . 's">';
                            if ($isBooked) {
                                echo '<div class="seat booked w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg" style="background-color: #600086;">' . $rightSeats_data["name"] . '</div>';
                            } else {
                                echo '<input class="seat-checkbox" type="checkbox" id="' . $rightSeats_data["id"] . '" name="seats" value="' . $rightSeats_data["id"] . '" onchange="updateTotalPrice(this)">';
                                echo '<label class="seat w-12 h-12 flex items-center justify-center text-sm font-semibold rounded-lg cursor-pointer" for="' . $rightSeats_data["id"] . '">' . $rightSeats_data["name"] . '</label>';
                            }
                            echo '</div>';
                            $delay += 0.05;
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Parking and Total Price -->
            <div class="flex flex-col items-center gap-6 mb-8 animate-fade-in" style="animation-delay: 1.2s">
                <div class="flex flex-col items-center">
                    <label for="parkinSlot" class="text-lg text-purple-300 mb-2">Parking Slots</label>
                    <input class="parkingSlotInput w-64 py-2 px-4 rounded-full bg-gray-800/50 border border-gray-600/50 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300" id="parkinSlot" type="number" value="0" placeholder="Enter Parking Slots" min="0">
                </div>
                <div class="text-2xl text-gray-300">
                    Total Price: Rs. <span class="font-bold text-purple-300" id="totalPrice">00</span> /=
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center animate-fade-in" style="animation-delay: 1.3s">
                <label id="btime" style="display: none;"><?php echo $btime; ?></label>
                <button class="bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 glow animate-neon-glow" onclick="submitBooking(<?php echo $mid; ?>, '<?php echo $bdate; ?>')">Submit Booking</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-black to-purple-950 py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="animate-fade-in" style="animation-delay: 0.1s">
                <h3 class="text-2xl font-bold text-purple-400 mb-4">Savoy Cinema</h3>
                <p class="text-gray-300">Experience the magic of movies with cutting-edge technology and unparalleled comfort.</p>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-2xl font-bold text-purple-400 mb-4">Connect With Us</h3>
                <div class="flex gap-6 justify-center">
                    <a href="https://www.instagram.com/savoy_cinemas/" target="_blank" class="transition duration-300 transform hover:scale-125 glow">
                        <i data-lucide="instagram" class="w-8 h-8 text-purple-400"></i>
                    </a>
                    <a href="https://www.facebook.com/SavoyCinemas/" target="_blank" class="transition duration-300 transform hover:scale-125 glow">
                        <i data-lucide="facebook" class="w-8 h-8 text-purple-400"></i>
                    </a>
                </div>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.3s">
                <h3 class="text-2xl font-bold text-purple-400 mb-4">Links</h3>
                <div class="flex flex-col gap-2">
                    <a href="./privacyPolicy.html" class="text-gray-300 hover:text-purple-400 font-semibold transition duration-300 transform hover:translate-x-2">Privacy Policy</a>
                    <a href="./TermsandConditions.html" class="text-gray-300 hover:text-purple-400 font-semibold transition duration-300 transform hover:translate-x-2">Terms and Conditions</a>
                    <a href="./TermsofUse.html" class="text-gray-300 hover:text-purple-400 font-semibold transition duration-300 transform hover:translate-x-2">Terms of Use</a>
                    <a href="./feedback.php" class="text-gray-300 hover:text-purple-400 font-semibold transition duration-300 transform hover:translate-x-2">Feedback</a>
                    <a href="./contactus.html" class="text-gray-300 hover:text-purple-400 font-semibold transition duration-300 transform hover:translate-x-2">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-400 mt-8 text-sm animate-fade-in" style="animation-delay: 0.4s">
            &copy; 2025 Savoy Cinema. All rights reserved.
        </div>
    </footer>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Search functionality
        function searchMovies() {
            const query = document.getElementById('searchInput').value;
            if (query.length < 3) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_movies.php?q=' + encodeURIComponent(query), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const movies = JSON.parse(xhr.responseText);
                    let resultsHTML = '';
                    for (const movie of movies) {
                        resultsHTML += `<div class="flex items-center p-3 cursor-pointer hover:bg-gray-700/50 rounded-lg transition duration-300" onclick="goToMovie(${movie.id})">
                            <img src="${movie.movieImage}" alt="${movie.movieName}" class="w-12 h-18 object-cover rounded-md mr-3">
                            <span class="text-white font-semibold">${movie.movieName}</span>
                        </div>`;
                    }
                    document.getElementById('searchResults').innerHTML = resultsHTML;
                }
            };
            xhr.send();
        }

        function goToMovie(movieId) {
            window.location.href = 'booking.php?id=' + movieId;
        }

        // Seat price and total price calculation
        const seatPrice = 500;

        function updateTotalPrice(checkbox) {
            let totalPriceElement = document.getElementById('totalPrice');
            let totalPrice = parseInt(totalPriceElement.innerText) || 0;

            if (checkbox.checked) {
                totalPrice += seatPrice;
            } else {
                totalPrice -= seatPrice;
            }

            totalPriceElement.innerText = totalPrice;
        }

        // Booking submission
        function submitBooking(mid, date) {
            let btime = document.getElementById('btime').innerHTML;
            let parkingSlot = document.getElementById('parkinSlot').value;
            const checkboxes = document.querySelectorAll('input[name="seats"]:checked');
            const selectedValues = [];

            checkboxes.forEach((checkbox) => {
                selectedValues.push(checkbox.value);
            });

            if (selectedValues.length === 0) {
                alert('Please select at least one seat.');
            } else if (parkingSlot < 0) {
                alert('Please enter a valid number of parking slots.');
            } else {
                const formData = new FormData();
                formData.append('mid', mid);
                formData.append('date', date);
                formData.append('btime', btime);
                formData.append('parkingSlot', parkingSlot);
                selectedValues.forEach(value => formData.append('seats[]', value));

                fetch('process_booking.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
<?php
}
?>