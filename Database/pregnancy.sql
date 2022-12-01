-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2022 at 12:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) UNSIGNED NOT NULL,
  `apptDate` date NOT NULL,
  `apptTime` time NOT NULL,
  `status` enum('COMPLETED','REQUESTED','SCHEDULED','CANCELLED') CHARACTER SET utf8 NOT NULL DEFAULT 'REQUESTED',
  `patientId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL DEFAULT 'No reason provided'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `apptDate`, `apptTime`, `status`, `patientId`, `doctorId`, `reason`) VALUES
(1, '2022-01-01', '10:00:00', 'COMPLETED', 3, 2, 'No reason provided'),
(2, '2022-12-01', '10:00:00', 'REQUESTED', 3, 2, 'No reason provided'),
(3, '2022-10-01', '10:00:00', 'CANCELLED', 3, 2, 'No reason provided'),
(4, '2022-11-01', '10:00:00', 'SCHEDULED', 3, 2, 'No reason provided'),
(5, '2022-11-01', '15:25:00', 'REQUESTED', 3, 2, 'dumb'),
(6, '2022-11-30', '18:33:00', 'SCHEDULED', 4, 2, ''),
(7, '2022-11-10', '15:37:00', 'SCHEDULED', 3, 2, ''),
(8, '2022-11-10', '15:40:00', 'SCHEDULED', 4, 2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `increment` int(11) NOT NULL,
  `patientID` int(255) DEFAULT NULL,
  `medName` varchar(255) DEFAULT NULL,
  `medDosage` varchar(255) DEFAULT NULL,
  `medFrequency` varchar(255) DEFAULT NULL,
  `medFood` enum('With Food','Without Food') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pregnancies`
--

CREATE TABLE `pregnancies` (
  `id` int(11) NOT NULL,
  `patient_first` varchar(255) CHARACTER SET utf8 NOT NULL,
  `patient_last` varchar(255) CHARACTER SET utf8 NOT NULL,
  `doctor_first` varchar(255) CHARACTER SET utf8 NOT NULL,
  `doctor_last` varchar(255) CHARACTER SET utf8 NOT NULL,
  `gestation_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('PLANNING','CURRENT','BIRTHED') CHARACTER SET utf8 NOT NULL DEFAULT 'CURRENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pregnancies`
--

INSERT INTO `pregnancies` (`id`, `patient_first`, `patient_last`, `doctor_first`, `doctor_last`, `gestation_date`, `due_date`, `status`) VALUES
(1, 'Jane', 'Doe', 'Johnny', 'Appleseed', '2022-03-01', '2022-12-01', 'CURRENT'),
(2, 'Jane', 'Doe', 'Johnny', 'Appleseed', '2019-01-01', '2022-09-01', 'BIRTHED');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `userpassword` varchar(64) NOT NULL,
  `role` enum('ADMIN','DOCTOR','PATIENT') DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `assigned_doctorId` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `emerCon_name` varchar(255) DEFAULT NULL,
  `emerCon_phone` varchar(255) DEFAULT NULL,
  `emerCon_relation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `first_name`, `last_name`, `email`, `userpassword`, `role`, `username`, `assigned_doctorId`, `birthdate`, `phone`, `address`, `emerCon_name`, `emerCon_phone`, `emerCon_relation`) VALUES
(1, 'Admin', 'Istrator', 'admin@example.com', 'password', 'ADMIN', 'admin', NULL, NULL, NULL, NULL, NULL, '', NULL),
(2, 'Johnny', 'Appleseed', 'JohnnyAppleseed@example.com', 'password', 'DOCTOR', 'doctor', NULL, NULL, NULL, NULL, NULL, '', NULL),
(3, 'Jane', 'Doe', 'JaneDoe@example.com', 'password', 'PATIENT', 'patient', 2, NULL, NULL, NULL, NULL, '', NULL),
(4, 'Cici', 'Siu', 'starxdevilx@gmail.com', 'pass', 'PATIENT', 'cici', NULL, '2022-11-10', '123-123-1234', NULL, NULL, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`increment`),
  ADD KEY `increment` (`increment`);

--
-- Indexes for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pregnancies`
--
ALTER TABLE `pregnancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
