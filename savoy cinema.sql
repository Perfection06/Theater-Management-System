-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for savoy_cinema
CREATE DATABASE IF NOT EXISTS `savoy_cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `savoy_cinema`;

-- Dumping structure for table savoy_cinema.booking
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moive_id` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `parking_slots` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_booking_movies` (`moive_id`),
  KEY `FK_booking_users` (`users_id`),
  CONSTRAINT `FK_booking_movies` FOREIGN KEY (`moive_id`) REFERENCES `movies` (`id`),
  CONSTRAINT `FK_booking_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.booking: ~2 rows (approximately)
INSERT INTO `booking` (`id`, `moive_id`, `date`, `time`, `parking_slots`, `users_id`, `booking_date`) VALUES
	(19, 26, '16', '10:30:00', 0, 1, '2024-06-21'),
	(20, 33, '18', '03:00:00', 0, 1, '2024-06-21');

-- Dumping structure for table savoy_cinema.booking_seat
CREATE TABLE IF NOT EXISTS `booking_seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_booking_seat_booking` (`booking_id`),
  KEY `FK_booking_seat_seat` (`seat_id`),
  CONSTRAINT `FK_booking_seat_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  CONSTRAINT `FK_booking_seat_seat` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.booking_seat: ~6 rows (approximately)
INSERT INTO `booking_seat` (`id`, `booking_id`, `seat_id`) VALUES
	(48, 19, 7),
	(49, 19, 9),
	(50, 19, 28),
	(51, 19, 17),
	(52, 20, 1),
	(53, 20, 2);

-- Dumping structure for table savoy_cinema.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.feedback: ~5 rows (approximately)
INSERT INTO `feedback` (`id`, `user_id`, `name`, `feedback`, `created_at`) VALUES
	(11, 1, 'Mohommed Najad', 'I love how intuitive and user-friendly your website is. Finding and booking movies is quick and easy. Great job on the responsive design!', '2024-06-23 12:34:41'),
	(12, 10, 'Panditha Upeksha', 'The seat booking process on your website is so smooth. I appreciate the detailed movie information and the clear, concise layout.', '2024-06-23 14:35:01'),
	(13, 11, 'Randunu', 'Navigating your site is a pleasure! The search functionality is spot on, and the movie selection process is effortless. Keep up the great work!', '2024-06-23 14:37:59'),
	(14, 12, 'Kasun Piyumal', 'Navigating your site is a pleasure. but, The search functionality is spot on, and the movie selection process is effortless.', '2024-06-23 14:40:25'),
	(15, 13, 'Chalani Maduwanthi', 'The website is great overall, but I experienced a few glitches when trying to view upcoming movies. Fixing these bugs would enhance the experience.', '2024-06-23 14:42:07'),
	(16, 1, 'Mohommed Najad', 'Great Website', '2024-06-24 11:54:14');

-- Dumping structure for table savoy_cinema.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movieName` varchar(255) DEFAULT NULL,
  `movieImage` varchar(255) DEFAULT NULL,
  `movieDescription` text DEFAULT NULL,
  `movieLanguage` varchar(250) DEFAULT NULL,
  `showingDate` date DEFAULT NULL,
  `endingDate` date DEFAULT NULL,
  `showingTime1` varchar(50) DEFAULT NULL,
  `showingTime2` varchar(50) DEFAULT NULL,
  `showingTime3` varchar(50) DEFAULT NULL,
  `dimension` varchar(10) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `trailerLink` varchar(255) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `status` enum('now_showing','upcoming') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.movies: ~6 rows (approximately)
