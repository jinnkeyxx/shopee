-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2020 at 02:17 PM
-- Server version: 5.7.31
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopee_checkin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(3) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `username`, `password`, `role`, `image`, `created_at`, `updated_at`, `status`) VALUES
(11, 'Võ Thái An', 'thaian@devforum.info', 'admin', '123', 0, 'http://localhost/shopee/assets\\images\\users\\profile2.png', '2020-09-22 16:11:04', '2020-09-22 16:11:04', 0),
(15, 'NV 001', 'nv001@mailinator.com', 'nv001', '123', 1, 'http://localhost/shopee/uploads/logo-fanpage-100px.png', '2020-09-28 03:09:00', '2020-09-28 03:09:00', 0),
(16, 'NV 002', 'nv002@gmail.com', 'nv002', '123', 1, 'http://localhost/shopee/uploads/img1601237321.png', '2020-09-29 21:08:33', '2020-09-29 21:08:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

DROP TABLE IF EXISTS `checkin`;
CREATE TABLE IF NOT EXISTS `checkin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(2) NOT NULL,
  `laptop` int(2) NOT NULL,
  `serial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orther` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orther` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manv` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `laptop` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_laptop` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orther` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(2) NOT NULL,
  `user_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `manv`, `team`, `phone`, `model_phone`, `serial`, `laptop`, `model_laptop`, `serial2`, `orther`, `serial3`, `images`, `status`, `user_post`) VALUES
(1, 'Võ Thái An', 'NV001', 'Inventory', 'Yes', 'MDH1', 'SH001', 'Yes', 'MDL1', 'SL001', 'Tai nghe 1', 'AD1', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTu51XqkERN4KCU2HF526phPswwmMY9qjexFA&usqp=CAU', 0, 'nv001'),
(2, 'Nguyễn Quang Bảo', 'NV002', 'Inbound', 'No', 'MDH2', 'SH002', 'No', 'MDL2', 'SL002', 'Tai nghe 2', 'AD2', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTu51XqkERN4KCU2HF526phPswwmMY9qjexFA&usqp=CAU', 1, 'nv001'),
(3, 'Nguyễn Văn A', 'NV003', 'Outbound', 'No', 'MDH3', 'SH003', 'Yes', 'MDL3', 'SL003', 'Tai nghe 3', 'AD3', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTu51XqkERN4KCU2HF526phPswwmMY9qjexFA&usqp=CAU', 1, 'nv001'),
(4, 'Nguyễn Văn B', 'NV004', 'Return', 'Yes', 'MDH4', 'SH004', 'No', 'MDL4', 'SL004', 'Tai nghe 4', 'AD4', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTu51XqkERN4KCU2HF526phPswwmMY9qjexFA&usqp=CAU', 1, 'nv001');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
