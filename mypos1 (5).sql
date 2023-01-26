-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 02:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypos1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(1, 'Arya', 'L', '097645895785', 'Aceh', '2023-01-09 09:08:23', '2023-01-23 04:32:49'),
(2, 'Siti', 'P', '06752342689', 'Cibinong', '2023-01-09 09:11:51', NULL),
(4, 'Lisa', 'P', '06752342689', 'Cibinong', '2023-01-22 20:03:37', NULL),
(5, 'Susanti', 'P', '06752342689', 'Cibinong', '2023-01-22 20:05:18', NULL),
(6, ' Puspa', 'P', '06752342689', 'Bogor', '2023-01-22 20:07:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `nama_alat_ukur` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `nama_alat_ukur`, `description`) VALUES
(0, 'Timbangan/neraca (1)', 'Timbangan untuk mempermudah penjualan');

-- --------------------------------------------------------

--
-- Table structure for table `kalibrasi`
--

CREATE TABLE `kalibrasi` (
  `durasi_kalibrasi` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `lembaga_kalibrasi` varchar(200) NOT NULL,
  `no_sertifikat` varchar(200) NOT NULL,
  `file_sertifikat` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_kalibrasi` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kalibrasi`
--

INSERT INTO `kalibrasi` (`durasi_kalibrasi`, `item_id`, `lembaga_kalibrasi`, `no_sertifikat`, `file_sertifikat`, `keterangan`, `tanggal_kalibrasi`) VALUES
(5, 1, 'external', '2023-02-04', '', '', '2023-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `p_category`
--

CREATE TABLE `p_category` (
  `category_id` int(11) NOT NULL,
  `jenisalat` varchar(100) NOT NULL,
  `fungsi` varchar(255) DEFAULT NULL,
  `range` varchar(100) DEFAULT NULL,
  `akurasi` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_category`
--

INSERT INTO `p_category` (`category_id`, `jenisalat`, `fungsi`, `range`, `akurasi`, `created`, `updated`) VALUES
(8, 'Rubber Hardness Tester', NULL, NULL, NULL, '2023-01-09 14:22:08', '2023-01-17 02:28:35'),
(9, 'Timbangan/Neraca', NULL, NULL, NULL, '2023-01-10 09:45:03', NULL),
(10, 'Profile projector', NULL, NULL, NULL, '2023-01-10 13:36:25', NULL),
(11, 'Magnetic Stand Indicator', NULL, NULL, NULL, '2023-01-10 13:36:50', '2023-01-19 04:27:47'),
(12, 'Dial Indicator', NULL, NULL, NULL, '2023-01-10 13:37:53', '2023-01-19 04:28:02'),
(13, 'Outside Micrometer', NULL, NULL, NULL, '2023-01-10 13:38:29', '2023-01-19 04:28:21'),
(14, 'Torque Wrench', NULL, NULL, NULL, '2023-01-10 13:39:25', '2023-01-19 04:29:04'),
(17, 'Digimatic Caliper ', NULL, NULL, NULL, '2023-01-11 11:22:28', '2023-01-18 09:00:51'),
(18, 'Thickness Gage ', NULL, NULL, NULL, '2023-01-11 11:33:54', NULL),
(20, 'Anak Batu Timbangan', NULL, NULL, NULL, '2023-01-18 15:05:02', NULL),
(21, 'Temperatur Humidity ', NULL, NULL, NULL, '2023-01-18 15:17:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_item`
--

CREATE TABLE `p_item` (
  `item_id` int(11) NOT NULL,
  `no_seri` varchar(100) DEFAULT NULL,
  `nama_alat_ukur` varchar(100) DEFAULT NULL,
  `merk` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pemilik_id` int(255) NOT NULL,
  `durasi_kalibrasi` enum('1x/1y','1x/2y') NOT NULL COMMENT '	',
  `pertama_kalibrasi` varchar(255) NOT NULL,
  `next_kalibrasi` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`item_id`, `no_seri`, `nama_alat_ukur`, `merk`, `category_id`, `pemilik_id`, `durasi_kalibrasi`, `pertama_kalibrasi`, `next_kalibrasi`, `image`, `created`, `updated`) VALUES
(54, '422221', 'Timbangan / Neraca ( 12 )', 'mitutoyo', 9, 10, '', '2022-02-12', '2023-01-24', 'item-230123-79fe4ca943.jpg', '2023-01-23 15:15:49', '2023-01-25 07:24:43'),
(55, '319931 H', 'Toque Wrench', 'TOHNICHI', 14, 12, '1x/1y', '2023-01-25', '2023-01-25', 'item-230125-79be654a22.jpg', '2023-01-25 09:48:01', '2023-01-25 07:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `p_pemilik`
--

CREATE TABLE `p_pemilik` (
  `pemilik_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_pemilik`
--

INSERT INTO `p_pemilik` (`pemilik_id`, `name`, `created`, `updated`) VALUES
(10, 'QC', '2023-01-10 21:42:12', '2023-01-18 09:30:56'),
(12, 'Gudang', '2023-01-11 08:49:17', '2023-01-18 09:31:09'),
(13, 'WIP Atas', '2023-01-11 08:50:06', '2023-01-18 09:31:19'),
(17, 'Marketing', '2023-01-18 10:54:33', '2023-01-18 09:31:31'),
(18, 'PRD', '2023-01-18 13:28:29', '2023-01-19 04:31:30'),
(19, 'WIP bawah', '2023-01-18 14:20:20', '2023-01-18 09:32:19'),
(29, 'MS', '2023-01-18 15:32:31', NULL),
(30, 'PRODUKSI', '2023-01-18 15:32:43', NULL),
(31, 'MS Office ', '2023-01-18 15:32:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin, 2:user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `level`) VALUES
(1, 'Aliya', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Aliyatu Shabrina Zein', 'Bogor, Indonesia', 1),
(2, 'Lucas', '874c0ac75f323057fe3b7fb3f5a8a41df2b94b1d', 'Lucas Wong', 'Hongkong', 2),
(13, 'Chanyeol', '8cb2237d0679ca88db6464eac60da96345513964', 'Park Chanyeol', 'Korea', 2),
(14, 'Johnny', '8cb2237d0679ca88db6464eac60da96345513964', 'Johnny Suh', 'AS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `kalibrasi`
--
ALTER TABLE `kalibrasi`
  ADD PRIMARY KEY (`durasi_kalibrasi`);

--
-- Indexes for table `p_category`
--
ALTER TABLE `p_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`no_seri`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`pemilik_id`),
  ADD KEY `next_kalibrasi` (`durasi_kalibrasi`),
  ADD KEY `kalibrasi_id` (`durasi_kalibrasi`),
  ADD KEY `pertama_kalibrasi` (`pertama_kalibrasi`);

--
-- Indexes for table `p_pemilik`
--
ALTER TABLE `p_pemilik`
  ADD PRIMARY KEY (`pemilik_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `p_category`
--
ALTER TABLE `p_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `p_pemilik`
--
ALTER TABLE `p_pemilik`
  MODIFY `pemilik_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `p_category` (`category_id`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`pemilik_id`) REFERENCES `p_pemilik` (`pemilik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
