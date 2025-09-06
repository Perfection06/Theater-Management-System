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

$sql = "SELECT * FROM promotions";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - Savoy Cinema</title>
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
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-neon-glow { animation: neonGlow 1.5s infinite; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
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
    </style>
    <script>
        // Active link highlighting
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.nav-link');
            const currentPath = window.location.pathname.split('/').pop();
            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
                link.addEventListener('click', () => {
                    links.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                });
            });
        });

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
    </script>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'I_navbar.php';
    ?>

    <!-- Promotions Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <h1 class="text-5xl font-extrabold text-purple-400 text-center mb-12 animate-pulse">Exclusive Promotions</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            // Assuming database connection and query for promotions
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "savoy_cinema";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM promotions"; // Adjust table name as needed
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $delay = 0;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="glass-effect rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-300 hover:shadow-[0_0_20px_rgba(147,51,234,0.8)] hover:-translate-y-2 animate-slide-in" style="animation-delay: '.$delay.'s">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['title'] . '" class="w-full h-48 object-cover transition duration-500 transform hover:scale-110">';
                    echo '<div class="p-6">';
                    echo '<h2 class="text-xl font-bold text-purple-300 mb-2">' . $row['title'] . '</h2>';
                    echo '<p class="text-gray-300 mb-4">' . $row['description'] . '</p>';
                    echo '<p class="text-2xl font-semibold text-red-400">' . $row['discount'] . '</p>';
                    echo '</div></div>';
                    $delay += 0.1;
                }
            } else {
                echo '<p class="text-center text-gray-400 col-span-full animate-fade-in-up">No promotions available at this time.</p>';
            }
            $conn->close();
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-black to-purple-950 py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                <h3 class="text-2xl font-bold text-purple-400 mb-4">Savoy Cinema</h3>
                <p class="text-gray-300">Experience the magic of movies with cutting-edge technology and unparalleled comfort.</p>
            </div>
            <div class="animate-fade-in-up" style="animation-delay: 0.2s">
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
            <div class="animate-fade-in-up" style="animation-delay: 0.3s">
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
        <div class="text-center text-gray-400 mt-8 text-sm animate-fade-in-up" style="animation-delay: 0.4s">
            &copy; 2025 Savoy Cinema. All rights reserved.
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>