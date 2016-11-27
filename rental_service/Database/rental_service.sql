-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2016 at 07:29 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `currently_rented`
--

CREATE TABLE `currently_rented` (
  `RentalID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `CustID` int(11) NOT NULL,
  `Pickup_Date` date NOT NULL,
  `Return_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustID` int(11) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Sex` char(1) NOT NULL,
  `Date_of_birth` date NOT NULL,
  `License_class` char(2) NOT NULL,
  `License_number` varchar(15) NOT NULL,
  `License_issue` date NOT NULL,
  `License_expiry` date NOT NULL,
  `Car_rented` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustID`, `FName`, `LName`, `Address`, `Sex`, `Date_of_birth`, `License_class`, `License_number`, `License_issue`, `License_expiry`, `Car_rented`) VALUES
(0, 'admin', 'admin', 'Admin', 'X', '2016-11-26', 'XX', '000000000000000', '2016-11-26', '2016-11-26', NULL),
(1, 'ghaith', 'haddad', '60 - wont tell you', 'M', '1995-08-22', 'G2', 'H123456', '2013-10-20', '2019-11-15', NULL),
(2, 'saleh', 'nawar', '12 - somewhere in varsity', 'M', '1994-02-14', 'G2', 'N987654', '2013-05-06', '2018-07-15', NULL),
(3, 'malek', 'mustapha', '45 - dont know', 'M', '1993-12-05', 'G', 'M456987', '2012-09-23', '2017-10-15', NULL),
(4, 'fawwaz', 'khayat', '54 - ask him', 'M', '1991-10-20', 'G', 'K321456', '2010-12-30', '2016-01-01', NULL),
(5, 'mohammed', 'turki', '90 - come on man', 'M', '1993-08-20', 'G2', 'T129856', '2013-07-23', '2018-06-10', NULL),
(6, 'sally', 'andrew', '23 - not sure', 'F', '1994-04-21', 'G', 'A984532', '2012-05-31', '2018-06-01', NULL),
(8, 'Malek', 'Abdullah', '20 Brimwood Blvd. ', 'M', '1995-12-12', 'G', 'ajfiewghewtuhwe', '2011-12-12', '2016-12-12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `Location_Name` varchar(50) NOT NULL,
  `Street` varchar(150) NOT NULL,
  `City` varchar(25) NOT NULL,
  `Province` varchar(20) NOT NULL,
  `Postal_Code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Location_Name`, `Street`, `City`, `Province`, `Postal_Code`) VALUES
(1, 'North Oshawa', '50 - Simcoe Street N', 'Oshawa', 'Ontario', 'L1L0E8'),
(2, 'South Oshawa', '20 - Simcoe Street S', 'Oshawa', 'Ontario', 'N6G5K1'),
(3, 'Dundas', '20 - Dundas Sqaure', 'Toronto', 'Ontario', 'F8H1K5'),
(4, 'Square One', '503 - Square One', 'Missisuaga', 'Ontario', 'N6S9G3'),
(5, 'West Taunton', '600 - Tauton Street W', 'Oshawa', 'Ontario', 'B5G1F4'),
(6, 'East Tauton', '44 - Tauton Street E', 'Oshawa', 'Ontario', 'H3S3K5');

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `CustID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`Email`, `Password`, `CustID`) VALUES
('admin@rentalservice.com', 'admin', 0),
('ghaith@rentalservice.com', 'ghaith', 1),
('saleh@rentalservice.com', 'saleh', 2),
('malek@rentalservice.com', 'malek', 3),
('fawwaz@rentalservice.com', 'fawwaz', 4),
('mohammed@rentalservice.com', 'mohammed', 5),
('sally@rentalservice.com', 'sally', 6),
('malek@abdullah.com', 'password', 7),
('malekabdullah@live.com', 'malekk12-', 8);

-- --------------------------------------------------------

--
-- Table structure for table `owned_cars`
--

