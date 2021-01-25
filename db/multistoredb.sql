-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 03:35 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multistoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int(11) NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CategoryID` int(11) NOT NULL,
  `Categories` varchar(90) NOT NULL,
  `StoreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CategoryID`, `Categories`, `StoreID`) VALUES
(5, 'Wallet', 2102),
(6, 'Custom T Shirt', 2102),
(7, 'Bag', 2102);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(90) NOT NULL,
  `CustomerAddress` varchar(90) NOT NULL,
  `CustomerContact` varchar(90) NOT NULL,
  `Sex` varchar(30) NOT NULL,
  `Customer_Username` varchar(90) NOT NULL,
  `Customer_Password` varchar(90) NOT NULL,
  `Customer_Photo` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`CustomerID`, `CustomerName`, `CustomerAddress`, `CustomerContact`, `Sex`, `Customer_Username`, `Customer_Password`, `Customer_Photo`) VALUES
(12, 'Jhoven Tan', '2119 De Guia, Valenzuela, Metro Manila, Philippines', '09777697562', 'Male', 'InScythe@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'photos/6d5ee1858277cac4673c657cf0bc26e5.jpg'),
(13, 'rafael', 'paengrafael', 'rafael', 'Male', 'rafael@rafael', '2d8d596a0b97569f9226a8c33ed9c6dbc8d88120', ''),
(14, 'qwe', 'qwe', 'qwe', 'Female', 'qwe@qwe', '056eafe7cf52220de2df36845b8ed170c67e23e3', ''),
(15, 'zzzzzzzzzzz', 'zzzzzzzzzzz', 'zzzzzzzzzzz', 'Female', 'zzzzzzzzzzz@zzzzzzzzzzz', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', ''),
(16, 'zzzzzzzzzzz', 'zzzzzzzzzzz', 'zzzzzzzzzzz', 'Female', 'zzzzzzzzzzz@gmail.com', '25c45fef5f91fd77eb4027d632f4bb2091d359c0', ''),
(17, 'Rafael', 'Rafael', 'Rafael', 'Male', 'Rafael@Rafael', '3e05c90f8530b1ba72519824415d05e08cf5718b', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `TransID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Stocks` int(11) NOT NULL,
  `Sold` int(11) NOT NULL,
  `Remaining` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinventory`
--

INSERT INTO `tblinventory` (`TransID`, `ProductID`, `Stocks`, `Sold`, `Remaining`) VALUES
(14, 4, 100, 1, 99),
(15, 5, 100, 1, 99),
(16, 6, 100, 1, 99),
(17, 7, 100, 0, 100),
(18, 8, 100, 0, 100),
(19, 9, 100, 0, 100),
(20, 10, 100, 0, 100),
(21, 11, 50, 3, 47),
(22, 12, 50, 2, 48),
(23, 13, 50, 1, 49),
(24, 14, 30, 0, 30),
(25, 15, 30, 0, 30),
(26, 16, 30, 0, 30),
(27, 17, 30, 0, 30),
(28, 18, 30, 0, 30),
(29, 19, 30, 0, 30),
(30, 20, 30, 0, 30),
(31, 21, 30, 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(90) NOT NULL,
  `Description` varchar(90) NOT NULL,
  `Price` double NOT NULL,
  `DateExpire` date NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `StoreID` int(11) NOT NULL,
  `Image1` text NOT NULL,
  `Image2` text NOT NULL,
  `Image3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ProductID`, `ProductName`, `Description`, `Price`, `DateExpire`, `CategoryID`, `StoreID`, `Image1`, `Image2`, `Image3`) VALUES
