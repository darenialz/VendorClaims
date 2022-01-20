-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2021 at 09:16 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `orlig` int(11) NOT NULL,
  `quotation` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `problems` varchar(250) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `details` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `vendor`, `orlig`, `quotation`, `date`, `location`, `problems`, `unit`, `price`, `total`, `details`) VALUES
(50, 'Pak Samad', 39381, 'BK9863', '2021-12-21', 'Kuala Lumpur', 'Masalah1', 2, '5.00', '10.00', 'Masalah1...'),
(51, 'Juan', 30197, 'AB30281', '2021-05-02', 'Sabah', 'Masalah2', 13, '6.00', '78.00', 'Masalah2....'),
(52, 'Ah Boi', 122059, 'AK101', '2021-01-05', 'Pahang', 'Masalah1.0', 15, '1.00', '15.00', 'Masalahv2'),
(53, 'Ah Boi', 122059, 'AK101', '2021-01-05', 'Pahang', 'Masalah2.0', 9, '2.00', '18.00', 'Masalahv2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
