-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 01:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
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
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lc_countries`
--

CREATE TABLE `lc_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `lc_region_id` tinyint(3) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `official_name` varchar(191) NOT NULL,
  `iso_alpha_2` varchar(3) NOT NULL,
  `iso_alpha_3` varchar(4) NOT NULL,
  `iso_numeric` smallint(6) DEFAULT NULL,
  `geoname_id` varchar(191) DEFAULT NULL,
  `international_phone` varchar(150) DEFAULT NULL,
  `languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`languages`)),
  `tld` varchar(191) DEFAULT NULL COMMENT 'Top-level domain',
  `wmo` varchar(191) DEFAULT NULL COMMENT 'Country abbreviations by the World Meteorological Organization',
  `emoji` varchar(191) NOT NULL,
  `color_hex` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`color_hex`)),
  `color_rgb` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`color_rgb`)),
  `coordinates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coordinates`)),
  `coordinates_limit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coordinates_limit`)),
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lc_countries_geographical`
--

CREATE TABLE `lc_countries_geographical` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `lc_country_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `features_type` varchar(191) NOT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`properties`)),
  `geometry` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`geometry`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lc_countries_translations`
--

CREATE TABLE `lc_countries_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lc_country_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `locale` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lc_regions`
--

CREATE TABLE `lc_regions` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lc_region_translations`
--

CREATE TABLE `lc_region_translations` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `lc_region_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `locale` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'Matero', 1, '2024-04-10 08:47:24', '2024-04-10 08:47:24'),
(2, 'Northmed', 1, '2024-04-10 08:47:43', '2024-04-10 08:47:43'),
(4, 'Lusaka', 5, '2024-05-09 15:12:20', '2024-05-09 15:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `property_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'gallery_images/d8e9LwSxJ8M49LIECLpfrcW0T4V4RCwCRJd4CBkr.jpg', 1, '2024-04-11 00:37:17', '2024-04-11 00:37:17'),
(2, 'gallery_images/ZGJ3mU7Hd0yjdzm8gtevUbkLwnpUogxDYb4uTgKj.jpg', 1, '2024-04-11 00:37:17', '2024-04-11 00:37:17'),
(3, 'gallery_images/Im7n5qXkk25VZ1l6klgH2WbgaKGgtwQt4RCpyfSO.psd', 1, '2024-04-11 00:37:17', '2024-04-11 00:37:17'),
(4, 'gallery_images/yLLmmF2ImPfOX50BsmrxQEyNlPVEts3K6uRjP3Rd.jpg', 2, '2024-04-19 11:31:09', '2024-04-19 11:31:09'),
(5, 'gallery_images/7YDKc1Fxu4P0o3ZktImTtbNOchNXFHG03EyrBtaa.jpg', 3, '2024-05-21 11:08:01', '2024-05-21 11:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_13_123456_create_wallet_tables', 1),
(4, '2018_11_05_123456_update_wallet_transactions_table', 1),
(5, '2019_01_25_000000_add_polymorphic_relation_to_transactions_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2020_01_01_000100_create_lc_regions_table', 1),
(9, '2020_01_01_000200_create_lc_region_translations_table', 1),
(10, '2020_01_01_000300_create_lc_countries_table', 1),
(11, '2020_01_01_000400_create_lc_countries_translations_table', 1),
(12, '2020_01_01_000500_create_lc_countries_geographical_table', 1),
(13, '2021_12_03_093555_create_locations_table', 1),
(14, '2021_12_05_072808_create_properties_table', 1),
(15, '2021_12_06_090337_create_media_table', 1),
(16, '2022_01_01_072326_create_pages_table', 1),
(17, '2022_01_25_062821_create_property_enquires_table', 1),
(18, '2022_01_31_073236_create_jobs_table', 1),
(19, '2022_07_17_101632_owner', 1),
(20, '2023_06_07_140659_create_shops_table', 1),
(21, '2023_06_08_120252_stores', 1),
(22, '2023_06_09_145558_country_codes', 1),
(23, '2023_06_16_144314_create_pawn_shops_table', 1),
(24, '2023_06_16_144826_pawn_id', 1),
(25, '2023_06_19_094444_promo_price', 1),
(26, '2024_05_15_222159_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pawn_shops`
--

CREATE TABLE `pawn_shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pawn_shops`
--

INSERT INTO `pawn_shops` (`id`, `name`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'SUV', 1, '2024-04-11 00:39:17', '2024-04-11 00:39:17'),
(2, 'My Pawn shop', 5, '2024-04-19 11:26:32', '2024-04-19 11:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `name_tr` varchar(191) NOT NULL,
  `featured_image` varchar(191) NOT NULL DEFAULT 'https://picsum.photos/1200/800',
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `sale` bigint(20) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=sale,2=rent',
  `type` bigint(20) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=apartment,2=villa,3=land',
  `bedrooms` bigint(20) UNSIGNED DEFAULT NULL,
  `drawing_rooms` bigint(20) UNSIGNED DEFAULT NULL,
  `bathrooms` bigint(20) UNSIGNED DEFAULT NULL,
  `net_sqm` bigint(20) UNSIGNED DEFAULT NULL,
  `gross_sqm` bigint(20) UNSIGNED DEFAULT NULL,
  `pool` bigint(20) UNSIGNED DEFAULT NULL COMMENT '1=private,2=public,3=both,4=no',
  `overview` varchar(191) NOT NULL,
  `overview_tr` varchar(191) NOT NULL,
  `why_buy` longtext DEFAULT NULL,
  `why_buy_tr` longtext DEFAULT NULL,
  `description` longtext NOT NULL,
  `description_tr` longtext NOT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store` int(11) NOT NULL,
  `country_code` varchar(191) NOT NULL,
  `country_state` varchar(191) NOT NULL,
  `pawn_id` int(11) NOT NULL,
  `promo_price` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `name_tr`, `featured_image`, `location_id`, `price`, `sale`, `type`, `bedrooms`, `drawing_rooms`, `bathrooms`, `net_sqm`, `gross_sqm`, `pool`, `overview`, `overview_tr`, `why_buy`, `why_buy_tr`, `description`, `description_tr`, `owner`, `created_at`, `updated_at`, `store`, `country_code`, `country_state`, `pawn_id`, `promo_price`) VALUES
(1, 'Dhash', '', 'gallery_images/QAY6oJ10VEUvIJZlqPp1xQf8NKmdjXBC4BMv8WUe.jpg', 1, 2000, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'jkajkjak', NULL, 'jkasjkjdkjka', '', 1, '2024-04-11 00:37:17', '2024-04-11 00:37:17', 1, 'zm', 'western', 0, 0),
(2, 'My Iphone', '', 'gallery_images/jr5yI7TQTvbhWQVgKpaWcx8gEKHlje4tyRXPGlIf.jpg', 1, 1000, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'Lasted Iphone', NULL, 'Iphone 15 Pro Max  good as new', '', 5, '2024-04-19 11:31:09', '2024-04-19 11:31:09', 2, 'zm', 'lusaka', 0, 0),
(3, 'cheese', '', 'gallery_images/lCRJDdNA39mFYKnUBA0JcRqk305Iooe88iA2bcFN.jpg', 1, 6000, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'uygyhguui90ii0nbju huiujoio', NULL, 'jiojojo joijo', '', 4, '2024-05-21 11:08:01', '2024-05-21 11:08:01', 5, 'zm', 'lusaka', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_enquires`
--

CREATE TABLE `property_enquires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `message` longtext NOT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phonenumber` int(12) NOT NULL,
  `owner` int(11) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','verified','rejected','not verified') DEFAULT 'not verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `phonenumber`, `owner`, `is_verified`, `created_at`, `updated_at`, `status`) VALUES
(1, 'mail', 0, 2, 1, '2024-04-04 07:36:32', '2024-05-16 09:24:32', 'verified'),
(2, 'My Store', 0, 5, 1, '2024-04-19 11:24:53', '2024-05-16 09:33:41', 'verified'),
(3, 'My Store', 0, 5, 1, '2024-05-09 15:11:26', '2024-05-16 09:31:11', 'verified'),
(4, 'Reader mall', 987665553, 5, 0, '2024-05-16 10:05:31', '2024-05-16 10:05:31', 'not verified'),
(5, 'My Store', 987665553, 4, 0, '2024-05-21 10:36:08', '2024-05-21 10:36:26', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `owner`, `role`) VALUES
(2, 'Dhash', 'Danielhash@mail.com', NULL, '$2y$10$StDa8O9FjCJ7uv95OvAGhOXk11KovvkKLemJXDAqbkB32fH8diRA6', NULL, '2024-04-11 13:30:14', '2024-04-11 13:30:14', 1, 'super-admin'),
(4, 'mail', 'Dhash2@mail.com', NULL, '$2y$10$eCEQvuoSqlU4dj379THTHuqnlDvPictN0KlDJdxUVl5jX6CdQMThW', NULL, '2024-04-11 13:51:51', '2024-04-11 13:51:51', 1, 'user'),
(5, 'Daniel Hash', 'Danielhashkuch@gmail.com', NULL, '$2y$10$6fTYMDw75KKuUT6ZgDy4ceK0v9YqDrQNhW5nmCdT66D.Y26tTruCq', NULL, '2024-04-19 11:24:04', '2024-04-19 11:24:04', 0, 'super-admin'),
(6, 'Dhash', 'danielh@mail.com', NULL, '$2y$10$Fc/TDdcge0WdSv4Nboyz4uhCFSaM5ZvdYd9tO/is09T29pX0XwQoO', NULL, '2024-04-19 11:25:18', '2024-04-19 11:25:18', 5, 'user'),
(8, 'Chris brown', 'johnmain4@gmail.com', NULL, '$2y$10$Mla90sfsPdwNVz3Jgk7EW.sLvKlEnt2wQKuWAWKvBwMvKLciFdNiO', NULL, '2024-05-21 18:53:31', '2024-05-21 18:53:31', 5, 'super-admin'),
(9, 'camster', 'Dhash@mail.com', NULL, '$2y$10$Ze.biqc5RL.gq8cF7qp1yOMQQ0E/F/RjLRoTmaK06jdYW8TOJb7ia', NULL, '2024-05-21 18:57:31', '2024-05-21 18:57:31', 4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED DEFAULT NULL,
  `owner_type` varchar(191) DEFAULT NULL,
  `balance` decimal(12,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `owner_id`, `owner_type`, `balance`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, NULL, '0.0000', '2024-04-11 13:51:51', '2024-04-11 13:51:51', NULL),
(6, NULL, NULL, '0.0000', '2024-04-19 11:25:18', '2024-04-19 11:25:18', NULL),
(7, NULL, NULL, '0.0000', '2024-05-21 18:50:48', '2024-05-21 18:50:48', NULL),
(8, NULL, NULL, '0.0000', '2024-05-21 18:53:31', '2024-05-21 18:53:31', NULL),
(9, NULL, NULL, '0.0000', '2024-05-21 18:57:31', '2024-05-21 18:57:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `wallet_id` int(10) UNSIGNED NOT NULL,
  `reference_id` int(10) UNSIGNED DEFAULT NULL,
  `reference_type` varchar(191) DEFAULT NULL,
  `amount` decimal(12,4) NOT NULL,
  `hash` varchar(60) NOT NULL,
  `type` varchar(30) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `origin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `lc_countries`
--
ALTER TABLE `lc_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lc_countries_lc_region_id_iso_alpha_2_unique` (`lc_region_id`,`iso_alpha_2`),
  ADD UNIQUE KEY `lc_countries_uuid_unique` (`uuid`);

--
-- Indexes for table `lc_countries_geographical`
--
ALTER TABLE `lc_countries_geographical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lc_countries_geographical_lc_country_id_foreign` (`lc_country_id`);

--
-- Indexes for table `lc_countries_translations`
--
ALTER TABLE `lc_countries_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lc_countries_translations_lc_country_id_locale_unique` (`lc_country_id`,`locale`),
  ADD KEY `lc_countries_translations_locale_index` (`locale`);

--
-- Indexes for table `lc_regions`
--
ALTER TABLE `lc_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lc_regions_uuid_unique` (`uuid`);

--
-- Indexes for table `lc_region_translations`
--
ALTER TABLE `lc_region_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lc_region_translations_lc_region_id_locale_unique` (`lc_region_id`,`locale`),
  ADD UNIQUE KEY `lc_region_translations_slug_locale_unique` (`slug`,`locale`),
  ADD KEY `lc_region_translations_locale_index` (`locale`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pawn_shops`
--
ALTER TABLE `pawn_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_location_id_foreign` (`location_id`);

--
-- Indexes for table `property_enquires`
--
ALTER TABLE `property_enquires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`),
  ADD KEY `wallet_transactions_origin_id_foreign` (`origin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `lc_countries`
--
ALTER TABLE `lc_countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lc_countries_geographical`
--
ALTER TABLE `lc_countries_geographical`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lc_countries_translations`
--
ALTER TABLE `lc_countries_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lc_regions`
--
ALTER TABLE `lc_regions`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lc_region_translations`
--
ALTER TABLE `lc_region_translations`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pawn_shops`
--
ALTER TABLE `pawn_shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_enquires`
--
ALTER TABLE `property_enquires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lc_countries`
--
ALTER TABLE `lc_countries`
  ADD CONSTRAINT `lc_countries_lc_region_id_foreign` FOREIGN KEY (`lc_region_id`) REFERENCES `lc_regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lc_countries_geographical`
--
ALTER TABLE `lc_countries_geographical`
  ADD CONSTRAINT `lc_countries_geographical_lc_country_id_foreign` FOREIGN KEY (`lc_country_id`) REFERENCES `lc_countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lc_countries_translations`
--
ALTER TABLE `lc_countries_translations`
  ADD CONSTRAINT `lc_countries_translations_lc_country_id_foreign` FOREIGN KEY (`lc_country_id`) REFERENCES `lc_countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lc_region_translations`
--
ALTER TABLE `lc_region_translations`
  ADD CONSTRAINT `lc_region_translations_lc_region_id_foreign` FOREIGN KEY (`lc_region_id`) REFERENCES `lc_regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_origin_id_foreign` FOREIGN KEY (`origin_id`) REFERENCES `wallet_transactions` (`id`),
  ADD CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
