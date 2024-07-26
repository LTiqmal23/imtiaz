-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2024 at 02:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imtiaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `clerk`
--

CREATE TABLE `clerk` (
  `clerkID` int NOT NULL,
  `clerkName` varchar(50) NOT NULL,
  `clerkPhone` varchar(15) NOT NULL,
  `clerkEmail` varchar(30) DEFAULT NULL,
  `clerkPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clerk`
--

INSERT INTO `clerk` (`clerkID`, `clerkName`, `clerkPhone`, `clerkEmail`, `clerkPassword`) VALUES
(601725, 'Fauzan Halim', '0189864532', 'staff1@imitaz.edu.my', 'clerk1');

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principalID` int NOT NULL,
  `principalName` varchar(50) NOT NULL,
  `principalPhone` varchar(15) NOT NULL,
  `principalEmail` varchar(30) DEFAULT NULL,
  `principalPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principalID`, `principalName`, `principalPhone`, `principalEmail`, `principalPassword`) VALUES
(703654, 'Saidi', '0164332878', 'principal@imitaz.edu.my', 'principal1');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `registerID` int NOT NULL,
  `registerDate` date DEFAULT NULL,
  `registerStatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'PENDING',
  `studID` int DEFAULT NULL,
  `clerkID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`registerID`, `registerDate`, `registerStatus`, `studID`, `clerkID`) VALUES
(300200, '2024-06-01', 'ACCEPTED', 2022495412, 601725);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int NOT NULL,
  `studName` varchar(50) NOT NULL,
  `studIC` varchar(12) NOT NULL,
  `studGender` varchar(2) NOT NULL,
  `studDOB` date DEFAULT NULL,
  `studPhone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studState` varchar(50) DEFAULT NULL,
  `studDistrict` varchar(50) DEFAULT NULL,
  `studPoscode` int DEFAULT NULL,
  `studAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studRace` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studEmail` varchar(30) DEFAULT NULL,
  `studPassword` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `studIC`, `studGender`, `studDOB`, `studPhone`, `studState`, `studDistrict`, `studPoscode`, `studAddress`, `studRace`, `studEmail`, `studPassword`) VALUES
(2022495412, 'Iqmal', '030923090345', 'M', '2003-09-23', '0195673421', 'KELANTAN', 'TUMPAT', 16200, 'UiTMKT', 'MELAYU', '20225@imtiaz.edu.my', 'stud1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clerk`
--
ALTER TABLE `clerk`
  ADD PRIMARY KEY (`clerkID`),
  ADD UNIQUE KEY `clerkEmail` (`clerkEmail`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principalID`),
  ADD UNIQUE KEY `principalEmail` (`principalEmail`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`registerID`),
  ADD KEY `studID` (`studID`),
  ADD KEY `clerkID` (`clerkID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`),
  ADD UNIQUE KEY `studEmail` (`studEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clerk`
--
ALTER TABLE `clerk`
  MODIFY `clerkID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601728;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `principalID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703655;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `registerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300214;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2022495672;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`clerkID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
