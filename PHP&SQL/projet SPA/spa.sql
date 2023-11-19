-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2023 at 02:29 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `spa_animal`
--

CREATE TABLE `spa_animal` (
  `id_animal` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `image` text NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spa_animal`
--

INSERT INTO `spa_animal` (`id_animal`, `nom`, `type`, `age`, `image`, `date_add`) VALUES
(76, 'de', 'Race Inconnue', 23, 'fighting-dogs-dogs.gif', '2023-11-17 15:20:36'),
(77, 'friscourt', 'lapin', 12, 'flawless.png', '2023-11-17 15:21:10'),
(78, 'test', 'Race Inconnue', 23, 'images.jpg', '2023-11-17 15:23:39'),
(79, 'friscourt', 'Race Inconnue', 10, 'istockphoto-175514100-612x612.jpg', '2023-11-17 15:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `spa_users`
--

CREATE TABLE `spa_users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `secret` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spa_users`
--

INSERT INTO `spa_users` (`id`, `pseudo`, `email`, `code`, `secret`) VALUES
(1, 'LeFi', 'felix31320@gmail.com', 'SFedd7e1ae16210021f2be8d648763621549f82beb2021', '057f18a58c8f21f8a39260f87f2c0d8a15d449af17000825031700082503'),
(2, 'test', 'test@gmail.com', 'SF4c8ec5d6824ba3942d9d872f69dfccf2e91481772021', 'b17b4727008e93fa5cdd72b186f8508f7479838a17002302881700230288');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `spa_animal`
--
ALTER TABLE `spa_animal`
  ADD PRIMARY KEY (`id_animal`);

--
-- Indexes for table `spa_users`
--
ALTER TABLE `spa_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `spa_animal`
--
ALTER TABLE `spa_animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `spa_users`
--
ALTER TABLE `spa_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
