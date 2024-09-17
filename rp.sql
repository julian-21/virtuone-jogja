-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 05:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rp`
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
-- Table structure for table `formulirs`
--

CREATE TABLE `formulirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `namainstansi` varchar(255) NOT NULL,
  `nomorhp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `keluhan` text NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_fix` date DEFAULT NULL,
  `kode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jam` varchar(12) DEFAULT NULL,
  `jam_fix` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formulirs`
--

INSERT INTO `formulirs` (`id`, `nama`, `nip`, `jabatan`, `namainstansi`, `nomorhp`, `email`, `keluhan`, `tanggal`, `tanggal_fix`, `kode`, `created_at`, `updated_at`, `jam`, `jam_fix`) VALUES
(62, 'Fikri Julian Febrianto', '2131413', 'Direktur', 'Amikom', '1340137097409132542', 'fikrijulianfebrianto@yahoo.co.id', 'kasdiohebnksbfsdf', '2023-09-20', '2023-09-20', '650A4D04', '2023-09-19 18:38:12', '2023-09-19 18:38:12', '', '1'),
(63, 'Julian', '12345678', 'Direktur', 'Untirta', '1340137097409132542', 'jfikri212@gmail.com', 'bismillah ya allah', '2023-09-20', '2023-09-20', '650A4DE9', '2023-09-19 18:42:01', '2023-09-19 18:42:01', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `formulir_jam`
--

CREATE TABLE `formulir_jam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulir_id` bigint(20) UNSIGNED NOT NULL,
  `jam_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jams`
--

CREATE TABLE `jams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jam` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jams`
--

INSERT INTO `jams` (`id`, `jam`, `created_at`, `updated_at`) VALUES
(1, '09:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(2, '10:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(3, '11:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(4, '13:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(5, '14:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(6, '15:00:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_14_033329_create_formulirs_table', 1),
(6, '2023_09_14_033523_create_jams_table', 2),
(7, '2023_09_14_033614_create_formulir_jam_table', 3),
(8, '2023_09_14_060718_add_jam_to_formulirs_table', 4),
(9, '2023_09_15_182007_create_zooms_table', 5),
(10, '2023_09_18_025208_create_zooms_table', 6),
(11, '2023_09_18_072316_create_zooms_table', 7),
(12, '2023_09_18_154143_create_zooms_table', 8);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zooms`
--

CREATE TABLE `zooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL,
  `link_zoom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zooms`
--

INSERT INTO `zooms` (`id`, `meeting_id`, `passcode`, `link_zoom`, `created_at`, `updated_at`) VALUES
(1, '17823685129748012356423', 'jbajSGd7915287612', 'https://www.google.com/search?q=link+zoom&oq=link+zoom+&aqs=chrome..69i57j0i512l9.4048j0j7&sourceid=chrome&ie=UTF-8', '2023-09-18 08:44:35', '2023-09-18 08:44:57');

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
-- Indexes for table `formulirs`
--
ALTER TABLE `formulirs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `formulirs_kode_unique` (`kode`);

--
-- Indexes for table `formulir_jam`
--
ALTER TABLE `formulir_jam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulir_jam_formulir_id_foreign` (`formulir_id`),
  ADD KEY `formulir_jam_jam_id_foreign` (`jam_id`);

--
-- Indexes for table `jams`
--
ALTER TABLE `jams`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zooms`
--
ALTER TABLE `zooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulirs`
--
ALTER TABLE `formulirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `formulir_jam`
--
ALTER TABLE `formulir_jam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jams`
--
ALTER TABLE `jams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zooms`
--
ALTER TABLE `zooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formulir_jam`
--
ALTER TABLE `formulir_jam`
  ADD CONSTRAINT `formulir_jam_formulir_id_foreign` FOREIGN KEY (`formulir_id`) REFERENCES `formulirs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `formulir_jam_jam_id_foreign` FOREIGN KEY (`jam_id`) REFERENCES `jams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
