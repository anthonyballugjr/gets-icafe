-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2019 at 10:49 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(11) NOT NULL,
  `accessLevel` varchar(20) NOT NULL,
  `accountStatus` varchar(15) NOT NULL DEFAULT 'unconfirmed',
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `accessLevel`, `accountStatus`, `lastName`, `firstName`, `middleName`, `emailAddress`, `userName`, `password`, `contactNo`, `image`) VALUES
(1, 'Admin', 'active', 'Admin', 'Admin', 'Admin', 'admin@email.com', 'admin', '200ceb26807d6bf99fd6f4f0d1ca54d4', '09123456789', NULL),
(2, 'member', 'active', 'Member', 'Member', 'Member', 'member@email.com', 'member', 'ef775988943825d2871e1cfa75473ec0', '99999999999', NULL),
(3, 'Attendant', 'active', 'Attendant', 'Attendant', 'Attendant', 'attendant@email.com', 'attendant', '25d55ad283aa400af464c76d713c07ad', '09123456789', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `computerID` int(11) NOT NULL,
  `computerNo` varchar(10) NOT NULL DEFAULT 'PC',
  `status` varchar(50) NOT NULL DEFAULT 'Vacant',
  `timeLeft` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`computerID`, `computerNo`, `status`, `timeLeft`) VALUES
