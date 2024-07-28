-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2024 at 06:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `imtiaz`
--

-- --------------------------------------------------------

-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int NOT NULL AUTO_INCREMENT,
  `studName` varchar(50) NOT NULL,
  `studIC` varchar(12) NOT NULL,
  `studGender` varchar(2) NOT NULL,
  `studDOB` date DEFAULT NULL,
  `studAge` int DEFAULT NULL,
  `studPhone` varchar(15) DEFAULT NULL,
  `studState` varchar(50) DEFAULT NULL,
  `studDistrict` varchar(50) DEFAULT NULL,
  `studPostcode` int DEFAULT NULL,
  `studAddress` varchar(100) DEFAULT NULL,
  `studRace` varchar(20) DEFAULT NULL,
  `studParentName` varchar(50) DEFAULT NULL,
  `studParentNo` varchar(20) DEFAULT NULL,
  `studEmail` varchar(30) DEFAULT NULL,
  `studPassword` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`studID`),
  UNIQUE KEY `studEmail` (`studEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `studIC`, `studGender`, `studDOB`, `studAge`, `studPhone`, `studState`, `studDistrict`, `studPostcode`, `studAddress`, `studRace`, `studParentName`, `studParentNo`, `studEmail`, `studPassword`) VALUES
(2022495412, 'Iqmal', '030923090345', 'M', '2007-09-23', 17, '0195673421', 'Wilayah Persekutuan Kuala Lumpur', 'N/A', 16200, 'UITMKT', 'MELAYU', 'Ali', '0123456789', '20225@imtiaz.edu.my', 'stud1'),
(2022495672, 'Zambri', '030415034557', 'M', '2006-04-15', 18, '0189876543', 'Selangor', 'Klang', 41200, 'No 123, Jalan ABC', 'MELAYU', 'Abu', '0123456789', '20226@imtiaz.edu.my', '123'),
(2022495673, 'Aishah', '041215045678', 'F', '2007-12-15', 16, '0176543210', 'Penang', 'Georgetown', 10200, 'No 456, Jalan DEF', 'MELAYU', 'Fatimah', '0198765432', '20227@imtiaz.edu.my', 'stud2'),
(2022495674, 'Farid', '050323056789', 'M', '2006-03-23', 18, '0165432109', 'Johor', 'Johor Bahru', 81200, 'No 789, Jalan GHI', 'MELAYU', 'Hassan', '0197654321', '20228@imtiaz.edu.my', 'stud3'),
(2022495675, 'Nadia', '060417067890', 'F', '2007-04-17', 17, '0154321098', 'Perak', 'Ipoh', 30200, 'No 101, Jalan JKL', 'MELAYU', 'Nor', '0196543210', '20229@imtiaz.edu.my', 'stud4'),
(2022495676, 'Hafiz', '070528078901', 'M', '2008-05-28', 16, '0143210987', 'Sarawak', 'Kuching', 93200, 'No 112, Jalan MNO', 'MELAYU', 'Ismail', '0195432109', '20230@imtiaz.edu.my', 'stud5'),
(2022495677, 'Mira', '080619089012', 'F', '2008-06-19', 16, '0132109876', 'Sabah', 'Kota Kinabalu', 88200, 'No 123, Jalan PQR', 'MELAYU', 'Rashidah', '0194321098', '20231@imtiaz.edu.my', 'stud6'),
(2022495678, 'Zaid', '090710090123', 'M', '2009-07-10', 15, '0121098765', 'Pahang', 'Kuantan', 25200, 'No 134, Jalan STU', 'MELAYU', 'Zain', '0193210987', '20232@imtiaz.edu.my', 'stud7'),
(2022495679, 'Lina', '100801091234', 'F', '2008-08-01', 15, '0110987654', 'Terengganu', 'Kuala Terengganu', 20200, 'No 145, Jalan VWX', 'MELAYU', 'Salmah', '0192109876', '20233@imtiaz.edu.my', 'stud8'),
(2022495680, 'Haziq', '101002092345', 'M', '2010-10-02', 13, '0109876543', 'Kelantan', 'Kota Bharu', 15200, 'No 156, Jalan YZ', 'MELAYU', 'Rahim', '0191098765', '20234@imtiaz.edu.my', 'stud9'),
(2022495681, 'Alya', '091101103456', 'F', '2009-11-01', 14, '0198765432', 'Negeri Sembilan', 'Seremban', 70200, 'No 167, Jalan ABC', 'MELAYU', 'Siti', '0189876543', '20235@imtiaz.edu.my', 'stud10'),
(2022495682, 'Syafiq', '100202104567', 'M', '2010-02-02', 14, '0187654321', 'Melaka', 'Melaka Tengah', 75200, 'No 178, Jalan DEF', 'MELAYU', 'Musa', '0188765432', '20236@imtiaz.edu.my', 'stud11'),
(2022495683, 'Fatin', '091203115678', 'F', '2009-12-03', 14, '0176543210', 'Perlis', 'Kangar', 18200, 'No 189, Jalan GHI', 'MELAYU', 'Aminah', '0187654321', '20237@imtiaz.edu.my', 'stud12'),
(2022495684, 'Azman', '080404126789', 'M', '2008-04-04', 16, '0165432109', 'Kedah', 'Alor Setar', 52200, 'No 190, Jalan JKL', 'MELAYU', 'Hussein', '0186543210', '20238@imtiaz.edu.my', 'stud13'),
(2022495685, 'Nabila', '070505137890', 'F', '2007-05-05', 17, '0154321098', 'Labuan', 'Labuan', 87000, 'No 201, Jalan MNO', 'MELAYU', 'Naimah', '0185432109', '20239@imtiaz.edu.my', 'stud14'),
(2022495686, 'Haziqah', '080606148901', 'F', '2008-06-06', 16, '0143210987', 'Putrajaya', 'Putrajaya', 62000, 'No 212, Jalan PQR', 'MELAYU', 'Nasir', '0184321098', '20240@imtiaz.edu.my', 'stud15'),
(2022495687, 'Ahmad', '090707159012', 'M', '2009-07-07', 15, '0132109876', 'Selangor', 'Shah Alam', 40100, 'No 223, Jalan STU', 'MELAYU', 'Rahmat', '0183210987', '20241@imtiaz.edu.my', 'stud16'),
(2022495688, 'Zarina', '080808160123', 'F', '2008-08-08', 15, '0121098765', 'Selangor', 'Petaling Jaya', 46000, 'No 234, Jalan VWX', 'MELAYU', 'Razak', '0182109876', '20242@imtiaz.edu.my', 'stud17'),
(2022495689, 'Adib', '090909171234', 'M', '2009-09-09', 14, '0110987654', 'Johor', 'Batu Pahat', 83000, 'No 245, Jalan YZ', 'MELAYU', 'Amran', '0181098765', '20243@imtiaz.edu.my', 'stud18'),
(2022495690, 'Siti', '100101182345', 'F', '2010-01-01', 14, '0109876543', 'Perak', 'Taiping', 34000, 'No 256, Jalan ABC', 'MELAYU', 'Azizah', '0180987654', '20244@imtiaz.edu.my', 'stud19'),
(2022495691, 'Hafiza', '091002193456', 'F', '2009-10-02', 14, '0198765432', 'Penang', 'Butterworth', 12300, 'No 267, Jalan DEF', 'MELAYU', 'Rahima', '0179876543', '20245@imtiaz.edu.my', 'stud20');

-- --------------------------------------------------------

-- Table structure for table `clerk`
--

CREATE TABLE `clerk` (
  `clerkID` int NOT NULL AUTO_INCREMENT,
  `clerkName` varchar(50) NOT NULL,
  `clerkPhone` varchar(15) NOT NULL,
  `clerkEmail` varchar(30) DEFAULT NULL,
  `clerkPassword` varchar(30) NOT NULL,
  PRIMARY KEY (`clerkID`),
  UNIQUE KEY `clerkEmail` (`clerkEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `clerk`
--

INSERT INTO `clerk` (`clerkID`, `clerkName`, `clerkPhone`, `clerkEmail`, `clerkPassword`) VALUES
(601725, 'Fauzan Halim', '0189864532', 'staff1@imtiaz.edu.my', 'clerk1'),
(601726, 'Nur Aina', '0189765432', 'staff2@imtiaz.edu.my', 'clerk2'),
(601727, 'Ahmad Bakar', '0189654321', 'staff3@imtiaz.edu.my', 'clerk3'),
(601728, 'Zulkifli Zain', '0189543210', 'staff4@imtiaz.edu.my', 'clerk4'),
(601729, 'Siti Mariam', '0189432109', 'staff5@imtiaz.edu.my', 'clerk5');

-- --------------------------------------------------------

-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principalID` int NOT NULL AUTO_INCREMENT,
  `principalName` varchar(50) NOT NULL,
  `principalPhone` varchar(15) NOT NULL,
  `principalEmail` varchar(30) DEFAULT NULL,
  `principalPassword` varchar(30) NOT NULL,
  PRIMARY KEY (`principalID`),
  UNIQUE KEY `principalEmail` (`principalEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principalID`, `principalName`, `principalPhone`, `principalEmail`, `principalPassword`) VALUES
(703654, 'Saidi', '0164332878', 'principal@imitaz.edu.my', 'principal1');

-- --------------------------------------------------------

-- Table structure for table `register`
--

CREATE TABLE `register` (
  `registerID` int NOT NULL AUTO_INCREMENT,
  `registerDate` date DEFAULT NULL,
  `registerStatus` varchar(20) DEFAULT 'PENDING',
  `registerDesc` varchar(50) DEFAULT NULL,
  `studID` int DEFAULT NULL,
  `clerkID` int DEFAULT NULL,
  PRIMARY KEY (`registerID`),
  KEY `studID` (`studID`),
  KEY `clerkID` (`clerkID`),
  CONSTRAINT `register_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  CONSTRAINT `register_ibfk_2` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`clerkID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `register`
--

INSERT INTO `register` (`registerID`, `registerDate`, `registerStatus`, `registerDesc`, `studID`, `clerkID`) VALUES
(300200, '2024-06-01', 'REJECTED', 'Incorrect personal or student information!', 2022495412, 601725),
(300201, '2024-06-02', 'ACCEPTED', NULL, 2022495672, 601726),
(300202, '2024-06-03', 'ACCEPTED', NULL, 2022495673, 601727),
(300203, '2024-06-04', 'ACCEPTED', NULL, 2022495674, 601728),
(300204, '2024-06-05', 'ACCEPTED', NULL, 2022495675, 601729),
(300205, '2024-06-06', 'ACCEPTED', NULL, 2022495676, 601725),
(300206, '2024-06-07', 'ACCEPTED', NULL, 2022495677, 601726),
(300207, '2024-06-08', 'ACCEPTED', NULL, 2022495678, 601727),
(300208, '2024-06-09', 'ACCEPTED', NULL, 2022495679, 601728),
(300209, '2024-06-10', 'ACCEPTED', NULL, 2022495680, 601729),
(300210, '2024-06-11', 'ACCEPTED', NULL, 2022495681, 601725),
(300211, '2024-06-12', 'ACCEPTED', NULL, 2022495682, 601726),
(300212, '2024-06-13', 'ACCEPTED', NULL, 2022495683, 601727),
(300213, '2024-06-14', 'ACCEPTED', NULL, 2022495684, 601728),
(300214, '2024-06-15', 'ACCEPTED', NULL, 2022495685, 601729),
(300215, '2024-06-16', 'ACCEPTED', NULL, 2022495686, 601725),
(300216, '2024-06-17', 'ACCEPTED', NULL, 2022495687, 601726),
(300217, '2024-06-18', 'ACCEPTED', NULL, 2022495688, 601727),
(300218, '2024-06-19', 'ACCEPTED', NULL, 2022495689, 601728),
(300219, '2024-06-20', 'ACCEPTED', NULL, 2022495690, 601729),
(300220, '2024-06-21', 'ACCEPTED', NULL, 2022495691, 601725);

COMMIT;
