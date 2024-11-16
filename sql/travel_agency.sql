

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

-- --------------------------------------------------------



DROP TABLE IF EXISTS `payments`;
DROP TABLE IF EXISTS `accommodations`;
DROP TABLE IF EXISTS `feedback`;
DROP TABLE IF EXISTS `reservations`;
DROP TABLE IF EXISTS `transportation`;
DROP TABLE IF EXISTS `travelpackages`;
DROP TABLE IF EXISTS `clients`;
DROP TABLE IF EXISTS `loyaltyprograms`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `accommodations` (
  `accommodation_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `accommodation_type` enum('hotel','hostel','resort') NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `travel_preferences` text DEFAULT NULL,
  `loyalty_program_id` int(11) DEFAULT NULL,
  `last_reservation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `feedback_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `loyaltyprograms` (
  `loyalty_program_id` int(11) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `required_trip_number` int(8) NOT NULL,
  `color_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `payment_method` enum('credit_card','bank_transfer','cash') NOT NULL,
  `payment_status` enum('pending','completed','refunded') NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------



CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `reservation_date` datetime DEFAULT current_timestamp(),
  `number_of_travelers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `transportation` (
  `transportation_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `mode_of_transport` enum('airplane','train','bus','car_rental') NOT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------



CREATE TABLE `travelpackages` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `itinerary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isStaff` BOOLEAN DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`accommodation_id`),
  ADD KEY `package_id` (`package_id`);


ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `loyalty_program_id` (`loyalty_program_id`);


ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `reservation_id` (`reservation_id`);


ALTER TABLE `loyaltyprograms`
  ADD PRIMARY KEY (`loyalty_program_id`);


ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `reservation_id` (`reservation_id`);


ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `package_id` (`package_id`);


ALTER TABLE `transportation`
  ADD PRIMARY KEY (`transportation_id`),
  ADD KEY `package_id` (`package_id`);


ALTER TABLE `travelpackages`
  ADD PRIMARY KEY (`package_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `accommodations`
  MODIFY `accommodation_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;



ALTER TABLE `loyaltyprograms`
  MODIFY `loyalty_program_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `transportation`
  MODIFY `transportation_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `travelpackages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `accommodations`
  ADD CONSTRAINT `accommodations_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `travelpackages` (`package_id`) ON DELETE CASCADE;


ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`loyalty_program_id`) REFERENCES `loyaltyprograms` (`loyalty_program_id`) ON DELETE SET NULL;


ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE;


ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE;


ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `travelpackages` (`package_id`) ON DELETE CASCADE;


ALTER TABLE `transportation`
  ADD CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `travelpackages` (`package_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
