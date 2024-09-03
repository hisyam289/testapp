-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 05:11 AM
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
-- Database: `bateriku`
--

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `starting_point` varchar(100) NOT NULL,
  `destination_point` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `unit_number` int(11) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Not Started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `start_at`, `starting_point`, `destination_point`, `driver_name`, `license_plate`, `unit_number`, `latitude`, `longitude`, `driver_id`, `status`) VALUES
(38, '2024-09-04 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Klang', 'Jamal Karim', 'VB 836', 200, 2.99470000, 101.46300000, NULL, 'Not Started'),
(39, '2024-09-05 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Sungai Buloh', 'Abdul Rahman', 'PAC 5176', 250, 3.19914000, 101.54900000, NULL, 'Not Started'),
(40, '2024-09-06 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Batang Kali', 'Prakesh Karpaya', 'FE 3200', 150, 3.46214000, 101.65800000, NULL, 'Not Started'),
(41, '2024-09-09 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Pelangi Damansara', 'Nuur Asyraf', 'WRQ 9086', 350, 3.15513000, 101.60300000, NULL, 'Not Started'),
(42, '2024-09-10 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Dengkil', 'Prakesh Karpaya', 'PAC 5176', 130, 3.19914000, 101.54900000, NULL, 'Not Started'),
(43, '2024-09-11 08:00:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Kinrara', 'Jamal Karim', 'WRQ 9086', 200, 3.05337000, 101.65400000, NULL, 'Not Started');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `fk_driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
