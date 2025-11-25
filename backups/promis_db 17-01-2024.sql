-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 06:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(1, '', 'Abau', 1, 86),
(2, '', 'Goilala', 1, 86),
(3, '', 'Kairuku-Hiri', 1, 86),
(4, '', 'Rigo', 1, 86),
(5, '', 'Chimbu', 1, 87),
(6, '', 'Gumine', 1, 87),
(7, '', 'Kerowagi', 1, 87),
(8, '', 'Kundiawa-Gembogl', 1, 87),
(9, '', 'Sinasina-Yonggomugl', 1, 87),
(10, '', 'Goroka', 1, 88),
(11, '', 'Kainantu', 1, 88),
(12, '', 'Lufa', 1, 88),
(13, '', 'Obura-Wonenara', 1, 88),
(14, '', 'Okapa', 1, 88),
(15, '', 'Gazelle', 1, 89),
(16, '', 'Kokopo', 1, 89),
(17, '', 'Pomio', 1, 89),
(18, '', 'Rabaul', 1, 89),
(19, '1401', 'Ambunti-Dreikikir', 1, 90),
(20, '1402', 'Angoram', 1, 90),
(21, '1403', 'Maprik', 1, 90),
(22, '1404', 'Wewak', 1, 90),
(23, '1405', 'Yangoru-Saussia', 1, 90),
(24, '', 'Kompiam-Ambum', 1, 91),
(25, '', 'Laiagam-Porgera', 1, 91),
(26, '', 'Wabag', 1, 91),
(27, '', 'Kerema', 1, 92),
(28, '', 'Kikori', 1, 92),
(29, '', 'Kopiago', 1, 92),
(30, '', 'Lake Murray', 1, 92),
(31, '', 'Hela', 1, 93),
(32, '', 'Komo-Margarima', 1, 93),
(33, '', 'Koroba-Lake Kopiago', 1, 93),
(34, '', 'Tari-Pori', 1, 93),
(35, '', 'Anglimp-South Waghi', 1, 94),
(36, '', 'Banz', 1, 94),
(37, '', 'Jimi', 1, 94),
(38, '', 'North Waghi', 1, 94);

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
(1, '14041', 'Wewak Urban', 1, 90, 22),
(2, '14042', 'Wewak Rural', 1, 90, 22),
(3, '14043', 'Wewak Island', 1, 90, 22),
(4, '14044', 'Turubu', 1, 90, 22),
(5, '14045', 'Boikin ', 1, 90, 22),
(6, '14046', 'Dagua', 1, 90, 22);

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
(51, '', 'Australian Capital Territory', 2),
(52, '', 'New South Wales', 2),
(53, '', 'Northern Territory', 2),
(54, '', 'Queensland', 2),
(55, '', 'South Australia', 2),
(56, '', 'Tasmania', 2),
(57, '', 'Victoria', 2),
(58, '', 'Western Australia', 2),
(86, '03', 'Central Province', 1),
(87, '10', 'Chimbu Province', 1),
(88, '11', 'Eastern Highlands Province', 1),
(89, '18', 'East New Britain Province', 1),
(90, '14', 'East Sepik Province', 1),
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
(105, '20', 'AROB Bougainville', 1);

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
(17, '654c2df5362961699491317', '144082', 'Wonder Contractor', 'public/uploads/contractors_files/con_logo144082_1699491372.png', 'ENE_UTIL', 'Fuel,\r\nTrees,\r\nCoal\r\nFirewood', 'PG', '14', '1404', '14042', '', '', '', '33244', 'edw@we.com, 345@fg.com', 'WebLinks: https://chat.openai.com/c/88cef023-238a-4fdc-9173-9cc8698fc510', 'AddresssRRRRRR', '2023-11-09 10:55:17', 'Minad', '2024-01-17 14:28:18', 'Minad', 'Figure Out Orgie', 'Figure Out Oorgee', 'active', '', 'warning');

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

