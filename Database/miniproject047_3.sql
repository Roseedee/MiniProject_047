-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 06:19 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniproject047`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(10) NOT NULL,
  `c_name` varchar(45) NOT NULL,
  `c_address` varchar(45) NOT NULL,
  `c_tel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_address`, `c_tel`) VALUES
(7, 'asdfasd', '32131321321', 'asdf'),
(8, 'asdf', 'ffff', 'sadf'),
(9, 'asdfwef', 'erwe', '654654'),
(10, 'sdfasdf', 'asdfasdf', 'asdf'),
(11, 'Roseedee Cehleah', '3/8 Banhadsai', '0630742165');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(10) NOT NULL,
  `e_name` varchar(45) NOT NULL,
  `e_address` varchar(45) NOT NULL,
  `e_tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `e_name`, `e_address`, `e_tel`) VALUES
(5, 'asdf', 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(10) NOT NULL,
  `p_name` varchar(45) NOT NULL,
  `p_cost_price` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `pdt_id` int(10) NOT NULL,
  `pdst_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_cost_price`, `p_price`, `pdt_id`, `pdst_id`) VALUES
(19, 'asdf', 0, 0, 1, 1),
(20, 'asdf', 0, 0, 1, 1),
(21, 'asddf', 0, 0, 1, 1),
(23, 'asdf', 0, 0, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `r_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `p_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`r_id`, `p_id`, `p_num`) VALUES
(1, 20, 20),
(1, 23, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_state`
--

CREATE TABLE `product_state` (
  `pdst_id` int(10) NOT NULL,
  `pdst_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_state`
--

INSERT INTO `product_state` (`pdst_id`, `pdst_name`) VALUES
(1, 'มี'),
(2, 'ไม่มี');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `pdt_id` int(11) NOT NULL,
  `pdt_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`pdt_id`, `pdt_name`) VALUES
(1, 'ขนม'),
(2, 'น้ำ'),
(3, 'ขนมปัง');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `r_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `e_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `r_tt_price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`r_id`, `c_id`, `e_id`, `date`, `r_tt_price`) VALUES
(1, 8, 5, '2023-01-19 04:36:55', 10000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `sdt_id` (`pdt_id`),
  ADD KEY `st_id` (`pdst_id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`r_id`,`p_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `product_state`
--
ALTER TABLE `product_state`
  ADD PRIMARY KEY (`pdst_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`pdt_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `e_id` (`e_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_state`
--
ALTER TABLE `product_state`
  MODIFY `pdst_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `pdt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `r_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`pdt_id`) REFERENCES `product_type` (`pdt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`pdst_id`) REFERENCES `product_state` (`pdst_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_sales_ibfk_2` FOREIGN KEY (`r_id`) REFERENCES `receipt` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`e_id`) REFERENCES `employee` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
