-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Okt 2021 pada 02.48
-- Versi server: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- Versi PHP: 7.2.32-4+focal

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chal_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_cd` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Laki-laki','Perempuan','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `position_cd`, `name`, `nik`, `email`, `gender`, `photo`, `created_at`, `updated_at`) VALUES
(5, 'ADM', 'Andi Suherman', '321602100415621', 'andisuherman@gmail.com', 'Laki-laki', NULL, '2021-10-05 16:50:23', '2021-10-05 16:50:23'),
(6, 'SA', 'Joki Surya', '321602100413122', 'joko@gmail.com', 'Laki-laki', NULL, '2021-10-05 17:01:18', '2021-10-05 17:01:18'),
(7, 'SA', 'Rachelia', '32160210043123', 'rachel@gmail.com', 'Perempuan', NULL, '2021-10-05 18:44:37', '2021-10-05 18:44:37'),
(8, 'DA', 'Chandra Wijaya', '321602440412347', 'chandra@gmail.com', 'Laki-laki', NULL, '2021-10-05 18:14:14', '2021-10-05 18:14:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2021_10_05_000322_create_positions_table', 1),
(3, '2021_10_05_000346_create_employees_table', 1),
(4, '2021_10_05_000419_create_salary_bonuses_table', 1),
(5, '2021_10_05_000430_create_salary_bonus_details_table', 1),
(6, '2021_10_05_000432_create_users_table', 1),
(8, '2021_10_06_000350_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `position_cd` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_name` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`position_cd`, `position_name`, `salary`, `created_at`, `updated_at`) VALUES
('ADM', 'Administrator', '4300000', '2021-10-04 18:22:40', '2021-10-04 18:22:40'),
('DA', 'Data Analyst', '7000000', '2021-10-05 18:13:40', '2021-10-05 18:13:40'),
('SA', 'System Analyst', '6000000', '2021-10-05 17:00:52', '2021-10-05 17:00:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `salary_bonuses`
--

CREATE TABLE `salary_bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nominal` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `salary_bonuses`
--

INSERT INTO `salary_bonuses` (`id`, `nominal`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, '5000000', 'Akhir Tahun', 'Bonus Akhir Tahun', '2021-10-05 18:45:14', '2021-10-05 18:45:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `salary_bonus_details`
--

CREATE TABLE `salary_bonus_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_bonus_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `precentage` int(11) NOT NULL,
  `nominal_total` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `salary_bonus_details`
--

INSERT INTO `salary_bonus_details` (`id`, `salary_bonus_id`, `employee_id`, `precentage`, `nominal_total`, `created_at`, `updated_at`) VALUES
(13, 5, 5, 20, '1000000', '2021-10-05 18:45:14', '2021-10-05 18:45:14'),
(14, 5, 6, 30, '1500000', '2021-10-05 18:45:14', '2021-10-05 18:45:14'),
(15, 5, 7, 20, '1000000', '2021-10-05 18:45:14', '2021-10-05 18:30:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `username` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('reguler','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 5, '321602100415621', '$2y$10$zR.MIESDyogr.LJZVbL.CO7UTbAbMdGFwTHH3x9qjlCqEhBgzC0Q6', 'reguler', NULL, '2021-10-05 16:59:46', '2021-10-05 16:59:46'),
(3, 6, '321602100413122', '$2y$10$0FiU9FqUlstuP8ue/rQYNeXvXCiOvhY4aTk0HyqBA2oIz4v35Fkwa', 'reguler', NULL, '2021-10-05 17:01:18', '2021-10-05 17:01:18'),
(4, 5, 'admin', '$2y$10$sOvPOZ9hqGKfFkB4uRswauf1mjy85QCSQC94z6ha2JaYObW2PSfDC', 'admin', NULL, '2021-10-05 17:18:49', '2021-10-05 18:38:45'),
(5, 7, '32160210043123', '$2y$10$UIrqN0GV2MpRLYm7ypEv/Or/Y2.4ROdlIWUV54rtjev3PJvgzowia', 'reguler', NULL, '2021-10-05 18:44:37', '2021-10-05 18:44:37'),
(6, 8, '321602440412347', '$2y$10$OSNomFbWp3xw.NE2u/o.OeuOQubdoI4Xs4N0La4jJ0kjhierFdkVe', 'reguler', NULL, '2021-10-05 18:14:14', '2021-10-05 18:14:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_position_cd_foreign` (`position_cd`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_cd`);

--
-- Indeks untuk tabel `salary_bonuses`
--
ALTER TABLE `salary_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `salary_bonus_details`
--
ALTER TABLE `salary_bonus_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_bonus_details_salary_bonus_id_foreign` (`salary_bonus_id`),
  ADD KEY `salary_bonus_details_employee_id_foreign` (`employee_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_employee_id_foreign` (`employee_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `salary_bonuses`
--
ALTER TABLE `salary_bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `salary_bonus_details`
--
ALTER TABLE `salary_bonus_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_position_cd_foreign` FOREIGN KEY (`position_cd`) REFERENCES `positions` (`position_cd`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `salary_bonus_details`
--
ALTER TABLE `salary_bonus_details`
  ADD CONSTRAINT `salary_bonus_details_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_bonus_details_salary_bonus_id_foreign` FOREIGN KEY (`salary_bonus_id`) REFERENCES `salary_bonuses` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
