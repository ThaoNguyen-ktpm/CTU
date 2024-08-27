-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 09:48 AM
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
-- Database: `qltt3`
--

-- --------------------------------------------------------

--
-- Table structure for table `buoihocs`
--

CREATE TABLE `buoihocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NgayHoc` varchar(255) NOT NULL,
  `ThoiGian` time NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buoihocs`
--

INSERT INTO `buoihocs` (`id`, `NgayHoc`, `ThoiGian`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'Thu2', '18:15:00', 1, '2024-06-15 15:06:46', 2, '2024-06-15 15:06:46', 2),
(2, 'Thu4', '18:15:00', 1, '2024-06-15 15:06:50', 2, '2024-06-15 15:06:50', 2),
(3, 'Thu6', '18:15:00', 1, '2024-06-15 15:06:54', 2, '2024-06-15 15:06:54', 2),
(4, 'Thu2', '07:55:00', 1, '2024-06-16 04:55:59', 3, '2024-06-16 04:55:59', 3),
(5, 'Thu3', '10:00:00', 1, '2024-06-16 09:50:01', 3, '2024-06-16 09:50:15', 3);

-- --------------------------------------------------------

--
-- Table structure for table `chungchis`
--

CREATE TABLE `chungchis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenChungChi` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chungchis`
--

