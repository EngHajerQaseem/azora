-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 08:31 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azroa_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `blackgem_users`
--

CREATE TABLE `blackgem_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `blackgem_users`
--

INSERT INTO `blackgem_users` (`id`, `name`, `password`, `salt`, `email`, `phone`, `user_role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Maher', '16c92179631d995fcc7cc48338181885ff1c2c5d3c87bfa001627d0b30d0ec16fc7aec43ecff085b403b3a88091255c5bebec5ad2fc601dbd279e86f9b82b248', '5zP42a9&DxlfBOr7r2orheo9BUNB1Ye1T!n5BpdHXW5RCejLhA3f9FJjh?HTZYyX', 'any@gmail.com', '714060582', 1, '2020-01-21 12:12:14', '2020-01-21 12:12:14', '2020-01-21 12:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `bundle`
--

CREATE TABLE `bundle` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `per month` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `bundle`
--

INSERT INTO `bundle` (`id`, `name`, `total`, `per month`, `created_at`, `updated_at`) VALUES
(1, '3 Months', 45, 15, '2019-11-12 11:17:43', '2019-11-12 11:17:43'),
(2, '6 Months', 72, 12, '2019-11-12 11:18:42', '2019-11-12 11:18:42'),
(3, '12 Months', 120, 10, '2019-11-12 11:18:59', '2019-11-12 11:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `bundle_id`, `created_at`, `updated_at`) VALUES
(19, 124, 2, '2019-12-12 07:11:36', '2019-12-12 07:11:36'),
(20, 2, 2, '2019-12-15 12:37:21', '2019-12-15 12:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `local_image_path` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `id_bundle` int(11) DEFAULT NULL,
  `type_of_shop` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `shopName` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `device_name` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `status` int(11) DEFAULT 1,
  `token` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `salt`, `phone`, `address`, `email`, `local_image_path`, `role_id`, `id_number`, `id_type`, `id_bundle`, `type_of_shop`, `shopName`, `device_id`, `device_name`, `longitude`, `latitude`, `status`, `token`, `language`, `register_date`, `created_at`, `updated_at`) VALUES
(215, 'Himyar', '511e4e115709416757b15f47df758bf1f39d9308325f6f8e107037ddc57743fac80afdd563a4da5d55b20ad5196570c5044c0976b9b3ec60769140882a69f696', 'BHVsdqi8@I&ME!zONm8GUYHiWXuz7ihDV?&&!bg3#X5yyJt&Gw!X#y833DWxb72r', '714060582', '714060582', 'any@gmail.com', NULL, 1, '10101012555444', 'passport', 3, '3', '3', NULL, NULL, 44.1832, 15.3989, 1, '', NULL, '2020-01-22 07:09:05', '2020-01-22 07:09:05', '2020-01-22 07:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-10-31 07:03:48', '2019-10-31 07:03:48'),
(2, 'sales', '2019-10-31 07:04:09', '2019-10-31 07:04:09'),
(3, 'accounting', '2019-10-31 07:05:18', '2019-10-31 07:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `verificationsms`
--

CREATE TABLE `verificationsms` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blackgem_users`
--
ALTER TABLE `blackgem_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`user_role`);

--
-- Indexes for table `bundle`
--
ALTER TABLE `bundle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `balance` (`bundle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `id_bundle` (`id_bundle`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `verificationsms`
--
ALTER TABLE `verificationsms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blackgem_users`
--
ALTER TABLE `blackgem_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bundle`
--
ALTER TABLE `bundle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verificationsms`
--
ALTER TABLE `verificationsms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blackgem_users`
--
ALTER TABLE `blackgem_users`
  ADD CONSTRAINT `blackgem_users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
