-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 11:31 AM
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
(11, 11),
(12, 12);

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

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `store_id`, `product_price_id`, `quantity`, `view`, `created_at`, `updated_at`) VALUES
(1, 2, 18, 3, 0, '2024-10-23 02:49:30', '2024-10-23 09:17:09'),
(2, 2, 2, 3, 0, '2024-10-23 04:35:38', '2024-10-23 09:17:10'),
(3, 2, 10, 2, 0, '2024-10-23 04:35:46', '2024-10-23 09:21:16'),
(4, 2, 11, 3, 0, '2024-10-23 04:35:48', '2024-10-23 09:17:14'),
(5, 2, 13, 3, 0, '2024-10-23 04:35:50', '2024-10-23 09:17:15'),
(6, 1, 18, 0, 0, '2024-10-23 04:49:47', '2024-10-23 04:51:01');

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
(15, '2024_10_08_105115_create_order_details_table', 2),
(16, '2024_10_21_110735_add_restock_on_cancel_in_orders_table', 3),
(19, '2024_10_21_172725_create_posts_table', 4),
(20, '2024_10_24_153756_add_columns_in_products_table', 5);

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
  `restock_on_cancel` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `note`, `total`, `payment_method`, `status`, `is_paid`, `restock_on_cancel`, `created_at`, `updated_at`) VALUES
