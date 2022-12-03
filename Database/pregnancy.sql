-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2022 at 08:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pregnancy`
--

-- --------------------------------------------------------

--
-- Table structure for table `pregnancies`
--

CREATE TABLE `pregnancies` (
  `id` int(11) NOT NULL,
  `doctor_first` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `doctor_last` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gestation_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('CURRENT','PAST') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'CURRENT',
  `patientID` int(11) NOT NULL,
  `babyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregnancies`
--

INSERT INTO `pregnancies` (`id`, `doctor_first`, `doctor_last`, `gestation_date`, `due_date`, `status`, `patientID`, `babyName`) VALUES
(1, 'Johnny', 'Appleseed', '2022-03-01', '2022-12-01', 'CURRENT', 3, '0'),
(2, 'Johnny', 'Appleseed', '2019-01-01', '2022-09-01', 'PAST', 3, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pregnancies`
--
ALTER TABLE `pregnancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
