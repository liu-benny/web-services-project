-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 01:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `time_from` datetime NOT NULL,
  `time_to` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `doctor_id`, `clinic_id`, `time_from`, `time_to`) VALUES
(1, 1, 1, 1, '2019-05-06 10:00:00', '2019-05-06 10:20:00'),
(2, 2, 50, 5, '2022-10-03 10:00:00', '2022-10-03 11:00:00'),
(3, 12, 20, 2, '2022-12-19 10:05:00', '2022-12-19 11:05:00'),
(4, 8, 19, 2, '2012-09-12 17:00:00', '2012-09-12 17:30:00'),
(5, 3, 37, 3, '2022-07-11 13:00:00', '2022-07-11 14:00:00'),
(6, 1, 1, 1, '2015-12-09 16:00:00', '2015-12-09 16:30:00'),
(7, 4, 20, 2, '2021-07-30 14:45:00', '2021-07-30 15:05:00'),
(8, 7, 43, 4, '2022-12-05 07:02:37', '2022-12-05 07:02:37'),
(10, 11, 45, 4, '2020-02-14 15:20:00', '2020-02-14 15:40:00'),
(11, 9, 20, 2, '2023-04-01 13:55:00', '2023-04-01 14:55:00'),
(12, 3, 52, 5, '2021-10-05 10:05:00', '2021-10-05 10:55:00'),
(13, 8, 6, 1, '2007-12-12 12:35:00', '2007-12-12 12:55:00'),
(14, 4, 27, 2, '2023-01-11 11:25:00', '2023-01-11 11:45:00'),
(15, 12, 34, 3, '2022-06-09 13:15:00', '2022-06-09 13:45:00'),
(16, 5, 29, 2, '2023-02-15 15:10:00', '2023-02-15 15:25:00'),
(18, 7, 2, 1, '1997-07-09 11:48:58', '1997-07-09 15:48:58'),
(19, 3, 3, 1, '2022-12-02 12:12:12', '2022-12-02 12:22:22'),
(20, 4, 4, 1, '2022-10-02 14:22:22', '2022-10-02 14:55:55'),
(21, 1, 1, 1, '2002-06-13 13:06:13', '2002-06-13 13:18:55'),
(22, 2, 2, 1, '1998-10-02 16:23:00', '1998-10-02 16:43:00'),
(23, 8, 20, 2, '2032-12-05 12:15:00', '2032-12-05 12:35:00'),
(24, 1, 1, 1, '2018-11-08 11:23:00', '2018-11-08 11:53:00'),
(25, 2, 1, 1, '2016-12-25 12:00:00', '2016-12-25 12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `clinic_address` varchar(255) NOT NULL,
  `clinic_details` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_address`, `clinic_details`) VALUES
(1, '', '1191, Union Ave, Montréal, Qc H3B 3C3\r\n', 'Located in the heart of downtown Montreal, our private medical clinic offers a wide range of medical and specialized services.\r\nThe majority of our professionals at downtown clinic Montreal offer private services, but consultations with some of our specialists, such as the allergy or internal medicine, are covered by the Quebec health insurance.\r\nThe goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at our downtown clinic Montreal today!'),
(2, 'UnionMD Gatineau', '86, Promenade du Portage, Suite 300, Gatineau, Qc, J8X 2K1', 'Located in the heart of downtown Gatineau, our private medical clinic offers a wide range of medical and specialized services, including family medicine, surgery center, dermatology and gastroenterology center. The goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at Gatineau clinic today!'),
(3, 'UnionMD Laval', '3498 Boulevard Saint-Rose Laval, Qc, H7P 4K7', 'Our clinic in Laval offers you family medicine, minor surgeries, medical dermatology and aesthetic medicine.\r\nOur patients enjoy access to free parking.\r\n\r\nThe goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at our Laval clinic today!'),
(4, 'UnionMD Town of Mount-Royal (TMR)', '4175, Jean-Talon O, Town of Mount-Royal, Qc, H4P 1W6', 'Located 10 minutes away from the Namur metro station, our clinic on Jean-Talon West (Town of Mont-Royal) occupies the second floor of a comfortable 2-storied building. Our patients enjoy access to free parking. UnionMD Jean-Talon offers a wide range of medical and specialized services, such as medical and aesthetic dermatology, minor surgeries, podiatry, and other services. The goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the'),
(5, 'SANTÉ MONT-ROYAL MEDICAL CLINIC', '4480 Chemin de la Côte de liesse, Suite 110, Ville Mont-Royal, QC, H4N 2R1', 'We are open 7 days a week and most holidays. Our doctors are qualified to see patients of all ages.'),
(6, 'UnionMD Gatineau', '86, Promenade du Portage, Suite 300, Gatineau, Qc, J8X 2K1', 'This is my new location');

-- --------------------------------------------------------

--
-- Table structure for table `days_of_week`
--

CREATE TABLE `days_of_week` (
  `schedule_id` int(11) NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days_of_week`
--

INSERT INTO `days_of_week` (`schedule_id`, `day_of_week`, `time_from`, `time_to`) VALUES
(2, 'Monday', '08:00:00', '18:00:00'),
(2, 'Tuesday', '08:00:00', '18:00:00'),
(2, 'Thursday', '08:00:00', '18:00:00'),
(2, 'Friday', '08:00:00', '18:00:00'),
(2, 'Saturday', '08:00:00', '18:00:00'),
(3, 'Monday', '08:00:00', '18:00:00'),
(3, 'Tuesday', '08:00:00', '18:00:00'),
(3, 'Wednesday', '08:00:00', '18:00:00'),
(3, 'Thursday', '08:00:00', '18:00:00'),
(3, 'Saturday', '08:00:00', '18:00:00'),
(4, 'Tuesday', '08:00:00', '18:00:00'),
(4, 'Wednesday', '08:00:00', '18:00:00'),
(4, 'Thursday', '08:00:00', '18:00:00'),
(4, 'Friday', '08:00:00', '18:00:00'),
(4, 'Saturday', '08:00:00', '18:00:00'),
(5, 'Monday', '08:00:00', '18:00:00'),
(5, 'Tuesday', '08:00:00', '18:00:00'),
(5, 'Wednesday', '08:00:00', '18:00:00'),
(5, 'Thursday', '08:00:00', '18:00:00'),
(5, 'Friday', '08:00:00', '18:00:00'),
(6, 'Monday', '08:00:00', '18:00:00'),
(6, 'Tuesday', '08:00:00', '18:00:00'),
(6, 'Thursday', '08:00:00', '18:00:00'),
(6, 'Friday', '08:00:00', '18:00:00'),
(6, 'Saturday', '08:00:00', '18:00:00'),
(7, 'Monday', '08:00:00', '18:00:00'),
(7, 'Wednesday', '08:00:00', '18:00:00'),
(7, 'Thursday', '08:00:00', '18:00:00'),
(7, 'Friday', '08:00:00', '18:00:00'),
(7, 'Saturday', '08:00:00', '18:00:00'),
(8, 'Monday', '08:00:00', '18:00:00'),
(8, 'Tuesday', '08:00:00', '18:00:00'),
(8, 'Wednesday', '08:00:00', '18:00:00'),
(8, 'Thursday', '08:00:00', '18:00:00'),
(13, 'Monday', '08:00:00', '18:00:00'),
(13, 'Tuesday', '08:00:00', '18:00:00'),
(13, 'Wednesday', '08:00:00', '18:00:00'),
(13, 'Thursday', '08:00:00', '18:00:00'),
(13, 'Friday', '08:00:00', '18:00:00'),
(14, 'Monday', '08:00:00', '18:00:00'),
(14, 'Tuesday', '08:00:00', '18:00:00'),
(14, 'Thursday', '08:00:00', '18:00:00'),
(14, 'Friday', '08:00:00', '18:00:00'),
(14, 'Saturday', '08:00:00', '18:00:00'),
(15, 'Monday', '08:00:00', '18:00:00'),
(15, 'Tuesday', '08:00:00', '18:00:00'),
(15, 'Wednesday', '08:00:00', '18:00:00'),
(15, 'Thursday', '08:00:00', '18:00:00'),
(15, 'Saturday', '08:00:00', '18:00:00'),
(16, 'Monday', '08:00:00', '18:00:00'),
(16, 'Wednesday', '08:00:00', '18:00:00'),
(16, 'Thursday', '08:00:00', '18:00:00'),
(16, 'Friday', '08:00:00', '18:00:00'),
(16, 'Saturday', '08:00:00', '18:00:00'),
(17, 'Monday', '08:00:00', '18:00:00'),
(17, 'Tuesday', '08:00:00', '18:00:00'),
(17, 'Wednesday', '08:00:00', '18:00:00'),
(17, 'Thursday', '08:00:00', '18:00:00'),
(17, 'Friday', '08:00:00', '18:00:00'),
(18, 'Monday', '08:00:00', '18:00:00'),
(18, 'Tuesday', '08:00:00', '18:00:00'),
(18, 'Thursday', '08:00:00', '18:00:00'),
(18, 'Friday', '08:00:00', '18:00:00'),
(18, 'Saturday', '08:00:00', '18:00:00'),
(19, 'Monday', '08:00:00', '18:00:00'),
(19, 'Tuesday', '08:00:00', '18:00:00'),
(19, 'Wednesday', '08:00:00', '18:00:00'),
(19, 'Thursday', '08:00:00', '18:00:00'),
(19, 'Friday', '08:00:00', '18:00:00'),
(20, 'Tuesday', '08:00:00', '18:00:00'),
(20, 'Wednesday', '08:00:00', '18:00:00'),
(20, 'Thursday', '08:00:00', '18:00:00'),
(20, 'Friday', '08:00:00', '18:00:00'),
(20, 'Saturday', '08:00:00', '18:00:00'),
(21, 'Monday', '08:00:00', '18:00:00'),
(21, 'Tuesday', '08:00:00', '18:00:00'),
(21, 'Wednesday', '08:00:00', '18:00:00'),
(21, 'Thursday', '08:00:00', '18:00:00'),
(21, 'Friday', '08:00:00', '18:00:00'),
(22, 'Monday', '08:00:00', '18:00:00'),
(22, 'Tuesday', '08:00:00', '18:00:00'),
(22, 'Wednesday', '08:00:00', '18:00:00'),
(22, 'Friday', '08:00:00', '18:00:00'),
(22, 'Saturday', '08:00:00', '18:00:00'),
(23, 'Monday', '08:00:00', '18:00:00'),
(23, 'Tuesday', '08:00:00', '18:00:00'),
(23, 'Wednesday', '08:00:00', '18:00:00'),
(23, 'Friday', '08:00:00', '18:00:00'),
(23, 'Saturday', '08:00:00', '18:00:00'),
(24, 'Monday', '08:00:00', '18:00:00'),
(24, 'Tuesday', '08:00:00', '18:00:00'),
(24, 'Wednesday', '08:00:00', '18:00:00'),
(24, 'Friday', '08:00:00', '18:00:00'),
(24, 'Saturday', '08:00:00', '18:00:00'),
(25, 'Monday', '08:00:00', '18:00:00'),
(25, 'Tuesday', '08:00:00', '18:00:00'),
(25, 'Wednesday', '08:00:00', '18:00:00'),
(25, 'Friday', '08:00:00', '18:00:00'),
(25, 'Saturday', '08:00:00', '18:00:00'),
(26, 'Monday', '08:00:00', '18:00:00'),
(26, 'Tuesday', '08:00:00', '18:00:00'),
(26, 'Wednesday', '08:00:00', '18:00:00'),
(26, 'Friday', '08:00:00', '18:00:00'),
(26, 'Saturday', '08:00:00', '18:00:00'),
(27, 'Monday', '08:00:00', '18:00:00'),
(27, 'Tuesday', '08:00:00', '18:00:00'),
(27, 'Wednesday', '08:00:00', '18:00:00'),
(27, 'Friday', '08:00:00', '18:00:00'),
(27, 'Saturday', '08:00:00', '18:00:00'),
(27, 'Monday', '08:00:00', '18:00:00'),
(27, 'Tuesday', '08:00:00', '18:00:00'),
(27, 'Wednesday', '08:00:00', '18:00:00'),
(27, 'Friday', '08:00:00', '18:00:00'),
(27, 'Saturday', '08:00:00', '18:00:00'),
(28, 'Monday', '08:00:00', '18:00:00'),
(28, 'Tuesday', '08:00:00', '18:00:00'),
(28, 'Wednesday', '08:00:00', '18:00:00'),
(28, 'Thursday', '08:00:00', '18:00:00'),
(28, 'Friday', '08:00:00', '18:00:00'),
(29, 'Monday', '08:00:00', '18:00:00'),
(29, 'Tuesday', '08:00:00', '18:00:00'),
(29, 'Wednesday', '08:00:00', '18:00:00'),
(29, 'Thursday', '08:00:00', '18:00:00'),
(29, 'Friday', '08:00:00', '18:00:00'),
(30, 'Monday', '08:00:00', '18:00:00'),
(30, 'Tuesday', '08:00:00', '18:00:00'),
(30, 'Wednesday', '08:00:00', '18:00:00'),
(30, 'Thursday', '08:00:00', '18:00:00'),
(30, 'Friday', '08:00:00', '18:00:00'),
(31, 'Monday', '08:00:00', '18:00:00'),
(31, 'Tuesday', '08:00:00', '18:00:00'),
(31, 'Wednesday', '08:00:00', '18:00:00'),
(31, 'Thursday', '08:00:00', '18:00:00'),
(31, 'Friday', '08:00:00', '18:00:00'),
(32, 'Monday', '08:00:00', '18:00:00'),
(32, 'Tuesday', '08:00:00', '18:00:00'),
(32, 'Wednesday', '08:00:00', '18:00:00'),
(32, 'Thursday', '08:00:00', '18:00:00'),
(32, 'Friday', '08:00:00', '18:00:00'),
(33, 'Monday', '08:00:00', '18:00:00'),
(33, 'Tuesday', '08:00:00', '18:00:00'),
(33, 'Wednesday', '08:00:00', '18:00:00'),
(33, 'Thursday', '08:00:00', '18:00:00'),
(33, 'Friday', '08:00:00', '18:00:00'),
(34, 'Monday', '08:00:00', '18:00:00'),
(34, 'Tuesday', '08:00:00', '18:00:00'),
(34, 'Wednesday', '08:00:00', '18:00:00'),
(34, 'Thursday', '08:00:00', '18:00:00'),
(34, 'Friday', '08:00:00', '18:00:00'),
(35, 'Monday', '08:00:00', '18:00:00'),
(35, 'Tuesday', '08:00:00', '18:00:00'),
(35, 'Wednesday', '08:00:00', '18:00:00'),
(35, 'Thursday', '08:00:00', '18:00:00'),
(35, 'Friday', '08:00:00', '18:00:00'),
(36, 'Monday', '08:00:00', '18:00:00'),
(36, 'Tuesday', '08:00:00', '18:00:00'),
(36, 'Wednesday', '08:00:00', '18:00:00'),
(36, 'Thursday', '08:00:00', '18:00:00'),
(36, 'Friday', '08:00:00', '18:00:00'),
(37, 'Monday', '08:00:00', '18:00:00'),
(37, 'Tuesday', '08:00:00', '18:00:00'),
(37, 'Wednesday', '08:00:00', '18:00:00'),
(37, 'Thursday', '08:00:00', '18:00:00'),
(37, 'Friday', '08:00:00', '18:00:00'),
(38, 'Monday', '08:00:00', '18:00:00'),
(38, 'Tuesday', '08:00:00', '18:00:00'),
(38, 'Wednesday', '08:00:00', '18:00:00'),
(38, 'Thursday', '08:00:00', '18:00:00'),
(38, 'Friday', '08:00:00', '18:00:00'),
(39, 'Monday', '08:00:00', '18:00:00'),
(39, 'Tuesday', '08:00:00', '18:00:00'),
(39, 'Wednesday', '08:00:00', '18:00:00'),
(39, 'Thursday', '08:00:00', '18:00:00'),
(39, 'Friday', '08:00:00', '18:00:00'),
(40, 'Monday', '08:00:00', '18:00:00'),
(40, 'Tuesday', '08:00:00', '18:00:00'),
(40, 'Wednesday', '08:00:00', '18:00:00'),
(40, 'Thursday', '08:00:00', '18:00:00'),
(40, 'Friday', '08:00:00', '18:00:00'),
(41, 'Monday', '08:00:00', '18:00:00'),
(41, 'Tuesday', '08:00:00', '18:00:00'),
(41, 'Wednesday', '08:00:00', '18:00:00'),
(41, 'Thursday', '08:00:00', '18:00:00'),
(41, 'Friday', '08:00:00', '18:00:00'),
(42, 'Monday', '08:00:00', '18:00:00'),
(42, 'Tuesday', '08:00:00', '18:00:00'),
(42, 'Wednesday', '08:00:00', '18:00:00'),
(42, 'Thursday', '08:00:00', '18:00:00'),
(42, 'Friday', '08:00:00', '18:00:00'),
(43, 'Monday', '08:00:00', '18:00:00'),
(43, 'Tuesday', '08:00:00', '18:00:00'),
(43, 'Wednesday', '08:00:00', '18:00:00'),
(43, 'Thursday', '08:00:00', '18:00:00'),
(43, 'Friday', '08:00:00', '18:00:00'),
(44, 'Monday', '08:00:00', '18:00:00'),
(44, 'Tuesday', '08:00:00', '18:00:00'),
(44, 'Wednesday', '08:00:00', '18:00:00'),
(44, 'Thursday', '08:00:00', '18:00:00'),
(44, 'Friday', '08:00:00', '18:00:00'),
(45, 'Monday', '08:00:00', '18:00:00'),
(45, 'Tuesday', '08:00:00', '18:00:00'),
(45, 'Wednesday', '08:00:00', '18:00:00'),
(45, 'Thursday', '08:00:00', '18:00:00'),
(45, 'Friday', '08:00:00', '18:00:00'),
(46, 'Monday', '08:00:00', '18:00:00'),
(46, 'Tuesday', '08:00:00', '18:00:00'),
(46, 'Wednesday', '08:00:00', '18:00:00'),
(46, 'Thursday', '08:00:00', '18:00:00'),
(46, 'Friday', '08:00:00', '18:00:00'),
(47, 'Monday', '08:00:00', '18:00:00'),
(47, 'Tuesday', '08:00:00', '18:00:00'),
(47, 'Wednesday', '08:00:00', '18:00:00'),
(47, 'Thursday', '08:00:00', '18:00:00'),
(47, 'Friday', '08:00:00', '18:00:00'),
(48, 'Monday', '08:00:00', '18:00:00'),
(48, 'Tuesday', '08:00:00', '18:00:00'),
(48, 'Wednesday', '08:00:00', '18:00:00'),
(48, 'Thursday', '08:00:00', '18:00:00'),
(48, 'Friday', '08:00:00', '18:00:00'),
(49, 'Monday', '08:00:00', '18:00:00'),
(49, 'Tuesday', '08:00:00', '18:00:00'),
(49, 'Wednesday', '08:00:00', '18:00:00'),
(49, 'Thursday', '08:00:00', '18:00:00'),
(49, 'Friday', '08:00:00', '18:00:00'),
(50, 'Monday', '08:00:00', '18:00:00'),
(50, 'Tuesday', '08:00:00', '18:00:00'),
(50, 'Wednesday', '08:00:00', '18:00:00'),
(50, 'Thursday', '08:00:00', '18:00:00'),
(50, 'Friday', '08:00:00', '18:00:00'),
(51, 'Monday', '08:00:00', '18:00:00'),
(51, 'Tuesday', '08:00:00', '18:00:00'),
(51, 'Wednesday', '08:00:00', '18:00:00'),
(51, 'Thursday', '08:00:00', '18:00:00'),
(51, 'Friday', '08:00:00', '18:00:00'),
(52, 'Monday', '08:00:00', '18:00:00'),
(52, 'Tuesday', '08:00:00', '18:00:00'),
(52, 'Wednesday', '08:00:00', '18:00:00'),
(52, 'Thursday', '08:00:00', '18:00:00'),
(52, 'Friday', '08:00:00', '18:00:00'),
(53, 'Monday', '08:00:00', '18:00:00'),
(53, 'Tuesday', '08:00:00', '18:00:00'),
(53, 'Wednesday', '08:00:00', '18:00:00'),
(53, 'Thursday', '08:00:00', '18:00:00'),
(53, 'Friday', '08:00:00', '18:00:00'),
(53, 'Monday', '08:00:00', '18:00:00'),
(54, 'Tuesday', '08:00:00', '18:00:00'),
(54, 'Wednesday', '08:00:00', '18:00:00'),
(54, 'Thursday', '08:00:00', '18:00:00'),
(54, 'Friday', '08:00:00', '18:00:00'),
(55, 'Monday', '08:00:00', '18:00:00'),
(55, 'Tuesday', '08:00:00', '18:00:00'),
(55, 'Wednesday', '08:00:00', '18:00:00'),
(55, 'Thursday', '08:00:00', '18:00:00'),
(55, 'Friday', '08:00:00', '18:00:00'),
(56, 'Monday', '08:00:00', '18:00:00'),
(56, 'Tuesday', '08:00:00', '18:00:00'),
(56, 'Wednesday', '08:00:00', '18:00:00'),
(56, 'Thursday', '08:00:00', '18:00:00'),
(56, 'Friday', '08:00:00', '18:00:00'),
(56, 'Monday', '08:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `clinic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `clinic_id`) VALUES
(1, 'Private Family Medicine', 1),
(2, 'Private Dermatologist', 1),
(4, 'Gynecology and obstetrics', 1),
(5, 'Gastroenterology', 1),
(6, 'Podiatry', 2),
(7, 'Allergies and Immunology', 2),
(8, 'Endocrinology', 2),
(9, 'Physiotherapy', 2),
(10, 'Internal Medicine', 2),
(11, 'Urology', 3),
(12, 'Orthopedic surgery', 3),
(13, 'Mohs Surgery', 3),
(14, 'General Surgery', 3),
(15, 'Vasectomy', 3),
(16, 'Laser Center', 4),
(17, 'Aesthetic Dermatology', 4),
(18, 'Plastic Surgery', 4),
(19, 'Hair Transplant', 4),
(20, 'Dermatology', 5),
(21, 'Endocrinology', 5),
(22, 'Ear Nose and Throat', 5),
(23, 'Gynecology', 5),
(24, 'Neurology', 5);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `first_name`, `last_name`, `email`, `phone`, `department_id`) VALUES
(1, 'Pablo', 'Damir', 'pablodamir.unionmdmtl@gmail.com', '(514) 878-2216', 1),
(2, 'Herbert', 'Nao', 'herbertnao.unionmdmtl@gmail.com', '(514) 738-1887', 1),
(3, 'Haydar', 'Jabin', 'haydarjabin.unionmdmtl@gmail.com', '(514) 747-4805', 1),
(4, 'Marion', 'Laurentin', 'marionlaurentin.unionmdmtl@gmail.com', '(450) 755-4839', 1),
(5, 'Jep', 'Jamison', 'jepjamison.unionmdmtl@gmail.com', '(450) 641-8237', 2),
(6, 'Elvin', 'Henry', 'elvinhenry.unionmdmtl@gmail.com', '(514) 274-4371', 2),
(7, 'Pacifico', 'Buse', 'pabus@arketmay.com', '(514) 342-6360', 2),
(8, 'Baran', 'Schaffer', 'barscha@progressenergyinc.info', '(514) 277-6464', 2),
(13, 'Irma', 'Gillespie', 'irgillespi@unionmd.mtl', '(438) 745-4449', 4),
(14, 'Lodema', 'Oney', 'lodem-one@unionmd.mtl', '(438) 473-4473', 4),
(15, 'Ziven', 'Oney', 'zive.one@unionmd.mtl', '(514) 623-3705', 5),
(16, 'Mitch', 'Bonelli', 'mitc.bone@unionmd.mtl', '(514) 985-1185', 5),
(17, 'Akilina', 'Troxell', 'akilintroxe@unionmd.gatineau', '(604) 590-0241', 6),
(18, 'Valborg', 'Sroka', 'valbosrok@unionmd.gatineau', '(514) 668-4486', 6),
(19, 'Davan', 'Ricca', 'dava.ric@unionmd.gatineau', '(514) 903-8628', 6),
(20, 'Akilina', 'Sroka', 'akilina.sro@unionmd.gatineau', '(514) 433-7881', 6),
(21, 'Agneta', 'Eyler', 'agey@unionmd.gatineau', '(514) 561-6565', 7),
(22, 'Akilina', 'Fansler', 'akfansler@unionmd.gatineau', '(514) 524-2292', 7),
(23, 'Nicodemus', 'Mims', 'nico-mim.unionmdlaval@gmail.com\r\n', '438-555-0174', 8),
(24, 'Nicodemus', 'Childers', 'nicodemuchilders.unionmdlaval@gmail.com', '438-555-0174', 8),
(25, 'Akiva', 'Hotchkiss', 'akihotchkiss.unionmdlaval@gmail.com', '438-555-0174', 8),
(26, 'Galen', 'Conn', 'gale-conn.unionmdlaval@gmail.com', '438-555-0198', 9),
(27, 'Aldora', 'Mims', 'aldora-mi.unionmdlaval@gmail.com', '438-555-0147', 9),
(28, 'Ike', 'Eason', 'k.easo.unionmdlaval@gmail.com', '438-555-0119', 10),
(29, 'Cicily', 'Austin', 'cicil-au.unionmdlaval@gmail.com', '438-555-0186', 10),
(30, 'Shri', 'Heil', 'sh.he.unionmdlaval@gmail.com', '438-555-0108', 11),
(31, 'Irvette', 'Austin', 'irvet-austi.unionmdlaval@gmail.com', '438-555-0181', 11),
(32, 'Carmela', 'Deacon', 'carmedea.unionmdlaval@gmail.com', '438-555-0157', 12),
(33, 'Klemens', 'Janes', 'klemenja.unionmdlaval@gmail.com', '438-555-0119', 12),
(34, 'Aakarshan', 'Rada', 'aakar-rad.unionmdlaval@gmail.com', '438-555-0126', 13),
(35, 'Mervyn', 'Shuman', 'mervyn_shuma.unionmdlaval@gmail.com', '438-555-0103', 13),
(36, 'Saloman', 'Jones', 'sa.jo.unionmdlaval@gmail.com', '438-555-0187', 14),
(37, 'Cardew', 'Winstead', 'carde.winstead.unionmdlaval@gmail.com', '438-555-0114', 14),
(38, 'Fineas', 'McGlone', 'finea_mcglo.unionmdlaval@gmail.com', '438-555-0181', 15),
(39, 'Herschell', 'Zorn', 'he-zor.unionmdlaval@gmail.com', '438-555-0180', 15),
(40, 'Jennifer', 'McGlone', 'jennimcg.unionmdmr@gmail.com\r\n', '438-555-0130', 16),
(41, 'Colby', 'Fichter', 'cofichte.unionmdmr@gmail.com\r\n', '438-555-0104', 16),
(42, 'Caerwyn', 'Mcdaniels', 'caer_mc.unionmdmr@gmail.com', '438-555-0161', 17),
(43, 'Veena', 'Edmundson', 'eeedmundson.unionmdmr@gmail.com', '438-555-0129', 17),
(44, 'Willoughby', 'Simpkins', 'willoughsimpki.unionmdmr@gmail.com', '438-555-0171', 18),
(45, 'Luce', 'Harpster', 'lu_harpst.unionmdmr@gmail.com', '438-555-0175', 18),
(46, 'Welby', 'Ogilvie', 'welb_ogilvi.unionmdmr@gmail.com', '438-555-0199', 19),
(47, 'Senta', 'Ogilvie', 'se-ogi.unionmdmr@gmail.com', '438-555-0107', 19),
(48, 'Kada', 'Macaulay', 'ka.maca@santemontroyal.com', '438-555-0139', 20),
(49, 'Ravi', 'Colby', 'racolby@santemontroyal.com', '438-555-0139', 20),
(50, 'Bourke', 'Mize', 'bourke.mize@santemontroyal.com', '438-555-0140', 21),
(51, 'Madison', 'Mertz', 'ma-mertz@santemontroyal.com', '438-555-0186', 21),
(52, 'Amethyst', 'Mertz', 'amethyst.mer@santemontroyal.com', '438-555-0155', 22),
(53, 'Maire', 'Bunch', 'mairebun@santemontroyal.com', '438-555-0164', 22),
(54, 'Zakai', 'Gravel', 'za.grav@santemontroyal.com', '438-555-0194', 23),
(55, 'Seung', 'Zeng', 'seuzeng@santemontroyal.com', '438-555-0140', 23),
(56, 'Janisa', 'Tindle', 'janitindl@santemontroyal.com', '438-555-0150', 24),
(1000, 'Foo', 'Rosas', 'pablodamir.unionmdmtl@gmail.com', '(514) 878-2216', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `last_name`, `email`, `phone`, `date_of_birth`, `gender`, `username`, `password`) VALUES
(1, 'Demitrius', 'Dehn', 'de.de@autozone-inc.info', '(250) 383-2213', '1985-12-23', 'Male', 'de.de', 'Aby*aHE'),
(2, 'Kavan', 'Robichaux', 'kavan_rob@diaperstack.com', '(613) 736-0121', '1965-12-23', 'Male', 'kavan_rob', 'E(ypY5yB'),
(3, 'Madelia', 'Alton', 'madeliaal@diaperstack.com', '(902) 466-4505', '1983-03-23', 'Female', 'madeliaal', 'E]YXU/yZU!'),
(4, 'Anona', 'Stender', 'anstend@acusage.net', '(780) 995-3333', '1993-03-20', 'Female', 'anstend', 'u+y%YjUTaJE('),
(5, 'Demitrius', 'Poss', 'demitrius_poss@consolidated-farm-research.net', '(519) 875-2246', '1975-03-02', 'Male', 'demitrius_poss', 'eVU-E*y'),
(6, 'An', 'Soares', 'an.so@autozone-inc.info', '(403) 887-0003', '1999-03-22', 'Female', 'an.so', 'U#utY=a'),
(7, 'Jon', 'Dhillon', 'jon.dhillon@diaperstack.com', '(604) 876-1119', '1993-04-23', 'Male', 'jon.dhillo', 'U$y_aPe2U'),
(8, 'Trind', 'Kirchhoff', 'trin.kirchh@diaperstack.com', '(604) 507-7678', '1999-02-09', 'Female', 'trin.kirchh', 'E$UBu]a'),
(9, 'Mawgan', 'Kraus', 'makr@autozone-inc.info', '(450) 625-6428', '1995-12-03', 'Male', 'makr', 'a^AZUsy'),
(11, 'Delbert', 'Marble', 'delbert.ma@arketmay.com', '(416) 461-0279', '1963-04-15', 'Male', 'delbert.ma', 'esepu}u]E_'),
(12, 'Ambar', 'McPeak', 'am.mcpeak@careful-organics.org', '(250) 385-1999', '1984-02-13', 'Male', 'am.mcpeak', 'Y3AgEhaJ'),
(13, 'Reimar', 'Rosas', 'de.de@autozone-inc.info', '(250) 383-2213', '1985-12-23', 'Male', '', 'Aby*aHE'),
(1000, 'Reimar', 'Rosas', 'de.de@autozone-inc.info', '(250) 383-2213', '1985-12-23', 'Male', '', 'Aby*aHE');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `is_available`, `doctor_id`) VALUES
(1, 0, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(13, 0, 13),
(14, 0, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 0, 21),
(22, 0, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 0, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 0, 33),
(34, 1, 34),
(35, 0, 35),
(36, 1, 36),
(37, 0, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(41, 1, 41),
(42, 1, 42),
(43, 1, 43),
(44, 0, 44),
(45, 1, 45),
(46, 1, 46),
(47, 0, 47),
(48, 1, 48),
(49, 0, 49),
(50, 1, 50),
(51, 1, 51),
(52, 1, 52),
(53, 1, 53),
(54, 1, 54),
(55, 1, 55),
(56, 1, 56);

-- --------------------------------------------------------

--
-- Table structure for table `ws_log`
--

CREATE TABLE `ws_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

CREATE TABLE `ws_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2022-12-01 08:11:50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`,`doctor_id`,`clinic_id`),
  ADD KEY `FK_appointment_clinic_id` (`clinic_id`),
  ADD KEY `FK_appointment_doctor_id` (`doctor_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `days_of_week`
--
ALTER TABLE `days_of_week`
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_appointment_clinic_id` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_appointment_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_appointment_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `days_of_week`
--
ALTER TABLE `days_of_week`
  ADD CONSTRAINT `FK_days_of_week_schedule_id` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `FK_department_clinic_id` FOREIGN KEY (`clinic_id`) REFERENCES `clinic` (`clinic_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `FK_doctor_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_schedule_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
