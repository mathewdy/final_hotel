-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 06:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '2fb8eddb850f05097cd730de7da46b9d');

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `guest` varchar(20) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`id`, `room_id`, `users_id`, `guest`, `check_in`, `check_out`, `added_on`) VALUES
(1, 1, 1, '1', '2021-10-28 00:00:00', '2021-10-30 00:00:00', '2021-10-08 12:13:58'),
(2, 1, 1, '1', '2021-10-28 00:00:00', '2021-10-30 00:00:00', '2021-10-08 12:14:06'),
(3, 1, 1, '1', '2021-10-28 00:00:00', '2021-10-30 00:00:00', '2021-10-08 12:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `id_info`
--

CREATE TABLE `id_info` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `image` blob NOT NULL,
  `users_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_info`
--

INSERT INTO `id_info` (`id`, `id_type`, `number`, `image`, `users_id`, `added_on`) VALUES
(1, 1, '321654', 0x436170747572652e504e47, 1, '2021-10-07 01:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `id_types`
--

CREATE TABLE `id_types` (
  `id` int(11) NOT NULL,
  `name_of_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_types`
--

INSERT INTO `id_types` (`id`, `name_of_id`) VALUES
(1, 'sss'),
(2, 'umid'),
(3, 'driver`s license'),
(4, 'professional id');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name_package` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name_package`, `description`) VALUES
(1, 'Junior', 'Free breakfast with a satisfying amenities'),
(2, 'Senior', 'Free breakfast,lunch, with kitchen facilities and pool'),
(3, 'Veteran', 'Free breakfast lunch and a dinner with a kitchen facilities pool and a beverages of your choice');

-- --------------------------------------------------------

--
-- Table structure for table `proof_of_transaction`
--

CREATE TABLE `proof_of_transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proof_of_transaction`
--

INSERT INTO `proof_of_transaction` (`id`, `user_id`, `image`, `bank`, `added_on`, `room_id`, `status`) VALUES
(1, 1, 'Capture.PNG', 'BPI', '2021-10-07 17:35:41', 10, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type_id`, `status`) VALUES
(1, '101', 1, 'reserved'),
(2, '102', 3, 'occupied'),
(3, '103', 3, 'reserved'),
(4, '104', 2, 'available'),
(5, '105', 1, 'reserved'),
(6, '106', 1, 'available'),
(7, '107', 2, 'available'),
(8, '108', 2, 'available'),
(9, '109', 3, 'available'),
(10, '110', 1, 'available'),
(11, '201', 2, 'available'),
(12, '202', 2, 'available'),
(13, '203', 1, 'available'),
(14, '204', 3, 'available'),
(15, '205', 3, 'available'),
(16, '206', 2, 'available'),
(17, '207', 1, 'available'),
(18, '208', 2, 'available'),
(19, '209', 1, 'available'),
(20, '210', 3, 'available'),
(21, '301', 2, 'available'),
(22, '302', 1, 'available'),
(23, '303', 3, 'available'),
(24, '304', 2, 'available'),
(25, '305', 3, 'reserved'),
(26, '306', 2, 'available'),
(27, '307', 1, 'available'),
(28, '308', 3, 'available'),
(29, '309', 1, 'available'),
(30, '310', 3, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name_of_room` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name_of_room`, `price`, `image`, `package_id`) VALUES
(1, 'economy', 2, 'economy_room.png', 1),
(2, 'deluxe', 4, 'deluxe_room.png', 2),
(3, 'executive', 6, 'executive_room.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account_id` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_status` int(11) NOT NULL,
  `v_code` varchar(30) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_id`, `first_name`, `last_name`, `email`, `email_status`, `v_code`, `mobile_number`, `added_on`) VALUES
(1, '762110070', 'mathew1', 'dy', 'mathewdalisay@gmail.com', 1, 'd92449bf128ffbe67419ddb07f63dd', '09156915704', '2021-10-07 01:18:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `id_info`
--
ALTER TABLE `id_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id` (`users_id`),
  ADD KEY `clients_id` (`users_id`),
  ADD KEY `users_id_2` (`users_id`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `id_types`
--
ALTER TABLE `id_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proof_of_transaction`
--
ALTER TABLE `proof_of_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_info`
--
ALTER TABLE `id_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `id_types`
--
ALTER TABLE `id_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proof_of_transaction`
--
ALTER TABLE `proof_of_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
