-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 08:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `paypal_order_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `name`, `email`, `check_in`, `check_out`, `created_at`, `updated_at`, `payment_status`, `paypal_order_id`) VALUES
(1, 3, 'TestUser', 'test@example.com', '2025-02-07', '2025-02-09', '2025-02-03 01:36:00', '2025-02-03 01:37:26', 'Paid', '17K79291XG5076808'),
(2, 10, 'TestUser2', 'test2@example.com', '2025-02-13', '2025-02-15', '2025-02-03 01:38:49', '2025-02-03 01:39:00', 'Cancelled', '44S38783KE470991S'),
(3, 27, 'TestUser3', 'test3@example.com', '2025-02-10', '2025-02-12', '2025-02-03 01:39:50', '2025-02-03 01:40:45', 'Paid', '1MK32741WF1878255');

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
(5, '2025_01_31_135443_create_rooms_table', 1),
(6, '2025_02_01_111748_add_role_to_users_table', 1),
(7, '2025_02_01_112908_create_bookings_table', 1),
(8, '2025_02_02_041607_add_payment_status_to_bookings', 1);

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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `type`, `price`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Room 100', 'Double', 91, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(2, 'Room 101', 'Suite', 292, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(3, 'Room 102', 'Single', 146, 0, '2025-02-03 00:42:08', '2025-02-03 01:37:39'),
(4, 'Room 103', 'Double', 219, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(5, 'Room 104', 'Suite', 405, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(6, 'Room 105', 'Single', 137, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(7, 'Room 106', 'Double', 229, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(8, 'Room 107', 'Suite', 337, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(9, 'Room 108', 'Single', 139, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(10, 'Room 109', 'Double', 229, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(11, 'Room 110', 'Suite', 299, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(12, 'Room 111', 'Single', 82, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(13, 'Room 112', 'Double', 185, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(14, 'Room 113', 'Suite', 383, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(15, 'Room 114', 'Single', 74, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(16, 'Room 115', 'Double', 151, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(17, 'Room 116', 'Suite', 381, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(18, 'Room 117', 'Single', 54, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(19, 'Room 118', 'Double', 137, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(20, 'Room 119', 'Suite', 274, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(21, 'Room 120', 'Single', 147, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(22, 'Room 121', 'Double', 119, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(23, 'Room 122', 'Suite', 314, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(24, 'Room 123', 'Single', 138, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(25, 'Room 124', 'Double', 126, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(26, 'Room 125', 'Suite', 432, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(27, 'Room 126', 'Single', 148, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(28, 'Room 127', 'Double', 195, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(29, 'Room 128', 'Suite', 358, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(30, 'Room 129', 'Single', 82, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(31, 'Room 130', 'Double', 99, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(32, 'Room 131', 'Suite', 431, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(33, 'Room 132', 'Single', 102, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(34, 'Room 133', 'Double', 217, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(35, 'Room 134', 'Suite', 478, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(36, 'Room 135', 'Single', 150, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(37, 'Room 136', 'Double', 112, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(38, 'Room 137', 'Suite', 493, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(39, 'Room 138', 'Single', 57, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(40, 'Room 139', 'Double', 138, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(41, 'Room 140', 'Suite', 230, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(42, 'Room 141', 'Single', 50, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(43, 'Room 142', 'Double', 86, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(44, 'Room 143', 'Suite', 266, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(45, 'Room 144', 'Single', 73, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(46, 'Room 145', 'Double', 141, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(47, 'Room 146', 'Suite', 257, 1, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(48, 'Room 147', 'Single', 70, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(49, 'Room 148', 'Double', 199, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08'),
(50, 'Room 149', 'Suite', 268, 0, '2025-02-03 00:42:08', '2025-02-03 00:42:08');

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
  `role` varchar(255) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$4FNlNBgWJRITESqYpmR5y.AdwbhSOc9WZDbTwEOSCTP1qYh9F./pW', NULL, '2025-02-03 00:42:00', '2025-02-03 00:42:00', 'admin'),
(2, 'TestUser', 'test@example.com', NULL, '$2y$12$bQhtUU8MYfrHhd2aEmd6lOFIKaDsz7UWtcFV4q3z447gj0ULWTWem', NULL, '2025-02-03 01:35:25', '2025-02-03 01:35:25', 'customer'),
(3, 'TestUser2', 'test2@example.com', NULL, '$2y$12$5F.bLFUVtPD6k1uF5HIIIuHSQdvprCQn4MmR2SmgRQQR7Dp8W1yCi', NULL, '2025-02-03 01:38:11', '2025-02-03 01:38:11', 'customer'),
(4, 'TestUser3', 'test3@example.com', NULL, '$2y$12$7ymvu0aAG3IYEDCH4OaSjO5FajSPasfTyAvi5UK53E/XXRSsZg/2m', NULL, '2025-02-03 01:39:32', '2025-02-03 01:39:32', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_room_id_foreign` (`room_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
