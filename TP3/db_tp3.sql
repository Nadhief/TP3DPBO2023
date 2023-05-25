-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 04:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotwheels`
--

CREATE TABLE `hotwheels` (
  `hotwheels_id` int(11) NOT NULL,
  `hotwheels_foto` varchar(255) NOT NULL,
  `hotwheels_kode` varchar(10) NOT NULL,
  `hotwheels_nama` varchar(255) NOT NULL,
  `tipe_id` int(11) NOT NULL,
  `seri_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotwheels`
--

INSERT INTO `hotwheels` (`hotwheels_id`, `hotwheels_foto`, `hotwheels_kode`, `hotwheels_nama`, `tipe_id`, `seri_id`) VALUES
(1, 'paradox.jpg', 'HW55', 'PHARODOX', 1, 1),
(7, 'govner.jpg', 'HW99', 'THE GOVNER', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `seri`
--

CREATE TABLE `seri` (
  `seri_id` int(11) NOT NULL,
  `seri_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seri`
--

INSERT INTO `seri` (`seri_id`, `seri_nama`) VALUES
(1, 'Seri Original'),
(2, 'Seri Batman');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `tipe_id` int(15) NOT NULL,
  `tipe_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`tipe_id`, `tipe_nama`) VALUES
(1, 'Hw Racers'),
(2, 'Hw Super Chromes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotwheels`
--
ALTER TABLE `hotwheels`
  ADD PRIMARY KEY (`hotwheels_id`),
  ADD KEY `tipe_id` (`tipe_id`),
  ADD KEY `seri_id` (`seri_id`);

--
-- Indexes for table `seri`
--
ALTER TABLE `seri`
  ADD PRIMARY KEY (`seri_id`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`tipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotwheels`
--
ALTER TABLE `hotwheels`
  MODIFY `hotwheels_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `seri`
--
ALTER TABLE `seri`
  MODIFY `seri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `tipe_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotwheels`
--
ALTER TABLE `hotwheels`
  ADD CONSTRAINT `seri_id` FOREIGN KEY (`seri_id`) REFERENCES `seri` (`seri_id`),
  ADD CONSTRAINT `tipe_id` FOREIGN KEY (`tipe_id`) REFERENCES `tipe` (`tipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