INSERT INTO `chungchis` (`id`, `TenChungChi`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'UD CNTT Cơ bản', 1, '2024-06-15 15:01:51', 2, '2024-06-15 15:01:51', 2),
(3, 'UD Anh Văn', 1, '2024-06-16 05:36:50', 3, '2024-06-16 09:04:37', 3),
(40, 'UD Anh Văn Căn Bản1', 1, '2024-06-16 09:44:19', 3, '2024-06-16 09:44:28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `danhsachlops`
--

CREATE TABLE `danhsachlops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TrangThai` tinyint(1) NOT NULL,
  `MaHocVien` bigint(20) UNSIGNED NOT NULL,
  `MaLopHoc` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danhsachlops`
--

INSERT INTO `danhsachlops` (`id`, `TrangThai`, `MaHocVien`, `MaLopHoc`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 1, 1, 1, 1, '2024-06-15 15:18:04', 2, '2024-06-16 09:00:14', 3),
(2, 1, 2, 1, 1, '2024-06-15 15:18:04', 2, '2024-06-16 09:00:15', 3),
(12, 1, 10, 6, 1, '2024-06-16 09:51:49', 3, '2024-06-16 10:01:59', 3),
(13, 1, 11, 1, 1, '2024-06-16 09:52:11', 3, '2024-06-16 10:02:00', 3),
(14, 1, 12, 6, 1, '2024-06-16 10:08:30', 3, '2024-06-16 10:08:39', 3),
(15, 1, 13, 6, 1, '2024-06-16 10:08:31', 3, '2024-06-16 10:08:40', 3),
(16, 1, 14, 6, 1, '2024-06-16 10:22:11', 3, '2024-06-16 10:22:16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `filemetadatas`
--

CREATE TABLE `filemetadatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FileName` varchar(255) NOT NULL,
  `TypeFile` varchar(255) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filemetadatas`
--

INSERT INTO `filemetadatas` (`id`, `FileName`, `TypeFile`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'mau_dang_ki_UD CNTT CB K50.1_UD CNTT Cơ bản_20240616_120221.xlsx', '.xlxs', '2024-06-16 05:03:48', 3, '2024-06-16 05:03:48', 3),
(2, 'mau_dang_ki_Lop AVCB_UD Anh Văn Căn Bản1_20240616_170320.xlsx', '.xlxs', '2024-06-16 10:08:17', 3, '2024-06-16 10:08:17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `giaoviengiangdays`
--

CREATE TABLE `giaoviengiangdays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaGiaoVien` bigint(20) UNSIGNED NOT NULL,
  `MaLopHoc` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giaoviengiangdays`
--

INSERT INTO `giaoviengiangdays` (`id`, `MaGiaoVien`, `MaLopHoc`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 1, 1, 1, '2024-06-15 15:10:12', 2, '2024-06-15 15:10:12', 2),
(2, 2, 2, 0, '2024-06-15 15:10:41', 2, '2024-06-16 08:04:26', 3),
(4, 2, 1, 0, '2024-06-16 04:28:48', 3, '2024-06-16 08:18:50', 3),
(10, 1, 3, 1, '2024-06-16 08:04:13', 3, '2024-06-16 08:04:13', 3),
(11, 2, 3, 1, '2024-06-16 08:04:13', 3, '2024-06-16 08:04:13', 3),
(12, 1, 2, 1, '2024-06-16 08:04:21', 3, '2024-06-16 08:04:21', 3),
(13, 1, 5, 1, '2024-06-16 08:07:57', 3, '2024-06-16 08:13:48', 3),
(14, 2, 5, 0, '2024-06-16 08:08:15', 3, '2024-06-16 08:13:48', 3),
(15, 4, 6, 1, '2024-06-16 09:51:01', 3, '2024-06-16 09:51:01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `giaoviens`
--

CREATE TABLE `giaoviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenGiaoVien` varchar(255) NOT NULL,
  `NgaySinh` date NOT NULL,
  `NoiSinh` varchar(255) NOT NULL,
  `CCCD` varchar(255) NOT NULL,
  `SDT` varchar(255) NOT NULL,
  `HocVi` varchar(255) NOT NULL,
  `ChuyenNghanh` varchar(255) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giaoviens`
--

INSERT INTO `giaoviens` (`id`, `TenGiaoVien`, `NgaySinh`, `NoiSinh`, `CCCD`, `SDT`, `HocVi`, `ChuyenNghanh`, `DiaChi`, `Email`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'Giáo Viên A', '2024-06-15', 'Cần Thơ', '0123456789', '0123456789', 'Thạc Sĩ', 'CNTT', 'Cần Thơ', 'GiaoVien@gmail.com', 1, '2024-06-15 15:09:33', 2, '2024-06-16 07:34:52', 3),
(2, 'Giáo Viên B', '2024-06-15', 'Cần Thơ', '0123456789', '0123456789', 'Thạc Sĩ', 'CNTT', 'Cần Thơ', 'GiaoVien@gmail.com', 1, '2024-06-16 07:31:32', 3, '2024-06-16 07:34:52', 3),
(4, 'Giáo Viên AVCB', '2024-06-16', 'Cần Thơ', '0123456789', '0123456789', 'Thạc Sĩ', 'ANHVAN', 'Cần Thơ', 'GiaoVienAnhVan@gmail.com', 1, '2024-06-16 09:48:44', 3, '2024-06-16 09:48:44', 3),
(5, 'Giáo Viên THUD', '2024-06-16', 'Cần Thơ', '0123456789', '0120000000', 'Thạc Sĩ', 'Tin Hoc', 'Cần Thơ', 'GiaoVienTinHoc@gmail.com', 1, '2024-06-16 09:49:28', 3, '2024-06-16 09:49:40', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hocviens`
--

CREATE TABLE `hocviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenHocVien` varchar(255) NOT NULL,
  `MSSV` varchar(255) DEFAULT NULL,
  `NgaySinh` date NOT NULL,
  `NoiSinh` varchar(255) NOT NULL,
  `GioiTinh` varchar(255) NOT NULL,
  `DanToc` varchar(255) NOT NULL,
  `CCCD` varchar(255) NOT NULL,
  `NgayCapCCCD` date NOT NULL,
  `NoiCapCCCD` varchar(255) NOT NULL,
  `SDT` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `GhiChu` varchar(1000) DEFAULT NULL,
  `IsClass` tinyint(1) NOT NULL,
  `MaChungChi` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED DEFAULT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hocviens`
--

INSERT INTO `hocviens` (`id`, `TenHocVien`, `MSSV`, `NgaySinh`, `NoiSinh`, `GioiTinh`, `DanToc`, `CCCD`, `NgayCapCCCD`, `NoiCapCCCD`, `SDT`, `Email`, `GhiChu`, `IsClass`, `MaChungChi`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'Học Viên A', '123456', '2024-06-15', 'Cần Thơ', 'Nam', 'Kinh', '123456789', '2024-06-15', 'Cần Thơ', '0123456789', 'hocvien@gmail.com', NULL, 1, 1, 0, '2024-06-15 15:13:02', 2, '2024-06-16 10:02:38', 3),
(2, 'Học Viên B', '123456', '2024-06-15', 'Cần Thơ', 'Nam', 'Kinh', '123456789', '2024-06-15', 'Cần Thơ', '0123456789', 'hocvien@gmail.com', NULL, 1, 1, 1, '2024-06-15 15:15:15', 2, '2024-06-16 09:55:35', 3),
(10, 'Nguyễn Văn Thảo', '125478', '2024-06-16', 'Cần Thơ', 'Nam', 'Kinh', '0123456789', '2024-06-16', 'Cần Thơ', '0123456789', 'nguyenvanthao@gmail.com', NULL, 1, 40, 1, '2024-06-16 09:46:30', 3, '2024-06-16 09:46:49', 3),
(11, 'nguyen dang khoa', '123456', '2024-06-16', 'Cần Thơ', 'Nam', 'Kinh', '0123456789', '2024-06-16', 'Cần Thơ', '0123456789', 'nguyendangkhoa@gmail.com', NULL, 1, 1, 1, '2024-06-16 09:47:49', 3, '2024-06-16 09:47:49', 3),
(12, 'Nguyễn Tấn Phát', '1800001', '2000-11-15', 'Tiền Giang', 'Nam', 'Kinh', '0123654789', '2021-11-15', 'Cục cảnh sát', '0983877752', 'ntphat@student.ctuet.edu.vn', '', 1, 40, 1, '2024-06-16 10:08:30', 3, '2024-06-16 10:08:30', 3),
(13, 'Nguyễn Tấn Lộc', '1800002', '2002-09-15', 'Sóc Trăng', 'Nam', 'Kinh', '0456987123', '2021-11-15', 'Cục cảnh sát', '0983877753', 'ntloc@student.ctuet.edu.vn', '', 1, 40, 1, '2024-06-16 10:08:31', 3, '2024-06-16 10:08:31', 3),
(14, 'Nguyễn Văn Tuan', '123456', '2024-06-16', 'Cần Thơ', 'Nam', 'Kinh', '0123456789', '2024-06-16', 'Cần Thơ', '0123456789', 'nvthao2001255@student.ctuet.edu.vn', NULL, 1, 40, 1, '2024-06-16 10:19:01', 31, '2024-06-16 10:19:01', 31);

-- --------------------------------------------------------

--
-- Table structure for table `khoahocs`
--

CREATE TABLE `khoahocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenKhoaHoc` varchar(255) NOT NULL,
  `MaChungChi` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoahocs`
--

INSERT INTO `khoahocs` (`id`, `TenKhoaHoc`, `MaChungChi`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'UDCNTTCB K50', 1, 1, '2024-06-15 15:04:44', 2, '2024-06-16 07:12:16', 3),
(2, 'UDCNTTCB K51', 1, 0, '2024-06-16 07:05:35', 3, '2024-06-16 07:12:16', 3),
(3, 'AVCBUD K51', 40, 1, '2024-06-16 09:45:08', 3, '2024-06-16 09:45:18', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lichhocs`
--

CREATE TABLE `lichhocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaBuoiHoc` bigint(20) UNSIGNED NOT NULL,
  `MaLopHoc` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lichhocs`
--

INSERT INTO `lichhocs` (`id`, `MaBuoiHoc`, `MaLopHoc`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 1, 1, 1, '2024-06-15 15:10:12', 2, '2024-06-16 08:19:41', 3),
(2, 1, 2, 0, '2024-06-15 15:10:41', 2, '2024-06-16 08:04:26', 3),
(3, 2, 2, 1, '2024-06-15 15:10:41', 2, '2024-06-16 08:04:21', 3),
(4, 3, 2, 1, '2024-06-15 15:10:41', 2, '2024-06-16 08:04:21', 3),
(5, 2, 1, 0, '2024-06-15 15:10:46', 2, '2024-06-16 08:18:50', 3),
(6, 3, 1, 0, '2024-06-15 15:10:46', 2, '2024-06-16 08:18:50', 3),
(12, 1, 3, 1, '2024-06-16 07:48:13', 3, '2024-06-16 07:48:13', 3),
(13, 2, 3, 1, '2024-06-16 07:48:13', 3, '2024-06-16 07:48:13', 3),
(14, 4, 2, 1, '2024-06-16 08:00:58', 3, '2024-06-16 08:04:21', 3),
(16, 4, 3, 1, '2024-06-16 08:01:14', 3, '2024-06-16 08:01:14', 3),
(17, 3, 3, 1, '2024-06-16 08:02:53', 3, '2024-06-16 08:02:53', 3),
(21, 1, 5, 1, '2024-06-16 08:07:57', 3, '2024-06-16 08:07:57', 3),
(22, 2, 5, 1, '2024-06-16 08:13:48', 3, '2024-06-16 08:13:48', 3),
(23, 3, 5, 1, '2024-06-16 08:13:48', 3, '2024-06-16 08:13:48', 3),
(24, 4, 1, 1, '2024-06-16 08:18:28', 3, '2024-06-16 08:18:28', 3),
(25, 5, 6, 1, '2024-06-16 09:51:01', 3, '2024-06-16 09:51:01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lophocs`
--

CREATE TABLE `lophocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenLopHoc` varchar(255) NOT NULL,
  `MaKhoaHoc` bigint(20) UNSIGNED NOT NULL,
  `MaPhongHoc` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lophocs`
--

INSERT INTO `lophocs` (`id`, `TenLopHoc`, `MaKhoaHoc`, `MaPhongHoc`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'UD CNTT CB K50.1', 1, 1, 1, '2024-06-15 15:10:12', 2, '2024-06-16 08:19:41', 3),
(2, 'UD CNTT CB K50.2', 1, 2, 1, '2024-06-15 15:10:41', 2, '2024-06-16 08:04:26', 3),
(3, 'UD CNTT CB K50.3', 1, 1, 1, '2024-06-16 08:04:13', 3, '2024-06-16 08:04:13', 3),
(5, 'UD CNTT CB K50.4', 1, 1, 1, '2024-06-16 08:07:57', 3, '2024-06-16 08:13:48', 3),
(6, 'Lop AVCB', 3, 7, 1, '2024-06-16 09:51:01', 3, '2024-06-16 09:51:01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(45, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(46, '2024_01_17_214419_create_users_table', 1),
(47, '2024_01_17_214435_create_phonghocs_table', 1),
(48, '2024_01_17_214450_create_buoihocs_table', 1),
(49, '2024_01_17_214505_create_giaoviens_table', 1),
(50, '2024_01_17_214528_create_chungchis_table', 1),
(51, '2024_01_17_214544_create_khoahocs_table', 1),
(52, '2024_01_17_214558_create_hocviens_table', 1),
(53, '2024_01_17_214613_create_lophocs_table', 1),
(54, '2024_01_17_214627_create_danhsachlops_table', 1),
(55, '2024_01_17_214659_create_thongkes_table', 1),
(56, '2024_03_16_205313_create_lichhocs_table', 1),
(57, '2024_03_25_012330_create_filemetadatas_table', 1),
(58, '2024_03_25_012558_create_rawdatas_table', 1),
(59, '2024_06_04_202524_create_giaoviengiangdays_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 7, 'API Token', '$2y$10$Z/X6Ap3xmUStbya1V9fhRe7Qk6sAJzFMWtP/NQiZKGvpaybu0Q8jm', '[\"*\"]', NULL, NULL, '2024-06-15 16:50:14', '2024-06-15 16:50:14'),
(2, 'App\\Models\\User', 6, 'API Token', '$2y$10$lYxX3if2DsXb5fzKpoh5ZuTfqS7OdQoVlmHVP3KYnRs7iRWRsp/V.', '[\"*\"]', NULL, NULL, '2024-06-15 16:55:24', '2024-06-15 16:55:24'),
(3, 'App\\Models\\User', 6, 'API Token', '$2y$10$3SSzguRVJ0Gc3uvynJvk0e1E7mUX0VXxGvhNDQTXzfiQcfRZPwrWG', '[\"*\"]', NULL, NULL, '2024-06-15 16:55:56', '2024-06-15 16:55:56'),
(4, 'App\\Models\\User', 6, 'API Token', '$2y$10$yooEUcLL7AQJ/FAiWUEYVOCAU/H9JoCv/ZRGvHKutOowbWJ5gs//S', '[\"*\"]', NULL, NULL, '2024-06-15 17:00:01', '2024-06-15 17:00:01'),
(5, 'App\\Models\\User', 6, 'API Token', '$2y$10$2r04QlxLWoYG2SuiAUIG5eR7PNpET2.3DQ6rYlUd/eGGjrnVgI4ZK', '[\"*\"]', NULL, NULL, '2024-06-15 17:10:48', '2024-06-15 17:10:48'),
(19, 'App\\Models\\User', 16, 'API Token', '$2y$10$/VnwobKNcB2dymwKQZREau0BygiRSBd7t8ZL.62f6xnqr4PhjtMEu', '[\"*\"]', NULL, NULL, '2024-06-15 17:54:18', '2024-06-15 17:54:18'),
(20, 'App\\Models\\User', 16, 'API Token', '$2y$10$r3jLEe1S6qpRlRYBfr6d6..Q8DiGZXmm/xUCVQZxllEm0/r4.fUnO', '[\"*\"]', NULL, NULL, '2024-06-15 17:58:01', '2024-06-15 17:58:01'),
(25, 'App\\Models\\User', 7, 'API Token', '$2y$10$901xgwYqKiiSy8pCXDWPl./g3MPXdUJGwKf4uuHYFahUD795heMIq', '[\"*\"]', NULL, NULL, '2024-06-16 04:34:40', '2024-06-16 04:34:40'),
(28, 'App\\Models\\User', 30, 'API Token', '$2y$10$aV63ypSNGPQit.ctxXvineyy3IXeBXfoiCBBG88ttnrwogx3jp/ha', '[\"*\"]', NULL, NULL, '2024-06-16 10:18:03', '2024-06-16 10:18:03'),
(29, 'App\\Models\\User', 31, 'API Token', '$2y$10$Nx.czVn.Yp7/4geZYjEzP..6oMSEtu2mxEivN7M3c8TbQcBPxEipi', '[\"*\"]', NULL, NULL, '2024-06-16 10:18:20', '2024-06-16 10:18:20'),
(30, 'App\\Models\\User', 31, 'API Token', '$2y$10$dPULblay8aE88Pjk1LnW7unusxb66UlI/gIXVOB814ZngJX3XVcie', '[\"*\"]', NULL, NULL, '2024-06-16 10:40:17', '2024-06-16 10:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `phonghocs`
--

CREATE TABLE `phonghocs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenPhongHoc` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phonghocs`
--

INSERT INTO `phonghocs` (`id`, `TenPhongHoc`, `IsActive`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 'PM1', 1, '2024-06-15 15:04:54', 2, '2024-06-15 15:04:54', 2),
(2, 'PM2', 1, '2024-06-16 07:18:07', 3, '2024-06-16 07:18:07', 3),
(3, 'PM4', 0, '2024-06-16 04:55:18', 3, '2024-06-16 04:55:34', 3),
(7, 'C102', 1, '2024-06-16 09:45:31', 3, '2024-06-16 09:45:40', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rawdatas`
--

CREATE TABLE `rawdatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FileMetaDataId` bigint(20) UNSIGNED NOT NULL,
  `LopHocId` bigint(20) UNSIGNED NOT NULL,
  `ChungChiId` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsComplete` tinyint(1) NOT NULL,
  `ColumnTenHocVien` varchar(255) NOT NULL,
  `ColumnMSSV` varchar(255) DEFAULT NULL,
  `ColumnEmail` varchar(255) NOT NULL,
  `ColumnNgaySinh` date NOT NULL,
  `ColumnNoiSinh` varchar(255) NOT NULL,
  `ColumnGioiTinh` varchar(255) NOT NULL,
  `ColumnDanToc` varchar(255) NOT NULL,
  `ColumnCCCD` varchar(255) NOT NULL,
  `ColumnNgayCapCCCD` date NOT NULL,
  `ColumnNoiCapCCCD` varchar(255) NOT NULL,
  `ColumnSoDienThoai` varchar(255) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rawdatas`
--

INSERT INTO `rawdatas` (`id`, `FileMetaDataId`, `LopHocId`, `ChungChiId`, `IsActive`, `IsComplete`, `ColumnTenHocVien`, `ColumnMSSV`, `ColumnEmail`, `ColumnNgaySinh`, `ColumnNoiSinh`, `ColumnGioiTinh`, `ColumnDanToc`, `ColumnCCCD`, `ColumnNgayCapCCCD`, `ColumnNoiCapCCCD`, `ColumnSoDienThoai`, `CreatedDateTime`, `CreatedUserId`, `LastModifiedDateTime`, `LastModifiedUserId`) VALUES
(1, 1, 1, 1, 1, 1, 'Học Viên F', '123456', 'hocvien@gmail.com', '2024-06-15', 'Cần Thơ', 'Nam', 'Kinh', '123456788', '2024-06-15', 'Cần Thơ', '0123456789', '2024-06-16 05:03:48', 3, '2024-06-16 05:03:48', 3),
(2, 1, 1, 1, 1, 1, 'Học Viên E', '123456', 'hocvien@gmail.com', '2024-06-15', 'Cần Thơ', 'Nam', 'Kinh', '123456789', '2024-06-15', 'Cần Thơ', '0123456789', '2024-06-16 05:03:48', 3, '2024-06-16 05:03:48', 3),
(3, 2, 6, 40, 1, 1, 'Nguyễn Tấn Phát', '1800001', 'ntphat@student.ctuet.edu.vn', '2000-11-15', 'Tiền Giang', 'Nam', 'Kinh', '0123654789', '2021-11-15', 'Cục cảnh sát', '0983877752', '2024-06-16 10:08:17', 3, '2024-06-16 10:08:17', 3),
(4, 2, 6, 40, 1, 1, 'Nguyễn Tấn Lộc', '1800002', 'ntloc@student.ctuet.edu.vn', '2002-09-15', 'Sóc Trăng', 'Nam', 'Kinh', '0456987123', '2021-11-15', 'Cục cảnh sát', '0983877753', '2024-06-16 10:08:17', 3, '2024-06-16 10:08:17', 3),
(5, 2, 6, 40, 0, 1, 'Nguyễn Tấn Phú', '1800003', 'ntphu@student.ctuet.edu.vn', '2000-11-15', 'Tiền Giang', 'Nam', 'Kinh', '0123654888', '2021-11-15', 'Cục cảnh sát', '0983877752', '2024-06-16 10:08:17', 3, '2024-06-16 10:08:17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `thongkes`
--

CREATE TABLE `thongkes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SoBuoiDayGiaoVien` int(11) NOT NULL,
  `TongThuHocPhi` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDateTime` timestamp NULL DEFAULT NULL,
  `CreatedUserId` bigint(20) UNSIGNED NOT NULL,
  `LastModifiedDateTime` timestamp NULL DEFAULT NULL,
  `LastModifiedUserId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SDT` varchar(255) DEFAULT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  `IsStudent` tinyint(1) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Password`, `Email`, `SDT`, `IsAdmin`, `IsStudent`, `google_id`, `IsActive`) VALUES
(2, 'Đinh Nhân', 'eyJpdiI6IjNaMS9MN2lWVGY0YWQ3V3JrOUl6b0E9PSIsInZhbHVlIjoiNnlhRTRRUEVtRDZhSFZsejBoOWVmKzhhYzhkTlg4RHBaa2ZpZXowZ21YVT0iLCJtYWMiOiJkNjgwMzllMDc1ZGI4MjEzYjU2MTBjMmNjOWI1M2E5YjM4YWIyN2QyODA3MmJmNTQ0ZDZmOGM2OWRlNGQwMGY5IiwidGFnIjoiIn0=', 'nhandinhctut@gmail.com', NULL, 0, 0, '107790362547743430258', 1),
(3, 'admin', '$2y$10$B922.qJSQ91DPzSqmsiIDOMKCqtE8YMNDDEUZUCV0bYiRzLYRFDrK', 'admin@gmail.com', '0123456789', 1, 0, NULL, 1),
(29, 'nhandinh', '$2y$10$eqzmmSsGGvEdX8r6G8NdReGnMswmw9Dqk9d5tyVQx1EX7zlsOEIsy', 'dinhnhanrgkg@gmail.com', '0123456888', 0, 0, NULL, 0),
(30, 'HocVienA', '$2y$10$wT9CHuLoj681PUCmtTV6beUN8HFYGIDCvUGOUzj28gkX4WiJ6KBkW', 'nvthao.12a.5.20@gmail.com', '0123456789', 0, 1, NULL, 1),
(31, 'Nguyễn Văn Thảo', 'eyJpdiI6IjA1Q09yeVI2RENTUXR1eFNJOU5CVkE9PSIsInZhbHVlIjoiNFhNZXgwejFPNEhWalBnaHYreXkzeFJQNE8reVI0UnhyeGxyd2wwZjIvWT0iLCJtYWMiOiJhMjgwMmEwOTZlN2M2NTcwMDdlM2Q2NDJhM2RkYTQyMjVlNjlkZGJhYzA2NDVmOGNjMTgzZjNmMGJiYTcyOTNmIiwidGFnIjoiIn0=', 'nvthao2001255@student.ctuet.edu.vn', NULL, 0, 1, '108866227975067641094', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buoihocs`
--
ALTER TABLE `buoihocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buoihocs_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `buoihocs_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `chungchis`
--
ALTER TABLE `chungchis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chungchis_tenchungchi_unique` (`TenChungChi`),
  ADD KEY `chungchis_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `chungchis_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `danhsachlops`
--
ALTER TABLE `danhsachlops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danhsachlops_mahocvien_foreign` (`MaHocVien`),
  ADD KEY `danhsachlops_malophoc_foreign` (`MaLopHoc`),
  ADD KEY `danhsachlops_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `danhsachlops_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `filemetadatas`
--
ALTER TABLE `filemetadatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filemetadatas_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `filemetadatas_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `giaoviengiangdays`
--
ALTER TABLE `giaoviengiangdays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giaoviengiangdays_magiaovien_foreign` (`MaGiaoVien`),
  ADD KEY `giaoviengiangdays_malophoc_foreign` (`MaLopHoc`),
  ADD KEY `giaoviengiangdays_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `giaoviengiangdays_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `giaoviens`
--
ALTER TABLE `giaoviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giaoviens_tengiaovien_unique` (`TenGiaoVien`),
  ADD KEY `giaoviens_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `giaoviens_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `hocviens`
--
ALTER TABLE `hocviens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hocviens_machungchi_foreign` (`MaChungChi`),
  ADD KEY `hocviens_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `hocviens_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `khoahocs`
--
ALTER TABLE `khoahocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khoahocs_tenkhoahoc_unique` (`TenKhoaHoc`),
  ADD KEY `khoahocs_machungchi_foreign` (`MaChungChi`),
  ADD KEY `khoahocs_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `khoahocs_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `lichhocs`
--
ALTER TABLE `lichhocs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichhocs_mabuoihoc_foreign` (`MaBuoiHoc`),
  ADD KEY `lichhocs_malophoc_foreign` (`MaLopHoc`),
  ADD KEY `lichhocs_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `lichhocs_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `lophocs`
--
ALTER TABLE `lophocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lophocs_tenlophoc_unique` (`TenLopHoc`),
  ADD KEY `lophocs_makhoahoc_foreign` (`MaKhoaHoc`),
  ADD KEY `lophocs_maphonghoc_foreign` (`MaPhongHoc`),
  ADD KEY `lophocs_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `lophocs_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phonghocs`
--
ALTER TABLE `phonghocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phonghocs_tenphonghoc_unique` (`TenPhongHoc`),
  ADD KEY `phonghocs_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `phonghocs_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `rawdatas`
--
ALTER TABLE `rawdatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rawdatas_filemetadataid_foreign` (`FileMetaDataId`),
  ADD KEY `rawdatas_lophocid_foreign` (`LopHocId`),
  ADD KEY `rawdatas_chungchiid_foreign` (`ChungChiId`),
  ADD KEY `rawdatas_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `rawdatas_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `thongkes`
--
ALTER TABLE `thongkes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thongkes_createduserid_foreign` (`CreatedUserId`),
  ADD KEY `thongkes_lastmodifieduserid_foreign` (`LastModifiedUserId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buoihocs`
--
ALTER TABLE `buoihocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chungchis`
--
ALTER TABLE `chungchis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `danhsachlops`
--
ALTER TABLE `danhsachlops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `filemetadatas`
--
ALTER TABLE `filemetadatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `giaoviengiangdays`
--
ALTER TABLE `giaoviengiangdays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `giaoviens`
--
ALTER TABLE `giaoviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hocviens`
--
ALTER TABLE `hocviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `khoahocs`
--
ALTER TABLE `khoahocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lichhocs`
--
ALTER TABLE `lichhocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lophocs`
--
ALTER TABLE `lophocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `phonghocs`
--
ALTER TABLE `phonghocs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rawdatas`
--
ALTER TABLE `rawdatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thongkes`
--
ALTER TABLE `thongkes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buoihocs`
--
ALTER TABLE `buoihocs`
  ADD CONSTRAINT `buoihocs_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `buoihocs_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `chungchis`
--
ALTER TABLE `chungchis`
  ADD CONSTRAINT `chungchis_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `chungchis_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `danhsachlops`
--
ALTER TABLE `danhsachlops`
  ADD CONSTRAINT `danhsachlops_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `danhsachlops_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `danhsachlops_mahocvien_foreign` FOREIGN KEY (`MaHocVien`) REFERENCES `hocviens` (`id`),
  ADD CONSTRAINT `danhsachlops_malophoc_foreign` FOREIGN KEY (`MaLopHoc`) REFERENCES `lophocs` (`id`);

--
-- Constraints for table `filemetadatas`
--
ALTER TABLE `filemetadatas`
  ADD CONSTRAINT `filemetadatas_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `filemetadatas_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `giaoviengiangdays`
--
ALTER TABLE `giaoviengiangdays`
  ADD CONSTRAINT `giaoviengiangdays_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `giaoviengiangdays_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `giaoviengiangdays_magiaovien_foreign` FOREIGN KEY (`MaGiaoVien`) REFERENCES `giaoviens` (`id`),
  ADD CONSTRAINT `giaoviengiangdays_malophoc_foreign` FOREIGN KEY (`MaLopHoc`) REFERENCES `lophocs` (`id`);

--
-- Constraints for table `giaoviens`
--
ALTER TABLE `giaoviens`
  ADD CONSTRAINT `giaoviens_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `giaoviens_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `hocviens`
--
ALTER TABLE `hocviens`
  ADD CONSTRAINT `hocviens_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hocviens_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hocviens_machungchi_foreign` FOREIGN KEY (`MaChungChi`) REFERENCES `chungchis` (`id`);

--
-- Constraints for table `khoahocs`
--
ALTER TABLE `khoahocs`
  ADD CONSTRAINT `khoahocs_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `khoahocs_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `khoahocs_machungchi_foreign` FOREIGN KEY (`MaChungChi`) REFERENCES `chungchis` (`id`);

--
-- Constraints for table `lichhocs`
--
ALTER TABLE `lichhocs`
  ADD CONSTRAINT `lichhocs_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lichhocs_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lichhocs_mabuoihoc_foreign` FOREIGN KEY (`MaBuoiHoc`) REFERENCES `buoihocs` (`id`),
  ADD CONSTRAINT `lichhocs_malophoc_foreign` FOREIGN KEY (`MaLopHoc`) REFERENCES `lophocs` (`id`);

--
-- Constraints for table `lophocs`
--
ALTER TABLE `lophocs`
  ADD CONSTRAINT `lophocs_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lophocs_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lophocs_makhoahoc_foreign` FOREIGN KEY (`MaKhoaHoc`) REFERENCES `khoahocs` (`id`),
  ADD CONSTRAINT `lophocs_maphonghoc_foreign` FOREIGN KEY (`MaPhongHoc`) REFERENCES `phonghocs` (`id`);

--
-- Constraints for table `phonghocs`
--
ALTER TABLE `phonghocs`
  ADD CONSTRAINT `phonghocs_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `phonghocs_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);

--
-- Constraints for table `rawdatas`
--
ALTER TABLE `rawdatas`
  ADD CONSTRAINT `rawdatas_chungchiid_foreign` FOREIGN KEY (`ChungChiId`) REFERENCES `chungchis` (`id`),
  ADD CONSTRAINT `rawdatas_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rawdatas_filemetadataid_foreign` FOREIGN KEY (`FileMetaDataId`) REFERENCES `filemetadatas` (`id`),
  ADD CONSTRAINT `rawdatas_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rawdatas_lophocid_foreign` FOREIGN KEY (`LopHocId`) REFERENCES `lophocs` (`id`);

--
-- Constraints for table `thongkes`
--
ALTER TABLE `thongkes`
  ADD CONSTRAINT `thongkes_createduserid_foreign` FOREIGN KEY (`CreatedUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `thongkes_lastmodifieduserid_foreign` FOREIGN KEY (`LastModifiedUserId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
