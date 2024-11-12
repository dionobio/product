-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 07:39 AM
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
-- Database: `nguoi_dung`
--

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int(11) NOT NULL,
  `danh_muc_id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia_ban` decimal(15,2) NOT NULL,
  `gia_nhap` decimal(15,2) NOT NULL,
  `gia_khuyen_mai` decimal(15,2) DEFAULT NULL,
  `so_luong` int(11) NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `trang_thai` enum('active','inactive') DEFAULT 'active',
  `ngay_nhap` date DEFAULT NULL,
  `luot_xem` int(11) DEFAULT 0,
  `mo_ta_chi_tiet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `danh_muc_id`, `ten_san_pham`, `mo_ta`, `gia_ban`, `gia_nhap`, `gia_khuyen_mai`, `so_luong`, `hinh_anh`, `trang_thai`, `ngay_nhap`, `luot_xem`, `mo_ta_chi_tiet`) VALUES
(1, 0, 'Sản phẩm Mẫu', 'Mô tả sản phẩm mẫu', 100000.00, 50000.00, 90000.00, 20, 'Screenshot 2024-11-05 165050.png', 'active', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
