-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 06:56 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backgroundcheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_data_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `icon_menus`
--

CREATE TABLE `icon_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_href` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `icon_menus`
--

INSERT INTO `icon_menus` (`id`, `role`, `icon`, `title`, `icon_href`, `created_at`, `updated_at`) VALUES
(1, 3, '<i data-feather=\"monitor\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Dashboard', '#MetricaDashboard', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(2, 3, '  <i data-feather=\"package\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Payments', '#MetricaUikit', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(3, 3, ' <i data-feather=\"users\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Users', '#MetricaUsers', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(4, 3, '<i data-feather=\"grid\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Staff List(HR)', '#MetricaAuthentication', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(5, 3, '<i data-feather=\"grid\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Assign Jobs', '#MetricaApps', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(6, 3, '<i data-feather=\"layer\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Settings', '#MetricaSettings', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(7, 2, '<i data-feather=\"grid\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Assign Jobs', '#MetricaApps', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(8, 2, '  <i data-feather=\"package\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Payments', '#MetricaUikit', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(9, 4, '<i data-feather=\"monitor\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Dashboard', '#MetricaDashboard', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(10, 4, '  <i data-feather=\"package\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Payments', '#MetricaUikit', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(11, 4, ' <i data-feather=\"users\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Users', '#MetricaUsers', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(12, 4, '<i data-feather=\"grid\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Staff List(HR)', '#MetricaAuthentication', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(13, 4, '<i data-feather=\"layer\" class=\"align-self-center menu-icon icon-dual\"></i>', 'Settings', '#MetricaSettings', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(14, 1, '<i data-feather=\"home\" class=\"align-self-center menu-icon icon-dual\"></i>', 'HOME', '#BackgroundCheck', '2020-07-06 07:24:34', '2020-07-06 07:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `main_menus`
--

CREATE TABLE `main_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_menus`
--

INSERT INTO `main_menus` (`id`, `icon_id`, `role_id`, `menu_name`, `menu_link`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Home', '/home', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(2, 1, 3, 'Vendor', '/vendors', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(3, 2, 3, 'Payments', '/vendors_payments', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(4, 3, 3, 'Users', '/all_users', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(5, 4, 3, 'Check List', '/background_check_list', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(6, 5, 3, 'Assigned Jobs', '/assigned_job_lists', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(7, 6, 3, 'Email Setting', '/email_settings', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(8, 7, 2, 'Assigned Jobs', '/assigned_job_lists', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(9, 8, 2, 'Vendor Payments', '/vendors_payments', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(10, 9, 4, 'Home', '/home', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(11, 9, 4, 'Vendor', '/vendors', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(12, 10, 4, 'Payments', '/vendors_payments', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(13, 11, 4, 'Users', '/all_users', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(14, 12, 4, 'Check List', '/background_check_list', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(15, 13, 4, 'Email Setting', '/email_settings', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(16, 13, 4, 'Company Settings', '/company_settings', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(17, 13, 4, 'Server Online', '/server_online', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(18, 14, 1, 'User Background', '/user_background_check', '2020-07-06 07:24:34', '2020-07-06 07:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `main_menus_links`
--

CREATE TABLE `main_menus_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_links` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_10_171856_create_roles_table', 1),
(5, '2020_04_10_205757_create_role_users_table', 1),
(6, '2020_04_20_144900_create_companies_table', 1),
(7, '2020_05_03_115335_create_icon_menus_table', 1),
(8, '2020_05_03_115357_create_main_menus_table', 1),
(9, '2020_05_03_120826_create_main_menus_links_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permission`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'USER', '{\"view-details\":true,\"update-info\":true}', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(2, 'VENDOR', '{\"submit-background-check\":true}', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(3, 'ADMIN', '{\"approve-background-check\":true,\"create-user\":true,\"view-all-users\":true,\"approve\":true,\"approve-payment\":true}', '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(4, 'SUPERADMIN', '{\"create_admin\":true,\"view-all-users\":true,\"create-user\":true,\"approve-payment\":true,\"approve-background-check\":true}', '2020-07-06 07:24:34', '2020-07-06 07:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2020-07-06 07:24:34', '2020-07-06 07:24:34'),
(2, 3, '2020-07-06 07:24:34', '2020-07-06 07:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userpic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cid`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `role_id`, `phone_number`, `address`, `auth_token`, `userpic`, `is_active`, `ip_address`, `user_agent`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'ogiogio', 'victor', 'ogiogiovictor@gmail.com', NULL, '$2y$10$MVwAiJleTjB5p/iX7T/qLe6.6PidTaiVaa5IkQEomnjy8nuj3nxLu', 4, '08114247689', '6 Adeyeye Street Megida Ayobo', '5f02e0792ca451594024057fEnwJCOx8PbGD3ohZzaOn7NPWRNQiVYFJ7MCvTQCvBrKOaXA41', NULL, '1', NULL, NULL, NULL, '2020-07-06 07:24:34', '2020-07-06 07:27:37'),
(2, '1', 'Tobiloba', 'Williams', 'tobiloba.williams@c-ileasing.com', NULL, '$2y$10$izsH3OPz9m8ZS007I.x3Kupev9Bm260Q1ym61bJ3B3do51qAw5RJu', 3, '08114247689', '6 Adeyeye Street Megida Ayobo', NULL, NULL, '1', NULL, NULL, NULL, '2020-07-06 07:24:34', '2020-07-06 07:24:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icon_menus`
--
ALTER TABLE `icon_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menus`
--
ALTER TABLE `main_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menus_links`
--
ALTER TABLE `main_menus_links`
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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `icon_menus`
--
ALTER TABLE `icon_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `main_menus`
--
ALTER TABLE `main_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `main_menus_links`
--
ALTER TABLE `main_menus_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
