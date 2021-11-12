-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 02:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_darshit`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `isDelete` tinyint(1) DEFAULT 0,
  `createdDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `stock`, `price`, `isDelete`, `createdDate`, `lastModified`) VALUES
(1, 'Product A', 10, '100.00', 0, '2021-11-11 15:49:53', NULL),
(2, 'Product B', 15, '50.00', 0, '2021-11-11 15:50:11', NULL),
(3, 'Product C', 5, '200.00', 0, '2021-11-11 15:50:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `isDelete` tinyint(1) DEFAULT 0,
  `createdDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `total`, `isDelete`, `createdDate`, `lastModified`) VALUES
(1, 600, 0, '2021-11-11 17:32:09', NULL),
(2, 400, 0, '2021-11-11 17:32:09', NULL),
(3, 0, 1, '2021-11-11 18:05:54', '2021-11-11 18:08:28'),
(4, 300, 0, '2021-11-11 18:08:49', '2021-11-11 18:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT 0,
  `product_id` int(11) DEFAULT 0,
  `qty` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `total` double DEFAULT 0,
  `isDelete` tinyint(1) DEFAULT 0,
  `createdDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_item`
--

INSERT INTO `sales_item` (`id`, `sales_id`, `product_id`, `qty`, `price`, `total`, `isDelete`, `createdDate`, `lastModified`) VALUES
(1, 1, 1, 3, '100.00', 300, 0, '2021-11-11 17:33:32', NULL),
(2, 1, 2, 2, '50.00', 100, 0, '2021-11-11 17:33:32', NULL),
(3, 1, 3, 1, '200.00', 200, 0, '2021-11-11 17:35:41', NULL),
(4, 2, 1, 1, '200.00', 200, 0, '2021-11-11 17:35:41', NULL),
(5, 2, 2, 2, '50.00', 100, 0, '2021-11-11 17:35:41', NULL),
(6, 2, 3, 1, '100.00', 100, 0, '2021-11-11 17:35:41', NULL),
(7, 3, 2, 1, '50.00', 0, 0, '2021-11-11 18:05:54', NULL),
(8, 3, 3, 2, '200.00', 0, 0, '2021-11-11 18:05:54', NULL),
(9, 4, 2, 2, '50.00', 0, 0, '2021-11-11 18:08:49', NULL),
(10, 4, 3, 1, '200.00', 0, 0, '2021-11-11 18:08:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