INSERT INTO `movies` (`id`, `movieName`, `movieImage`, `movieDescription`, `movieLanguage`, `showingDate`, `endingDate`, `showingTime1`, `showingTime2`, `showingTime3`, `dimension`, `genre`, `rating`, `trailerLink`, `releaseDate`, `status`) VALUES
	(26, 'Bad Boys Ride or Die', 'uploads/Bad Boys.jpg', 'When their late police captain gets linked to drug cartels, wisecracking Miami cops Mike Lowrey and Marcus Burnett embark on a dangerous mission to clear his name.', 'English', '2024-06-13', '2024-06-18', '10:30:PM', '12:00:AM', NULL, '2D', 'Action', 'PG - Paren', 'https://youtu.be/hRFY_Fesa9Q', '2024-06-07', 'now_showing'),
	(27, 'Deadpool & Wolverine', 'uploads/Deadpool 3.jpg', 'Wolverine is recovering from his injuries when he crosses paths with the loudmouth, Deadpool. They team up to defeat a common enemy.', 'English', '2024-07-26', '2024-07-31', '3:30:PM', '9:00:PM', NULL, '3D', 'Action', 'PG - Paren', 'https://youtu.be/uJMCNJP2ipI', '2024-07-26', 'upcoming'),
	(31, 'Indian 2', 'uploads/Indian 2.jpg', 'Indian 2 is an upcoming Indian Tamil-language vigilante action film directed by S. Shankar, who wrote the screenplay with B. Jeyamohan, Kabilan Vairamuthu, and Lakshmi Saravana Kumar. The film is jointly produced by Lyca Productions and Red Giant Movies. The sequel to Indian (1996), Kamal Haasan reprises his role as Senapathy, an ageing freedom fighter turned vigilante who fights against corruption, with Siddharth, S. J. Suryah, Rakul Preet Singh, Bobby Simha, Vivek, Priya Bhavani Shankar, Gulshan Grover, Samuthirakani and Nedumudi Venu in the ensemble cast.', 'Tamil', '2024-07-12', '2024-07-25', '10:00:PM', '3:00:AM', NULL, '2D', 'Action', 'G - Genera', 'https://youtu.be/kqGj31bQQQ0', '2024-07-12', 'upcoming'),
	(33, 'Maharaja', 'uploads/MV5BMTE0ZjY3MTUtYzUwMy00ZWEzLTgwMTYtMjg3ZDE1NTMxOTE4XkEyXkFqcGc@._V1_.jpg', 'A barber seeks vengeance after his home is burglarized, cryptically telling police his \\"lakshmi\\" has been taken, leaving them uncertain if it\\\'s a person or object. His quest to recover the elusive \\"lakshmi\\" unfolds.', 'Tamil', '2024-06-14', '2024-06-22', '03:00:PM', NULL, NULL, '2D', 'Action', 'PG - Paren', 'https://youtu.be/z37hCm4eges', '2024-06-14', 'now_showing'),
	(35, 'KALKI 2898 AD', 'uploads/Kalki-ezgif.com-webp-to-jpg-converter.jpg', 'Kalki 2898 AD is an upcoming 2024 Indian epic dystopian science fiction action film written and directed by Nag Ashwin. Produced by C. Aswani Dutt under Vyjayanthi Movies, it was shot primarily in Telugu with some scenes re-shot in Hindi.Inspired by Hindu scriptures, the film is set in a post-apocalyptic world, in the year 2898 AD. The film features Prabhas in the lead role with an ensemble cast including Amitabh Bachchan, Kamal Haasan, Deepika Padukone, Disha Patani, and Brahmanandam in prominent roles.', 'Tamil', '2024-06-27', '2024-07-05', '04:30 PM', '10:00 PM', NULL, '3D', 'Sci-Fi', 'G - Genera', 'https://youtu.be/BfCIPsEGAS8', '2024-06-27', 'upcoming');

