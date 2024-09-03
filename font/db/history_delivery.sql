-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 04:30 AM
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
-- Table structure for table `history_delivery`
--

CREATE TABLE `history_delivery` (
  `schedule_id` int(11) NOT NULL,
  `completed_at` datetime NOT NULL,
  `start_at` datetime NOT NULL,
  `starting_point` varchar(255) NOT NULL,
  `destination_point` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `license_plate` varchar(50) NOT NULL,
  `unit_number` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `history_delivery`
--

INSERT INTO `history_delivery` (`schedule_id`, `completed_at`, `start_at`, `starting_point`, `destination_point`, `driver_name`, `license_plate`, `unit_number`, `status`) VALUES
(35, '2024-09-02 16:43:21', '2024-09-19 16:08:00', 'Pitstop Puncak Alam', 'Pitstop Sungai Buloh', 'Abdul Rahman', 'SYA 9086', '130', 'Completed'),
(36, '2024-09-02 16:14:52', '2024-09-10 16:13:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Sungai Buloh', 'Jamal Karim', 'WRQ 9086', '350', 'Completed'),
(37, '2024-09-03 10:07:48', '2024-09-13 10:06:00', 'Bateriku Paddock (Warehouse)', 'Pitstop Puncak Alam', 'Prakesh Karpaya', 'PAC 5176', '350', 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_delivery`
--
ALTER TABLE `history_delivery`
  ADD PRIMARY KEY (`schedule_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
