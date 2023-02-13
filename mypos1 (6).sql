-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 09:39 AM
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
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `dashboard_id` int(11) NOT NULL,
  `no_seri` varchar(255) NOT NULL,
  `nama_alat_ukur` varchar(255) NOT NULL,
  `pertama_kalibrasi` date NOT NULL DEFAULT current_timestamp(),
  `next_kalibrasi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`dashboard_id`, `no_seri`, `nama_alat_ukur`, `pertama_kalibrasi`, `next_kalibrasi`) VALUES
(1, '', 'Profile Projector', '2023-01-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `durasi`
--

CREATE TABLE `durasi` (
  `id_durasi_kalibrasi` int(11) NOT NULL,
  `durasi_kalibrasi` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `durasi`
--

INSERT INTO `durasi` (`id_durasi_kalibrasi`, `durasi_kalibrasi`, `created`, `updated`) VALUES
(16, 1, '2023-02-08 09:20:06', NULL),
(17, 2, '2023-02-08 09:20:24', '2023-02-08'),
(18, 3, '2023-02-08 09:20:34', '2023-02-08'),
(19, 4, '2023-02-08 09:20:40', '2023-02-08'),
(20, 5, '2023-02-08 09:20:47', '2023-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `kalibrasi`
--

CREATE TABLE `kalibrasi` (
  `kalibrasi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `lembaga_id` int(11) NOT NULL,
  `no_sertifikat` varchar(200) NOT NULL,
  `file_sertifikat` varchar(200) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `durasi_kalibrasi` int(11) NOT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `tanggal_kalibrasi` date NOT NULL DEFAULT current_timestamp(),
  `selanjutnya` date DEFAULT NULL,
  `create` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kalibrasi`
--

INSERT INTO `kalibrasi` (`kalibrasi_id`, `item_id`, `lembaga_id`, `no_sertifikat`, `file_sertifikat`, `keterangan`, `durasi_kalibrasi`, `tanggal_pembelian`, `tanggal_kalibrasi`, `selanjutnya`, `create`, `updated`) VALUES
(8, 55, 0, '65342', 'sdgfhgjewsd', 'sdzfsdzz', 1, NULL, '2024-02-04', '2025-02-04', '2023-01-31 09:11:15', NULL),
(10, 73, 0, '56432', 'pdf', 'untuk menimbang', 1, NULL, '2023-01-31', '2024-01-31', '2023-01-31 09:11:15', NULL),
(12, 74, 0, '90998767', 'kalibrasi-230131-850787da5c.docx', 'jdhfjkdxhv', 1, NULL, '2023-01-31', '2024-01-31', '2023-01-31 10:41:32', NULL),
(26, 77, 0, 'selanjutnya', NULL, 'selanjutnya', 1, NULL, '2023-02-01', '2024-02-01', '2023-02-01 09:50:52', NULL),
(30, 79, 0, '982645347', NULL, 'Compotec', 1, NULL, '2023-09-01', '2024-09-01', '2023-02-01 10:45:50', NULL),
(31, 80, 0, '65333232', NULL, 'Compotec', 1, NULL, '2023-04-01', '2024-04-01', '2023-02-01 10:48:03', NULL),
(35, 93, 0, '65645', 'kalibrasi-230203-458b1e2932.jpg', 'Compotec', 2, '2023-02-03', '2023-02-03', '2025-02-03', '2023-02-03 08:23:18', NULL),
(49, 96, 0, 'RYE5334124', NULL, 'ERTGXDF', 5, '2023-02-02', '2023-02-02', '2028-02-02', '2023-02-08 09:18:13', NULL),
(50, 96, 0, 'FE5235', NULL, 'RTGZSDFD', 5, '2023-02-08', '2023-02-08', '2028-02-08', '2023-02-08 09:19:53', NULL),
(51, 95, 0, '2QAEAW', NULL, 'untuk', 1, '2023-02-08', '2023-02-08', '1970-01-01', '2023-02-08 09:21:53', NULL),
(52, 95, 2, 'e224343', NULL, 'contoh', 4, '2023-01-02', '2023-02-02', '2027-02-02', '2023-02-08 11:38:47', NULL),
(53, 97, 2, 'sfk43i2323', NULL, 'wesds', 3, '2023-02-07', '2023-02-08', '2026-02-08', '2023-02-08 14:36:56', NULL);

--
-- Triggers `kalibrasi`
--
DELIMITER $$
CREATE TRIGGER `tambah_kalibrasi` AFTER INSERT ON `kalibrasi` FOR EACH ROW UPDATE p_item SET tanggal_kalibrasi=NEW.tanggal_kalibrasi,selanjutnya=NEW.selanjutnya WHERE item_id=NEW.item_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_kalibrasi` AFTER UPDATE ON `kalibrasi` FOR EACH ROW UPDATE p_item SET tanggal_kalibrasi=NEW.tanggal_kalibrasi,selanjutnya=NEW.selanjutnya WHERE item_id=NEW.item_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `k_frekuensi`
--

