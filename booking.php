<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

?>

<?php
if (isset($_GET["id"])) {

    $mid = $_GET["id"];


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
    } else {
        echo "No movies currently showing.";
    }

    // $conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking - Savoy Cinema</title>
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
        /* Custom toggle button styles */
        .toggle-button {
            position: relative;
            padding: 10px 20px;
            border-radius: 8px;
            background: #2d3748;
            color: #e2e8f0;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .toggle-button:hover {
            background: linear-gradient(to right, #9333ea, #6b21a8);
            transform: scale(1.05);
        }
        .toggle-button.active {
            background: linear-gradient(to right, #9333ea, #6b21a8);
            color: white;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(147, 51, 234, 0.6);
        }
        input[type="radio"] { display: none; }
    </style>
    <script>
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

        // Booking date and time selection with toggle effect
        document.addEventListener('DOMContentLoaded', () => {
            const dateButtons = document.querySelectorAll('.date-toggle');
            const timeButtons = document.querySelectorAll('.time-toggle');

            dateButtons.forEach(button => {
                button.addEventListener('click', () => {
                    dateButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    document.getElementById(button.dataset.id).checked = true;
                });
            });

            timeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    timeButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    document.getElementById(button.dataset.id).checked = true;
                });
            });
        });

        function getbookingdate(id) {
            const dateRadio = document.getElementsByName('date');
            const timeRadio = document.getElementsByName('time');
            let selectedDate = null;
            let selectedTime = null;

            for (let date of dateRadio) {
                if (date.checked) {
                    selectedDate = date.value;
                    break;
                }
            }

            for (let time of timeRadio) {
                if (time.checked) {
                    selectedTime = time.value;
                    break;
                }
            }

            if (!selectedDate) {
                alert("Please Select Date");
            } else if (!selectedTime) {
                alert("Please Select Time");
            } else {
                window.location.href = `seat_booking.php?id=${id}&date=${selectedDate}&time=${encodeURIComponent(selectedTime)}`;
            }
        }
    </script>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'I_navbar.php';
    ?>

    <!-- Movie Header Section (Restored from Original) -->
    <section class="relative w-full h-[600px] flex items-center justify-center overflow-hidden animate-fade-in" style="animation-delay: 0.1s">
        <div class="absolute inset-0 bg-cover bg-center filter blur-lg" style="background-image: url('<?php echo $movieImage; ?>'); z-index: 1;"></div>
        <div class="relative z-10 flex items-center justify-center">
            <div class="absolute bottom-6 left-6 bg-black/70 p-6 rounded-xl max-w-lg animate-scale-up" style="animation-delay: 0.2s">
                <h1 class="text-3xl font-bold text-purple-300 mb-4"><?php echo $movieName; ?></h1>
                <a href="<?php echo $trailerLink; ?>" target="_blank" class="inline-block bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105 glow animate-neon-glow">Watch Trailer</a>
            </div>
            <div class="relative z-10">
                <img src="<?php echo $movieImage; ?>" alt="<?php echo $movieName; ?>" class="h-[500px] rounded-2xl shadow-2xl transition duration-300 transform hover:scale-105 glow animate-scale-up" style="animation-delay: 0.3s">
            </div>
        </div>
    </section>

    <!-- Main Booking Section -->
    <section class="max-w-7xl mx-auto px-6 pt-24 pb-12">
        <div class="glass-effect rounded-2xl p-8 shadow-2xl animate-fade-in" style="animation-delay: 0.4s">
            <!-- About Movie -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-purple-300 mb-4 border-b-2 border-purple-600 pb-2 animate-fade-in" style="animation-delay: 0.5s">About the Movie</h2>
                <p class="text-lg text-gray-300 mb-6 leading-relaxed animate-fade-in" style="animation-delay: 0.6s"><?php echo $movieDescription; ?></p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in" style="animation-delay: 0.7s">
                    <p class="text-gray-300"><span class="font-bold text-purple-300">Genre:</span> <?php echo $genre; ?></p>
                    <p class="text-gray-300"><span class="font-bold text-purple-300">Rating:</span> <?php echo $rating; ?></p>
                </div>
            </div>

            <!-- Cast -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-purple-300 mb-6 border-b-2 border-purple-600 pb-2 animate-fade-in" style="animation-delay: 0.8s">Cast</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                    <?php
                    $moiveCast_query = "SELECT * FROM `movie_casts` WHERE `movieId` = '" . $mid . "'";
                    $moiveCast_rs = $conn->query($moiveCast_query);
                    $moiveCast_num = $moiveCast_rs->num_rows;
                    $delay = 0.9;

                    for ($i = 0; $i < $moiveCast_num; $i++) {
                        $moiveCast_data = $moiveCast_rs->fetch_assoc();
                        echo '<div class="flex flex-col items-center animate-scale-up" style="animation-delay: ' . $delay . 's">';
                        echo '<img src="' . $moiveCast_data["castImage"] . '" alt="' . $moiveCast_data["castName"] . '" class="h-24 w-24 rounded-full object-cover border-2 border-purple-600 transition duration-300 transform hover:scale-110 glow">';
                        echo '<span class="text-gray-300 mt-2 text-center">' . $moiveCast_data["castName"] . '</span>';
                        echo '</div>';
                        $delay += 0.1;
                    }
                    ?>
                </div>
            </div>

            <!-- Date Selection -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-purple-300 mb-6 border-b-2 border-purple-600 pb-2 animate-fade-in" style="animation-delay: 1.1s">Select Date</h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <?php
                    $start_date = new DateTime($showingDate);
                    $end_date = new DateTime($endingDate);
                    $interval = DateInterval::createFromDateString('1 day');
                    $period = new DatePeriod($start_date, $interval, $end_date->modify('+1 day'));
                    $delay = 1.2;

                    foreach ($period as $date) {
                        $showing_date_str = $date->format("d");
                        echo '<div class="animate-scale-up" style="animation-delay: ' . $delay . 's">';
                        echo '<input type="radio" name="date" id="date-' . $showing_date_str . '" value="' . $showing_date_str . '">';
                        echo '<label for="date-' . $showing_date_str . '" class="toggle-button date-toggle" data-id="date-' . $showing_date_str . '">' . $showing_date_str . '</label>';
                        echo '</div>';
                        $delay += 0.1;
                    }
                    ?>
                </div>
            </div>

            <!-- Time and Format Selection -->
            <div>
                <h2 class="text-3xl font-bold text-purple-300 mb-6 border-b-2 border-purple-600 pb-2 animate-fade-in" style="animation-delay: 1.5s">Select Time & Format</h2>
                <div class="text-center mb-6 animate-fade-in" style="animation-delay: 1.6s">
                    <h3 class="text-xl text-gray-300"><?php echo $movieLanguages; ?> <?php echo $dimension; ?></h3>
                </div>
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <?php
                    $times = [$showingTime1, $showingTime2, $showingTime3];
                    $delay = 1.7;
                    foreach ($times as $index => $time) {
                        if ($time) {
                            echo '<div class="animate-scale-up" style="animation-delay: ' . $delay . 's">';
                            echo '<input type="radio" name="time" id="time-' . $index . '" value="' . $time . '">';
                            echo '<label for="time-' . $index . '" class="toggle-button time-toggle" data-id="time-' . $index . '">' . $time . '</label>';
                            echo '</div>';
                            $delay += 0.1;
                        }
                    }
                    ?>
                </div>
                <div class="text-center animate-fade-in" style="animation-delay: 2.0s">
                    <button onclick="getbookingdate(<?php echo $mid; ?>);" class="bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 glow animate-neon-glow">Book Now</button>
                </div>
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
        lucide.createIcons();
    </script>
</body>
</html>
<?php
} else {
    header("location:Index.php");
}
?>