-- Dumping structure for table savoy_cinema.movie_casts
CREATE TABLE IF NOT EXISTS `movie_casts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movieId` int(11) DEFAULT NULL,
  `castName` varchar(255) DEFAULT NULL,
  `castImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movieId` (`movieId`),
  CONSTRAINT `movie_casts_ibfk_1` FOREIGN KEY (`movieId`) REFERENCES `movies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.movie_casts: ~20 rows (approximately)
INSERT INTO `movie_casts` (`id`, `movieId`, `castName`, `castImage`) VALUES
	(65, 26, 'Will Smith', 'uploads/Will Smith.jpg'),
	(66, 26, 'Martin Lawrence', 'uploads/Martin Lawrence.jpg'),
	(67, 26, 'Vanessa Hudgens', 'uploads/Vanessa Hudgens.jpg'),
	(68, 26, 'Adil El Arbi', 'uploads/Adil El Arbi.jpg'),
	(69, 27, 'Ryan Renolds', 'uploads/ryan renolds.jpeg'),
	(70, 27, 'Hugh Jackman', 'uploads/Hugh Jackman.jpeg'),
	(71, 27, 'Morena Baccarin', 'uploads/Morena Baccarin.jpg'),
	(72, 27, 'Shawn Levy', 'uploads/Shawn Levy.jpg'),
	(77, 31, 'Kamal Hassan', 'uploads/Kamal_haasan.jpg'),
	(78, 31, 'Priya Bhavani Shankar', 'uploads/Priya_Bhavani_Shankar_PYTV.png'),
	(79, 31, 'Siddharth', 'uploads/2640-siddharth.jpg'),
	(80, 31, 'Shankar', 'uploads/Shankar_at_the_2.0_Trailer_Launch.jpg'),
	(85, 33, 'Vijay Sethupathi', 'uploads/MV5BZDg5MmIyNjUtYjQwNC00NzY0LWE0OTgtMzUxNzU5MmI2MTc5XkEyXkFqcGdeQXVyMTYzMDI0ODk1._V1_.jpg'),
	(86, 33, 'Mamta Mohandas', 'uploads/DSC_1238.jpeg'),
	(87, 33, 'Bharathiraja', 'uploads/Director_Bharathiraja_at_Salim_Movie_Audio_Launch.jpg'),
	(88, 33, 'Nithilan Swaminathan', 'uploads/nithilan-swaminathan-20230713122819-37021.jpg'),
	(93, 35, 'Prabhas', 'uploads/2525-prabhas.jpg'),
	(94, 35, 'Deepika Padukone', 'uploads/Deepika_Padukone_Cannes_2018_(cropped).jpg'),
	(95, 35, 'Kamal Hassan', 'uploads/Kamal_haasan.jpg'),
	(96, 35, 'Amitabh Bachan', 'uploads/Indian_actor_Amitabh_Bachchan.jpg');

-- Dumping structure for table savoy_cinema.now_showing
CREATE TABLE IF NOT EXISTS `now_showing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movieName` varchar(255) DEFAULT NULL,
  `movieImage` varchar(255) DEFAULT NULL,
  `movieDescription` text DEFAULT NULL,
  `showingDate` date DEFAULT NULL,
  `endingDate` date DEFAULT NULL,
  `showingTime1` varchar(50) DEFAULT NULL,
  `showingTime2` varchar(50) DEFAULT NULL,
  `showingTime3` varchar(50) DEFAULT NULL,
  `dimension` varchar(10) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `trailerLink` varchar(255) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.now_showing: ~4 rows (approximately)
INSERT INTO `now_showing` (`id`, `movieName`, `movieImage`, `movieDescription`, `showingDate`, `endingDate`, `showingTime1`, `showingTime2`, `showingTime3`, `dimension`, `genre`, `rating`, `trailerLink`, `releaseDate`) VALUES
	(23, 'Bad Boys Ride or Die', 'uploads/Bad Boys.jpg', 'When their late police captain gets linked to drug cartels, wisecracking Miami cops Mike Lowrey and Marcus Burnett embark on a dangerous mission to clear his name.', '2024-06-13', '2024-06-18', '16:30:00', '21:00:00', '10:00:00', '2D', 'Action', 'PG', 'https://youtu.be/hRFY_Fesa9Q', '2024-06-07'),
	(24, 'Maharaja', 'uploads/MV5BMTE0ZjY3MTUtYzUwMy00ZWEzLTgwMTYtMjg3ZDE1NTMxOTE4XkEyXkFqcGc@._V1_.jpg', 'A barber seeks vengeance after his home is burglarized, cryptically telling police his \\"lakshmi\\" has been taken, leaving them uncertain if it\\\'s a person or object. His quest to recover the elusive \\"lakshmi\\" unfolds.', '2024-06-14', '2024-06-22', '03:00:00', '01:00:00', '01:00:00', '2D', 'Action', 'PG - Paren', 'https://youtu.be/z37hCm4eges', '2024-06-14'),
	(28, 'Maharaja', 'uploads/MV5BMTE0ZjY3MTUtYzUwMy00ZWEzLTgwMTYtMjg3ZDE1NTMxOTE4XkEyXkFqcGc@._V1_.jpg', 'A barber seeks vengeance after his home is burglarized, cryptically telling police his \\"lakshmi\\" has been taken, leaving them uncertain if it\\\'s a person or object. His quest to recover the elusive \\"lakshmi\\" unfolds.', '2024-06-14', '2024-06-22', '03:00:00', NULL, NULL, '2D', 'Action', 'PG - Paren', 'https://youtu.be/z37hCm4eges', '2024-06-14'),
	(29, 'asd', 'uploads/DSC_1238.jpeg', 'sada', '2024-06-16', '2024-06-18', '12:37:00', NULL, NULL, '2D', 'Action', 'G - Genera', 'https://youtu.be/XyFWNV026c4', '2024-06-16');

-- Dumping structure for table savoy_cinema.promotions
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.promotions: ~0 rows (approximately)
INSERT INTO `promotions` (`id`, `title`, `description`, `discount`, `duration`, `image`, `start_date`, `end_date`) VALUES
	(1, '20% Off with HNB Card', 'Use your HNB card and get a 20% discount on all movie tickets.', '20% OFF', 3, 'uploads/1582893504.png', '2024-06-20', '2024-06-23');

-- Dumping structure for table savoy_cinema.seat
CREATE TABLE IF NOT EXISTS `seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `seat_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_seat_seat_type` (`seat_type_id`),
  CONSTRAINT `FK_seat_seat_type` FOREIGN KEY (`seat_type_id`) REFERENCES `seat_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.seat: ~100 rows (approximately)
INSERT INTO `seat` (`id`, `name`, `seat_type_id`) VALUES
	(1, 'A1', 1),
	(2, 'A2', 1),
	(3, 'A3', 1),
	(4, 'A4', 1),
	(5, 'A5', 1),
	(6, 'A6', 2),
	(7, 'A7', 2),
	(8, 'A8', 2),
	(9, 'A9', 2),
	(10, 'A10', 2),
	(11, 'A11', 2),
	(12, 'A12', 2),
	(13, 'A13', 2),
	(14, 'A14', 2),
	(15, 'A15', 2),
	(16, 'A16', 3),
	(17, 'A17', 3),
	(18, 'A18', 3),
	(19, 'A19', 3),
	(20, 'A20', 3),
	(21, 'B1', 1),
	(22, 'B2', 1),
	(23, 'B3', 1),
	(24, 'B4', 1),
	(25, 'B5', 1),
	(26, 'B6', 2),
	(27, 'B7', 2),
	(28, 'B8', 2),
	(29, 'B9', 2),
	(30, 'B10', 2),
	(31, 'B11', 2),
	(32, 'B12', 2),
	(33, 'B13', 2),
	(34, 'B14', 2),
	(35, 'B15', 2),
	(36, 'B16', 3),
	(37, 'B17', 3),
	(38, 'B18', 3),
	(39, 'B19', 3),
	(40, 'B20', 3),
	(41, 'C1', 1),
	(42, 'C2', 1),
	(43, 'C3', 1),
	(44, 'C4', 1),
	(45, 'C5', 1),
	(46, 'C6', 2),
	(47, 'C7', 2),
	(48, 'C8', 2),
	(49, 'C9', 2),
	(50, 'C10', 2),
	(51, 'C11', 2),
	(52, 'C12', 2),
	(53, 'C13', 2),
	(54, 'C14', 2),
	(55, 'C15', 2),
	(56, 'C16', 3),
	(57, 'C17', 3),
	(58, 'C18', 3),
	(59, 'C19', 3),
	(60, 'C20', 3),
	(61, 'D1', 1),
	(62, 'D2', 1),
	(63, 'D3', 1),
	(64, 'D4', 1),
	(65, 'D5', 1),
	(66, 'D6', 2),
	(67, 'D7', 2),
	(68, 'D8', 2),
	(69, 'D9', 2),
	(70, 'D10', 2),
	(71, 'D11', 2),
	(72, 'D12', 2),
	(73, 'D13', 2),
	(74, 'D14', 2),
	(75, 'D15', 2),
	(76, 'D16', 3),
	(77, 'D17', 3),
	(78, 'D18', 3),
	(79, 'D19', 3),
	(80, 'D20', 3),
	(81, 'E1', 1),
	(82, 'E2', 1),
	(83, 'E3', 1),
	(84, 'E4', 1),
	(85, 'E5', 1),
	(86, 'E6', 2),
	(87, 'E7', 2),
	(88, 'E8', 2),
	(89, 'E9', 2),
	(90, 'E10', 2),
	(91, 'E11', 2),
	(92, 'E12', 2),
	(93, 'E13', 2),
	(94, 'E14', 2),
	(95, 'E15', 2),
	(96, 'E16', 3),
	(97, 'E17', 3),
	(98, 'E18', 3),
	(99, 'E19', 3),
	(100, 'E20', 3);

-- Dumping structure for table savoy_cinema.seat_type
CREATE TABLE IF NOT EXISTS `seat_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.seat_type: ~3 rows (approximately)
INSERT INTO `seat_type` (`id`, `name`) VALUES
	(1, 'Left Seats'),
	(2, 'Middle Seats'),
	(3, 'Right Seats');

