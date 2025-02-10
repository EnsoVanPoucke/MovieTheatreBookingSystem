-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 11:44 PM
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
-- Database: `testproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `screenrooms`
--

CREATE TABLE `screenrooms` (
  `screenroom_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `row_count` int(4) DEFAULT NULL,
  `col_count` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `screenrooms`
--

INSERT INTO `screenrooms` (`screenroom_id`, `name`, `description`, `row_count`, `col_count`) VALUES
(1, 'Room 1', 'Large theater room.', 16, NULL),
(2, 'Room 2', 'Large theatre room.', 17, NULL),
(3, 'Room 3', 'Medium theatre room.', 13, NULL),
(4, 'Room 4', 'Medium theatre room.', 13, NULL),
(5, 'Room 5', 'Small theatre room.', 12, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `screenrooms`
--
ALTER TABLE `screenrooms`
  ADD PRIMARY KEY (`screenroom_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `screenrooms`
--
ALTER TABLE `screenrooms`
  MODIFY `screenroom_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
