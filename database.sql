-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 04:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

CREATE database `database`;
USE `database`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment 4_olufemi ojeyemi`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `card` varchar(20) DEFAULT NULL,
  `expiry_month` varchar(20) DEFAULT NULL,
  `expiry_year` varchar(4) DEFAULT NULL,
  `products_json` text DEFAULT NULL,
  `tax_percentage` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `postcode`, `address`, `province`, `password`, `card`, `expiry_month`, `expiry_year`, `products_json`, `tax_percentage`, `tax`, `total_price`) VALUES
(94, 'Femi', 'femi@gmail.com', '1231231234', 'L9T 2N2', '49 SB Abubakar Avenue, NAF Valley Estate, Asokoro, Abuja, Nigeria', 'ON', '1', '1111-1111-1111-1111', 'MAY', '2024', '[{\"name\":\"Amazon Gift Card\",\"price\":10,\"quantity\":\"1\"},{\"name\":\"Apple Gift Card\",\"price\":15,\"quantity\":\"1\"}]', 13.00, 3.25, 28.25),
(95, 'Tolu', 'tolu@gmail.com', '1231231234', '900231', '49 SB Abubakar Avenue, NAF Valley Estate, Asokoro, Abuja, Nigeria', 'SK', '1', '1111-1111-1111-1111', 'MAY', '2024', '[{\"name\":\"Amazon Gift Card\",\"price\":10,\"quantity\":\"1\"},{\"name\":\"Apple Gift Card\",\"price\":15,\"quantity\":\"1\"},{\"name\":\"Playstation Gift Card\",\"price\":20,\"quantity\":\"2\"}]', 6.00, 3.90, 68.90),
(96, 'Tosin', 'tosin@gmail.com', '1231231234', '900231', '49 SB Abubakar Avenue, NAF Valley Estate, Asokoro, Abuja, Nigeria', 'BC', '1', '1111-1111-1111-1111', 'MAY', '2024', '[{\"name\":\"Amazon Gift Card\",\"price\":10,\"quantity\":\"2\"},{\"name\":\"Apple Gift Card\",\"price\":15,\"quantity\":\"3\"},{\"name\":\"Playstation Gift Card\",\"price\":20,\"quantity\":\"4\"},{\"name\":\"Spotify Gift Card\",\"price\":25,\"quantity\":\"5\"}]', 12.00, 32.40, 302.40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'femi', '1234', 'manager'),
(12, 'tolu', '1234', 'manager'),
(13, 'tosin', '1234', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
