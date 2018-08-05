-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2018 at 09:15 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tannhatquang_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `url` varchar(256) NOT NULL,
  `thumbnail` varchar(256) DEFAULT NULL,
  `desc` varchar(2048) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` tinyint(1) NOT NULL,
  `path` varchar(256) NOT NULL DEFAULT '',
  `created_datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(256) DEFAULT NULL,
  `updated_by` varchar(256) DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `url`, `thumbnail`, `desc`, `order`, `parent_id`, `path`, `created_datetime`, `updated_datetime`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Product', 'product', '', 'Manage product', 0, 0, '0-1-', '2017-08-07 23:44:13', NULL, 'admin', NULL, 'active'),
(2, 'News', 'news', '', 'Manage news', 0, 0, '0-2-', '2017-08-07 23:44:42', NULL, 'admin', NULL, 'active'),
(3, 'Ballast', 'ballast', '', '', 0, 1, '0-1-3-', '2018-08-03 09:02:43', '2018-08-03 09:02:43', 'admin', NULL, 'active'),
(4, 'Biến áp', 'bien-ap', '', '', 0, 1, '0-1-4-', '2018-08-03 09:02:51', '2018-08-03 09:02:51', 'admin', NULL, 'active'),
(5, 'Billy', 'billy', '', '', 0, 1, '0-1-5-', '2018-08-03 09:03:11', '2018-08-03 09:03:11', 'admin', NULL, 'active'),
(6, 'Bóng', 'bong', '', '', 0, 1, '0-1-6-', '2018-08-03 09:03:22', '2018-08-03 09:03:22', 'admin', NULL, 'active'),
(7, 'Bulb', 'bulb', '', '', 0, 1, '0-1-7-', '2018-08-03 09:03:30', '2018-08-03 09:03:30', 'admin', NULL, 'active'),
(8, 'Cáp', 'cap', '', '', 0, 1, '0-1-8-', '2018-08-03 09:03:36', '2018-08-03 09:03:36', 'admin', NULL, 'active'),
(9, 'Compact', 'compact', '', '', 0, 1, '0-1-9-', '2018-08-03 09:03:43', '2018-08-03 09:03:43', 'admin', NULL, 'active'),
(10, 'Chuột', 'chuot', '', '', 0, 1, '0-1-10-', '2018-08-03 09:03:49', '2018-08-03 09:03:49', 'admin', NULL, 'active'),
(11, 'Downlight', 'downlight', '', '', 0, 1, '0-1-11-', '2018-08-03 09:03:55', '2018-08-03 09:03:55', 'admin', NULL, 'active'),
(12, 'Dui', 'dui', '', '', 0, 1, '0-1-12-', '2018-08-03 09:04:03', '2018-08-03 09:04:03', 'admin', NULL, 'active'),
(13, 'Đèn bàn', 'den-ban', '', '', 0, 1, '0-1-13-', '2018-08-03 09:04:11', '2018-08-03 09:04:11', 'admin', NULL, 'active'),
(14, 'Đường', 'duong', '', '', 0, 1, '0-1-14-', '2018-08-03 09:04:19', '2018-08-03 09:04:19', 'admin', NULL, 'active'),
(15, 'Globe', 'globe', '', '', 0, 1, '0-1-15-', '2018-08-03 09:04:28', '2018-08-03 09:04:28', 'admin', NULL, 'active'),
(16, 'Halogen', 'halogen', '', '', 0, 1, '0-1-16-', '2018-08-03 09:05:12', '2018-08-03 09:05:12', 'admin', NULL, 'active'),
(17, ' Huỳnh Quang', 'huynh-quang', '', '', 0, 1, '0-1-17-', '2018-08-03 09:05:19', '2018-08-03 09:05:19', 'admin', NULL, 'active'),
(18, 'Kích', 'kich', '', '', 0, 1, '0-1-18-', '2018-08-03 09:05:28', '2018-08-03 09:05:28', 'admin', NULL, 'active'),
(19, 'LED', 'led', '', '', 0, 1, '0-1-19-', '2018-08-03 09:07:37', '2018-08-03 09:07:37', 'admin', NULL, 'active'),
(20, 'Master', 'master', '', '', 0, 1, '0-1-20-', '2018-08-03 09:07:45', '2018-08-03 09:07:45', 'admin', NULL, 'active'),
(21, 'Metal', 'metal', '', '', 0, 1, '0-1-21-', '2018-08-03 09:07:52', '2018-08-03 09:07:52', 'admin', NULL, 'active'),
(22, 'Nhà Xưởng', 'nha-xuong', '', '', 0, 1, '0-1-22-', '2018-08-03 09:08:04', '2018-08-03 09:08:04', 'admin', NULL, 'active'),
(23, 'Par', 'par', '', '', 0, 1, '0-1-23-', '2018-08-03 09:08:10', '2018-08-03 09:08:10', 'admin', NULL, 'active'),
(24, 'Pha', 'pha', '', '', 0, 1, '0-1-24-', '2018-08-03 09:08:19', '2018-08-03 09:08:19', 'admin', NULL, 'active'),
(25, 'Sodium', 'sodium', '', '', 0, 1, '0-1-25-', '2018-08-03 09:08:24', '2018-08-03 09:08:24', 'admin', NULL, 'active'),
(26, 'TCW', 'tcw', '', '', 0, 1, '0-1-26-', '2018-08-03 09:08:30', '2018-08-03 09:08:30', 'admin', NULL, 'active'),
(27, 'TCH', 'tch', '', '', 0, 1, '0-1-27-', '2018-08-03 09:08:42', '2018-08-03 09:08:42', 'admin', NULL, 'active'),
(28, 'Tempo', 'tempo', '', '', 0, 1, '0-1-28-', '2018-08-03 09:08:49', '2018-08-03 09:08:49', 'admin', NULL, 'active'),
(29, 'TMS008', 'tms008', '', '', 0, 1, '0-1-29-', '2018-08-03 09:08:56', '2018-08-03 09:08:56', 'admin', NULL, 'active'),
(30, 'TMS012', 'tms012', '', '', 0, 1, '0-1-30-', '2018-08-03 09:09:03', '2018-08-03 09:09:03', 'admin', NULL, 'active'),
(31, 'Tụ điện', 'tu-dien', '', '', 0, 1, '0-1-31-', '2018-08-03 09:09:10', '2018-08-03 09:09:10', 'admin', NULL, 'active'),
(32, 'TUBE', 'tube', '', '', 0, 1, '0-1-32-', '2018-08-03 09:09:16', '2018-08-03 09:09:16', 'admin', NULL, 'active'),
(33, 'TWS', 'tws', '', '', 0, 1, '0-1-33-', '2018-08-03 09:09:22', '2018-08-03 09:09:22', 'admin', NULL, 'active'),
(34, 'Thanh ray', 'thanh-ray', '', '', 0, 1, '0-1-34-', '2018-08-03 09:09:29', '2018-08-03 09:09:29', 'admin', NULL, 'active'),
(35, ' Thủy Ngân', 'thuy-ngan', '', '', 0, 1, '0-1-35-', '2018-08-03 09:09:36', '2018-08-03 09:09:36', 'admin', NULL, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
