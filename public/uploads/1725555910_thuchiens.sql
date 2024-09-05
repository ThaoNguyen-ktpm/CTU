


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


INSERT INTO `thuchiens` (`id`, `NgayBatDau`, `NgayKetThuc`, `ThuGiaiDoan`, `MaDuAn`, `MaGiaiDoan`, `IsActive`, `IsCongViec`) VALUES
(116, '2024-08-19 00:00:00', '2024-08-31 00:00:00', '1', 114, 1, 1, 1),
(117, '2024-08-31 00:00:00', '2024-09-12 00:00:00', '2', 114, 2, 1, 1),
(118, '2024-09-12 00:00:00', '2024-09-24 00:00:00', '3', 114, 3, 1, 1),
(119, '2024-09-24 00:00:00', '2024-10-06 00:00:00', '4', 114, 4, 1, 1);


--
ALTER TABLE `thuchiens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thuchiens_maduan_foreign` (`MaDuAn`),
  ADD KEY `thuchiens_magiaidoan_foreign` (`MaGiaiDoan`);

-
ALTER TABLE `thuchiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

ALTER TABLE `thuchiens`
  ADD CONSTRAINT `thuchiens_maduan_foreign` FOREIGN KEY (`MaDuAn`) REFERENCES `duans` (`id`),
  ADD CONSTRAINT `thuchiens_magiaidoan_foreign` FOREIGN KEY (`MaGiaiDoan`) REFERENCES `giaidoans` (`id`);
COMMIT;