(1, 'PC1', 'Vacant', '00:00:00'),
(2, 'PC2', 'Vacant', '00:00:00'),
(3, 'PC3', 'Vacant', '00:00:00'),
(4, 'PC4', 'Vacant', '00:00:00'),
(5, 'PC5', 'Vacant', '00:00:00'),
(6, 'PC6', 'Vacant', '00:00:00'),
(7, 'PC7', 'Vacant', '00:00:00'),
(8, 'PC8', 'Vacant', '00:00:00'),
(9, 'PC9', 'Vacant', '00:00:00'),
(10, 'PC10', 'Vacant', '00:00:00'),
(11, 'PC11', 'Vacant', '00:00:00'),
(12, 'PC12', 'Vacant', '00:00:00'),
(13, 'PC13', 'Vacant', '00:00:00'),
(14, 'PC14', 'Vacant', '00:00:00'),
(15, 'PC15', 'Vacant', '00:00:00'),
(16, 'PC16', 'Vacant', '00:00:00'),
(17, 'PC17', 'Vacant', '00:00:00'),
(18, 'PC18', 'Vacant', '00:00:00'),
(19, 'PC19', 'Vacant', '00:00:00'),
(20, 'PC20', 'Vacant', '00:00:00'),
(21, 'PC21', 'Vacant', '00:00:00'),
(22, 'PC22', 'Vacant', '00:00:00'),
(23, 'PC23', 'Vacant', '00:00:00'),
(24, 'PC24', 'Vacant', '00:00:00'),
(25, 'PC25', 'Vacant', '00:00:00'),
(26, 'PC26', 'Vacant', '00:00:00'),
(27, 'PC27', 'Vacant', '00:00:00'),
(28, 'PC28', 'Vacant', '00:00:00'),
(29, 'PC29', 'Vacant', '00:00:00'),
(30, 'PC30', 'Vacant', '00:00:00'),
(31, 'PC31', 'Guest', '00:30:00'),
(32, 'PC32', 'Vacant', '00:00:00'),
(33, 'PC33', 'Vacant', '00:00:00'),
(34, 'PC34', 'Vacant', '00:00:00'),
(35, 'PC35', 'Vacant', '00:00:00'),
(36, 'PC36', 'Vacant', '00:00:00'),
(37, 'PC37', 'Vacant', '00:00:00'),
(38, 'PC38', 'Vacant', '00:00:00'),
(39, 'PC39', 'Vacant', '00:00:00'),
(40, 'PC40', 'Vacant', '00:00:00'),
(41, 'PC41', 'Vacant', '00:00:00'),
(42, 'PC42', 'Vacant', '00:00:00'),
(43, 'PC43', 'Vacant', '00:00:00'),
(44, 'PC44', 'Vacant', '00:00:00'),
(45, 'PC45', 'Vacant', '00:00:00'),
(46, 'PC46', 'Vacant', '00:00:00'),
(47, 'PC47', 'Vacant', '00:00:00'),
(48, 'PC48', 'Vacant', '00:00:00'),
(49, 'PC49', 'Vacant', '00:00:00'),
(50, 'PC50', 'Vacant', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `computerlog`
--

CREATE TABLE `computerlog` (
  `sessionID` int(11) NOT NULL,
  `accountID` int(11) DEFAULT NULL,
  `computerID` int(11) DEFAULT NULL,
  `dateStamp` date NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `duration` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computerlog`
--

INSERT INTO `computerlog` (`sessionID`, `accountID`, `computerID`, `dateStamp`, `timeStamp`, `status`, `duration`) VALUES
(1, 19, 1, '0000-00-00', '2018-11-12 06:07:22', 'Member', '0:0:32');

-- --------------------------------------------------------

--
-- Table structure for table `computersale`
--

CREATE TABLE `computersale` (
  `comSaleID` int(11) NOT NULL,
  `computerID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `employeeOnDuty` varchar(100) DEFAULT NULL,
  `dateStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computersale`
--

INSERT INTO `computersale` (`comSaleID`, `computerID`, `amount`, `employeeOnDuty`, `dateStamp`) VALUES
(1, 1, 200, 'Attendant', '2018-04-17'),
(2, 1, 500, 'Admin', '2018-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenseID` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `amount` int(11) NOT NULL,
  `employeeOnDuty` varchar(100) NOT NULL,
  `dateStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenseID`, `description`, `amount`, `employeeOnDuty`, `dateStamp`) VALUES
(1, '1 ream short bond paper', 200, 'Attendant', '2018-04-03'),
(2, 'Printer black ink', 150, 'Admin', '2018-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservationID` int(11) NOT NULL,
  `computerID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `timeFrom` varchar(20) DEFAULT NULL,
  `timeTo` varchar(20) DEFAULT NULL,
  `dateStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservationID`, `computerID`, `accountID`, `timeFrom`, `timeTo`, `dateStamp`) VALUES
(1, 4, 3, '00:00:01', '00:00:04', '2018-04-23'),
(2, 4, 3, '00:00:02', '00:00:04', '2018-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceID` int(11) NOT NULL,
  `serviceCategory` varchar(50) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `servicePrice` int(11) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceID`, `serviceCategory`, `serviceName`, `servicePrice`, `isArchived`) VALUES
(1, 'Print/Scan', 'Print (Short)', 2, 0),
(2, 'Downloads', 'Movie', 15, 0),
(3, 'Prepaid Load', 'Prepaid Load (200)', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicesale`
--

CREATE TABLE `servicesale` (
  `saleID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `totalPrice` float NOT NULL,
  `employeeOnDuty` varchar(100) NOT NULL,
  `dateStamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicesale`
--

INSERT INTO `servicesale` (`saleID`, `serviceID`, `quantity`, `totalPrice`, `employeeOnDuty`, `dateStamp`) VALUES
(1, 1, 7, 84, 'Admin', '2018-03-26'),
(2, 2, 2, 30, 'Attendant', '2018-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `employeeOnDuty` varchar(50) DEFAULT NULL,
  `balanceNow` time NOT NULL,
  `balanceNew` time DEFAULT NULL,
  `dateStamp` date NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `accountID`, `employeeOnDuty`, `balanceNow`, `balanceNew`, `dateStamp`, `timeStamp`, `amount`) VALUES
(1, 1, 'Admin', '00:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(2, 2, 'Attendant', '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`computerID`),
  ADD UNIQUE KEY `computerNo` (`computerNo`);

--
-- Indexes for table `computerlog`
--
ALTER TABLE `computerlog`
  ADD PRIMARY KEY (`sessionID`);

--
-- Indexes for table `computersale`
--
ALTER TABLE `computersale`
  ADD PRIMARY KEY (`comSaleID`),
  ADD KEY `computerID` (`computerID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenseID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservationID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `servicesale`
--
ALTER TABLE `servicesale`
  ADD PRIMARY KEY (`saleID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `computer`
--
ALTER TABLE `computer`
  MODIFY `computerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `computerlog`
--
ALTER TABLE `computerlog`
  MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `computersale`
--
ALTER TABLE `computersale`
  MODIFY `comSaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `servicesale`
--
ALTER TABLE `servicesale`
  MODIFY `saleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `computersale`
--
ALTER TABLE `computersale`
  ADD CONSTRAINT `computersale_ibfk_1` FOREIGN KEY (`computerID`) REFERENCES `computer` (`computerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
