-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 12:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azora`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electronics', 'Something', 1, '2019-10-10 11:54:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Drinks', 'Hello', 1, '2019-10-10 11:54:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Snacks', 'Yes', 1, '2019-09-29 08:55:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Equipments', 'Yes', 0, '2019-10-02 07:16:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Test', 'Something', 1, '2019-10-10 11:51:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'New Category', 'Test', 1, '2019-11-27 06:14:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Testing 2', '', 1, '2019-11-27 06:17:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `customer_type` varchar(255) DEFAULT NULL,
  `account_no` int(11) DEFAULT NULL,
  `local_image_path` varchar(255) DEFAULT NULL,
  `server_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `lname`, `company_name`, `email`, `phone`, `address`, `customer_type`, `account_no`, `local_image_path`, `server_image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Salah', 'Al-Dhaferi', 'BlackGem', 'hha', 'asdd', 'asdd', '7raf', NULL, NULL, NULL, '2019-09-19 08:10:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Muhanned', 'Noman', 'BlackGem', 'Yes@example.com', '777777777', 'Home', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Ahmed', 'AL-Rajhi', 'Dell', 'dell@example.com', '777777777', 'Street', 'Kinda', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Ali', 'AL-Qaq', 'Lenovo', 'lenovo@example.com', '777777777', 'China', '7raf', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Morad', 'AL-Moqabl', 'MSI', 'msi@example.com', '777777777', 'School', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Mustafa', 'Al-Hashdi', 'New Yourk Times', 'hello@example.com', '777777777', 'Hospital', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Salah', 'Al-Dhaferi', 'BlackGem', 'hha', 'asdd', 'asdd', '7raf', NULL, NULL, NULL, '2019-09-19 08:10:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Muhanned', 'Noman', 'BlackGem', 'Yes@example.com', '777777777', 'Home', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Ahmed', 'AL-Rajhi', 'Dell', 'dell@example.com', '777777777', 'Street', 'Kinda', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Morad', 'AL-Moqabl', 'MSI', 'msi@example.com', '777777777', 'School', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Mustafa', 'Al-Hashdi', 'New Yourk Times', 'hello@example.com', '777777777', 'Hospital', 'Floos', NULL, NULL, NULL, '2019-09-22 06:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

CREATE TABLE `debts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'FALSE',
  `archive` varchar(255) NOT NULL DEFAULT 'no',
  `sync_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Yes', 30, '2019-12-18 09:28:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'OK Tax', 10, '2019-12-18 09:28:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '', 5, '2019-12-18 09:44:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '', 15, '2019-12-18 09:48:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `user_id`, `type`, `description`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Utilities', 'Hello', 2000, '2019-10-03 11:32:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 5, 'Salaries', 'Hi', 1400, '2019-10-09 09:07:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'Utilities', 'Hello', 2000, '2019-10-03 11:32:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 'Salaries', 'Hi', 1400, '2019-10-09 09:07:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `opening_stock` varchar(255) DEFAULT NULL,
  `sync_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `warehouse_id`, `product_id`, `quantity`, `status`, `opening_stock`, `sync_status`, `created_at`, `updated_at`, `deleted_at`, `expiry_date`) VALUES
