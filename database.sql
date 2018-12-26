-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2018 at 09:15 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biosys`
--
CREATE DATABASE IF NOT EXISTS `biosys` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biosys`;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payroll_id` int(11) NOT NULL,
  `log_date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `is_thirteen_month_pay` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) NOT NULL DEFAULT 'employee',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL DEFAULT 'OFFICE_1',
  `position` varchar(255) NOT NULL DEFAULT 'position_1',
  `rate_per_hour` double NOT NULL,
  `philhealth` tinyint(1) DEFAULT '0',
  `sss` tinyint(1) DEFAULT '0',
  `pagibig` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `firstname`, `lastname`, `gender`, `address`, `profile_pic`, `account_type`, `created`, `modified`, `age`, `birthdate`, `department`, `position`, `rate_per_hour`, `philhealth`, `sss`, `pagibig`) VALUES
(1, 'johndoe@yopmail.com', 'johndoe', '$2y$10$pwfYSPFwbErY1fV8WsX.Eestq5lL6tYtgdtOu2QienqeHmijj3gYe', 'john', 'doe', 'male', 'Legazpi City', 'avatar.png', 'admin', '2018-01-01 03:59:04', '2018-11-14 03:59:04', 0, '', 'OFFICE_1', 'position_1', 50, 1, 1, 1),
(3, 'briancalmadevacc@gmail.com', 'root192', '$2y$10$ST59yu5bU1hANqhWn.M7X.vm225rW9vza.Sr5dMg1.b65mRi/qvdi', 'brian', 'last', NULL, NULL, NULL, 'employee', '2018-11-23 07:55:31', '2018-11-23 07:55:31', 0, '', 'OFFICE_1', 'position_1', 50, 1, 1, 1),
(9, 'markotto@yopmail.com', 'ShinShoppe', '$2y$10$ZeWgTCe6sfZk8cpIMT7jveXFacP7dc7MQXNVoVJwuTjQa3wFh47ZO', 'Mark', 'Otto', 'male', '72 Penaranda Street Legazpi City', NULL, 'employee', '2018-12-15 01:26:43', '2018-12-15 03:07:45', 21, '2018-12-29', 'office_1', 'position_1', 42, 1, 1, 1),
(10, 'yuri@yopmail.com', 'YuriLast', '$2y$10$.KMuY67hQbYWvE2UQjXCwOPtGNL5ot4HIAhP2kHONkx5NcxszBu0a', 'Yuri', 'Last', 'female', 'Bigaa, Legazpi City', NULL, 'employee', '2018-12-15 09:12:53', '2018-12-19 05:49:07', 35, '2018-12-15', 'office_1', 'position_1', 50, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
