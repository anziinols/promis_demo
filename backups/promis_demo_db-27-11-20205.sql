-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 11:28 PM
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
-- Database: `promis_demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adx_country`
--

CREATE TABLE `adx_country` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adx_country`
--

INSERT INTO `adx_country` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'Papua New Guinea', 'PNG', '2025-11-23 14:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `adx_district`
--

CREATE TABLE `adx_district` (
  `id` int(11) UNSIGNED NOT NULL,
  `districtcode` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adx_district`
--

INSERT INTO `adx_district` (`id`, `districtcode`, `name`, `country_id`, `province_id`) VALUES
(1, '0301', 'Abau', 1, 86),
(2, '0302', 'Goilala', 1, 86),
(3, '0303', 'Kairuku-Hiri', 1, 86),
(4, '0304', 'Rigo', 1, 86);

-- --------------------------------------------------------

--
-- Table structure for table `adx_llg`
--

CREATE TABLE `adx_llg` (
  `id` int(11) UNSIGNED NOT NULL,
  `llgcode` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adx_llg`
--

INSERT INTO `adx_llg` (`id`, `llgcode`, `name`, `country_id`, `province_id`, `district_id`) VALUES
(1, 'PG030101', 'Abau Urban', 1, 86, 1),
(2, 'PG030102', 'Amazon Bay Rural', 1, 86, 1),
(3, 'PG030103', 'Aroma Rural', 1, 86, 1),
(4, 'PG030104', 'Cloudy Bay Rural', 1, 86, 1),
(5, 'PG030201', 'Guari Rural', 1, 86, 2),
(6, 'PG030202', 'Tapini Rural', 1, 86, 2),
(7, 'PG030203', 'Woitape Rural', 1, 86, 2),
(8, 'PG030301', 'Hiri Rural', 1, 86, 3),
(9, 'PG030302', 'Koiari Rural', 1, 86, 3),
(10, 'PG030303', 'Koita Rural', 1, 86, 3),
(11, 'PG030304', 'Mekeo Kuni Rural', 1, 86, 3),
(12, 'PG030305', 'Roro Rural', 1, 86, 3),
(13, 'PG030401', 'Rigo Rural', 1, 86, 4),
(14, 'PG030402', 'Yule Island Rural', 1, 86, 4);

-- --------------------------------------------------------

--
-- Table structure for table `adx_province`
--

CREATE TABLE `adx_province` (
  `id` int(11) UNSIGNED NOT NULL,
  `provincecode` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adx_province`
--

INSERT INTO `adx_province` (`id`, `provincecode`, `name`, `country_id`) VALUES
(86, '03', 'Central Province', 1);

-- --------------------------------------------------------

--
-- Table structure for table `adx_ward`
--

CREATE TABLE `adx_ward` (
  `id` int(11) UNSIGNED NOT NULL,
  `wardcode` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `llg_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basefiles`
--

CREATE TABLE `basefiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `kmlucode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `road_id` int(11) DEFAULT NULL,
  `road_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractor_details`
--

CREATE TABLE `contractor_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `concode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `con_logo` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `services` text DEFAULT NULL,
  `ipanumber` varchar(255) DEFAULT NULL,
  `ipadate` date DEFAULT NULL,
  `ipafile` varchar(255) DEFAULT NULL,
  `ircnumber` varchar(255) DEFAULT NULL,
  `ircfile` varchar(255) DEFAULT NULL,
  `cocnumber` varchar(255) DEFAULT NULL,
  `cocfile` varchar(255) DEFAULT NULL,
  `profiledate` date DEFAULT NULL,
  `file_profile` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `llg` varchar(255) DEFAULT NULL,
  `phones` varchar(255) DEFAULT NULL,
  `emails` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `weblinks` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `statusnotes` text DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lon` varchar(100) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `create_org` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `update_org` varchar(255) DEFAULT NULL,
  `notice_flag` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contractor_details`
--

INSERT INTO `contractor_details` (`id`, `ucode`, `concode`, `name`, `con_logo`, `category`, `services`, `ipanumber`, `ipadate`, `ipafile`, `ircnumber`, `ircfile`, `cocnumber`, `cocfile`, `profiledate`, `file_profile`, `country`, `province`, `district`, `llg`, `phones`, `emails`, `address`, `weblinks`, `status`, `statusnotes`, `gps`, `lat`, `lon`, `create_by`, `create_org`, `update_by`, `update_org`, `notice_flag`, `create_at`, `update_at`) VALUES
(1, '69263e3228b6b1764113970154', 'CP-CON-001', 'Central Infrastructure Builders Ltd', NULL, 'CONST_ENG', 'Road Construction\nBridge Building\nCivil Engineering\nProject Management', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '03', '0301', NULL, '+675 325 4567, +675 7234 5678', 'info@cibpng.com, projects@cibpng.com', 'Section 45, Lot 23, Abau Town, Central Province, Papua New Guinea', 'www.cibpng.com', 'active', NULL, NULL, NULL, NULL, 'System Seeder', '3301', NULL, NULL, NULL, '2025-11-26 09:39:30', '2025-11-26 09:39:30'),
(2, '69263e32297ba1764113970178', 'CP-CON-002', 'Goilala Construction & Development Co.', NULL, 'CONST_ENG', 'Building Construction\nWater Supply Systems\nCommunity Infrastructure\nRural Development', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '03', '0302', NULL, '+675 325 7890, +675 7098 7654', 'contact@goilalaconst.pg, admin@goilalaconst.pg', 'Tapini Station, Goilala District, Central Province, Papua New Guinea', 'www.goilalaconst.pg', 'active', NULL, NULL, NULL, NULL, 'System Seeder', '3301', NULL, NULL, NULL, '2025-11-26 09:39:30', '2025-11-26 09:39:30'),
(3, '69263e322b4e21764113970550', 'CP-CON-003', 'Pacific Coast Engineering Services', NULL, 'CONST_ENG', 'Infrastructure Development\nHealth Facility Construction\nEducation Infrastructure\nMaintenance Services', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '03', '0303', NULL, '+675 325 1122, +675 7345 6789', 'info@pces.pg, engineering@pces.pg', 'Bereina Town, Kairuku-Hiri District, Central Province, Papua New Guinea', 'www.pces.pg', 'active', NULL, NULL, NULL, NULL, 'System Seeder', '3301', NULL, NULL, NULL, '2025-11-26 09:39:30', '2025-11-26 09:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `contractor_files`
--

CREATE TABLE `contractor_files` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `concode` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_number` varchar(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_org` varchar(255) DEFAULT NULL,
  `update_org` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `statusnotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contractor_notices`
--

CREATE TABLE `contractor_notices` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `concode` varchar(255) DEFAULT NULL,
  `notice_flag` varchar(50) DEFAULT NULL,
  `notice_title` varchar(255) DEFAULT NULL,
  `notice_description` text DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_org` varchar(255) DEFAULT NULL,
  `update_org` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `statusnotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dakoii_org`
--

CREATE TABLE `dakoii_org` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `loc_level_locked` varchar(100) DEFAULT NULL,
  `loc_code_locked` varchar(255) DEFAULT NULL,
  `loc_name_locked` varchar(255) DEFAULT NULL,
  `orglogo` varchar(255) DEFAULT NULL,
  `is_locationlocked` tinyint(1) NOT NULL DEFAULT 0,
  `country_code` varchar(100) DEFAULT NULL,
  `province_code` varchar(100) DEFAULT NULL,
  `district_code` varchar(100) DEFAULT NULL,
  `llg_code` varchar(100) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `province_name` varchar(255) DEFAULT NULL,
  `district_name` varchar(255) DEFAULT NULL,
  `llg_name` varchar(255) DEFAULT NULL,
  `center_gps_zoom` varchar(50) DEFAULT NULL,
  `center_gps_longitude` varchar(100) DEFAULT NULL,
  `center_gps_latitude` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phones` varchar(255) DEFAULT NULL,
  `emails` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dakoii_org`
--

INSERT INTO `dakoii_org` (`id`, `orgcode`, `name`, `description`, `loc_level_locked`, `loc_code_locked`, `loc_name_locked`, `orglogo`, `is_locationlocked`, `country_code`, `province_code`, `district_code`, `llg_code`, `country_name`, `province_name`, `district_name`, `llg_name`, `center_gps_zoom`, `center_gps_longitude`, `center_gps_latitude`, `address`, `phones`, `emails`, `is_active`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '3301', 'Central Provincial Works', 'This is Central Provincial Works', 'province', '03', 'Central Province', 'public/uploads/org_logo/3301_1763870780.png', 1, 'PNG', '03', '0301', 'PG030101', 'Papua New Guinea', 'Central Province', 'Abau', 'Abau Urban', NULL, NULL, NULL, '', '', '', 1, NULL, NULL, '2025-11-23 13:51:55', '2025-11-24 00:04:35');

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
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dakoii_users`
--

INSERT INTO `dakoii_users` (`id`, `name`, `username`, `password`, `orgcode`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Free Kenny', 'fkenny', '$2y$10$C6tiDBz7LUAR4IA60gUM1OJnqJlBqmSzS7v/FOMW7ZutjJNDHJAca', '', 'admin', 1, '2025-11-23 03:47:19', '2025-11-23 03:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `kmlfiles`
--

CREATE TABLE `kmlfiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `proucode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kmlfiles`
--

INSERT INTO `kmlfiles` (`id`, `proucode`, `name`, `filepath`, `create_at`, `create_by`, `status`, `orgcode`, `procode`) VALUES
(1, '692453b0f2a701763988400', NULL, 'public/uploads/gps_files/PG030201-3301-1_1763992542.kml', NULL, 'Cent Admin', NULL, '3301', 'PG030201-3301-1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(27, '2025-11-23-033912', 'App\\Database\\Migrations\\CreateAdminsTable', 'default', 'App', 1763869612, 1),
(28, '2025-11-23-033919', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1763869612, 1),
(29, '2025-11-23-033935', 'App\\Database\\Migrations\\CreateDakoiiUsersTable', 'default', 'App', 1763869632, 2),
(30, '2025-11-23-033942', 'App\\Database\\Migrations\\CreateDakoiiOrgTable', 'default', 'App', 1763869632, 2),
(31, '2025-11-23-033949', 'App\\Database\\Migrations\\CreateSettingsTable', 'default', 'App', 1763869633, 2),
(32, '2025-11-23-033956', 'App\\Database\\Migrations\\CreateCountryTable', 'default', 'App', 1763869633, 2),
(33, '2025-11-23-034002', 'App\\Database\\Migrations\\CreateProvinceTable', 'default', 'App', 1763869633, 2),
(34, '2025-11-23-034009', 'App\\Database\\Migrations\\CreateDistrictTable', 'default', 'App', 1763869633, 2),
(35, '2025-11-23-034015', 'App\\Database\\Migrations\\CreateLlgTable', 'default', 'App', 1763869633, 2),
(36, '2025-11-23-034023', 'App\\Database\\Migrations\\CreateWardTable', 'default', 'App', 1763869633, 2),
(37, '2025-11-23-034029', 'App\\Database\\Migrations\\CreateProjectsTable', 'default', 'App', 1763869633, 2),
(38, '2025-11-23-034037', 'App\\Database\\Migrations\\CreateProjectPhasesTable', 'default', 'App', 1763869633, 2),
(39, '2025-11-23-034044', 'App\\Database\\Migrations\\CreateProjectMilestonesTable', 'default', 'App', 1763869633, 2),
(40, '2025-11-23-034051', 'App\\Database\\Migrations\\CreateProjectEventsTable', 'default', 'App', 1763869633, 2),
(41, '2025-11-23-034058', 'App\\Database\\Migrations\\CreateProjectFilesTable', 'default', 'App', 1763869633, 2),
(42, '2025-11-23-034105', 'App\\Database\\Migrations\\CreateProjectEventfilesTable', 'default', 'App', 1763869633, 2),
(43, '2025-11-23-034112', 'App\\Database\\Migrations\\CreateProjectMilefilesTable', 'default', 'App', 1763869633, 2),
(44, '2025-11-23-034118', 'App\\Database\\Migrations\\CreateProjectOfficersTable', 'default', 'App', 1763869633, 2),
(45, '2025-11-23-034123', 'App\\Database\\Migrations\\CreateProfundTable', 'default', 'App', 1763869633, 2),
(46, '2025-11-23-034129', 'App\\Database\\Migrations\\CreateContractorDetailsTable', 'default', 'App', 1763869633, 2),
(47, '2025-11-23-034136', 'App\\Database\\Migrations\\CreateContractorFilesTable', 'default', 'App', 1763869633, 2),
(48, '2025-11-23-034145', 'App\\Database\\Migrations\\CreateContractorNoticesTable', 'default', 'App', 1763869633, 2),
(49, '2025-11-23-034152', 'App\\Database\\Migrations\\CreateRoadsTable', 'default', 'App', 1763869633, 2),
(50, '2025-11-23-034200', 'App\\Database\\Migrations\\CreateKmlfilesTable', 'default', 'App', 1763869633, 2),
(51, '2025-11-23-034208', 'App\\Database\\Migrations\\CreateBasefilesTable', 'default', 'App', 1763869633, 2),
(52, '2025-11-23-034217', 'App\\Database\\Migrations\\CreateSelectionTable', 'default', 'App', 1763869633, 2),
(53, '2025-11-24-000001', 'App\\Database\\Migrations\\CreateNotificationsTable', 'default', 'App', 1764022601, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `recipient_type` enum('all','specific') NOT NULL DEFAULT 'all',
  `recipient_po_id` int(11) DEFAULT NULL,
  `recipient_po_name` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `ucode`, `orgcode`, `title`, `message`, `recipient_type`, `recipient_po_id`, `recipient_po_name`, `status`, `is_read`, `priority`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(3, '6926671229ea81764124434', '3301', 'End of Year Report', 'You are required to provide end of year report', 'all', 0, NULL, 'active', 0, 'normal', 'Cent Admin', NULL, NULL, NULL),
(4, '69266747b9c0b1764124487', '3301', 'Report for Poject A001', 'Send me report', 'specific', 1, 'Pro One', 'active', 0, 'normal', 'Cent Admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profund`
--

CREATE TABLE `profund` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `paymentdate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `profund`
--

INSERT INTO `profund` (`id`, `ucode`, `procode`, `orgcode`, `amount`, `paymentdate`, `description`, `filepath`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '6924c7f45e42a1764018164', 'PG030201-3301-1', '3301', 5000.00, '2025-11-18', 'Mobilization Payment', 'public/uploads/payment_files/paydocs_PG030201-3301-1_1764018164.pdf', 'Pro One', NULL, NULL, NULL),
(2, '6926680e326941764124686', 'pm03PSIP2025-01', '3301', 50000.00, '2025-10-08', '1st Payment', 'public/uploads/payment_files/paydocs_pm03PSIP2025-01_1764124686.pdf', 'Cent Admin', NULL, NULL, NULL),
(3, '69266bf8510f31764125688', 'PG030201-3301-1', '3301', 2000.00, '2025-11-13', '', 'public/uploads/payment_files/paydocs_PG030201-3301-1_1764125688.pdf', 'Pro One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pro_date` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `llg` varchar(255) DEFAULT NULL,
  `pro_site` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pro_update_at` datetime DEFAULT NULL,
  `pro_update_by` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `statusnotes` text DEFAULT NULL,
  `status_at` datetime DEFAULT NULL,
  `status_by` varchar(255) DEFAULT NULL,
  `fund` varchar(255) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `budget_at` datetime DEFAULT NULL,
  `budget_by` varchar(255) DEFAULT NULL,
  `payment_total` decimal(15,2) DEFAULT NULL,
  `payment_at` datetime DEFAULT NULL,
  `payment_by` varchar(255) DEFAULT NULL,
  `mapping` varchar(255) DEFAULT NULL,
  `kmlfile` varchar(255) DEFAULT NULL,
  `gps` varchar(255) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `lon` varchar(100) DEFAULT NULL,
  `gps_at` datetime DEFAULT NULL,
  `gps_by` varchar(255) DEFAULT NULL,
  `pro_officer_id` int(11) DEFAULT NULL,
  `pro_officer_name` varchar(255) DEFAULT NULL,
  `pro_officer_scope` text DEFAULT NULL,
  `pro_officer_at` datetime DEFAULT NULL,
  `pro_officer_by` varchar(255) DEFAULT NULL,
  `contractor_id` int(11) DEFAULT NULL,
  `contractor_code` varchar(255) DEFAULT NULL,
  `contractor_name` varchar(255) DEFAULT NULL,
  `contract_file` varchar(255) DEFAULT NULL,
  `contractor_at` datetime DEFAULT NULL,
  `contractor_by` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `create_org` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `ucode`, `procode`, `orgcode`, `name`, `pro_date`, `country`, `province`, `district`, `llg`, `pro_site`, `description`, `pro_update_at`, `pro_update_by`, `status`, `statusnotes`, `status_at`, `status_by`, `fund`, `budget`, `budget_at`, `budget_by`, `payment_total`, `payment_at`, `payment_by`, `mapping`, `kmlfile`, `gps`, `lat`, `lon`, `gps_at`, `gps_by`, `pro_officer_id`, `pro_officer_name`, `pro_officer_scope`, `pro_officer_at`, `pro_officer_by`, `contractor_id`, `contractor_code`, `contractor_name`, `contract_file`, `contractor_at`, `contractor_by`, `create_by`, `create_org`, `update_by`, `create_at`, `update_at`) VALUES
(1, '692453b0f2a701763988400', 'PG030201-3301-1', '3301', 'Water Supply', '2025-11-24', 'PNG', '03', '0302', 'PG030201', NULL, 'This is PIP funding', '2025-11-24 22:46:40', 'Cent Admin', 'hold', 'Project is on hold', '2025-11-25 05:17:16', 'Cent Admin', 'Donor', 20005.45, '2025-11-24 23:13:50', 'Cent Admin', 7000.00, '2025-11-26 12:54:48', 'Pro One', NULL, 'public/uploads/gps_files/PG030201-3301-1_1763992542.kml', '-9.290771,146.995628', '-9.290771', '146.995628', '2025-11-24 23:55:42', 'Cent Admin', 1, 'Pro One', 'Officer assigned', '2025-11-25 06:16:22', 'Cent Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'Cent Admin', 'Central Provincial Works', 'Pro One', '2025-11-24 22:46:40', '2025-11-26 12:54:48'),
(2, '69263d5d45b2717641137570', 'pm03PSIP2025-01', '3301', 'Central Province Road Rehabilitation Project', NULL, '1', '03', '0301', NULL, NULL, 'Rehabilitation and upgrading of main roads connecting major towns in Central Province to improve accessibility and promote economic development.', NULL, NULL, 'active', NULL, NULL, NULL, 'PSIP', 250000.00, NULL, NULL, 50000.00, '2025-11-26 12:38:06', 'Cent Admin', NULL, NULL, '-8.821772,146.525068', '-8.821772', '146.525068', '2025-11-26 12:40:20', 'Cent Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Seeder', NULL, 'Cent Admin', '2025-11-26 09:35:57', '2025-11-26 12:40:20'),
(3, '69263d5d4a02c17641137571', 'pm03DSIP2025-02', '3301', 'Goilala District Water Supply Infrastructure', NULL, '1', '03', '0302', NULL, NULL, 'Construction of water supply systems and installation of water tanks in rural communities to provide clean and safe drinking water.', NULL, NULL, 'active', NULL, NULL, NULL, 'DSIP', 180000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Seeder', NULL, NULL, '2025-11-26 09:35:57', '2025-11-26 09:35:57'),
(4, '69263d5d4a6f417641137572', 'pm03PRAP2025-03', '3301', 'Kairuku-Hiri Health Facility Upgrade', NULL, '1', '03', '0303', NULL, NULL, 'Renovation and expansion of health centers including equipment procurement to improve healthcare services delivery in the district.', NULL, NULL, 'active', NULL, NULL, NULL, 'PRAP', 320000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Seeder', NULL, NULL, '2025-11-26 09:35:57', '2025-11-26 09:35:57'),
(5, '69263d5d4abb117641137573', 'pm03PSIP2025-04', '3301', 'Rigo District Education Infrastructure Development', NULL, '1', '03', '0304', NULL, NULL, 'Construction of new classrooms and teacher housing facilities to support quality education delivery in rural schools.', NULL, NULL, 'active', NULL, NULL, NULL, 'PSIP', 275000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Seeder', NULL, NULL, '2025-11-26 09:35:57', '2025-11-26 09:35:57'),
(6, '69263d5d4b72f17641137574', 'pm03GoPNG2025-05', '3301', 'Central Province Bridge Construction Project', NULL, '1', '03', '0301', NULL, NULL, 'Construction of concrete bridges to replace aging timber bridges and improve transportation connectivity across rivers.', NULL, NULL, 'active', NULL, NULL, NULL, 'GoPNG', 450000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'System Seeder', NULL, NULL, '2025-11-26 09:35:57', '2025-11-26 09:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `project_eventfiles`
--

CREATE TABLE `project_eventfiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_eventfiles`
--

INSERT INTO `project_eventfiles` (`id`, `ucode`, `procode`, `orgcode`, `filepath`, `event_id`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '6924cc4d27b8a1764019277', 'PG030201-3301-1', '3301', 'public/uploads/event_files/ev_PG030201-3301-1_1764019277-1.jpg', 1, 'Pro One', NULL, NULL, NULL),
(2, '6924cc4d292f61764019277', 'PG030201-3301-1', '3301', 'public/uploads/event_files/ev_PG030201-3301-1_1764019277-2.jpg', 1, 'Pro One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_events`
--

CREATE TABLE `project_events` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `event` text DEFAULT NULL,
  `eventdate` date DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_events`
--

INSERT INTO `project_events` (`id`, `ucode`, `procode`, `orgcode`, `event`, `eventdate`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '6924cc4d1a82e1764019277', 'PG030201-3301-1', '3301', 'Fighting over land', '2025-11-18', 'Pro One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `ucode`, `procode`, `orgcode`, `name`, `filepath`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '6924c730e69d81764017968', 'PG030201-3301-1', '3301', 'Feasibility Study', 'public/uploads/prodocs_files/prodocs_PG030201-3301-1_1764017968.pdf', 'Pro One', NULL, NULL, NULL),
(2, '6924c85e4b51b1764018270', 'PG030201-3301-1', '3301', 'Foundation Report', 'public/uploads/prodocs_files/prodocs_PG030201-3301-1_1764018270.pdf', 'Pro One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_milefiles`
--

CREATE TABLE `project_milefiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `milestones_id` int(11) DEFAULT NULL,
  `milestones_ucode` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_milefiles`
--

INSERT INTO `project_milefiles` (`id`, `ucode`, `procode`, `orgcode`, `milestones_id`, `milestones_ucode`, `filepath`, `caption`, `phase_id`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(5, '6924c6d5030161764017877', 'PG030201-3301-1', '3301', 1, NULL, 'public/uploads/milestone_files/mf_PG030201-3301-1_1764017877.jpg', NULL, 1, 'Pro One', NULL, NULL, NULL),
(10, '6924ca330bc281764018739', 'PG030201-3301-1', '3301', 1, NULL, 'public/uploads/milestone_files/mf_PG030201-3301-1_1764018739_1.jpg', NULL, 1, 'Pro One', NULL, NULL, NULL),
(12, '69266b84b930c1764125572', 'PG030201-3301-1', '3301', 1, NULL, 'public/uploads/milestone_files/mf_PG030201-3301-1_1764125572_1.png', NULL, 1, 'Pro One', NULL, NULL, NULL),
(13, '69266b84c49a41764125572', 'PG030201-3301-1', '3301', 1, NULL, 'public/uploads/milestone_files/mf_PG030201-3301-1_1764125572_2.png', NULL, 1, 'Pro One', NULL, NULL, NULL),
(14, '69266b84c697c1764125572', 'PG030201-3301-1', '3301', 1, NULL, 'public/uploads/milestone_files/mf_PG030201-3301-1_1764125572_3.png', NULL, 1, 'Pro One', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_milestones`
--

CREATE TABLE `project_milestones` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `milestones` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  `checked_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_milestones`
--

INSERT INTO `project_milestones` (`id`, `ucode`, `procode`, `orgcode`, `milestones`, `status`, `checked`, `checked_date`, `notes`, `datefrom`, `dateto`, `phase_id`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '69245fd4c4bba1763991508', 'PG030201-3301-1', '3301', 'Water Sources', 'canceled', 0, '2025-11-25', 'The Milestone is completed', '2025-10-28', '2025-11-06', 1, 'Cent Admin', 'Pro One', NULL, NULL),
(2, '69263e2d484f11764113965181', 'pm03PSIP2025-01', '3301', 'Site Assessment and Survey', 'pending', 0, NULL, '', '2025-01-15', '2025-02-15', 2, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(3, '69263e2d48ce41764113965631', 'pm03PSIP2025-01', '3301', 'Engineering Design Completion', 'pending', 0, NULL, '', '2025-02-16', '2025-03-30', 2, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(4, '69263e2d495231764113965838', 'pm03PSIP2025-01', '3301', 'Budget and Cost Estimation', 'pending', 0, NULL, '', '2025-03-01', '2025-03-20', 2, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(5, '69263e2d49c761764113965613', 'pm03PSIP2025-01', '3301', 'Contractor Selection', 'pending', 0, NULL, '', '2025-04-01', '2025-04-30', 3, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(6, '69263e2d4a5031764113965882', 'pm03PSIP2025-01', '3301', 'Contract Signing', 'pending', 0, NULL, '', '2025-05-01', '2025-05-15', 3, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(7, '69263e2d4bd051764113965796', 'pm03PSIP2025-01', '3301', 'Site Mobilization', 'pending', 0, NULL, '', '2025-05-16', '2025-06-15', 3, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(8, '69263e2d4c6c01764113965136', 'pm03PSIP2025-01', '3301', 'Foundation Works', 'pending', 0, NULL, '', '2025-06-16', '2025-08-30', 4, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(9, '69263e2d4d03f1764113965582', 'pm03PSIP2025-01', '3301', 'Main Construction Works', 'pending', 0, NULL, '', '2025-09-01', '2025-12-31', 4, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(10, '69263e2d4dbfd1764113965917', 'pm03PSIP2025-01', '3301', 'Finishing and Quality Check', 'pending', 0, NULL, '', '2026-01-01', '2026-02-28', 4, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(11, '69263e2d4e3401764113965523', 'pm03PSIP2025-01', '3301', 'Project Handover', 'pending', 0, NULL, '', '2026-03-01', '2026-03-15', 5, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(12, '69263e2d4ede71764113965823', 'pm03PSIP2025-01', '3301', 'Final Evaluation Report', 'pending', 0, NULL, '', '2026-03-16', '2026-03-31', 5, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(13, '69263e2d501b71764113965367', 'pm03PSIP2025-01', '3301', 'Project Closure', 'pending', 0, NULL, '', '2026-04-01', '2026-04-15', 5, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(14, '69263e2d53bbe1764113965385', 'pm03DSIP2025-02', '3301', 'Site Assessment and Survey', 'pending', 0, NULL, '', '2025-01-15', '2025-02-15', 6, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(15, '69263e2d547d31764113965947', 'pm03DSIP2025-02', '3301', 'Engineering Design Completion', 'pending', 0, NULL, '', '2025-02-16', '2025-03-30', 6, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(16, '69263e2d54f471764113965573', 'pm03DSIP2025-02', '3301', 'Budget and Cost Estimation', 'pending', 0, NULL, '', '2025-03-01', '2025-03-20', 6, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(17, '69263e2d555ea1764113965349', 'pm03DSIP2025-02', '3301', 'Contractor Selection', 'pending', 0, NULL, '', '2025-04-01', '2025-04-30', 7, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(18, '69263e2d55b521764113965122', 'pm03DSIP2025-02', '3301', 'Contract Signing', 'pending', 0, NULL, '', '2025-05-01', '2025-05-15', 7, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(19, '69263e2d563301764113965537', 'pm03DSIP2025-02', '3301', 'Site Mobilization', 'pending', 0, NULL, '', '2025-05-16', '2025-06-15', 7, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(20, '69263e2d568af1764113965733', 'pm03DSIP2025-02', '3301', 'Foundation Works', 'pending', 0, NULL, '', '2025-06-16', '2025-08-30', 8, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(21, '69263e2d57cfe1764113965994', 'pm03DSIP2025-02', '3301', 'Main Construction Works', 'pending', 0, NULL, '', '2025-09-01', '2025-12-31', 8, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(22, '69263e2d583d31764113965536', 'pm03DSIP2025-02', '3301', 'Finishing and Quality Check', 'pending', 0, NULL, '', '2026-01-01', '2026-02-28', 8, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(23, '69263e2d5896f1764113965631', 'pm03DSIP2025-02', '3301', 'Project Handover', 'pending', 0, NULL, '', '2026-03-01', '2026-03-15', 9, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(24, '69263e2d58e721764113965311', 'pm03DSIP2025-02', '3301', 'Final Evaluation Report', 'pending', 0, NULL, '', '2026-03-16', '2026-03-31', 9, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(25, '69263e2d594641764113965385', 'pm03DSIP2025-02', '3301', 'Project Closure', 'pending', 0, NULL, '', '2026-04-01', '2026-04-15', 9, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(26, '69263e2d5c4e11764113965397', 'pm03PRAP2025-03', '3301', 'Site Assessment and Survey', 'pending', 0, NULL, '', '2025-01-15', '2025-02-15', 10, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(27, '69263e2d5cb981764113965257', 'pm03PRAP2025-03', '3301', 'Engineering Design Completion', 'pending', 0, NULL, '', '2025-02-16', '2025-03-30', 10, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(28, '69263e2d5d2ee1764113965334', 'pm03PRAP2025-03', '3301', 'Budget and Cost Estimation', 'pending', 0, NULL, '', '2025-03-01', '2025-03-20', 10, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(29, '69263e2d5d99a1764113965170', 'pm03PRAP2025-03', '3301', 'Contractor Selection', 'pending', 0, NULL, '', '2025-04-01', '2025-04-30', 11, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(30, '69263e2d5dedf1764113965440', 'pm03PRAP2025-03', '3301', 'Contract Signing', 'pending', 0, NULL, '', '2025-05-01', '2025-05-15', 11, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(31, '69263e2d5e39b1764113965513', 'pm03PRAP2025-03', '3301', 'Site Mobilization', 'pending', 0, NULL, '', '2025-05-16', '2025-06-15', 11, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(32, '69263e2d5eb081764113965581', 'pm03PRAP2025-03', '3301', 'Foundation Works', 'pending', 0, NULL, '', '2025-06-16', '2025-08-30', 12, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(33, '69263e2d602131764113965465', 'pm03PRAP2025-03', '3301', 'Main Construction Works', 'pending', 0, NULL, '', '2025-09-01', '2025-12-31', 12, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(34, '69263e2d6094a1764113965452', 'pm03PRAP2025-03', '3301', 'Finishing and Quality Check', 'pending', 0, NULL, '', '2026-01-01', '2026-02-28', 12, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(35, '69263e2d60ee41764113965535', 'pm03PRAP2025-03', '3301', 'Project Handover', 'pending', 0, NULL, '', '2026-03-01', '2026-03-15', 13, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(36, '69263e2d615c41764113965801', 'pm03PRAP2025-03', '3301', 'Final Evaluation Report', 'pending', 0, NULL, '', '2026-03-16', '2026-03-31', 13, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(37, '69263e2d61bbd1764113965285', 'pm03PRAP2025-03', '3301', 'Project Closure', 'pending', 0, NULL, '', '2026-04-01', '2026-04-15', 13, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(38, '69263e2d654291764113965287', 'pm03PSIP2025-04', '3301', 'Site Assessment and Survey', 'pending', 0, NULL, '', '2025-01-15', '2025-02-15', 14, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(39, '69263e2d65c611764113965539', 'pm03PSIP2025-04', '3301', 'Engineering Design Completion', 'pending', 0, NULL, '', '2025-02-16', '2025-03-30', 14, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(40, '69263e2d665021764113965589', 'pm03PSIP2025-04', '3301', 'Budget and Cost Estimation', 'pending', 0, NULL, '', '2025-03-01', '2025-03-20', 14, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(41, '69263e2d66bbf1764113965431', 'pm03PSIP2025-04', '3301', 'Contractor Selection', 'pending', 0, NULL, '', '2025-04-01', '2025-04-30', 15, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(42, '69263e2d67eb91764113965834', 'pm03PSIP2025-04', '3301', 'Contract Signing', 'pending', 0, NULL, '', '2025-05-01', '2025-05-15', 15, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(43, '69263e2d6895f1764113965354', 'pm03PSIP2025-04', '3301', 'Site Mobilization', 'pending', 0, NULL, '', '2025-05-16', '2025-06-15', 15, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(44, '69263e2d690451764113965639', 'pm03PSIP2025-04', '3301', 'Foundation Works', 'pending', 0, NULL, '', '2025-06-16', '2025-08-30', 16, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(45, '69263e2d696801764113965732', 'pm03PSIP2025-04', '3301', 'Main Construction Works', 'pending', 0, NULL, '', '2025-09-01', '2025-12-31', 16, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(46, '69263e2d69c5c1764113965361', 'pm03PSIP2025-04', '3301', 'Finishing and Quality Check', 'pending', 0, NULL, '', '2026-01-01', '2026-02-28', 16, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(47, '69263e2d6a18f1764113965667', 'pm03PSIP2025-04', '3301', 'Project Handover', 'pending', 0, NULL, '', '2026-03-01', '2026-03-15', 17, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(48, '69263e2d6a6401764113965769', 'pm03PSIP2025-04', '3301', 'Final Evaluation Report', 'pending', 0, NULL, '', '2026-03-16', '2026-03-31', 17, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(49, '69263e2d6accc1764113965893', 'pm03PSIP2025-04', '3301', 'Project Closure', 'pending', 0, NULL, '', '2026-04-01', '2026-04-15', 17, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(50, '69263e2d6de011764113965141', 'pm03GoPNG2025-05', '3301', 'Site Assessment and Survey', 'pending', 0, NULL, '', '2025-01-15', '2025-02-15', 18, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(51, '69263e2d6e4491764113965118', 'pm03GoPNG2025-05', '3301', 'Engineering Design Completion', 'pending', 0, NULL, '', '2025-02-16', '2025-03-30', 18, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(52, '69263e2d6eaa01764113965563', 'pm03GoPNG2025-05', '3301', 'Budget and Cost Estimation', 'pending', 0, NULL, '', '2025-03-01', '2025-03-20', 18, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(53, '69263e2d6f7291764113965788', 'pm03GoPNG2025-05', '3301', 'Contractor Selection', 'pending', 0, NULL, '', '2025-04-01', '2025-04-30', 19, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(54, '69263e2d70c081764113965164', 'pm03GoPNG2025-05', '3301', 'Contract Signing', 'pending', 0, NULL, '', '2025-05-01', '2025-05-15', 19, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(55, '69263e2d712061764113965254', 'pm03GoPNG2025-05', '3301', 'Site Mobilization', 'pending', 0, NULL, '', '2025-05-16', '2025-06-15', 19, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(56, '69263e2d7182e1764113965772', 'pm03GoPNG2025-05', '3301', 'Foundation Works', 'pending', 0, NULL, '', '2025-06-16', '2025-08-30', 20, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(57, '69263e2d71e5c1764113965954', 'pm03GoPNG2025-05', '3301', 'Main Construction Works', 'pending', 0, NULL, '', '2025-09-01', '2025-12-31', 20, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(58, '69263e2d722da1764113965351', 'pm03GoPNG2025-05', '3301', 'Finishing and Quality Check', 'pending', 0, NULL, '', '2026-01-01', '2026-02-28', 20, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(59, '69263e2d727651764113965398', 'pm03GoPNG2025-05', '3301', 'Project Handover', 'pending', 0, NULL, '', '2026-03-01', '2026-03-15', 21, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(60, '69263e2d72cb51764113965368', 'pm03GoPNG2025-05', '3301', 'Final Evaluation Report', 'pending', 0, NULL, '', '2026-03-16', '2026-03-31', 21, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(61, '69263e2d7338b1764113965915', 'pm03GoPNG2025-05', '3301', 'Project Closure', 'pending', 0, NULL, '', '2026-04-01', '2026-04-15', 21, 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(62, '692667bff1ea11764124607', 'pm03PSIP2025-01', '3301', 'Certifcation of Completion', 'pending', 0, NULL, NULL, '0000-00-00', '0000-00-00', 22, 'Cent Admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_officers`
--

CREATE TABLE `project_officers` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `pocode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_officers`
--

INSERT INTO `project_officers` (`id`, `ucode`, `pocode`, `orgcode`, `name`, `username`, `password`, `status`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '6924bca508fd71764015269', '1001', '3301', 'Pro One', 'One', '$2y$10$qEcsr76hKUzD9LntAXelbOD.6Q/7iXb0IeafIchtOZpG7XzZs0mFO', 'active', 'Cent Admin', 'Cent Admin', NULL, NULL),
(2, '6924da0fba3561764022799', '1002', '3301', 'Pro Two', 'two', '$2y$10$riEbqkiq93jIlQRZj.7zjeTs3pct.IW7nseG/4pvEZ3it3TVvzToq', 'deactive', 'Cent Admin', 'Cent Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_phases`
--

CREATE TABLE `project_phases` (
  `id` int(11) UNSIGNED NOT NULL,
  `ucode` varchar(255) DEFAULT NULL,
  `procode` varchar(255) DEFAULT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `phases` varchar(255) DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_phases`
--

INSERT INTO `project_phases` (`id`, `ucode`, `procode`, `orgcode`, `phases`, `create_by`, `update_by`, `create_at`, `update_at`) VALUES
(1, '69245e74823371763991156', 'PG030201-3301-1', '3301', 'Cooking', 'Cent Admin', NULL, NULL, NULL),
(2, '69263e2d43c861764113965134', 'pm03PSIP2025-01', '3301', 'Planning and Design Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(3, '69263e2d453da1764113965192', 'pm03PSIP2025-01', '3301', 'Procurement and Mobilization Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(4, '69263e2d45c6a1764113965101', 'pm03PSIP2025-01', '3301', 'Implementation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(5, '69263e2d47a5b1764113965616', 'pm03PSIP2025-01', '3301', 'Monitoring and Evaluation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(6, '69263e2d50ca41764113965519', 'pm03DSIP2025-02', '3301', 'Planning and Design Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(7, '69263e2d513d31764113965446', 'pm03DSIP2025-02', '3301', 'Procurement and Mobilization Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(8, '69263e2d51c261764113965733', 'pm03DSIP2025-02', '3301', 'Implementation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(9, '69263e2d5251a1764113965246', 'pm03DSIP2025-02', '3301', 'Monitoring and Evaluation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(10, '69263e2d59bda1764113965233', 'pm03PRAP2025-03', '3301', 'Planning and Design Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(11, '69263e2d5a0df1764113965485', 'pm03PRAP2025-03', '3301', 'Procurement and Mobilization Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(12, '69263e2d5a6941764113965622', 'pm03PRAP2025-03', '3301', 'Implementation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(13, '69263e2d5b4211764113965822', 'pm03PRAP2025-03', '3301', 'Monitoring and Evaluation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(14, '69263e2d622f01764113965609', 'pm03PSIP2025-04', '3301', 'Planning and Design Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(15, '69263e2d62e9a1764113965785', 'pm03PSIP2025-04', '3301', 'Procurement and Mobilization Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(16, '69263e2d6438a1764113965536', 'pm03PSIP2025-04', '3301', 'Implementation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(17, '69263e2d64d541764113965165', 'pm03PSIP2025-04', '3301', 'Monitoring and Evaluation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(18, '69263e2d6c4991764113965271', 'pm03GoPNG2025-05', '3301', 'Planning and Design Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(19, '69263e2d6cc7b1764113965523', 'pm03GoPNG2025-05', '3301', 'Procurement and Mobilization Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(20, '69263e2d6d2921764113965557', 'pm03GoPNG2025-05', '3301', 'Implementation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(21, '69263e2d6d88d1764113965583', 'pm03GoPNG2025-05', '3301', 'Monitoring and Evaluation Phase', 'System Seeder', NULL, '2025-11-26 09:39:25', '2025-11-26 09:39:25'),
(22, '692667a5051bf1764124581', 'pm03PSIP2025-01', '3301', 'Conclusion', 'Cent Admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roads`
--

CREATE TABLE `roads` (
  `id` int(11) UNSIGNED NOT NULL,
  `roaducode` varchar(255) DEFAULT NULL,
  `roadcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `length` varchar(100) DEFAULT NULL,
  `llg` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `num_lanes` int(11) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `surface_type` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `selection`
--

CREATE TABLE `selection` (
  `id` int(11) UNSIGNED NOT NULL,
  `box` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `orgcode` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `orgcode`, `name`, `username`, `password`, `role`, `is_active`, `create_at`, `update_at`) VALUES
(1, '3301', 'Cent Admin', 'central', '$2y$10$Ov3BhFuNGgXCyBFuAwo/mOrw.molMrBYuMpDEmGQqyTXnpekN0fki', 'admin', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `basefiles`
--
ALTER TABLE `basefiles`
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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orgcode` (`orgcode`),
  ADD KEY `recipient_po_id` (`recipient_po_id`),
  ADD KEY `status` (`status`);

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
-- Indexes for table `roads`
--
ALTER TABLE `roads`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adx_country`
--
ALTER TABLE `adx_country`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adx_district`
--
ALTER TABLE `adx_district`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adx_llg`
--
ALTER TABLE `adx_llg`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `adx_province`
--
ALTER TABLE `adx_province`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `adx_ward`
--
ALTER TABLE `adx_ward`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basefiles`
--
ALTER TABLE `basefiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractor_details`
--
ALTER TABLE `contractor_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contractor_files`
--
ALTER TABLE `contractor_files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contractor_notices`
--
ALTER TABLE `contractor_notices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dakoii_org`
--
ALTER TABLE `dakoii_org`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dakoii_users`
--
ALTER TABLE `dakoii_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profund`
--
ALTER TABLE `profund`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_eventfiles`
--
ALTER TABLE `project_eventfiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_events`
--
ALTER TABLE `project_events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_milefiles`
--
ALTER TABLE `project_milefiles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project_milestones`
--
ALTER TABLE `project_milestones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `project_officers`
--
ALTER TABLE `project_officers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_phases`
--
ALTER TABLE `project_phases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roads`
--
ALTER TABLE `roads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `selection`
--
ALTER TABLE `selection`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
