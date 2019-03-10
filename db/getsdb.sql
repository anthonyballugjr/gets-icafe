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
(1, 'Admin', 'active', 'Ballug', 'Anthony', 'De Guzman', 'juandelacruz@yahoo.com', 'admin', '200ceb26807d6bf99fd6f4f0d1ca54d4', '09123456789', '482268.jpg'),
(15, 'Admin', 'active', 'Padua', 'Lyra', 'Smith', 'lyra12padua@gmail.com', 'lyra', '200ceb26807d6bf99fd6f4f0d1ca54d4', '11111111111', '745055.png'),
(16, 'Admin', 'active', 'Snoop', 'Jepoy', '', 'quitorianojepri@yahoo.com', 'Jepoy', '200ceb26807d6bf99fd6f4f0d1ca54d4', '09123456789', '185245.png'),
(17, 'Admin', 'active', 'Flores', 'Reindel', 'Fourtwenty', 'reindel.flores@gmail.com', 'haliksacobra420', '200ceb26807d6bf99fd6f4f0d1ca54d4', '', ''),
(18, 'Admin', 'active', 'Cecilio', 'Ralph', 'Noble', 'ralph.anthony.cecilio@hcltech.com', 'siralphako', '200ceb26807d6bf99fd6f4f0d1ca54d4', '09124356789', '404987.png'),
(19, 'Member', 'active', 'Dela Cruz', 'Juan', 'Tamad', 'juantamad@gmail.com', 'juantamad', 'dd4b21e9ef71e1291183a46b913ae6f2', '09123456789', '218406.png'),
(20, 'Member', 'active', 'Ballug', 'Anthony', 'De Guzman', 'anthonyballugjr@gmail.com', 'anthonyballugjr', '15f1e6dc8b', '', ''),
(22, 'Member', 'active', 'Ballug', 'Liandra', '', 'liandra@yahoo.com', 'maymaytot', 'f6b19ea89ba72249f3d337cff6709fdf', '09128094188', '883673.'),
(23, 'Member', 'active', 'Ballug', 'Liandra Mhay', '', 'liandra@yahoo.com', 'liandramhay', '15f1e6dc8b', '09128094109', ''),
(24, 'Member', 'active', 'Ballug', 'Lenlen', 'Estipona', 'jam@yahoo.com', 'jamel', '15f1e6dc8b', '09128094109', '966811.jpg'),
(25, 'Member', 'active', 'Rizal', 'Jose', 'Protacio', 'joserizal@yahoo.com', 'joserizal', '4bdec768f727fb72f1445f6bccbbdaba', '09123456789', '828403.jpg'),
(28, 'Attendant', 'active', 'Bonifacio', 'Andres', 'Supremo', 'supremo@yahoo.com', 'supremo', '25d55ad283aa400af464c76d713c07ad', '09123456789', '860228.png'),
(29, 'Member', 'deactivated', 'Padua', 'Ly', 'Ra', 'ly@g.com', 'ly', '25d55ad283aa400af464c76d713c07ad', '09876543212', '876136.png'),
(35, 'Member', 'active', 'Marley', 'Bob', '', 'bob.marley@yahoo.com', 'bob.marley', '25d55ad283aa400af464c76d713c07ad', '09123456789', NULL),
(36, 'Attendant', 'active', 'Dogg', 'Snoop', '', 'snoop.dogg@yahoo.com', 'snoop.dogg', '5e8667a439c68f5145dd2fcbecf02209', '09123456789', '158726.png'),
(40, 'Member', 'active', 'Cole', 'Jay', '', 'jcole@yahoo.com', 'j.cole', '5e8667a439c68f5145dd2fcbecf02209', '09123456789', '943311.png'),
(47, 'member', 'active', 'aaa', 'aaa', 'aaa', 'aaa', 'sss', 'ef775988943825d2871e1cfa75473ec0', '99999999999', NULL),
(48, 'Member', 'active', 'Apeks', 'Loonie', '', 'loonie@y.com', 'loonie', '482c811da5d5b4bc6d497ffa98491e38', '09123456789', NULL),
(49, 'Attendant', 'active', 'B', 'B', 'B', 'ay@y.com', 'a', '25d55ad283aa400af464c76d713c07ad', '09123456789', NULL),
(50, 'Member', 'active', 'Martinez', 'Erna', '', 'erna.martinez@yahoo.com', 'erna', '5e8667a439c68f5145dd2fcbecf02209', '09123456789', NULL),
(51, 'Attendant', 'active', 'Del', 'Rerendel', '', 'ren@yahoo.com', 'rerendel', '25d55ad283aa400af464c76d713c07ad', '09123456789', NULL);

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
(53, 1, 20, '', '2018-04-17'),
(54, 1, 30, '', '2018-04-17'),
(55, 1, 10, '', '2018-04-17'),
(56, 1, 20, '', '2018-04-18'),
(57, 3, 20, '', '2018-04-18'),
(58, 1, 20, '', '2018-04-18'),
(59, 2, 30, '', '2018-04-19'),
(60, 2, 30, '', '2018-04-19'),
(61, 7, 10, 'Nanadaime Hokage', '2018-04-20'),
(62, 7, 10, 'Nanadaime Hokage', '2018-04-20'),
(63, 4, 10, 'Nanadaime Hokage', '2018-04-20'),
(64, 2, 10, 'Reindel Flores', '2018-04-21'),
(65, 3, 30, 'Reindel Flores', '2018-04-21'),
(66, 2, 10, 'Nanadaime Hokage', '2018-04-23'),
(67, 4, 20, 'Nanadaime Hokage', '2018-04-23'),
(68, 5, 10, 'Nanadaime Hokage', '2018-04-23'),
(69, 6, 10, 'Jeffry Quitoriano', '2018-04-23'),
(70, 1, 30, 'Jeffry Quitoriano', '2018-04-23'),
(71, 4, 20, 'Nanadaime Hokage', '2018-04-23'),
(72, 5, 30, 'Nanadaime Hokage', '2018-04-23'),
(73, 2, 20, 'Nanadaime Hokage', '2018-04-23'),
(74, 1, 20, 'Nanadaime Hokage', '2018-04-23'),
(75, 6, 20, 'Nanadaime Hokage', '2018-04-23'),
(76, 3, 20, 'Nanadaime Hokage', '2018-04-23'),
(77, 4, 30, 'Nanadaime Hokage', '2018-04-23'),
(78, 3, 20, 'Nanadaime Hokage', '2018-04-23'),
(79, 3, 20, 'Nanadaime Hokage', '2018-04-23'),
(80, 2, 20, 'Nanadaime Hokage', '2018-04-24'),
(81, 3, 20, 'Nanadaime Hokage', '2018-04-24'),
(82, 4, 20, 'Nanadaime Hokage', '2018-04-24'),
(83, 7, 20, 'Nanadaime Hokage', '2018-04-24'),
(84, 5, 10, 'Nanadaime Hokage', '2018-04-24'),
(85, 1, 10, 'Nanadaime Hokage', '2018-04-24'),
(86, 1, 10, 'Nanadaime Hokage', '2018-04-24'),
(87, 2, 20, 'Nanadaime Hokage', '2018-04-24'),
(88, 2, 20, 'Nanadaime Hokage', '2018-04-24'),
(89, 4, 20, 'Nanadaime Hokage', '2018-04-24'),
(90, 1, 20, 'Nanadaime Hokage', '2018-04-24'),
(91, 3, 20, 'Nanadaime Hokage', '2018-04-24'),
(92, 6, 20, 'Nanadaime Hokage', '2018-04-24'),
(93, 3, 20, 'Nanadaime Hokage', '2018-04-24'),
(94, 1, 20, 'Nanadaime Hokage', '2018-04-24'),
(95, 2, 30, 'Nanadaime Hokage', '2018-04-24'),
(96, 2, 20, 'Nanadaime Hokage', '2018-04-24'),
(97, 2, 10, 'Nanadaime Hokage', '2018-04-24'),
(98, 2, 10, 'Nanadaime Hokage', '2018-04-24'),
(99, 2, 10, 'Nanadaime Hokage', '2018-04-24'),
(100, 2, 20, 'Nanadaime Hokage', '2018-04-25'),
(101, 9, 30, 'Nanadaime Hokage', '2018-04-25'),
(102, 2, 20, 'Nanadaime Hokage', '2018-04-25'),
(103, 5, 30, 'Nanadaime Hokage', '2018-04-25'),
(104, 1, 20, 'Anthony Ballug', '2018-06-04'),
(105, 6, 10, 'Anthony Ballug', '2018-08-07'),
(106, 7, 20, 'Anthony Ballug', '2018-11-11'),
(107, 8, 30, 'Anthony Ballug', '2018-11-12'),
(108, 31, 10, 'Anthony Ballug', '2019-03-08');

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
(1, '1 ream short bond paper', 200, '', '2018-04-03'),
(2, '1 ream bond paper', 200, '', '2018-04-03'),
(3, '1 ream long bond paper', 350, '', '2018-04-03'),
(4, 'groceries', 2000, '', '2018-04-03'),
(5, '1 ream long bond paper', 300, '', '2018-04-05'),
(6, 'Groceries', 800, '', '2018-04-05'),
(7, '1 ream long bond paper', 250, '', '2018-04-09'),
(8, 'Get some dubi with love', 100, '', '2018-04-13'),
(9, 'Get some dubi with much love', 120, '', '2018-04-13'),
(10, 'Bumili kami ng mcdo fries \'LARGE\'', 100, '', '2018-04-18'),
(11, '4/20 Party!', 2000, 'Nanadaime Hokage', '2018-04-20'),
(12, 'Turks', 123, 'Jeffry Quitoriano', '2018-04-23'),
(13, '1 rim of short bond paper', 100, 'Jeffry Quitoriano', '2018-04-23'),
(14, 'Xxx', 123, 'Anthony Ballug', '2019-03-09');

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
(23, 4, 19, '00:00:01', '00:00:04', '2018-04-23'),
(24, 4, 19, '00:00:02', '00:00:04', '2018-04-23'),
(25, 4, 19, '00:00:00', '00:00:10', '2018-04-23'),
(26, 4, 19, '00:00:00', '00:00:11', '2018-04-23'),
(27, 7, 50, '00:00:10', '00:00:01', '2018-04-23'),
(28, 8, 50, '00:00:10', '00:00:01', '2018-04-23'),
(29, 7, 35, '00:00:10', '00:00:01', '2018-04-23'),
(30, 6, 19, '10 PM', '11 PM', '2018-04-25'),
(31, 4, 19, '11 PM', '11 PM', '2018-04-25'),
(32, 6, 19, '11 AM', '12 PM', '2018-04-26'),
(33, 7, 19, '04 PM', '05 PM', '2018-06-03'),
(34, 2, 19, '11 PM', '12 AM', '2018-06-04'),
(35, 6, 19, '06 PM', '07 PM', '2018-08-07'),
(36, 6, 19, '05 PM', '06 PM', '2018-11-10'),
(37, 6, 19, '02 AM', '05 AM', '2018-11-11'),
(38, 1, 19, '02 PM', '04 PM', '2018-11-12');

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
(1, 'F&B', 'Cold Drink (8 oz)', 12, 0),
(2, 'F&B', 'Cold Drink (12 oz)', 17, 0),
(3, 'F&B', 'Chips (Small)', 15, 0),
(4, 'F&B', 'Chips (Big)', 30, 0),
(5, 'Print/Scan', 'Print (Short)', 2, 0),
(6, 'Downloads', 'Movie', 15, 0),
(7, 'Downloads', 'Music', 5, 0),
(8, 'Print/Scan', 'Print (Full page colored)', 15, 0),
(9, 'Print/Scan', 'Print (Long)', 4, 0),
(10, 'Print/Scan', 'Scan', 10, 0),
(11, 'F&B', 'Hot Drink (8 oz)', 12, 0),
(13, 'Downloads', 'Software', 50, 0),
(14, 'F&B', 'Cookies', 8, 0),
(101, 'Prepaid Load', 'Prepaid Load (200)', 0, 1),
(102, 'Prepaid Load', 'Prepaid Load (100)', 0, 1),
(103, 'Prepaid Load', 'Prepaid Load (50)', 0, 1),
(104, 'Print/Scan', 'BT', 15, 0);

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
(8, 11, 7, 84, 'Nanadaime Hokage', '2018-03-26'),
(9, 8, 2, 30, 'Nanadaime Hokage', '2018-03-26'),
(10, 3, 3, 45, 'Nanadaime Hokage', '2018-03-27'),
(11, 4, 5, 150, 'Nanadaime Hokage', '2018-03-27'),
(12, 2, 6, 102, 'Nanadaime Hokage', '2018-03-27'),
(13, 5, 10, 20, 'Nanadaime Hokage', '2018-03-27'),
(16, 7, 3, 15, 'Nanadaime Hokage', '2018-03-27'),
(17, 12, 1, 18, 'Nanadaime Hokage', '2018-03-27'),
(18, 8, 1, 15, 'Nanadaime Hokage', '2018-03-27'),
(19, 1, 4, 48, 'Nanadaime Hokage', '2018-03-27'),
(20, 7, 1, 5, 'Nanadaime Hokage', '2018-03-27'),
(21, 4, 5, 150, 'Nanadaime Hokage', '2018-03-27'),
(22, 4, 4, 120, 'Nanadaime Hokage', '2018-03-27'),
(23, 4, 5, 150, 'Nanadaime Hokage', '2018-03-31'),
(24, 13, 3, 150, 'Nanadaime Hokage', '2018-03-31'),
(25, 2, 6, 102, 'Nanadaime Hokage', '2018-03-31'),
(26, 2, 6, 102, 'Nanadaime Hokage', '2018-03-31'),
(27, 9, 1, 4, 'Nanadaime Hokage', '2018-03-31'),
(28, 9, 1, 4, 'Nanadaime Hokage', '2018-03-31'),
(29, 11, 6, 72, 'Nanadaime Hokage', '2018-03-31'),
(30, 13, 3, 150, 'Nanadaime Hokage', '2018-03-31'),
(31, 9, 1, 4, 'Nanadaime Hokage', '2018-03-31'),
(32, 7, 1, 5, 'Nanadaime Hokage', '2018-03-31'),
(33, 4, 4, 120, 'Nanadaime Hokage', '2018-03-31'),
(34, 3, 1, 15, 'Nanadaime Hokage', '2018-03-31'),
(35, 12, 1, 18, 'Nanadaime Hokage', '2018-03-31'),
(36, 6, 5, 75, 'Nanadaime Hokage', '2018-04-01'),
(37, 11, 6, 72, 'Nanadaime Hokage', '2018-04-01'),
(38, 7, 1, 5, 'Nanadaime Hokage', '2018-04-01'),
(39, 4, 4, 120, 'Nanadaime Hokage', '2018-04-01'),
(40, 12, 1, 18, 'Nanadaime Hokage', '2018-04-02'),
(41, 12, 1, 20, 'Nanadaime Hokage', '2018-04-02'),
(42, 1, 1, 12, 'Nanadaime Hokage', '2018-04-02'),
(43, 1, 1, 12, 'Nanadaime Hokage', '2018-04-02'),
(45, 6, 9, 135, 'Nanadaime Hokage', '2018-04-02'),
(46, 13, 2, 100, 'Nanadaime Hokage', '2018-04-02'),
(47, 0, 1, 0, 'Nanadaime Hokage', '2018-04-02'),
(48, 0, 1, 0, 'Nanadaime Hokage', '2018-04-02'),
(49, 0, 1, 0, 'Nanadaime Hokage', '2018-04-02'),
(50, 4, 4, 120, 'Nanadaime Hokage', '2018-04-03'),
(51, 3, 1, 15, 'Nanadaime Hokage', '2018-04-03'),
(52, 14, 3, 24, 'Nanadaime Hokage', '2018-04-05'),
(53, 11, 6, 72, 'Nanadaime Hokage', '2018-04-05'),
(54, 3, 1, 15, 'Nanadaime Hokage', '2018-04-05'),
(55, 11, 6, 72, 'Nanadaime Hokage', '2018-04-05'),
(56, 1, 10, 120, 'Nanadaime Hokage', '2018-04-05'),
(57, 3, 1, 15, 'Nanadaime Hokage', '2018-04-06'),
(58, 0, 1, 0, 'Nanadaime Hokage', '2018-04-06'),
(59, 0, 1, 0, 'Nanadaime Hokage', '2018-04-09'),
(60, 7, 1, 5, 'Nanadaime Hokage', '2018-04-09'),
(61, 4, 4, 120, 'Nanadaime Hokage', '2018-04-09'),
(62, 4, 4, 120, 'Nanadaime Hokage', '2018-04-10'),
(63, 11, 7, 84, 'Nanadaime Hokage', '2018-04-10'),
(64, 1, 1, 12, 'Nanadaime Hokage', '2018-04-11'),
(65, 12, 4, 80, 'Nanadaime Hokage', '2018-04-13'),
(66, 6, 9, 135, 'Nanadaime Hokage', '2018-04-13'),
(67, 7, 1, 5, 'Nanadaime Hokage', '2018-04-13'),
(68, 6, 9, 135, 'Nanadaime Hokage', '2018-04-15'),
(69, 11, 105, 1260, 'Nanadaime Hokage', '2018-04-15'),
(73, 101, 40, 206000, 'Nanadaime Hokage', '2018-04-15'),
(74, 102, 27, 2700, 'Nanadaime Hokage', '2018-04-15'),
(75, 103, 34, 1700, 'Nanadaime Hokage', '2018-04-15'),
(80, 13, 3, 150, 'Nanadaime Hokage', '2018-04-15'),
(81, 6, 8, 120, 'Nanadaime Hokage', '2018-04-17'),
(82, 102, 26, 2600, 'Nanadaime Hokage', '2018-04-17'),
(83, 103, 33, 1650, 'Nanadaime Hokage', '2018-04-17'),
(84, 103, 32, 1600, 'Nanadaime Hokage', '2018-04-18'),
(85, 101, 28, 5600, 'Nanadaime Hokage', '2018-04-18'),
(86, 102, 25, 2500, 'Nanadaime Hokage', '2018-04-18'),
(87, 2, 8, 136, 'Nanadaime Hokage', '2018-04-18'),
(88, 102, 25, 2500, 'Nanadaime Hokage', '2018-04-19'),
(89, 101, 28, 5600, 'Nanadaime Hokage', '2018-04-19'),
(90, 103, 30, 1500, 'Nanadaime Hokage', '2018-04-19'),
(91, 101, 19, 3800, 'Nanadaime Hokage', '2018-04-20'),
(92, 12, 3, 60, 'Nanadaime Hokage', '2018-04-20'),
(93, 103, 30, 1500, 'Nanadaime Hokage', '2018-04-20'),
(94, 102, 21, 2100, 'Nanadaime Hokage', '2018-04-21'),
(95, 101, 18, 3600, 'Nanadaime Hokage', '2018-04-21'),
(96, 103, 30, 1500, 'Nanadaime Hokage', '2018-04-21'),
(97, 103, 30, 1500, 'Nanadaime Hokage', '2018-04-23'),
(98, 101, 15, 3000, 'Nanadaime Hokage', '2018-04-23'),
(99, 102, 20, 2000, 'Nanadaime Hokage', '2018-04-23'),
(100, 12, 10, 200, 'Nanadaime Hokage', '2018-04-23'),
(101, 105, 1, 0, 'Nanadaime Hokage', '2018-05-06'),
(102, 7, 15, 75, 'Nanadaime Hokage', '2018-05-06'),
(103, 4, 8, 240, 'Nanadaime Hokage', '2018-06-03'),
(104, 13, 1, 50, 'Anthony Ballug', '2018-06-26'),
(105, 7, 1, 5, 'Anthony Ballug', '2018-11-14');

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
(63, 19, NULL, '00:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(64, 20, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(65, 22, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(66, 23, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(67, 24, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(68, 25, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(69, 29, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(70, 35, NULL, '00:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(71, 40, NULL, '00:00:00', '06:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(72, 47, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(73, 19, NULL, '00:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(74, 19, 'Nanadaime Hokage', '03:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(75, 19, 'Nanadaime Hokage', '09:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(76, 40, NULL, '00:00:00', '06:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(77, 40, 'Nanadaime Hokage', '12:00:00', '18:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(78, 40, 'Nanadaime Hokage', '24:00:00', '30:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(79, 40, 'Nanadaime Hokage', '30:00:00', '36:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(80, 40, 'Nanadaime Hokage', '33:00:00', '39:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(81, 35, NULL, '00:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(82, 40, NULL, '00:00:00', '06:00:00', '2018-04-23', '2018-04-25 16:00:00', NULL),
(83, 19, NULL, '00:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(84, 19, 'Nanadaime Hokage', '06:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(85, 19, 'Nanadaime Hokage', '09:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(86, 19, 'Nanadaime Hokage', '21:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(87, 19, 'Nanadaime Hokage', '27:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(88, 19, 'Nanadaime Hokage', '39:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(89, 19, 'Nanadaime Hokage', '51:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(90, 19, 'Nanadaime Hokage', '63:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(91, 40, 'Nanadaime Hokage', '06:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(92, 35, 'Nanadaime Hokage', '12:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(93, 35, 'Nanadaime Hokage', '24:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(94, 35, 'Nanadaime Hokage', '30:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(95, 19, 'Nanadaime Hokage', '75:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', 100),
(96, 19, 'Nanadaime Hokage', '81:00:00', '08:58:54', '2018-04-23', '2018-04-25 16:00:00', NULL),
(97, 48, NULL, '00:00:00', '06:00:00', '2018-04-23', '2018-04-25 16:00:00', 100),
(98, 48, NULL, '00:00:00', '06:00:00', '2018-04-23', '2018-04-25 16:00:00', 100),
(99, 48, 'B B', '03:00:00', '09:00:00', '2018-04-23', '2018-04-25 16:00:00', 100),
(100, 48, 'Nanadaime Hokage', '09:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(101, 50, NULL, '00:00:00', '12:00:00', '2018-04-23', '2018-04-25 16:00:00', 200),
(102, 50, 'Jeffry Quitoriano', '03:00:00', '15:00:00', '2018-04-23', '2018-04-25 16:00:00', 200),
(103, 35, NULL, '00:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', 50),
(104, 48, NULL, '00:00:00', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(105, 50, NULL, '02:58:08', '14:58:08', '2018-04-23', '2018-04-25 16:00:00', 200),
(106, 35, 'Jeffry Quitoriano', '03:00:00', '02:19:39', '2018-04-23', '2018-04-25 16:00:00', NULL),
(107, 50, 'Jeffry Quitoriano', '14:58:08', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(108, 35, NULL, '02:19:39', NULL, '2018-04-23', '2018-04-25 16:00:00', NULL),
(109, 19, NULL, '08:59:27', '08:58:54', '2018-04-24', '2018-04-25 16:00:00', NULL),
(110, 19, NULL, '08:58:54', NULL, '0000-00-00', '2018-11-12 06:07:21', NULL);

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
