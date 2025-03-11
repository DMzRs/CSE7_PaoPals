-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2025 at 10:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paopalsdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateExpiredStock` ()   BEGIN
    INSERT INTO StockOut (stockInId, quantity, dateUsed, cause)
    SELECT stockInId, remainingQuantity, CURDATE(), 'Expired'
    FROM StockIn
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;

    UPDATE StockIn
    SET remainingQuantity = 0, status = 'Unavailable'
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminPassword` varchar(250) NOT NULL,
  `adminName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminEmail`, `adminPassword`, `adminName`) VALUES
(1, 'lean@gmail.com', '$2y$10$tBeWjSyIlBYExIXTfocDdOpUNBGJZba4OpiEuWS4tEQwneiZEeUcO', 'Lean Adrian Murillo'),
(2, 'mendoza@gmail.com', '$2y$10$Vn3c5Ij6qhXe/Y4kbsjK6OYj1CcSbsHx/z7ut/bQPec.uZnGlSEwm', 'James Oliver Mendoza'),
(3, 'dmferrer@gmail.com', '$2y$10$1sW3iRX7KmNKI2Hs8S2IjOhtHw7GQNuJ.O/o62dZ.ok31zNG2Vhzu', 'DM Rashid Ferrer');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `customerFirstName` varchar(100) NOT NULL,
  `customerLastName` varchar(100) NOT NULL,
  `customerEmail` varchar(150) NOT NULL,
  `customerContactNumber` varchar(20) DEFAULT NULL,
  `customerAddress` varchar(250) DEFAULT NULL,
  `customerPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerFirstName`, `customerLastName`, `customerEmail`, `customerContactNumber`, `customerAddress`, `customerPassword`) VALUES
(7, 'Ryle Jade', 'Tabay', 'ryle@gmail.com', '09123456789', 'Matina Aplaya, Davao City', '$2y$10$.Omx/NF.rgEwNno3W9fb2.5Ei5kxKDFchRHEFKAY.IGcGNQHYncdm'),
(8, 'Zach', 'Suralta', 'zach@gmail.com', '09121212121212', 'Matina Aplaya, Davao City', '$2y$10$aXJ51pfqbCoMknyt4v1Ew.DThp8a8YSS3JWcD9H452nT6dYHYnLYK');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `feedbackText` text NOT NULL,
  `submissionDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackId`, `name`, `email`, `subject`, `feedbackText`, `submissionDate`) VALUES
(21, 'Ryle Jade', 'ryle@gmail.com', 'Good Foods', 'The Foods were great will order again!', '2025-03-11 17:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `customerId`, `orderDate`, `status`) VALUES
(34, 7, '2025-03-11 17:19:57', 'Completed'),
(35, 7, '2025-03-11 17:20:42', 'Completed'),
(36, 7, '2025-03-11 17:23:37', 'Completed'),
(37, 7, '2025-03-11 17:27:26', 'Completed'),
(38, 8, '2025-03-11 17:30:39', 'Completed'),
(39, 7, '2025-03-11 17:31:01', 'Completed'),
(40, 8, '2025-03-11 17:31:02', 'Pending'),
(41, 7, '2025-03-11 17:54:05', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 1),
  `unitPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderItemId`, `orderId`, `productId`, `quantity`, `unitPrice`) VALUES
(2, 34, 34, 8, 15.00),
(3, 34, 32, 8, 50.00),
(4, 35, 35, 1, 80.00),
(5, 36, 32, 1, 50.00),
(6, 37, 32, 1, 50.00),
(7, 38, 32, 1, 50.00),
(8, 39, 37, 1, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `paymentDate` datetime NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` enum('Cash','Card','GCash') NOT NULL,
  `paymentTotalCost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `orderId`, `customerId`, `paymentDate`, `paymentMethod`, `paymentTotalCost`) VALUES
(37, 34, 7, '2025-03-11 17:20:42', 'Cash', 520.00),
(38, 35, 7, '2025-03-11 17:23:37', 'GCash', 80.00),
(39, 36, 7, '2025-03-11 17:27:26', 'Card', 50.00),
(40, 37, 7, '2025-03-11 17:31:01', 'Cash', 50.00),
(41, 38, 8, '2025-03-11 17:31:02', 'Cash', 50.00),
(42, 39, 7, '2025-03-11 17:54:05', 'Cash', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productCategory` enum('Siopao','Drinks','Dessert') NOT NULL,
  `productImage` varchar(250) DEFAULT NULL,
  `productPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `productCategory`, `productImage`, `productPrice`) VALUES
