-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itqan`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `address_title` varchar(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `city_id`, `user_id`, `lat`, `lng`, `address_title`, `recipient_name`, `recipient_phone`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 10.522260329097259, 29.904635958373543, 'Work2', 'Hamza', '546349264', 'Al Buram', NULL, '2024-05-18 01:06:32', '2024-05-27 19:51:24'),
(2, 1, 3, 0, 0, 'Home', 'Hamza', '546349264', 'Address Street for Home', '2024-05-18 01:10:57', '2024-05-18 01:10:25', '2024-05-18 01:10:57'),
(3, 1, 3, 37.4219983, -122.084, 'test', 'test', '546349264', '1600 Amphitheatre Pkwy Building 43', NULL, '2024-05-25 02:55:32', '2024-05-25 02:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `super` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `super`, `email`, `phone`, `role_id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'FansFood', '$2y$10$DP6UT4lf0ygPzwBkkdSlkuX/00Uwoe3l0n6SOb2KH.q3wann3e4zW', 1, 'admin@admin.com', '555555555', 0, 0, '2024-05-17 21:36:30', '2024-05-17 21:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'banner_image.png', NULL, NULL),
(2, 'banner2.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `percentage` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `color`, `name_ar`, `name_en`, `percentage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'category1_image.png', '#D80027', 'دهان منازل', 'House painting', 0, NULL, NULL, NULL),
(2, 'category2_image.png', '#BA59FE', 'خدمه نقل', 'Transportation service', 0, NULL, NULL, NULL),
(3, 'category3_image.png', '#2299DD', 'كهرباء', 'Electricity', 0, NULL, NULL, NULL),
(4, 'category4_image.png', '#4FBF67', 'منظفات', 'Detergent', 0, NULL, '2024-05-24 01:29:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_provider_id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `service_provider_id`, `service_order_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 4, '2024-05-27 07:35:19', '2024-05-27 07:35:19'),
(3, 3, 10, 6, '2024-05-30 11:26:11', '2024-05-30 11:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'الرياض', 'Riyadh', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `rate` double NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `market_id`, `rate`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 4.5, 'Very Good', '2024-05-18 02:26:12', '2024-05-18 02:26:12'),
(2, 3, 3, 4.5, 'test', '2024-05-26 12:20:57', '2024-05-26 12:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `email`, `title`, `message`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'hamza@hamza.com', 'test', 'test', 'user', '2024-05-18 06:24:04', '2024-05-18 06:24:04'),
(2, 3, 'test@test.com', 'test', 'test', 'user', '2024-05-27 20:17:48', '2024-05-27 20:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lang` enum('ar','en') NOT NULL DEFAULT 'ar',
  `logo` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT 0,
  `address` text NOT NULL,
  `work_hours` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_price` double NOT NULL DEFAULT 0,
  `wallet` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `lang`, `logo`, `image`, `name`, `description`, `status`, `lat`, `lng`, `email`, `phone`, `password`, `block`, `address`, `work_hours`, `city_id`, `delivery_price`, `wallet`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ar', NULL, NULL, 'Market1', 'Market1', 1, 0, 0, 'market@market.com 0', '546349264 0', '$2y$10$vzprJ9SMqjK7dHKnX8y30O5nfjcFW5O2XnOpdIBNK3hb4upjybL3u', 0, 'address', '8:00 AM - 22:00 PM', 1, 0, 0, '2024-05-18 21:00:38', NULL, '2024-05-18 21:00:38'),
(3, 'ar', '1716065387571547_markets.png', '1716065313186480_markets.png', 'Market Hamza', 'Hamza Market', 1, 1, 1, 'hhamza@hamzxa.com', '546349266', '$2y$10$mFczqOhj8yKdV5SjakuM6epgwB2unpEqqT1R.HahJ5099TEAiWqdO', 0, 'Riyadh Street', '12 - 12', 1, 50, 0, NULL, '2024-05-18 20:18:22', '2024-05-18 20:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `market_categories`
--

CREATE TABLE `market_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_categories`
--

INSERT INTO `market_categories` (`id`, `market_id`, `category_id`, `created_at`, `updated_at`) VALUES
(16, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `from` enum('user','service_provider') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `message`, `from`, `created_at`, `updated_at`) VALUES
(3, 2, 'test', 'user', '2024-05-27 07:36:03', '2024-05-27 07:36:03'),
(4, 2, 'test', 'user', '2024-05-27 07:36:07', '2024-05-27 07:36:07');

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
(1, '00_create_users_table', 1),
(2, '01_create_admins_table', 1),
(3, '01_create_banners_table', 1),
(4, '01_create_categories_table', 1),
(5, '01_create_cities_table', 1),
(6, '01_create_notifications_table', 1),
(7, '01_create_permissions_table', 1),
(8, '01_create_service_providers_table', 1),
(9, '01_create_settings_table', 1),
(10, '02_create_addresses_table', 1),
(11, '02_create_markets_table', 1),
(12, '02_create_roles_table', 1),
(13, '02_create_sub_categories_table', 1),
(14, '02_create_user_tokens_table', 1),
(15, '03_create_comments_table', 1),
(16, '03_create_market_categories_table', 1),
(17, '03_create_role_permissions_table', 1),
(18, '03_create_sections_table', 1),
(19, '03_create_service_orders_table', 1),
(20, '03_create_service_provider_categories_table', 1),
(21, '04_create_chats_table', 1),
(22, '04_create_products_table', 1),
(23, '04_create_service_order_finish_images_table', 1),
(24, '04_create_service_order_images_table', 1),
(25, '04_create_service_order_offers_table', 1),
(26, '05_carts_table', 1),
(27, '05_create_contact_us_table', 1),
(28, '05_create_messages_table', 1),
(29, '05_create_orders_table', 1),
(30, '06_create_order_products_table', 1),
(31, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `description_ar` text NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_en` text NOT NULL,
  `type` enum('user','delivery','markets') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `note` text DEFAULT NULL,
  `sub_total` double NOT NULL DEFAULT 0,
  `taxes` double NOT NULL DEFAULT 0,
  `delivery_price` double NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `payment_method` enum('visa','cash') NOT NULL,
  `status` enum('new','in_progress','delivery','complete','canceled') NOT NULL DEFAULT 'new',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `market_id`, `address_id`, `note`, `sub_total`, `taxes`, `delivery_price`, `total`, `payment_method`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 1, 'test', 5, 0.75, 0, 10.75, 'cash', 'in_progress', NULL, '2024-05-18 03:45:17', '2024-05-18 22:21:49'),
(4, 3, 3, 3, NULL, 150, 22.5, 50, 222.5, 'cash', 'new', NULL, '2024-05-27 02:55:49', '2024-05-27 02:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 2, 50, NULL, '2024-05-18 03:45:17', '2024-05-18 03:45:17'),
(3, 4, 1, 3, 50, NULL, '2024-05-27 02:55:49', '2024-05-27 02:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `offer_price` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `image`, `title`, `description`, `price`, `offer_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'test', 'test', 50, NULL, NULL, NULL, NULL),
(3, 2, '1716080435435070_products.png', 'Product Title 2', 'Product Description', 50, NULL, '2024-05-19 01:02:22', '2024-05-19 00:51:39', '2024-05-19 01:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `market_id`, `title`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'Test Section', '1716079191832727_sections.png', NULL, NULL, '2024-05-19 00:39:51'),
(2, 3, 'Test Section', '1716080296162011_sections.png', NULL, '2024-05-19 00:32:27', '2024-05-19 00:58:16'),
(3, 3, 'Test Category', '1716079204283686_sections.png', NULL, '2024-05-19 00:40:04', '2024-05-19 00:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `service_orders`
--

CREATE TABLE `service_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `video` varchar(255) DEFAULT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('new','in_progress','service_provider_finish','complete','canceled') NOT NULL DEFAULT 'new',
  `deposit_paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` enum('visa','cash') NOT NULL DEFAULT 'cash',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_orders`
--

INSERT INTO `service_orders` (`id`, `user_id`, `notes`, `sub_category_id`, `order_date`, `video`, `video_image`, `address_id`, `status`, `deposit_paid`, `payment_method`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 3, 'test', 9, '2024-05-30 10:34:37', '1716614143322314_service_orders.mp4', '1716614143325421_service_orders.jpg', 3, 'complete', 1, 'cash', NULL, '2024-05-25 05:15:43', '2024-05-27 08:32:21'),
(5, 3, 'new or', 9, '2024-05-30 09:28:37', NULL, NULL, 3, 'new', 0, 'cash', NULL, '2024-05-27 03:57:20', '2024-05-27 10:04:47'),
(6, 3, 'tesdt', 8, '2024-05-30 11:36:54', NULL, NULL, 3, 'service_provider_finish', 0, 'cash', NULL, '2024-05-27 03:58:19', '2024-05-30 11:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `service_order_finish_images`
--

CREATE TABLE `service_order_finish_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_order_finish_images`
--

INSERT INTO `service_order_finish_images` (`id`, `service_order_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, '1717069013041239_service_orders.jpg', NULL, '2024-05-30 11:36:53', '2024-05-30 11:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `service_order_images`
--

CREATE TABLE `service_order_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_order_images`
--

INSERT INTO `service_order_images` (`id`, `service_order_id`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 4, '1716614143326678_service_orders.jpg', NULL, '2024-05-25 05:15:43', '2024-05-25 05:15:43'),
(6, 4, '1716614143336918_service_orders.jpg', NULL, '2024-05-25 05:15:43', '2024-05-25 05:15:43'),
(7, 4, '1716614143340013_service_orders.jpg', NULL, '2024-05-25 05:15:43', '2024-05-25 05:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `service_order_offers`
--

CREATE TABLE `service_order_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_provider_id` bigint(20) UNSIGNED NOT NULL,
  `service_order_id` bigint(20) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `deposit` double DEFAULT NULL,
  `status` enum('progress','accepted','refused','closed') NOT NULL DEFAULT 'progress',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_order_offers`
--

INSERT INTO `service_order_offers` (`id`, `service_provider_id`, `service_order_id`, `time`, `description`, `price`, `deposit`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 4, '2024-05-28 09:19:36', 'i am very good', 50, 10, 'closed', NULL, NULL, '2024-05-28 09:19:36'),
(6, 10, 4, '2024-05-30 10:35:20', 'i am very good again', 50, 10, 'accepted', NULL, NULL, '2024-05-28 09:19:36'),
(8, 10, 6, '2024-05-30 10:20:28', 'test', 50, 10, 'accepted', NULL, '2024-05-28 09:15:49', '2024-05-28 09:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lang` enum('ar','en') NOT NULL DEFAULT 'ar',
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `wallet` double(8,2) NOT NULL DEFAULT 0.00,
  `block` tinyint(1) NOT NULL DEFAULT 0,
  `online` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `name`, `lang`, `email`, `phone`, `image`, `password`, `wallet`, `block`, `online`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'test', 'ar', 'test@test.com', '546349265', NULL, '123456', 0.00, 0, 1, NULL, NULL, NULL),
(8, 'Service Hamza', 'ar', 'hamza@service.com 0', '546349266 0', '1716083254867978_service_provider.png', '$2y$10$ex3xPJa5ZbVrhXhPsVOwd.Ak3AQSl05Fiz6U6lHqj5ub5z9CSYQb6', 0.00, 0, 1, '2024-05-19 01:49:38', '2024-05-19 01:37:20', '2024-05-19 01:49:38'),
(9, 'Hamza Service', 'ar', 'hamza@service.com', '546349266', '1716083387294605_service_provider.png', '$2y$10$UQg01eLq74K5Z3CVRcn/new8OFewh7d2ZY86B4Br970vlUdQXRG7e', 0.00, 0, 1, NULL, '2024-05-19 01:49:47', '2024-05-19 01:49:47'),
(10, 'hamza', 'ar', 'hamza@test.com', '546349264', '1716976173624951_service_provider.jpg', '$2y$10$VodX2BQyChjEz4KNglcYoO3QgnMzLIEQn0lgi6euazJqnnIqMEwDm', 0.00, 0, 1, NULL, '2024-05-29 09:49:33', '2024-05-30 21:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_categories`
--

CREATE TABLE `service_provider_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_provider_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_provider_categories`
--

INSERT INTO `service_provider_categories` (`id`, `service_provider_id`, `category_id`, `created_at`, `updated_at`) VALUES
(16, 9, 1, NULL, NULL),
(17, 9, 2, NULL, NULL),
(18, 9, 3, NULL, NULL),
(19, 9, 4, NULL, NULL),
(20, 10, 4, NULL, NULL),
(21, 10, 3, NULL, NULL),
(22, 10, 2, NULL, NULL),
(23, 10, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `terms_ar` text NOT NULL,
  `terms_en` text NOT NULL,
  `privacy_ar` text NOT NULL,
  `privacy_en` text NOT NULL,
  `about_ar` text NOT NULL,
  `about_en` text NOT NULL,
  `payment_activated` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_user` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_user_ios` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_service_provider` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_service_provider_ios` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_market` tinyint(1) NOT NULL DEFAULT 0,
  `must_update_market_ios` tinyint(1) NOT NULL DEFAULT 0,
  `user_version` int(3) NOT NULL DEFAULT 1,
  `user_ios_version` int(3) NOT NULL DEFAULT 1,
  `service_provider_version` int(3) NOT NULL DEFAULT 1,
  `service_provider_ios_version` int(3) NOT NULL DEFAULT 1,
  `market_version` int(3) NOT NULL DEFAULT 1,
  `market_version_ios` int(3) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `phone`, `terms_ar`, `terms_en`, `privacy_ar`, `privacy_en`, `about_ar`, `about_en`, `payment_activated`, `must_update_user`, `must_update_user_ios`, `must_update_service_provider`, `must_update_service_provider_ios`, `must_update_market`, `must_update_market_ios`, `user_version`, `user_ios_version`, `service_provider_version`, `service_provider_ios_version`, `market_version`, `market_version_ios`, `created_at`, `updated_at`) VALUES
(1, '0123456789', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, '2024-05-17 21:36:30', '2024-05-17 21:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `percentage` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `image`, `name_ar`, `name_en`, `category_id`, `percentage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'aircondition.png', 'صيانه تكييف', 'Air conditioning maintenance', 3, NULL, NULL, NULL, NULL),
(3, 'lamp.png', 'تغيير مصباح', 'Change a lamp', 3, NULL, NULL, NULL, NULL),
(4, 'spray.png', 'رش الشقق السكنيه', 'Spraying residential apartments', 1, NULL, NULL, NULL, NULL),
(5, 'transport.png', 'نقل اثاث منزلي', 'Home furniture transportation', 2, NULL, NULL, NULL, NULL),
(6, 'spray.png', 'رش الشقق السكنيه', 'Spraying residential apartments', 4, NULL, NULL, NULL, NULL),
(7, 'spray.png', 'رش الشقق السكنيه', 'Spraying residential apartments', 4, NULL, NULL, NULL, NULL),
(8, 'spray.png', 'رش الشقق السكنيه', 'Spraying residential apartments', 4, NULL, NULL, NULL, NULL),
(9, 'spray.png', 'رش الشقق السكنيه', 'Spraying residential apartments', 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `lang` enum('ar','en') NOT NULL DEFAULT 'ar',
  `wallet` double NOT NULL DEFAULT 0,
  `block` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `password`, `lang`, `wallet`, `block`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Hamza Mahmoud Fouad', '546349264   0', '546349264  0', NULL, '$2y$10$Ot/NlF7NC2vw.kooStV3nua.kNbenewi9fswAVePi1Tr9MMkVihQy', 'ar', 500, 0, '2024-05-17 23:24:40', '2024-05-17 22:55:17', '2024-05-17 23:24:40'),
(3, 'Hamza Mahmoud', 'hamza@hamza.com', '546349264', NULL, '$2y$10$VKHo3BNt6kQBySqax.3sc.Q5Bzf3zjKJw1vrK.O23M11ICnNyqYNi', 'ar', 168, 0, NULL, '2024-05-17 23:24:46', '2024-05-28 11:22:14'),
(4, 'Hamza Mahmoud', 'hamza@app.com', '546349266', '1716163493443984_users.jpg', '$2y$10$.JU0tk.WxOtZ3dbwG9LXye/EP2SJMqYhKn1.P5I2Ad/CFnYFiaeSq', 'ar', 0, 0, NULL, '2024-05-20 00:04:53', '2024-05-20 00:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('user','market','service_provider') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `token`, `user_id`, `type`, `created_at`, `updated_at`) VALUES
(52, 'fOXRrRiNS7i_RR0osoq3Et:APA91bFfdDJFACPIrFXeLDgAnxFuRwrhuudJn4Aru8meEODmNdF7htQLJ-jq38D_Zn10KlpXDzld3WoGIukO5jbrrqjmps0d63Qwjfs6i6V1Trvh-MfUP9b495nHBw5YTsCLJLG5W9Wb', 4, 'user', '2024-05-20 00:48:17', '2024-05-20 00:48:17'),
(73, 'cD22VlayTpa3DG4Hot1NHl:APA91bGm3DZYSWzb7dRy1h_uNlipkM1U5Twy9mkVCHNlAvD61d51l85wEgl2PHsh07YmctQDYEbdHq_VihSfNekq2R463F6ghaffcPs6LRmjKMfCHF7Cfu4u088jbBufNQAe6IY30LYl', 3, 'user', '2024-05-25 05:19:59', '2024-05-25 05:19:59'),
(183, 'eMmj2LkPRIidCTKO-Tc09D:APA91bGynHFKp_slXbAdR-qY0-Gvl2yMHzXSPMIFopbNXyKSkGH9JJxh_xzOUAlFbEQZUulz6rh6Zx_raODOPWw3CaunsLkip-SZd1x1t_EbGp0_dL8fON5rL6HD7608VtcicQsBHZ3b', 3, 'user', '2024-05-28 10:41:37', '2024-05-28 10:41:37'),
(187, 'e2i514u3SEWi6LXV7p4Ac1:APA91bHykC_tTIi_6KLtgqX9TTd4wFHmwfQUDeFlA-gqkRxPwB-2hm-h1LO_CUH76ObPfnZ9KwqieOMFn4xTNCWtx9Iw5XCp4AjfARTD2UVj-Wiyi1A0qBMc7yRZbWq-CMQQ0plxhq9V', 3, 'user', '2024-05-28 11:34:46', '2024-05-28 11:34:46'),
(204, '123', 9, 'service_provider', '2024-05-30 13:02:35', '2024-05-30 13:02:35'),
(210, 'eVkaALZyTlOeQtQA_4P4y-:APA91bEMWHG_XoEHSpK3JOSCYtK-9kz65d01gPPpdDLViZ-fZ_s_JItlItYNcce7vQML95NLQx5l34zVP9zAdU4UGTWICV2OLo7hjZvRvWbqUTdV9NDveQeWzCvpZD0iEYheXyeKa3Ca', 10, 'service_provider', '2024-05-30 21:57:21', '2024-05-30 21:57:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_city_id_foreign` (`city_id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_market_id_foreign` (`market_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_id_foreign` (`user_id`),
  ADD KEY `chats_service_provider_id_foreign` (`service_provider_id`),
  ADD KEY `chats_service_order_id_foreign` (`service_order_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_market_id_foreign` (`market_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `markets_email_unique` (`email`),
  ADD KEY `markets_city_id_foreign` (`city_id`);

--
-- Indexes for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `market_categories_market_id_foreign` (`market_id`),
  ADD KEY `market_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_chat_id_foreign` (`chat_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_market_id_foreign` (`market_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_section_id_foreign` (`section_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_market_id_foreign` (`market_id`);

--
-- Indexes for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_orders_user_id_foreign` (`user_id`),
  ADD KEY `service_orders_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `service_orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `service_order_finish_images`
--
ALTER TABLE `service_order_finish_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_order_finish_images_service_order_id_foreign` (`service_order_id`);

--
-- Indexes for table `service_order_images`
--
ALTER TABLE `service_order_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_order_images_service_order_id_foreign` (`service_order_id`);

--
-- Indexes for table `service_order_offers`
--
ALTER TABLE `service_order_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_order_offers_service_provider_id_foreign` (`service_provider_id`),
  ADD KEY `service_order_offers_service_order_id_foreign` (`service_order_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_providers_email_unique` (`email`),
  ADD UNIQUE KEY `service_providers_phone_unique` (`phone`);

--
-- Indexes for table `service_provider_categories`
--
ALTER TABLE `service_provider_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_provider_categories_service_provider_id_foreign` (`service_provider_id`),
  ADD KEY `service_provider_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `market_categories`
--
ALTER TABLE `market_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_order_finish_images`
--
ALTER TABLE `service_order_finish_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_order_images`
--
ALTER TABLE `service_order_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_order_offers`
--
ALTER TABLE `service_order_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_provider_categories`
--
ALTER TABLE `service_provider_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `markets`
--
ALTER TABLE `markets`
  ADD CONSTRAINT `markets_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD CONSTRAINT `market_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `market_categories_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_market_id_foreign` FOREIGN KEY (`market_id`) REFERENCES `markets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD CONSTRAINT `service_orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_orders_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_order_finish_images`
--
ALTER TABLE `service_order_finish_images`
  ADD CONSTRAINT `service_order_finish_images_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_order_images`
--
ALTER TABLE `service_order_images`
  ADD CONSTRAINT `service_order_images_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_order_offers`
--
ALTER TABLE `service_order_offers`
  ADD CONSTRAINT `service_order_offers_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_order_offers_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_provider_categories`
--
ALTER TABLE `service_provider_categories`
  ADD CONSTRAINT `service_provider_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_provider_categories_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
