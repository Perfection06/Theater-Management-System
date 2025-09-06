<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for form cards */
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
            <h1 class="text-5xl font-extrabold text-purple-400 animate-pulse">Add a New Movie</h1>
            <p class="text-gray-400 mt-3 text-lg">Complete the form below to add a movie to the cinema catalog</p>
        </header>

        <section class="grid gap-6 md:grid-cols-2 max-w-5xl mx-auto">
            <!-- Movie Details Card -->
            <div class="bg-gray-900 rounded-2xl p-6 shadow-2xl transform transition-all duration-300 hover:shadow-purple-500/50 animate-zoom-in" style="animation-delay: 0.1s">
                <h2 class="text-2xl font-bold text-purple-300 mb-6">Movie Details</h2>
                <form action="./add_movie.php" method="post" enctype="multipart/form-data" class="space-y-5">
                    <div>
                        <label for="movieName" class="block text-sm font-semibold text-gray-300 mb-2">Movie Name</label>
                        <input type="text" name="movieName" placeholder="Enter Movie Name" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Movie Image</label>
                        <input type="file" name="movieImage" accept="image/*" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                    </div>
                    <div>
                        <label for="releaseDate" class="block text-sm font-semibold text-gray-300 mb-2">Release Date</label>
                        <input type="date" name="releaseDate" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Movie Description</label>
                        <textarea name="movieDescription" placeholder="Enter Movie Description" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300 resize-y min-h-[100px]"></textarea>
                    </div>
                    <div>
                        <label for="movieLanguage" class="block text-sm font-semibold text-gray-300 mb-2">Movie Language</label>
                        <select name="movieLanguage" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <option value="English">English</option>
                            <option value="Tamil">Tamil</option>
                            <option value="Sinhala">Sinhala</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Showtimes and Metadata Card -->
            <div class="bg-gray-900 rounded-2xl p-6 shadow-2xl transform transition-all duration-300 hover:shadow-purple-500/50 animate-zoom-in" style="animation-delay: 0.2s">
                <h2 class="text-2xl font-bold text-purple-300 mb-6">Showtimes & Metadata</h2>
                <form action="./add_movie.php" method="post" enctype="multipart/form-data" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Showing Date</label>
                        <input type="date" name="showingDate" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Ending Date</label>
                        <input type="date" name="endingDate" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Showing Times</label>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="time" name="showingTime1" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <input type="time" name="showingTime2" class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <input type="time" name="showingTime3" class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Dimension</label>
                        <select name="dimension" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <option value="2D">2D</option>
                            <option value="3D">3D</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Genre</label>
                        <select name="genre" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <option value="Action">Action</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Drama">Drama</option>
                            <option value="Horror">Horror</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Rating</label>
                        <select name="rating" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                            <option value="G - General Audience">G - General Audience</option>
                            <option value="PG - Parental Guidance">PG - Parental Guidance</option>
                            <option value="PG-13 - Parents Strongly Cautioned">PG-13 - Parents Strongly Cautioned</option>
                            <option value="R - Restricted">R - Restricted</option>
                            <option value="NC-17 - Adults Only">NC-17 - Adults Only</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Cast and Trailer Card -->
            <div class="bg-gray-900 rounded-2xl p-6 shadow-2xl transform transition-all duration-300 hover:shadow-purple-500/50 animate-zoom-in md:col-span-2" style="animation-delay: 0.3s">
                <h2 class="text-2xl font-bold text-purple-300 mb-6">Cast & Trailer</h2>
                <form action="./add_movie.php" method="post" enctype="multipart/form-data" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Cast Members</label>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="castName[]" placeholder="Cast Name" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                                <input type="file" name="castImage[]" accept="image/*" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="castName[]" placeholder="Cast Name" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                                <input type="file" name="castImage[]" accept="image/*" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="castName[]" placeholder="Cast Name" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                                <input type="file" name="castImage[]" accept="image/*" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="castName[]" placeholder="Cast Name" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                                <input type="file" name="castImage[]" accept="image/*" required class="p-3 rounded-lg bg-gray-800 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-900 file:text-white file:hover:bg-purple-700 transition duration-300">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">YouTube Trailer Link</label>
                        <input type="url" name="trailerLink" placeholder="Enter YouTube Trailer Link" required class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:border-purple-400 focus:ring-2 focus:ring-purple-400 focus:outline-none transition duration-300">
                    </div>
                    <button type="submit" class="w-full bg-purple-900 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105">Add Movie</button>
                </form>
                <div class="hidden text-center text-green-400 mt-4 animate-zoom-in" style="animation-delay: 0.4s">Movie added successfully!</div>
            </div>
        </section>
    </main>
</body>
</html>