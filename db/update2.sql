-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2021 at 12:18 AM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-52+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackv1`
--
INSERT INTO `companies` (`company_id`, `company_name`, `company_admin_user_id`, `company_created_by_user_id`, `company_status`, `company_validity_start_date`, `company_validity_end_date`, `created_at`, `updated_at`) VALUES
(1, 'Impelsys', 1, 1, 'ACTIVE', '2021-08-15', '2021-09-15', '2021-08-15 00:00:00', '2021-08-15 00:00:00');
-- --------------------------------------------------------

--
-- Table structure for table `building_floors`
--

CREATE TABLE `building_floors` (
  `floor_id` int(11) NOT NULL,
  `floor_name` varchar(200) NOT NULL,
  `building_id` int(11) NOT NULL,
  `floor_status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building_floors`
--

INSERT INTO `building_floors` (`floor_id`, `floor_name`, `building_id`, `floor_status`, `created_at`, `updated_at`) VALUES
(1, '1st Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(2, '2nd Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(3, '2nd Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(4, '4th Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(5, '5th Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(6, '6th Floor', 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(7, '6th Floor', 2, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00');

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `company_buildings`
--

CREATE TABLE `company_buildings` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `building_status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_buildings`
--

INSERT INTO `company_buildings` (`building_id`, `building_name`, `company_id`, `location_id`, `building_status`, `created_at`, `updated_at`) VALUES
(1, 'Suryodai complex', 1, 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(2, 'Golden Tower', 1, 1, 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_address` text NOT NULL,
  `location_status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_address`, `location_status`, `created_at`, `updated_at`) VALUES
(1, 'Banglore,karnataka', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(2, 'Manglore,Karnataka', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `floor_id`, `room_status`, `room_capacity`, `created_at`, `updated_at`) VALUES
(1, 'Main Room', 6, 'ACTIVE', 40, '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(2, 'Conference Room', 6, 'ACTIVE', 15, '2021-08-18 00:00:00', '2021-08-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `seat_code` varchar(200) NOT NULL,
  `seat_status` enum('ACTIVE','INACTIVE','DELETED','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `floor_id`, `room_id`, `seat_code`, `seat_status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'PTL-1', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(2, 6, 1, 'PTL-2', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(3, 6, 1, 'PTL-3', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(4, 6, 1, 'PTL-4', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(5, 6, 1, 'PTL-5', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(6, 6, 1, 'PTL-6', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(7, 6, 1, 'PTL-7', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(8, 6, 1, 'PTL-8', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(9, 6, 1, 'PTL-9', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(10, 6, 1, 'PTL-10', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(11, 6, 1, 'PTL-11', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(12, 6, 1, 'PTL-12', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(13, 6, 1, 'PTL-13', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(14, 6, 1, 'PTL-14', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(15, 6, 1, 'PTL-15', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(16, 6, 1, 'PTL-16', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(17, 6, 1, 'PTL-17', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(18, 6, 1, 'PTL-18', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(19, 6, 1, 'PTL-19', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(20, 6, 1, 'PTL-20', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(21, 6, 1, 'PTL-21', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(22, 6, 1, 'PTL-22', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(23, 6, 1, 'PTL-23', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(24, 6, 1, 'PTL-24', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(25, 6, 1, 'PTL-25', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(26, 6, 1, 'PTL-26', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(27, 6, 1, 'PTL-27', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(28, 6, 1, 'PTL-28', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(29, 6, 1, 'PTL-29', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(30, 6, 1, 'PTL-30', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(31, 6, 1, 'PTL-31', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(32, 6, 1, 'PTL-32', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(33, 6, 1, 'PTL-33', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(34, 6, 1, 'PTL-34', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(35, 6, 1, 'PTL-35', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(36, 6, 1, 'PTL-36', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(37, 6, 1, 'PTL-37', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(38, 6, 1, 'PTL-38', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(39, 6, 1, 'PTL-39', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00'),
(40, 6, 1, 'PTL-40', 'ACTIVE', '2021-08-18 00:00:00', '2021-08-18 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_floors`
--
ALTER TABLE `building_floors`
  ADD PRIMARY KEY (`floor_id`),
  ADD KEY `building_floor_fk` (`building_id`);

--
-- Indexes for table `company_buildings`
--
ALTER TABLE `company_buildings`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `company_buildings_fk` (`company_id`),
  ADD KEY `company_building_location_fk` (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rooms_floor_fk` (`floor_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `seats_floor_id_fk` (`floor_id`),
  ADD KEY `seats_room_id_fk` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building_floors`
--
ALTER TABLE `building_floors`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_buildings`
--
ALTER TABLE `company_buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `building_floors`
--
ALTER TABLE `building_floors`
  ADD CONSTRAINT `building_floor_fk` FOREIGN KEY (`building_id`) REFERENCES `company_buildings` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_buildings`
--
ALTER TABLE `company_buildings`
  ADD CONSTRAINT `company_building_location_fk` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_buildings_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_floor_fk` FOREIGN KEY (`floor_id`) REFERENCES `building_floors` (`floor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_floor_id_fk` FOREIGN KEY (`floor_id`) REFERENCES `building_floors` (`floor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seats_room_id_fk` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
