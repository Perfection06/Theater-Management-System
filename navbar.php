<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(147, 51, 234, 0.7);
            }
            50% {
                box-shadow: 0 0 10px 5px rgba(147, 51, 234, 0.3);
            }
        }
        .nav-link:hover, .nav-link.active {
            animation: pulseGlow 1.5s infinite;
        }
    </style>
</head>
<body>
    <nav class="glass-effect fixed top-0 left-0 right-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-purple-400">Admin Panel</div>
            <div class="flex space-x-6">
                <?php
                $links = [
                    'adminpanel.php' => 'Home',
                    'addmovies.php' => 'Add Movies',
                    'addPromotions.php' => 'Add Promotions',
                    'staffSignup.php' => 'Create Staff Account',
                    'CheckBookings.php' => 'Check Bookings',
                    'view_feedback.php' => 'View Feedbacks',
                    'Index.php' => 'Logout'
                ];

                foreach ($links as $file => $name) {
                    $is_active = ($current_page === $file) ? 'active bg-purple-900 text-white' : 'text-gray-300';
                    echo "<a href='$file' class='nav-link px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 hover:bg-purple-900 hover:text-white $is_active'>$name</a>";
                }
                ?>
            </div>
        </div>
    </nav>
</body>
</html>