(1, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', NULL, 123000000, 0, 4, 2, 0, '2023-08-18 11:02:27', '2023-08-21 03:05:19'),
(2, 3, 'Phương Linh', 'phlinh@gmail.com', '0987587966', 'Hà Nội', 'Đơn hàng thanh toán', 32299000, 0, 4, 2, 0, '2024-09-18 12:01:00', '2024-09-21 04:37:07'),
(4, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', 'Giao hỏa tốc', 123497000, 0, 4, 2, 0, '2024-10-21 03:00:14', '2024-10-21 07:13:57'),
(6, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', 'SSS', 121999000, 0, 4, 2, 0, '2024-10-21 04:37:38', '2024-10-21 07:14:05'),
(8, 3, 'Phương Linh', 'phlinh@gmail.com', '0987587966', 'Hà Nội', NULL, 97000000, 0, 4, 2, 0, '2024-10-23 08:51:22', '2024-10-23 09:45:10'),
(9, 3, 'Phương Linh', 'phlinh@gmail.com', '0987587966', 'Hà Nội', NULL, 421391000, 0, 4, 2, 0, '2024-10-23 09:16:03', '2024-10-23 09:45:07'),
(10, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', NULL, 64598000, 0, 4, 2, 0, '2024-10-23 09:20:48', '2024-10-23 09:44:35'),
(11, 5, 'hieuhv', 'hieuhv@gmail.com', '0965441254', 'Hà Nội', NULL, 32299000, 0, 4, 2, 0, '2024-10-23 09:21:16', '2024-10-23 09:44:26');

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
(1, 1, NULL, 13, 'Iphone 15 pro max - Đen - 256GB', 26000000, 1, 26000000, '2023-08-18 11:02:27', '2023-08-18 11:02:27'),
(2, 1, NULL, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 2, 97000000, '2023-08-18 11:02:27', '2023-08-18 11:02:27'),
(3, 2, NULL, 10, 'Iphone 15 pro max - Trắng - 512GB', 32299000, 1, 32299000, '2024-09-18 12:01:00', '2024-09-18 12:01:00'),
(5, 4, NULL, 2, 'Iphone 15 pro max - Trắng - 256GB', 24999000, 3, 74997000, '2024-10-21 03:00:14', '2024-10-21 03:00:14'),
(6, 4, NULL, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 1, 48500000, '2024-10-21 03:00:14', '2024-10-21 03:00:14'),
(9, 6, NULL, 2, 'Iphone 15 pro max - Trắng - 256GB', 24999000, 1, 24999000, '2024-10-21 04:37:38', '2024-10-21 04:37:38'),
(10, 6, NULL, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 2, 97000000, '2024-10-21 04:37:38', '2024-10-21 04:37:38'),
(12, 8, 2, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 2, 97000000, '2024-10-23 08:51:22', '2024-10-23 08:51:22'),
(13, 9, 2, 2, 'Iphone 15 pro max - Trắng - 256GB', 24999000, 3, 74997000, '2024-10-23 09:16:03', '2024-10-23 09:16:03'),
(14, 9, 2, 10, 'Iphone 15 pro max - Trắng - 512GB', 32299000, 3, 96897000, '2024-10-23 09:16:03', '2024-10-23 09:16:03'),
(15, 9, 2, 11, 'Iphone 15 pro max - Trắng - 1TB', 40999000, 3, 122997000, '2024-10-23 09:16:03', '2024-10-23 09:16:03'),
(16, 9, 2, 13, 'Iphone 15 pro max - Đen - 256GB', 26000000, 3, 78000000, '2024-10-23 09:16:03', '2024-10-23 09:16:03'),
(17, 9, 2, 18, 'Iphone 16 pro max - Vàng - 1TB', 48500000, 1, 48500000, '2024-10-23 09:16:03', '2024-10-23 09:16:03'),
(18, 10, NULL, 10, 'Iphone 15 pro max - Trắng - 512GB', 32299000, 2, 64598000, '2024-10-23 09:20:48', '2024-10-23 09:20:48'),
(19, 11, 2, 10, 'Iphone 15 pro max - Trắng - 512GB', 32299000, 1, 32299000, '2024-10-23 09:21:16', '2024-10-23 09:21:16');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `short_description` text NOT NULL,
  `content` longtext NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `image`, `name`, `slug`, `short_description`, `content`, `view`, `created_at`, `updated_at`) VALUES
(2, 'posts/2024-10-21-05-57-41671633a539ec3.webp', 'Lenovo ra mắt trợ lý thông minh AI Buddy', 'lenovo-ra-mat-tro-ly-thong-minh-ai-buddy', 'Các nhà sản xuất không ngừng nghiên cứu và giới thiệu các giải pháp AI thông minh. Mới đây, Lenovo vừa ra mắt trợ lý thông minh AI Buddy – một bước đột phá trong công nghệ cá nhân hóa. AI Buddy không chỉ hỗ trợ người dùng quản lý công việc hàng ngày mà còn hỗ trợ tốt theo thói quen riêng của mỗi cá nhân.', '<h2><strong>Lenovo ra mắt trợ lý thông minh AI Buddy</strong></h2><p>Tại Hội nghị Công nghệ đổi mới Lenovo năm 2024, nhà sản xuất này đã ra mắt nguyên mẫu trợ lý nhà thông minh mang tên mã là “AI Buddy”. Được thiết kế nhằm cạnh tranh với các sản phẩm nổi tiếng như Echo của Amazon, Lenovo AI Buddy nổi bật với những yếu tố thiết kế độc đáo và tính năng cải tiến, tạo ra sự khác biệt so với các trợ lý nhà thông minh hiện có trên thị trường. Tổng giám đốc điều hành Lenovo, Yang Yuanqing, đã cùng Tổng giám đốc Meta, Mark Zuckerberg, ra mắt AI Buddy và công bố mối quan hệ hợp tác giữa hai công ty để phát triển AI Now – Đây là một trợ lý AI cá nhân cho PC dựa trên mô hình lớn Llama của Meta.</p><figure class=\"image\"><picture><source srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/1-23.jpg.webp 800w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/1-23-300x169.jpg.webp 300w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/1-23-768x432.jpg.webp 768w\" type=\"image/webp\" sizes=\"(max-width: 800px) 100vw, 800px\"><img src=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/1-23.jpg\" alt=\"AI Buddy\" srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/1-23.jpg 800w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/1-23-300x169.jpg 300w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/1-23-768x432.jpg 768w\" sizes=\"100vw\" width=\"800\" height=\"450\"></picture></figure><p>Sản phẩm có hình dạng tương tự như một đế sạc MagSafe cỡ lớn có thể gập lại, với màn hình tròn ở trên cùng hiển thị đôi mắt hoạt, hình dưới dạng biểu tượng cảm xúc, giúp mô phỏng cảm xúc và nâng cao khả năng tương tác với người dùng. Biểu cảm này gợi nhớ đến Robot máy tính để bàn Android JoyfulRobotics, được phát triển bởi một cựu nhân viên Xiaomi vào năm ngoái. Ngoài ra, màn hình còn cung cấp các thông tin thiết yếu như thời gian, cập nhật thời tiết, tùy chọn nhạc và hình ảnh cá nhân, hứa hẹn mang đến trải nghiệm công nghệ gần gũi và thân thiện hơn cho người dùng.</p><h2><strong>Thông số kỹ thuật của Lenovo AI Buddy</strong></h2><p>AI Buddy sẽ tận dụng công nghệ tiên tiến này để mang lại trải nghiệm người dùng tự nhiên và dễ thích nghi. Nó sẽ sử dụng AI dựa trên cảm xúc để tùy chỉnh phản hồi, xử lý các tác vụ như lên lịch và nhắc nhở, đồng thời học hỏi theo thời gian. AI Buddy còn được trang bị các cổng USB-A và USB-C, cùng giắc cắm tai nghe ở đế, người dùng muốn kết nối linh hoạt với các thiết bị nhà thông minh. Trợ lý thông mình này có kiểu dáng thanh lịch và tối giản, sản phẩm hoàn toàn phù hợp với triết lý thiết kế của Lenovo. các thông số kỹ thuật chi tiết của thiết bị đang được cập nhật.&nbsp;</p><figure class=\"image\"><picture><source srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/2-23.jpg.webp 800w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/2-23-300x169.jpg.webp 300w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/2-23-768x432.jpg.webp 768w\" type=\"image/webp\" sizes=\"(max-width: 800px) 100vw, 800px\"><img src=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/2-23.jpg\" alt=\"AI Buddy\" srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/2-23.jpg 800w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/2-23-300x169.jpg 300w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/2-23-768x432.jpg 768w\" sizes=\"100vw\" width=\"800\" height=\"450\"></picture></figure><p>Về hoạt động, sản phẩm này nổi bật với màn hình xoay có thể điều chỉnh, tương tự như Echo Show 10 của Amazon. Tính năng này làm cho các tương tác trở nên cá nhân và năng động, khi AI Buddy có khả năng theo dõi người dùng và điều chỉnh vị trí theo họ trong không gian. Với sự hỗ trợ của AI Now, AI Buddy giúp người dùng quản lý tác vụ, tối ưu hóa lịch trình làm việc hiệu quả. Đặc biệt, Lenovo cũng chú trọng đến bảo mật dữ liệu, đảm bảo thông tin nhạy cảm được xử lý an toàn và bảo vệ quyền riêng tư của người dùng trong mọi tương tác với AI Buddy.</p><h2><strong>Lenovo cũng đang nghiên cứu trong lĩnh vực AI</strong></h2><p>Tại sự kiện, Lenovo đã gây ấn tượng khi giới thiệu không chỉ AI Buddy mà còn nhiều nguyên mẫu độc đáo khác, trong đó nổi bật là AI Mouse. Sản phẩm này được trang bị nút AI Now chuyên dụng, cho phép tích hợp một cách mượt mà vào hệ sinh thái AI của Lenovo, mở ra nhiều cơ hội tương tác sáng tạo cho người dùng.Với khả năng học hỏi liên tục và cung cấp gợi ý thông minh, AI Buddy hứa hẹn trở thành người bạn đồng hành đáng tin cậy, giúp tối ưu hóa trải nghiệm công nghệ của người dùng.</p><figure class=\"image\"><picture><source srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/3-22.jpg.webp 800w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/3-22-300x169.jpg.webp 300w, https://hoanghamobile.com/tin-tuc/wp-content/webp-express/webp-images/uploads/2024/10/3-22-768x432.jpg.webp 768w\" type=\"image/webp\" sizes=\"(max-width: 800px) 100vw, 800px\"><img src=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/3-22.jpg\" alt=\"AI Buddy\" srcset=\"https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/3-22.jpg 800w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/3-22-300x169.jpg 300w, https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/3-22-768x432.jpg 768w\" sizes=\"100vw\" width=\"800\" height=\"450\"></picture></figure><p>Ngoài ra, Lenovo còn trình làng Lenovo Home AI Brain, một giải pháp thông minh thiết kế để quản lý, sắp xếp và bảo vệ những kỷ niệm của gia đình. Với khả năng tạo ra các đoạn phim nổi bật từ những khoảnh khắc đặc biệt, AI Brain không chỉ giúp lưu giữ những ký ức mà còn mang lại trải nghiệm thú vị, giúp gia đình cùng nhau chia sẻ lại những giây phút đáng nhứ. Sự kết hợp giữa công nghệ và cảm xúc trong những sản phẩm này hứa hẹn sẽ mang đến một trải nghiệm ý nghĩa hơn cho người dùng.</p>', 0, '2024-10-21 10:48:58', '2024-10-21 10:58:27');

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
  `is_new` int(11) NOT NULL DEFAULT 2,
  `is_hot` int(11) NOT NULL DEFAULT 2,
  `is_best_seller` int(11) NOT NULL DEFAULT 2,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `description`, `is_new`, `is_hot`, `is_best_seller`, `view`, `created_at`, `updated_at`) VALUES
(9, 'Iphone 15 pro max', 'iphone-15-pro-max', '[\"products\\/2024-10-15-11-42-39670df2bf87c2b.webp\"]', '<p>Đang cập nhật</p>', 2, 2, 2, 0, '2024-10-15 04:42:39', '2024-10-15 09:33:57'),
(11, 'Iphone 16 pro max', 'iphone-16-pro-max', '[\"products\\/2024-10-17-03-10-526710c68c4a659.webp\"]', '<p>Updating</p>', 2, 2, 2, 0, '2024-10-17 08:10:52', '2024-10-24 09:19:41');

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
(2, 9, '[\"6\",\"2\"]', 0, 28000000, 10, 24999000, '2024-10-16 07:04:59', '2024-10-23 09:17:10'),
(10, 9, '[\"6\",\"3\"]', 2, 35890000, 10, 32299000, '2024-10-16 08:26:50', '2024-10-23 09:20:48'),
(11, 9, '[\"6\",\"4\"]', 4, 41990000, 2, 40999000, '2024-10-16 08:27:43', '2024-10-23 09:17:14'),
(13, 9, '[\"7\",\"2\"]', 4, 28000000, 6, 26000000, '2024-10-16 08:28:48', '2024-10-23 09:17:15'),
(18, 11, '[\"9\",\"4\"]', 1, 49000000, 1, 48500000, '2024-10-17 08:11:27', '2024-10-23 09:17:09');

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
-- Table structure for table `stores1`
--

CREATE TABLE `stores1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `iframe` text DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 0, 'admin1', 'admin1@gmail.com', NULL, '$2y$10$KHHanA1bCMtLiVYuuMs/pe2XW1fsXg8WF/Fh2761Pe.MvpriJDgWe', NULL, NULL, NULL, '2024-10-09 03:21:16', '2024-10-24 08:30:41'),
(3, 3, 'Phương Linh', 'phlinh@gmail.com', NULL, '$2y$10$kbzKrq2cXF9I4pEPztFnSOOS0zUETUL6dtbtQzU49cKlJ3HomPHWO', '0987587966', 'Hà Nội', NULL, '2024-10-11 09:31:22', '2024-10-17 07:06:34'),
(4, 3, 'thangvd', 'thangvd@gmail.com', NULL, '$2y$10$nzGkbl5hsRc9jR1RGafBAeFhaS2YOwAlw4xcnD4t6V4pe2.PWbeK2', '0963658744', 'Nguyễn Trãi', NULL, '2024-10-14 01:53:32', '2024-10-24 08:30:54'),
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`) USING HASH;

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
-- Indexes for table `stores1`
--
ALTER TABLE `stores1`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stores1`
--
ALTER TABLE `stores1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
