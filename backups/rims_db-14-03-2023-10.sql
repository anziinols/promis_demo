-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 06:57 PM
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
-- Database: `rims_db`
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
(105, '20', 'A.R Bougainville', 1);

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
-- Table structure for table `basefiles`
--

CREATE TABLE `basefiles` (
  `id` int(11) NOT NULL,
  `kmlucode` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `road_id` int(11) NOT NULL,
  `road_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basefiles`
--

INSERT INTO `basefiles` (`id`, `kmlucode`, `name`, `filepath`, `create_at`, `create_by`, `status`, `road_id`, `road_code`) VALUES
(1, '', '', 'uploads/base_files/1678595243_0f71c14e7d78c80b98fd.kml', '2023-03-12 14:27:23', '', '', 0, ''),
(2, '', '', 'uploads/base_files/_php85D3.tmp', '2023-03-12 14:40:24', '', '', 0, ''),
(3, '', '', 'uploads/base_files/DR1404-11678596214.kml', '2023-03-12 14:43:34', '', '', 0, ''),
(4, '', '', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678660891.kml', '2023-03-13 08:41:32', '', '', 27, 'DR1404-1'),
(5, '', 'DR1404-1_1678661565.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678661565.kml', '2023-03-13 08:52:45', '', '', 27, 'DR1404-1'),
(6, '', 'DR1404-1_1678661607.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678661607.kml', '2023-03-13 08:53:27', '', '', 27, 'DR1404-1'),
(7, '', 'DR1404-1_1678666142.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678666142.kml', '2023-03-13 10:09:02', '', '', 27, 'DR1404-1'),
(8, '', 'DR1404-1_1678672260.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678672260.kml', '2023-03-13 11:51:00', '', '', 27, 'DR1404-1'),
(9, '', 'DR1404-1_1678672339.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678672339.kml', '2023-03-13 11:52:19', '', '', 27, 'DR1404-1'),
(10, '', 'DR1404-1_1678694217.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678694217.kml', '2023-03-13 17:56:57', '', '', 27, 'DR1404-1'),
(11, '', 'DR1404-1_1678694283.kml', 'http://localhost/rims/public/uploads/base_files/DR1404-1_1678694283.kml', '2023-03-13 17:58:03', '', '', 27, 'DR1404-1');

-- --------------------------------------------------------

--
-- Table structure for table `kmlfiles`
--

CREATE TABLE `kmlfiles` (
  `id` int(11) NOT NULL,
  `kmlucode` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `road_id` int(11) NOT NULL,
  `road_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roads`
--

CREATE TABLE `roads` (
  `id` int(11) NOT NULL,
  `roaducode` varchar(255) NOT NULL,
  `roadcode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `length` float NOT NULL,
  `llg` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `num_lanes` int(11) NOT NULL,
  `class` varchar(200) NOT NULL,
  `surface_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roads`
--

INSERT INTO `roads` (`id`, `roaducode`, `roadcode`, `name`, `description`, `country`, `province`, `district`, `length`, `llg`, `ward`, `num_lanes`, `class`, `surface_type`, `created_at`, `updated_at`) VALUES
(5, 'RC-005', 'P2', 'Provincial Road 2', 'Connects provincial capital to tourist spots', 'Philippines', 'Palawan', 'Puerto Princesa', 60.8, 'Aborlan', 'Quezon Road', 2, 'ProvinceRoad', 'Concrete', '2023-03-10 04:32:55', '2023-03-10 04:32:55'),
(6, 'RC-006', 'D2', 'District Road 2', 'Connects remote areas to the nearest district center', 'South Africa', 'Gauteng', 'Johannesburg', 38.2, 'Mogale City', 'Krugersdorp', 1, 'DistrictRoad', 'Gravel', '2023-03-10 04:32:55', '2023-03-10 04:32:55'),
(7, 'RC-007', 'N3', 'National Highway 3', 'Links major cities in the country', 'China', 'Beijing', 'Beijing', 450.5, 'Chaoyang', 'Jingtong Expressway', 8, 'NationalRoad', 'Asphalt', '2023-03-10 04:32:55', '2023-03-10 04:32:55'),
(12, '640cee6a2b2d31678569066', '-1', 'Wewak Kulablia', 'Adfsdf', '', '', '', 3.453, '', '', 3, '', '', '2023-03-11 11:11:06', '2023-03-11 11:11:06'),
(13, '640cf03d50a201678569533', '-1', 'Wewak Kulablia', '', '', '', '', 4243, '', '', 25454, '', '', '2023-03-11 11:18:53', '2023-03-11 11:18:53'),
(14, '640cf18b383201678569867', '-1', 'Wewak Kulablia', '', '1', '90', '21', 456, '', '', 23, '', '', '2023-03-11 11:24:27', '2023-03-11 11:24:27'),
(15, '640cf23380d2e1678570035', '-1', 'Wewak Kulablia', '', 'PG', '90', '19', 12, '', '', 4, '', '', '2023-03-11 11:27:15', '2023-03-11 11:27:15'),
(16, '640cf81181a281678571537', '-1', 'Wewak Kulablia', '', 'PG', '03', '', 0, '', '', 0, '', '', '2023-03-11 11:52:17', '2023-03-11 11:52:17'),
(17, '640cf8f472e5e1678571764', '-1', 'Wewak Kulablia', '', 'PG', '14', '1401', 0, '', '', 0, 'DR', '', '2023-03-11 11:56:04', '2023-03-11 11:56:04'),
(18, '640cff37b25641678573367', '-1', 'Wewak Kulablia', 'This is the Kubalia Wewak Road', 'PG', '14', '1404', 0.2, '', '', 2, 'NR', '', '2023-03-11 12:22:47', '2023-03-11 12:22:47'),
(19, '640d00a9532f61678573737', 'DR141401-1', 'Wewak Kulablia', 'Kubex Road', 'PG', '14', '1401', 23, '', '', 3, 'DR', '', '2023-03-11 12:28:57', '2023-03-11 12:28:57'),
(20, '640d011b17fe31678573851', 'NR14-1', 'Wewak Kulablia', 'Kubexia', 'PG', '14', '1404', 2.4, '', '', 2, 'NR', '', '2023-03-11 12:30:51', '2023-03-11 12:30:51'),
(21, '640d0b658644f1678576485', '', 'Wewak Turubu', '', 'PG', '14', '', 34, '', '', 3, 'NR', '', '2023-03-11 13:14:45', '2023-03-11 13:14:45'),
(22, '640d0b70e82241678576496', '', 'Wewak Turubu', '', 'PG', '14', '', 34, '', '', 3, 'NR', '', '2023-03-11 13:14:56', '2023-03-11 13:14:56'),
(23, '640d0bb1300151678576561', '', 'Wewak Turubu', '', 'PG', '14', '', 34, '', '', 3, 'NR', '', '2023-03-11 13:16:01', '2023-03-11 13:16:01'),
(24, '640d0bc9eef1a1678576585', 'NR14-2', 'Wewak Turubu', '', 'PG', '14', '', 34, '', '', 3, 'NR', '', '2023-03-11 13:16:25', '2023-03-11 13:16:25'),
(25, '640d0c0e028261678576654', 'NR14-3', 'Wewak Turubu', '', 'PG', '14', '', 34, '', '', 3, 'NR', '', '2023-03-11 13:17:34', '2023-03-11 13:17:34'),
(26, '640d0c2fe5f3d1678576687', 'NR14-4', 'Wewak Turubu', '', 'PG', '14', '', 5, '', '', 4, 'NR', '', '2023-03-11 13:18:07', '2023-03-11 13:18:07'),
(27, '640d0c64664151678576740', 'DR1404-1', 'Turubu Mandi', 'Trurubs to Mandi', 'PG', '14', '1404', 4, '', '', 2, 'DR', '', '2023-03-11 13:19:00', '2023-03-11 13:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `selection`
--

CREATE TABLE `selection` (
  `id` int(11) NOT NULL,
  `box` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `item` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `selection`
--

INSERT INTO `selection` (`id`, `box`, `value`, `item`) VALUES
(1, 'roadclass', 'NR', 'National Road'),
(2, 'roadclass', 'PR', 'Provincial Road'),
(3, 'roadclass', 'DR', 'District Road');

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
-- Indexes for table `basefiles`
--
ALTER TABLE `basefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `basefiles`
--
ALTER TABLE `basefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kmlfiles`
--
ALTER TABLE `kmlfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roads`
--
ALTER TABLE `roads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `selection`
--
ALTER TABLE `selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
