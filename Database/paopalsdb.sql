-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 06:55 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
