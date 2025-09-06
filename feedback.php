<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <script>
// Function to search for movies
        function searchMovies() {
            const query = document.getElementById('searchInput').value;
            if (query.length < 3) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_movies.php?q=' + query, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const movies = JSON.parse(xhr.responseText);
                    let resultsHTML = '';
                    for (const movie of movies) {
                        resultsHTML += `<div class="result-item" onclick="goToMovie(${movie.id})">
                            <img src="${movie.movieImage}" alt="${movie.movieName}">
                            <span>${movie.movieName}</span>
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
    
    <style>
    body {
        object-fit: cover;
        background-color: black;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }
    
    /* Nav Bar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333; 
        padding: 10px 20px;
        position: relative;
        width: 97.3%;
        z-index: 10;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        border-radius: 10px;
    }
    
    .navbar .center {
        position: relative;
    }
    
    .navbar .center .nav-link {
        color: #ddd;
        padding: 14px 20px;
        text-decoration: none;
        text-align: center;
        margin-left: 30px;
        position: relative;
        transition: color 0.3s ease;
        z-index: 1;
        overflow: hidden;
    }
    
    .navbar .center .nav-link::before {
        content: '';
        position: absolute;
        left: 100%;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: #600086;
        z-index: -1;
        transition: left 0.5s ease, opacity 0.5s ease;
        opacity: 0;
    }
    
    .navbar .center .nav-link:hover::before,
    .navbar .center .nav-link.active::before {
        left: 0;
        opacity: 1;
    }
    
    .navbar .center .nav-link:hover {
        color: #fff;
    }
    
    .left a .logo {
        width: 80px;
        height: auto;
        padding-top: 5px;
        transition: all 0.3s ease;
    }
    
    .left a .logo:hover {
        transform: scale(1.1);
    }
    
    .right {
        display: flex;
        align-items: center;
    }
    
    .search-bar {
        position: relative;
        margin-right: 20px;
    }
    
    .search-bar input {
        border: 1px solid #555;
        height: 30px;
        border-radius: 20px;
        padding: 0 10px;
        outline: none;
        transition: all 0.3s ease;
        width: 250px;
        background-color: #444;
        color: #fff;
    }
    
    .search-bar input::placeholder {
        color: #bbb;
    }
    
    .search-bar input:focus {
        border-color: #600086;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .search-results {
        position: absolute;
        background: #444;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        width: 250px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: #fff;
    }
    
    .search-results .result-item {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.3s ease;
    }
    
    .search-results .result-item img {
        width: 50px;
        height: 75px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 5px;
    }
    
    .search-results .result-item:hover {
        background-color: #555;
    }
    
    .profile-dropdown {
        position: relative;
        display: inline-block;
    }
    
    .profile-icon {
        width: 30px;
        height: auto;
        cursor: pointer;
        margin-top: 3px;
        transition: transform 0.3s ease;
    }
    
    .profile-icon:hover {
        transform: rotate(360deg);
    }
    
    .dropdown-content {
        width: 120px;
        display: none;
        position: absolute;
        right: 0;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.9);
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }
    
    .dropdown-content a {
        color: #ddd;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background 0.3s ease;
        border-radius: 5px;
        margin: 5px;
    }
    
    .dropdown-content a:hover {
        background-color: #600086;
        color: #fff;
    }
    
    .profile-dropdown:hover .dropdown-content {
        display: block;
    }
    
    .page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            color: #fff;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #ccc;
        }

        textarea {
            width: 90%;
            height: 100px;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            margin-top: 10px;
            background-color: #444;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .thank-you {
            text-align: center;
            color: #28a745;
            font-size: 24px;
        }
    </style>
</head>
<body>

<!-- Navigation bar -->
<section>
    <nav class="navbar">

        <div class="left">
            <a href="#"><img src="./uploads/icons/savoy.png" alt="Logo" class="logo"></a>
        </div>

        <div class="center">
            <a href="./Index.php" class="nav-link">Home</a>
            <a href="./Aboutus.html" class="nav-link">About Us</a>
            <a href="./promotion.php" class="nav-link">Promotions</a>
        </div>

        <div class="right">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search Your Movie..." onkeyup="searchMovies()">
                <div id="searchResults" class="search-results"></div>
            </div>

            <div class="profile-dropdown">
                <img src="./uploads/icons/profile icon.png" alt="Profile" class="profile-icon">

                <div class="dropdown-content">
                    <a href="./Signup.html">Sign Up</a>
                    <a href="./login.html">Login</a>
                </div>
            </div>
        </div>

    </nav>
</section>

    <div class="page">
        <div class="container">
            <h1>Feedback</h1>
            <form action="submit_feedback.php" method="post">
                <label for="feedback">Your Feedback:</label>
                <textarea id="feedback" name="feedback" required></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
