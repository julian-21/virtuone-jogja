-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 07:15 AM
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
-- Table structure for table `coachings`
--

CREATE TABLE `coachings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `elemenmanajemen` varchar(50) DEFAULT NULL,
  `unitkerja` varchar(255) DEFAULT NULL,
  `nomorhp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_fix` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jam` varchar(12) DEFAULT NULL,
  `jam_fix` varchar(5) DEFAULT NULL,
  `zoom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `va_id` int(10) UNSIGNED DEFAULT NULL,
  `petugas_id` int(10) UNSIGNED DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coachings`
--

INSERT INTO `coachings` (`id`, `nama`, `nip`, `jabatan`, `elemenmanajemen`, `unitkerja`, `nomorhp`, `email`, `tanggal`, `tanggal_fix`, `tanggal_selesai`, `kode`, `created_at`, `updated_at`, `jam`, `jam_fix`, `zoom_id`, `va_id`, `petugas_id`, `gambar`, `is_completed`) VALUES
(215, 'KOMARIAH', '123152342245', 'Admin', '1', '6419', '2343141242343', 'kodaihsdjkabd@gmail.com', '2023-12-06', '2023-01-01', NULL, '656FFB02', '2023-12-05 21:39:30', '2023-12-17 20:35:01', '2', '1', 1, 2, 20, NULL, 0),
(216, 'KATMADI', '123152342245', 'Admin', '1', '6419', '2343141242343', 'kodaihsdjkabd@gmail.com', '2023-12-06', '2023-12-06', NULL, '656FFB4D', '2023-12-05 21:40:45', '2023-12-06 23:31:53', '4', '1', 1, 2, 3, '1701930713.pdf', 0),
(217, 'TRIA MERINA', '199304082020122010', 'Analis Kinerja', '25', '6408', '089652973177', 'triamerina@gmail.com', '2023-12-10', '2023-12-12', NULL, '65701980', '2023-12-05 23:49:36', '2023-12-06 23:27:51', '1', '1', 1, NULL, 3, '1701930419.xlsx', 0),
(219, 'FIKRI JULIAN', '12314134', 'absdjaksdasd', '3', '6421', '0129190273142', 'jfikri2152@gmail.com', '2023-12-22', '2023-12-22', NULL, '65707715', '2023-12-07 06:28:53', '2023-12-08 09:49:48', '5', '3', 1, NULL, 6, NULL, 0),
(221, 'ALBERTT', '213813269814', 'Mukiashdjadw', '24', '6301', '910943710368940134', 'jfikri212@gmail.com', '2023-12-07', '2023-01-18', NULL, '65712546', '2023-12-06 18:52:06', '2023-12-17 20:24:30', '6', '1', 1, 2, 20, '1701930703.xlsx', 0),
(222, 'ANT ARI PRASETYADI', '111111111111111', '-', '2', '6300', '0822222222222', 'AntAri@gmail.com', '2023-12-07', '2023-12-07', NULL, '65713A2C', '2023-12-06 20:21:16', '2023-12-06 20:21:16', '5', '5', 4, NULL, NULL, NULL, 0),
(223, 'NURYADIN', '111111111111', 'audiman asn', '11', '6476', '08127272727', 'gagagag@gmail.com', '2023-12-08', '2023-12-08', NULL, '6572BDF8', '2023-12-07 23:55:52', '2023-12-07 23:55:52', '6', '6', 4, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coaching_jam`
--

CREATE TABLE `coaching_jam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coaching_id` bigint(20) UNSIGNED NOT NULL,
  `jam_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaching_materi`
--

CREATE TABLE `coaching_materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coaching_materi`
--

INSERT INTO `coaching_materi` (`id`, `nama_materi`, `created_at`, `updated_at`) VALUES
(1, 'Penyusunan dan Penetapan Kebutuhan ASN', NULL, NULL),
(2, 'Pengadaan ASN', NULL, NULL),
(3, 'Pengangkatan ASN', NULL, NULL),
(4, 'Jabatan', NULL, NULL),
(5, 'Pangkat', NULL, NULL),
(6, 'Pola Karier', NULL, NULL),
(7, 'Pengembangan Karier ASN', NULL, NULL),
(8, 'Mutasi', NULL, NULL),
(9, 'Penilaian Kinerja', NULL, NULL),
(10, 'Penghargaan', NULL, NULL),
(11, 'Disiplin', NULL, NULL),
(12, 'Cuti', NULL, NULL),
(13, 'Kode Etik', NULL, NULL),
(14, 'Pemberhentian', NULL, NULL),
(15, 'Jaminan Pensiun dan Hari Tua', NULL, NULL),
(16, 'Penggajian, Tunjangan, dan Fasilitasi', NULL, NULL),
(17, 'Pensiun', NULL, NULL),
(18, 'Perlindungan', NULL, NULL),
(19, 'Hot Topic - Sistem Kerja Pada Instansi Pemerintah untuk Penyederhanaan Birokrasi', NULL, '2023-11-01 01:39:51'),
(20, 'Hot Topic - Manajemen Talenta ', NULL, '2023-11-01 01:39:51'),
(21, 'Hot Topic - BerAKHLAK ', NULL, '2023-11-01 01:39:51'),
(22, 'Hot Topic - KORPRI', NULL, '2023-11-01 01:39:51'),
(23, 'Hot Topic - Indeks NSPK', NULL, '2023-11-01 01:39:51'),
(24, 'Hot Topic - Penugasan ASN pada Instansi Pemerintah dan di luar Instansi Pemerintah ', NULL, '2023-11-01 01:39:51'),
(25, 'Hot Topic - Jabatan Fungsional', NULL, '2023-11-01 01:39:51');

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
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `unitkerja` varchar(255) DEFAULT NULL,
  `nomorhp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_fix` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jam` varchar(12) DEFAULT NULL,
  `jam_fix` varchar(5) DEFAULT NULL,
  `zoom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `va_id` int(10) UNSIGNED DEFAULT NULL,
  `petugas_id` int(10) UNSIGNED DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formulirs`
--

INSERT INTO `formulirs` (`id`, `nama`, `nip`, `jabatan`, `unitkerja`, `nomorhp`, `email`, `keluhan`, `tanggal`, `tanggal_fix`, `tanggal_selesai`, `kode`, `created_at`, `updated_at`, `jam`, `jam_fix`, `zoom_id`, `va_id`, `petugas_id`, `gambar`, `is_completed`) VALUES
(202, 'AULIA', '198201282015032001', 'asesor', '6423', '08174106299', 'auliliaro@gmail.com', 'prosedur CACT', '2023-09-06', '2023-12-12', '2023-12-06', '657014C1', '2023-12-05 23:29:21', '2023-12-05 23:39:09', '2', '1', 1, 2, 3, '1701844728.png', 1),
(214, 'DAFAFA', 'adjsbajksbdjadw', 'asdadwdw', '6421', '12312314141313', 'mukidi@gmail.com', 'komariah', '2023-12-30', '2023-12-30', NULL, '6570A6D1', '2023-12-06 09:52:33', '2023-12-06 18:35:20', '5', '1', 1, NULL, 6, NULL, 0),
(215, 'GUNAWAN CHAYADI', '901703461083414', 'Topi Kuning', '6405', '0810923741809634', 'mukidi@gmail.com', 'jkagsdvsvdknavdkwhadaeef', '2023-12-07', '2023-12-07', NULL, '657125B3', '2023-12-06 18:53:55', '2023-12-06 18:53:55', '5', '5', 4, NULL, NULL, NULL, 0),
(216, 'ANT ARI PRASETYADI', '1111111111111111111', '-', '6300', '085156475083', 'antari@gmail.com', 'tuliskan permasalahan anda disini', '2023-12-07', '2023-12-07', NULL, '65713939', '2023-12-06 20:17:13', '2023-12-06 23:45:05', '3', '6', 1, 2, 3, NULL, 0),
(217, 'FASFAFA', '123123123113123123', 'ddfsdfsdf', '6423', '871893789123123', 'jokasdhai@gmail.com', 'asdakdjajsdnja sd', '2023-12-09', '2023-12-09', NULL, '65745DD3', '2023-12-09 05:30:11', '2023-12-09 05:30:11', '4', '4', 4, NULL, NULL, NULL, 0),
(218, 'AGSDUIGAISDAVSDVASDGVHASD', '1231231241324', 'kajsdkjhajksbdjkasd', '6423', '1723751728371', 'jfikri212@gmail.com', 'asdhasidgakjsgdjkagsdadw', '2023-12-12', '2023-12-12', NULL, '657813F8', '2023-12-12 01:04:08', '2023-12-17 19:00:03', '4', '4', 4, 2, NULL, NULL, 0);

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
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unitkerja_kode` varchar(20) NOT NULL,
  `unitkerja` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `unitkerja_kode`, `unitkerja`, `created_at`, `updated_at`) VALUES
(1, '6418', 'Pemerintah Kab. Banjarnegara', NULL, NULL),
(2, '6423', 'Pemerintah Kab. Kebumen', NULL, NULL),
(3, '6422', 'Pemerintah Kab. Purworejo', NULL, NULL),
(4, '6421', 'Pemerintah Kab. Wonosobo', NULL, NULL),
(5, '6419', 'Pemerintah Kab. Magelang', NULL, NULL),
(6, '6425', 'Pemerintah Kab. Boyolali', NULL, NULL),
(7, '6424', 'Pemerintah Kab. Klaten', NULL, NULL),
(8, '6410', 'Pemerintah Kab. Kudus', NULL, NULL),
(9, '6412', 'Pemerintah Kab. Jepara', NULL, NULL),
(10, '6427', 'Pemerintah Kab. Sukoharjo', NULL, NULL),
(11, '6429', 'Pemerintah Kab. Wonogiri', NULL, NULL),
(12, '6401', 'Pemerintah Kab. Semarang', NULL, NULL),
(13, '6420', 'Pemerintah Kab. Temanggung', NULL, NULL),
(14, '6402', 'Pemerintah Kab. Kendal', NULL, NULL),
(15, '6406', 'Pemerintah Kab. Batang', NULL, NULL),
(16, '6405', 'Pemerintah Kab. Pekalongan', NULL, NULL),
(17, '6428', 'Pemerintah Kab. Karanganyar', NULL, NULL),
(18, '6426', 'Pemerintah Kab. Sragen', NULL, NULL),
(19, '6404', 'Pemerintah Kab. Grobogan', NULL, NULL),
(20, '6414', 'Pemerintah Kab. Blora', NULL, NULL),
(21, '6413', 'Pemerintah Kab. Rembang', NULL, NULL),
(22, '6409', 'Pemerintah Kab. Pati', NULL, NULL),
(23, '6400', 'Pemerintah Provinsi Jawa Tengah', NULL, NULL),
(24, '6416', 'Pemerintah Kab. Cilacap', NULL, NULL),
(25, '6415', 'Pemerintah Kab. Banyumas', NULL, NULL),
(26, '6417', 'Pemerintah Kab. Purbalingga', NULL, NULL),
(27, '6303', 'Pemerintah Kab. Gunung Kidul', NULL, NULL),
(28, '6302', 'Pemerintah Kab. Sleman', NULL, NULL),
(29, '6371', 'Pemerintah Kota Yogyakarta', NULL, NULL),
(30, '6300', 'Pemerintah Daerah Istimewa Yogyakarta', NULL, NULL),
(31, '6411', 'Pemerintah Kab. Pemalang', NULL, NULL),
(32, '6407', 'Pemerintah Kab. Tegal', NULL, NULL),
(33, '6408', 'Pemerintah Kab. Brebes', NULL, NULL),
(34, '6475', 'Pemerintah Kota Magelang', NULL, NULL),
(35, '6476', 'Pemerintah Kota Surakarta', NULL, NULL),
(36, '6472', 'Pemerintah Kota Salatiga', NULL, NULL),
(37, '6471', 'Pemerintah Kota Semarang', NULL, NULL),
(38, '6473', 'Pemerintah Kota Pekalongan', NULL, NULL),
(39, '6474', 'Pemerintah Kota Tegal', NULL, NULL),
(40, '6304', 'Pemerintah Kab. Kulon Progo', NULL, NULL),
(41, '6301', 'Pemerintah Kab. Bantul', NULL, NULL),
(42, '6403', 'Pemerintah Kab. Demak', NULL, NULL),
(999, '1000', 'Perorangan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jams`
--

CREATE TABLE `jams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jam` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jams`
--

INSERT INTO `jams` (`id`, `jam`, `created_at`, `updated_at`) VALUES
(1, '09:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(2, '10:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(3, '11:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(4, '13:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(5, '14:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07'),
(6, '15:00', '2023-09-13 21:17:07', '2023-09-13 21:17:07');

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
(12, '2023_09_18_154143_create_zooms_table', 8),
(13, '2014_10_12_100000_create_password_resets_table', 9),
(14, '2016_06_01_000001_create_oauth_auth_codes_table', 9),
(15, '2016_06_01_000002_create_oauth_access_tokens_table', 9),
(16, '2016_06_01_000003_create_oauth_refresh_tokens_table', 9),
(17, '2016_06_01_000004_create_oauth_clients_table', 9),
(18, '2016_06_01_000005_create_oauth_personal_access_clients_table', 9),
(19, '2023_09_22_064323_add_zoom_id_to_formulirs', 9),
(20, '2023_10_06_031847_create_roles_table', 10),
(21, '2023_10_09_013203_create_petugas_konsultasi_table', 11),
(22, '2023_10_10_083814_add_image_to_formulirs_table', 12),
(23, '2023_10_12_062523_add_is_completed_to_formulirs', 13),
(24, '2023_10_18_042338_add_is_zoom_active_to_zooms', 14),
(25, '2023_10_18_042718_add_is_zoom_active_to_zooms', 15),
(26, '2023_10_18_053414_change_unitkerja_kode_in_formulirs_table', 16),
(27, '2023_10_18_062803_create_unitkerja_table', 17),
(28, '2023_11_01_073417_create_coaching_materi_table', 18),
(29, '2023_12_12_055354_add_is_active_to_users_table', 19);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('ADMIN','VA','PETUGAS') DEFAULT NULL,
  `is_active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `is_active`) VALUES
