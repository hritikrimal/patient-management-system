-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 10:53 AM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Patientid` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Language` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `District` varchar(255) NOT NULL,
  `Municipality` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(20) DEFAULT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patientid`, `Name`, `Age`, `Gender`, `Language`, `Country`, `Province`, `District`, `Municipality`, `Address`, `MobileNumber`, `DateTime`) VALUES
(41, 'Hritik Rimal', 25, 'male', '[\"nepali\",\"english\"]', 'Albania', 'None', 'None', 'None', 'Haraincha', '9845151515', '2023-06-05 04:23:52'),
(45, 'Rahul Thapa', 95, 'male', '[\"nepali\",\"english\"]', 'Nepal', 'Province No. 1', 'Ilam', 'Fakphokthum', 'Ithari', '9745845685', '2023-06-05 15:32:13'),
(46, 'Sudip Rai', 25, 'male', '[\"nepali\",\"english\"]', 'Albania', 'None', 'None', 'None', 'Netachok', '9845124512', '2023-06-06 05:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `patient_billing`
--

CREATE TABLE `patient_billing` (
  `sample_no` int(11) NOT NULL,
  `P_id` int(11) DEFAULT NULL,
  `billing_date` datetime DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `discount_percent` decimal(5,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `net_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_billing`
--

INSERT INTO `patient_billing` (`sample_no`, `P_id`, `billing_date`, `subtotal`, `discount_percent`, `discount_amount`, `net_total`) VALUES
(143, 45, '2023-06-06 10:28:09', '700.00', '0.00', '0.00', '700.00'),
(144, 41, '2023-06-06 10:28:49', '4000.00', '5.00', '200.00', '3800.00'),
(145, 46, '2023-06-06 11:33:44', '1000.00', '0.00', '0.00', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `test_record`
--

CREATE TABLE `test_record` (
  `id` int(11) NOT NULL,
  `sample_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `test_items` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_record`
--

INSERT INTO `test_record` (`id`, `sample_id`, `p_id`, `test_items`, `qty`, `unit`, `price`) VALUES
(146, 143, 45, 'x-ray', 1, '500', '500.00'),
(147, 143, 45, 'Blood', 1, '200', '200.00'),
(148, 144, 41, 'sugar', 1, '1000', '1000.00'),
(149, 144, 41, 'MRI', 1, '3000', '3000.00'),
(150, 145, 46, 'ECG', 1, '1000', '1000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patientid`);

--
-- Indexes for table `patient_billing`
--
ALTER TABLE `patient_billing`
  ADD PRIMARY KEY (`sample_no`),
  ADD KEY `foregin_p_id` (`P_id`);

--
-- Indexes for table `test_record`
--
ALTER TABLE `test_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_s_id` (`sample_id`),
  ADD KEY `fk_p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Patientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `patient_billing`
--
ALTER TABLE `patient_billing`
  MODIFY `sample_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `test_record`
--
ALTER TABLE `test_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_billing`
--
ALTER TABLE `patient_billing`
  ADD CONSTRAINT `foregin_p_id` FOREIGN KEY (`P_id`) REFERENCES `patients` (`Patientid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_record`
--
ALTER TABLE `test_record`
  ADD CONSTRAINT `fk_p_id` FOREIGN KEY (`p_id`) REFERENCES `patients` (`Patientid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_s_id` FOREIGN KEY (`sample_id`) REFERENCES `patient_billing` (`sample_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
