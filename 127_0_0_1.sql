-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 11:00 AM
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
  `log_date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log_date`, `time`, `created`, `modified`) VALUES
(1, 1, '2018/11/28', '09:27:14', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(2, 1, '2018/11/28', '09:29:06', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(3, 3, '2018/11/28', '09:32:39', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(4, 1, '2018/12/01', '07:57:35', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(5, 1, '2018/12/01', '08:25:09', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(6, 1, '2018/12/02', '22:44:12', '2018-12-04 07:01:35', '2018-12-04 07:01:35'),
(7, 1, '2018/12/03', '07:39:02', '2018-12-04 07:01:36', '2018-12-04 07:01:36'),
(8, 1, '2018/11/28', '09:27:14', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(9, 1, '2018/11/28', '09:29:06', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(10, 3, '2018/11/28', '09:32:39', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(11, 1, '2018/12/01', '07:57:35', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(12, 1, '2018/12/01', '08:25:09', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(13, 1, '2018/12/02', '22:44:12', '2018-12-04 09:56:05', '2018-12-04 09:56:05'),
(14, 1, '2018/12/03', '07:39:02', '2018-12-04 09:56:06', '2018-12-04 09:56:06');

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
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `firstname`, `lastname`, `gender`, `address`, `profile_pic`, `account_type`, `created`, `modified`) VALUES
(1, 'johndoe@yopmail.com', 'johndoe', '$2y$10$pwfYSPFwbErY1fV8WsX.Eestq5lL6tYtgdtOu2QienqeHmijj3gYe', 'john', 'doe', 'male', 'Legazpi City', 'avatar.png', 'admin', '2018-11-14 03:59:04', '2018-11-14 03:59:04'),
(3, 'briancalmadevacc@gmail.com', 'root192', '$2y$10$ST59yu5bU1hANqhWn.M7X.vm225rW9vza.Sr5dMg1.b65mRi/qvdi', 'brian', 'last', NULL, NULL, NULL, 'employee', '2018-11-23 07:55:31', '2018-11-23 07:55:31'),
(4, 'shinargscalma@yopmail.com', 'shin', '$2y$10$PIIkohdM6HPbRkz51s5fAOeVKKuckmxYbhBgCSUCnjSMWliFDFr.y', 'Shin', 'last', NULL, NULL, NULL, 'employee', '2018-11-23 08:26:41', '2018-11-23 08:26:41'),
(5, 'rakie@yopmail.com', 'rakie', '$2y$10$Bbc81cCJ67rFbeHSupy/Y.th9e8UJD0W4W65PXEvhw4Ulgu10EeVG', 'kiera', 'last', NULL, NULL, NULL, 'employee', '2018-11-23 14:28:03', '2018-11-23 14:28:03'),
(7, 'sherlock@yopmail.com', 'holmes', '$2y$10$63Qf7Mni33S99Sg80ozVh.nRoMixoMm36u0Ti7E/07iJxM6aCa9Ve', 'sherlock', 'holmes', NULL, NULL, NULL, 'employee', '2018-11-28 03:48:16', '2018-11-28 03:48:16'),
(8, 'yurigagarin@yopmail.com', 'Yuriyuri', '$2y$10$.j3UDtr0/M0hB8ztdooKOOSEDBtHJHbk6TnBWa6kGDlW12BqN9k7i', 'Yu', 'Gagarin', NULL, NULL, NULL, 'employee', '2018-12-03 02:37:50', '2018-12-03 02:37:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
