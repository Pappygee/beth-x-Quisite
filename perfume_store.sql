-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 07:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfume_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`) VALUES
(1, 'Body Spray'),
(5, 'Combo'),
(2, 'Perfume'),
(4, 'Perfume Oil'),
(3, 'Roll On');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `collection_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `collection_id`, `created_at`) VALUES
(15, 'Supemacy', 12500.00, 'Incense | Noir | In out', 'uploads/prod_68d98f8e0651e0.38264329.jpg', 2, '2025-09-28 19:42:06'),
(16, 'Yum Yum', 9500.00, 'Armaf Delights | vanilla', 'uploads/prod_68d991b4658688.47417729.jpg', 1, '2025-09-28 19:51:16'),
(17, 'Explore', 6000.00, 'Cool | spray', 'uploads/prod_68d99257b66660.73670416.jpg', 1, '2025-09-28 19:53:59'),
(18, 'Elixir', 6500.00, 'Atralia', 'uploads/prod_68d992f0e2d112.93553972.jpg', 2, '2025-09-28 19:56:32'),
(19, 'Yum Yum', 1500.00, 'YumYum perfume oil spray', 'uploads/prod_68d9934d7b34c6.71045853.jpg', 4, '2025-09-28 19:58:05'),
(20, 'T A C', 6500.00, 'Ultra Dry | Cool Breeze', 'uploads/prod_68d993ddb20cd8.54576989.jpg', 3, '2025-09-28 20:00:29'),
(21, 'T A C', 6500.00, 'Ultra Dry | Fresh Mint', 'uploads/prod_68d994175c40b2.86374074.jpg', 3, '2025-09-28 20:01:27'),
(22, 'Combo', 13500.00, 'Mosuf | Perfume oil | Genic | FA', 'uploads/prod_68d994aa1ff1a3.85809266.jpg', 5, '2025-09-28 20:03:54'),
(23, 'Billionaire', 17500.00, 'Body Spray | Perfume | Perfume Oil', 'uploads/prod_68d99527c99af0.97997305.jpg', 5, '2025-09-28 20:05:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
