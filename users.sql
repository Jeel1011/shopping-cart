-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 04:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_jeelp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmPassword` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `mobile`, `email`, `password`, `confirmPassword`, `registration_date`) VALUES
(1, 'Jeelpatel10', '9876543211', 'jeel10@gmail.com', '$2y$10$7hb0/yhAmfWjYfWJxsGJYuWon/KyYmkLV/hvR75VQh2otYP8LnwDW', '$2y$10$NBhOcXGXHIYBZ3KHITui6u6O1L0X4Qka9ANsP0dbONDrlyziCdRfW', '2024-04-04 14:29:19'),
(2, 'miralpatel14', '9157253765', 'miralpatel10@gmail.com', '$2y$10$ZvKsNyeaXIv8KjF8tbYoFegQh6eaj.LSRSoIHAKTdwu4dVRlej0SS', '$2y$10$AG/DK8BYsPT7itPS7PiINOrQrwQTdBg2li0nTLUq7oUHaS249EqT2', '2024-04-04 14:30:19'),
(3, 'pinkalrathod10', '9237948723', 'pinkal10@gmail.com', '$2y$10$KHhLaLODhxrOCwBL5R1.we6Gn6Sszo6rY0RdjJPjQ/jJLGaDadopq', '$2y$10$d/lM6hxipGieB8PErD/GxO4QV9jrGAtvwQzIhjqdIL2AMK.AIQE06', '2024-04-04 14:30:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
