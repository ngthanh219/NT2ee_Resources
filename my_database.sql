-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 02:03 PM
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
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Loại tự quy định: 0 là phiên bản, 1 là màu, ...',
  `description` text DEFAULT NULL COMMENT 'Mô tả cụ thể cho loại này',
  `name` varchar(255) NOT NULL COMMENT 'Ví dụ name là 256GB, thì type là 0 chẳng hạn, và mô tả là dung lượng của sản phẩm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `type`, `description`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dung lượng thiết bị', '128GB', '2024-10-14 10:03:15', '2024-10-14 10:35:31'),
(2, 2, 'Dung lượng thiết bị', '256GB', '2024-10-14 10:06:38', '2024-10-14 10:06:38'),
(3, 2, 'Dung lượng thiết bị', '512GB', '2024-10-14 10:06:53', '2024-10-16 07:12:53'),
(4, 2, 'Dung lượng thiết bị', '1TB', '2024-10-14 10:07:03', '2024-10-14 10:07:03'),
(6, 1, NULL, 'Trắng', '2024-10-14 10:38:23', '2024-10-14 10:38:23'),
(7, 1, NULL, 'Đen', '2024-10-14 10:38:27', '2024-10-14 10:38:27'),
(8, 1, NULL, 'Hồng', '2024-10-14 10:38:31', '2024-10-14 10:38:31'),
(9, 1, NULL, 'Vàng', '2024-10-14 10:38:34', '2024-10-14 10:38:34'),
(10, 1, NULL, 'Đỏ', '2024-10-14 10:38:39', '2024-10-14 10:38:39'),
(11, 1, NULL, 'Xanh', '2024-10-14 10:38:44', '2024-10-14 10:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `view`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', 0, 0, '2024-10-14 04:06:35', '2024-10-14 06:36:42'),
(2, 'Laptop', 0, 0, '2024-10-14 04:06:50', '2024-10-14 04:06:50'),
(3, 'Tablet', 0, 0, '2024-10-14 04:07:32', '2024-10-14 04:07:32'),
(11, 'Iphone', 0, 1, '2024-10-14 04:07:32', '2024-10-14 04:07:32'),
(12, 'Samsung', 0, 1, '2024-10-14 04:07:32', '2024-10-14 04:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(11, 9),
(11, 11);

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `product_price_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_08_085433_create_categories_table', 1),
(6, '2024_10_08_085449_create_products_table', 1),
(7, '2024_10_08_091050_create_category_product_table', 1),
(8, '2024_10_08_091325_create_stores_table', 1),
(9, '2024_10_08_092231_create_attributes_table', 1),
(10, '2024_10_08_095520_create_product_prices_table', 1),
(11, '2024_10_08_100700_create_inventories_table', 1),
(14, '2024_10_08_103409_create_orders_table', 2),
(15, '2024_10_08_105115_create_order_details_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `total` double NOT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_paid` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `note`, `total`, `payment_method`, `status`, `is_paid`, `created_at`, `updated_at`) VALUES
(1, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', NULL, 123000000, 0, 1, 1, '2024-10-18 11:02:27', '2024-10-18 11:02:27'),
(2, 3, 'Phương Linh', 'phlinh@gmail.com', '0987587966', 'Hà Nội', 'Đơn hàng thanh toán', 32299000, 0, 2, 2, '2024-10-18 12:01:00', '2024-10-18 12:01:00'),
(3, 3, 'Phương Linh', 'phlinh@gmail.com', '0987587966', 'Hà Nội', NULL, 48500000, 0, 1, 1, '2024-10-18 12:01:44', '2024-10-18 12:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_price_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `store_id`, `product_price_id`, `product_name`, `product_price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 13, 'Iphone 15 pro max - Đen - 256GB', 26000000, 1, 26000000, '2024-10-18 11:02:27', '2024-10-18 11:02:27'),
(2, 1, NULL, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 2, 97000000, '2024-10-18 11:02:27', '2024-10-18 11:02:27'),
(3, 2, NULL, 10, 'Iphone 15 pro max - Trắng - 512GB', 32299000, 1, 32299000, '2024-10-18 12:01:00', '2024-10-18 12:01:00'),
(4, 3, NULL, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 1, 48500000, '2024-10-18 12:01:44', '2024-10-18 12:01:44');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `image` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `description`, `view`, `created_at`, `updated_at`) VALUES
(9, 'Iphone 15 pro max', 'iphone-15-pro-max', '[\"products\\/2024-10-15-11-42-39670df2bf87c2b.webp\"]', '<p>Đang cập nhật</p>', 0, '2024-10-15 04:42:39', '2024-10-15 09:33:57'),
(11, 'Iphone 16 pro max', 'iphone-16-pro-max', '[\"products\\/2024-10-17-03-10-526710c68c4a659.webp\"]', '<p>Updating</p>', 0, '2024-10-17 08:10:52', '2024-10-17 09:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attribute_ids` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0 COMMENT 'Giá gốc',
  `sale_percent` double NOT NULL DEFAULT 0 COMMENT 'Khuyến mãi',
  `sale_price` double NOT NULL DEFAULT 0 COMMENT 'Giá khuyến mãi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_prices`
--

INSERT INTO `product_prices` (`id`, `product_id`, `attribute_ids`, `quantity`, `price`, `sale_percent`, `sale_price`, `created_at`, `updated_at`) VALUES
(2, 9, '[\"6\",\"2\"]', 10, 28000000, 10, 24999000, '2024-10-16 07:04:59', '2024-10-16 08:24:13'),
(10, 9, '[\"6\",\"3\"]', 10, 35890000, 10, 32299000, '2024-10-16 08:26:50', '2024-10-16 08:26:50'),
(11, 9, '[\"6\",\"4\"]', 10, 41990000, 2, 40999000, '2024-10-16 08:27:43', '2024-10-16 08:27:52'),
(13, 9, '[\"7\",\"2\"]', 10, 28000000, 6, 26000000, '2024-10-16 08:28:48', '2024-10-16 08:29:23'),
(18, 11, '[\"9\",\"4\"]', 10, 49000000, 1, 48500000, '2024-10-17 08:11:27', '2024-10-17 08:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `iframe` text DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `address`, `phone`, `email`, `iframe`, `view`, `created_at`, `updated_at`) VALUES
(1, '382 Nguyễn Văn Cừ, Hà Nội', '0915963222', 'nguyenvancu@hoangha.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.6742606871617!2d105.87394527587274!3d21.045715787194716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a97e152f94cf%3A0x1f99a678efa8a2a2!2zSG_DoG5nIEjDoCBNb2JpbGU!5e0!3m2!1svi!2s!4v1729148563817!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2024-10-17 03:58:46', '2024-10-17 07:03:05'),
(2, '348 Hồ Tùng Mậu, Cầu Diễn, Từ Liêm, Hà Nội', '0965868348', 'hotungmau@hoangha.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.7902258673394!2d105.76144337587266!3d21.041077987354207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c0d1e97ca1%3A0xbb1987579fac3ecd!2zMzQ4IMSQLiBI4buTIFTDuW5nIE3huq11LCBD4bqndSBEaeG7hW4sIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1729148543561!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, '2024-10-17 04:01:38', '2024-10-17 07:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3 COMMENT '0: Admin, 1: Quản lý, 2: Nhân viên, 3: Khách hàng',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin', 'admin@gmail.com', NULL, '$2y$10$kUBB1fhMTcADPXMUlVhGDuh0FgRwV0bpSfADGJ.FPeLjh0.KfKM0y', NULL, NULL, NULL, '2024-10-09 03:21:16', '2024-10-14 08:24:55'),
(2, 1, 'admin1', 'admin1@gmail.com', NULL, '$2y$10$KHHanA1bCMtLiVYuuMs/pe2XW1fsXg8WF/Fh2761Pe.MvpriJDgWe', NULL, NULL, NULL, '2024-10-09 03:21:16', '2024-10-14 02:35:32'),
(3, 3, 'Phương Linh', 'phlinh@gmail.com', NULL, '$2y$10$kbzKrq2cXF9I4pEPztFnSOOS0zUETUL6dtbtQzU49cKlJ3HomPHWO', '0987587966', 'Hà Nội', NULL, '2024-10-11 09:31:22', '2024-10-17 07:06:34'),
(4, 2, 'thangvd', 'thangvd@gmail.com', NULL, '$2y$10$nzGkbl5hsRc9jR1RGafBAeFhaS2YOwAlw4xcnD4t6V4pe2.PWbeK2', '0963658744', 'Nguyễn Trãi', NULL, '2024-10-14 01:53:32', '2024-10-14 01:53:32'),
(5, 3, 'hieuhv', 'hieuhv@gmail.com', NULL, '$2y$10$ObqyI3cRXlz.iY4GWTQa1OGaBWopXP2w.7XlkGU2QvP6DRzqlLS9q', '0965441254', 'Hà Nội', NULL, '2024-10-14 02:08:15', '2024-10-17 07:15:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD UNIQUE KEY `products_slug_unique` (`slug`) USING HASH;

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