(32, 'Siopao Asado', 'Siopao', '1741684549_sample_1.png', 50.00),
(33, 'Original Siopao', 'Siopao', '1741684583_sample_3.png', 25.00),
(34, 'Iced Tea', 'Drinks', '1741684623_drink1.png', 15.00),
(35, 'Leche Flan', 'Dessert', '1741684650_dessert1.png', 80.00),
(36, 'Pork Siopao', 'Siopao', '1741686674_sample_2.png', 60.00),
(37, 'Coke', 'Drinks', '1741686818_istockphoto-458464735-612x612.jpg', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `saleDate` datetime NOT NULL DEFAULT current_timestamp(),
  `totalRevenue` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleId`, `orderId`, `paymentId`, `customerId`, `saleDate`, `totalRevenue`) VALUES
(1, 34, 37, 7, '2025-03-11 17:20:42', 520.00),
(2, 35, 38, 7, '2025-03-11 17:23:37', 80.00),
(3, 36, 39, 7, '2025-03-11 17:27:26', 50.00),
(4, 37, 40, 7, '2025-03-11 17:31:01', 50.00),
(5, 38, 41, 8, '2025-03-11 17:31:02', 50.00),
(6, 39, 42, 7, '2025-03-11 17:54:05', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockInId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `dateCreated` date NOT NULL,
  `expirationDate` date DEFAULT NULL,
  `remainingQuantity` int(11) NOT NULL DEFAULT 0,
  `status` enum('Available','Unavailable') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockInId`, `productId`, `quantity`, `dateCreated`, `expirationDate`, `remainingQuantity`, `status`) VALUES
(36, 32, 100, '2025-03-11', '2025-03-15', 89, 'Available'),
(37, 33, 100, '2025-03-11', '2025-03-12', 100, 'Available'),
(38, 34, 100, '2025-03-11', '2025-03-15', 92, 'Available'),
(39, 35, 111, '2025-03-11', '2025-03-15', 110, 'Available'),
(40, 36, 100, '2025-03-11', '2025-03-15', 100, 'Available'),
(41, 37, 1, '2025-03-11', '2025-03-15', 0, 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `stockOutId` int(11) NOT NULL,
  `stockInId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `dateUsed` date NOT NULL,
  `cause` enum('Sale','Expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`stockOutId`, `stockInId`, `quantity`, `dateUsed`, `cause`) VALUES
(162, 38, 8, '2025-03-11', 'Sale'),
(163, 36, 8, '2025-03-11', 'Sale'),
(164, 39, 1, '2025-03-11', 'Sale'),
(165, 36, 1, '2025-03-11', 'Sale'),
(166, 36, 1, '2025-03-11', 'Sale'),
(167, 36, 1, '2025-03-11', 'Sale'),
(168, 41, 1, '2025-03-11', 'Sale');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `adminEmail` (`adminEmail`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD UNIQUE KEY `customerEmail` (`customerEmail`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stockInId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `stockout`
--
ALTER TABLE `stockout`
  ADD PRIMARY KEY (`stockOutId`),
  ADD KEY `stockInId` (`stockInId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockInId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `stockOutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`paymentId`) REFERENCES `payment` (`paymentId`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

--
-- Constraints for table `stockin`
--
ALTER TABLE `stockin`
  ADD CONSTRAINT `stockin_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE;

--
-- Constraints for table `stockout`
--
ALTER TABLE `stockout`
  ADD CONSTRAINT `stockout_ibfk_1` FOREIGN KEY (`stockInId`) REFERENCES `stockin` (`stockInId`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `ExpireStockEvent` ON SCHEDULE EVERY 1 DAY STARTS '2025-03-12 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    INSERT INTO StockOut (stockInId, quantity, dateUsed, cause)
    SELECT stockInId, remainingQuantity, CURDATE(), 'Expired'
    FROM StockIn
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;

    UPDATE StockIn
    SET remainingQuantity = 0, status = 'Unavailable'
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
