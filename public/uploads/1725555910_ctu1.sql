-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 03, 2024 lúc 06:46 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ctu1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `capnhattiendos`
--

CREATE TABLE `capnhattiendos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TienDo` int(11) NOT NULL,
  `NoiDung` text NOT NULL,
  `ThoiGian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `MaGiaoViec` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `capnhattiendos`
--

INSERT INTO `capnhattiendos` (`id`, `TienDo`, `NoiDung`, `ThoiGian`, `MaGiaoViec`, `IsActive`) VALUES
(10, 39, 'ko có nhe', '2024-09-02 14:27:23', 20, 1),
(13, 1, 'nội dung mới', '2024-08-31 06:25:03', 9, 1),
(14, 70, 'ko có j hết', '2024-09-02 01:37:18', 7, 1),
(20, 15, 'koko', '2024-09-02 01:38:05', 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviecs`
--

CREATE TABLE `congviecs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenCongViec` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `NgayBatDau` datetime NOT NULL,
  `NgayKetThuc` datetime NOT NULL,
  `LinkTaiLieu` varchar(255) DEFAULT NULL,
  `TrangThai` int(11) NOT NULL,
  `MaDuAn` bigint(20) UNSIGNED NOT NULL,
  `MaThucHien` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiTao` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `congviecs`
--

INSERT INTO `congviecs` (`id`, `TenCongViec`, `MoTa`, `NgayBatDau`, `NgayKetThuc`, `LinkTaiLieu`, `TrangThai`, `MaDuAn`, `MaThucHien`, `MaNguoiTao`, `IsActive`) VALUES
(4, 'khởi làm', '112', '2024-08-19 00:00:00', '2024-08-30 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 113, 115, 1, 1),
(5, 'Khởi Đầu mới', '123', '2024-08-19 00:00:00', '2024-08-29 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 114, 116, 1, 1),
(6, 'thiết kế web', '123', '2024-08-31 00:00:00', '2024-09-11 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 114, 117, 1, 1),
(10, 'Triển Khai', 'giai đoạn chuyển khai làm web', '2024-09-12 00:00:00', '2024-09-22 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 114, 118, 1, 1),
(12, 'kiểm thử', '123', '2024-09-24 00:00:00', '2024-10-05 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 114, 119, 1, 1),
(18, 'Khởi Đầu 543', '123', '2024-08-21 00:00:00', '2024-09-13 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 116, 123, 1, 1),
(19, 'Thiết Kế', 'công việc thiết kế', '2024-09-20 00:00:00', '2024-10-20 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 116, 124, 1, 1),
(20, 'test trễ hẹn', 'test trễ hẹn', '2024-08-27 00:00:00', '2024-08-28 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 117, 126, 1, 1),
(21, 'Triển Khai new', '123123', '2024-10-29 00:00:00', '2024-11-10 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 116, 125, 1, 1),
(22, 'Khởi Đầu', '123', '2024-08-29 00:00:00', '2024-09-08 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 118, 127, 1, 1),
(23, 'Thiết kế web 123', '123', '2024-09-08 00:00:00', '2024-09-18 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 118, 128, 1, 1),
(24, 'Khởi Đầu dự án test việc', '13123123', '2024-08-21 00:00:00', '2024-09-12 00:00:00', 'https://www.ctu.edu.vn/gioithieu/tong-quan.html', 1, 115, 120, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvis`
--

CREATE TABLE `donvis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenDonVi` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvis`
--

INSERT INTO `donvis` (`id`, `TenDonVi`, `IsActive`) VALUES
(1, 'Phòng lập trình 1', 1),
(2, 'Phòng lập trình 2', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duans`
--

CREATE TABLE `duans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenDuAn` varchar(255) NOT NULL,
  `Mota` text NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `MaNguoiTao` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `duans`
--

INSERT INTO `duans` (`id`, `TenDuAn`, `Mota`, `TrangThai`, `MaNguoiTao`, `IsActive`) VALUES
(113, 'Web Ngân hàng', '123', 1, 1, 1),
(114, 'Web Ngân hàng Aww', '123', 1, 1, 1),
(115, 'Dự Án Test Việc', '123', 1, 1, 1),
(116, 'làm Web test chức năng', '123', 1, 1, 1),
(117, 'làm Web test Trễ hẹn', 'công việc test trễ hẹn', 1, 1, 1),
(118, 'làm Web 123', '123', 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `DuongDanFile` varchar(255) NOT NULL,
  `MaCapNhatTienDo` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`id`, `DuongDanFile`, `MaCapNhatTienDo`, `IsActive`) VALUES
