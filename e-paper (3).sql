-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 02:58 PM
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
-- Database: `e-paper`
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
('laravel_cache_password_reset_rashmithag5204@gmail.com', 'i:1;', 1749553697),
('laravel_cache_password_reset_rashmithag5204@gmail.com:timer', 'i:1749553697;', 1749553697);

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
-- Table structure for table `editions`
--

CREATE TABLE `editions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publication_type` enum('Newspaper','Magazine') NOT NULL,
  `publication_name` varchar(255) NOT NULL,
  `edition_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `editions`
--

INSERT INTO `editions` (`id`, `publication_type`, `publication_name`, `edition_date`, `created_at`, `updated_at`) VALUES
(3, 'Magazine', 'The great india', '2025-06-07', '2025-06-06 11:24:42', '2025-06-08 04:15:08'),
(4, 'Newspaper', 'The Hindu', '2025-06-08', '2025-06-08 04:11:53', '2025-06-10 02:42:19'),
(7, 'Magazine', 'Vogue', '2025-06-09', '2025-06-09 07:44:56', '2025-06-10 02:06:33'),
(15, 'Newspaper', 'The times of India', '2025-06-10', '2025-06-10 02:47:08', '2025-06-10 02:47:08'),
(16, 'Newspaper', 'The indian express', '2025-06-11', '2025-06-10 02:47:53', '2025-06-10 02:47:53'),
(17, 'Magazine', 'India Today', '2025-06-12', '2025-06-10 02:48:53', '2025-06-10 02:48:53'),
(18, 'Newspaper', 'National Newspaper', '2025-06-13', '2025-06-10 03:35:00', '2025-06-10 03:35:00'),
(19, 'Newspaper', 'Hindusthan', '2025-06-14', '2025-06-10 03:35:52', '2025-06-10 03:35:52'),
(20, 'Magazine', 'Elle', '2025-06-15', '2025-06-10 03:36:41', '2025-06-10 03:36:41'),
(21, 'Magazine', 'Vanitha', '2025-06-16', '2025-06-10 03:37:10', '2025-06-10 03:37:10');

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
(1, '2025_06_06_091720_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 2),
(3, '0001_01_01_000002_create_jobs_table', 2),
(4, '2025_06_06_154236_create_editions_table', 2),
(5, '2025_06_06_172851_create_pages_table', 3),
(6, '2025_06_08_093517_add_publication_name_to_editions_table', 4),
(7, '2025_06_09_104225_add_description_to_pages_table', 5),
(8, '2025_06_09_141408_create_password_resets_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `edition_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `page_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `edition_id`, `image_path`, `page_number`, `created_at`, `updated_at`, `description`) VALUES
(1, 3, 'pages/GHfN3n8m3rNXPO50Zvx7gNsncVsflHr4tHWbraS6.png', 1, '2025-06-06 12:49:32', '2025-06-09 06:40:24', 'Today, the city witnessed a major development as the local government announced a new initiative aimed at improving public transportation. The project promises to reduce traffic congestion and enhance commuter convenience through the introduction of eco-friendly buses and expanded routes. Officials emphasized the importance of sustainable urban mobility and assured residents that construction will begin next month with minimal disruption. Citizens have welcomed the move, expressing hope for a smoother daily commute and better air quality in the coming years.'),
(11, 3, 'pages/bSwyUDLdDpjhhIYNraZ5PyPO5arenVJl34qiiyhg.png', 2, '2025-06-09 06:57:50', '2025-06-09 07:02:53', 'Flipkart Plus. A world of limitless possibilities awaits you - Flipkart Plus was kickstarted as a loyalty reward programme for all its regular customers at zero'),
(12, 3, 'pages/OpMJGj8YNO9IV0FvVRNblls8X0rarOyycVNBdUdg.png', 3, '2025-06-09 06:57:58', '2025-06-09 06:57:58', NULL),
(13, 7, 'pages/CuIA1Wm6gIZOKxG0zNz8h76kjVHctcMRQ2WNMKoD.png', 1, '2025-06-10 02:40:40', '2025-06-10 02:40:40', NULL),
(14, 7, 'pages/WOq1KPnDJL2MtCemaZljOXejcGYRgKvtLqakmqTo.jpg', 2, '2025-06-10 02:40:49', '2025-06-10 02:40:49', NULL),
(15, 7, 'pages/OBtkaJMaOjF5VyGUef8w21mmzLkBEasp2ygzO6N4.jpg', 3, '2025-06-10 02:40:57', '2025-06-10 02:40:57', NULL),
(16, 7, 'pages/mPyzmM1erA7zE5tQ7SlJ0smPd0OO8GjmWkhlTRdT.jpg', 4, '2025-06-10 02:41:06', '2025-06-10 02:41:06', NULL),
(17, 4, 'pages/7KaVFVoZz9bGHBH6nKibIc3MKbden2WT1m3DjGmO.jpg', 1, '2025-06-10 02:42:34', '2025-06-10 02:42:34', NULL),
(18, 4, 'pages/STrk7rK3kQY4O63y0Gid5dSXMTqiBhPrxHZgBOnM.jpg', 2, '2025-06-10 02:42:42', '2025-06-10 02:42:42', NULL),
(19, 4, 'pages/UkBHi25IvIyo0JafK4v6Eg3SyOsASEwKM5MWn8Zx.jpg', 3, '2025-06-10 02:42:54', '2025-06-10 02:42:54', NULL),
(20, 4, 'pages/yJaCv1FLxi3L4sCnT1vA176wgIGfEKTwg2ZfXGLP.jpg', 4, '2025-06-10 02:43:03', '2025-06-10 02:43:03', NULL),
(21, 17, 'pages/0Y6xXe5Z86pvpPGemlFORS1VoHWIhfd6ROAVqfPb.jpg', 1, '2025-06-10 02:49:10', '2025-06-10 02:49:10', NULL),
(22, 17, 'pages/FWLJvLIIzDWUeJ5s5G32vX33q4Bw2rIDmiP4WTDm.jpg', 2, '2025-06-10 02:49:21', '2025-06-10 02:49:21', NULL),
(23, 17, 'pages/lsxCLaTAkC9HFVxukOqtbn6S22Lb3hoaOKFa8zR9.jpg', 3, '2025-06-10 02:49:33', '2025-06-10 02:49:33', NULL),
(24, 17, 'pages/8MOH8g4Ss4mqejcLMcajwxkaZCju6zNNOHTr3Ano.jpg', 4, '2025-06-10 02:49:43', '2025-06-10 02:49:43', NULL),
(25, 16, 'pages/3DtB6Xn8I53iEtFDQkBOqrxPLUYArNbLnz6tEWdU.jpg', 1, '2025-06-10 02:50:13', '2025-06-10 02:50:13', NULL),
(26, 16, 'pages/3GKvNu5mIZQhldB1i79OhzoflBtDLDEJUOuD23rD.jpg', 2, '2025-06-10 02:50:23', '2025-06-10 02:50:23', NULL),
(27, 16, 'pages/bfAd0bUTjrdjgt7uaS15OsEpO7SnjayfZyiTEjKm.jpg', 3, '2025-06-10 02:50:30', '2025-06-10 02:50:30', NULL),
(28, 16, 'pages/VxRqmwdEq5B5CDfOhuh7rB4uSJDsnBrpDB9g9xr1.jpg', 4, '2025-06-10 02:50:39', '2025-06-10 02:50:39', NULL),
(29, 15, 'pages/VY9CKoAxNtEf1jWwdSI13LUDdutuZPLS3fvSXIYA.jpg', 1, '2025-06-10 02:50:59', '2025-06-10 02:50:59', NULL),
(30, 15, 'pages/BubTWH60RwappyPzkIzaVivF3xEwwtm2d4joEBp5.jpg', 2, '2025-06-10 02:51:07', '2025-06-10 02:51:07', NULL),
(31, 15, 'pages/UpQTjheOCmHR8wx4vmwgm0KIOXFHxNMiljj6UrA8.jpg', 3, '2025-06-10 02:51:14', '2025-06-10 02:51:14', NULL),
(32, 15, 'pages/jz5VcUoCEPod8ZrdycmF2fESgmZWOAkzNGi9LNzm.jpg', 4, '2025-06-10 02:51:22', '2025-06-10 02:51:22', NULL),
(33, 21, 'pages/cjYGg15qXNBXY0C7WpK7wqkJTmgrrF578QqUEc2N.jpg', 1, '2025-06-10 03:37:21', '2025-06-10 03:37:21', NULL),
(35, 21, 'pages/i0YbkEynx3REB1iYFWrG51qevJeAck5zw5DFsPlt.png', 2, '2025-06-10 03:37:42', '2025-06-10 05:35:29', 'Tired of the endless rush and the environmental toll? Discover how small shifts in your daily habits can lead to profound positive impacts, both for the planet and your peace of mind. From conscious consumption to digital detoxes, this guide unpacks practical, achievable ways to re-engage with nature and live more intentionally in the modern world.'),
(37, 20, 'pages/so0lXFKNOyAZJ8iLp0ffaFU2az4WklRFSCny7xSJ.jpg', 1, '2025-06-10 03:38:04', '2025-06-10 03:38:04', NULL),
(38, 20, 'pages/jV4tTdJsUD6y4zurvJjDYj3gqlk8UkIyE5RAAV7q.jpg', 2, '2025-06-10 03:38:14', '2025-06-10 03:38:14', NULL),
(39, 20, 'pages/UQnVfhfJRaqTEPbJz6vRjAVpB4X4lE4SAu8JD0Ar.jpg', 3, '2025-06-10 03:38:23', '2025-06-10 03:38:23', NULL),
(40, 19, 'pages/00cEHJpr2V1klKQyufx76qgdejNzQlB8UHpVvdAx.jpg', 1, '2025-06-10 03:38:41', '2025-06-10 03:38:41', NULL),
(41, 19, 'pages/yi7WSuQ0xcT0vGOVvdKArZO8tE9wPzV88GA6Hd9b.jpg', 2, '2025-06-10 03:38:48', '2025-06-10 03:38:48', NULL),
(42, 19, 'pages/UuhwUQlXm5TU1W4gmJCzoDP4iT4zZNCa6vgEuAax.jpg', 3, '2025-06-10 03:38:55', '2025-06-10 03:38:55', NULL),
(43, 18, 'pages/gm4Y0J3Pfu7OZFSxotIhyKQHdOzx9mQMCQzPynCj.jpg', 1, '2025-06-10 03:39:14', '2025-06-10 03:39:14', NULL),
(44, 18, 'pages/NeNJMxtvC66KL6hB59TPWiz4EoteGIWdy6ZHgCWP.jpg', 2, '2025-06-10 03:39:21', '2025-06-10 03:39:21', NULL),
(45, 18, 'pages/r8oiDNOaVcIlTVxVNyWMWOjCcxlHU6iIHdcJixyS.jpg', 3, '2025-06-10 03:39:29', '2025-06-10 03:39:29', NULL),
(46, 21, 'pages/hlDpgz33Ghob9aHHlm1tG2jR4PIhQWnozKtskGuX.jpg', 3, '2025-06-10 05:35:51', '2025-06-10 05:35:51', NULL);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'rashmithag5204@gmail.com', NULL, '$2y$12$AQ1uBFXIw56PlnRy2bHYf.uxLlvi727f7UFKkxqKsSAu9nbI11jEy', 'admin', NULL, '2025-06-06 03:54:46', '2025-06-10 05:38:48');

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
-- Indexes for table `editions`
--
ALTER TABLE `editions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `editions_edition_date_unique` (`edition_date`);

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_edition_id_foreign` (`edition_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `editions`
--
ALTER TABLE `editions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_edition_id_foreign` FOREIGN KEY (`edition_id`) REFERENCES `editions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
