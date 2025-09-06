<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: login.html');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for movie cards */
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
        /* Glass effect for navbar */
        .glass-effect {
            background: rgba(31, 41, 55, 0.3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen">
    <!-- Include Navbar -->
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        include 'navbar.php';
    ?>

    <!-- Main Content with top padding to avoid navbar overlap -->
    <main class="container mx-auto p-8 pt-24">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-purple-400 animate-pulse">Admin Dashboard - Movies</h1>
        </header>

        <section class="space-y-8">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "savoy_cinema";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch movies
            $sql_movies = "SELECT * FROM movies";
            $result_movies = $conn->query($sql_movies);

            if ($result_movies->num_rows > 0) {
                $delay = 0;
                while ($movie = $result_movies->fetch_assoc()) {
                    echo "<div class='bg-gray-900 rounded-2xl shadow-2xl p-6 flex flex-col md:flex-row gap-6 transform transition-all duration代替

System: duration-300 hover:shadow-purple-500/50 hover:-translate-y-2 animate-slide-up' style='animation-delay: {$delay}s'>";
                    echo "<div class='md:w-1/3'>";
                    echo "<img src='" . $movie["movieImage"] . "' alt='" . $movie["movieName"] . "' class='w-full h-96 object-cover rounded-xl shadow-md transition-transform duration-300 hover:scale-105'>";
                    echo "</div>";
                    echo "<div class='md:w-2/3 flex flex-col justify-between'>";
                    echo "<div>";
                    echo "<h2 class='text-3xl font-bold mb-4 text-purple-300'>" . $movie["movieName"] . "</h2>";
                    echo "<p class='text-gray-300 mb-3'><span class='font-semibold text-white'>Description:</span> " . $movie["movieDescription"] . "</p>";
                    echo "<div class='grid grid-cols-2 gap-4 mb-4'>";
                    echo "<p><span class='font-semibold'>Release Date:</span> " . $movie["releaseDate"] . "</p>";
                    echo "<p><span class='font-semibold'>Language:</span> " . $movie["movieLanguage"] . "</p>";
                    echo "<p><span class='font-semibold'>Genre:</span> " . $movie["genre"] . "</p>";
                    echo "<p><span class='font-semibold'>Rating:</span> " . $movie["rating"] . "</p>";
                    echo "<p><span class='font-semibold'>Dimension:</span> " . $movie["dimension"] . "</p>";
                    echo "<p><span class='font-semibold'>Status:</span> <span class='text-purple-400'>" . $movie["status"] . "</span></p>";
                    echo "</div>";
                    echo "<p class='mb-3'><span class='font-semibold'>Duration:</span> " . $movie["showingDate"] . " - " . $movie["endingDate"] . "</p>";
                    echo "<p class='mb-3'><span class='font-semibold'>Showing Times:</span> " . $movie["showingTime1"] . ", " . $movie["showingTime2"] . ", " . $movie["showingTime3"] . "</p>";
                    
                    // Fetch casts
                    $movieId = $movie["id"];
                    $sql_casts = "SELECT * FROM movie_casts WHERE movieId = $movieId";
                    $result_casts = $conn->query($sql_casts);
                    $casts = [];
                    if ($result_casts->num_rows > 0) {
                        while ($cast = $result_casts->fetch_assoc()) {
                            $casts[] = "<span class='inline-flex items-center bg-gray-800 px-3 py-1 rounded-full mr-2 mb-2 text-sm transition-colors duration-300 hover:bg-purple-900'>" . $cast["castName"] . " <img src='" . $cast["castImage"] . "' alt='" . $cast["castName"] . "' class='w-5 h-5 ml-2 rounded-full'></span>";
                        }
                    }
                    echo "<div class='mb-4'><span class='font-semibold block mb-2'>Cast:</span> " . implode(" ", $casts) . "</div>";
                    echo "</div>";
                    echo "<div class='flex items-center gap-4'>";
                    echo "<a href='" . $movie["trailerLink"] . "' target='_blank' class='bg-purple-900 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105'>Watch Trailer</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $delay += 0.1; // Incremental delay for staggered animation
                }
            } else {
                echo "<p class='text-center text-gray-400'>No movies found.</p>";
            }

            $conn->close();
            ?>
        </section>
    </main>
</body>
</html>