(1, 'uploads/1725110097_Bao cao QLTTNH-TH Ver 1.docx', 10, 1),
(2, 'uploads/1725110097_fileWord.docx', 10, 1),
(3, 'uploads/1725110097_mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx', 10, 1),
(4, 'uploads/1725110097_mau_dang_ki_B1 khóa 1 Lớp 1_Tiếng Anh B1_20240502_020307.xlsx', 10, 1),
(5, 'uploads/1725110703_NguyenVanThao_2001255_TH_B4.rar', 13, 1),
(6, 'uploads/1725110703_mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx', 13, 1),
(7, 'uploads/1725110703_thảoword.docx', 13, 1),
(8, 'uploads/1725110703_BaoCaoYeuCauDatTa.docx', 13, 1),
(9, 'uploads/1725113466_BaoCaoYeuCauDatTa.docx', 14, 1),
(15, 'uploads/1725266238_2000985_NguyenHuynhDangKhoa.docx', 14, 1),
(16, 'uploads/1725266238_GIS ontappppppppp.docx', 14, 1),
(17, 'uploads/1725266285_Thảo_Lab2.docx', 20, 1),
(18, 'uploads/1725287210_fileWord.docx', 10, 1),
(19, 'uploads/1725287243_Bao cao QLTTNH-TH Ver 1.docx', 10, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaidoans`
--

CREATE TABLE `giaidoans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenGiaiDoan` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giaidoans`
--

INSERT INTO `giaidoans` (`id`, `TenGiaiDoan`, `IsActive`) VALUES
(1, 'Khởi Đầu', 1),
(2, 'Thiết Kế', 1),
(3, 'Triển Khai', 1),
(4, 'Kiểm Thử', 1),
(5, 'Báo Cáo', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaoviecs`
--

CREATE TABLE `giaoviecs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiDung` bigint(20) UNSIGNED NOT NULL,
  `MaCongViec` bigint(20) UNSIGNED NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giaoviecs`
--

INSERT INTO `giaoviecs` (`id`, `MaNguoiDung`, `MaCongViec`, `TrangThai`, `IsActive`) VALUES
(5, 2, 4, 1, 0),
(6, 3, 4, 1, 1),
(7, 5, 4, 2, 1),
(8, 6, 4, 1, 1),
(9, 5, 5, 2, 1),
(10, 5, 6, 2, 1),
(11, 2, 10, 1, 1),
(13, 2, 12, 1, 1),
(14, 5, 18, 2, 1),
(15, 5, 19, 2, 1),
(16, 5, 20, 4, 1),
(17, 5, 21, 2, 1),
(18, 2, 22, 1, 1),
(19, 3, 22, 1, 1),
(20, 5, 22, 2, 1),
(21, 5, 23, 2, 1),
(22, 5, 24, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"262a9dcd-d6c0-4a70-9c32-dd2fead9ff22\",\"displayName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\SendNotificationEmail\\\":2:{s:10:\\\"\\u0000*\\u0000NoiDung\\\";s:6:\\\"123123\\\";s:8:\\\"\\u0000*\\u0000Email\\\";s:34:\\\"nvthao2001255@student.ctuet.edu.vn\\\";}\"}}', 0, NULL, 1725290911, 1725290911),
(2, 'default', '{\"uuid\":\"f5d9d65f-3b05-4615-8c90-d17ca310776b\",\"displayName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\SendNotificationEmail\\\":2:{s:10:\\\"\\u0000*\\u0000NoiDung\\\";s:10:\\\"bin tetstt\\\";s:8:\\\"\\u0000*\\u0000Email\\\";s:34:\\\"nvthao2001255@student.ctuet.edu.vn\\\";}\"}}', 0, NULL, 1725290948, 1725290948),
(3, 'default', '{\"uuid\":\"850f60b4-2d3f-4cd5-8f5a-b8a24aa3f059\",\"displayName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendNotificationEmail\",\"command\":\"O:30:\\\"App\\\\Jobs\\\\SendNotificationEmail\\\":2:{s:10:\\\"\\u0000*\\u0000NoiDung\\\";s:11:\\\"mỹ testtt\\\";s:8:\\\"\\u0000*\\u0000Email\\\";s:34:\\\"nvthao2001255@student.ctuet.edu.vn\\\";}\"}}', 0, NULL, 1725291000, 1725291000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_08_13_120654_create_donvis_table', 1),
(2, '2024_08_13_120741_create_vaitros_table', 1),
(3, '2024_08_13_120813_create_nguoidungs_table', 1),
(4, '2024_08_13_120834_create_phongbans_table', 1),
(5, '2024_08_13_120841_create_tacvus_table', 1),
(6, '2024_08_13_120900_create_thongbaos_table', 1),
(7, '2024_08_13_120920_create_giaidoans_table', 1),
(8, '2024_08_13_121002_create_duans_table', 1),
(9, '2024_08_13_121021_create_thuchiens_table', 1),
(10, '2024_08_13_121032_create_congviecs_table', 1),
(11, '2024_08_13_121044_create_giaoviecs_table', 1),
(12, '2024_08_13_121104_create_capnhattiendos_table', 1),
(13, '2024_08_13_121929_create_personal_access_tokens_table', 1),
(14, '2024_08_13_135115_create_thanhviens_table', 1),
(15, '2024_08_13_145412_create_sessions_table', 2),
(16, '2024_08_14_223024_change_thoigian_column_in_thongbaos_table', 3),
(17, '2024_08_15_090912_create_jobs_table', 4),
(18, '2024_08_15_091640_create_cache_table', 5),
(19, '2024_08_15_093707_drop_jobs_table', 6),
(20, '2024_08_15_093750_drop_cache_table', 6),
(21, '2024_08_15_094318_drop_cache_table', 7),
(22, '2024_08_15_094535_drop_cache_table', 8),
(23, '2024_08_18_012840_update_linktailieu_nullable_in_congviecs_table', 9),
(24, '2024_08_19_233441_add_is_congviec_to_thuchiens_table', 10),
(26, '2024_08_21_105026_add_username_to_nguoidungs_table', 11),
(29, '2024_08_22_212302_update_tables_structure', 12),
(30, '2024_08_23_010556_create_cache_table', 12),
(31, '2024_08_29_082617_add_is_see_to_thongbaos_table', 13),
(34, '2024_08_31_134735_update_capnhattiendos_table', 14),
(35, '2024_08_31_134903_create_files_table', 14),
(43, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(44, '2024_08_13_120654_create_donvis_table', 1),
(45, '2024_08_13_120741_create_vaitros_table', 1),
(46, '2024_08_13_120813_create_nguoidungs_table', 1),
(47, '2024_08_13_120834_create_phongbans_table', 1),
(48, '2024_08_13_120841_create_tacvus_table', 1),
(49, '2024_08_13_120900_create_thongbaos_table', 1),
(50, '2024_08_13_120920_create_giaidoans_table', 1),
(51, '2024_08_13_121002_create_duans_table', 1),
(52, '2024_08_13_121021_create_thuchiens_table', 1),
(53, '2024_08_13_121032_create_congviecs_table', 1),
(54, '2024_08_13_121044_create_giaoviecs_table', 1),
(55, '2024_08_13_121104_create_capnhattiendos_table', 1),
(56, '2024_08_13_135115_create_thanhviens_table', 1),
(57, '2024_08_13_145412_create_sessions_table', 1),
(58, '2024_08_31_134903_create_files_table', 1),
(59, '2024_09_02_222511_create_jobs_table', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidungs`
--

CREATE TABLE `nguoidungs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SDT` varchar(255) DEFAULT NULL,
  `Quyen` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidungs`
--

INSERT INTO `nguoidungs` (`id`, `Name`, `UserName`, `Password`, `Email`, `SDT`, `Quyen`, `google_id`, `IsActive`) VALUES
(1, 'admin', 'admin', '$2y$12$rTJC.bW799pwMJiNCic1yuQ5z2lyiaZa7h2dydKU97oFcVJOdOzdG', 'nvthao.12a5.20@gmail.com', '0788774326', '1', NULL, 1),
(2, 'khoa', 'Nguyễn Huỳnh Đăng Khoa', '$2y$12$LPk0vM8a.7DIa8Q2ff2JG.oz6NY7ij8Iky.Wnl0ZQJ95/CjtRMjZu', 'nvthao1.12a5.20@gmail.com', '0788774326', '2', NULL, 1),
(3, 'thảo', 'Nguyễn văn thảo', '$2y$12$FhbaWeg/hrBRgMnYBPJDMu1tJ9HKlvQV.23/AgVEZD994yENwrMd2', 'nvthao.12a5.2002@gmail.com', '0788774326', '4', NULL, 1),
(5, 'nhanvien', 'Nguyễn Nhân Viên', '$2y$12$HvOoPXQPZzg4esj57sy/9OsjTv2qQJ7hrpLvqpAkKPRvIt.i9cpvC', 'nvthao2001255@student.ctuet.edu.vn', '0788774326', '4', '117575137738287609922', 1),
(6, 'Nguyễn', 'Nguyễn Duy Nguyễn', '$2y$12$gh3fpq4VlPsvMskD6lQ1buQytHjdk/hOPkM1zWFg3E9HsLyoE.ew6', 'nvthao20012552@student.ctuet.edu.vn', '0788774326', '4', NULL, 1),
(7, 'my', 'Trần Hoàng Mỹ', '$2y$12$zFP.K8P3/uMYb3ZPcOoIfOnH0SPpDnZU6jpDdQ2U4leqdjYPIDdkS', 'my1@gmail.com', '0788774326', '4', NULL, 1),
(8, 'my2', 'Trần Hoàng Mỹ 2', '$2y$12$NOjyvjwA9vGszU2OgXFyGeOvQzvwh81YYY0ccjgUKZDxViWoBAa6S', 'my2@gmail.com', '0788774326', '4', NULL, 1),
(9, 'my3', 'Trần Hoàng Mỹ 3', '$2y$12$ZnlzNgqSjKEw4lxn..gJbONuEYI20qjqPWCHRNxwTLlgLruriZK/i', 'my3@gmail.com', '0788774326', '4', NULL, 1),
(10, 'my4', 'Trần Hoàng Mỹ 4', '$2y$12$3XpcJaja2TKvxkQjnt8j.ejz01xPx9MA42h91ntLtRp4ptjWqujZK', 'my4@gmail.com', '0788774326', '4', NULL, 1),
(11, 'my5', 'Trần Hoàng Mỹ 5', '$2y$12$qbwCvQS7KN.2oeqIBld.qu/qb2VNqbvuJMQLMaLPCxbKgSn8LmgNW', 'my5@gmail.com', '0788774326', '4', NULL, 1),
(12, 'my6', 'Trần Hoàng Mỹ 6', '$2y$12$mWLH8OvRZltCLYl/2knwoeV.DJ4pZrky0XPLeIgozMfuzeeJIEXW2', 'my6@gmail.com', '0788774326', '4', NULL, 1),
(13, 'my7', 'Trần Hoàng Mỹ 7', '$2y$12$qW0nKBahS55vgfTVmPwdku/yEDE9zBinnJ0QaCjO3siqRgrmEE/qe', 'my7@gmail.com', '0788774326', '4', NULL, 1),
(14, 'my8', 'Trần Hoàng Mỹ 8', '$2y$12$ru2bb6swKvvMmG18szz8jOZyrq0fLOZvhjRrpkK3iO7OR04WAq63y', 'my8@gmail.com', '0788774326', '4', NULL, 1),
(15, 'my9', 'Trần Hoàng Mỹ 9', '$2y$12$ltUt8pjbWb.wnzkCKivJCecaO6P0GJ/wa6JgB4DS0EOt6LMQh10E2', 'my9@gmail.com', '0788774326', '4', NULL, 1),
(16, 'my10', 'Trần Hoàng Mỹ 10', '$2y$12$yrXVRCf5O5t2ANRNF.HpLeoY/IfC7vpta8Y80ZPoH3D2rInddzLb6', 'my10@gmail.com', '0788774326', '4', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongbans`
--

CREATE TABLE `phongbans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiDung` bigint(20) UNSIGNED NOT NULL,
  `MaDonVi` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongbans`
--

INSERT INTO `phongbans` (`id`, `MaNguoiDung`, `MaDonVi`, `IsActive`) VALUES
(1, 7, 1, 1),
(2, 8, 1, 1),
(3, 7, 2, 1),
(4, 2, 1, 1),
(5, 3, 1, 1),
(6, 5, 1, 1),
(7, 6, 1, 1),
(8, 9, 1, 1),
(9, 10, 1, 1),
(10, 11, 1, 1),
(11, 12, 1, 1),
(12, 13, 1, 1),
(13, 14, 1, 1),
(14, 15, 1, 1),
(15, 16, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nsDPIuXwOlw3ZO71CeIdiihVMivxKclr4elTzeqU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiOUhUd2pzbkRZYjdFcFBwbUxyTndOWG9sYzNOT1ByOUZZTXpNREwxWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9JbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoiVGhvbmdCYW8iO2E6MDp7fXM6MTE6InNlc3Npb25Vc2VyIjtzOjIwOiJOZ3V54buFbiBOaMOibiBWacOqbiI7czoxMzoic2Vzc2lvblVzZXJJZCI7aTo1O3M6NzoiSXNBZG1pbiI7czoxOiI0Ijt9', 1725276969);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacvus`
--

CREATE TABLE `tacvus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiDung` bigint(20) UNSIGNED NOT NULL,
  `MaVaiTro` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tacvus`
--

INSERT INTO `tacvus` (`id`, `MaNguoiDung`, `MaVaiTro`, `IsActive`) VALUES
(1, 2, 2, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 3, 2, 1),
(5, 5, 1, 1),
(6, 3, 3, 1),
(7, 6, 1, 1),
(8, 7, 1, 1),
(9, 8, 1, 1),
(10, 9, 1, 1),
(11, 10, 1, 1),
(12, 8, 2, 1),
(13, 9, 2, 1),
(14, 10, 2, 1),
(15, 11, 2, 1),
(16, 12, 2, 1),
(17, 13, 2, 1),
(18, 14, 2, 1),
(19, 15, 2, 1),
(20, 16, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhviens`
--

CREATE TABLE `thanhviens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiDung` bigint(20) UNSIGNED NOT NULL,
  `MaDuAn` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhviens`
--

INSERT INTO `thanhviens` (`id`, `MaNguoiDung`, `MaDuAn`, `IsActive`) VALUES
(11, 2, 113, 1),
(12, 3, 113, 1),
(13, 5, 113, 1),
(14, 6, 113, 1),
(15, 10, 113, 1),
(16, 11, 113, 1),
(17, 12, 113, 1),
(18, 13, 113, 1),
(19, 14, 113, 1),
(20, 15, 113, 1),
(21, 16, 113, 1),
(22, 2, 114, 1),
(23, 3, 114, 1),
(24, 5, 114, 1),
(25, 6, 114, 1),
(26, 10, 114, 1),
(27, 11, 114, 1),
(28, 12, 114, 1),
(29, 13, 114, 1),
(30, 14, 114, 1),
(31, 15, 114, 1),
(32, 16, 114, 1),
(33, 2, 115, 1),
(34, 3, 115, 1),
(35, 5, 115, 1),
(36, 6, 115, 1),
(37, 7, 115, 1),
(38, 2, 116, 1),
(39, 3, 116, 1),
(40, 5, 116, 1),
(41, 6, 116, 1),
(42, 7, 116, 1),
(43, 8, 116, 1),
(44, 5, 117, 1),
(45, 2, 118, 1),
(46, 3, 118, 1),
(47, 5, 118, 1),
(48, 6, 118, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbaos`
--

CREATE TABLE `thongbaos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MaNguoiDung` bigint(20) UNSIGNED NOT NULL,
  `NoiDung` text NOT NULL,
  `ThoiGian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsSee` tinyint(1) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbaos`
--

INSERT INTO `thongbaos` (`id`, `MaNguoiDung`, `NoiDung`, `ThoiGian`, `IsSee`, `IsActive`) VALUES
(1, 2, '123', '2024-08-13 17:00:00', 0, 1),
(2, 6, 'thực hiện công việc A trước ngày 20/8', '2024-08-15 01:58:29', 0, 1),
(3, 6, 'thực hiện công việc A trước ngày 20/8', '2024-08-15 01:58:34', 0, 1),
(4, 6, '123', '2024-08-15 02:00:36', 0, 1),
(5, 6, '123', '2024-08-15 02:11:57', 0, 1),
(6, 6, '123456', '2024-08-15 02:13:15', 0, 1),
(7, 6, '123567', '2024-08-15 02:14:04', 0, 1),
(8, 6, '123456', '2024-08-15 02:24:09', 0, 1),
(9, 6, 'thao', '2024-08-15 02:25:00', 0, 1),
(10, 6, 'test 9h50', '2024-08-15 02:50:38', 0, 1),
(11, 6, 'nội dung mới', '2024-08-28 03:17:21', 0, 1),
(12, 6, '12312312312312 test', '2024-08-28 04:42:13', 0, 1),
(13, 6, 'test loading', '2024-08-28 04:44:31', 0, 1),
(14, 6, 'teststtt loading', '2024-08-28 04:50:13', 0, 1),
(15, 5, 'Chúng tôi xin chân thành xin lỗi vì sự bất tiện này.', '2024-08-28 11:35:40', 1, 1),
(16, 5, 'Chúng tôi xin chân thành xin lỗi vì sự bất tiện này. Vì một số lý do ngoài ý muốn, chúng tôi không thể hoàn thành [công việc/dự án/cuộc hẹn] đúng như dự kiến ban đầu vào ngày [ngày dự kiến ban đầu]. Chúng tôi hiện đang nỗ lực hết mình để hoàn thành [công việc/dự án] và dự kiến sẽ hoàn tất vào ngày [ngày mới dự kiến hoàn thành].\n\nChúng tôi rất mong nhận được sự thông cảm từ quý vị và sẽ cập nhật tình hình một cách nhanh chóng nhất có thể. Một lần nữa, chúng tôi xin lỗi vì sự chậm trễ này và hy vọng quý vị sẽ tiếp tục hợp tác cùng chúng tôi.\n\nTrân trọng,', '2024-08-28 11:36:00', 1, 1),
(17, 5, 'Chúng tôi xin nhắc nhở về thời hạn hoàn thành [công việc/dự án/cuộc hẹn] đã được lên kế hoạch vào ngày [ngày dự kiến ban đầu]. Để đảm bảo tiến độ và chất lượng công việc, chúng tôi mong muốn quý vị hoàn thành [công việc/dự án] đúng theo kế hoạch. Việc tuân thủ thời hạn không chỉ giúp dự án diễn ra suôn sẻ mà còn đảm bảo sự hài lòng của tất cả các bên liên quan. Chúng tôi rất mong quý vị hợp tác và hoàn tất công việc đúng thời gian đã thỏa thuận. Trân trọng,', '2024-08-28 11:36:17', 1, 1),
(18, 5, 'Chúng tôi xin nhắc nhở về thời hạn hoàn thành [công việc/dự án/cuộc hẹn] đã được lên kế hoạch vào ngày [ngày dự kiến ban đầu]. Để đảm bảo tiến độ và chất lượng công việc, chúng tôi mong muốn quý vị hoàn thành [công việc/dự án] đúng theo kế hoạch. Việc tuân thủ thời hạn không chỉ giúp dự án diễn ra suôn sẻ mà còn đảm bảo sự hài lòng của tất cả các bên liên quan. Chúng tôi rất mong quý vị hợp tác và hoàn tất công việc đúng thời gian đã thỏa thuận. Trân trọng,', '2024-08-28 11:36:28', 1, 1),
(19, 5, 'Chúng tôi xin nhắc nhở về thời hạn hoàn thành [công việc/dự án/cuộc hẹn] đã được lên kế hoạch vào ngày [ngày dự kiến ban đầu]. Để đảm bảo tiến độ và chất lượng công việc, chúng tôi mong muốn quý vị hoàn thành [công việc/dự án] đúng theo kế hoạch. Việc tuân thủ thời hạn không chỉ giúp dự án diễn ra suôn sẻ mà còn đảm bảo sự hài lòng của tất cả các bên liên quan. Chúng tôi rất mong quý vị hợp tác và hoàn tất công việc đúng thời gian đã thỏa thuận. Trân trọng,', '2024-08-29 04:38:54', 1, 1),
(20, 5, 'Test', '2024-08-29 11:06:43', 1, 1),
(21, 5, 'Chúng tôi xin nhắc nhở về thời hạn hoàn thành [công việc/dự án/cuộc hẹn] đã được lên kế hoạch vào ngày [ngày dự kiến ban đầu]. Để đảm bảo tiến độ và chất lượng công việc, chúng tôi mong muốn quý vị hoàn thành [công việc/dự án] đúng theo kế hoạch. Việc tuân thủ thời hạn không chỉ giúp dự án diễn ra suôn sẻ mà còn đảm bảo sự hài lòng của tất cả các bên liên quan. Chúng tôi rất mong quý vị hợp tác và hoàn tất công việc đúng thời gian đã thỏa thuận. Trân trọng,', '2024-09-02 16:02:42', 1, 1),
(22, 5, 'thảo test', '2024-09-02 16:02:41', 1, 1),
(23, 5, 'thảo test', '2024-09-02 16:02:46', 1, 1),
(24, 5, '123123', '2024-09-02 16:02:43', 1, 1),
(25, 5, 'bin tetstt', '2024-09-02 16:02:43', 1, 1),
(26, 5, 'mỹ testtt', '2024-09-02 16:02:44', 1, 1),
(27, 5, 'thảo thảo', '2024-09-02 16:02:44', 1, 1),
(28, 5, 'thảo thảo', '2024-09-02 16:02:44', 1, 1),
(29, 5, 'testtttt nè', '2024-09-02 16:02:45', 1, 1),
(30, 5, 'testtttt nè', '2024-09-02 16:02:45', 1, 1),
(31, 5, 'testttttt nè', '2024-09-02 16:02:35', 1, 1),
(32, 5, '123 tétttt', '2024-09-02 16:02:36', 1, 1),
(33, 5, '123 tétttt', '2024-09-02 16:02:39', 1, 1),
(34, 5, '1232132132322   tếttste', '2024-09-02 16:02:34', 1, 1),
(35, 5, '1 1 1 1 1', '2024-09-02 16:02:45', 1, 1),
(36, 5, '1 1 1 1 1', '2024-09-02 16:02:33', 1, 1),
(37, 5, '1 1 1 1 1', '2024-09-02 16:02:45', 1, 1),
(38, 5, '123 2 3 2323 23 têttse', '2024-09-02 16:02:32', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuchiens`
--

CREATE TABLE `thuchiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NgayBatDau` datetime NOT NULL,
  `NgayKetThuc` datetime NOT NULL,
  `ThuGiaiDoan` varchar(255) NOT NULL,
  `MaDuAn` bigint(20) UNSIGNED NOT NULL,
  `MaGiaiDoan` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsCongViec` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuchiens`
--

INSERT INTO `thuchiens` (`id`, `NgayBatDau`, `NgayKetThuc`, `ThuGiaiDoan`, `MaDuAn`, `MaGiaiDoan`, `IsActive`, `IsCongViec`) VALUES
(115, '2024-08-19 00:00:00', '2024-08-31 00:00:00', '1', 113, 1, 1, 1),
(116, '2024-08-19 00:00:00', '2024-08-31 00:00:00', '1', 114, 1, 1, 1),
(117, '2024-08-31 00:00:00', '2024-09-12 00:00:00', '2', 114, 2, 1, 1),
(118, '2024-09-12 00:00:00', '2024-09-24 00:00:00', '3', 114, 3, 1, 1),
(119, '2024-09-24 00:00:00', '2024-10-06 00:00:00', '4', 114, 4, 1, 1),
(120, '2024-08-21 00:00:00', '2024-09-12 00:00:00', '1', 115, 1, 1, 1),
(121, '2024-09-12 00:00:00', '2024-10-03 00:00:00', '2', 115, 2, 1, 0),
(122, '2024-10-03 00:00:00', '2024-10-26 00:00:00', '3', 115, 3, 1, 0),
(123, '2024-08-21 00:00:00', '2024-09-20 00:00:00', '1', 116, 1, 1, 1),
(124, '2024-09-20 00:00:00', '2024-10-29 00:00:00', '2', 116, 2, 1, 1),
(125, '2024-10-29 00:00:00', '2024-12-07 00:00:00', '3', 116, 3, 1, 1),
(126, '2024-08-27 00:00:00', '2024-08-29 00:00:00', '1', 117, 1, 1, 1),
(127, '2024-08-29 00:00:00', '2024-09-08 00:00:00', '1', 118, 1, 1, 1),
(128, '2024-09-08 00:00:00', '2024-09-18 00:00:00', '2', 118, 2, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitros`
--

CREATE TABLE `vaitros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TenVaiTro` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vaitros`
--

INSERT INTO `vaitros` (`id`, `TenVaiTro`, `IsActive`) VALUES
(1, 'Kiểm Thử', 1),
(2, 'Dev', 1),
(3, 'Thiết Kế', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `capnhattiendos`
--
ALTER TABLE `capnhattiendos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `capnhattiendos_magiaoviec_foreign` (`MaGiaoViec`);

--
-- Chỉ mục cho bảng `congviecs`
--
ALTER TABLE `congviecs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `congviecs_maduan_foreign` (`MaDuAn`),
  ADD KEY `congviecs_mathuchien_foreign` (`MaThucHien`),
  ADD KEY `congviecs_manguoitao_foreign` (`MaNguoiTao`);

--
-- Chỉ mục cho bảng `donvis`
--
ALTER TABLE `donvis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donvis_tendonvi_unique` (`TenDonVi`);

--
-- Chỉ mục cho bảng `duans`
--
ALTER TABLE `duans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `duans_manguoitao_foreign` (`MaNguoiTao`);

--
-- Chỉ mục cho bảng `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_macapnhattiendo_foreign` (`MaCapNhatTienDo`);

--
-- Chỉ mục cho bảng `giaidoans`
--
ALTER TABLE `giaidoans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giaidoans_tengiaidoan_unique` (`TenGiaiDoan`);

--
-- Chỉ mục cho bảng `giaoviecs`
--
ALTER TABLE `giaoviecs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giaoviecs_manguoidung_foreign` (`MaNguoiDung`),
  ADD KEY `giaoviecs_macongviec_foreign` (`MaCongViec`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguoidungs`
--
ALTER TABLE `nguoidungs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phongbans`
--
ALTER TABLE `phongbans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phongbans_manguoidung_foreign` (`MaNguoiDung`),
  ADD KEY `phongbans_madonvi_foreign` (`MaDonVi`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `tacvus`
--
ALTER TABLE `tacvus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tacvus_manguoidung_foreign` (`MaNguoiDung`),
  ADD KEY `tacvus_mavaitro_foreign` (`MaVaiTro`);

--
-- Chỉ mục cho bảng `thanhviens`
--
ALTER TABLE `thanhviens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thanhviens_manguoidung_foreign` (`MaNguoiDung`),
  ADD KEY `thanhviens_maduan_foreign` (`MaDuAn`);

--
-- Chỉ mục cho bảng `thongbaos`
--
ALTER TABLE `thongbaos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thongbaos_manguoidung_foreign` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `thuchiens`
--
ALTER TABLE `thuchiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thuchiens_maduan_foreign` (`MaDuAn`),
  ADD KEY `thuchiens_magiaidoan_foreign` (`MaGiaiDoan`);

--
-- Chỉ mục cho bảng `vaitros`
--
ALTER TABLE `vaitros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vaitros_tenvaitro_unique` (`TenVaiTro`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `capnhattiendos`
--
ALTER TABLE `capnhattiendos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `congviecs`
--
ALTER TABLE `congviecs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `donvis`
--
ALTER TABLE `donvis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `duans`
--
ALTER TABLE `duans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `giaidoans`
--
ALTER TABLE `giaidoans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `giaoviecs`
--
ALTER TABLE `giaoviecs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `nguoidungs`
--
ALTER TABLE `nguoidungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phongbans`
--
ALTER TABLE `phongbans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tacvus`
--
ALTER TABLE `tacvus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `thanhviens`
--
ALTER TABLE `thanhviens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `thongbaos`
--
ALTER TABLE `thongbaos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `thuchiens`
--
ALTER TABLE `thuchiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT cho bảng `vaitros`
--
ALTER TABLE `vaitros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `capnhattiendos`
--
ALTER TABLE `capnhattiendos`
  ADD CONSTRAINT `capnhattiendos_magiaoviec_foreign` FOREIGN KEY (`MaGiaoViec`) REFERENCES `giaoviecs` (`id`);

--
-- Các ràng buộc cho bảng `congviecs`
--
ALTER TABLE `congviecs`
  ADD CONSTRAINT `congviecs_maduan_foreign` FOREIGN KEY (`MaDuAn`) REFERENCES `duans` (`id`),
  ADD CONSTRAINT `congviecs_manguoitao_foreign` FOREIGN KEY (`MaNguoiTao`) REFERENCES `nguoidungs` (`id`),
  ADD CONSTRAINT `congviecs_mathuchien_foreign` FOREIGN KEY (`MaThucHien`) REFERENCES `thuchiens` (`id`);

--
-- Các ràng buộc cho bảng `duans`
--
ALTER TABLE `duans`
  ADD CONSTRAINT `duans_manguoitao_foreign` FOREIGN KEY (`MaNguoiTao`) REFERENCES `nguoidungs` (`id`);

--
-- Các ràng buộc cho bảng `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_macapnhattiendo_foreign` FOREIGN KEY (`MaCapNhatTienDo`) REFERENCES `capnhattiendos` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `giaoviecs`
--
ALTER TABLE `giaoviecs`
  ADD CONSTRAINT `giaoviecs_macongviec_foreign` FOREIGN KEY (`MaCongViec`) REFERENCES `congviecs` (`id`),
  ADD CONSTRAINT `giaoviecs_manguoidung_foreign` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidungs` (`id`);

--
-- Các ràng buộc cho bảng `phongbans`
--
ALTER TABLE `phongbans`
  ADD CONSTRAINT `phongbans_madonvi_foreign` FOREIGN KEY (`MaDonVi`) REFERENCES `donvis` (`id`),
  ADD CONSTRAINT `phongbans_manguoidung_foreign` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidungs` (`id`);

--
-- Các ràng buộc cho bảng `tacvus`
--
ALTER TABLE `tacvus`
  ADD CONSTRAINT `tacvus_manguoidung_foreign` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidungs` (`id`),
  ADD CONSTRAINT `tacvus_mavaitro_foreign` FOREIGN KEY (`MaVaiTro`) REFERENCES `vaitros` (`id`);

--
-- Các ràng buộc cho bảng `thanhviens`
--
ALTER TABLE `thanhviens`
  ADD CONSTRAINT `thanhviens_maduan_foreign` FOREIGN KEY (`MaDuAn`) REFERENCES `duans` (`id`),
  ADD CONSTRAINT `thanhviens_manguoidung_foreign` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidungs` (`id`);

--
-- Các ràng buộc cho bảng `thongbaos`
--
ALTER TABLE `thongbaos`
  ADD CONSTRAINT `thongbaos_manguoidung_foreign` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidungs` (`id`);

--
-- Các ràng buộc cho bảng `thuchiens`
--
ALTER TABLE `thuchiens`
  ADD CONSTRAINT `thuchiens_maduan_foreign` FOREIGN KEY (`MaDuAn`) REFERENCES `duans` (`id`),
  ADD CONSTRAINT `thuchiens_magiaidoan_foreign` FOREIGN KEY (`MaGiaiDoan`) REFERENCES `giaidoans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