-- Dumping structure for table savoy_cinema.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.staff: ~3 rows (approximately)
INSERT INTO `staff` (`id`, `name`, `phone_number`, `password`, `created_at`) VALUES
	(1, 'Staff-1', 'ST01', '$2y$10$koWFBdnTl/CzxLsYrRX80OTs95453OLoPsVh5YCHnsWJrIUokM1TC', '2024-06-14 05:11:23'),
	(2, 'Mohommed Naj', 'ST02', '$2y$10$vFPHvFyZ3w8yxW2XGas1AexA8zaF/vDjl.25hxvKlWmeUMq2ZdmBe', '2024-06-24 12:49:39'),
	(3, 'Upeksha', 'ST03', '$2y$10$CrBE.YTAcTN8ztQozk7Aq.vk/99s64Xe3MV5qaQRk2X92fEFFkYFC', '2024-06-24 13:09:24');

-- Dumping structure for table savoy_cinema.upcoming_movies
CREATE TABLE IF NOT EXISTS `upcoming_movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movieName` varchar(255) DEFAULT NULL,
  `movieImage` varchar(255) DEFAULT NULL,
  `movieDescription` text DEFAULT NULL,
  `showingDate` date DEFAULT NULL,
  `endingDate` date DEFAULT NULL,
  `showingTime1` varchar(50) DEFAULT NULL,
  `showingTime2` varchar(50) DEFAULT NULL,
  `showingTime3` varchar(50) DEFAULT NULL,
  `dimension` varchar(10) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `trailerLink` varchar(255) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.upcoming_movies: ~4 rows (approximately)
