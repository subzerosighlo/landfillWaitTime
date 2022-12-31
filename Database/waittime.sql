-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2022 at 07:50 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landfillwait`
--

-- --------------------------------------------------------

--
-- Table structure for table `waittime`
--

CREATE TABLE `waittime` (
  `id` int(11) NOT NULL,
  `LandfillName` varchar(100) NOT NULL,
  `DatePosted` date NOT NULL,
  `TimeofWait` int(40) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waittime`
--

INSERT INTO `waittime` (`id`, `LandfillName`, `DatePosted`, `TimeofWait`, `message`) VALUES
(1, 'Pine Tree', '2022-12-30', 0, 'The line is long'),
(2, 'Pine Tree', '2022-12-30', 40, 'The line is long'),
(3, 'Woodland meadows', '2022-12-30', 25, 'quick link'),
(4, 'Jfons', '2022-12-30', 45, 'The line is too the street'),
(5, 'Citizens', '2022-12-31', 10, 'Quick Line'),
(6, 'Woodland Meadows ', '2022-12-31', 45, 'Long wait'),
(7, 'JFons', '2022-12-31', 35, 'Dozer broke down, long line');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `waittime`
--
ALTER TABLE `waittime`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `waittime`
--
ALTER TABLE `waittime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