CREATE TABLE `owned_cars` (
  `CarID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Make` varchar(20) DEFAULT NULL,
  `Model` varchar(20) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Mileage` float DEFAULT NULL,
  `MPG` float DEFAULT NULL,
  `Color` varchar(10) DEFAULT NULL,
  `Transmission` int(11) DEFAULT NULL,
  `Cylinder` int(11) DEFAULT NULL,
  `Litre` float DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `No_of_seats` int(11) NOT NULL,
  `Body_Type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owned_cars`
--

INSERT INTO `owned_cars` (`CarID`, `LocationID`, `Make`, `Model`, `Year`, `Mileage`, `MPG`, `Color`, `Transmission`, `Cylinder`, `Litre`, `Price`, `No_of_seats`, `Body_Type`) VALUES
(1, 6, 'Chrysler', 'Sebring', 2007, 134000, 4.2, 'Black', 4, 4, 16.83, 35, 5, 'Sedan'),
(2, 5, 'Nissan', 'Armada', 2013, 150000, 5, 'Black', 5, 6, 20, 50, 7, 'SUV'),
(3, 3, 'honda', 'civic', 2013, 115000, 4.5, 'Grey', 6, 6, 18, 30, 5, 'Sedan'),
(4, 2, 'mazda', 'mazda 3', 2011, 80000, 3.5, 'Red', 4, 6, 17.5, 25, 5, 'Sedan'),
(5, 1, 'toyota', 'corolla', 2014, 99000, 4, 'Black', 6, 4, 16.8, 30, 5, 'Sedan'),
(6, 4, 'toyota', 'camry', 2016, 109000, 4, 'White', 5, 6, 19, 28, 5, 'Sedan');

-- --------------------------------------------------------

--
-- Table structure for table `rentals_history`
--

CREATE TABLE `rentals_history` (
  `RentalID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `CustID` int(11) NOT NULL,
  `Pickup_Date` date NOT NULL,
  `Days_rented` int(11) NOT NULL,
  `Review` varchar(150) NOT NULL,
  `Rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentals_history`
--

INSERT INTO `rentals_history` (`RentalID`, `CarID`, `CustID`, `Pickup_Date`, `Days_rented`, `Review`, `Rating`) VALUES
(1, 1, 3, '0000-00-00', 5, 'very nice car', 4),
(2, 2, 2, '0000-00-00', 3, 'good car, a bit unsatisfied', 3),
(3, 3, 3, '0000-00-00', 4, 'best car ever', 4.5),
(4, 4, 4, '0000-00-00', 2, 'could have chosen a better car', 3.5),
(5, 5, 3, '0000-00-00', 5, 'it will not fail to amaze you', 5),
(6, 6, 6, '0000-00-00', 3, 'very satisfied, prob will rent again', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currently_rented`
--
ALTER TABLE `currently_rented`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `car id` (`CarID`),
  ADD KEY `customerid` (`CustID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `customer_ibfk_1` (`Car_rented`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`CustID`);

--
-- Indexes for table `owned_cars`
--
ALTER TABLE `owned_cars`
  ADD PRIMARY KEY (`CarID`),
  ADD KEY `LocationID` (`LocationID`);

--
-- Indexes for table `rentals_history`
--
ALTER TABLE `rentals_history`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `CarID` (`CarID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `currently_rented`
--
ALTER TABLE `currently_rented`
  ADD CONSTRAINT `car id` FOREIGN KEY (`CarID`) REFERENCES `owned_cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customerid` FOREIGN KEY (`CustID`) REFERENCES `customer` (`CustID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `cust id` FOREIGN KEY (`CustID`) REFERENCES `login_info` (`CustID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Car_rented`) REFERENCES `currently_rented` (`RentalID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `owned_cars`
--
ALTER TABLE `owned_cars`
  ADD CONSTRAINT `owned_cars_ibfk_1` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`LocationID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rentals_history`
--
ALTER TABLE `rentals_history`
  ADD CONSTRAINT `rentals_history_ibfk_1` FOREIGN KEY (`CustID`) REFERENCES `customer` (`CustID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_history_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `owned_cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
