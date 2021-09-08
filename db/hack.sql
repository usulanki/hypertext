-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2021 at 11:05 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hack`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE `menu_master` (
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `menu_rank` decimal(10,2) NOT NULL,
  `item_type` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_sublink` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_icon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_id`, `parent_id`, `menu_name`, `menu_link`, `is_active`, `menu_rank`, `item_type`, `menu_sublink`, `menu_icon`) VALUES
(1, 0, 'My Profile', 'my-profile', 1, '1.00', '1', '0', 'boy.png'),
(2, 0, 'Seat Bookings', 'seat-booking', 1, '2.00', '1', '0', 'office-desk.png'),
(3, 0, 'Attendance', 'attendance', 1, '3.00', '1', '0', 'accept.png'),
(4, 0, 'Book Meal', 'book-meal', 1, '4.00', '1', '0', 'meal.png'),
(5, 0, 'Coffee', 'coffee-booking', 1, '5.00', '1', '0', 'coffee-maker.png'),
(6, 0, 'Updates', 'updates', 1, '6.00', '1', '0', 'notification-bell.pn'),
(7, 0, 'My Awards', 'my-awards', 1, '7.00', '1', '0', 'awards.png'),
(8, 0, 'Employees', 'employees', 1, '8.00', '1', '0', 'team.png'),
(9, 0, 'Help Desk', 'help-desk', 1, '0.00', '1', '', 'desk.png');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_code` varchar(30) NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1' COMMENT '1=ative,0=inactive',
  `created_by` int(11) DEFAULT NULL COMMENT 'user_id of user_master',
  `created_ts` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL COMMENT 'user_id of user_master',
  `updated_ts` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`role_id`, `role_name`, `role_code`, `is_active`, `created_by`, `created_ts`, `updated_by`, `updated_ts`) VALUES
(1, 'Superadmin', '1', b'1', NULL, '0000-00-00 00:00:00', NULL, NULL),
(2, 'Company Admin', '1', b'1', NULL, '0000-00-00 00:00:00', NULL, '2021-08-07 09:05:47'),
(3, 'HR', '1', b'1', NULL, '0000-00-00 00:00:00', NULL, '2021-08-07 09:05:47'),
(4, 'Managers', '1', b'1', NULL, '0000-00-00 00:00:00', NULL, '2021-08-07 09:05:47'),
(5, 'Employee', '1', b'1', NULL, '0000-00-00 00:00:00', NULL, '2021-08-07 09:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` varchar(45) DEFAULT '1',
  `created_by` int(1) DEFAULT NULL,
  `created_ts` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_ts` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `role_id`, `is_active`, `created_by`, `created_ts`, `updated_by`, `updated_ts`) VALUES
(1, 'Udit', NULL, 'Sulanki', 'u.sulanki@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 5, '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `add_flag` int(2) DEFAULT 0,
  `edit_flag` int(2) DEFAULT 0,
  `delete_flag` int(2) DEFAULT 0,
  `download_flag` int(2) DEFAULT 0,
  `is_active` bit(1) DEFAULT b'1' COMMENT '1 = active , inactive = 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`permission_id`, `role_id`, `menu_id`, `add_flag`, `edit_flag`, `delete_flag`, `download_flag`, `is_active`) VALUES
(1, 5, 1, 0, 0, 0, 0, b'1'),
(8, 5, 2, 0, 0, 0, 0, b'1'),
(9, 5, 3, 0, 0, 0, 0, b'1'),
(10, 5, 4, 0, 0, 0, 0, b'1'),
(11, 5, 5, 0, 0, 0, 0, b'1'),
(12, 5, 6, 0, 0, 0, 0, b'1'),
(13, 5, 7, 0, 0, 0, 0, b'1'),
(14, 5, 8, 0, 0, 0, 0, b'1'),
(15, 5, 9, 0, 0, 0, 0, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_master`
--
ALTER TABLE `menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
