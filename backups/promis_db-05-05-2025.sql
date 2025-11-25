-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 11:52 AM
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
-- Database: `promis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adx_country`
--

CREATE TABLE `adx_country` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adx_country`
--

INSERT INTO `adx_country` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'Papua New Guinea', 'PG', '2023-03-11 10:10:42'),
(2, 'Australia', 'AU', '2023-03-11 10:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `adx_district`
--

CREATE TABLE `adx_district` (
  `id` int(11) NOT NULL,
  `districtcode` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adx_district`
--

INSERT INTO `adx_district` (`id`, `districtcode`, `name`, `country_id`, `province_id`) VALUES
(19, 'PG1401', 'Ambunti-Dreikikir', 1, 90),
(20, 'PG1402', 'Angoram', 1, 90),
(21, 'PG1403', 'Maprik', 1, 90),
(22, 'PG1404', 'Wewak', 1, 90),
(23, 'PG1405', 'Yangoru-Saussia', 1, 90),
(39, 'PG1403', 'Telefomin', 1, 106);

-- --------------------------------------------------------

--
-- Table structure for table `adx_llg`
--

CREATE TABLE `adx_llg` (
  `id` int(11) NOT NULL,
  `llgcode` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adx_llg`
--

INSERT INTO `adx_llg` (`id`, `llgcode`, `name`, `country_id`, `province_id`, `district_id`) VALUES
(1, 'PG14041', 'Wewak Urban', 1, 90, 22),
(2, 'PG14042', 'Wewak Rural', 1, 90, 22),
(3, 'PG14043', 'Wewak Island', 1, 90, 22),
(4, 'PG14044', 'Turubu', 1, 90, 22),
(5, 'PG14045', 'Boikin ', 1, 90, 22),
(6, 'PG14046', 'Dagua', 1, 90, 22),
(7, 'PG140308', 'Namea Rural', 1, 106, 39),
(8, 'PG140309', 'Oksapmin Rural', 1, 106, 39),
(9, 'PG140310', 'Telefomin Rural', 1, 106, 39),
(10, 'PG140311', 'Yapsie Rural', 1, 106, 39);

-- --------------------------------------------------------

--
-- Table structure for table `adx_province`
--

CREATE TABLE `adx_province` (
  `id` int(11) NOT NULL,
  `provincecode` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adx_province`
--

INSERT INTO `adx_province` (`id`, `provincecode`, `name`, `country_id`) VALUES
(86, '03', 'Central Province', 1),
(87, '10', 'Chimbu Province', 1),
(88, '11', 'Eastern Highlands Province', 1),
(89, '18', 'East New Britain Province', 1),
(90, 'PG14', 'East Sepik Province', 1),
(91, '08', 'Enga Province', 1),
(92, '02', 'Gulf Province', 1),
(93, '21', 'Hela Province', 1),
(94, '22', 'Jiwaka Province', 1),
(95, '13', 'Madang Province', 1),
(96, '16', 'Manus Province', 1),
(97, '05', 'Milne Bay Province', 1),
(98, '12', 'Morobe Province', 1),
(99, '17', 'New Ireland Province', 1),
(100, '06', 'Oro Province', 1),
(101, '07', 'Southern Highlands Province', 1),
(102, '01', 'Western Province', 1),
(103, '09', 'Western Highlands Province', 1),
(104, '19', 'West New Britain Province', 1),
(105, '20', 'AROB Bougainville', 1),
(106, 'PG15', 'West Sepik Province', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adx_ward`
--

CREATE TABLE `adx_ward` (
  `id` int(11) NOT NULL,
  `wardcode` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `llg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractor_details`
--

CREATE TABLE `contractor_details` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `concode` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `con_logo` varchar(255) NOT NULL,
  `category` varchar(200) NOT NULL,
  `services` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `llg` varchar(200) NOT NULL,
  `gps` varchar(100) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lon` varchar(50) NOT NULL,
  `phones` varchar(255) NOT NULL,
  `emails` text NOT NULL,
  `weblinks` text NOT NULL,
  `address` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `create_org` varchar(255) NOT NULL,
  `update_org` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statusnotes` text NOT NULL,
  `notice_flag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractor_details`
--

INSERT INTO `contractor_details` (`id`, `ucode`, `concode`, `name`, `con_logo`, `category`, `services`, `country`, `province`, `district`, `llg`, `gps`, `lat`, `lon`, `phones`, `emails`, `weblinks`, `address`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `update_org`, `status`, `statusnotes`, `notice_flag`) VALUES
(15, '642bdd25ee8891680596261', '1410000', 'Wanda Works', '', 'CONST_ENG', 'Architect\r\nDesign\r\nBuilding', 'PG', '14', '1402', '', '', '', '', '', '', '', '', '2023-04-04 18:17:41', 'Minad', '2023-04-04 18:17:41', '', 'Figure Out Orgie', '', '1', '', ''),
(16, '654aff4419b301699413828', '145259', 'Turbeng', 'public/uploads/contractors_files/con_logo145259_1705454371.png', 'FIN_BANK', 'Money lending\r\nLoan Fixing\r\nLending Leader\r\nBridge Builder', 'PG', '14', '1404', '14044', '', '', '', '', '', '', '', '2023-11-08 13:23:48', 'Minad', '2024-01-17 11:20:04', 'Minad', 'Figure Out Orgie', 'Figure Out Oorgee', 'active', '', ''),
(17, '654c2df5362961699491317', '144082', 'Wonder Contractor', 'public/uploads/contractors_files/con_logo144082_1699491372.png', 'ENE_UTIL', 'Fuel,\r\nTrees,\r\nCoal\r\nFirewood', 'PG', '14', '1404', '14042', '', '', '', '33244', 'edw@we.com, 345@fg.com', 'WebLinks: https://chat.openai.com/c/88cef023-238a-4fdc-9173-9cc8698fc510', 'AddresssRRRRRR', '2023-11-09 10:55:17', 'Minad', '2024-01-17 14:28:18', 'Minad', 'Figure Out Orgie', 'Figure Out Oorgee', 'active', '', 'warning'),
(18, '65cab8c6e53051707784390', 'PG145399', 'Civil Works Contractor', '', 'CONST_ENG', 'Bitumen,\r\nRoad Sealing', 'PG', 'PG14', 'PG1404', 'PG14041', '', '', '', '', '', '', '', '2024-02-13 10:33:10', 'Minad', '2024-02-13 10:33:10', '', 'East Sepik Provincial Administration', '', 'active', '', ''),
(19, '664be39d462c81716249501', 'PG149409', 'Contractor Two', '', 'CONSULT', 'Consultancy', 'PG', 'PG14', 'PG1404', 'PG14044', '', '', '', '', '', '', '', '2024-05-21 09:58:21', 'Minad', '2024-05-21 09:58:21', '', 'East Sepik Provincial Administration', '', 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `contractor_files`
--

CREATE TABLE `contractor_files` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `concode` varchar(100) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_number` varchar(100) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `create_org` varchar(255) NOT NULL,
  `update_org` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statusnotes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractor_files`
--

INSERT INTO `contractor_files` (`id`, `ucode`, `concode`, `file_name`, `file_number`, `issued_date`, `expiry_date`, `file_path`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `update_org`, `status`, `statusnotes`) VALUES
(17, '654b166a2a7b11699419754', '145259', 'IPA Certificate', '5564', '2023-11-01', '2023-11-23', 'public/uploads/contractors_files/con_file145259_1699421565.pdf', '2023-11-08 05:02:34', 'Minad', '2023-11-08 15:43:20', 'Minad', 'Figure Out Orgie', 'Figure Out Orgie', 'active', ''),
(20, '654b17b514e8e1699420085', '145259', 'Company Profile', '11234', '2023-10-31', '2023-11-17', 'public/uploads/contractors_files/con_file145259_1699420085.pdf', '2023-11-08 05:08:05', 'Minad', '2023-11-09 08:53:02', 'Minad', 'Figure Out Orgie', 'Figure Out Orgie', 'active', ''),
(21, '654b17d1d50141699420113', '145259', 'IPA Certificate', '245245', '2023-11-03', '2023-11-09', 'public/uploads/contractors_files/con_file145259_1699420113.pdf', '2023-11-08 05:08:33', 'Minad', '2023-11-08 05:08:33', '', 'Figure Out Orgie', '', 'active', ''),
(22, '654b1a135b1461699420691', '145259', 'Awards Certificate', '5546', '2023-11-02', '2023-11-17', 'public/uploads/contractors_files/con_file145259_1699420691.pdf', '2023-11-08 05:18:11', 'Minad', '2023-11-08 05:18:11', '', 'Figure Out Orgie', '', 'active', ''),
(23, '654c2e54281921699491412', '144082', 'IPA Certificate', '55367', '2023-09-06', '2023-11-24', 'public/uploads/contractors_files/con_file144082_1699491412.pdf', '2023-11-09 10:56:52', 'Minad', '2023-11-09 10:56:52', '', 'Figure Out Orgie', '', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `contractor_notices`
--

CREATE TABLE `contractor_notices` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `orgcode` varchar(200) NOT NULL,
  `concode` varchar(100) NOT NULL,
  `notice_flag` varchar(255) DEFAULT NULL,
  `notice_title` varchar(100) DEFAULT NULL,
  `notice_description` text DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `create_org` varchar(255) NOT NULL,
  `update_org` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statusnotes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractor_notices`
--

INSERT INTO `contractor_notices` (`id`, `ucode`, `orgcode`, `concode`, `notice_flag`, `notice_title`, `notice_description`, `notice_date`, `file_path`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `update_org`, `status`, `statusnotes`) VALUES
(23, '', '', '145259', 'excellent', 'Excellent Job done', 'This is an Appreciation Notice for the job Well Done!!', NULL, 'public/uploads/contractors_files/con_notice145259_1699489090.pdf', '2023-11-09 10:18:10', 'Minad', '2023-11-09 10:18:10', '', 'Figure Out Orgie', '', '', ''),
(24, '', '', '145259', 'blacklist', 'Stole Money and Gone', 'Stole Money Without Work', '2023-11-01', 'public/uploads/contractors_files/con_notice145259_1699490007.pdf', '2023-11-09 10:33:27', 'Minad', '2023-11-09 10:33:27', '', 'Figure Out Orgie', '', '', ''),
(25, '', '', '145259', 'banned', 'Not Allowed', 'This is not Allowed', '2023-10-31', 'public/uploads/contractors_files/con_notice145259_1699490149.pdf', '2023-11-09 10:35:49', 'Minad', '2023-11-09 10:35:49', '', 'Figure Out Orgie', '', '', ''),
(26, '', '', '145259', 'warning', 'Wrning Hime to Continue', 'Warning to Contiunue Working', '2023-11-06', 'public/uploads/contractors_files/con_notice145259_1699491134.pdf', '2023-11-09 10:52:14', 'Minad', '2023-11-09 10:52:14', '', 'Figure Out Orgie', '', '', ''),
(27, '', '', '144082', 'good', 'Interview Was good he agreed to take on the job before payment', 'The payment discussion was aweseom', '2023-11-01', 'public/uploads/contractors_files/con_notice144082_1699491471.pdf', '2023-11-09 10:57:51', 'Minad', '2023-11-09 10:57:51', '', 'Figure Out Orgie', '', '', ''),
(28, '', '', '145259', 'banned', 'Stole Money and Gone', 'This is evil', '2023-10-30', 'public/uploads/contractors_files/con_notice145259_1699653032.pdf', '2023-11-11 07:50:32', 'Minad', '2023-11-11 07:50:32', '', 'Figure Out Oorgee', '', '', ''),
(29, '', '', '145259', 'banned', 'Conn man', 'This is conn', '2023-11-08', 'public/uploads/contractors_files/con_notice145259_1699653087.pdf', '2023-11-11 07:51:27', 'Minad', '2023-11-11 07:51:27', '', 'Figure Out Oorgee', '', '', ''),
(30, '', '', '144082', 'banned', 'Banned for a PEriod of time', 'This is to be banned', '2024-01-02', 'public/uploads/contractors_files/con_notice144082_1705462808.pdf', '2024-01-17 13:40:08', 'Minad', '2024-01-17 13:40:08', '', 'Figure Out Oorgee', '', '', ''),
(31, '', '', '144082', 'warning', 'This is the Warning', 'Warning', '2024-01-03', 'public/uploads/contractors_files/con_notice144082_1705463303.pdf', '2024-01-17 13:48:23', 'Minad', '2024-01-17 13:48:23', '', 'Figure Out Oorgee', '', '', ''),
(32, '', '', '144082', 'blacklist', 'Blacklisted', 'Desdcrt', '2024-01-02', 'public/uploads/contractors_files/con_notice144082_1705463352.pdf', '2024-01-17 13:49:12', 'Minad', '2024-01-17 13:49:12', '', 'Figure Out Oorgee', '', '', ''),
(33, '', '', '144082', 'warning', 'Warning Notive', 'Warning', '2024-01-09', 'public/uploads/contractors_files/con_notice144082_1705463990.pdf', '2024-01-17 13:59:50', 'Minad', '2024-01-17 13:59:50', '', 'Figure Out Oorgee', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dakoii_org`
--

CREATE TABLE `dakoii_org` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `loc_level_locked` varchar(100) NOT NULL,
  `loc_code_locked` varchar(100) NOT NULL,
  `loc_name_locked` text NOT NULL,
  `is_locationlocked` varchar(10) NOT NULL DEFAULT '0',
  `orglogo` varchar(200) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `province_code` varchar(100) NOT NULL,
  `district_code` varchar(100) NOT NULL,
  `llg_code` varchar(100) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `llg_name` varchar(255) NOT NULL,
  `center_gps_zoom` varchar(255) NOT NULL,
  `center_gps_longitude` varchar(255) NOT NULL,
  `center_gps_latitude` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phones` text NOT NULL,
  `emails` text NOT NULL,
  `is_active` varchar(10) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dakoii_org`
--

INSERT INTO `dakoii_org` (`id`, `orgcode`, `name`, `description`, `loc_level_locked`, `loc_code_locked`, `loc_name_locked`, `is_locationlocked`, `orglogo`, `country_code`, `province_code`, `district_code`, `llg_code`, `country_name`, `province_name`, `district_name`, `llg_name`, `center_gps_zoom`, `center_gps_longitude`, `center_gps_latitude`, `address`, `phones`, `emails`, `is_active`, `create_at`, `update_at`, `create_by`, `update_by`) VALUES
(2, '2345', 'East Sepik Provincial Administration', 'This is the figure out organization Too This\r\nThis is hte description', 'province', 'PG14', 'East Sepik Province', '1', 'public/uploads/org_logo/2345_1707199489.png', 'PG', 'PG14', 'PG1404', 'PG14044', 'Papua New Guinea', 'East Sepik Province', 'Wewak', 'Turubu', '8', '143.293196', '-4.294692', 'Wewak School BMS', '4556744, 556767', 'eda@gmail.com, dakoisnd@gmail.com', 'active', '2023-03-16 16:49:23', '2024-02-13 09:23:38', '', 'Minad'),
(3, '49501', 'Cooking', 'This is cooking descript', '', '', '', '0', 'http://localhost/promis/public/uploads/org_logo/49501_1679908153.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '2023-03-27 19:09:13', '2023-03-27 19:09:13', '', ''),
(4, '25492', 'Rico', 'Tekorif', '', '', '', '0', 'http://localhost/promis/public/uploads/org_logo/25492_1679966568.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '2023-03-27 19:15:40', '2023-03-28 11:22:48', '', ''),
(5, '16807', 'Activate', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2023-03-27 19:19:12', '2023-03-27 19:19:12', '', ''),
(6, '53874', 'Oepn Org', 'This Oepn thisdfnfsdj', '', '', '', '0', 'http://localhost/promis/public/uploads/org_logo/53874_1679914956.jpg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2023-03-27 19:23:18', '2023-03-27 21:02:36', '', ''),
(7, '336', 'Wan Org', 'This is the wan organization', '', '', '', '0', 'public/uploads/org_logo/336_1707786812.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2024-02-13 11:13:32', '2024-02-13 11:13:32', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dakoii_users`
--

CREATE TABLE `dakoii_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `orgcode` varchar(500) NOT NULL,
  `role` enum('admin','moderator','user') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dakoii_users`
--

INSERT INTO `dakoii_users` (`id`, `name`, `username`, `password`, `orgcode`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Free Kenny', 'fkenny', '$2y$10$A.8jXDJcv/wbzVi3l8bt/OPY6B0FpExgbUg.HOk6Khq9CYvKNQCyK', '', 'admin', 1, '2023-03-16 06:49:23', '2023-03-17 00:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `kmlfiles`
--

CREATE TABLE `kmlfiles` (
  `id` int(11) NOT NULL,
  `proucode` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `orgcode` varchar(200) NOT NULL,
  `procode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kmlfiles`
--

INSERT INTO `kmlfiles` (`id`, `proucode`, `name`, `filepath`, `create_at`, `create_by`, `status`, `orgcode`, `procode`) VALUES
(1, '', '', 'public/uploads/gps_files/142023-01_1695083906.kml', '2023-09-19 10:38:26', '', '', '', ''),
(2, '64c9bd1b0b9031690942747', '', 'public/uploads/gps_files/142023-01_1695084213.kml', '2023-09-19 10:43:33', 'Dok Man', '', '2345', '142023-01'),
(3, '64c9bd1b0b9031690942747', '', 'public/uploads/gps_files/142023-01_1695085666.kml', '2023-09-19 11:07:46', 'Dok Man', '', '2345', '142023-01'),
(4, '654af251245c01699410513', '', 'public/uploads/gps_files/142023-05_1699484983.kml', '2023-11-09 09:09:43', 'Minad', '', '2345', '142023-05'),
(5, '64c9bd1b0b9031690942747', '', 'public/uploads/gps_files/142023-01_1705525853.kml', '2024-01-18 07:10:53', 'Minad', '', '2345', '142023-01'),
(6, '65a7325918c401705456217', '', 'public/uploads/gps_files/202414-001_1705892445.kml', '2024-01-22 13:00:45', 'Minad', '', '2345', '202414-001'),
(7, '654af93ca86e81699412284', '', 'public/uploads/gps_files/142023-07_1705900840.kml', '2024-01-22 15:20:40', 'Minad', '', '2345', '142023-07');

-- --------------------------------------------------------

--
-- Table structure for table `profund`
--

CREATE TABLE `profund` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `description` text NOT NULL,
  `paymentdate` date NOT NULL,
  `filepath` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profund`
--

INSERT INTO `profund` (`id`, `ucode`, `procode`, `orgcode`, `amount`, `description`, `paymentdate`, `filepath`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(1, '6422523f243c71679970879', 'pip20231401', '2345', 0.00, '', '0000-00-00', '', '2023-03-28 12:34:39', 'Minad', '2023-03-28 12:34:39', '', ''),
(2, '642255e64351c1679971814', 'eu20231401', '2345', 0.00, 'This is the Road Point', '0000-00-00', '', '2023-03-28 12:50:14', 'Minad', '2023-03-28 14:27:32', '', '1'),
(3, '64227907a86b81679980807', 'eu20231401', '2345', 234.34, 'This is the payment for ringkon', '0000-00-00', '', '2023-03-28 15:20:07', 'Minad', '2023-03-28 15:20:07', '', ''),
(4, '6422794e61dae1679980878', 'eu20231401', '2345', 2324.45, 'This is the cos', '2023-03-03', '', '2023-03-28 15:21:18', 'Minad', '2023-03-28 15:21:18', '', ''),
(5, '642282c58f4c31679983301', 'eu20231401', '2345', 14345.23, '', '2023-03-08', '', '2023-03-28 16:01:41', 'Minad', '2023-03-28 16:01:41', '', ''),
(6, '6426232c70ab01680220972', 'pip202314-01', '2345', 458.56, 'Front up PAyment', '2023-03-11', '', '2023-03-31 10:02:52', 'Minad', '2023-04-01 10:22:00', 'Minad', ''),
(7, '64262488a17871680221320', 'pip202314-01', '2345', 0.00, '2nd Payment of the rules', '2023-03-13', '', '2023-03-31 10:08:40', 'Minad', '2023-04-01 11:20:58', 'Minad', ''),
(8, '', '', '', 0.00, '', '0000-00-00', 'http://localhost/promis/public/uploads/payment_files/paydocs_pip202314-01_1680311435pdf', '2023-04-01 11:10:35', '', '2023-04-01 11:10:35', '', ''),
(9, '64278526bc9f31680311590', 'pip202314-01', '2345', 1232.00, 'This  tokin', '2023-04-05', 'http://localhost/promis/public/uploads/payment_files/paydocs_pip202314-01_1680311590pdf', '2023-04-01 11:13:10', 'Minad', '2023-04-01 11:17:29', 'Minad', ''),
(10, '6427982a1f0fb1680316458', 'eu202314-01', '2345', 140.00, '1st Payment', '2023-03-31', 'http://localhost/promis/public/uploads/payment_files/paydocs_eu202314-01_1680316458.pdf', '2023-04-01 12:34:18', 'Minad', '2023-04-01 12:34:18', '', ''),
(11, '64c9d1d56931c1690948053', '142023-01', '2345', 23.23, 'Half Payment', '2023-08-02', 'public/uploads/payment_files/paydocs_142023-01_1690948053.txt', '2023-08-02 13:47:33', 'Minad', '2024-01-18 13:57:36', 'Minad', ''),
(12, '64f6938c5c1dc1693881228', '142023-01', '2345', 45.00, '1st Payment to Wanjuwa for the posts', '2023-07-12', 'public/uploads/payment_files/paydocs_142023-01_1693881477.pdf', '2023-09-05 12:33:48', 'Dok Man', '2024-01-18 10:20:52', 'Minad', ''),
(13, '654ad71c2d2881699403548', '142023-01', '2345', 46.00, 'This is the third payment', '2023-10-31', 'public/uploads/payment_files/paydocs_142023-01_1699403548.csv', '2023-11-08 10:32:28', 'Minad', '2024-01-18 10:21:01', 'Minad', ''),
(14, '65a7b8c2544881705490626', '142023-02', '2345', 0.00, 'This is payment', '2024-01-09', 'public/uploads/payment_files/paydocs_142023-02_1705490626.pdf', '2024-01-17 21:23:46', 'Dok Man', '2024-01-17 21:49:19', 'Dok Man', ''),
(15, '65a868972fbb21705535639', '142023-01', '2345', 45.00, 'This is front Payment', '2023-11-12', 'public/uploads/payment_files/paydocs_142023-01_1705535639.pdf', '2024-01-18 09:53:59', 'Minad', '2024-01-18 12:50:10', 'Minad', ''),
(16, '65a86a2e6b7601705536046', '142023-01', '2345', 34.00, 'Was uploaded later', '2020-11-11', 'public/uploads/payment_files/paydocs_142023-01_1705537301.pdf', '2024-01-18 10:00:46', 'Minad', '2024-01-18 10:21:54', 'Minad', ''),
(17, '65a86e6eca1dc1705537134', '142023-01', '2345', 55.00, 'This is new file', '2023-12-12', 'public/uploads/payment_files/paydocs_142023-01_1705537181.pdf', '2024-01-18 10:18:54', 'Minad', '2024-02-21 15:38:51', 'Dok Man', ''),
(18, '65a8a0c1c25941705550017', '142023-01', '2345', 100.00, 'Total Payed', '2024-01-09', 'public/uploads/payment_files/paydocs_142023-01_1705550017.pdf', '2024-01-18 13:53:37', 'Minad', '2024-01-18 13:53:37', '', ''),
(19, '65a9f813510641705637907', '202414-001', '2345', 30.00, 'This is an overpayment', '2024-01-04', 'public/uploads/payment_files/paydocs_202414-001_1705637907.pdf', '2024-01-19 14:18:27', 'Minad', '2024-01-19 14:18:27', '', ''),
(20, '65cabe3a74ad51707785786', '142023-07', '2345', 4325.20, 'Up front payment\r\n', '2024-01-31', 'public/uploads/payment_files/paydocs_142023-07_1707785786.pdf', '2024-02-13 10:56:26', 'Minad', '2024-02-13 11:01:01', 'Minad', ''),
(21, '65cabf9552e171707786133', '142023-07', '2345', 203.23, 'Cool payment', '2024-02-08', 'public/uploads/payment_files/paydocs_142023-07_1707786133.pdf', '2024-02-13 11:02:13', 'Minad', '2024-02-13 11:03:29', 'Minad', ''),
(22, '65cacc25872621707789349', '142023-05', '2345', 100000.00, 'NExt pary', '2024-02-08', 'public/uploads/payment_files/paydocs_142023-05_1707789349.pdf', '2024-02-13 11:55:49', 'Minad', '2024-02-13 11:55:49', '', ''),
(23, '65d587484e6fa1708492616', '142023-01', '2345', 50.00, 'This is another follow up payment\r\nFollowing the initial payment', '2024-02-21', 'public/uploads/payment_files/paydocs_142023-01_1708494135.pdf', '2024-02-21 15:16:56', 'Dok Man', '2024-03-12 15:25:04', 'Dok Man', ''),
(24, '65d58b27369f41708493607', '142023-01', '2345', 80.90, 'This is the timing', '2024-02-14', 'public/uploads/payment_files/paydocs_142023-01_1708493607.pdf', '2024-02-21 15:33:27', 'Dok Man', '2024-02-21 15:39:20', 'Dok Man', ''),
(25, '65efe76d0570c1710221165', '142023-01', '2345', 20333.00, 'This is one of the payments done', '2024-02-29', 'public/uploads/payment_files/paydocs_142023-01_1710221165.pdf', '2024-03-12 15:26:05', 'Dok Man', '2024-03-12 15:26:05', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `pro_date` date DEFAULT NULL,
  `pro_update_at` datetime DEFAULT NULL,
  `pro_update_by` varchar(255) NOT NULL,
  `mapping` varchar(100) NOT NULL,
  `fund` varchar(255) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `llg` varchar(200) DEFAULT NULL,
  `pro_site` varchar(255) NOT NULL,
  `kmlfile` text NOT NULL,
  `gps` varchar(100) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lon` varchar(50) NOT NULL,
  `gps_at` datetime DEFAULT NULL,
  `gps_by` varchar(255) NOT NULL,
  `budget` decimal(11,2) DEFAULT NULL,
  `budget_at` datetime DEFAULT NULL,
  `budget_by` varchar(255) NOT NULL,
  `payment_total` decimal(11,2) NOT NULL,
  `payment_at` datetime DEFAULT NULL,
  `payment_by` varchar(200) NOT NULL,
  `pro_officer_id` int(11) NOT NULL,
  `pro_officer_name` varchar(200) NOT NULL,
  `pro_officer_scope` text NOT NULL,
  `pro_officer_at` datetime DEFAULT NULL,
  `pro_officer_by` varchar(255) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `contractor_code` varchar(50) NOT NULL,
  `contractor_name` varchar(255) NOT NULL,
  `contract_file` varchar(255) NOT NULL,
  `contractor_at` datetime DEFAULT NULL,
  `contractor_by` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `create_org` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statusnotes` text NOT NULL,
  `status_at` datetime DEFAULT NULL,
  `status_by` varchar(255) NOT NULL,
  `pro_officer_cert` varchar(255) NOT NULL,
  `pro_contractor_cert` varchar(255) NOT NULL,
  `pro_officer_cert_at` varchar(255) NOT NULL,
  `pro_officer_cert_by` varchar(255) NOT NULL,
  `pro_contractor_cert_at` varchar(255) NOT NULL,
  `pro_contractor_cert_by` varchar(255) NOT NULL,
  `evaluation_file` varchar(255) NOT NULL,
  `evaluation_notes` text NOT NULL,
  `evaluation_date` date DEFAULT NULL,
  `evaluation_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `ucode`, `procode`, `orgcode`, `name`, `description`, `pro_date`, `pro_update_at`, `pro_update_by`, `mapping`, `fund`, `country`, `province`, `district`, `llg`, `pro_site`, `kmlfile`, `gps`, `lat`, `lon`, `gps_at`, `gps_by`, `budget`, `budget_at`, `budget_by`, `payment_total`, `payment_at`, `payment_by`, `pro_officer_id`, `pro_officer_name`, `pro_officer_scope`, `pro_officer_at`, `pro_officer_by`, `contractor_id`, `contractor_code`, `contractor_name`, `contract_file`, `contractor_at`, `contractor_by`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `status`, `statusnotes`, `status_at`, `status_by`, `pro_officer_cert`, `pro_contractor_cert`, `pro_officer_cert_at`, `pro_officer_cert_by`, `pro_contractor_cert_at`, `pro_contractor_cert_by`, `evaluation_file`, `evaluation_notes`, `evaluation_date`, `evaluation_by`) VALUES
(15, '64c9bd1b0b9031690942747', '142023-01', '2345', 'Cook Project', 'This is cook project this will go down to history', '2023-10-31', '2024-02-21 15:07:08', 'Minad', '', 'pip', 'PG', 'PG14', 'PG1404', 'PG14046', 'Hawain Bridge, Kurakum Village', 'public/uploads/gps_files/142023-01_1705525853.kml', '-3.577419,143.640458', '-3.577419', '143.640458', '2024-03-12 15:30:25', 'Dok Man', 5679.00, '2024-01-18 12:52:35', 'Minad', 20812.13, '2024-03-12 15:26:05', 'Dok Man', 11, 'Dok Man', 'This is the scome of work for him', '2024-01-18 12:52:12', 'Minad', 17, '144082', 'Wonder Contractor', 'public/uploads/contract_files/confile_142023-01_1705470291.pdf', '2024-01-17 15:44:51', 'Minad', '2023-08-02 12:19:07', 'Minad', '2024-03-12 15:30:25', 'Dok Man', '', 'active', 'It\'s been activated and work continues', '2024-01-17 14:45:08', 'Minad', '', '', '', '', '', '', '', '', NULL, ''),
(16, '64cafa3b45a461691023931', '142023-02', '2345', 'Wondering Project', 'This is the wondering project', NULL, NULL, '', '', 'tu', 'PG', 'PG14', 'PG1402', '', '', '', '-5.85549, 147.4178', '-3.664039', '143.372469', NULL, '', NULL, NULL, '', 0.00, NULL, '', 11, 'Dok Man', '', NULL, '', 0, '', '', '', NULL, '', '2023-08-03 10:52:11', 'Minad', '2024-02-23 10:05:58', 'Minad', '', 'completed', 'Completed on 12-10-2023', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(19, '654af251245c01699410513', '142023-05', '2345', 'ProWan Cool LLG Project', 'ProWan Project is a cool project', NULL, NULL, '', '', 'PIP', 'PG', 'PG14', 'PG1404', 'PG14044', '', 'public/uploads/gps_files/142023-05_1699484983.kml', '-3.868966,143.023704', '-3.868966', '143.023704', NULL, '', 400000.00, NULL, '', 100000.00, '2024-02-13 11:55:49', 'Minad', 11, 'Dok Man', 'Identify Works Civil Works and Report Back', NULL, '', 16, '145259', 'Turbeng', 'public/uploads/contract_files/confile_142023-05_1699485182.pdf', NULL, '', '2023-11-08 12:28:33', 'Minad', '2024-02-13 11:55:49', 'Minad', '', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(20, '654af3ea833c71699410922', '142023-06', '2345', 'Ori Projects', 'This is ori project', '2023-09-26', NULL, '', '', 'eu', 'PG', 'PG14', 'PG1404', 'PG14042', '', '', '-6.786405, 145.721189', '-6.786405', '145.721189', NULL, '', 45567.00, '2024-02-05 12:35:38', 'Minad', 0.00, NULL, '', 0, '', '', NULL, '', 17, '144082', 'Wonder Contractor', 'public/uploads/contract_files/confile_142023-06_1707100686.pdf', '2024-02-05 12:38:06', 'Minad', '2023-11-08 12:35:22', 'Minad', '2024-02-22 17:11:56', 'Minad', '', 'canceled', 'Project was cancelled due to financial constraints', '2024-02-05 12:37:46', 'Minad', '', '', '', '', '', '', '', '', NULL, ''),
(21, '654af93ca86e81699412284', '142023-07', '2345', 'Ring Dong', 'This i ', '2024-02-01', '2024-02-13 11:04:40', 'Minad', '', 'eu', 'PG', 'PG14', 'PG1404', 'PG14044', '', 'public/uploads/gps_files/142023-07_1705900840.kml', '-3.757755, 143.493639', '-3.757755', ' 143.493639', '2024-02-13 10:55:40', 'Minad', 20500.00, '2024-02-13 10:57:06', 'Minad', 4528.43, '2024-02-13 11:03:29', 'Minad', 0, '', '', NULL, '', 16, '145259', 'Turbeng', 'public/uploads/contract_files/confile_142023-07_1699484715.pdf', NULL, '', '2023-11-08 12:58:04', 'Minad', '2024-02-13 11:04:40', 'Minad', '', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(27, '65a7325918c401705456217', '202414-001', '2345', 'Wanajo', 'This is the project about Wanajoring', '2024-01-12', '2024-01-17 11:50:17', 'Minad', '', 'pip', 'PG', 'PG14', 'PG1402', '', '', 'public/uploads/gps_files/202414-001_1705892445.kml', '-3.559390,143.622710', '-3.559390', '143.622710', '2024-01-22 13:01:49', 'Minad', 24.00, NULL, '', 30.00, '2024-01-19 14:18:27', 'Minad', 12, 'Wan Boy', 'Asses the scope ', '2024-01-17 12:38:19', 'Minad', 17, '144082', 'Wonder Contractor', 'public/uploads/contract_files/confile_202414-001_1705456582.pdf', '2024-01-17 11:56:22', 'Minad', '2024-01-17 11:50:17', 'Minad', '2024-02-13 10:41:38', 'Minad', 'Figure Out Oorgee', 'completed', 'This hold', '2024-01-17 12:42:29', 'Minad', '', '', '', '', '', '', '', '', NULL, ''),
(28, '65caaa0b71ab31707780619', 'PG14045-2345-2024-001', '2345', 'Project Col', '', '2024-02-08', '2024-02-13 09:31:46', 'Minad', '', 'eu', 'PG', 'PG14', 'PG1404', 'PG14045', 'Hawain Bridge, Kurakum Village', '', '', '', '', NULL, '', 4230.00, '2024-02-13 10:30:34', 'Minad', 0.00, NULL, '', 10, 'Pik man', 'To assist to check off milestones', '2024-02-13 10:31:18', 'Minad', 0, '', '', '', NULL, '', '2024-02-13 09:30:19', 'Minad', '2024-02-13 10:31:18', 'Minad', 'East Sepik Provincial Administration', 'active', 'Project is active', '2024-02-13 10:30:26', 'Minad', '', '', '', '', '', '', '', '', NULL, ''),
(29, '65cac2e398bca1707786979', 'PG14044-2345-2024-1', '2345', 'Boe Wan Project', 'This is the boel project', '2023-12-12', '2024-02-13 11:16:19', 'Minad', '', 'tu', 'PG', 'PG14', 'PG1404', 'PG14044', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-02-13 11:16:19', 'Minad', '2024-02-23 10:06:05', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(30, '65d15d3d65c061708219709', 'PG14045-2345-202459', '2345', 'Cook Groups', 'This is a cook project', '2024-01-31', '2024-02-18 11:28:29', 'Minad', '', 'go', 'PG', 'PG14', 'PG1404', 'PG14045', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-02-18 11:28:29', 'Minad', '2024-02-23 10:06:11', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(31, '65d15d61f18f81708219745', 'PG14044-2345-202459', '2345', 'Testa Dakoii', '', '2024-02-21', '2024-02-18 11:29:05', 'Minad', '', 'hi', 'PG', 'PG14', 'PG1404', 'PG14044', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-02-18 11:29:05', 'Minad', '2024-02-23 10:06:15', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(32, '65d15d8a2989e1708219786', 'PG14046-2345-2024-1', '2345', 'Terima Cooking', 'This si teri cooking', '2024-03-09', '2024-02-18 11:29:46', 'Minad', '', 'gg', 'PG', 'PG14', 'PG1404', 'PG14046', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-02-18 11:29:46', 'Minad', '2024-02-23 10:06:19', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(33, '65d19a44368ee1708235332', 'PG14044-2345-20243', '2345', 'Retrance', 'This is retrance', '2024-02-06', '2024-02-18 15:48:52', 'Minad', '', 'we', 'PG', 'PG14', 'PG1404', 'PG14044', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-02-18 15:48:52', 'Minad', '2024-02-23 10:06:22', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, ''),
(34, '6728501eb6bb81730695198', 'PG14045-2345-3', '2345', 'Wewak Hydro ', '', '2024-11-01', '2024-11-04 14:39:58', 'Minad', '', NULL, 'PG', 'PG14', 'PG1404', 'PG14045', '', '', '', '', '', NULL, '', NULL, NULL, '', 0.00, NULL, '', 0, '', '', NULL, '', 0, '', '', '', NULL, '', '2024-11-04 14:39:58', 'Minad', '2024-11-04 14:39:58', 'Minad', 'East Sepik Provincial Administration', 'active', '', NULL, '', '', '', '', '', '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `project_eventfiles`
--

CREATE TABLE `project_eventfiles` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `filepath` text NOT NULL,
  `event_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_eventfiles`
--

INSERT INTO `project_eventfiles` (`id`, `ucode`, `procode`, `orgcode`, `filepath`, `event_id`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(35, '6427b34a1a5671680323402', 'pip202314-01', '2345', 'public/uploads/event_files/events_pip202314-01_1680323402-1.jpg', 60, '2023-04-01 14:30:02', 'Minad', '2023-04-01 14:30:02', '', ''),
(36, '6427b34a1b38d1680323402', 'pip202314-01', '2345', 'public/uploads/event_files/events_pip202314-01_1680323402-2.png', 60, '2023-04-01 14:30:02', 'Minad', '2023-04-01 14:30:02', '', ''),
(37, '6427b34a1c06f1680323402', 'pip202314-01', '2345', 'public/uploads/event_files/events_pip202314-01_1680323402-3.jpg', 60, '2023-04-01 14:30:02', 'Minad', '2023-04-01 14:30:02', '', ''),
(38, '6427b34a1cc371680323402', 'pip202314-01', '2345', 'public/uploads/event_files/events_pip202314-01_1680323402-4.png', 60, '2023-04-01 14:30:02', 'Minad', '2023-04-01 14:30:02', '', ''),
(39, '6427b34a1d9e41680323402', 'pip202314-01', '2345', 'public/uploads/event_files/events_pip202314-01_1680323402-5.jpg', 60, '2023-04-01 14:30:02', 'Minad', '2023-04-01 14:30:02', '', ''),
(40, '6427c215261f01680327189', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680327189-1.pdf', 61, '2023-04-01 15:33:09', 'Minad', '2023-04-01 15:33:09', '', ''),
(41, '6427c2152725e1680327189', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680327189-2.pdf', 61, '2023-04-01 15:33:09', 'Minad', '2023-04-01 15:33:09', '', ''),
(42, '6427c2152825f1680327189', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680327189-3.jpg', 61, '2023-04-01 15:33:09', 'Minad', '2023-04-01 15:33:09', '', ''),
(43, '6427c215294701680327189', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680327189-4.png', 61, '2023-04-01 15:33:09', 'Minad', '2023-04-01 15:33:09', '', ''),
(44, '6427c2152ab121680327189', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680327189-5.pdf', 61, '2023-04-01 15:33:09', 'Minad', '2023-04-01 15:33:09', '', ''),
(45, '6427cbc2a5c771680329666', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680329666-1.pdf', 63, '2023-04-01 16:14:26', 'Minad', '2023-04-01 16:14:26', '', ''),
(46, '6427cbc2a79b61680329666', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680329666-2.pdf', 63, '2023-04-01 16:14:26', 'Minad', '2023-04-01 16:14:26', '', ''),
(47, '6427da961e92d1680333462', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680333462-1.png', 64, '2023-04-01 17:17:42', 'Minad', '2023-04-01 17:17:42', '', ''),
(48, '6427da96204761680333462', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680333462-2.jpg', 64, '2023-04-01 17:17:42', 'Minad', '2023-04-01 17:17:42', '', ''),
(49, '6427da96219501680333462', 'pip202314-01', '2345', 'public/uploads/event_files/ev_pip202314-01_1680333462-3.png', 64, '2023-04-01 17:17:42', 'Minad', '2023-04-01 17:17:42', '', ''),
(50, '64f6c23ebf5691693893182', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1693893182-1.png', 68, '2023-09-05 15:53:02', 'Dok Man', '2023-09-05 15:53:02', '', ''),
(51, '64f6c23ec0f8d1693893182', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1693893182-2.png', 68, '2023-09-05 15:53:02', 'Dok Man', '2023-09-05 15:53:02', '', ''),
(52, '64f6cb83c757f1693895555', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1693895555-1.jpg', 69, '2023-09-05 16:32:35', 'Dok Man', '2023-09-05 16:32:35', '', ''),
(53, '64f6cb83cd1191693895555', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1693895555-2.docx', 69, '2023-09-05 16:32:35', 'Dok Man', '2023-09-05 16:32:35', '', ''),
(54, '64f6cb83cde101693895555', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1693895555-3.pdf', 69, '2023-09-05 16:32:35', 'Dok Man', '2023-09-05 16:32:35', '', ''),
(55, '6549c116d0dbd1699332374', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1699332374-1.pdf', 70, '2023-11-07 14:46:14', 'Dok Man', '2023-11-07 14:46:14', '', ''),
(56, '65a7b90f022ff1705490703', '142023-02', '2345', 'public/uploads/event_files/ev_142023-02_1705490703-1.pdf', 71, '2024-01-17 21:25:03', 'Dok Man', '2024-01-17 21:25:03', '', ''),
(57, '65a7b90f0be601705490703', '142023-02', '2345', 'public/uploads/event_files/ev_142023-02_1705490703-2.txt', 71, '2024-01-17 21:25:03', 'Dok Man', '2024-01-17 21:25:03', '', ''),
(58, '65a7b90f0cb8e1705490703', '142023-02', '2345', 'public/uploads/event_files/ev_142023-02_1705490703-3.jpg', 71, '2024-01-17 21:25:03', 'Dok Man', '2024-01-17 21:25:03', '', ''),
(59, '65a7b9390619b1705490745', '142023-02', '2345', 'public/uploads/event_files/ev_142023-02_1705490745-1.docx', 72, '2024-01-17 21:25:45', 'Dok Man', '2024-01-17 21:25:45', '', ''),
(60, '65efe7041b5e61710221060', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1710221060-1.pdf', 73, '2024-03-12 15:24:20', 'Dok Man', '2024-03-12 15:24:20', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_events`
--

CREATE TABLE `project_events` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `event` text NOT NULL,
  `eventdate` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_events`
--

INSERT INTO `project_events` (`id`, `ucode`, `procode`, `orgcode`, `event`, `eventdate`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(60, '6427b34a0e86b1680323402', 'pip202314-01', '2345', 'Taro is cooking and the mikes a????', '2023-03-16', '2023-04-01 14:30:02', 'Minad', '2023-04-01 17:27:30', 'Minad', ''),
(61, '6427c2151a03c1680327189', 'pip202314-01', '2345', 'Toko Riko Ramu', '2023-03-03', '2023-04-01 15:33:09', 'Minad', '2023-04-01 17:24:32', 'Minad', ''),
(62, '6427cad55efc01680329429', 'pip202314-01', '2345', 'Conflict between Korovi Tribe and Wanjowari tribe regarding the proposed build site', '2023-03-21', '2023-04-01 16:10:29', 'Minad', '2023-04-01 17:27:42', 'Minad', ''),
(63, '6427cbc29ad831680329666', 'pip202314-01', '2345', 'The tribal retaliation of kalu tribe- 23 wounded- 3 houses burnt', '2023-03-10', '2023-04-01 16:14:26', 'Minad', '2023-04-01 17:24:42', 'Minad', ''),
(64, '6427da96137c21680333462', 'pip202314-01', '2345', 'This is the rimotronefn\r\n', '2023-04-01', '2023-04-01 17:17:42', 'Minad', '2023-04-01 17:27:52', 'Minad', ''),
(65, '6427db41f36ad1680333633', 'pip202314-01', '2345', 'Tricking Stone Reconnianxe', '2023-03-13', '2023-04-01 17:20:34', 'Minad', '2023-04-01 17:27:11', 'Minad', ''),
(66, '6427dbac74c5d1680333740', 'pip202314-01', '2345', 'Tribal Conflict happening', '2023-03-30', '2023-04-01 17:22:20', 'Minad', '2023-04-01 17:22:20', '', ''),
(67, '64f6c1f20663d1693893106', '142023-01', '2345', 'This is the 1st event of this project', '2023-08-18', '2023-09-05 15:51:46', 'Dok Man', '2023-09-05 15:51:46', '', ''),
(68, '64f6c23ea449b1693893182', '142023-01', '2345', 'This is the 1st event of this project', '2023-08-18', '2023-09-05 15:53:02', 'Dok Man', '2023-09-05 15:53:02', '', ''),
(69, '64f6cb83ba44f1693895555', '142023-01', '2345', 'This is an event mixed with images and docs', '2023-08-17', '2023-09-05 16:32:35', 'Dok Man', '2023-09-05 16:32:35', '', ''),
(70, '6549c116c43001699332374', '142023-01', '2345', 'This is one of those events that occured', '2023-11-02', '2023-11-07 14:46:14', 'Dok Man', '2023-11-07 14:46:14', '', ''),
(71, '65a7b90ef17b71705490702', '142023-02', '2345', 'This event is caused by landslide and block road', '2024-01-04', '2024-01-17 21:25:02', 'Dok Man', '2024-01-17 21:25:02', '', ''),
(72, '65a7b938f1c731705490744', '142023-02', '2345', 'Tribal Fight Clashes', '2024-01-07', '2024-01-17 21:25:45', 'Dok Man', '2024-01-17 21:25:45', '', ''),
(73, '65efe703f14f01710221059', '142023-01', '2345', 'This event occured during fighting', '2024-03-06', '2024-03-12 15:24:19', 'Dok Man', '2024-03-12 15:24:19', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `filepath` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `ucode`, `procode`, `orgcode`, `name`, `filepath`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(1, '6422523f243c71679970879', 'pip20231401', '2345', '0.00', '', '2023-03-28 12:34:39', 'Minad', '2023-03-28 12:34:39', '', ''),
(2, '642255e64351c1679971814', 'eu20231401', '2345', '0.00', 'This is the Road Point', '2023-03-28 12:50:14', 'Minad', '2023-03-28 14:27:32', '', '1'),
(3, '64227907a86b81679980807', 'eu20231401', '2345', '234.34', 'This is the payment for ringkon', '2023-03-28 15:20:07', 'Minad', '2023-03-28 15:20:07', '', ''),
(4, '6422794e61dae1679980878', 'eu20231401', '2345', '2324.45', 'This is the cos', '2023-03-28 15:21:18', 'Minad', '2023-03-28 15:21:18', '', ''),
(5, '642282c58f4c31679983301', 'eu20231401', '2345', '14345.23', '', '2023-03-28 16:01:41', 'Minad', '2023-03-28 16:01:41', '', ''),
(6, '64c9b86ec3cdc1690941550', 'pip202314-01', '2345', 'Documentation', 'public/uploads/prodocs_files/prodocs_pip202314-01_1690941550.txt', '2023-03-31 10:02:52', 'Minad', '2023-08-02 11:59:10', '', ''),
(7, '64262488a17871680221320', 'pip202314-01', '2345', '25.34', '2nd Payment of the rules', '2023-03-31 10:08:40', 'Minad', '2023-03-31 10:08:40', '', ''),
(8, '642635e455c6d1680225764', 'pip202314-01', '2345', '1st Payment File', 'http://localhost/promis/public/uploads/prodocs_files/pip202314-01_1680225764jpg', '2023-03-31 11:22:44', 'Minad', '2023-03-31 11:22:44', '', ''),
(9, '64278b2631e2b1680313126', 'pip202314-01', '2345', 'Cooking', 'http://localhost/promis/public/uploads/prodocs_files/pip202314-01_1680313126pdf', '2023-04-01 11:38:46', 'Minad', '2023-04-01 11:38:46', '', ''),
(10, '64278b6e912011680313198', 'pip202314-01', '2345', 'This too', 'http://localhost/promis/public/uploads/prodocs_files/pip202314-01_1680313198.pdf', '2023-04-01 11:39:58', 'Minad', '2023-04-01 11:39:58', '', ''),
(11, '642796e7ca4831680316135', 'eu202314-01', '2345', 'Site Planning', 'http://localhost/promis/public/uploads/prodocs_files/eu202314-01_1680316135.png', '2023-04-01 12:22:17', 'Minad', '2023-04-01 12:28:55', '', ''),
(12, '642796d08aff41680316112', 'eu202314-01', '2345', 'Site Mapping', 'http://localhost/promis/public/uploads/prodocs_files/eu202314-01_1680316112.pdf', '2023-04-01 12:22:34', 'Minad', '2023-04-01 12:28:32', '', ''),
(13, '642796daebf321680316122', 'eu202314-01', '2345', 'Screening Top', 'http://localhost/promis/public/uploads/prodocs_files/eu202314-01_1680316122.pdf', '2023-04-01 12:23:04', 'Minad', '2023-04-01 12:28:42', '', ''),
(14, '642797581ec321680316248', 'eu202314-01', '2345', 'Track Path File', 'http://localhost/promis/public/uploads/prodocs_files/prodocs_eu202314-01_1680316248.kml', '2023-04-01 12:29:29', 'Minad', '2023-04-01 12:30:48', '', ''),
(15, '642797abe42181680316331', 'eu202314-01', '2345', 'This is the way ', 'http://localhost/promis/public/uploads/prodocs_files/prodocs_eu202314-01_1680316331.docx', '2023-04-01 12:31:44', 'Minad', '2023-04-01 12:32:11', '', ''),
(16, '646495d462f591684313556', 'pip202314-01', '2345', 'Submission Paper', 'public/uploads/prodocs_files/prodocs_pip202314-01_1684313556.pdf', '2023-05-17 18:52:36', 'Minad', '2023-05-17 18:52:36', '', ''),
(18, '64f68acf747cd1693878991', '142023-01', '2345', 'Exelont', 'public/uploads/prodocs_files/prodocs_142023-01_1693878991.csv', '2023-09-05 11:56:31', 'Dok Man', '2023-09-05 11:56:31', '', ''),
(19, '6556e2c19312e1700192961', '142023-01', '2345', 'Cook Wanada ', 'public/uploads/prodocs_files/prodocs_142023-01_1700192961.docx', '2023-11-08 09:58:04', 'Minad', '2023-11-17 13:49:21', 'Minad', ''),
(21, '65a77079eeb6b1705472121', '142023-01', '2345', 'Cooking', 'public/uploads/prodocs_files/prodocs_142023-01_1705472121.pdf', '2024-01-17 16:15:22', 'Minad', '2024-01-17 16:15:22', '', ''),
(23, '65a77213a47101705472531', '142023-01', '2345', 'Take Up and Raise up', 'public/uploads/prodocs_files/prodocs_142023-01_1705472531.csv', '2024-01-17 16:22:11', 'Minad', '2024-01-17 16:28:02', 'Minad', ''),
(28, '65a7b86dea98c1705490541', '142023-02', '2345', 'Cook Mix File', 'public/uploads/prodocs_files/prodocs_142023-02_1705490541.pdf', '2024-01-17 21:22:21', 'Dok Man', '2024-01-17 21:22:21', '', ''),
(32, '65d588d4890631708493012', '142023-01', '2345', 'This is the file', 'public/uploads/prodocs_files/prodocs_142023-01_1708493012.jpg', '2024-02-21 15:23:32', 'Dok Man', '2024-02-21 15:23:32', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_milefiles`
--

CREATE TABLE `project_milefiles` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `milestones_id` int(11) NOT NULL,
  `milestone_ucode` varchar(100) NOT NULL,
  `filepath` text NOT NULL,
  `caption` text NOT NULL,
  `phase_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_milefiles`
--

INSERT INTO `project_milefiles` (`id`, `ucode`, `procode`, `orgcode`, `milestones_id`, `milestone_ucode`, `filepath`, `caption`, `phase_id`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(43, '64caf3a5b87ee1691022245', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022245.jpg', '', 0, '2023-08-03 10:24:05', 'Dok Man', '2023-08-03 10:24:05', '', ''),
(44, '64caf3a5bebb51691022245', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022245.png', '', 0, '2023-08-03 10:24:05', 'Dok Man', '2023-08-03 10:24:05', '', ''),
(45, '64caf3a5bf94b1691022245', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022245.png', '', 0, '2023-08-03 10:24:05', 'Dok Man', '2023-08-03 10:24:05', '', ''),
(46, '64caf3a5c04651691022245', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022245.png', '', 0, '2023-08-03 10:24:05', 'Dok Man', '2023-08-03 10:24:05', '', ''),
(47, '64caf43040a071691022384', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022384.jpg', '', 0, '2023-08-03 10:26:24', 'Dok Man', '2023-08-03 10:26:24', '', ''),
(48, '64caf430484441691022384', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022384.png', '', 0, '2023-08-03 10:26:24', 'Dok Man', '2023-08-03 10:26:24', '', ''),
(49, '64caf4304932b1691022384', '142023-01', '2345', 0, '', 'public/uploads/milestone_files/mf_142023-01_1691022384.png', '', 0, '2023-08-03 10:26:24', 'Dok Man', '2023-08-03 10:26:24', '', ''),
(50, '64caf467a05951691022439', '142023-01', '2345', 27, '', 'public/uploads/milestone_files/mf_142023-01_1691022439.jpg', '', 18, '2023-08-03 10:27:19', 'Dok Man', '2023-08-03 10:27:19', '', ''),
(51, '64caf467a71f21691022439', '142023-01', '2345', 27, '', 'public/uploads/milestone_files/mf_142023-01_1691022439.png', '', 18, '2023-08-03 10:27:19', 'Dok Man', '2023-08-03 10:27:19', '', ''),
(52, '64cb1d7d4d80f1691032957', '142023-01', '2345', 28, '', 'public/uploads/milestone_files/mf_142023-01_1691032957.xlsx', '', 18, '2023-08-03 13:22:37', 'Dok Man', '2023-08-03 13:22:37', '', ''),
(53, '64cb1d7d4fb5a1691032957', '142023-01', '2345', 28, '', 'public/uploads/milestone_files/mf_142023-01_1691032957.xlsx', '', 18, '2023-08-03 13:22:37', 'Dok Man', '2023-08-03 13:22:37', '', ''),
(54, '64cb1d7d510bb1691032957', '142023-01', '2345', 28, '', 'public/uploads/milestone_files/mf_142023-01_1691032957.xlsx', '', 18, '2023-08-03 13:22:37', 'Dok Man', '2023-08-03 13:22:37', '', ''),
(55, '64efcdddbd8c91693437405', '142023-01', '2345', 27, '', 'public/uploads/milestone_files/mf_142023-01_1693437405.txt', '', 18, '2023-08-31 09:16:45', 'Dok Man', '2023-08-31 09:16:45', '', ''),
(56, '64f674977ebcf1693873303', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693873303.png', '', 18, '2023-09-05 10:21:43', 'Dok Man', '2023-09-05 10:21:43', '', ''),
(57, '64f6749787e831693873303', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693873303.png', '', 18, '2023-09-05 10:21:43', 'Dok Man', '2023-09-05 10:21:43', '', ''),
(58, '64f67497890161693873303', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693873303.jpg', '', 18, '2023-09-05 10:21:43', 'Dok Man', '2023-09-05 10:21:43', '', ''),
(59, '64f6749789afe1693873303', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693873303.png', '', 18, '2023-09-05 10:21:43', 'Dok Man', '2023-09-05 10:21:43', '', ''),
(60, '64f677b7b0c8e1693874103', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693874103.pdf', '', 18, '2023-09-05 10:35:03', 'Dok Man', '2023-09-05 10:35:03', '', ''),
(61, '65d582b5bfae11708491445', '142023-01', '2345', 27, '', 'public/uploads/milestone_files/mf_142023-01_1708491445.jpg', '', 18, '2024-02-21 14:57:25', 'Dok Man', '2024-02-21 14:57:25', '', ''),
(62, '65d582b5caab51708491445', '142023-01', '2345', 27, '', 'public/uploads/milestone_files/mf_142023-01_1708491445.png', '', 18, '2024-02-21 14:57:25', 'Dok Man', '2024-02-21 14:57:25', '', ''),
(63, '65efe7d20adec1710221266', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1710221266.pdf', '', 18, '2024-03-12 15:27:46', 'Dok Man', '2024-03-12 15:27:46', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_milestones`
--

CREATE TABLE `project_milestones` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `milestones` text NOT NULL,
  `checked` varchar(10) NOT NULL,
  `checked_date` date DEFAULT NULL,
  `notes` text NOT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date DEFAULT NULL,
  `phase_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_milestones`
--

INSERT INTO `project_milestones` (`id`, `ucode`, `procode`, `orgcode`, `milestones`, `checked`, `checked_date`, `notes`, `datefrom`, `dateto`, `phase_id`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(27, '64c9d350e7e091690948432', '142023-01', '2345', '1 Milestone', 'completed', '2023-09-09', 'This is notes \r\nwe can always write these notes properly. That\'s it', '2023-05-10', '2023-08-17', 18, '2023-08-02 13:53:52', 'Minad', '2023-09-11 09:32:14', 'Dok Man', ''),
(28, '64cb1a1bbec6e1691032091', '142023-01', '2345', 'Writing Submission', 'completed', '2023-08-30', 'Just completed', '2023-05-17', '2023-08-09', 18, '2023-08-03 13:08:11', 'Minad', '2024-02-21 14:59:21', 'Dok Man', ''),
(30, '64cb1ab2067271691032242', '142023-01', '2345', '3rd Milestone', 'completed', '2024-03-12', 'This is the concern of the set documents', '2023-11-02', '2023-11-23', 18, '2023-08-03 13:10:42', 'Minad', '2024-03-12 15:27:20', 'Dok Man', ''),
(31, '654acdc2135cb1699401154', '142023-01', '2345', 'Water Study', 'hold', '2024-02-14', 'This milestone is on hild', '2023-11-03', '2023-11-11', 19, '2023-11-08 09:52:34', 'Minad', '2024-02-21 15:57:33', 'Dok Man', ''),
(32, '654acddbe9f3a1699401179', '142023-01', '2345', 'Sun Study', 'pending', NULL, '', NULL, NULL, 19, '2023-11-08 09:52:59', 'Minad', '2024-01-17 18:49:24', '', ''),
(33, '654acde0814c31699401184', '142023-01', '2345', 'Moon Study', 'pending', NULL, '', '2023-11-02', '2023-11-12', 19, '2023-11-08 09:53:04', 'Minad', '2023-11-10 11:25:08', 'Minad', ''),
(52, '65cabd205ffdc1707785504', '142023-07', '2345', '1 Milestone', 'pending', NULL, '', '2024-02-07', '2024-02-18', 25, '2024-02-13 10:51:44', 'Minad', '2024-02-13 10:54:18', 'Minad', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_officers`
--

CREATE TABLE `project_officers` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `pocode` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_officers`
--

INSERT INTO `project_officers` (`id`, `ucode`, `orgcode`, `pocode`, `name`, `username`, `password`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(10, '64649e10202541684315664', '2345', '1001', 'Pik man', 'pman', '$2y$10$MrMF3iE2vOJrIz5BtS/zRuUQIT6XnZWyjFAnE5w7lzO2trKGB8QG2', '2023-05-17 19:27:44', 'Minad', '2024-01-19 12:30:49', 'Minad', 'deactive'),
(11, '64649e20c2ccb1684315680', '2345', '1002', 'Dok Man', 'dman', '$2y$10$N04wGz1c4pLXj7zTsbs3xeMnMjM5rDOA5blu44SrYlWPQ8biuVi0G', '2023-05-17 19:28:00', 'Minad', '2024-01-19 12:30:54', '', 'active'),
(12, '654c306fda92e1699491951', '2345', '1003', 'Wan Boy', 'wanboy', '$2y$10$An13lNEUgjdqnP6L1Xf5.uOgDph9Kr/zUjpWFQSHHSHs/dlyinPVa', '2023-11-09 11:05:51', 'Minad', '2024-01-19 12:30:58', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `project_phases`
--

CREATE TABLE `project_phases` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `phases` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_phases`
--

INSERT INTO `project_phases` (`id`, `ucode`, `procode`, `orgcode`, `phases`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(18, '64c9d3151694d1690948373', '142023-01', '2345', 'Documentation Phase', '2023-08-02 13:52:53', 'Minad', '2024-01-17 11:04:06', 'Minad', ''),
(19, '64f67a80c73b61693874816', '142023-01', '2345', 'Surverying styleish', '2023-09-05 10:46:56', 'Minad', '2024-01-18 11:08:51', 'Minad', ''),
(20, '654acd768666c1699401078', '142023-01', '2345', 'Foundation Phasesin', '2023-11-08 09:51:18', 'Minad', '2024-01-18 11:09:31', 'Minad', ''),
(21, '654e9d2e7cd3e1699650862', '142023-06', '2345', 'Phase One Documentation part', '2023-11-11 07:14:22', 'Minad', '2023-11-11 08:40:11', 'Minad', ''),
(22, '654e9f192f3341699651353', '142023-06', '2345', 'Phase Two', '2023-11-11 07:22:33', 'Minad', '2023-11-11 07:22:33', '', ''),
(25, '65cabb22b91931707784994', '142023-07', '2345', 'Documentation Phase', '2024-02-13 10:43:14', 'Minad', '2024-02-13 10:43:14', '', ''),
(26, '65cabc97a6f861707785367', '142023-07', '2345', 'Foundation Phase', '2024-02-13 10:49:27', 'Minad', '2024-02-13 10:49:27', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `procode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `phase_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tasks`
--

INSERT INTO `project_tasks` (`id`, `ucode`, `procode`, `orgcode`, `name`, `phase_id`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(1, '6422523f243c71679970879', 'pip20231401', '2345', '0.00', 0, '2023-03-28 12:34:39', 'Minad', '2023-03-28 12:34:39', '', ''),
(2, '642255e64351c1679971814', 'eu20231401', '2345', '0.00', 0, '2023-03-28 12:50:14', 'Minad', '2023-03-28 14:27:32', '', '1'),
(3, '64227907a86b81679980807', 'eu20231401', '2345', '234.34', 0, '2023-03-28 15:20:07', 'Minad', '2023-03-28 15:20:07', '', ''),
(4, '6422794e61dae1679980878', 'eu20231401', '2345', '2324.45', 0, '2023-03-28 15:21:18', 'Minad', '2023-03-28 15:21:18', '', ''),
(5, '642282c58f4c31679983301', 'eu20231401', '2345', '14345.23', 0, '2023-03-28 16:01:41', 'Minad', '2023-03-28 16:01:41', '', ''),
(6, '6426232c70ab01680220972', 'pip202314-01', '2345', '200.45', 0, '2023-03-31 10:02:52', 'Minad', '2023-03-31 10:02:52', '', ''),
(7, '64262488a17871680221320', 'pip202314-01', '2345', '25.34', 2, '2023-03-31 10:08:40', 'Minad', '2023-03-31 10:08:40', '', ''),
(8, '642635e455c6d1680225764', 'pip202314-01', '2345', '1st Payment File', 0, '2023-03-31 11:22:44', 'Minad', '2023-03-31 11:22:44', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `selection`
--

CREATE TABLE `selection` (
  `id` int(11) NOT NULL,
  `box` varchar(20) NOT NULL,
  `value` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selection`
--

INSERT INTO `selection` (`id`, `box`, `value`, `item`) VALUES
(1, 'roadclass', 'NR', 'National Road'),
(2, 'roadclass', 'PR', 'Provincial Road'),
(3, 'roadclass', 'DR', 'District Road'),
(4, 'fund', 'pip', 'PIP'),
(5, 'fund', 'eu', 'EU'),
(6, 'con_cat', 'TECH', 'Technology'),
(7, 'con_cat', 'CONST_ENG', 'Construction and Engineering'),
(8, 'con_cat', 'CONSULT', 'Consulting and Professional Services'),
(9, 'con_cat', 'FIN_BANK', 'Finance and Banking'),
(10, 'con_cat', 'HEALTH', 'Healthcare'),
(11, 'con_cat', 'EDU', 'Education'),
(12, 'con_cat', 'RET_CONS', 'Retail and Consumer Goods'),
(13, 'con_cat', 'HOSP_TOUR', 'Hospitality and Tourism'),
(14, 'con_cat', 'ENE_UTIL', 'Energy and Utilities'),
(15, 'con_cat', 'TRANS_LOG', 'Transportation and Logistics'),
(16, 'con_cat', 'MEDIA_ENT', 'Media and Entertainment'),
(17, 'con_cat', 'GOV_PUB', 'Government and Public Sector'),
(18, 'con_cat', 'NON_PROF', 'Non-profit and Social Services');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `value` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `value`, `name`, `create_at`) VALUES
(1, 'PG', 'country', '2023-03-11 13:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','user') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `orgcode`, `name`, `username`, `password`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(6, '', 'Rc4 Admin', 'admin', '$2y$10$u2WThss1GKD/.cWwQl0Gt.q14X83Gz2jxJcFx1Hge5EZxTLpW6ObC', 'admin', 1, '2023-03-17 03:48:51', '2023-03-17 03:48:51'),
(7, '', 'Photo MAngi', 'foto', '$2y$10$lEV0JqkUUrdmkQ.B27ibB.g77Ai1AkEoj3Y2ZU89IAa1ZaUZ4paTu', 'admin', 0, '2023-03-20 09:21:32', '2023-03-20 09:21:32'),
(8, '', 'Cool Boy', 'cboy', '$2y$10$9834LWBkfvBXjYKWefjFy.zvwZkWtoiLLGKyHr/pxodMusR1GS6fq', 'user', 1, '2023-03-28 01:10:41', '2023-03-28 01:10:41'),
(9, '', 'Fr', 'dsdf', '$2y$10$wxtLnGNDwxbNDWHN/63Ck.G1LflkzHpf3130sHdLwOjE/3y8uGNGG', 'user', 0, '2023-03-28 01:14:11', '2023-03-28 01:14:11'),
(10, '', 'daefw', 'dada', '$2y$10$XxfirPWI8RkYNrqbHide7.i7MQ7HPVUQkEXqedDoLi8s1yq1JbK.G', 'user', 0, '2023-03-28 01:15:58', '2023-03-28 01:15:58'),
(11, '', 'dafedw', 'dadw', '$2y$10$QtyktCRSvsjPPleLhITOGe1ZOBzDjZ2rNhfTNqTbc5oYbwOlAmsQa', 'user', 0, '2023-03-28 01:16:44', '2023-03-28 01:16:44'),
(12, '', 'dasda', 'ssdad', '$2y$10$JPDktb1yW3UQ6T8kkSr0BOGyWhhpSjrLef5h4wLIc.gQr8n5FHYUi', 'user', 0, '2023-03-28 01:19:52', '2023-03-28 01:19:52'),
(13, '2345', 'dafewv', 'daef', '$2y$10$PQ.vKcORr8iGOzRl32qAPupBtr17LYb61nmJIHS8Hz8nlXWAcfr/.', 'user', 0, '2023-03-28 01:28:56', '2023-03-28 01:28:56'),
(14, '2345', 'Minad', 'minad', '$2y$10$Av6cBIw6EvO/h7439n0mfeiAIwlReLmnkncSU4LTj8Iqubc4p2nK2', 'admin', 1, '2023-03-28 01:32:20', '2023-03-28 01:32:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adx_country`
--
ALTER TABLE `adx_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adx_district`
--
ALTER TABLE `adx_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adx_llg`
--
ALTER TABLE `adx_llg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adx_province`
--
ALTER TABLE `adx_province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adx_ward`
--
ALTER TABLE `adx_ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractor_details`
--
ALTER TABLE `contractor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractor_files`
--
ALTER TABLE `contractor_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contractor_notices`
--
ALTER TABLE `contractor_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dakoii_org`
--
ALTER TABLE `dakoii_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dakoii_users`
--
ALTER TABLE `dakoii_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profund`
--
ALTER TABLE `profund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_eventfiles`
--
ALTER TABLE `project_eventfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_events`
--
ALTER TABLE `project_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_milefiles`
--
ALTER TABLE `project_milefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_milestones`
--
ALTER TABLE `project_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_officers`
--
ALTER TABLE `project_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_phases`
--
ALTER TABLE `project_phases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selection`
--
ALTER TABLE `selection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `adx_country`
--
ALTER TABLE `adx_country`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `adx_district`
--
ALTER TABLE `adx_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `adx_llg`
--
ALTER TABLE `adx_llg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `adx_province`
--
ALTER TABLE `adx_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `adx_ward`
--
ALTER TABLE `adx_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractor_details`
--
ALTER TABLE `contractor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contractor_files`
--
ALTER TABLE `contractor_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contractor_notices`
--
ALTER TABLE `contractor_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `dakoii_org`
--
ALTER TABLE `dakoii_org`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dakoii_users`
--
ALTER TABLE `dakoii_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profund`
--
ALTER TABLE `profund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `project_eventfiles`
--
ALTER TABLE `project_eventfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `project_events`
--
ALTER TABLE `project_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `project_milefiles`
--
ALTER TABLE `project_milefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `project_milestones`
--
ALTER TABLE `project_milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `project_officers`
--
ALTER TABLE `project_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_phases`
--
ALTER TABLE `project_phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `selection`
--
ALTER TABLE `selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