(1, 'ADMIN', 'fikri@gmail.com', NULL, '$2y$10$l6OLV2MdhoYulOL/mCboHen7L.VMnd2BX2LPWC2jFMcwUiRlk86w6', NULL, '2023-09-25 20:06:37', '2023-12-12 01:12:17', 'ADMIN', 'yes'),
(2, 'VA', 'ari@gmail.com', NULL, '$2y$10$CHDt2Z6BBXNHT.e9672bC.cOQ9AN/KHEjhZrRL2iQANlTlMI7N4RW', NULL, '2023-09-26 00:56:10', '2023-12-17 18:36:20', 'VA', 'yes'),
(3, 'PETUGAS 1', 'mukidi@gmail.com', NULL, '$2y$10$8kkj.T7V/2N9tHdOtynf2eu4jyMdzfgWsuA9XqnwVTQe6in2MFLNi', NULL, '2023-10-09 20:15:46', '2023-12-17 19:25:54', 'PETUGAS', 'yes'),
(5, 'PETUGAS 2', 'mukidi12345@gmail.com', NULL, '$2y$10$Jjxigl/WUYnuQYIbcTOMnOwsVnxiJjEsfaSLxu0JXocKlG19T7Zwe', NULL, '2023-10-09 20:40:47', '2023-10-09 20:40:47', 'PETUGAS', 'yes'),
(6, 'PETUGAS', 'mukidi217@gmail.com', NULL, '$2y$10$jcBO4z.NlaDqHxzVAy.hZOlrkjy6Y3unSNFR2W8bR7p71Dmety0Xi', NULL, '2023-10-09 20:41:15', '2023-10-09 20:41:15', 'PETUGAS', 'yes'),
(7, 'VA 2', 'mukidi2003@gmail.com', NULL, '$2y$10$BJlzzaqY/N6jTatkm8tunuVJfmXcYt/ieqyoJX29qMKgNHnpsPLIO', NULL, '2023-10-09 23:09:08', '2023-10-09 23:09:08', 'VA', 'yes'),
(19, 'Fikri as Juliamn', 'julian@gmail.com', NULL, '$2y$10$5ZJrG6.3jufkRF3JdiiME.6.c9WODpTOk7.yw4h68Mnva.rvegKNa', NULL, '2023-12-12 01:12:57', '2023-12-12 01:12:57', 'ADMIN', 'yes'),
(20, 'Mukidi', 'ajbdsvbajvsd@gmail.com', NULL, '$2y$10$fD2BeT0ZTuuXjIs42Jxu5.mWkTk6MTa5cgTq9/W8oCZrAh.hJ0xHG', NULL, '2023-12-17 18:16:11', '2023-12-17 18:16:11', 'PETUGAS', 'yes'),
(21, 'ashdasdasdvjh', 'asdbabsdibadb@gmail.com', NULL, '$2y$10$Dp6zafqNudFT339G3C1bj.vhbMB6l2.ZEJ6bkhuGqLOKb4tOk4MEO', NULL, '2023-12-17 18:17:42', '2023-12-17 18:17:42', 'VA', 'yes'),
(22, 'sjkadavsdasdasdvjha@gmail.com', 'sjkadavsdasdasdvjha@gmail.com', NULL, '$2y$10$G85kVaa7nc5DSqhH5rWMjuArnYFJtf3/22HPZ5is5z70/zL7OCNsq', NULL, '2023-12-17 18:20:11', '2023-12-17 18:20:11', 'VA', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `zooms`
--

CREATE TABLE `zooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL,
  `link_zoom` varchar(255) NOT NULL,
  `media_teleconference` varchar(21) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_zoom_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zooms`
--

INSERT INTO `zooms` (`id`, `meeting_id`, `passcode`, `link_zoom`, `media_teleconference`, `created_at`, `updated_at`, `is_zoom_active`) VALUES
(1, '17823685129748012356423', 'jbajSGd791528761234', 'https://www.google.com/search?q=link+zoom&oq=link+zoom+&aqs=chrome..69i57j0i512l9.4048j0j7&sourceid=chrome&ie=UTF-8', 'Zoom', '2023-09-18 08:44:35', '2023-10-20 00:46:42', 0),
(4, '1231231', '21314134', 'media_teleconference', 'Gmeet', '2023-10-01 21:13:44', '2023-10-31 23:54:28', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coachings`
--
ALTER TABLE `coachings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `formulirs_kode_unique` (`kode`),
  ADD KEY `formulirs_zoom_id_foreign` (`zoom_id`);

--
-- Indexes for table `coaching_jam`
--
ALTER TABLE `coaching_jam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulir_jam_formulir_id_foreign` (`coaching_id`),
  ADD KEY `formulir_jam_jam_id_foreign` (`jam_id`);

--
-- Indexes for table `coaching_materi`
--
ALTER TABLE `coaching_materi`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `formulirs_kode_unique` (`kode`),
  ADD KEY `formulirs_zoom_id_foreign` (`zoom_id`);

--
-- Indexes for table `formulir_jam`
--
ALTER TABLE `formulir_jam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulir_jam_formulir_id_foreign` (`formulir_id`),
  ADD KEY `formulir_jam_jam_id_foreign` (`jam_id`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unitkerja_unitkerja_kode_unique` (`unitkerja_kode`);

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
-- AUTO_INCREMENT for table `coachings`
--
ALTER TABLE `coachings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `coaching_jam`
--
ALTER TABLE `coaching_jam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coaching_materi`
--
ALTER TABLE `coaching_materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulirs`
--
ALTER TABLE `formulirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `formulir_jam`
--
ALTER TABLE `formulir_jam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `jams`
--
ALTER TABLE `jams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `zooms`
--
ALTER TABLE `zooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formulirs`
--
ALTER TABLE `formulirs`
  ADD CONSTRAINT `formulirs_zoom_id_foreign` FOREIGN KEY (`zoom_id`) REFERENCES `zooms` (`id`) ON DELETE SET NULL;

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
