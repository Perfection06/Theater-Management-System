<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savoy Cinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom animations */
        @keyframes neonGlow {
            0%, 100% { box-shadow: 0 0 5px rgba(147, 51, 234, 0.5), 0 0 20px rgba(147, 51, 234, 0.3); }
            50% { box-shadow: 0 0 10px rgba(147, 51, 234, 0.8), 0 0 30px rgba(147, 51, 234, 0.5); }
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes zoomIn {
            from { transform: scale(0.95); opacity: 0.8; }
            to { transform: scale(1); opacity: 1; }
        }
        .animate-neon-glow { animation: neonGlow 1.5s infinite; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        .animate-zoom-in { animation: zoomIn 0.3s ease-out forwards; }
        /* Glass effect */
        .glass-effect {
            background: rgba(31, 41, 55, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        /* Input and button glow */
        input:focus, button:focus { box-shadow: 0 0 10px rgba(147, 51, 234, 0.7); }
        .glow:hover { box-shadow: 0 0 20px rgba(147, 51, 234, 0.8); }
        /* Slider styles */
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide { min-width: 100%; }
        .slider:hover .slide-img { animation: zoomIn 0.3s ease-out forwards; }
        /* Tab styles */
        .tab-button.active { background: linear-gradient(to right, #9333ea, #6b21a8); }
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

        // Tab switching
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabId).classList.remove('hidden');
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
        }

        // Slider functionality
        let slideIndex = 1;
        let slideInterval;

        function showSlides(n) {
            const slides = document.querySelector('.slides');
            const dots = document.querySelectorAll('.dot');
            if (n > slides.children.length) slideIndex = 1;
            if (n < 1) slideIndex = slides.children.length;
            slides.style.transform = `translateX(-${(slideIndex - 1) * 100}%)`;
            dots.forEach(dot => dot.classList.remove('bg-purple-900'));
            dots[slideIndex - 1].classList.add('bg-purple-900');
        }

        function moveSlide(n) {
            clearInterval(slideInterval);
            slideIndex += n;
            showSlides(slideIndex);
            startSlideInterval();
        }

        function currentSlide(n) {
            clearInterval(slideInterval);
            slideIndex = n;
            showSlides(slideIndex);
            startSlideInterval();
        }

        function startSlideInterval() {
            slideInterval = setInterval(() => {
                slideIndex++;
                showSlides(slideIndex);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSlides(slideIndex);
            startSlideInterval();
        });
    </script>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'I_navbar.php';
    ?>

    <!-- Slider Section -->
    <section class="relative w-full max-w-7xl mx-auto mt-20 mb-12">
        <div class="slider overflow-hidden rounded-2xl shadow-2xl">
            <div class="slides flex">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "savoy_cinema";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `movies` WHERE `status` = 'now_showing'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="slide relative min-w-full h-[500px] flex">';
                        echo '<img src="' . $row["movieImage"] . '" alt="' . $row["movieName"] . '" class="slide-img w-full h-full object-cover transition-transform duration-500">';
                        echo '<div class="absolute bottom-6 left-6 bg-black/70 p-6 rounded-xl max-w-lg animate-slide-in" style="animation-delay: 0.2s">';
                        echo '<h1 class="text-3xl font-bold text-purple-300 mb-4">' . $row["movieName"] . '</h1>';
                        echo '<div class="flex gap-4">';
                        echo '<a href="./booking.php?id='.$row["id"].'" class="bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105 glow">Book Tickets</a>';
                        echo '<a href="' . $row["trailerLink"] . '" class="bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white font-bold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105 glow" target="_blank">Play Trailer</a>';
                        echo '</div></div></div>';
                    }
                }
                $conn->close();
                ?>
            </div>
            <div class="navigation absolute top-1/2 w-full flex justify-between transform -translate-y-1/2 px-4">
                <button class="prev bg-black/50 hover:bg-purple-900 text-white p-4 rounded-full transition duration-300 glow" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next bg-black/50 hover:bg-purple-900 text-white p-4 rounded-full transition duration-300 glow" onclick="moveSlide(1)">&#10095;</button>
            </div>
            <div class="dots absolute bottom-4 w-full text-center">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    for ($i = 1; $i <= $result->num_rows; $i++) {
                        echo '<span class="dot w-4 h-4 mx-1 bg-gray-400 rounded-full cursor-pointer transition duration-300 hover:bg-purple-700 '.($i === 1 ? 'bg-purple-900' : '').'" onclick="currentSlide(' . $i . ')"></span>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Movies Section with Tabs -->
    <section class="max-w-7xl mx-auto px-6 mb-12">
        <h1 class="text-4xl font-extrabold text-purple-400 text-center mb-8 animate-pulse">Movies</h1>
        <div class="flex justify-center mb-6">
            <button data-tab="now-showing" class="tab-button px-6 py-3 text-lg font-semibold text-gray-300 bg-gray-800 rounded-l-lg transition duration-300 hover:bg-purple-900 hover:text-white active" onclick="showTab('now-showing')">Now Showing</button>
            <button data-tab="upcoming" class="tab-button px-6 py-3 text-lg font-semibold text-gray-300 bg-gray-800 rounded-r-lg transition duration-300 hover:bg-purple-900 hover:text-white" onclick="showTab('upcoming')">Upcoming</button>
        </div>
        <div id="now-showing" class="tab-content">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

                $sql = "SELECT * FROM movies WHERE status = 'now_showing'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $delay = 0;
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="relative bg-gray-900/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-300 hover:shadow-[0_0_20px_rgba(147,51,234,0.8)] hover:-translate-y-2 animate-slide-in" style="animation-delay: '.$delay.'s">';
                        echo '<img src="' . $row["movieImage"] . '" alt="' . $row["movieName"] . '" class="w-full h-80 object-cover transition duration-500 transform hover:scale-110">';
                        echo '<div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent p-4 flex flex-col justify-end opacity-0 hover:opacity-100 transition duration-300">';
                        echo '<h3 class="text-lg font-bold text-purple-300 text-center mb-2">' . $row["movieName"] . '</h3>';
                        echo '<div class="flex justify-center gap-4">';
                        echo '<a href="./booking.php?id='.$row["id"].'" class="bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105 glow">Book Tickets</a>';
                        echo '<a href="' . $row["trailerLink"] . '" class="bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105 glow" target="_blank">Watch Trailer</a>';
                        echo '</div></div></div>';
                        $delay += 0.1;
                    }
                } else {
                    echo "<p class='text-center text-gray-400 col-span-full'>No movies currently showing.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
        <div id="upcoming" class="tab-content hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

                $sql = "SELECT * FROM movies WHERE status = 'Upcoming'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $delay = 0;
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="relative bg-gray-900/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-300 hover:shadow-[0_0_20px_rgba(147,51,234,0.8)] hover:-translate-y-2 animate-slide-in" style="animation-delay: '.$delay.'s">';
                        echo '<img src="' . $row["movieImage"] . '" alt="' . $row["movieName"] . '" class="w-full h-80 object-cover transition duration-500 transform hover:scale-110">';
                        echo '<div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent p-4 flex flex-col justify-end opacity-0 hover:opacity-100 transition duration-300">';
                        echo '<h3 class="text-lg font-bold text-purple-300 text-center mb-2">' . $row["movieName"] . '</h3>';
                        echo '<div class="flex justify-center">';
                        echo '<a href="' . $row["trailerLink"] . '" class="bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105 glow" target="_blank">Watch Trailer</a>';
                        echo '</div></div></div>';
                        $delay += 0.1;
                    }
                } else {
                    echo "<p class='text-center text-gray-400 col-span-full'>No upcoming movies.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-black to-purple-950 py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="animate-zoom-in" style="animation-delay: 0.1s">
                <h3 class="text-2xl font-bold text-purple-400 mb-4">Savoy Cinema</h3>
                <p class="text-gray-300">Experience the magic of movies with cutting-edge technology and unparalleled comfort.</p>
            </div>
            <div class="animate-zoom-in" style="animation-delay: 0.2s">
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
            <div class="animate-zoom-in" style="animation-delay: 0.3s">
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
        <div class="text-center text-gray-400 mt-8 text-sm animate-zoom-in" style="animation-delay: 0.4s">
            &copy; 2025 Savoy Cinema. All rights reserved.
        </div>
    </footer>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>