-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2024 at 02:43 AM
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
(300200, '2024-06-01', 'ACCEPTED', 2022495412, 601725),
(300202, '2024-07-21', 'REJECTED', 2022495415, 601725),
(300203, '2024-06-04', 'PENDING', 2022495480, 601725),
(300204, '2024-06-05', 'ACCEPTED', 2022495416, 601725),
(300205, '2024-06-06', 'REJECTED', 2022495417, 601725),
(300206, '2024-06-07', 'PENDING', 2022495418, 601725),
(300207, '2024-06-08', 'ACCEPTED', 2022495419, 601725),
(300208, '2024-06-09', 'REJECTED', 2022495420, 601725),
(300209, '2024-06-10', 'PENDING', 2022495421, 601725),
(300210, '2024-06-11', 'ACCEPTED', 2022495422, 601725),
(300211, '2024-06-12', 'REJECTED', 2022495423, 601725),
(300212, '2024-06-13', 'PENDING', 2022495424, 601725);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` int NOT NULL,
  `studName` varchar(50) NOT NULL,
  `studIC` varchar(12) NOT NULL,
  `studDOB` date DEFAULT NULL,
  `studPhone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studRace` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `studEmail` varchar(30) DEFAULT NULL,
  `studPassword` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `studIC`, `studDOB`, `studPhone`, `studAddress`, `studRace`, `studEmail`, `studPassword`) VALUES
(2022495412, 'Iqmal Bae', '030923090345', '2003-09-23', '0195673421', 'UiTMKT', 'MELAYU', '20225@imtiaz.edu.my', 'stud1'),
(2022495415, 'Amir', '030415034557', NULL, NULL, NULL, NULL, '20230@imtiaz.edu.my', 'stud6'),
(2022495416, 'Hafiz', '050423090343', '2005-04-23', '0195673425', 'UiTMKT', 'MELAYU', '202231@imtiaz.edu.my', 'stud5'),
(2022495417, 'Aminah', '050423090344', '2005-04-23', '0195673426', 'UiTMKT', 'MELAYU', '202232@imtiaz.edu.my', 'stud6'),
(2022495418, 'Kamal', '050423090345', '2005-04-23', '0195673427', 'UiTMKT', 'MELAYU', '202234@imtiaz.edu.my', 'stud7'),
(2022495419, 'Sarah', '050423090346', '2005-04-23', '0195673428', 'UiTMKT', 'MELAYU', '202235@imtiaz.edu.my', 'stud8'),
(2022495420, 'Farid', '050423090347', '2005-04-23', '0195673429', 'UiTMKT', 'MELAYU', '202236@imtiaz.edu.my', 'stud9'),
(2022495421, 'Azizah', '050423090348', '2005-04-23', '0195673430', 'UiTMKT', 'MELAYU', '202237@imtiaz.edu.my', 'stud10'),
(2022495422, 'Rosli', '050423090349', '2005-04-23', '0195673431', 'UiTMKT', 'MELAYU', '202238@imtiaz.edu.my', 'stud11'),
(2022495423, 'Maimunah', '050423090350', '2005-04-23', '0195673432', 'UiTMKT', 'MELAYU', '202239@imtiaz.edu.my', 'stud12'),
(2022495424, 'Halim', '050423090351', '2005-04-23', '0195673433', 'UiTMKT', 'MELAYU', '202240@imtiaz.edu.my', 'stud13'),
(2022495480, 'Nurul', '050423090342', '2005-04-23', '0195673424', 'UiTMKT', 'MELAYU', '202230@imtiaz.edu.my', 'stud4');

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
  MODIFY `registerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300213;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2022495671;

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
