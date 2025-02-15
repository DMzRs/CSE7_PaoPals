-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 03:16 PM
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
(5, 'sasasas', 'asasasa', 'asasas@gmail.com', '121212121212121212', 'asasasasasas', '$2y$10$/5YPiUDcDtuqLUyi1jUo3OI4s2tfauIEak6mB6AaWV73/o0aCD6WK');

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
(16, 'James Oliver', 'test@gmail.com', 'TEST', '                                                                                                                                                                                                                                                                                                                                                sdsdsds', '2025-02-15 22:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `expirationDate` date NOT NULL,
  `stockQuantity` int(11) NOT NULL CHECK (`stockQuantity` >= 0),
  `status` enum('Available','Expired') GENERATED ALWAYS AS (case when `expirationDate` < curdate() then 'Expired' else 'Available' end) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `productId`, `dateCreated`, `expirationDate`, `stockQuantity`) VALUES
(3, 2, '2025-02-01', '2025-02-15', 121),
(5, 2, '2025-02-22', '2025-03-01', 11);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'Pork Siopao', 'Siopao', '1739625328_sample_1.png', 121.00);

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
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryId`),
  ADD KEY `productId` (`productId`);

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
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