CREATE TABLE `k_frekuensi` (
  `frekuensi_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `k_frekuensi`
--

INSERT INTO `k_frekuensi` (`frekuensi_id`, `name`, `created`, `updated`) VALUES
(2, '1 x / 2 y', '2023-02-03 14:40:52', NULL),
(3, '1 x / 1 y', '2023-02-03 14:41:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `k_lembaga`
--

CREATE TABLE `k_lembaga` (
  `lembaga_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `k_lembaga`
--

INSERT INTO `k_lembaga` (`lembaga_id`, `name`, `created`, `updated`) VALUES
(2, 'contoh', '2023-02-08 11:36:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_akurasi`
--

CREATE TABLE `p_akurasi` (
  `akurasi_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_akurasi`
--

INSERT INTO `p_akurasi` (`akurasi_id`, `name`, `created`, `updated`) VALUES
(3, '0.001 mm', '2023-02-03 14:38:04', NULL),
(4, '0.01 Gr.', '2023-02-03 14:38:11', NULL),
(9, '0.5 Gr', '2023-02-03 14:39:08', NULL),
(10, '1 Kg', '2023-02-03 14:39:15', NULL),
(11, '0.01 Gr.', '2023-02-03 14:39:20', NULL),
(12, '0.1 Gr.', '2023-02-03 14:39:26', NULL),
(14, '0,01', '2023-02-03 14:39:43', NULL),
(15, '0,001', '2023-02-03 14:39:49', NULL),
(16, '2 degree', '2023-02-03 14:39:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_category`
--

CREATE TABLE `p_category` (
  `category_id` int(11) NOT NULL,
  `jenisalat` varchar(100) NOT NULL,
  `fungsi` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_category`
--

INSERT INTO `p_category` (`category_id`, `jenisalat`, `fungsi`, `created`, `updated`) VALUES
(8, 'Rubber Hardness Tester', 'Mengukur kekerasan rubber', '2023-01-09 14:22:08', '2023-01-26 02:49:47'),
(9, 'Timbangan/Neraca ', 'Menimbang Berat Produk', '2023-01-10 09:45:03', '2023-01-26 07:25:58'),
(10, 'Profile projector', 'Mengukur profile produk', '2023-01-10 13:36:25', '2023-01-26 02:50:47'),
(11, 'Magnetic Stand Indicator', 'Cek diel tie bar MC', '2023-01-10 13:36:50', '2023-01-26 02:57:12'),
(12, 'Dial Indicator', 'Cek setting benda kerja', '2023-01-10 13:37:53', '2023-01-26 02:57:43'),
(13, 'Outside Micrometer', 'Mengukur Dimensi Luar', '2023-01-10 13:38:29', '2023-01-26 02:58:10'),
(14, 'Torque Wrench', 'Cek Torsi ', '2023-01-10 13:39:25', '2023-01-26 02:58:29'),
(17, 'Digimatic Caliper ', 'Mengukur Dimensi Luar & Dalam', '2023-01-11 11:22:28', '2023-01-26 02:59:26'),
(18, 'Thickness Gage ', 'Mengukur ketebalan ', '2023-01-11 11:33:54', '2023-01-26 03:00:45'),
(20, 'Anak Batu Timbangan', 'Untuk Verifikasi timbangan ', '2023-01-18 15:05:02', '2023-01-26 03:01:35'),
(21, 'Temperatur Humidity ', '-', '2023-01-18 15:17:29', '2023-01-26 03:01:59'),
(30, 'asda', 'ada', '2023-02-03 13:40:06', NULL);

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
  `fungsi` varchar(255) DEFAULT NULL,
  `range_id` int(11) DEFAULT NULL,
  `akurasi_id` int(11) DEFAULT NULL,
  `tanggal_kalibrasi` varchar(255) NOT NULL,
  `selanjutnya` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`item_id`, `no_seri`, `nama_alat_ukur`, `merk`, `category_id`, `pemilik_id`, `fungsi`, `range_id`, `akurasi_id`, `tanggal_kalibrasi`, `selanjutnya`, `image`, `created`, `updated`) VALUES
(75, '112510. (7010 S - 10 )', 'Magnetic stand indicator ', 'MITUTOYO', 11, 29, NULL, NULL, NULL, '2020-09-01', NULL, 'item-230131-316157ba32.jpg', '2023-01-31 10:19:12', NULL),
(81, '0022361', 'Outside Micrometer ', 'MITUTOYO', 13, 10, NULL, NULL, NULL, '', '2025-01-01', NULL, '2023-02-01 12:00:41', NULL),
(83, 'PJ 300', 'Profile Projector', 'MITUTOYO', 10, 10, NULL, NULL, NULL, '2023-02-01', '2024-02-01', NULL, '2023-02-01 14:15:48', NULL),
(84, 'J 8050935', 'Timbangan/ Neraca ( 1 )', 'AND EK', 9, 12, '0', 1, 0, '', NULL, 'item-230202-e751aafe57.jpg', '2023-02-02 08:37:45', NULL),
(85, '452312', 'edsfzcs', 'sfdvrfdv', 14, 13, '0', 0, 2, '', NULL, NULL, '2023-02-02 08:38:33', NULL),
(88, '6456785', 'x fbkjgdlug', 'reteiud', 11, 19, '0', 5, 0, '', NULL, NULL, '2023-02-02 10:40:53', NULL),
(89, '232332', 'cdcdece', 'cfecc', 17, 17, '0', 0, 0, '', NULL, NULL, '2023-02-02 11:03:24', NULL),
(92, '644647', 'vjhv jvg', 'dchbv', 18, 12, 'Mengukur kekerasan rubber', 2, 2, '2024-02-23', '2025-02-23', NULL, '2023-02-03 08:16:58', NULL),
(93, '8249368734', 'Profile Projector', 'MITUTOYO', 10, 13, 'Mengukur profile produk', 2, 2, '2023-02-03', '2025-02-03', 'item-230203-0a469bc587.jpg', '2023-02-03 08:19:01', '2023-02-03 02:20:20'),
(95, 'cxxcxc', 'Profile Projector', 'dfsxc', 10, 12, 'Mengukur profile produk', 3, 9, '2023-02-02', '2027-02-02', NULL, '2023-02-07 11:56:21', '2023-02-08 09:37:50'),
(96, '64464562', 'Profile Projector', 'MITUTOYO', 10, 10, 'Mengukur profile produk', 18, 13, '2023-02-08', '2028-02-08', NULL, '2023-02-08 09:05:35', NULL),
(97, 'A9901', 'Dial Indicator ', 'TOHNICHI', 12, 10, 'Mengukur Dimensi Luar', 21, 14, '2023-02-08', '2026-02-08', NULL, '2023-02-08 13:55:28', NULL);

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
(12, 'GUDANG', '2023-01-11 08:49:17', '2023-01-26 05:32:10'),
(13, 'WIP Atas', '2023-01-11 08:50:06', '2023-01-18 09:31:19'),
(17, 'MARKETING', '2023-01-18 10:54:33', '2023-01-26 05:31:58'),
(18, 'PRD', '2023-01-18 13:28:29', '2023-01-19 04:31:30'),
(19, 'WIP bawah', '2023-01-18 14:20:20', '2023-01-18 09:32:19'),
(29, 'MS', '2023-01-18 15:32:31', NULL),
(30, 'PRODUKSI', '2023-01-18 15:32:43', NULL),
(31, 'MS Office ', '2023-01-18 15:32:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_range`
--

CREATE TABLE `p_range` (
  `range_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_range`
--

INSERT INTO `p_range` (`range_id`, `name`, `created`, `updated`) VALUES
(3, '0 - 50', '2023-02-03 14:30:24', NULL),
(4, '1 mg - 100 g', '2023-02-03 14:30:45', NULL),
(5, '0.1 ~ 200 Gr.', '2023-02-03 14:31:20', NULL),
(6, '0 ~ 2.5 Kg', '2023-02-03 14:31:28', NULL),
(7, '0.1 ~ 300 Gr.', '2023-02-03 14:31:47', NULL),
(8, '0 ~ 7.5 Kg', '2023-02-03 14:31:54', NULL),
(9, '0 ~ 3.0 Kg', '2023-02-03 14:32:03', NULL),
(10, '0 ~ 2.5 Kg', '2023-02-03 14:32:15', NULL),
(12, '0 ~ 30 Kg', '2023-02-03 14:33:21', NULL),
(13, '0 ~ 6 Kg', '2023-02-03 14:33:36', NULL),
(14, '1 ~ 150 Kg', '2023-02-03 14:33:47', NULL),
(15, '0.01 ~ 300 Gr', '2023-02-03 14:33:55', NULL),
(16, '0.1g - 15000 g', '2023-02-03 14:34:05', NULL),
(17, '0 ~ 50 kg', '2023-02-03 14:34:16', NULL),
(18, '0,5g - 15 kg ', '2023-02-03 14:34:23', NULL),
(19, '0 ~ 300g ', '2023-02-03 14:34:35', NULL),
(20, '0.1g - 15000 g', '2023-02-03 14:35:43', NULL),
(21, '0 ~ 50 kg', '2023-02-03 14:35:49', NULL),
(22, '0,5g - 15 kg ', '2023-02-03 14:35:55', NULL),
(24, '0 ~ 150', '2023-02-03 14:36:29', NULL),
(25, '0 - 10', '2023-02-03 14:36:43', NULL),
(26, '0 ~ 25', '2023-02-03 14:36:49', NULL),
(27, '0 - 100 degree', '2023-02-03 14:36:55', NULL),
(28, '0 - 100 degree', '2023-02-03 14:36:56', NULL),
(29, '05 cm - 30 kgf', '2023-02-03 14:37:07', NULL);

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
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Bogor, Indonesia', 1),
(2, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'user1', 'indonesia', 2),
(15, 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 'user2', 'Bogor, Indonesia', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`dashboard_id`),
  ADD KEY `no_seri` (`no_seri`),
  ADD KEY `nama_alat_ukur` (`nama_alat_ukur`),
  ADD KEY `pertama_kalibrasi` (`pertama_kalibrasi`),
  ADD KEY `next_kalibrasi` (`next_kalibrasi`);

--
-- Indexes for table `durasi`
--
ALTER TABLE `durasi`
  ADD PRIMARY KEY (`id_durasi_kalibrasi`);

--
-- Indexes for table `kalibrasi`
--
ALTER TABLE `kalibrasi`
  ADD PRIMARY KEY (`kalibrasi_id`);

--
-- Indexes for table `k_frekuensi`
--
ALTER TABLE `k_frekuensi`
  ADD PRIMARY KEY (`frekuensi_id`);

--
-- Indexes for table `k_lembaga`
--
ALTER TABLE `k_lembaga`
  ADD PRIMARY KEY (`lembaga_id`);

--
-- Indexes for table `p_akurasi`
--
ALTER TABLE `p_akurasi`
  ADD PRIMARY KEY (`akurasi_id`);

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
  ADD KEY `pertama_kalibrasi` (`tanggal_kalibrasi`),
  ADD KEY `fungsi` (`fungsi`),
  ADD KEY `range` (`range_id`),
  ADD KEY `akurasi` (`akurasi_id`);

--
-- Indexes for table `p_pemilik`
--
ALTER TABLE `p_pemilik`
  ADD PRIMARY KEY (`pemilik_id`);

--
-- Indexes for table `p_range`
--
ALTER TABLE `p_range`
  ADD PRIMARY KEY (`range_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `dashboard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `durasi`
--
ALTER TABLE `durasi`
  MODIFY `id_durasi_kalibrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kalibrasi`
--
ALTER TABLE `kalibrasi`
  MODIFY `kalibrasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `k_frekuensi`
--
ALTER TABLE `k_frekuensi`
  MODIFY `frekuensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `k_lembaga`
--
ALTER TABLE `k_lembaga`
  MODIFY `lembaga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `p_akurasi`
--
ALTER TABLE `p_akurasi`
  MODIFY `akurasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `p_category`
--
ALTER TABLE `p_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `p_pemilik`
--
ALTER TABLE `p_pemilik`
  MODIFY `pemilik_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `p_range`
--
ALTER TABLE `p_range`
  MODIFY `range_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
