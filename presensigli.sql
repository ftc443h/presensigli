-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 07:57 PM
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
-- Database: `presensigli`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sistem_web_karyawan_gli_cache_632ca39ecffdf43cdb8a86d8a5b5b33f', 'i:1;', 1753508237),
('sistem_web_karyawan_gli_cache_632ca39ecffdf43cdb8a86d8a5b5b33f:timer', 'i:1753508237;', 1753508237),
('sistem_web_karyawan_gli_cache_otp:fathimah3.0820.5fyn@gmail.com', 'i:1;', 1753508477),
('sistem_web_karyawan_gli_cache_otp:fathimah3.0820.5fyn@gmail.com:timer', 'i:1753508477;', 1753508477);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-06-13 20:32:42', '2025-06-13 20:32:42'),
(4, 'IT Support', '2025-06-18 20:41:43', '2025-06-18 20:41:43'),
(5, 'Marketing', '2025-06-18 20:41:54', '2025-06-18 20:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `name` varchar(225) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jabatan` varchar(45) NOT NULL,
  `lokasi_presensi` varchar(65) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `name`, `jenis_kelamin`, `alamat`, `no_hp`, `jabatan`, `lokasi_presensi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'KAR-0001', 'Fathimah N', 'perempuan', 'Jalan Mekar Jaya', '087645347645', 'Admin', 'Kantor Pusat', 'karyawan/fath.jpg', '2025-06-09 03:04:53', '2025-06-09 03:04:53'),
(2, 'KAR-0002', 'Ridho A', 'laki-laki', 'Jalan Mekar Asri', '087632457634', 'IT Support', 'Kantor Pusat', 'karyawan/ridho.jpg', '2025-06-09 03:05:20', '2025-06-09 03:05:20'),
(3, 'KAR-0003', 'Arga Mahendra', 'laki-laki', 'Jl. Sementara', '086745365342', 'Marketing', 'Kantor Pusat', 'karyawan/1750309384_006m.jpg', '2025-06-18 22:03:06', '2025-06-18 22:03:06'),
(4, 'KAR-0004', 'Raga Mahendra', 'laki-laki', 'Jl. Hidup', '086745363789', 'IT Support', 'Kantor Pusat', 'karyawan/1750310041_001m.jpg', '2025-06-18 22:14:01', '2025-07-07 03:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `ketidakhadiran`
--

CREATE TABLE `ketidakhadiran` (
  `id` int(11) NOT NULL,
  `keterangan` enum('Cuti','Sakit','Izin') NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status_pengajuan` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `karyawan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ketidakhadiran`
--

INSERT INTO `ketidakhadiran` (`id`, `keterangan`, `tanggal`, `deskripsi`, `file`, `status_pengajuan`, `created_at`, `updated_at`, `karyawan_id`) VALUES
(1, 'Cuti', '2025-06-29', 'Cuti lebaran', 'ketidakhadiran/1751166143_Screenshot (333).png', 'approved', '2025-06-29 03:02:24', '2025-06-29 08:46:26', 2),
(2, 'Sakit', '2025-07-14', 'Sakit', 'ketidakhadiran/1752397236_rekap_harian_2025-07-13_15-58-52.pdf', 'rejected', '2025-07-13 09:00:36', '2025-07-13 09:01:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_presensi`
--

CREATE TABLE `lokasi_presensi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(45) NOT NULL,
  `alamat_lokasi` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `radius` int(11) NOT NULL,
  `zona_waktu` varchar(4) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_presensi`
--

INSERT INTO `lokasi_presensi` (`id`, `nama_lokasi`, `alamat_lokasi`, `latitude`, `longitude`, `radius`, `zona_waktu`, `jam_masuk`, `jam_pulang`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Pusat', 'Jl. Kasturi Raya', '-6.384198116453103', '106.98915724163342', 200, 'WIB', '07:30:00', '19:00:00', '2025-06-18 17:30:12', '2025-07-07 03:44:44');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `foto_masuk` varchar(255) NOT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `foto_keluar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `karyawan_id` int(11) NOT NULL,
  `lokasi_presensi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `tanggal_masuk`, `jam_masuk`, `foto_masuk`, `tanggal_keluar`, `jam_keluar`, `foto_keluar`, `created_at`, `updated_at`, `karyawan_id`, `lokasi_presensi_id`) VALUES
(1, '2025-06-27', '19:14:41', 'presensi/foto_masuk/KAR-0002-2025-06-27.png', '2025-06-27', '19:15:12', 'presensi/foto_keluar/KAR-0002-2025-06-27.png', '2025-06-27 05:14:42', '2025-06-27 05:15:12', 2, 1),
(2, '2025-06-28', '06:49:02', 'presensi/foto_masuk/KAR-0002-2025-06-28.png', '2025-06-28', '19:59:41', 'presensi/foto_keluar/KAR-0002-2025-06-28.png', '2025-06-27 16:49:03', '2025-06-28 12:59:41', 2, 1),
(3, '2025-06-28', '18:33:06', 'presensi/foto_masuk/KAR-0004-2025-06-28.png', '2025-06-28', '19:55:56', 'presensi/foto_keluar/KAR-0004-2025-06-28.png', '2025-06-28 11:33:07', '2025-06-28 12:55:56', 4, 1),
(4, '2025-07-02', '12:23:04', 'presensi/foto_masuk/KAR-0001-2025-07-02.png', NULL, NULL, NULL, '2025-07-02 05:23:05', '2025-07-02 05:23:05', 1, 1),
(5, '2025-07-04', '10:35:40', 'presensi/foto_masuk/KAR-0001-2025-07-04.png', NULL, NULL, NULL, '2025-07-04 03:35:40', '2025-07-04 03:35:40', 1, 1),
(6, '2025-07-06', '11:29:14', 'presensi/foto_masuk/KAR-0001-2025-07-06.png', NULL, NULL, NULL, '2025-07-06 04:29:15', '2025-07-06 04:29:15', 1, 1),
(7, '2025-07-12', '07:13:44', 'presensi/foto_masuk/KAR-0001-2025-07-12.png', NULL, NULL, NULL, '2025-07-12 00:13:44', '2025-07-12 00:13:44', 1, 1),
(8, '2025-07-13', '15:35:16', 'presensi/foto_masuk/KAR-0002-2025-07-13.png', NULL, NULL, NULL, '2025-07-13 08:35:16', '2025-07-13 08:35:16', 2, 1),
(9, '2025-07-13', '15:55:04', 'presensi/foto_masuk/KAR-0001-2025-07-13.png', NULL, NULL, NULL, '2025-07-13 08:55:04', '2025-07-13 08:55:04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EGSpTby1GMbe1fD7jx6SwahafsRohdBhgJ7HU3cD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGQwT0o4WmE0dE55Uk5ScHppQ2FReHJqQVhtOUJFR2ZBNTF2OFYwdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly8xMjcuMC4wLjE6OTI3Ijt9czo5OiJvdHBfZW1haWwiO3M6Mjk6ImZhdGhpbWFoMy4wODIwLjVmeW5AZ21haWwuY29tIjt9', 1753508586);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `role` enum('admin','karyawan') DEFAULT 'admin',
  `status` enum('active','banned') DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`, `karyawan_id`) VALUES
(1, 'Fathimah', 'fathimah@globallintas2025', 'fathimah3.0820.5fyn@gmail.com', '2025-07-26 05:22:59', '$2y$12$j4bQpBK2Vq1XFXsG6cnXuucT2OKokE9jS40deGHr8wBoqyR2SNRJi', 'admin', 'active', 'aOP1tliHpkqoBpsyKpNGlwfd207Z7pxzTXQzrycEJpPbI6SaGucQw1UvYxZM', '2025-06-07 16:14:41', '2025-07-26 05:22:59', 1),
(2, 'Ridho', 'ridho@globallintas2025', 'ridho.global.lintas@gmail.com', '2025-07-24 03:44:23', '$2y$12$GiU5WgeTxEAMfC3MKyK0ROg4Eq6HnoOXOY0uATUWNn.DrubjX5Eou', 'karyawan', 'active', '2gRH8k7eiuFrApBapcCi1fHgjU2M72s3bs3pOUz1TwHyxqLzeLFyvctvgbEs', '2025-06-07 16:14:41', '2025-06-07 16:14:41', 2),
(3, NULL, 'arga@globallintas2025', 'arga@gmail.com', '2025-06-19 05:08:13', '$2y$12$uGgd0QMV1KZH6GLXSrpzpuFwvS5zn1HFiarsmfVvgP5b.ubnG71Cy', 'karyawan', 'active', NULL, '2025-06-18 22:03:06', '2025-06-18 22:03:06', 3),
(4, NULL, 'raga@globallintas2025', 'raga@gmail.com', '2025-07-07 03:36:46', '$2y$12$NN8HiTeY3BecnMG9hI02r.VSiTBbVbFB3OMABnql0dbZLYJduDT26', 'karyawan', 'active', NULL, '2025-06-18 22:14:01', '2025-07-07 03:36:46', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `ketidakhadiran`
--
ALTER TABLE `ketidakhadiran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_ketidakhadiran_karyawan1_idx` (`karyawan_id`);

--
-- Indexes for table `lokasi_presensi`
--
ALTER TABLE `lokasi_presensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_presensi_karyawan1_idx` (`karyawan_id`),
  ADD KEY `fk_presensi_lokasi_presensi1_idx` (`lokasi_presensi_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`username`),
  ADD KEY `fk_users_karyawan_idx` (`karyawan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ketidakhadiran`
--
ALTER TABLE `ketidakhadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lokasi_presensi`
--
ALTER TABLE `lokasi_presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ketidakhadiran`
--
ALTER TABLE `ketidakhadiran`
  ADD CONSTRAINT `fk_ketidakhadiran_karyawan1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `fk_presensi_karyawan1` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_presensi_lokasi_presensi1` FOREIGN KEY (`lokasi_presensi_id`) REFERENCES `lokasi_presensi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_karyawan` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
