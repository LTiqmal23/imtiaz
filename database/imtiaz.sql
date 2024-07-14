-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 05:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `clerkID` int(11) NOT NULL,
  `clerkName` varchar(50) NOT NULL,
  `clerkPhone` varchar(15) NOT NULL,
  `clerkUsername` varchar(30) NOT NULL,
  `clerkPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clerk`
--

INSERT INTO `clerk` (`clerkID`, `clerkName`, `clerkPhone`, `clerkUsername`, `clerkPassword`) VALUES
(601725, 'Fauzan', '0189864532', 'fauzan', 'clerk1');

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principalID` int(11) NOT NULL,
  `principalName` varchar(50) NOT NULL,
  `principalPhone` varchar(15) NOT NULL,
  `principalUsername` varchar(30) NOT NULL,
  `principalPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principalID`, `principalName`, `principalPhone`, `principalUsername`, `principalPassword`) VALUES
(703654, 'Saidi', '0164332878', 'saidi', 'principal1');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `registerID` int(11) NOT NULL,
  `registerDate` date DEFAULT NULL,
  `studID` int(11) DEFAULT NULL,
  `clerkID` int(11) DEFAULT NULL,
  `principalID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int(11) NOT NULL,
  `studName` varchar(50) NOT NULL,
  `studIC` varchar(12) NOT NULL,
  `studDOB` date NOT NULL,
  `studPhone` varchar(15) NOT NULL,
  `studAddress` varchar(100) NOT NULL,
  `studRace` varchar(20) NOT NULL,
  `studUsername` varchar(30) NOT NULL,
  `studPassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `studIC`, `studDOB`, `studPhone`, `studAddress`, `studRace`, `studUsername`, `studPassword`) VALUES
(2022495412, 'iqmal', '030923090345', '2003-09-23', '0195673421', 'UiTMKT', 'MELAYU', 'iqmal', 'kemah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clerk`
--
ALTER TABLE `clerk`
  ADD PRIMARY KEY (`clerkID`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principalID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`registerID`),
  ADD KEY `studID` (`studID`),
  ADD KEY `clerkID` (`clerkID`),
  ADD KEY `principalID` (`principalID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clerk`
--
ALTER TABLE `clerk`
  MODIFY `clerkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601726;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `principalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703655;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `registerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2022495413;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`clerkID`) REFERENCES `clerk` (`clerkID`),
  ADD CONSTRAINT `register_ibfk_3` FOREIGN KEY (`principalID`) REFERENCES `principal` (`principalID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
