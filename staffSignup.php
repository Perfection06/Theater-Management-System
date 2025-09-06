<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for form elements */
        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        .animate-zoom-in {
            animation: zoomIn 0.6s ease-out forwards;
        }
        /* Glass effect for navbar */
        .glass-effect {
            background: rgba(31, 41, 55, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        /* Input hover glow */
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 10px rgba(147, 51, 234, 0.5);
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
            <h1 class="text-5xl font-extrabold text-purple-400 animate-pulse">Add Staff</h1>
            <p class="text-gray-400 mt-3 text-lg">Register a new staff member for the admin panel</p>
        </header>

        <section class="max-w-md mx-auto bg-gray-900 rounded-2xl p-8 shadow-2xl transform transition-all duration-300 hover:shadow-purple-500/50 animate-zoom-in" style="animation-delay: 0.1s">
            <h2 class="text-2xl font-bold text-purple-300 mb-6 text-center">Enter Staff Details</h2>
            <form action="staff_signup.php" method="POST" class="space-y-6">
                <div class="animate-zoom-in" style="animation-delay: 0.2s">
                    <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Full Name" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                </div>
                <div class="animate-zoom-in" style="animation-delay: 0.3s">
                    <label for="phone_number" class="block text-sm font-semibold text-gray-300 mb-2">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="Enter Your Phone Number" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                </div>
                <div class="animate-zoom-in" style="animation-delay: 0.4s">
                    <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter New Password" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                </div>
                <button type="submit" class="w-full bg-purple-900 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105 animate-zoom-in" style="animation-delay: 0.5s">Register</button>
            </form>
        </section>
    </main>
</body>
</html>