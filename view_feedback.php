<?php
// Database credentials
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

// Fetch feedbacks from the database
$sql = "SELECT user_id, name, feedback, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedbacks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animation for feedback cards */
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

    <!-- Main Content -->
    <main class="container mx-auto px-6 pt-24 pb-12">
        <header class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-purple-400 animate-pulse">Customer Feedbacks</h1>
            <p class="text-gray-400 mt-3 text-lg">View all feedback submitted by customers</p>
        </header>

        <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "savoy_cinema";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT name, feedback, created_at FROM feedback";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $delay = 0;
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='bg-gray-900 rounded-2xl shadow-2xl p-6 transform transition-all duration-300 hover:shadow-purple-500/50 hover:-translate-y-2 animate-slide-up' style='animation-delay: {$delay}s'>";
                    echo "<h3 class='text-xl font-bold text-purple-300 mb-3'>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p class='text-gray-300 mb-4'>" . htmlspecialchars($row['feedback']) . "</p>";
                    echo "<p class='text-sm text-gray-400 text-right'>" . htmlspecialchars($row['created_at']) . "</p>";
                    echo "</div>";
                    $delay += 0.1; // Incremental delay for staggered animation
                }
            } else {
                echo "<p class='text-center text-gray-400 col-span-full'>No feedbacks found.</p>";
            }

            $conn->close();
            ?>
        </section>
    </main>
</body>
</html>