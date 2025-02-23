-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 08:28 AM
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
(1, 'lean@gmail.com', '$2y$10$.fhEfFRquQFpPeHj5SSatu8rUub/X/.3gI0moceptf7NCOBa5UTvy', 'Lean Adrian Murillo'),
(5, 'DM@gmail.com', '$2y$10$yD8H/PtSKb3Nhp6BM9A01eIF4heDCGdXQB5sDXspHeTJShv1/GbIW', 'DM Rashid Ferrer'),
(6, 'jamesmendoza@gmail.com', '$2y$10$MqfTDMp13sEQ53QIGBRRV.SZFTsnxrKGKpbIcsrrfADz4KJ0AzrOy', 'James Oliver Mendoza');

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
(1, 'Test', 'Test', 'test@gmail.com', '222222', 'test', '$2y$10$6I6mdhKlTyJ8hoc0DZLjKu5EDgnt/La3YMbn8qSnSIEUg/W8QdKLe'),
(2, 'fff', 'fff', 'ff@gmail.com', '22222', 'fffff', '$2y$10$2fPxR/kHfCuIu.qZD9LnGOteicruSjnST5oza/hjJWyPga1fwYJSm'),
(3, 'Lean Adrian', 'Murillo', 'lean@gmail.com', '0192939393', 'Matina Aplaya', '$2y$10$jjfAhoT/ZV/LifQsLiZdPueyLyMFUaeVubjnM89ipFF7lSdtiqvdy'),
(4, 'Ryle Jade', 'Tabay', 'ryle@gmail.com', '09121212121212121', 'Matina Crossing', '$2y$10$dZSqkFddQp1bytdzLRKzfO.lsYeOPn9ke96RqtlsBdOMFbCa0yDNG'),
(5, 'sasasas', 'asasasa', 'asasas@gmail.com', '121212121212121212', 'asasasasasas', '$2y$10$/5YPiUDcDtuqLUyi1jUo3OI4s2tfauIEak6mB6AaWV73/o0aCD6WK'),
(6, 'Sedna', 'Sedna', 'sedna@gmail.com', '09123456789', 'Matina Aplaya', '$2y$10$HJ496CfFfxzNNXlDCHWsJuLMXfVjpQ2fbcPlZziQZSH6IvE.GCM7W');

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
(1, 'Ryle Jade Tabay', 'ryle@gmail.com', 'Siopao Is Good', '                 Lami kaayo                           ', '2025-02-15 21:54:34'),
(2, 'Ryle Jade Tabay', 'ryle@gmail.com', 'TEST', 'TEST', '2025-02-15 21:56:07'),
(3, 'James Oliver', 'test@gmail.com', 'TEST', '                        ssssss', '2025-02-15 21:59:44'),
(4, 'James Oliver', 'test@gmail.com', 'TEST', '                                                ssssss', '2025-02-15 22:09:13'),
(5, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                        ssssss', '2025-02-15 22:09:16'),
(6, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                ssssss', '2025-02-15 22:09:17'),
(7, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                        ssssss', '2025-02-15 22:09:17'),
(8, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                ssssss', '2025-02-15 22:09:18'),
(9, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                        ssssss', '2025-02-15 22:09:18'),
(10, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                ssssss', '2025-02-15 22:09:18'),
(11, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                        ssssss', '2025-02-15 22:09:18'),
(12, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                ssssss', '2025-02-15 22:09:19'),
(13, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                                        ssssss', '2025-02-15 22:09:19'),
(14, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                                                                ssssss', '2025-02-15 22:09:19'),
(15, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                                                                                        ssssss', '2025-02-15 22:09:19'),
(16, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                                                                                                                sdsdsds', '2025-02-15 22:15:16'),
(17, 'Lean', 'l.murillo.546842@umindanao.edu.ph', 'Lami', '                inyong siopao kay lami kaayo HAHAHAAHHAHHHHHHAHAHAHAAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHAHHA        ', '2025-02-16 21:54:12'),
(18, 'Ryle Jade Tabay', 'ryle@gmail.com', 'TEST', '                   dasdasdasdasdasdasdasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd     ', '2025-02-16 21:58:53'),
(19, 'Sedna', 'sshiz0201@gmail.com', 'asdasdad', '                       asdadasdasdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaddddddddddddddddddddddddddddd ', '2025-02-16 22:03:11'),
(20, 'YAWA', 'yawa@gmail.com', 'asdasdad', 'Giataya maning projeca ni', '2025-02-22 22:42:23');

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
(3, 4, '2025-02-23 12:21:03', 'Completed'),
(4, 6, '2025-02-23 14:46:06', 'Completed'),
(5, 6, '2025-02-23 14:46:23', 'Completed'),
(6, 6, '2025-02-23 14:51:52', 'Completed'),
(7, 6, '2025-02-23 15:00:02', 'Completed'),
(8, 6, '2025-02-23 15:15:22', 'Pending'),
(9, 4, '2025-02-23 15:18:22', 'Completed'),
(10, 4, '2025-02-23 15:19:10', 'Completed'),
(11, 4, '2025-02-23 15:21:35', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 1),
  `unitPrice` decimal(10,2) NOT NULL,
  `stockOutId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderItemId`, `orderId`, `productId`, `quantity`, `unitPrice`, `stockOutId`) VALUES
(32, 3, 31, 3, 121.00, NULL),
(33, 3, 28, 3, 11.00, NULL),
(34, 3, 29, 2, 121.00, NULL),
(35, 4, 28, 3, 11.00, NULL),
(36, 4, 29, 1, 121.00, NULL),
(37, 5, 28, 1, 11.00, NULL),
(39, 6, 29, 1, 121.00, NULL),
(40, 6, 28, 1, 11.00, NULL),
(41, 7, 28, 1, 11.00, NULL),
(42, 9, 31, 1, 121.00, NULL),
(43, 10, 31, 1, 121.00, NULL),
(44, 11, 31, 4, 121.00, NULL),
(45, 11, 29, 3, 121.00, NULL);

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
(4, 3, 4, '2025-02-23 14:35:47', 'GCash', 242.00),
(5, 4, 6, '2025-02-23 14:46:23', 'Cash', 132.00),
(6, 5, 6, '2025-02-23 14:51:52', 'Cash', 11.00),
(7, 6, 6, '2025-02-23 15:00:02', 'Cash', 132.00),
(8, 7, 6, '2025-02-23 15:15:22', 'Cash', 11.00),
(9, 9, 4, '2025-02-23 15:19:10', 'Card', 121.00),
(10, 10, 4, '2025-02-23 15:21:35', 'GCash', 121.00);

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
(28, 'Normal Siopao', 'Siopao', '1740147167_sample_2.png', 11.00),
(29, 'Leche Flan', 'Dessert', '1740148120_dessert1.png', 121.00),
(30, 'Plain Siopao', 'Siopao', '1740148741_sample_3.png', 11.00),
(31, 'Iced Tea', 'Drinks', '1740234117_drink1.png', 121.00);

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
(25, 28, 11, '2025-02-21', '2025-02-21', 0, 'Unavailable'),
(26, 29, 10, '2025-02-21', '2025-02-21', 0, 'Unavailable'),
(27, 30, 11, '2025-02-21', '2025-02-21', 0, 'Unavailable'),
(28, 28, 11, '2025-02-22', '2025-02-27', 7, 'Available'),
(29, 29, 23, '2025-02-22', '2025-02-27', 21, 'Available'),
(30, 31, 121, '2025-02-22', '2025-02-24', 117, 'Available');

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
(123, 26, 10, '2025-02-21', 'Expired'),
(124, 27, 11, '2025-02-21', 'Expired'),
(125, 30, 2, '2025-02-23', 'Sale'),
(126, 28, 1, '2025-02-23', 'Sale'),
(127, 29, 1, '2025-02-23', 'Sale'),
(128, 28, 1, '2025-02-23', 'Sale'),
(129, 29, 1, '2025-02-23', 'Sale'),
(130, 28, 1, '2025-02-23', 'Sale'),
(131, 28, 1, '2025-02-23', 'Sale'),
(132, 30, 1, '2025-02-23', 'Sale'),
(133, 30, 1, '2025-02-23', 'Sale');

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
  ADD KEY `productId` (`productId`),
  ADD KEY `stockOutId` (`stockOutId`);

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
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockInId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stockout`
--
ALTER TABLE `stockout`
  MODIFY `stockOutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

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
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`),
  ADD CONSTRAINT `orderitem_ibfk_3` FOREIGN KEY (`stockOutId`) REFERENCES `stockout` (`stockOutId`) ON DELETE SET NULL;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE;

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
CREATE DEFINER=`root`@`localhost` EVENT `inventory_management` ON SCHEDULE EVERY 1 DAY STARTS '2025-02-21 23:59:59' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Log expired stock and update StockIn
    INSERT INTO StockOut (stockInId, quantity, dateUsed, cause)
    SELECT stockInId, remainingQuantity, CURDATE(), 'Expired'
    FROM StockIn
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;

    -- Update StockIn status and quantity
    UPDATE StockIn
    SET remainingQuantity = 0, status = 'Unavailable'
    WHERE expirationDate <= CURDATE() AND remainingQuantity > 0;

    -- Update status for any remaining expired stock (if needed)
    UPDATE StockIn
    SET status = 'Unavailable'
    WHERE expirationDate <= CURDATE() AND status = 'Available';
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
