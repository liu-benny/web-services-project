-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 10:51 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `time_to` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'UnionMD Montreal', '1191, Union Ave, Montréal, Qc H3B 3C3\r\n', 'Located in the heart of downtown Montreal, our private medical clinic offers a wide range of medical and specialized services.\r\nThe majority of our professionals at downtown clinic Montreal offer private services, but consultations with some of our specialists, such as the allergy or internal medicine, are covered by the Quebec health insurance.\r\nThe goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at our downtown clinic Montreal today!'),
(2, 'UnionMD Gatineau', '86, Promenade du Portage, Suite 300, Gatineau, Qc, J8X 2K1', 'Located in the heart of downtown Gatineau, our private medical clinic offers a wide range of medical and specialized services, including family medicine, surgery center, dermatology and gastroenterology center. The goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at Gatineau clinic today!'),
(3, 'UnionMD Laval', '3498 Boulevard Saint-Rose Laval, Qc, H7P 4K7', 'Our clinic in Laval offers you family medicine, minor surgeries, medical dermatology and aesthetic medicine.\r\nOur patients enjoy access to free parking.\r\n\r\nThe goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the latest technologies and experience of our doctors, in a place that reflects comfort and excellence. Get an appointment at our Laval clinic today!'),
(4, 'UnionMD Town of Mount-Royal (TMR)', '4175, Jean-Talon O, Town of Mount-Royal, Qc, H4P 1W6', 'Located 10 minutes away from the Namur metro station, our clinic on Jean-Talon West (Town of Mont-Royal) occupies the second floor of a comfortable 2-storied building. Our patients enjoy access to free parking. UnionMD Jean-Talon offers a wide range of medical and specialized services, such as medical and aesthetic dermatology, minor surgeries, podiatry, and other services. The goal of our medical clinic is to offer high quality care and consultations within a reasonable time. Your satisfaction is important to us and our team works hard for you to benefit from the'),
(5, 'SANTÉ MONT-ROYAL MEDICAL CLINIC', '4480 Chemin de la Côte de liesse, Suite 110, Ville Mont-Royal, QC, H4N 2R1', 'We are open 7 days a week and most holidays. Our doctors are qualified to see patients of all ages.');

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
(1, 'Monday', '08:00:00', '18:00:00'),
(1, 'Tuesday', '08:00:00', '18:00:00'),
(1, 'Wednesday', '08:00:00', '18:00:00'),
(1, 'Thursday', '08:00:00', '18:00:00'),
(1, 'Friday', '08:00:00', '18:00:00'),
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
(9, 'Friday', '08:00:00', '18:00:00'),
(9, 'Monday', '08:00:00', '18:00:00'),
(9, 'Tuesday', '08:00:00', '18:00:00'),
(9, 'Wednesday', '08:00:00', '18:00:00'),
(9, 'Thursday', '08:00:00', '18:00:00'),
(9, 'Saturday', '08:00:00', '18:00:00'),
(11, 'Tuesday', '08:00:00', '18:00:00'),
(10, 'Wednesday', '08:00:00', '18:00:00'),
(10, 'Thursday', '08:00:00', '18:00:00'),
(10, 'Friday', '08:00:00', '18:00:00'),
(10, 'Saturday', '08:00:00', '18:00:00'),
(11, 'Monday', '08:00:00', '18:00:00'),
(11, 'Tuesday', '08:00:00', '18:00:00'),
(11, 'Wednesday', '08:00:00', '18:00:00'),
(11, 'Thursday', '08:00:00', '18:00:00'),
(11, 'Friday', '08:00:00', '18:00:00'),
(12, 'Tuesday', '08:00:00', '18:00:00'),
(12, 'Wednesday', '08:00:00', '18:00:00'),
(12, 'Thursday', '08:00:00', '18:00:00'),
(12, 'Friday', '08:00:00', '18:00:00'),
(12, 'Saturday', '08:00:00', '18:00:00'),
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
(18, '', '08:00:00', '18:00:00'),
(18, '', '08:00:00', '18:00:00'),
(18, '', '08:00:00', '18:00:00'),
(18, '', '08:00:00', '18:00:00'),
(18, '', '08:00:00', '18:00:00'),
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
(22, 'Saturday', '08:00:00', '18:00:00');

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
(3, 'Women’s Health', 1),
(4, 'Gynecology and obstetrics', 1),
(5, 'Gastroenterology', 1),
(6, 'Podiatry', 2),
(7, 'Allergies and Immunology', 2),
(8, 'Endocrinology', 2),
(9, 'Physiotherapy', 2),
(10, 'Internal Medicine', 2),
(26, 'Urology', 3),
(27, 'Orthopedic surgery', 3),
(28, 'Mohs Surgery', 3),
(29, 'General Surgery', 3),
(30, 'Vasectomy', 3),
(31, 'Laser Center', 4),
(32, 'Aesthetic Dermatology', 4),
(33, 'Plastic Surgery', 4),
(34, 'Hair Transplant', 4),
(35, 'Dermatology', 5),
(36, 'Endocrinology', 5),
(37, 'Ear Nose and Throat', 5),
(38, 'Gynecology', 5),
(39, 'Neurology', 5);

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
(9, 'Osric', 'Boisvert', 'osri.boisve@unionmd.mtl', '(418) 335-7522', 3),
(10, 'Shiela', 'Piche', 'shiepiche@unionmd.mtl', '(450) 246-3522', 3),
(11, 'Hari', 'Stack', 'harist@unionmd.mtl', '(514) 444-5151', 3),
(12, 'Odelia', 'Houde', 'odel.houd@unionmd.mtl', '(807) 623-3705', 3),
(13, 'Irma', 'Gillespie', 'irgillespi@unionmd.mtl', '(438) 745-4449', 4),
(14, 'Lodema', 'Oney', 'lodem-one@unionmd.mtl', '(438) 473-4473', 4),
(15, 'Ziven', 'Oney', 'zive.one@unionmd.mtl', '(514) 623-3705', 5),
(16, 'Mitch', 'Bonelli', 'mitc.bone@unionmd.mtl', '(514) 985-1185', 5),
(17, 'Akilina', 'Troxell', 'akilintroxe@unionmd.gatineau', '(604) 590-0241', 6),
(18, 'Valborg', 'Sroka', 'valbosrok@unionmd.gatineau', '(514) 668-4486', 6),
(19, 'Davan', 'Ricca', 'dava.ric@unionmd.gatineau', '(514) 903-8628', 6),
(20, 'Akilina', 'Sroka', 'akilina.sro@unionmd.gatineau', '(514) 433-7881', 6),
(21, 'Agneta', 'Eyler', 'agey@unionmd.gatineau', '(514) 561-6565', 7),
(22, 'Akilina', 'Fansler', 'akfansler@unionmd.gatineau', '(514) 524-2292', 7);

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
(10, 'Kira', 'Benko', 'ki_be@acusage.net', '(450) 632-0700', '1973-03-22', 'Male', 'ki_be', 'U=eTyNe5ErA]'),
(11, 'Delbert', 'Marble', 'delbert.ma@arketmay.com', '(416) 461-0279', '1963-04-15', 'Male', 'delbert.ma', 'esepu}u]E_'),
(12, 'Ambar', 'McPeak', 'am.mcpeak@careful-organics.org', '(250) 385-1999', '1984-02-13', 'Male', 'am.mcpeak', 'Y3AgEhaJ');

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
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 0, 13),
(14, 0, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 0, 18),
(19, 1, 19),
(20, 1, 20),
(21, 0, 21),
(22, 1, 22);

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
