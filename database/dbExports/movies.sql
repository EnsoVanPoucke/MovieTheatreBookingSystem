-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2025 at 12:22 PM
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `director` varchar(255) NOT NULL,
  `cast` text NOT NULL,
  `genre` text NOT NULL,
  `duration` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `poster_url` text NOT NULL,
  `trailer_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `director`, `cast`, `genre`, `duration`, `release_date`, `poster_url`, `trailer_url`, `created_at`, `updated_at`) VALUES
(1, 'The Dark Knight', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'Action, Crime, Drama', 152, '2008-07-18', 'the_dark_knight.jpg', '#', '2025-02-20 13:00:00', NULL),
(2, 'Vaiana 2', 'After receiving an unexpected call from her wayfinding ancestors, Moana must journey to the far seas of Oceania and into dangerous, long-lost waters for an adventure unlike anything she\'s ever faced.', 'David G. Derrick Jr., Jason Hand, Dana Ledoux Miller', 'Auli\'i Cravalho, Dwayne Johnson, Hualalai Chung', 'Animation', 160, '2024-11-27', 'vaiana_2.jpg', '#', '2025-02-20 13:00:00', NULL),
(3, 'Interstellar', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'Adventure Epic, Drama', 169, '2014-11-05', 'interstellar.jpg', '#', '2025-02-20 13:00:00', NULL),
(4, 'Inglourious Basterds', 'In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner\\\'s vengeful plans for the same.', 'Quentin Tarantino', 'Brad Pitt, Diane Kruger, Christoph Waltz, Michael Fassbender, Mélanie Laurent', 'Dark comedy, Drama, War', 153, '2009-08-19', 'inglourious_basterds.jpg', '#', '2025-02-20 13:00:00', NULL),
(5, 'Patsers', 'Patser PATSER vertelt het waanzinnige verhaal van vier vrienden op ‘t Kiel in Antwerpen die ervan dromen om te leven als echte patsers. Ze stoppen hun neus in highprofile drugszaken en ontketenen zo een bendeoorlog van Antwerpen tot Amsterdam, en zelfs Colombia. Patsers In de straten van Antwerpen proberen Badia, Junes en Volt zich los te rukken van hun bewogen verleden, terwijl de onderwereld hen één voor één onverbiddelijk terugtrekt. Adamo heeft zich opgewerkt tot een van de meest invloedrijke figuren in de Antwerpse drugshandel en raakt steeds dieper verstrikt in een web van macht en gevaar. Zijn vrienden moeten een keuze maken: trouw blijven aan Adamo of kiezen voor de veiligheid van zichzelf en hun dierbaren. Ze ontdekken dat het verleden hen niet zomaar loslaat — en dat de prijs voor vrijheid hoger is dan ze ooit hadden verwacht.', 'Adil El Arbi, Bilall Fallah', 'Matteo Simoni, Nora Gharib, Junes Lazaar, Saïd Boumazoughe, Pommelien Thijs, Jennifer Heylen', 'Action, thriller', 126, '2025-02-22', 'patsers.jpg', '#', '2025-02-20 13:00:00', NULL),
(6, 'The Brutalist', 'De visionaire architect László Toth ontvlucht het naoorlogse Europa en komt aan in Amerika om zijn leven, zijn werk en zijn huwelijk met zijn vrouw Erzsébet opnieuw op te bouwen nadat hij tijdens de oorlog uit elkaar werd gedreven door verschuivende grenzen en regimes. In zijn eentje in een vreemd nieuw land vestigt László zich in Pennsylvania, waar de rijke en prominente industrieel Harrison Lee Van Buren zijn bouwtalent herkent. Maar macht en nalatenschap komen ten koste van een zware prijs... Opgelet: deze film bevat een geïntegreerde pauze van 15 minuten.', 'Brady Corbet', 'Guy Pearce, Felicity Jones, Adrien Brody', 'Drama', 215, '2025-02-05', 'the_brutalist.jpg', '#', '2025-02-20 13:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movies_title_unique` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