(4, 'Custom T Shirt 1 ', 'Custom T Shirt 1 ', 600, '2020-12-14', 6, 2102, 'photos/1.jpg', 'photos/1.jpg', 'photos/1.jpg'),
(5, 'Custom T Shirt 2', 'Custom T Shirt 2', 500, '2020-12-14', 6, 2102, 'photos/2.jpg', 'photos/2.jpg', 'photos/2.jpg'),
(6, 'Custom T Shirt 3', 'Custom T Shirt 3', 500, '2020-12-14', 6, 2102, 'photos/3.jpg', 'photos/3.jpg', 'photos/3.jpg'),
(7, 'Custom T Shirt 4', 'Custom T Shirt 4', 500, '2020-12-14', 6, 2102, 'photos/4.jpg', 'photos/4.jpg', 'photos/4.jpg'),
(8, 'Custom T Shirt 5', 'Custom T Shirt 5', 500, '2020-12-14', 6, 2102, 'photos/5.jpg', 'photos/5.jpg', 'photos/5.jpg'),
(9, 'Custom T Shirt 6', 'Custom T Shirt 6', 500, '2020-12-14', 6, 2102, 'photos/6.jpg', 'photos/6.jpg', 'photos/6.jpg'),
(10, 'Custom T Shirt 7', 'Custom T Shirt 7', 500, '2020-12-14', 6, 2102, 'photos/7.jpg', 'photos/7.jpg', 'photos/7.jpg'),
(11, 'Wallet 1', 'Wallet 1', 300, '2020-12-14', 5, 2102, 'photos/wallet 1.jpg', 'photos/wallet 1.jpg', 'photos/wallet 1.jpg'),
(12, 'Wallet 2', 'Wallet 2', 300, '2020-12-14', 5, 2102, 'photos/wallet 2.jpg', 'photos/wallet 2.jpg', 'photos/wallet 2.jpg'),
(13, 'Wallet 3', 'Wallet 3', 300, '2020-12-14', 5, 2102, 'photos/wallet 3.jpg', 'photos/wallet 3.jpg', 'photos/wallet 3.jpg'),
(14, 'Bag 1', 'Bag 1', 600, '2020-12-14', 7, 2102, 'photos/1.jpg', 'photos/1.jpg', 'photos/1.jpg'),
(15, 'Bag  2', 'Bag  2', 600, '2020-12-14', 7, 2102, 'photos/2.jpg', 'photos/2.jpg', 'photos/2.jpg'),
(16, 'Bag  3', 'Bag  3', 600, '2020-12-14', 7, 2102, 'photos/3.jpg', 'photos/3.jpg', 'photos/3.jpg'),
(17, 'Bag  4', 'Bag  4', 600, '2020-12-14', 7, 2102, 'photos/9.jpg', 'photos/9.jpg', 'photos/9.jpg'),
(18, 'Bag  5', 'Bag  5', 600, '2020-12-14', 7, 2102, 'photos/5.jpg', 'photos/5.jpg', 'photos/5.jpg'),
(19, 'Bag  6', 'Bag  6', 600, '2020-12-14', 7, 2102, 'photos/6.jpg', 'photos/6.jpg', 'photos/6.jpg'),
(20, 'Bag  7', 'Bag  7', 600, '2020-12-14', 7, 2102, 'photos/7.jpg', 'photos/7.jpg', 'photos/7.jpg'),
(21, 'Bag 8', 'Bag 8', 600, '2020-12-14', 7, 2102, 'photos/8.jpg', 'photos/8.jpg', 'photos/8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblstockin`
--

CREATE TABLE `tblstockin` (
  `StockinID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateReceive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstockin`
--

INSERT INTO `tblstockin` (`StockinID`, `ProductID`, `Quantity`, `DateReceive`) VALUES
(4, 4, 100, '2020-12-14'),
(5, 5, 100, '2020-12-14'),
(6, 6, 100, '2020-12-14'),
(7, 7, 100, '2020-12-14'),
(8, 8, 100, '2020-12-14'),
(9, 9, 100, '2020-12-14'),
(10, 10, 100, '2020-12-14'),
(11, 11, 50, '2020-12-14'),
(12, 12, 50, '2020-12-14'),
(13, 13, 50, '2020-12-14'),
(14, 14, 30, '2020-12-14'),
(15, 15, 30, '2020-12-14'),
(16, 16, 30, '2020-12-14'),
(17, 17, 30, '2020-12-14'),
(18, 18, 30, '2020-12-14'),
(19, 19, 30, '2020-12-14'),
(20, 20, 30, '2020-12-14'),
(21, 21, 30, '2020-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `tblstockout`
--

CREATE TABLE `tblstockout` (
  `StockoutID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateSold` date NOT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Pending',
  `Remarks` varchar(90) NOT NULL,
  `OrderNo` varchar(90) NOT NULL,
  `HView` tinyint(1) NOT NULL,
  `Payment_Type` varchar(100) DEFAULT NULL,
  `Payment_Reference` varchar(100) DEFAULT NULL,
  `Payment_Contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstockout`
--

INSERT INTO `tblstockout` (`StockoutID`, `CustomerID`, `ProductID`, `Quantity`, `DateSold`, `Status`, `Remarks`, `OrderNo`, `HView`, `Payment_Type`, `Payment_Reference`, `Payment_Contact`) VALUES
(22, 17, 11, 1, '2021-01-04', 'Confirmed', '', '8289603f0fe7e4635ac1f6c0db0c9f1b364441af', 1, 'PayMaya', 'e770b59c-68e3-489b-9592-9ab95cb96e59', '09997143666'),
(23, 17, 12, 1, '2021-01-04', 'Confirmed', '', '8289603f0fe7e4635ac1f6c0db0c9f1b364441af', 1, 'PayMaya', 'e770b59c-68e3-489b-9592-9ab95cb96e59', '09997143666'),
(24, 17, 12, 1, '2021-01-04', 'Cancelled', '', '2fe9760675970e411ea01f80e65e64e8c1f93c8a', 1, 'GCash', '43543534534', '09560718537');

-- --------------------------------------------------------

--
-- Table structure for table `tblstore`
--

CREATE TABLE `tblstore` (
  `StoreID` int(11) NOT NULL,
  `StoreName` varchar(90) NOT NULL,
  `StoreAddress` varchar(90) NOT NULL,
  `ContactNo` varchar(90) NOT NULL,
  `st_Image1` text NOT NULL,
  `st_Image2` text NOT NULL,
  `st_Image3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstore`
--

INSERT INTO `tblstore` (`StoreID`, `StoreName`, `StoreAddress`, `ContactNo`, `st_Image1`, `st_Image2`, `st_Image3`) VALUES
(2102, 'Xelina\'s Closet', 'Malinta Valenzuela City', '09162143285', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblsummary`
--

CREATE TABLE `tblsummary` (
  `SummaryID` int(11) NOT NULL,
  `OrderNo` varchar(90) NOT NULL,
  `TotalAmount` double NOT NULL,
  `TransDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsummary`
--

INSERT INTO `tblsummary` (`SummaryID`, `OrderNo`, `TotalAmount`, `TransDate`) VALUES
(2, '', 1600, '2020-12-14'),
(3, '', 300, '2020-12-14'),
(4, '', 300, '2020-12-14'),
(5, '', 300, '2020-12-14'),
(6, '', 300, '2020-12-14'),
(7, '', 600, '2020-12-14'),
(8, '', 300, '2020-12-14'),
(9, '', 300, '2020-12-14'),
(10, '', 300, '2020-12-14'),
(11, '', 300, '2020-12-14'),
(12, '', 300, '2020-12-14'),
(13, '8e02b33c32d060cf86c2052cb64bc672acfe0e0b', 600, '2021-01-03'),
(14, '1618af56c2ecf8d449b7c089a2453ff13811adc8', 2100, '2021-01-04'),
(15, '879a06073bbc8fe1766ca7c8dadbce264e1ee5cd', 1500, '2021-01-04'),
(16, '9b4d857b5b598fe4e615c0cbc330dd8754b46a89', 3000, '2021-01-04'),
(17, 'b2edea006a9e7e8e0ade4038a8eada50a3731afd', 600, '2021-01-04'),
(18, '36a65fe10e38c10dc7e7714671d9283f966c0c17', 900, '2021-01-04'),
(19, '8289603f0fe7e4635ac1f6c0db0c9f1b364441af', 600, '2021-01-04'),
(20, '2fe9760675970e411ea01f80e65e64e8c1f93c8a', 300, '2021-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(90) NOT NULL,
  `Username` varchar(90) NOT NULL,
  `Password` varchar(90) NOT NULL,
  `Role` varchar(90) NOT NULL,
  `PicLoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserID`, `FullName`, `Username`, `Password`, `Role`, `PicLoc`) VALUES
(2102, 'Xelina\'s Closet', 'Xelina', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Administrator', 'photos/3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`TransID`),
  ADD UNIQUE KEY `ProductID` (`ProductID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tblstockin`
--
ALTER TABLE `tblstockin`
  ADD PRIMARY KEY (`StockinID`);

--
-- Indexes for table `tblstockout`
--
ALTER TABLE `tblstockout`
  ADD PRIMARY KEY (`StockoutID`);

--
-- Indexes for table `tblstore`
--
ALTER TABLE `tblstore`
  ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `tblsummary`
--
ALTER TABLE `tblsummary`
  ADD PRIMARY KEY (`SummaryID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblinventory`
--
ALTER TABLE `tblinventory`
  MODIFY `TransID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblstockin`
--
ALTER TABLE `tblstockin`
  MODIFY `StockinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblstockout`
--
ALTER TABLE `tblstockout`
  MODIFY `StockoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblstore`
--
ALTER TABLE `tblstore`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2103;

--
-- AUTO_INCREMENT for table `tblsummary`
--
ALTER TABLE `tblsummary`
  MODIFY `SummaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
