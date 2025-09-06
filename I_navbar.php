<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes neonPulse {
            0%, 100% { box-shadow: 0 0 5px rgba(147, 51, 234, 0.5); }
            50% { box-shadow: 0 0 15px rgba(147, 51, 234, 0.9), 0 0 30px rgba(147, 51, 234, 0.5); }
        }
        .nav-link:hover, .nav-link.active { animation: neonPulse 1.2s infinite; }
        .glass-effect {
            background: rgba(31, 41, 55, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glow:hover { box-shadow: 0 0 20px rgba(147, 51, 234, 0.8); }
    </style>
</head>
<body>
    <nav class="glass-effect fixed top-0 left-0 right-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center animate-slide-in" style="animation-delay: 0.1s">
                <a href="./Index.php">
                    <svg class="w-12 h-12 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                        <path d="M2 17l10 5 10-5"></path>
                        <path d="M2 12l10 5 10-5"></path>
                    </svg>
                </a>
            </div>
            <div class="flex space-x-6">
                <?php
                $links = [
                    'Index.php' => 'Home',
                    'Aboutus.php' => 'About Us',
                    'promotion.php' => 'Promotions'
                ];
                $delay = 0.2;
                foreach ($links as $file => $name) {
                    $is_active = ($current_page === $file) ? 'active bg-gradient-to-r from-purple-900 to-purple-700 text-white' : 'text-gray-300';
                    echo "<a href='$file' class='nav-link px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 hover:bg-gradient-to-r hover:from-purple-900 hover:to-purple-700 hover:text-white $is_active animate-slide-in' style='animation-delay: {$delay}s'>$name</a>";
                    $delay += 0.1;
                }
                ?>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative animate-slide-in" style="animation-delay: 0.5s">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search Movies..." onkeyup="searchMovies()" class="pl-10 pr-4 py-2 rounded-full bg-gray-800/50 border border-gray-600/50 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300 w-64">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    </div>
                    <div id="searchResults" class="absolute top-full left-0 w-full bg-gray-900/90 rounded-lg shadow-lg mt-2 glass-effect max-h-60 overflow-y-auto z-50"></div>
                </div>
                <div class="relative group animate-slide-in" style="animation-delay: 0.6s">
                    <i data-lucide="user-circle-2" class="w-8 h-8 text-purple-400 cursor-pointer transition duration-300 transform hover:scale-110"></i>
                    <div class="absolute right-0 mt-2 w-32 bg-gray-900/90 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition duration-300 z-50 glass-effect">
                        <a href="./Signup.html" class="block px-4 py-2 text-gray-300 hover:bg-purple-900 hover:text-white rounded-lg transition duration-300">Sign Up</a>
                        <a href="./login.html" class="block px-4 py-2 text-gray-300 hover:bg-purple-900 hover:text-white rounded-lg transition duration-300">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>