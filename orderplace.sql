-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 04:42 PM
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
-- Table structure for table `orderplace`
--

CREATE TABLE `orderplace` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderplace`
--

INSERT INTO `orderplace` (`id`, `user_id`, `username`, `email`, `product_id`, `product_name`, `product_img`, `quantity`, `price`, `total`, `created_at`) VALUES
(1, 1, 'Jeelpatel10', 'jeel10@gmail.com', 8, 'Nokia G310', 'nokia-g310.jpg', 1, '299.99', '299.99', '2024-04-04 14:36:03'),
(2, 1, 'Jeelpatel10', 'jeel10@gmail.com', 24, 'Google Pixel 8 Pro', 'google-pixel-8-pro.jpg', 2, '999.99', '1999.98', '2024-04-04 14:37:13'),
(3, 2, 'miralpatel14', 'miralpatel10@gmail.com', 3, 'Apple iPhone 15 Pro', 'apple-iphone-15-pro.jpg', 1, '1299.99', '1299.99', '2024-04-04 14:38:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderplace`
--
ALTER TABLE `orderplace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderplace`
--
ALTER TABLE `orderplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderplace`
--
ALTER TABLE `orderplace`
  ADD CONSTRAINT `orderplace_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orderplace_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
