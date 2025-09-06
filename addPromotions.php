<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
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
            <h1 class="text-5xl font-extrabold text-purple-400 animate-pulse">Add New Promotion</h1>
            <p class="text-gray-400 mt-3 text-lg">Create a new promotion to attract more customers</p>
        </header>

        <section class="max-w-3xl mx-auto bg-gray-900 rounded-2xl p-8 shadow-2xl transform transition-all duration-300 hover:shadow-purple-500/50 animate-zoom-in" style="animation-delay: 0.1s">
            <h2 class="text-2xl font-bold text-purple-300 mb-6 text-center">Promotion Details</h2>
            <form action="add_promotion.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="animate-zoom-in" style="animation-delay: 0.2s">
                        <label for="title" class="block text-sm font-semibold text-gray-300 mb-2">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter Promotion Title" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div class="animate-zoom-in" style="animation-delay: 0.3s">
                        <label for="discount" class="block text-sm font-semibold text-gray-300 mb-2">Discount (% or Amount)</label>
                        <input type="text" id="discount" name="discount" placeholder="Enter Discount Value" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                </div>
                <div class="animate-zoom-in" style="animation-delay: 0.4s">
                    <label for="description" class="block text-sm font-semibold text-gray-300 mb-2">Description</label>
                    <textarea id="description" name="description" placeholder="Enter Promotion Description" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300 resize-y min-h-[100px]"></textarea>
                </div>
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="animate-zoom-in" style="animation-delay: 0.5s">
                        <label for="start_date" class="block text-sm font-semibold text-gray-300 mb-2">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div class="animate-zoom-in" style="animation-delay: 0.6s">
                        <label for="end_date" class="block text-sm font-semibold text-gray-300 mb-2">End Date</label>
                        <input type="date" id="end_date" name="end_date" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                </div>
                <div class="animate-zoom-in" style="animation-delay: 0.7s">
                    <label for="duration" class="block text-sm font-semibold text-gray-300 mb-2">Duration (in days)</label>
                    <input type="number" id="duration" name="duration" placeholder="Enter Duration" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                </div>
                <div class="animate-zoom-in" style="animation-delay: 0.8s">
                    <label for="image" class="block text-sm font-semibold text-gray-300 mb-2">Promotion Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                </div>
                <button type="submit" class="w-full bg-purple-900 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105 animate-zoom-in" style="animation-delay: 0.9s">Add Promotion</button>
            </form>
        </section>
    </main>
</body>
</html>