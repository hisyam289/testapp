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
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `unit_number` int(11) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `size`, `unit_number`, `brand`, `location`) VALUES
(15, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop Pelangi Damansara'),
(16, 'NX100-6L (65B24L) MF', 'Large', 50, 'Astra', 'Pitstop Pelangi Damansara'),
(17, 'M42R (60B20R) EFB', 'Medium', 50, 'Astra', 'Pitstop Pelangi Damansara'),
(18, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop Sungai Buloh'),
(19, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop Puncak Alam'),
(20, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop Dengkil'),
(21, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop TTDI Jaya'),
(22, 'NX100-6R (65B24R) MF', 'Medium', 50, 'Astra', 'Pitstop Klang'),
(23, 'NX100-6R (65B24R) MF', 'Medium', 100, 'Astra', 'Pitstop Kinrara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
