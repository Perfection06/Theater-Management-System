<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Savoy Cinema</title>
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

    <!-- About Us Section -->
    <section class="max-w-5xl mx-auto px-6 py-20">
        <h1 class="text-5xl font-extrabold text-purple-400 text-center mb-12 animate-pulse">About Savoy Cinema</h1>
        <div class="glass-effect rounded-2xl p-8 shadow-2xl transform transition-all duration-300 hover:shadow-[0_0_20px_rgba(147,51,234,0.8)] animate-fade-in-up">
            <p class="text-lg text-gray-300 mb-6 leading-relaxed animate-slide-in" style="animation-delay: 0.1s">
                Welcome to <span class="text-purple-400 font-bold">Savoy Cinema</span>, the premier destination for movie enthusiasts in Colombo, Sri Lanka. Since our establishment, we have been dedicated to delivering an unparalleled cinematic experience, blending state-of-the-art technology with a passion for storytelling.
            </p>

            <h2 class="text-3xl font-bold text-purple-300 mb-4 border-b-2 border-purple-600 pb-2 animate-slide-in" style="animation-delay: 0.2s">Our Facilities</h2>
            <ul class="space-y-4 mb-6">
                <li class="flex items-start animate-slide-in" style="animation-delay: 0.3s">
                    <i data-lucide="monitor" class="w-6 h-6 text-purple-400 mr-3 mt-1"></i>
                    <div>
                        <span class="font-bold text-lg">Modern Auditoriums:</span> Equipped with cutting-edge sound and projection technology for an immersive viewing experience.
                    </div>
                </li>
                <li class="flex items-start animate-slide-in" style="animation-delay: 0.4s">
                    <i data-lucide="armchair" class="w-6 h-6 text-purple-400 mr-3 mt-1"></i>
                    <div>
                        <span class="font-bold text-lg">Comfortable Seating:</span> Plush, ergonomic seats designed for maximum comfort during your movie.
                    </div>
                </li>
                <li class="flex items-start animate-slide-in" style="animation-delay: 0.5s">
                    <i data-lucide="popcorn" class="w-6 h-6 text-purple-400 mr-3 mt-1"></i>
                    <div>
                        <span class="font-bold text-lg">Concession Stand:</span> A variety of gourmet snacks and beverages to enhance your cinema experience.
                    </div>
                </li>
                <li class="flex items-start animate-slide-in" style="animation-delay: 0.6s">
                    <i data-lucide="ticket" class="w-6 h-6 text-purple-400 mr-3 mt-1"></i>
                    <div>
                        <span class="font-bold text-lg">Online Booking:</span> Seamless online ticket booking system to reserve your seats in advance.
                    </div>
                </li>
            </ul>

            <h2 class="text-3xl font-bold text-purple-300 mb-4 border-b-2 border-purple-600 pb-2 animate-slide-in" style="animation-delay: 0.7s">Our Commitment</h2>
            <p class="text-lg text-gray-300 mb-6 leading-relaxed animate-slide-in" style="animation-delay: 0.8s">
                At Savoy Cinema, we are committed to excellence in entertainment and customer service. Our dedicated staff ensures every visit is memorable, creating a welcoming environment for all movie lovers.
            </p>

            <h2 class="text-3xl font-bold text-purple-300 mb-4 border-b-2 border-purple-600 pb-2 animate-slide-in" style="animation-delay: 0.9s">Special Events & Promotions</h2>
            <p class="text-lg text-gray-300 mb-6 leading-relaxed animate-slide-in" style="animation-delay: 1s">
                We host exclusive screenings, special events, and exciting promotions. Follow us on our social media channels and check our website for the latest updates and offers.
            </p>

            <div class="text-center animate-slide-in" style="animation-delay: 1.1s">
                <a href="./promotion.php" class="inline-block bg-gradient-to-r from-purple-900 to-purple-700 hover:from-purple-800 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 glow animate-neon-glow">Discover Our Promotions</a>
            </div>
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