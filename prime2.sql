-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2026 at 05:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prime2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`) VALUES
(1, 'admin', '$2y$10$5jz/Iy9JakjwaNb41d2GSue.sdc.iGulWWqPTrZ3cZifzJcUUle0S');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `conntype` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `user_id`, `fname`, `lname`, `address`, `contact`, `occupation`, `bday`, `class`, `conntype`, `date`, `status`) VALUES
(1, 2, 'Michael ', 'Mesina', 'Lucena City', '09702968842', 'IT', '0000-00-00', 'Residential', 'New Connection', '2026-05-15 12:00:24', 'For Additional Requirements'),
(2, 2, 'Jordan ', 'Michael', 'Lucena City', '09702323344', 'Driver', '0000-00-00', 'Residential', 'Sub Connection', '2026-05-15 12:06:41', 'For Payment'),
(3, 2, 'Michael Jordan', NULL, 'Lucena City', '1234567890', 'NEW_CONNECTION', NULL, NULL, NULL, '2026-05-22 18:40:29', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `accountnumber` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `complaint` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `remarks_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `user_id`, `name`, `accountnumber`, `address`, `contact`, `complaint`, `date`, `status`, `remarks`, `remarks_date`) VALUES
(1, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '09302968842', 'No Water', '2026-05-15 11:43:52', 'For Schedule of Repair', NULL, NULL),
(2, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '09302968842', 'No Water', '2026-05-15 11:44:06', 'For Inspection', NULL, NULL),
(3, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '09302968842', 'No Water', '2026-05-15 11:55:55', 'For Schedule of Repair', NULL, NULL),
(4, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '09307834545', 'High Consumption', '2026-05-15 12:05:54', 'Accomplished', NULL, NULL),
(5, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '1234567890', 'Leaking Pipes', '2026-05-22 18:40:29', 'Accomplished', NULL, NULL),
(6, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '09702968842', 'High Consumption', '2026-05-22 18:49:06', 'Accomplished', NULL, NULL),
(7, 2, 'Michael Jordan', '6031-0120-0001', 'Lucena City', '1234567890', 'Leaking Pipes', '2026-05-22 19:01:03', 'Accomplished', NULL, NULL),
(8, 4, 'Michael Jordan', '6301-0120-0001', 'Lucena City	', '09923245587', 'High Consumption', '2026-05-22 19:34:03', 'Accomplished', NULL, NULL),
(9, 3, 'Lebron Doncic', '6031-0120-0002', 'Tayabas City', '09702964433', 'High Consumption', '2026-05-23 14:38:13', 'Accomplished', 'With Leak After Meter', '2026-05-23 15:04:10'),
(10, 5, 'Michael Mendoza', '6031-0120-0010', 'Tayabas', '09706676543', 'High Consumption', '2026-05-23 15:17:56', 'Pending', NULL, NULL),
(11, 4, 'Michael Jordan', '6301-0120-0001', 'Lucena City	', '09923245587', 'Leaking Pipes', '2026-05-23 15:24:26', 'Schedule for Maintenance', 'The repair requires a permit ', '2026-05-23 15:26:06'),
(12, 4, 'Michael Jordan', '6301-0120-0001', 'Lucena City	', '09923245587', 'High Consumption', '2026-05-23 15:28:02', 'Accomplished', 'with leak after meter', '2026-05-23 15:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `cust_account` varchar(100) DEFAULT NULL,
  `cust_address` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `billing_month` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Unpaid',
  `PrReading` decimal(10,2) DEFAULT 0.00,
  `CReading` decimal(10,2) DEFAULT 0.00,
  `TReading` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_account`, `cust_address`, `amount`, `due_date`, `billing_month`, `status`, `PrReading`, `CReading`, `TReading`) VALUES
(1, 'Michael Jordan', '6301-0120-0001', 'Lucena City', '678.45', '2026-05-15', 'May', 'Paid', '2450.00', '2485.00', '35.00'),
(2, 'Micahel Jordan', '6031-0120-0002', 'Lucena', '698.45', '2026-05-15', 'May', 'Paid', '1800.00', '2100.00', '300.00'),
(3, 'Michael Mesina', '6031-0120-0005', 'Lucena City', '459.70', '2026-06-18', 'June', 'Unpaid', '1237.00', '1255.00', '0.00'),
(4, 'Michael Mendoza', '6031-0120-0010', 'tayabas', '840.00', '2026-06-19', 'June', 'Paid', '1367.00', '1402.00', '35.00'),
(5, 'Lebron Doncic', '6031-0120-0002', 'Lucena City', '1080.00', '2026-06-28', 'June', 'Paid', '2100.00', '2145.00', '45.00'),
(7, 'Lebron Doncic', '6031-0120-0002', 'Lucena City', '1056.00', '2026-07-15', 'July', 'Paid', '2145.00', '2189.00', '44.00'),
(8, 'Michael Mendoza', '6031-0120-0010', 'tayabas', '1560.00', '2026-07-15', 'July', 'Unpaid', '1402.00', '1467.00', '65.00'),
(9, 'Michael Jordan', '6301-0120-0001', 'Lucena City', '1896.00', '2026-06-19', 'June', 'Paid', '2485.00', '2564.00', '79.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `cust_account` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `accountnum` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `users_Pnumber` varchar(50) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `accountnum`, `address`, `users_Pnumber`, `is_verified`, `otp_code`, `otp_expiry`) VALUES
(1, 'deidei0813@gmail.com', '$2y$10$Lh1eOGm3fnYc.7PKSXyy/exmBb07P2kqFGnygoqpOdqcgopQiCM0.', 'Michael Mesina', '6031-0120-0005', 'Lucena City', NULL, 0, '175301', '2026-05-15 03:55:25'),
(3, 'sabriamesina@gmail.com', '$2y$10$Lh1eOGm3fnYc.7PKSXyy/exmBb07P2kqFGnygoqpOdqcgopQiCM0.', 'Lebron Doncic', '6031-0120-0002', 'Tayabas City', NULL, 0, NULL, NULL),
(4, 'lekym0813@gmail.com', '$2y$10$ey45wBbfs.SH4FJGHzs5D.H8JQi2IYIY9EMpzerCXdXdivevr0CZ6', 'Michael Jordan', '6301-0120-0001', 'Lucena City	', '09923245587', 0, NULL, NULL),
(5, 'dei@gmail.com', '$2y$10$ey45wBbfs.SH4FJGHzs5D.H8JQi2IYIY9EMpzerCXdXdivevr0CZ6', 'Michael Mendoza', '6031-0120-0010', 'Tayabas', '09706676543', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
