-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 30, 2023 at 02:58 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` char(36) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `service` text NOT NULL,
  `status` text NOT NULL,
  `patient_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `doctor_id`, `start_time`, `end_time`, `service`, `status`, `patient_contact`) VALUES
('64ef4b558bfd7', 1, '15:59:00', '16:59:00', 'service_1', 'Scheduled', '2345678'),
('64ef4b6292d3f', 1, '15:56:00', '16:56:00', 'service_1', 'Scheduled', '2345678'),
('64ef4d352cad1', 1, '12:07:00', '13:07:00', 'service_1', 'CANCELLED', '2345678'),
('64ef4e2ae51f1', 1, '16:11:00', '17:11:00', 'service_1', 'Scheduled', '2345678'),
('64ef4e6d3f296', 1, '15:12:00', '16:12:00', 'service_1', 'Scheduled', '2345678'),
('64ef4e80d03db', 1, '16:13:00', '17:13:00', 'service_1', 'Scheduled', '2345678'),
('64ef4eebac02a', 1, '16:35:00', '17:35:00', 'service_1', 'Scheduled', '2345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
