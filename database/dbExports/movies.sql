-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 18, 2025 at 07:24 PM
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
-- Database: `theatrebookingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `director` varchar(255) NOT NULL,
  `cast` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `tarief_single_normaal` int(5) NOT NULL,
  `tarief_single_korting` int(5) NOT NULL,
  `tarief_duo_normaal` int(5) NOT NULL,
  `tarief_duo_korting` int(5) NOT NULL,
  `release_date` date NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `trailer_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`, `duration`, `director`, `cast`, `genre`, `tarief_single_normaal`, `tarief_single_korting`, `tarief_duo_normaal`, `tarief_duo_korting`, `release_date`, `image_url`, `trailer_url`) VALUES
(1, 'Interstellar', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.', 169, 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'Adventure Epic, Drama', 1760, 1660, 2060, 1960, '2014-11-05', 'interstellar.jpg', NULL),
(2, 'Vaiana 2', 'After receiving an unexpected call from her wayfinding ancestors, Moana must journey to the far seas of Oceania and into dangerous, long-lost waters for an adventure unlike anything she\'s ever faced.', 160, 'David G. Derrick Jr., Jason Hand, Dana Ledoux Miller', 'Auli\'i Cravalho, Dwayne Johnson, Hualalai Chung', 'Animation', 1610, 1510, 1910, 1810, '2024-11-27', 'vaiana_2.jpg', NULL),
(3, 'The Dark Knight', 'When a menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman, James Gordon and Harvey Dent must work together to put an end to the madness.', 152, 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine, Morgan Freeman', 'Action Epic, Drama', 1810, 1710, 2110, 2010, '2008-07-23', 'the_dark_knight.jpg', NULL),
(4, 'Inglourious Basterds', 'In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner\'s vengeful plans for the same.', 153, 'Quentin Tarantino', 'Brad Pitt, Diane Kruger, Christoph Waltz, Michael Fassbender, Mélanie Laurent', 'Dark comedy, Drama, War', 1750, 1650, 2050, 1950, '2009-08-19', 'inglourious_basterds.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD UNIQUE KEY `movies_title_unique` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