INSERT INTO `contractor_notices` (`id`, `ucode`, `concode`, `notice_flag`, `notice_title`, `notice_description`, `notice_date`, `file_path`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `update_org`, `status`, `statusnotes`) VALUES
(23, '', '145259', 'excellent', 'Excellent Job done', 'This is an Appreciation Notice for the job Well Done!!', NULL, 'public/uploads/contractors_files/con_notice145259_1699489090.pdf', '2023-11-09 10:18:10', 'Minad', '2023-11-09 10:18:10', '', 'Figure Out Orgie', '', '', ''),
(24, '', '145259', 'blacklist', 'Stole Money and Gone', 'Stole Money Without Work', '2023-11-01', 'public/uploads/contractors_files/con_notice145259_1699490007.pdf', '2023-11-09 10:33:27', 'Minad', '2023-11-09 10:33:27', '', 'Figure Out Orgie', '', '', ''),
(25, '', '145259', 'banned', 'Not Allowed', 'This is not Allowed', '2023-10-31', 'public/uploads/contractors_files/con_notice145259_1699490149.pdf', '2023-11-09 10:35:49', 'Minad', '2023-11-09 10:35:49', '', 'Figure Out Orgie', '', '', ''),
(26, '', '145259', 'warning', 'Wrning Hime to Continue', 'Warning to Contiunue Working', '2023-11-06', 'public/uploads/contractors_files/con_notice145259_1699491134.pdf', '2023-11-09 10:52:14', 'Minad', '2023-11-09 10:52:14', '', 'Figure Out Orgie', '', '', ''),
(27, '', '144082', 'good', 'Interview Was good he agreed to take on the job before payment', 'The payment discussion was aweseom', '2023-11-01', 'public/uploads/contractors_files/con_notice144082_1699491471.pdf', '2023-11-09 10:57:51', 'Minad', '2023-11-09 10:57:51', '', 'Figure Out Orgie', '', '', ''),
(28, '', '145259', 'banned', 'Stole Money and Gone', 'This is evil', '2023-10-30', 'public/uploads/contractors_files/con_notice145259_1699653032.pdf', '2023-11-11 07:50:32', 'Minad', '2023-11-11 07:50:32', '', 'Figure Out Oorgee', '', '', ''),
(29, '', '145259', 'banned', 'Conn man', 'This is conn', '2023-11-08', 'public/uploads/contractors_files/con_notice145259_1699653087.pdf', '2023-11-11 07:51:27', 'Minad', '2023-11-11 07:51:27', '', 'Figure Out Oorgee', '', '', ''),
(30, '', '144082', 'banned', 'Banned for a PEriod of time', 'This is to be banned', '2024-01-02', 'public/uploads/contractors_files/con_notice144082_1705462808.pdf', '2024-01-17 13:40:08', 'Minad', '2024-01-17 13:40:08', '', 'Figure Out Oorgee', '', '', ''),
(31, '', '144082', 'warning', 'This is the Warning', 'Warning', '2024-01-03', 'public/uploads/contractors_files/con_notice144082_1705463303.pdf', '2024-01-17 13:48:23', 'Minad', '2024-01-17 13:48:23', '', 'Figure Out Oorgee', '', '', ''),
(32, '', '144082', 'blacklist', 'Blacklisted', 'Desdcrt', '2024-01-02', 'public/uploads/contractors_files/con_notice144082_1705463352.pdf', '2024-01-17 13:49:12', 'Minad', '2024-01-17 13:49:12', '', 'Figure Out Oorgee', '', '', ''),
(33, '', '144082', 'warning', 'Warning Notive', 'Warning', '2024-01-09', 'public/uploads/contractors_files/con_notice144082_1705463990.pdf', '2024-01-17 13:59:50', 'Minad', '2024-01-17 13:59:50', '', 'Figure Out Oorgee', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dakoii_org`
--

CREATE TABLE `dakoii_org` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `addlockllg` varchar(100) NOT NULL,
  `addlockdistrict` varchar(100) NOT NULL,
  `addlockprov` varchar(100) NOT NULL,
  `addlockcountry` varchar(100) NOT NULL,
  `orglogo` varchar(200) NOT NULL,
  `is_locationlocked` tinyint(1) NOT NULL DEFAULT 0,
  `country_code` varchar(100) NOT NULL,
  `province_code` varchar(100) NOT NULL,
  `district_code` varchar(100) NOT NULL,
  `llg_code` varchar(100) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `llg_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `create_by` varchar(200) NOT NULL,
  `update_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dakoii_org`
--

INSERT INTO `dakoii_org` (`id`, `orgcode`, `name`, `description`, `addlockllg`, `addlockdistrict`, `addlockprov`, `addlockcountry`, `orglogo`, `is_locationlocked`, `country_code`, `province_code`, `district_code`, `llg_code`, `country_name`, `province_name`, `district_name`, `llg_name`, `is_active`, `create_at`, `update_at`, `create_by`, `update_by`) VALUES
(2, '2345', 'Wonderful Organization', 'This is the figure out organization Too', '', '', '14', 'PG', 'public/uploads/org_files/org_logo_1705454766.png', 0, 'PG', '14', '1404', '14041', 'Papua New Guinea', 'East Sepik Province', 'Wewak', 'Wewak Urban', 1, '2023-03-16 16:49:23', '2024-01-17 11:26:06', '', 'Minad'),
(3, '49501', 'Cooking', 'This is cooking descript', '', '', '', '', 'http://localhost/promis/public/uploads/org_logo/49501_1679908153.jpg', 0, '', '', '', '', '', '', '', '', 0, '2023-03-27 19:09:13', '2023-03-27 19:09:13', '', ''),
(4, '25492', 'Rico', 'Tekorif', '', '', '', '', 'http://localhost/promis/public/uploads/org_logo/25492_1679966568.png', 0, '', '', '', '', '', '', '', '', 0, '2023-03-27 19:15:40', '2023-03-28 11:22:48', '', ''),
(5, '16807', 'Activate', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', 1, '2023-03-27 19:19:12', '2023-03-27 19:19:12', '', ''),
(6, '53874', 'Oepn Org', 'This Oepn thisdfnfsdj', '', '', '', '', 'http://localhost/promis/public/uploads/org_logo/53874_1679914956.jpg', 0, '', '', '', '', '', '', '', '', 1, '2023-03-27 19:23:18', '2023-03-27 21:02:36', '', '');

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
(4, '654af251245c01699410513', '', 'public/uploads/gps_files/142023-05_1699484983.kml', '2023-11-09 09:09:43', 'Minad', '', '2345', '142023-05');

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
(1, '6422523f243c71679970879', 'pip20231401', '2345', '0.00', '', '0000-00-00', '', '2023-03-28 12:34:39', 'Minad', '2023-03-28 12:34:39', '', ''),
(2, '642255e64351c1679971814', 'eu20231401', '2345', '0.00', 'This is the Road Point', '0000-00-00', '', '2023-03-28 12:50:14', 'Minad', '2023-03-28 14:27:32', '', '1'),
(3, '64227907a86b81679980807', 'eu20231401', '2345', '234.34', 'This is the payment for ringkon', '0000-00-00', '', '2023-03-28 15:20:07', 'Minad', '2023-03-28 15:20:07', '', ''),
(4, '6422794e61dae1679980878', 'eu20231401', '2345', '2324.45', 'This is the cos', '2023-03-03', '', '2023-03-28 15:21:18', 'Minad', '2023-03-28 15:21:18', '', ''),
(5, '642282c58f4c31679983301', 'eu20231401', '2345', '14345.23', '', '2023-03-08', '', '2023-03-28 16:01:41', 'Minad', '2023-03-28 16:01:41', '', ''),
(6, '6426232c70ab01680220972', 'pip202314-01', '2345', '458.56', 'Front up PAyment', '2023-03-11', '', '2023-03-31 10:02:52', 'Minad', '2023-04-01 10:22:00', 'Minad', ''),
(7, '64262488a17871680221320', 'pip202314-01', '2345', '0.00', '2nd Payment of the rules', '2023-03-13', '', '2023-03-31 10:08:40', 'Minad', '2023-04-01 11:20:58', 'Minad', ''),
(8, '', '', '', '0.00', '', '0000-00-00', 'http://localhost/promis/public/uploads/payment_files/paydocs_pip202314-01_1680311435pdf', '2023-04-01 11:10:35', '', '2023-04-01 11:10:35', '', ''),
(9, '64278526bc9f31680311590', 'pip202314-01', '2345', '1232.00', 'This  tokin', '2023-04-05', 'http://localhost/promis/public/uploads/payment_files/paydocs_pip202314-01_1680311590pdf', '2023-04-01 11:13:10', 'Minad', '2023-04-01 11:17:29', 'Minad', ''),
(10, '6427982a1f0fb1680316458', 'eu202314-01', '2345', '140.00', '1st Payment', '2023-03-31', 'http://localhost/promis/public/uploads/payment_files/paydocs_eu202314-01_1680316458.pdf', '2023-04-01 12:34:18', 'Minad', '2023-04-01 12:34:18', '', ''),
(11, '64c9d1d56931c1690948053', '142023-01', '2345', '200.45', 'Half Payment', '2023-08-02', 'public/uploads/payment_files/paydocs_142023-01_1690948053.txt', '2023-08-02 13:47:33', 'Minad', '2023-08-02 13:47:33', '', ''),
(12, '64f6938c5c1dc1693881228', '142023-01', '2345', '500.00', '1st Payment to Wanjuwa for the posts', '2023-07-12', 'public/uploads/payment_files/paydocs_142023-01_1693881477.pdf', '2023-09-05 12:33:48', 'Dok Man', '2023-09-05 12:37:57', 'Dok Man', ''),
(13, '654ad71c2d2881699403548', '142023-01', '2345', '2346.00', 'This is the third payment', '2023-10-31', 'public/uploads/payment_files/paydocs_142023-01_1699403548.csv', '2023-11-08 10:32:28', 'Minad', '2023-11-08 10:32:28', '', '');

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
  `status_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `ucode`, `procode`, `orgcode`, `name`, `description`, `pro_date`, `pro_update_at`, `pro_update_by`, `mapping`, `fund`, `country`, `province`, `district`, `llg`, `pro_site`, `kmlfile`, `gps`, `lat`, `lon`, `gps_at`, `gps_by`, `budget`, `budget_at`, `budget_by`, `pro_officer_id`, `pro_officer_name`, `pro_officer_scope`, `pro_officer_at`, `pro_officer_by`, `contractor_id`, `contractor_code`, `contractor_name`, `contract_file`, `contractor_at`, `contractor_by`, `create_at`, `create_by`, `update_at`, `update_by`, `create_org`, `status`, `statusnotes`, `status_at`, `status_by`) VALUES
(15, '64c9bd1b0b9031690942747', '142023-01', '2345', 'Cook Project', 'This is cook project this will go down to history', '2023-10-31', '2024-01-17 11:00:54', 'Minad', '', 'pip', 'PG', '14', '1404', '14046', '', 'public/uploads/gps_files/142023-01_1695085666.kml', '-3.550049,143.628629', '-3.550049', '143.628629', NULL, '', '1285.35', NULL, '', 11, 'Dok Man', 'This is the scome of work', '2024-01-17 14:54:24', 'Minad', 15, '1410000', 'Wanda Works', 'public/uploads/contract_files/confile_142023-01_1700259507.pdf', '2023-11-18 08:18:27', 'Minad', '2023-08-02 12:19:07', 'Minad', '2024-01-17 14:54:24', 'Minad', '', 'active', 'It\'s been activated and work continues', '2024-01-17 14:45:08', 'Minad'),
(16, '64cafa3b45a461691023931', '142023-02', '2345', 'Wondering Project', 'This is the wondering project', NULL, NULL, '', '', NULL, 'PG', '14', '1402', '', '', '', '', '', '', NULL, '', NULL, NULL, '', 11, 'Dok Man', '', NULL, '', 0, '', '', '', NULL, '', '2023-08-03 10:52:11', 'Minad', '2023-11-08 10:43:54', 'Minad', '', 'completed', 'Completed on 12-10-2023', NULL, ''),
(19, '654af251245c01699410513', '142023-05', '2345', 'ProWan Cool LLG Project', 'ProWan Project is a cool project', NULL, NULL, '', '', 'PIP', 'PG', '14', '1404', '14044', '', 'public/uploads/gps_files/142023-05_1699484983.kml', '-3.868966,143.023704', '-3.868966', '143.023704', NULL, '', '400000.00', NULL, '', 11, 'Dok Man', 'Identify Works Civil Works and Report Back', NULL, '', 16, '145259', 'Turbeng', 'public/uploads/contract_files/confile_142023-05_1699485182.pdf', NULL, '', '2023-11-08 12:28:33', 'Minad', '2023-11-10 09:10:43', 'Minad', '', 'active', '', NULL, ''),
(20, '654af3ea833c71699410922', '142023-06', '2345', 'Ori Projects', 'This is ori project', '2023-09-26', NULL, '', '', 'pip', 'PG', '14', '1404', '14042', '', '', '', '', '', NULL, '', '45567.00', NULL, '', 0, '', '', NULL, '', 15, '1410000', 'Wanda Works', 'public/uploads/contract_files/confile_142023-06_1699653398.pdf', NULL, '', '2023-11-08 12:35:22', 'Minad', '2023-11-11 07:56:38', 'Minad', '', 'active', '', NULL, ''),
(21, '654af93ca86e81699412284', '142023-07', '2345', 'Ring Dong', 'This i ', NULL, NULL, '', '', NULL, 'PG', '14', '1404', '14044', '', '', '', '', '', NULL, '', NULL, NULL, '', 0, '', '', NULL, '', 16, '145259', 'Turbeng', 'public/uploads/contract_files/confile_142023-07_1699484715.pdf', NULL, '', '2023-11-08 12:58:04', 'Minad', '2023-11-09 09:05:15', 'Minad', '', 'active', '', NULL, ''),
(27, '65a7325918c401705456217', '202414-001', '2345', 'Wanajo', 'This is the project about Wanajoring', '2024-01-12', '2024-01-17 11:50:17', 'Minad', '', 'pip', 'PG', '14', '1402', '', '', '', '', '', '', NULL, '', '24.00', NULL, '', 12, 'Wan Boy', 'Asses the scope ', '2024-01-17 12:38:19', 'Minad', 17, '144082', 'Wonder Contractor', 'public/uploads/contract_files/confile_202414-001_1705456582.pdf', '2024-01-17 11:56:22', 'Minad', '2024-01-17 11:50:17', 'Minad', '2024-01-17 13:19:10', 'Minad', 'Figure Out Oorgee', 'completed', 'This hold', '2024-01-17 12:42:29', 'Minad');

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
(55, '6549c116d0dbd1699332374', '142023-01', '2345', 'public/uploads/event_files/ev_142023-01_1699332374-1.pdf', 70, '2023-11-07 14:46:14', 'Dok Man', '2023-11-07 14:46:14', '', '');

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
(70, '6549c116c43001699332374', '142023-01', '2345', 'This is one of those events that occured', '2023-11-02', '2023-11-07 14:46:14', 'Dok Man', '2023-11-07 14:46:14', '', '');

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
(17, '64f68710865f71693878032', '142023-01', '2345', 'Ckkoing', 'public/uploads/prodocs_files/prodocs_142023-01_1693878032.pdf', '2023-09-05 11:40:32', 'Minad', '2023-09-05 11:40:32', '', ''),
(18, '64f68acf747cd1693878991', '142023-01', '2345', 'Exelont', 'public/uploads/prodocs_files/prodocs_142023-01_1693878991.csv', '2023-09-05 11:56:31', 'Dok Man', '2023-09-05 11:56:31', '', ''),
(19, '6556e2c19312e1700192961', '142023-01', '2345', 'Cook Wanada ', 'public/uploads/prodocs_files/prodocs_142023-01_1700192961.docx', '2023-11-08 09:58:04', 'Minad', '2023-11-17 13:49:21', 'Minad', '');

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
(60, '64f677b7b0c8e1693874103', '142023-01', '2345', 30, '', 'public/uploads/milestone_files/mf_142023-01_1693874103.pdf', '', 18, '2023-09-05 10:35:03', 'Dok Man', '2023-09-05 10:35:03', '', '');

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
(28, '64cb1a1bbec6e1691032091', '142023-01', '2345', 'Writing Submission', 'completed', '2023-08-30', 'Just completed', '2023-05-17', '2023-08-09', 18, '2023-08-03 13:08:11', 'Minad', '2023-09-06 16:06:04', 'Dok Man', ''),
(29, '64cb1a5e22f531691032158', '142023-01', '2345', 'Cooking Reels', 'halted', '2023-10-31', '', '2023-07-13', '2023-07-13', 18, '2023-08-03 13:09:18', 'Minad', '2023-11-07 14:27:43', 'Dok Man', ''),
(30, '64cb1ab2067271691032242', '142023-01', '2345', '3rd Milestone', 'hold', '2023-09-02', 'This is the concern of the set documents', '2023-11-02', '2023-11-23', 18, '2023-08-03 13:10:42', 'Minad', '2024-01-17 11:04:20', 'Minad', ''),
(31, '654acdc2135cb1699401154', '142023-01', '2345', 'Water Study', 'pending', NULL, '', '2023-11-03', '2023-11-11', 19, '2023-11-08 09:52:34', 'Minad', '2023-11-08 09:52:51', 'Minad', ''),
(32, '654acddbe9f3a1699401179', '142023-01', '2345', 'Sun Study', 'pending', NULL, '', '0000-00-00', '0000-00-00', 19, '2023-11-08 09:52:59', 'Minad', '2023-11-08 09:52:59', '', ''),
(33, '654acde0814c31699401184', '142023-01', '2345', 'Moon Study', 'pending', NULL, '', '2023-11-02', '2023-11-12', 19, '2023-11-08 09:53:04', 'Minad', '2023-11-10 11:25:08', 'Minad', ''),
(34, '654ace60d62911699401312', '142023-01', '2345', 'Stick Stone Hip', 'pending', NULL, '', '0000-00-00', '0000-00-00', 20, '2023-11-08 09:55:12', 'Minad', '2023-11-08 09:55:12', '', ''),
(35, '654ace69c42501699401321', '142023-01', '2345', 'Cement Mix', 'pending', NULL, '', '0000-00-00', '0000-00-00', 20, '2023-11-08 09:55:21', 'Minad', '2023-11-08 09:55:21', '', ''),
(36, '654ace7625b021699401334', '142023-01', '2345', 'Concrete Ironed up', 'pending', NULL, '', '0000-00-00', '0000-00-00', 20, '2023-11-08 09:55:34', 'Minad', '2023-11-08 09:55:34', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_officers`
--

CREATE TABLE `project_officers` (
  `id` int(11) NOT NULL,
  `ucode` varchar(100) NOT NULL,
  `orgcode` varchar(50) NOT NULL,
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

INSERT INTO `project_officers` (`id`, `ucode`, `orgcode`, `name`, `username`, `password`, `create_at`, `create_by`, `update_at`, `update_by`, `status`) VALUES
(10, '64649e10202541684315664', '2345', 'Pik man', 'pman', '$2y$10$MrMF3iE2vOJrIz5BtS/zRuUQIT6XnZWyjFAnE5w7lzO2trKGB8QG2', '2023-05-17 19:27:44', 'Minad', '2023-05-17 20:19:01', 'Minad', 'deactive'),
(11, '64649e20c2ccb1684315680', '2345', 'Dok Man', 'dman', '$2y$10$N04wGz1c4pLXj7zTsbs3xeMnMjM5rDOA5blu44SrYlWPQ8biuVi0G', '2023-05-17 19:28:00', 'Minad', '2023-05-17 19:28:00', '', 'active'),
(12, '654c306fda92e1699491951', '2345', 'Wan Boy', 'wanboy', '$2y$10$An13lNEUgjdqnP6L1Xf5.uOgDph9Kr/zUjpWFQSHHSHs/dlyinPVa', '2023-11-09 11:05:51', 'Minad', '2023-11-09 11:05:51', '', 'active');

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
(19, '64f67a80c73b61693874816', '142023-01', '2345', 'Surverying', '2023-09-05 10:46:56', 'Minad', '2023-09-05 10:46:56', '', ''),
(20, '654acd768666c1699401078', '142023-01', '2345', 'Foundation Phase', '2023-11-08 09:51:18', 'Minad', '2023-11-08 09:51:53', 'Minad', ''),
(21, '654e9d2e7cd3e1699650862', '142023-06', '2345', 'Phase One Documentation part', '2023-11-11 07:14:22', 'Minad', '2023-11-11 08:40:11', 'Minad', ''),
(22, '654e9f192f3341699651353', '142023-06', '2345', 'Phase Two', '2023-11-11 07:22:33', 'Minad', '2023-11-11 07:22:33', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `adx_llg`
--
ALTER TABLE `adx_llg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adx_province`
--
ALTER TABLE `adx_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `adx_ward`
--
ALTER TABLE `adx_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractor_details`
--
ALTER TABLE `contractor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dakoii_users`
--
ALTER TABLE `dakoii_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profund`
--
ALTER TABLE `profund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project_eventfiles`
--
ALTER TABLE `project_eventfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `project_events`
--
ALTER TABLE `project_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `project_milefiles`
--
ALTER TABLE `project_milefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `project_milestones`
--
ALTER TABLE `project_milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `project_officers`
--
ALTER TABLE `project_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_phases`
--
ALTER TABLE `project_phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
