-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 11:34 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `movie_id` int(10) NOT NULL,
  `num_of_seats` int(5) NOT NULL,
  `status` enum('BOOKED','ARRIVED','CLOSED','') NOT NULL,
  `ref_number` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `staff_id`, `movie_id`, `num_of_seats`, `status`, `ref_number`, `created_at`, `modified_at`) VALUES
(1, 4, 1, 2, 1, 'ARRIVED', '#1PYT-HG', '2020-10-02 17:15:16', '2020-10-02 17:15:16'),
(2, 7, 1, 3, 5, 'ARRIVED', '#2GRP-FF', '2020-10-03 10:55:01', '2020-10-03 13:28:54'),
(3, 7, NULL, 2, 3, 'BOOKED', '#PMM0310-3', '2020-10-03 13:30:37', '2020-10-03 13:30:37'),
(4, 4, NULL, 3, 15, 'BOOKED', '#YHZ0710-4', '2020-10-07 08:03:40', '2020-10-07 08:03:40'),
(5, 1, NULL, 3, 12, 'BOOKED', '#SYD0710-5', '2020-10-07 08:19:51', '2020-10-07 08:19:51'),
(6, 1, NULL, 2, 1, 'BOOKED', '#ONO0710-6', '2020-10-07 08:41:27', '2020-10-07 08:41:27'),
(7, 6, NULL, 2, 1, 'BOOKED', '#LSO0710-7', '2020-10-07 09:06:31', '2020-10-07 09:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) NOT NULL,
  `genre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Horror'),
(2, 'Action'),
(4, 'Drama'),
(5, 'Sci-fi'),
(7, 'Adventure'),
(9, 'Comedy'),
(10, 'Zionite');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(10) NOT NULL,
  `hall` varchar(255) NOT NULL,
  `num_of_seats` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `hall`, `num_of_seats`) VALUES
(1, 'Exclame', 221),
(2, 'Yuri Morre', 545),
(3, 'Heaven\'s Hear', 300);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  `trailer_link` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `director` varchar(25) NOT NULL,
  `writer` varchar(255) NOT NULL,
  `stars` varchar(255) NOT NULL,
  `run_time` varchar(25) NOT NULL,
  `viewing_date` date NOT NULL,
  `viewing_time` time NOT NULL,
  `fee` decimal(10,0) NOT NULL,
  `num_available_seats` int(5) NOT NULL,
  `pg_rating` varchar(25) NOT NULL,
  `plot_keywords` varchar(255) NOT NULL,
  `genre_id` int(10) NOT NULL,
  `hall_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_date`, `trailer_link`, `image`, `description`, `director`, `writer`, `stars`, `run_time`, `viewing_date`, `viewing_time`, `fee`, `num_available_seats`, `pg_rating`, `plot_keywords`, `genre_id`, `hall_id`, `user_id`, `created_at`, `modified_at`) VALUES
(2, 'Remain', '2020-08-05', 'http://youtube.com', 'mv4.jpg', '<p>Remain watching...!:)</p>', 'Simon Jordan', 'Mark Seemin', 'Jackie Chan, Zang Zhi', '120mins', '2020-11-20', '08:00:00', '750', 254, 'PG-12', 'laugh, chill', 9, 1, 1, '2020-10-07 09:06:29', '2020-09-29 18:15:27'),
(3, 'Mystiken', '2020-11-04', 'http://youtube.com', 'mv2.jpg', '<p>An adventurous movie. Help Matt find the Gula...</p>', 'Zing Hei', 'Delali Paul', 'Crooner Teri, Sam Thompson', '150mins', '2021-02-05', '05:30:00', '750', 254, 'PG-12', 'search, adventure', 7, 3, 1, '2020-10-07 09:06:29', '2020-10-03 11:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `movie_casts`
--

CREATE TABLE `movie_casts` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `movie_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_casts`
--

INSERT INTO `movie_casts` (`id`, `name`, `role`, `movie_id`) VALUES
(1, 'John Melo', 'Stunt Man', 2);

-- --------------------------------------------------------

--
-- Table structure for table `movie_crews`
--

CREATE TABLE `movie_crews` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `movie_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_tags`
--

CREATE TABLE `movie_tags` (
  `id` int(10) NOT NULL,
  `tag` enum('SHOWING NOW','TODAY','LATEST','COMING SOON') NOT NULL,
  `movie_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_tags`
--

INSERT INTO `movie_tags` (`id`, `tag`, `movie_id`) VALUES
(1, 'COMING SOON', 2),
(2, 'SHOWING NOW', 2),
(3, 'LATEST', 3),
(4, 'COMING SOON', 3),
(5, 'TODAY', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_customer` tinyint(1) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `profile_photo`, `is_active`, `is_customer`, `is_staff`, `is_admin`, `last_login`, `created_at`, `modified_at`) VALUES
(1, 'mosiac05', 'obutemoses5@gmail.com', '4c527675e9130ae3a6f0eea1fd9acfe5', 'Moses', 'Obute', 'avatar.png', 1, 0, 1, 1, '2020-10-07 08:49:10', '2020-09-23 02:07:42', '2020-09-23 02:07:42'),
(3, 'ruthhart', 'ruth.hart@gmail.com', '66266e1d2f3c32e9b3f21f116aba5f84', 'Ruth', 'Hart', 'avatar.png', 1, 0, 1, 0, '2020-10-05 17:46:08', '2020-09-28 17:00:01', '2020-09-28 17:00:01'),
(4, 'john.bob', 'john.bob@gmail.com', 'eaea7928d3c0c10ce80be4f79222981b', 'John', 'Bob', 'avatar.png', 1, 0, 1, 0, '2020-10-07 08:05:16', '2020-09-28 22:38:03', '2020-09-28 22:38:03'),
(5, 'belemma', 'belemma@gmail.com', 'c4d1d0227d0036711c66d211aadd75fe', 'Bello', 'Emmanuel', 'avatar.png', 0, 1, 0, 0, '2020-09-28 23:27:12', '2020-09-28 23:24:36', '2020-09-28 23:24:36'),
(6, 'veekwin', 'veekwin@gmail.com', 'b13a4b4e57072c874b08d5cd1f9a007f', 'Victor', 'Onazi', 'avatar.png', 1, 0, 1, 1, '2020-09-29 00:19:41', '2020-09-29 00:19:41', '2020-09-29 00:19:41'),
(7, 'elijahbass', 'elijah.bassey@gmail.com', '01c3012a4b4c3a3ed2aeefefafa38cc5', 'Elijah', 'Bassey', 'avatar.png', 1, 1, 0, 0, '2020-10-06 17:48:09', '2020-10-02 08:51:02', '2020-10-02 13:41:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movies` (`hall_id`);

--
-- Indexes for table `movie_casts`
--
ALTER TABLE `movie_casts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movie_crews`
--
ALTER TABLE `movie_crews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movie_tags`
--
ALTER TABLE `movie_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movie_casts`
--
ALTER TABLE `movie_casts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_crews`
--
ALTER TABLE `movie_crews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_tags`
--
ALTER TABLE `movie_tags`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`),
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `movie_casts`
--
ALTER TABLE `movie_casts`
  ADD CONSTRAINT `movie_casts_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `movie_crews`
--
ALTER TABLE `movie_crews`
  ADD CONSTRAINT `movie_crews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `movie_tags`
--
ALTER TABLE `movie_tags`
  ADD CONSTRAINT `movie_tags_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
