-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2025 at 06:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat_imitation`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_07_015217_m_user_migrate', 1),
(5, '2025_02_07_015309_m_surat_migrate', 1),
(6, '2025_02_07_015530_m_inbox_migrate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_inbox`
--

CREATE TABLE `m_inbox` (
  `inbox_id` bigint UNSIGNED NOT NULL,
  `sender` bigint UNSIGNED NOT NULL,
  `surat_id` bigint UNSIGNED NOT NULL,
  `receiver` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_inbox`
--

INSERT INTO `m_inbox` (`inbox_id`, `sender`, `surat_id`, `receiver`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 2, '2025-02-10 22:52:10', '2025-02-10 22:52:10'),
(7, 1, 3, 1, '2025-02-10 22:52:43', '2025-02-10 22:52:43'),
(8, 1, 3, 1, '2025-02-11 18:02:27', '2025-02-11 18:02:27'),
(9, 3, 12, 3, '2025-02-11 18:36:24', '2025-02-11 18:36:24'),
(10, 1, 5, 3, '2025-02-11 21:08:56', '2025-02-11 21:08:56'),
(11, 1, 17, 4, '2025-02-13 23:53:42', '2025-02-13 23:53:42'),
(12, 4, 17, 3, '2025-02-13 23:54:22', '2025-02-13 23:54:22'),
(13, 3, 17, 2, '2025-02-13 23:54:46', '2025-02-13 23:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `m_surat`
--

CREATE TABLE `m_surat` (
  `surat_id` bigint UNSIGNED NOT NULL,
  `kepada` bigint UNSIGNED NOT NULL,
  `tembusan` bigint UNSIGNED DEFAULT NULL,
  `pengirim` bigint UNSIGNED NOT NULL,
  `pemeriksa` bigint UNSIGNED DEFAULT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_surat`
--

INSERT INTO `m_surat` (`surat_id`, `kepada`, `tembusan`, `pengirim`, `pemeriksa`, `perihal`, `isi_surat`, `lampiran`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 1, 1, 'lkjadsflkhj lkajsdfhlawe lakjsdfh9e va', 'asdlkjh oviaushdvenkjn lvausdvklejn asdvasdfa', NULL, '2025-02-10 00:11:35', '2025-02-10 00:11:35'),
(5, 2, NULL, 1, NULL, 'asdfads as casdcasd a s da', 'as ac cawea ae ae fewfsfca asd casd ca cva r vc as', 'asset/lampiran/1739173106.jpg', '2025-02-10 00:38:26', '2025-02-10 00:38:26'),
(6, 1, NULL, 2, 1, 'percobaan ke beberapakali', 'kjashdf werkjhvzxoicuv asdfaemnfbasv asdjkfahefalkjadsh sadfasdviuadvhoas', 'asset/lampiran/1739235183.pdf', '2025-02-10 17:53:03', '2025-02-10 17:53:03'),
(12, 1, NULL, 3, NULL, 'qwertyui dfghjk vbnm, ghjkl', 'wertyui fghj wertyu vbnm rtyuio cvbnm,.', NULL, '2025-02-10 20:56:04', '2025-02-10 20:56:04'),
(17, 4, 2, 1, 3, 'percobaan untuk demo', 'pembuatan email untuk demo pada hari jumat', 'asset/lampiran/1739515999.jpg', '2025-02-13 23:53:19', '2025-02-13 23:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `username`, `email`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ricat', 'ricat@gmail.com', 'Rikat Setya Gusti', '$2y$12$uDdDaqioIJ7Z6wna2Pa2N.uqjWxF7COIFzu67iZczFpasYUY8yMoy', '2025-02-07 00:01:50', '2025-02-07 00:01:50'),
(2, 'nanda', 'nanda@gmail.com', 'Ananda Azharuddin', '$2y$12$yMZFIMxSoygblcezR6ANBemX.xRHl7RmH0VsltDuZc5iHS8IbSysW', '2025-02-09 19:36:39', '2025-02-09 19:36:39'),
(3, 'wisam', 'wisam@gmail.com', 'wisam ahmad', '$2y$12$zatgKjvOSQMnce7xkTHGC.e95GdvKLe4gNEjIUUFcL.er/KPLfTfC', '2025-02-10 18:50:59', '2025-02-10 18:50:59'),
(4, 'liya', 'liya@gmail.com', 'Liya Novitasari', '$2y$12$AATwu3WUTrIhY/wpPzBAduRwOe7Bv4xDwPqknu9LnekCINXcHZyU.', '2025-02-11 20:42:46', '2025-02-11 20:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vjsQ3tCYSEaexUzzPDIsYdwqFKTOwKILE5Ma13RR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiREQ0WjMwemhqa2laU2RPTm9lVU9YRWdDNTNRV3ZmUWQ2bmFFYXBJYSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cDovL2xvY2FsaG9zdC9zdXJhdF9pbWl0YXRpb24vcHVibGljIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Qvc3VyYXRfaW1pdGF0aW9uL3B1YmxpYy9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738908687);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_inbox`
--
ALTER TABLE `m_inbox`
  ADD PRIMARY KEY (`inbox_id`),
  ADD KEY `m_inbox_surat_id_index` (`surat_id`),
  ADD KEY `m_inbox_sender_index` (`sender`),
  ADD KEY `m_inbox_receiver_index` (`receiver`);

--
-- Indexes for table `m_surat`
--
ALTER TABLE `m_surat`
  ADD PRIMARY KEY (`surat_id`),
  ADD KEY `kepada_user` (`kepada`),
  ADD KEY `pemeriksa_user` (`pemeriksa`),
  ADD KEY `pengirim_user` (`pengirim`),
  ADD KEY `tembusan` (`tembusan`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD UNIQUE KEY `m_user_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_inbox`
--
ALTER TABLE `m_inbox`
  MODIFY `inbox_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_surat`
--
ALTER TABLE `m_surat`
  MODIFY `surat_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_inbox`
--
ALTER TABLE `m_inbox`
  ADD CONSTRAINT `m_inbox_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `m_surat` (`surat_id`),
  ADD CONSTRAINT `user_receiver` FOREIGN KEY (`receiver`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_sender` FOREIGN KEY (`sender`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `m_surat`
--
ALTER TABLE `m_surat`
  ADD CONSTRAINT `kepada_user` FOREIGN KEY (`kepada`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pemeriksa_user` FOREIGN KEY (`pemeriksa`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pengirim_user` FOREIGN KEY (`pengirim`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tembusan` FOREIGN KEY (`tembusan`) REFERENCES `m_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
