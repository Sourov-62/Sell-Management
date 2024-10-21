-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 01:53 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'bata'),
(2, 'asus'),
(3, 'del'),
(4, 'samsung'),
(5, 'iphone'),
(6, 'oppo'),
(7, 'rich man');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'laptop'),
(3, 'mobile'),
(4, 'mouse'),
(5, 'shirt'),
(7, 'Headphone'),
(8, 'xbox'),
(9, 'Foods'),
(10, 'Foods'),
(11, 'Honda');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `brand_id`, `product_title`, `product_price`, `product_image`, `description`) VALUES
(1, 2, 2, 'laptop1', 30000, 'laptop1.png', 'dddddddddddd'),
(2, 3, 4, 'mobile1', 20000, 'mobile1.png', 'ddddddd'),
(3, 4, 3, 'mouse1', 300, 'mouse1.jpg', 'gggggg'),
(5, 7, 6, 'headphone1', 150, 'headphone1.png', 'fdertttttttt'),
(6, 8, 2, 'xbox1', 700, 'xbox1.jpg', 'fgjjjjj'),
(7, 8, 2, 'xbox1', 700, 'xbox1.jpg', 'fgjjjjj'),
(9, 2, 2, 'asus1', 55000, 'asus1.png', 'asdfg'),
(10, 5, 7, 'Shirt2', 1000, 'Shirt2.jpg', 'ghhhhh'),
(11, 5, 7, 'Shirt3', 1100, 'Shirt3.jpg', 'ggggggg'),
(12, 5, 7, 'Shirt4', 1200, 'Shirt4.jpg', 'cfrtt'),
(13, 5, 7, 'Shirt5', 1300, 'Shirt5.jpg', 'jgjfkfk'),
(14, 5, 7, 'Shirt6', 1500, 'Shirt6.jpeg', 'kgjjg'),
(15, 2, 2, 'Laptop10', 50000, 'Laptop10.jpg', 'fggggggg'),
(16, 2, 2, 'Laptop11', 60000, 'Laptop11.png', 'vnnn'),
(17, 4, 4, 'mouse10', 300, 'mouse10.png', 'hffffff'),
(18, 4, 4, 'mouse11', 250, 'mouse11.png', 'jgjgjg'),
(19, 4, 4, 'mouse12', 200, 'mouse12.png', 'hjiyt'),
(20, 8, 3, 'xbox10', 40000, 'xbox10.jpg', 'fhfhfh'),
(21, 8, 4, 'xbox11', 36000, 'xbox11.png', 'jgjgj'),
(22, 8, 4, 'xbox12', 38000, 'xbox12.png', 'kiutr'),
(23, 3, 4, 'phone10', 20000, 'phone10.png', 'hjkk'),
(24, 3, 4, 'phone11', 26000, 'phone11.png', 'jkiu'),
(25, 3, 4, 'phone12', 30000, 'phone12.jpg', 'sdddee'),
(26, 3, 5, 'phone13', 34000, 'phone13.png', 'fgg'),
(27, 2, 2, 'lenovo', 40000, 'lenovo.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sell_info`
--

CREATE TABLE `sell_info` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `total_bill` decimal(10,2) DEFAULT NULL,
  `vat_percentage` decimal(5,2) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `net_balance` decimal(10,2) DEFAULT NULL,
  `cash_paid` decimal(10,2) DEFAULT NULL,
  `change_due` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell_info`
--

INSERT INTO `sell_info` (`id`, `customer_name`, `email`, `address`, `total_bill`, `vat_percentage`, `discount_percentage`, `net_balance`, `cash_paid`, `change_due`, `created_at`) VALUES
(1, 'sourov', 'shajidul09@gmail.com', '4', 1500.00, 5.00, 0.00, 1575.00, 2000.00, 425.00, '2024-10-20 18:46:52'),
(20, '', '', '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2024-10-21 00:37:30'),
(23, 'sourov', 'shajidul09@gmail.com', 'Jobra', 80000.00, 5.00, 0.00, 84000.00, 60000.00, -24000.00, '2024-10-20 20:50:20'),
(24, 'sourov', 'shajidul09@gmail.com', 'Jobra', 80000.00, 5.00, 0.00, 84000.00, 60000.00, -24000.00, '2024-10-20 20:50:26'),
(25, 'sourov', 'shajidul09@gmail.com', 'Jobra', 1300.00, 5.00, 0.00, 1365.00, 60000.00, 58635.00, '2024-10-20 20:58:20'),
(26, 'sourov', 'shajidul09@gmail.com', 'Jobra', 40000.00, 5.00, 0.00, 42000.00, 60000.00, 18000.00, '2024-10-20 21:00:56'),
(27, 'sourov', 'shajidul09@gmail.com', 'Jobra', 40000.00, 5.00, 0.00, 42000.00, 60000.00, 18000.00, '2024-10-20 21:00:59'),
(28, 'sourov', 'shajidul09@gmail.com', 'Jobra', 50000.00, 5.00, 0.00, 52500.00, 60000.00, 7500.00, '2024-10-20 21:18:15'),
(29, 'sourov', 'shajidul09@gmail.com', 'Jobra', 34000.00, 5.00, 0.00, 35700.00, 60000.00, 24300.00, '2024-10-20 21:19:08'),
(30, 'sourov', 'shajidul09@gmail.com', 'Jobra', 300.00, 5.00, 0.00, 315.00, 60000.00, 59685.00, '2024-10-20 21:27:32'),
(31, 'sourov', 'shajidul09@gmail.com', 'Jobra', 1200.00, 5.00, 0.00, 1260.00, 60000.00, 58740.00, '2024-10-20 21:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`) VALUES
(2, 'sourov', 'shajidul09@gmail.com', 'sa123456'),
(3, 'sourov', 'shajidul@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sell_info`
--
ALTER TABLE `sell_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sell_info`
--
ALTER TABLE `sell_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
