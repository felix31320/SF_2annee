-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2023 at 09:29 AM
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
-- Database: `bitly`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `shortcut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `shortcut`) VALUES
(1, 'https://www.warp-worlds.com/', '16Wr5gJn/6CVc'),
(2, 'https://kinsta.com/fr/base-de-connaissances/mamp-http-erreur-500/', '16Wr5gJn/6CVc'),
(3, 'https://club.tklacademy.com/home', '16Wr5gJn/6CVc'),
(4, 'https://www.tklacademy.com//login.php', '16Wr5gJn/6CVc'),
(5, 'https://www.twitch.tv/', '19Fu6fW4t2YOY'),
(6, 'https://www.youtube.com/', '25cTuMJZn.m6Y'),
(7, 'https://twitter.com/home?lang=fr', '18kLHcvvCc0Xc'),
(8, 'https://localhost/?q=18kLHcvvCc0Xc', '18kLHcvvCc0Xc'),
(9, 'https://www.w3schools.com/', '11P3PA2QFXOco'),
(10, 'https://translate.google.com/', '16Wr5gJn/6CVc'),
(11, 'https://www.bloomberg.com/europe', '13OaByZFgJ45I'),
(12, 'https://www.zonebourse.com/', '17lgkPGNgGcpc'),
(13, 'https://fr.investing.com/', '10K9LuwruHkMk'),
(14, 'https://app.october.eu/login', '20q26OlsSaPR2'),
(15, 'https://openclassrooms.com/fr/', '11P3PA2QFXOco'),
(16, 'https://m3.material.io/', '10K9LuwruHkMk'),
(17, 'https://www.mintos.com/en/', '19Fu6fW4t2YOY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