(1, 2, 3, 0, 1, '20', 'no', '0000-00-00 00:00:00', '2019-12-26 06:42:43', '0000-00-00 00:00:00', '2020-01-05 01:00:00'),
(2, 2, 4, 100, 1, '20', NULL, '0000-00-00 00:00:00', '2019-12-26 06:42:43', '0000-00-00 00:00:00', '2020-01-10 01:00:00'),
(3, 2, 7, 10, 0, '5', NULL, '0000-00-00 00:00:00', '2019-12-26 06:42:43', '0000-00-00 00:00:00', '2020-01-12 01:00:00'),
(4, 5, 4, 10, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-01-10 21:00:00'),
(5, 5, 5, 10, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-12-31 21:00:00'),
(6, 5, 6, 5, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-01-02 21:00:00'),
(7, 5, 4, 10, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-01-10 21:00:00'),
(8, 5, 5, 10, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-12-31 21:00:00'),
(9, 5, 6, 5, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-01-02 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privilege_category`
--

CREATE TABLE `privilege_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `unit_of_counting_id` int(11) DEFAULT NULL,
  `weight_type_id` int(11) DEFAULT NULL,
  `pieces_per_box` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `local_image_path` varchar(255) DEFAULT NULL,
  `server_image_path` varchar(255) DEFAULT NULL,
  `sync_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `category_id`, `subcategory_id`, `unit_of_counting_id`, `weight_type_id`, `pieces_per_box`, `price`, `length`, `width`, `height`, `description`, `tax_id`, `status`, `local_image_path`, `server_image_path`, `sync_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lenovo ', '2538110', 1, 4, 1, 2, 1200, 45000, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-10-18 14:43:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'MSI', '2538110', 1, 4, 1, 2, 1600, 50000, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-10-18 14:43:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Hellios', '2538110', 3, 2, 1, 2, 1200, 1200, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-12-17 06:49:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Trion', '2538110', 1, 4, 1, 2, 1600, 1600, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-10-18 14:43:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Galaxy S7', '2538110', 3, 2, 1, 2, 1200, 200, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-12-17 06:52:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Iphone 7', '2538110', 1, 4, 1, 2, 1600, 400, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-10-18 14:43:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'LG G3', '2538110', 3, 2, 1, 2, 1200, 100, NULL, NULL, NULL, '', 4, 1, 'upload\\samsung.jpg', NULL, '0', '2019-12-26 11:33:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'RTX', '2538110', 1, 4, 1, 2, 1600, 1900, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-10-18 14:43:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Hellios', '2538110', 3, 2, 1, 2, 1200, 1200, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-12-17 06:53:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Hellios', '2538110', 3, 2, 1, 2, 1200, 1200, NULL, NULL, NULL, '', 4, 1, 'upload\\watch.png', NULL, '0', '2019-12-17 06:53:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `purchase_status_id` int(11) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `total_tax` float NOT NULL,
  `total_discount` float NOT NULL,
  `sub_total` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `paid` float NOT NULL,
  `delivery_date` date NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `supplier_id`, `warehouse_id`, `purchase_status_id`, `title`, `total_tax`, `total_discount`, `sub_total`, `total`, `paid`, `delivery_date`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 3, 4, 'Test', 10, 0, 0, 59774, 59776, '2019-12-20', '', '2020-01-02 07:22:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 2, 1, 3, 4, 'Test', 10, 0, 0, 59772, 59774, '2019-12-20', '', '2019-12-31 05:34:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 2, 1, 5, 4, 'Test Inventory', 5, 0, 17250, 18112, 18112, '2020-01-06', 'Test Inventory Insert.', '2020-01-06 09:12:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `requested_quantity` float DEFAULT NULL,
  `received_quantity` float NOT NULL,
  `price_of_purchase` float DEFAULT NULL,
  `given_discount` float DEFAULT NULL,
  `tax_on_product` float DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `purchase_id`, `product_id`, `requested_quantity`, `received_quantity`, `price_of_purchase`, `given_discount`, `tax_on_product`, `expiry_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 10, 10, 2500, 5, 10, '2019-12-19', '2019-12-16 12:55:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 7, 10, 10, 1200, 5, 10, '2019-12-20', '2019-12-16 12:55:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 8, 10, 10, 1500, 5, 10, '2019-12-21', '2019-12-16 12:55:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 38, 4, 10, 10, 1500, 0, 0, '2020-01-11', '2020-01-06 09:12:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 38, 7, 10, 10, 100, 0, 0, '2020-01-01', '2020-01-06 09:12:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 38, 8, 10, 5, 250, 0, 0, '2020-01-03', '2020-01-06 09:12:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_status`
--

CREATE TABLE `purchase_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_status`
--

INSERT INTO `purchase_status` (`id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Open', '2019-09-19 08:19:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sent', '2019-09-19 08:19:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Canceled', '2019-09-19 08:19:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Received', '2019-09-19 08:19:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `discount` float NOT NULL,
  `total_tax` float NOT NULL,
  `total` float NOT NULL DEFAULT '0',
  `paid` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `customer_id`, `warehouse_id`, `user_id`, `sub_total`, `discount`, `total_tax`, `total`, `paid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 8, 3, 6, 4500, 10, 10, 500, 86623, '2020-01-02 07:22:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 8, 3, 7, 4500, 10, 10, 1000, 86625, '2019-12-31 11:43:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 8, 3, 6, 4500, 10, 10, 0, 86625, '2019-10-07 09:52:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 2, 2, 49860, 9972, 150, 0, 50000, '2019-12-26 06:41:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 2, 2, 49860, 9972, 150, 25000, 50000, '2019-12-31 08:18:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sale_orders`
--

CREATE TABLE `sale_orders` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sale_orders`
--

INSERT INTO `sale_orders` (`id`, `sale_id`, `product_id`, `quantity`, `price`, `discount`, `tax`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 11, 4500, 10, 10, '2020-01-02 07:23:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 1, 2, 2500, 10, 10, '2019-10-06 07:11:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 2, 25, 1500, 10, 10, '2019-10-06 07:11:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, 2, 10, 4500, 10, 10, '2019-10-06 07:10:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 9, 1, 2, 2500, 10, 10, '2019-10-06 07:11:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 7, 2, 25, 1500, 10, 10, '2019-12-24 21:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 4, 5, 20, 1500, 10, 10, '2019-12-24 22:20:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 5, 40, 1500, 10, 10, '2019-12-25 01:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 10, 4, 32, 1600, 10, 50, '2019-12-26 06:41:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 10, 7, 2, 100, 10, 50, '2019-12-26 06:41:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 10, 3, 3, 1200, 0, 50, '2019-12-26 06:41:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 11, 4, 32, 1600, 10, 50, '2019-12-26 06:42:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 11, 7, 2, 100, 10, 50, '2019-12-26 06:42:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 11, 3, 3, 1200, 0, 50, '2019-12-26 06:42:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Soft drinks', 'Some stuff', 1, '2019-10-10 11:54:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Chips', 'Chips', 1, '2019-09-29 08:56:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Laptops', 'sd', 1, '2019-09-29 08:57:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 4, 'Car Equipments', '', 0, '2019-10-02 07:49:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `local_image_path` varchar(255) DEFAULT NULL,
  `server_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `fname`, `lname`, `company_name`, `email`, `phone`, `address`, `local_image_path`, `server_image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amazon', 'Corp', '', 'example.com', '7777777777', 'USA', NULL, NULL, '2019-09-23 06:30:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Dell', 'Cop', '', 'dell.example', '77777777', 'asdd', NULL, NULL, '2019-09-23 06:30:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'MHD', 'Limited', '', 'mhd@mhd.corp', '7772223333', 'Haddah, St.', NULL, NULL, '2019-09-24 09:09:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'NOT OK', 20, '2019-12-22 12:46:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Good stuff', 50, '2019-09-29 08:57:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'New Amount', 15, '2019-12-18 09:14:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Good people', 30, '2019-12-22 12:47:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_type` int(11) DEFAULT NULL,
  `total_cost_price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `net_total` float DEFAULT NULL,
  `paid` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Purchase', '2019-09-19 07:56:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Sale', '2019-09-19 07:56:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Expense', '2019-09-19 07:56:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `unit_of_counting`
--

CREATE TABLE `unit_of_counting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_of_counting`
--

INSERT INTO `unit_of_counting` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Piece', '2019-09-19 07:59:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Box', '2019-09-19 07:59:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Weight', '2019-09-19 07:59:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `local_image_path` varchar(255) DEFAULT NULL,
  `server_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `password`, `phone`, `email`, `role_id`, `local_image_path`, `server_image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Muanned Hello', '', '343', 'ssd@example.com', NULL, 'asd', NULL, '2020-01-01 10:56:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Ali Mothana', 'PAsSw0rd', '777777777', 'example@hotmail.com', NULL, NULL, NULL, '2019-09-22 06:31:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Moath Ahmed', 'helloWorld', '777777777', 'Moath@moath.com', NULL, NULL, NULL, '2019-09-22 06:33:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Saleh Farhan', 'Saleh123', '777111222333', 'Saleh@company.net', NULL, NULL, NULL, '2019-09-22 06:33:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Salah Al-Dhaferi', '$2y$10$adqpzbsqrrcghpkulam7COskNGIKrj7DjmgOZw3ZfW6KlTExJ2t6W', '772220700', 'example@example.com', NULL, 'watch.png', NULL, '2020-01-01 09:53:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Salah Al-Dhaferi', '$2y$10$4fyCUSzwn7GARDsCqoDORuppRYbiQg9bCdMMN/RAnHKn8Bp.CSyWm', '777222070', 'Salah@gmail.com', NULL, '294805e0c30ed9a06a.jpg', NULL, '2020-01-01 05:41:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Test', '$2y$10$.x99ALJXuOfRwZOWsOTSVOAaomlf8KIOaVXYqXRZCQAkRz52Q9YR6', '78855', 'ssd@ey.c', NULL, '17805e0c7c07a9e54.', NULL, '2020-01-01 11:01:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '334', '$2y$10$QYJbchbhwpoIBLAb2jNn6ewWUVcPgZ/2laipLEzXsql1xPwtNrMhy', '8999', '', NULL, '144825e0c7c4184597.', NULL, '2020-01-01 11:02:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Salah Al-Dhaferi', '$2y$10$fBUlafCvmTBd558PRXL1EuiNh9WQ9VNuy9ggH.IFpMGnEBVfumh16', '7855236', '', NULL, '240375e0c7d1e89935.', NULL, '2020-01-01 11:06:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE `user_privilege` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `privilege_category_id` int(11) DEFAULT NULL,
  `privilege_id` int(11) DEFAULT NULL,
  `privilege_state` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address`, `capacity`, `size`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hadda Warehouse', 'Haddah st.', '2500', '1200', 'Hello', '2019-09-29 08:53:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Saddah', 'Saddah st', '1500', '1000', 'Goodbye', '2020-01-02 12:18:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Thamar', 'Main st', '4500', '3200', 'Hi', '2019-09-29 08:54:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Yes', 'Yes', 'any', '1000', 'any', '2020-01-01 07:50:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `weight_type`
--

CREATE TABLE `weight_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weight_type`
--

INSERT INTO `weight_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tonne', '2019-09-19 07:59:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Kilogram', '2019-09-19 07:59:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gram', '2019-09-19 07:59:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Milligram', '2019-09-19 07:59:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege_category`
--
ALTER TABLE `privilege_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `weight_type_id` (`weight_type_id`),
  ADD KEY `tax_id` (`tax_id`),
  ADD KEY `unit_of_counting_id` (`unit_of_counting_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `purchase_status_id` (`purchase_status_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `purchase_status`
--
ALTER TABLE `purchase_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_of_counting`
--
ALTER TABLE `unit_of_counting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `privilege_category_id` (`privilege_category_id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weight_type`
--
ALTER TABLE `weight_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `debts`
--
ALTER TABLE `debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privilege_category`
--
ALTER TABLE `privilege_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `purchase_status`
--
ALTER TABLE `purchase_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sale_orders`
--
ALTER TABLE `sale_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit_of_counting`
--
ALTER TABLE `unit_of_counting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `weight_type`
--
ALTER TABLE `weight_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `debts_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`),
  ADD CONSTRAINT `debts_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`weight_type_id`) REFERENCES `weight_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_5` FOREIGN KEY (`unit_of_counting_id`) REFERENCES `unit_of_counting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_4` FOREIGN KEY (`purchase_status_id`) REFERENCES `purchase_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase_ibfk_6` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sale_orders`
--
ALTER TABLE `sale_orders`
  ADD CONSTRAINT `sale_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_orders_ibfk_3` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`transaction_type`) REFERENCES `transaction_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_ibfk_6` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD CONSTRAINT `user_privilege_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privilege_ibfk_2` FOREIGN KEY (`privilege_category_id`) REFERENCES `privilege_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privilege_ibfk_3` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