INSERT INTO `upcoming_movies` (`id`, `movieName`, `movieImage`, `movieDescription`, `showingDate`, `endingDate`, `showingTime1`, `showingTime2`, `showingTime3`, `dimension`, `genre`, `rating`, `trailerLink`, `releaseDate`) VALUES
	(19, 'Deadpool & Wolverine', 'uploads/Deadpool 3.jpg', 'Wolverine is recovering from his injuries when he crosses paths with the loudmouth, Deadpool. They team up to defeat a common enemy.', '2024-07-26', '2024-07-31', '16:30:00', '21:00:00', '10:00:00', '3D', 'Action', 'PG', 'https://youtu.be/uJMCNJP2ipI', '2024-07-26'),
	(20, 'Indian 2', 'uploads/Indian 2.jpg', 'Indian 2 is an upcoming Indian Tamil-language vigilante action film directed by S. Shankar, who wrote the screenplay with B. Jeyamohan, Kabilan Vairamuthu, and Lakshmi Saravana Kumar. The film is jointly produced by Lyca Productions and Red Giant Movies. The sequel to Indian (1996), Kamal Haasan reprises his role as Senapathy, an ageing freedom fighter turned vigilante who fights against corruption, with Siddharth, S. J. Suryah, Rakul Preet Singh, Bobby Simha, Vivek, Priya Bhavani Shankar, Gulshan Grover, Samuthirakani and Nedumudi Venu in the ensemble cast.', '2024-07-12', '2024-07-25', '10:00:00', '16:00:00', '00:00:00', '2D', 'Action', 'G - Genera', 'https://youtu.be/kqGj31bQQQ0', '2024-07-12'),
	(21, 'KALKI 2898 AD', 'uploads/Kalki-ezgif.com-webp-to-jpg-converter.jpg', 'Kalki 2898 AD is an upcoming 2024 Indian epic dystopian science fiction action film written and directed by Nag Ashwin. Produced by C. Aswani Dutt under Vyjayanthi Movies, it was shot primarily in Telugu with some scenes re-shot in Hindi.Inspired by Hindu scriptures, the film is set in a post-apocalyptic world, in the year 2898 AD. The film features Prabhas in the lead role with an ensemble cast including Amitabh Bachchan, Kamal Haasan, Deepika Padukone, Disha Patani, and Brahmanandam in prominent roles.', '2024-06-27', '2024-07-05', '04:30 PM', '10:00 PM', NULL, '3D', 'Sci-Fi', 'G - Genera', 'https://youtu.be/BfCIPsEGAS8', '2024-06-27');

