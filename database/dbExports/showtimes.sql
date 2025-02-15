SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `showtimes` (
  `showtime_id` bigint(20) UNSIGNED NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `screenroom_id` int(10) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `showtimes` (`showtime_id`, `show_date`, `show_time`, `screenroom_id`, `movie_id`) VALUES
(1, '2025-02-29', '20:00:00', 1, 1),
(2, '2025-02-29', '16:00:00', 2, 2),
(3, '2025-02-29', '20:00:00', 3, 4),
(4, '2025-02-29', '16:30:00', 4, 3),
(5, '2025-02-29', '21:30:00', 4, 3),
(6, '2025-04-29', '16:00:00', 3, 4);

ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtime_id`),
  ADD KEY `showtimes_ibfk_1` (`movie_id`),
  ADD KEY `showtimes_ibfk_2` (`screenroom_id`);

ALTER TABLE `showtimes`
  MODIFY `showtime_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`screenroom_id`) REFERENCES `screenrooms` (`screenroom_id`) ON DELETE CASCADE;
COMMIT;