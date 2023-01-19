-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 12:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen_gaji`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_karyawan` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nm_karyawan`, `tgl_masuk`, `alamat`, `no_hp`, `posisi`, `created_at`, `updated_at`) VALUES
(2, 'uhuy', '2022-06-26', 'jl. alalak selatan', '0896232323', 'tes', '2022-06-26 04:50:43', '2022-06-26 04:50:43'),
(3, 'niken', '2022-06-26', 'Jl. Kuin Utara', '0896232323', 'staff', '2022-06-26 04:51:33', '2022-06-26 04:51:33'),
(23, 'Sidiq', '2010-04-15', '', '', 'Presiden', '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(24, 'Tasdik', '1996-06-01', '', '', 'Apoteker', '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(25, 'Aisyah', '1997-01-08', '', '', 'Penulis', '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(26, 'Daruna', '1976-03-25', 'Jl. Pasir Mas', '0852343434', 'Admin', '2022-07-15 13:22:22', '2022-07-15 13:25:24'),
(27, 'Umar', '2018-05-20', '', '', 'Kondektur', '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(28, 'Prayoga', '2001-02-21', '', '', 'Tukang Kayu', '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(29, 'Kuncara', '2009-03-04', '', '', 'Wakil Presiden', '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(30, 'Rini', '2019-10-02', '', '', 'Peneliti', '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(31, 'Eko', '1971-09-21', '', '', 'Pialang', '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(32, 'Yadi', '2022-08-01', 'jl. alalak selatan', '0896232323', 'Pegawai', '2022-08-01 10:50:57', '2022-08-01 11:01:28'),
(33, 'Maman Sebijian', '2022-08-01', 'jl. alalak selatan', '0896232323', 'Pegawai', '2022-08-01 11:49:27', '2022-08-01 11:50:10');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_03_043428_create_karyawans_table', 1),
(6, '2022_06_08_133821_create_tb_status', 2),
(7, '2022_06_08_133912_create_tb_absen', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `admin` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id_absen`, `id_karyawan`, `status`, `tgl`, `id_lokasi`, `admin`, `created_at`, `updated_at`) VALUES
(1, 2, 'M', '2022-06-26', 2, 'uhuy', '2022-06-26 05:25:05', '2022-06-26 05:25:05'),
(3, 2, 'M', '2022-06-01', 2, 'uhuy', '2022-06-26 05:25:22', '2022-07-14 11:12:51'),
(4, 2, 'M', '2022-06-27', 2, 'uhuy', '2022-06-26 13:11:55', '2022-06-26 13:11:55'),
(5, 3, 'M', '2022-06-10', 2, 'Aldi', '2022-07-14 11:12:32', '2022-07-14 11:12:32'),
(6, 3, 'M', '2022-06-18', 2, 'Aldi', '2022-07-14 11:12:40', '2022-07-14 11:12:40'),
(7, 3, 'M', '2022-06-20', 2, 'Aldi', '2022-07-14 11:13:36', '2022-07-14 11:13:36'),
(8, 32, 'M', '2022-08-01', 2, 'Aldi', '2022-08-01 10:52:19', '2022-08-01 10:52:19'),
(9, 33, 'M', '2022-08-01', 2, 'Aldi', '2022-08-01 11:49:40', '2022-08-01 11:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_denda`
--

CREATE TABLE `tb_denda` (
  `id_denda` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_denda`
--

INSERT INTO `tb_denda` (`id_denda`, `tgl`, `id_karyawan`, `ket`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, '2022-06-26', 3, 'fdg', 100000, '2022-06-26 05:50:25', '2022-07-14 11:13:18'),
(5, '2022-06-28', 2, NULL, 50000, '2022-06-26 06:03:10', '2022-06-26 06:19:29'),
(6, '2022-06-14', 2, 'denda lagi', 50000, '2022-07-14 11:44:43', '2022-07-14 11:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `rp_gaji` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gaji`
--

INSERT INTO `tb_gaji` (`id_gaji`, `id_karyawan`, `rp_gaji`, `created_at`, `updated_at`) VALUES
(1, 2, 100000, '2022-06-26 05:10:15', '2022-06-26 05:10:15'),
(2, 3, 50000, '2022-06-26 05:10:44', '2022-06-26 05:10:44'),
(22, 23, 100000, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(23, 24, 100000, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(24, 25, 100000, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(25, 26, 100000, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(26, 27, 100000, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(27, 28, 100000, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(28, 29, 100000, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(29, 30, 100000, '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(30, 31, 100000, '2022-07-15 13:22:24', '2022-07-15 13:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kasbon`
--

CREATE TABLE `tb_kasbon` (
  `id_kasbon` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `tgl` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kasbon`
--

INSERT INTO `tb_kasbon` (`id_kasbon`, `id_karyawan`, `jumlah`, `ket`, `tgl`, `created_at`, `updated_at`) VALUES
(1, 2, 100000, NULL, '2022-06-26', '2022-06-26 04:51:09', '2022-06-26 06:19:37'),
(2, 3, 20000, NULL, '2022-06-26', '2022-06-26 04:51:55', '2022-07-14 11:26:30'),
(3, 2, 10000, 'tes', '2022-06-15', '2022-07-15 12:33:13', '2022-07-15 12:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(10) UNSIGNED NOT NULL,
  `nm_gudang` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `nm_gudang`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(2, 'Gudang 1', 'Jl. Adiyaksa No.21', '0895413122323', '2022-06-12 02:05:36', '2022-06-12 02:05:36'),
(3, 'Gudang 2', 'Jl. Jafri Zam - Zam Komp. Persada No. 158', '0852483635232', '2022-06-12 02:06:07', '2022-06-12 02:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `ket` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `status`, `ket`, `created_at`, `updated_at`) VALUES
(1, 'M', 'Masuk', '2022-06-08 06:06:20', '2022-06-08 06:09:22'),
(4, 'S', 'Sakit', '2022-06-10 04:29:54', '2022-06-19 02:03:21'),
(5, 'I', 'Izin', '2022-06-19 02:03:02', '2022-06-19 02:03:02'),
(6, 'OFF', 'Tidak Hadir', '2022-06-19 02:03:40', '2022-06-19 02:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Aldi', 'aldi', NULL, '$2y$10$4v/wxR9hKbTyZUTUo0ZBzOzhP1J8.QxHlkLq/mSi97P0OZ8HZ2AR.', 1, NULL, '2022-06-19 02:39:51', '2022-06-19 02:39:51'),
(8, 'uhuy', 'uhuy', NULL, '$2y$10$22YT5p5wEzEVmKd28d/TLeKtuM8T1zNiLebDspXafxvC7DMafJBv6', 3, NULL, '2022-06-26 04:50:43', '2022-06-26 04:50:43'),
(9, 'niken', 'niken', NULL, '$2y$10$NJJpcOKGKyldWnU8cpyX9.IV2Ic0u1pJ1TqLAv1u5On0PVIISfyDm', 3, NULL, '2022-06-26 04:51:33', '2022-06-26 04:51:33'),
(10, 'wahyu', 'wahyu', NULL, '$2y$10$wTiHoYyCi9eJFZjofMXOsOjgKjKqN526/QS3Oc4t1DF/J70/bOAve', 2, NULL, '2022-06-26 13:18:04', '2022-06-26 13:18:04'),
(11, 'Keisha', 'putu', NULL, '$2y$10$BxJwDwjS7Ug501esguYWzueIdv4z7QFXh7SJ.wLlwBKhwntGr16ym', 3, NULL, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(12, 'Hamima', 'rina', NULL, '$2y$10$VsCN6euSMabUOWy3g6OtHuAQlv4xTRs4xJthGRIK1RGjvREIlh63a', 3, NULL, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(13, 'Maimunah', 'anom', NULL, '$2y$10$1.qnJEsWdeOzNkRacmnXzeiJMw6kGYomsQxqjFaY7hwiiwPi6lOr6', 3, NULL, '2022-07-15 13:22:22', '2022-07-15 13:22:22'),
(14, 'Zizi', 'makara', NULL, '$2y$10$itry4Y0ilEVx6ASmuu57jeN0TzJ8PLeZ5271Wr55kGij3C7lC6Jz.', 3, NULL, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(15, 'Darmaji', 'danu', NULL, '$2y$10$MoyWgE9hvRmY2anNYpmEjO5Dr2uT/OQ2ZfR/Qy.w8tzkTSdO7A/8a', 3, NULL, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(16, 'Febi', 'kasusra', NULL, '$2y$10$4y.UHwGxdgtAAGZMmVkkSOq4I7ch/AKMC21tOcHb/XUV5SraOkrR6', 3, NULL, '2022-07-15 13:22:23', '2022-07-15 13:22:23'),
(17, 'Tina', 'murti', NULL, '$2y$10$UlzKq85gyNRu4y/Hrol8S.uJcHCkb74xWUh.sIBiQpZndiFfRbYia', 3, NULL, '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(18, 'Ifa', 'cawuk', NULL, '$2y$10$q.pypUV5gdWHsnVgwlpLWeI4KH937Kba3XCGPLbcSngGLRG/kE3ZK', 3, NULL, '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(19, 'Clara', 'ina', NULL, '$2y$10$2BuWcJChVfezKr3wCYhJ6uPMMllT/YXXel1tobe92XGFO3FaPtdNC', 3, NULL, '2022-07-15 13:22:24', '2022-07-15 13:22:24'),
(20, 'Yadi', 'yani', NULL, '$2y$10$UYj1lAr3l8nz.7XLoS7e5eHFognsOidBfS15MWrOVgZHkY7TKaS6u', 3, NULL, '2022-08-01 10:50:57', '2022-08-01 11:01:28'),
(21, 'Maman Sebijian', 'maman', NULL, '$2y$10$JEJTa5AvkgUGmm3.eMZjHORm55cFNOjqQwrzVwYMZO9XIVL9cgHMO', 3, NULL, '2022-08-01 11:49:27', '2022-08-01 11:50:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `tb_denda`
--
ALTER TABLE `tb_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `tb_kasbon`
--
ALTER TABLE `tb_kasbon`
  ADD PRIMARY KEY (`id_kasbon`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id_absen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_denda`
--
ALTER TABLE `tb_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_kasbon`
--
ALTER TABLE `tb_kasbon`
  MODIFY `id_kasbon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