-- Dumping structure for table savoy_cinema.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table savoy_cinema.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `password`, `created_at`) VALUES
	(1, 'Mohommed Najad', 'perfection0953@gmail.com', '0769068534', '$2y$10$ONSRlXHCceKTL60sNDM4g.WCgBx4ZIDYx45WEFzB8h02QDvDpt14y', '2024-06-13 16:52:46'),
	(10, 'Panditha Upeksha', 'upeksha123@gmail.com', '0712626261', '$2y$10$Vzwr2GuVdjTkYkRToCAwXOxfDCPDN1gzsMx1Ec2HeDDvzrIdlN5AK', '2024-06-23 14:29:52'),
	(11, 'Randunu', 'randy123@gmail.com', '0772223333', '$2y$10$WTqCaoUpSED8hZL71HExyOPNuJNHFiY1iIGEDY5G6T5QpWbDsesEq', '2024-06-23 14:37:17'),
	(12, 'Kasun Piyumal', 'kasun123@gmail.com', '0772224444', '$2y$10$JGsr0k/rPOjG0vcrW7hJ0utdW1CMciR3qoC88EfOR4R8nQbC3OQ3W', '2024-06-23 14:39:33'),
	(13, 'Chalani Maduwanthi', 'chalani123@gmail.com', '0777666888', '$2y$10$3hjVHpFc3Sx62PbPa.R9rej1/0arry2R4XvkPVRUX4LMT9CoEfgJ2', '2024-06-23 14:41:35');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
