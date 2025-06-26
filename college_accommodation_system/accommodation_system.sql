-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql107.byetcluster.com
-- Generation Time: Jun 25, 2025 at 10:02 PM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39316356_accommodation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `date_applied` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `student_id`, `college_id`, `notes`, `date_applied`, `status_id`, `status`) VALUES
(1, 1, 1, '', '2025-06-21', 3, 'rejected'),
(2, 1, 1, '', '2025-06-21', 3, 'rejected'),
(3, 1, 1, '', '2025-06-21', 3, 'rejected'),
(4, 1, 1, '', '2025-06-21', 2, 'approved'),
(5, 1, 1, '', '2025-06-21', 2, 'approved'),
(6, 1, 2, '', '2025-06-21', 2, 'approved'),
(7, 1, 2, '', '2025-06-21', 2, 'approved'),
(8, 1, 1, '', '2025-06-21', 3, 'rejected'),
(9, 1, 1, 'single room', '2025-06-25', 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int(11) NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `college_name`, `capacity`) VALUES
(1, 'Kolej Tun Dr Ismail', 48),
(2, 'Kolej Tunku Abdul Rahman', 40),
(3, 'Kolej Rahman Putra', 45);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `full_name`, `phone`, `address`) VALUES
(1, 1, 'Ali Bin Abu', '0111222333', 'alor gajah'),
(2, 2, 'Alice Manager', '0111222333', 'Manager Residence, Block A, Campus'),
(3, 3, 'admin bin mohamad amin', '0123456778', 'utm jb');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'student1', '$2y$10$umWHoMqoPAI55IzPgQfCxOvcL6Y/iKVoqYP6AwHfZyNU6xXq/21PK', 'student'),
(2, 'manager1', '$2y$10$umWHoMqoPAI55IzPgQfCxOvcL6Y/iKVoqYP6AwHfZyNU6xXq/21PK', 'manager'),
(3, 'admin', '$2y$10$umWHoMqoPAI55IzPgQfCxOvcL6Y/iKVoqYP6AwHfZyNU6xXq/21PK', 'admin'),
(4, 'admin2', '$2y$10$wuZDN/4r0QK5nPh1u/1JIOKoK12Jo0mjjpM0YDV/Epl5jnKqqRd7G', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `college_id` (`college_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
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
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
