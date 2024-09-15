-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 09, 2024 lúc 05:46 PM
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
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `DuongDanFile` varchar(255) NOT NULL,
  `MaCapNhatTienDo` bigint(20) UNSIGNED NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `ThoiGianNop` datetime DEFAULT NULL,
  `TenFile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`id`, `DuongDanFile`, `MaCapNhatTienDo`, `IsActive`, `ThoiGianNop`, `TenFile`) VALUES
(1, 'uploads/1725110097_Bao cao QLTTNH-TH Ver 1.docx', 10, 1, '2024-08-30 00:00:00', 'Bao cao QLTTNH-TH Ver 1.docx'),
(2, 'uploads/1725110097_fileWord.docx', 10, 1, '2024-08-30 00:00:00', 'fileWord.docx'),
(3, 'uploads/1725110097_mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx', 10, 1, '2024-08-30 00:00:00', 'mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx'),
(4, 'uploads/1725110097_mau_dang_ki_B1 khóa 1 Lớp 1_Tiếng Anh B1_20240502_020307.xlsx', 10, 1, '2024-08-30 00:00:00', 'mau_dang_ki_B1 khóa 1 Lớp 1_Tiếng Anh B1_20240502_020307.xlsx'),
(5, 'uploads/1725110703_NguyenVanThao_2001255_TH_B4.rar', 13, 1, '2024-08-30 00:00:00', 'NguyenVanThao_2001255_TH_B4.rar'),
(6, 'uploads/1725110703_mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx', 13, 1, '2024-08-30 00:00:00', 'mau_dang_ki_Lớp Av_Anhvan1_20240510_024601.xlsx'),
(7, 'uploads/1725110703_thảoword.docx', 13, 1, '2024-08-30 00:00:00', 'thảoword.docx'),
(8, 'uploads/1725110703_BaoCaoYeuCauDatTa.docx', 13, 1, '2024-08-30 00:00:00', 'NguyenHuynhDangKhoa.docx'),
(9, 'uploads/1725113466_BaoCaoYeuCauDatTa.docx', 14, 1, '2024-08-30 07:08:00', 'NguyenHuynhDangKhoa.docx'),
(15, 'uploads/1725266238_2000985_NguyenHuynhDangKhoa.docx', 14, 1, '2024-08-30 00:00:00', 'NguyenHuynhDangKhoa.docx'),
(16, 'uploads/1725266238_GIS ontappppppppp.docx', 14, 1, '2024-08-30 00:00:00', 'GIS ontappppppppp.docx'),
(17, 'uploads/1725266285_Thảo_Lab2.docx', 20, 1, '2024-08-30 00:00:00', 'Thảo_Lab2.docx'),
(18, 'uploads/1725287210_fileWord.docx', 10, 1, '2024-08-30 00:00:00', 'fileWord.docx'),
(19, 'uploads/1725287243_Bao cao QLTTNH-TH Ver 1.docx', 10, 1, '2024-08-30 00:00:00', 'Bao cao QLTTNH-TH Ver 1.docx'),
(20, 'uploads/1725526163_fileWord.docx', 14, 1, '2024-08-30 00:00:00', 'fileWord.docx'),
(21, 'uploads/1725531969_thuchiens.sql', 20, 1, '2024-08-30 00:00:00', 'thuchiens.sql'),
(22, 'uploads/1725531969_ctu1.sql', 20, 1, '2024-08-30 00:00:00', 'ctu1.sql'),
(23, 'uploads/1725531969_fileWord.docx', 20, 1, '2024-08-30 00:00:00', 'fileWord.docx'),
(24, 'uploads/1725535049_Bao cao QLTTNH-TH Ver 1.docx', 20, 1, '2024-08-30 00:00:00', 'Bao cao QLTTNH-TH Ver 1.docx'),
(25, 'uploads/1725535049_fileWord.docx', 20, 1, '2024-08-30 00:00:00', 'fileWord.docx'),
(26, 'uploads/1725555910_thuchiens.sql', 13, 1, '2024-08-30 00:00:00', 'thuchiens.sql'),
(27, 'uploads/1725555910_ctu1.sql', 13, 1, '2024-08-30 00:00:00', 'ctu1.sql');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_macapnhattiendo_foreign` (`MaCapNhatTienDo`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_macapnhattiendo_foreign` FOREIGN KEY (`MaCapNhatTienDo`) REFERENCES `capnhattiendos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
