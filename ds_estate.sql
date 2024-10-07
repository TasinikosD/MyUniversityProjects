-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Ιουν 2024 στις 17:12:28
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `ds_estate`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `images`
--

CREATE TABLE `images` (
  `id` int(255) DEFAULT 0,
  `photoname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `images`
--

INSERT INTO `images` (`id`, `photoname`, `image`) VALUES
(1, 'ακινητο1.1.jpg', 'images/ακινητο1.1.jpg'),
(1, 'ακινητο1.2.jpg', 'images/ακινητο1.2.jpg'),
(1, 'ακινητο1.3.jpg', 'images/ακινητο1.3.jpg'),
(1, 'ακινητο1.4.jpg', 'images/ακινητο1.4.jpg'),
(1, 'ακινητο1.5.jpg', 'images/ακινητο1.5.jpg'),
(2, '120101_908484_fullscreen.jpg', 'images/120101_908484_fullscreen.jpg'),
(2, '120105_726435_fullscreen.jpg', 'images/120105_726435_fullscreen.jpg'),
(2, '120108_123847_fullscreen.jpg', 'images/120108_123847_fullscreen.jpg'),
(2, '120110_553767_fullscreen.jpg', 'images/120110_553767_fullscreen.jpg'),
(2, '120112_733598_fullscreen.jpg', 'images/120112_733598_fullscreen.jpg'),
(2, '120114_121152_fullscreen.jpg', 'images/120114_121152_fullscreen.jpg'),
(2, '120117_938313_fullscreen.jpg', 'images/120117_938313_fullscreen.jpg'),
(2, '120119_731487_fullscreen.jpg', 'images/120119_731487_fullscreen.jpg'),
(2, '120121_673242_fullscreen.jpg', 'images/120121_673242_fullscreen.jpg'),
(2, '120123_693016_fullscreen.jpg', 'images/120123_693016_fullscreen.jpg'),
(2, '120128_010789_fullscreen.jpg', 'images/120128_010789_fullscreen.jpg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `listings`
--

CREATE TABLE `listings` (
  `Τίτλος` varchar(255) NOT NULL,
  `Περιοχή` varchar(255) NOT NULL,
  `Πλήθος_δωματίων` varchar(255) NOT NULL,
  `Τιμή_ανά_διανυκτέρευση` varchar(255) NOT NULL,
  `id` int(255) DEFAULT NULL,
  `USER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `listings`
--

INSERT INTO `listings` (`Τίτλος`, `Περιοχή`, `Πλήθος_δωματίων`, `Τιμή_ανά_διανυκτέρευση`, `id`, `USER`) VALUES
('Διαμέρισμα ογδόντα τ.μ.', 'Μαρούσι,Αττικής', '2', '75', 1, 'TASINIKOS'),
('Διαμέρισμα εκατό τ.μ.', 'Διόνυσος,Αττικής', '3', '100', 2, 'GPAP');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservations`
--

CREATE TABLE `reservations` (
  `ημερομηνια_εναρξης` date NOT NULL,
  `ημερομηνια_ληξης` date NOT NULL,
  `ονομα` varchar(255) NOT NULL,
  `επιθετο` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `USER` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `reservations`
--

INSERT INTO `reservations` (`ημερομηνια_εναρξης`, `ημερομηνια_ληξης`, `ονομα`, `επιθετο`, `Email`, `USER`, `id`, `price`) VALUES
('2024-08-10', '2024-08-25', 'ΓΙΩΡΓΟΣ', 'ΠΑΠΑΔΟΠΟΥΛΟΣ', 'gpap@gmail.com', 'GPAP', 1, 978.75),
('2024-07-20', '2024-08-20', 'ΔΗΜΗΤΡΗΣ', 'ΤΑΣΗΝΙΚΟΣ', 'tastas757@gmail.com', 'TASINIKOS', 2, 2325);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `Όνομα` varchar(255) NOT NULL,
  `Επώνυμο` varchar(255) NOT NULL,
  `nameuser` varchar(255) NOT NULL,
  `kwdikos` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`Όνομα`, `Επώνυμο`, `nameuser`, `kwdikos`, `Email`) VALUES
('ΔΗΜΗΤΡΗΣ', 'ΤΑΣΗΝΙΚΟΣ', 'TASINIKOS', '1234', 'tastas757@gmail.com'),
('ΓΙΩΡΓΟΣ', 'ΠΑΠΑΔΟΠΟΥΛΟΣ', 'GPAP', '1234', 'gpap@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
