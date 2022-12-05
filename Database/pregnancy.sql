-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2022 at 11:10 PM
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
(1, '2022-04-15', '10:00:00', 'COMPLETED', 4, 2, 'Lectus sit amet est placerat.'),
(2, '2022-07-10', '12:15:00', 'COMPLETED', 4, 2, 'Adipiscing commodo elit at imperdiet dui accumsan'),
(3, '2022-07-24', '10:30:00', 'COMPLETED', 5, 3, 'Adipiscing elit duis tristique sollicitudin nibh sit amet'),
(4, '2022-08-29', '11:00:00', 'COMPLETED', 5, 3, 'Nisl nisi scelerisque eu ultrices vitae auctor eu.'),
(5, '2022-10-24', '10:00:00', 'COMPLETED', 6, 2, 'Elementum nibh tellus molestie nunc non blandit massa enim nec.'),
(6, '2022-10-24', '14:00:00', 'COMPLETED', 6, 2, 'Sollicitudin tempor id eu nisl nunc mi. Orci a scelerisque purus semper eget.'),
(7, '2022-01-11', '11:00:00', 'COMPLETED', 7, 3, 'Tempor nec feugiat nisl pretium fusce id velit ut tortor.'),
(8, '2022-01-18', '10:00:00', 'COMPLETED', 7, 3, 'Purus sit amet volutpat consequat mauris nunc congue.'),
(9, '2022-04-12', '14:15:00', 'COMPLETED', 4, 2, 'Imperdiet proin fermentum leo vel orci porta non pulvinar neque.'),
(10, '2023-01-19', '10:00:00', 'SCHEDULED', 4, 2, 'Lectus sit amet est placerat.'),
(12, '2023-04-19', '10:30:00', 'SCHEDULED', 5, 3, 'Adipiscing elit duis tristique sollicitudin nibh sit amet'),
(14, '2023-02-14', '10:00:00', 'SCHEDULED', 6, 2, 'Elementum nibh tellus molestie nunc non blandit massa enim nec.'),
(16, '2023-01-21', '11:00:00', 'SCHEDULED', 7, 3, 'Tempor nec feugiat nisl pretium fusce id velit ut tortor.'),
(17, '2023-01-19', '12:45:00', 'REQUESTED', 4, 2, 'Lectus sit amet est placerat.'),
(18, '2023-04-19', '11:45:00', 'REQUESTED', 5, 3, 'Adipiscing elit duis tristique sollicitudin nibh sit amet'),
(19, '2023-02-14', '12:30:00', 'REQUESTED', 6, 2, 'Elementum nibh tellus molestie nunc non blandit massa enim nec.'),
(20, '2023-01-21', '09:45:00', 'REQUESTED', 7, 3, 'Tempor nec feugiat nisl pretium fusce id velit ut tortor.'),
(21, '2022-07-24', '12:45:00', 'CANCELLED', 4, 2, 'Lectus sit amet est placerat.'),
(22, '2022-07-15', '11:45:00', 'CANCELLED', 5, 3, 'Adipiscing elit duis tristique sollicitudin nibh sit amet'),
(23, '2022-09-08', '12:30:00', 'CANCELLED', 6, 2, 'Elementum nibh tellus molestie nunc non blandit massa enim nec.'),
(24, '2022-11-11', '09:45:00', 'CANCELLED', 7, 3, 'Tempor nec feugiat nisl pretium fusce id velit ut tortor.');

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

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`increment`, `patientID`, `medName`, `medDosage`, `medFrequency`, `medFood`) VALUES
(1, 4, 'Antalamin', '10mg', '2 times a day', 'With Food'),
(2, 5, 'Antalamin', '10mg', '2 times a day', 'With Food'),
(3, 6, 'Antalamin', '10mg', '2 times a day', 'With Food'),
(4, 7, 'Antalamin', '10mg', '2 times a day', 'With Food'),
(5, 4, 'Sensitamine', '20mg', '2 times a day', 'Without Food'),
(6, 5, 'Thyroxitrol Naloxacin', '15mg', '2 times a day', 'Without Food'),
(7, 6, 'Sensitamine', '15mg', '2 times a day', 'Without Food'),
(8, 7, 'Alglucoderal', '15mg', '2 times a day', 'Without Food'),
(9, 4, 'Thyroxitrol Naloxacin', '10mg', '2 times a day', 'Without Food'),
(10, 5, 'Tamoletra Betavax', '20mg', '2 times a day', 'Without Food'),
(11, 4, 'Phytocerol', '10mg', '2 times a day', 'With Food'),
(12, 5, 'Alglucoderal', '10mg', '2 times a day', 'With Food'),
(13, 6, 'Oloferal Unilac', '20mg', '2 times a day', 'With Food'),
(14, 7, 'Symbysteride', '15mg', '2 times a day', 'With Food');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancies`
--

CREATE TABLE `pregnancies` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `momHealth` enum('Healthy','Unhealthy') DEFAULT NULL,
  `Health` enum('Healthy','Unhealthy') DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('CURRENT','PAST') CHARACTER SET utf8 NOT NULL DEFAULT 'CURRENT',
  `patientID` int(11) NOT NULL,
  `babyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pregnancies`
--

INSERT INTO `pregnancies` (`id`, `doctor_id`, `momHealth`, `Health`, `due_date`, `status`, `patientID`, `babyName`) VALUES
(1, 2, 'Healthy', 'Healthy', '2023-01-25', 'CURRENT', 4, 'Liam'),
(2, 2, 'Healthy', 'Healthy', '2023-05-26', 'CURRENT', 5, 'Noah'),
(3, 3, 'Healthy', 'Healthy', '2023-06-02', 'CURRENT', 6, 'Olivia'),
(4, 3, 'Healthy', 'Healthy', '2023-07-19', 'CURRENT', 7, 'Emma'),
(5, 2, 'Healthy', 'Healthy', '2021-03-28', 'PAST', 4, 'Charlotte'),
(6, 2, 'Healthy', 'Healthy', '2021-11-08', 'PAST', 5, 'Ava'),
(7, 3, 'Unhealthy', 'Healthy', '2021-06-01', 'PAST', 6, 'Sophia'),
(8, 2, 'Unhealthy', 'Healthy', '2021-03-12', 'PAST', 7, 'James');

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
(1, 'Admin', 'User', 'admin@example.com', 'password', 'ADMIN', 'admin', NULL, NULL, NULL, NULL, NULL, '', NULL),
(2, 'Anthony', 'Fauci', 'afauci@example.com', 'password', 'DOCTOR', 'afauci', NULL, NULL, NULL, NULL, NULL, '', NULL),
(3, 'Mehmet', 'Oz', 'moz@example.com', 'password', 'DOCTOR', 'moz', NULL, NULL, NULL, NULL, NULL, '', NULL),
(4, 'Elaine', 'Joseph', 'ejoseph@example.com', 'password', 'PATIENT', 'ejoseph', 2, '1979-04-05', '401-864-0745', '65 Linda Avenue Taylors, SC 29687', 'Santiago Bass', '978-660-4036', 'Husband'),
(5, 'Velma', 'Warner', 'vwarner@example.com', 'password', 'PATIENT', 'vwarner', 3, '1979-06-11', '631-317-8283', '8238 Birch Hill Avenue Montclair, NJ 07042', 'Kirk Boyd', '774-563-2921', 'Husband'),
(6, 'Rosemary', 'Matthews', 'rmatthews@example.com', 'password', 'PATIENT', 'rmatthews', 2, '1984-04-20', '205-393-2646', '596 Franklin St. Irmo, SC 29063', 'Owen Curtis', '210-722-3523', 'Husband'),
(7, 'Tracy', 'Hammond', 'thammond@example.com', 'password', 'PATIENT', 'thammond', 3, '1992-05-16', '515-291-6664', '69 Magnolia Street Parlin, NJ 08859', 'Isaac Harmon', '386-233-9751', 'Husband');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pregnancies`
--
ALTER TABLE `pregnancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
