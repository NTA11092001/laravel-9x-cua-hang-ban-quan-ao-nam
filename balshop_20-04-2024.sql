-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 20, 2024 lúc 11:25 PM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-cll-lve
-- Phiên bản PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `balshopc_balshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_histories`
--

CREATE TABLE `bill_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `bill_status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `bill_histories`
--

INSERT INTO `bill_histories` (`id`, `cart_id`, `bill_status`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2023-12-23 14:57:25', '2023-12-23 14:57:25'),
(2, 2, 0, '2023-12-24 12:56:25', '2023-12-24 12:56:25'),
(3, 2, 0, '2023-12-24 13:21:53', '2023-12-24 13:21:53'),
(4, 1, 1, '2023-12-24 14:08:24', '2023-12-24 14:08:24'),
(5, 3, 0, '2023-12-24 14:13:00', '2023-12-24 14:13:00'),
(6, 4, 0, '2023-12-24 14:33:47', '2023-12-24 14:33:47'),
(7, 5, 0, '2023-12-27 07:53:47', '2023-12-27 07:53:47'),
(8, 6, 0, '2024-01-13 07:49:20', '2024-01-13 07:49:20'),
(9, 7, 1, '2024-01-13 07:51:02', '2024-01-13 07:51:02'),
(10, 8, 0, '2024-01-13 07:53:22', '2024-01-13 07:53:22'),
(11, 9, 1, '2024-01-13 07:54:02', '2024-01-13 07:54:02'),
(12, 10, 0, '2024-01-14 06:53:46', '2024-01-14 06:53:46'),
(13, 11, 0, '2024-01-14 06:54:27', '2024-01-14 06:54:27'),
(14, 12, 1, '2024-01-14 06:59:36', '2024-01-14 06:59:36'),
(15, 13, 0, '2024-01-14 11:16:27', '2024-01-14 11:16:27'),
(16, 14, 0, '2024-01-15 16:51:07', '2024-01-15 16:51:07'),
(17, 15, 0, '2024-01-15 16:52:03', '2024-01-15 16:52:03'),
(18, 16, 0, '2024-01-15 16:52:25', '2024-01-15 16:52:25'),
(19, 17, 1, '2024-01-16 08:07:18', '2024-01-16 08:07:18'),
(20, 18, 1, '2024-01-20 01:20:38', '2024-01-20 01:20:38'),
(21, 19, 1, '2024-03-22 05:13:09', '2024-03-22 05:13:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `cart_date` date NOT NULL,
  `estimated_arrival_date` date DEFAULT NULL,
  `actual_arrival_date` date DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `total` decimal(65,0) NOT NULL,
  `status` smallint(6) NOT NULL,
  `bill_status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `member_id`, `cart_date`, `estimated_arrival_date`, `actual_arrival_date`, `payment_type`, `total`, `status`, `bill_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-12-23', '2023-12-25', NULL, 'cod', 1580000, 3, 1, '2023-12-23 14:57:25', '2023-12-24 14:08:24'),
(2, 1, '2023-12-24', '2023-12-26', NULL, 'vnpay', 556000, -2, 0, '2023-12-24 12:56:25', '2023-12-24 13:22:44'),
(3, 1, '2023-12-24', '2023-12-26', NULL, 'cod', 556000, 0, 0, '2023-12-24 14:13:00', '2023-12-24 14:34:11'),
(4, 1, '2023-12-24', '2023-12-26', NULL, 'cod', 600000, 0, 0, '2023-12-24 14:33:47', '2023-12-24 14:42:04'),
(5, 1, '2023-12-27', '2023-12-29', NULL, 'cod', 2222000, 1, 0, '2023-12-27 07:53:47', '2024-01-14 08:40:06'),
(6, 10, '2024-01-13', '2024-01-15', NULL, 'cod', 375000, 2, 0, '2024-01-13 07:49:20', '2024-01-14 08:39:59'),
(7, 10, '2024-01-13', '2024-01-15', NULL, 'vnpay', 395000, 0, 1, '2024-01-13 07:51:02', '2024-01-14 08:40:29'),
(8, 11, '2024-01-13', '2024-01-15', NULL, 'cod', 375000, -2, 0, '2024-01-13 07:53:22', '2024-01-13 07:57:19'),
(9, 11, '2024-01-13', '2024-01-15', NULL, 'vnpay', 495000, 3, 1, '2024-01-13 07:54:02', '2024-01-13 07:56:26'),
(10, 10, '2024-01-14', '2024-01-16', NULL, 'cod', 1125000, 1, 0, '2024-01-14 06:53:46', '2024-01-14 08:41:00'),
(11, 12, '2024-01-14', '2024-01-16', NULL, 'cod', 300000, 2, 0, '2024-01-14 06:54:27', '2024-01-14 08:41:16'),
(12, 10, '2024-01-14', '2024-01-16', NULL, 'vnpay', 450000, 1, 1, '2024-01-14 06:59:36', '2024-01-14 08:41:11'),
(13, 1, '2024-01-14', '2024-01-16', NULL, 'cod', 556000, -1, 0, '2024-01-14 11:16:27', '2024-01-14 11:16:27'),
(14, 10, '2024-01-15', '2024-01-17', NULL, 'cod', 375000, -1, 0, '2024-01-15 16:51:07', '2024-01-15 16:51:07'),
(15, 10, '2024-01-15', '2024-01-17', NULL, 'cod', 450000, -1, 0, '2024-01-15 16:52:03', '2024-01-15 16:52:03'),
(16, 10, '2024-01-15', '2024-01-17', NULL, 'cod', 600000, -1, 0, '2024-01-15 16:52:25', '2024-01-15 16:52:25'),
(17, 1, '2024-01-16', '2024-01-18', NULL, 'vnpay', 986000, -1, 1, '2024-01-16 08:07:18', '2024-01-16 08:07:18'),
(18, 1, '2024-01-20', '2024-01-22', NULL, 'vnpay', 375000, -1, 1, '2024-01-20 01:20:38', '2024-01-20 01:20:38'),
(19, 1, '2024-03-22', '2024-03-24', NULL, 'vnpay', 375000, -1, 1, '2024-03-22 05:13:09', '2024-03-22 05:13:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` decimal(65,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `cart_detail`
--

INSERT INTO `cart_detail` (`cart_id`, `product_id`, `quantity`, `size`, `price`) VALUES
(1, 3, 4, 38, 395000),
(2, 12, 1, 38, 556000),
(3, 15, 1, 38, 556000),
(4, 13, 1, 38, 600000),
(5, 13, 1, 38, 600000),
(5, 14, 2, 38, 636000),
(5, 4, 1, 38, 350000),
(6, 6, 1, 38, 375000),
(7, 20, 1, 38, 395000),
(8, 5, 1, 38, 375000),
(9, 11, 1, 38, 495000),
(10, 5, 3, 41, 375000),
(11, 8, 1, 38, 300000),
(12, 10, 1, 38, 450000),
(13, 15, 1, 38, 556000),
(14, 6, 1, 38, 375000),
(15, 10, 1, 38, 450000),
(16, 13, 1, 38, 600000),
(17, 4, 1, 38, 350000),
(17, 14, 1, 38, 636000),
(18, 6, 1, 38, 375000),
(19, 5, 1, 38, 375000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_status_history`
--

CREATE TABLE `cart_status_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `cart_status` smallint(6) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `cart_status_history`
--

INSERT INTO `cart_status_history` (`id`, `cart_id`, `cart_status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, -1, NULL, '2023-12-23 14:57:25', '2023-12-23 14:57:25'),
(2, 1, 0, 1, '2023-12-23 14:58:54', '2023-12-23 14:58:54'),
(3, 1, 1, 1, '2023-12-24 12:52:56', '2023-12-24 12:52:56'),
(4, 2, -1, 1, '2023-12-24 12:56:25', '2023-12-24 12:56:25'),
(5, 2, -2, NULL, '2023-12-24 13:22:44', '2023-12-24 13:22:44'),
(6, 1, 2, 1, '2023-12-24 13:33:59', '2023-12-24 13:33:59'),
(7, 1, 3, NULL, '2023-12-24 14:08:24', '2023-12-24 14:08:24'),
(8, 3, -1, NULL, '2023-12-24 14:13:00', '2023-12-24 14:13:00'),
(9, 4, -1, NULL, '2023-12-24 14:33:47', '2023-12-24 14:33:47'),
(11, 3, 0, 1, '2023-12-24 14:38:05', '2023-12-24 14:38:05'),
(12, 4, 0, 1, '2023-12-24 14:42:04', '2023-12-24 14:42:04'),
(13, 5, -1, NULL, '2023-12-27 07:53:47', '2023-12-27 07:53:47'),
(14, 6, -1, NULL, '2024-01-13 07:49:20', '2024-01-13 07:49:20'),
(15, 7, -1, NULL, '2024-01-13 07:51:02', '2024-01-13 07:51:02'),
(16, 8, -1, NULL, '2024-01-13 07:53:22', '2024-01-13 07:53:22'),
(17, 9, -1, NULL, '2024-01-13 07:54:02', '2024-01-13 07:54:02'),
(18, 9, 0, 1, '2024-01-13 07:55:56', '2024-01-13 07:55:56'),
(19, 9, 1, 1, '2024-01-13 07:56:04', '2024-01-13 07:56:04'),
(20, 9, 2, 1, '2024-01-13 07:56:08', '2024-01-13 07:56:08'),
(21, 9, 3, NULL, '2024-01-13 07:56:26', '2024-01-13 07:56:26'),
(22, 8, -2, NULL, '2024-01-13 07:57:19', '2024-01-13 07:57:19'),
(23, 10, -1, NULL, '2024-01-14 06:53:46', '2024-01-14 06:53:46'),
(24, 11, -1, NULL, '2024-01-14 06:54:27', '2024-01-14 06:54:27'),
(25, 12, -1, NULL, '2024-01-14 06:59:36', '2024-01-14 06:59:36'),
(26, 5, 0, 9, '2024-01-14 08:38:38', '2024-01-14 08:38:38'),
(27, 6, 0, 9, '2024-01-14 08:39:35', '2024-01-14 08:39:35'),
(28, 6, 1, 9, '2024-01-14 08:39:55', '2024-01-14 08:39:55'),
(29, 6, 2, 9, '2024-01-14 08:39:59', '2024-01-14 08:39:59'),
(30, 5, 1, 9, '2024-01-14 08:40:06', '2024-01-14 08:40:06'),
(31, 7, 0, 9, '2024-01-14 08:40:29', '2024-01-14 08:40:29'),
(32, 10, 0, 9, '2024-01-14 08:40:34', '2024-01-14 08:40:34'),
(33, 11, 0, 9, '2024-01-14 08:40:38', '2024-01-14 08:40:38'),
(34, 12, 0, 9, '2024-01-14 08:40:45', '2024-01-14 08:40:45'),
(35, 10, 1, 9, '2024-01-14 08:41:00', '2024-01-14 08:41:00'),
(36, 11, 1, 9, '2024-01-14 08:41:05', '2024-01-14 08:41:05'),
(37, 12, 1, 9, '2024-01-14 08:41:11', '2024-01-14 08:41:11'),
(38, 11, 2, 9, '2024-01-14 08:41:16', '2024-01-14 08:41:16'),
(39, 13, -1, NULL, '2024-01-14 11:16:27', '2024-01-14 11:16:27'),
(40, 14, -1, NULL, '2024-01-15 16:51:07', '2024-01-15 16:51:07'),
(41, 15, -1, NULL, '2024-01-15 16:52:03', '2024-01-15 16:52:03'),
(42, 16, -1, NULL, '2024-01-15 16:52:25', '2024-01-15 16:52:25'),
(43, 17, -1, NULL, '2024-01-16 08:07:18', '2024-01-16 08:07:18'),
(44, 18, -1, NULL, '2024-01-20 01:20:38', '2024-01-20 01:20:38'),
(45, 19, -1, NULL, '2024-03-22 05:13:09', '2024-03-22 05:13:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thutu` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `ten`, `thutu`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ÁO T-SHIRT', 1, 1, '2023-05-07 21:41:26', '2023-06-01 03:35:19'),
(2, 'QUẦN SHORT', 2, 1, '2023-05-08 03:07:02', '2023-06-01 04:14:43'),
(3, 'ÁO SƠ MI', 3, 1, '2023-05-08 03:07:20', '2023-06-01 04:14:50'),
(4, 'ÁO POLO', 4, 1, '2023-05-08 03:08:15', '2023-06-01 07:27:56'),
(5, 'ÁO THUN DÀI TAY', 5, 1, '2023-05-08 03:08:37', '2023-06-01 08:19:40'),
(6, 'ÁO TANK-TOP', 6, 1, '2023-05-08 03:11:33', '2023-05-15 09:52:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trung Anh', '0977324362', 'trunganh9933@gmail.com', NULL, '$2y$10$IXSLQ9mhD.Vrsv1LYGhsru7gVRo/CTmBx0NgStIA7bE50wHUquQla', 'Hải Dương', 'IR27pfMMPo8lNN6hN1NQsOLuAJtWzree6SqBj5BGr4fotgjfDuHhB4ZNQmBb', '2023-05-17 04:31:12', '2023-05-26 10:07:01'),
(3, 'Lộc', '0374729196', 'luuloc.02102001@gmail.com', NULL, '$2y$10$RnGw/XciC8WfhZEbZvpdEeomu32e1veJuOrAuu7BxUZC60Yf9HEH6', 'giao yến giao thủy', 'hk5fZapMaUoyu1XB6Ynw9I5P8GMh5RaCV5FSOZlepTw7MuBLDcmA5kMTTzeg', '2023-06-01 14:16:09', '2023-06-01 14:16:09'),
(4, 'Đỗ Huyền', '0327328369', 'minmin38012001@gmail.com', NULL, '$2y$10$1hVT5v3H7QHQKuiVNkOIqOzcUGttfyhziwZcTxvyM.9bQh0res.ru', 'Giao Tác, Liên Hà, Đông Anh, Hà Nội', NULL, '2023-06-01 14:17:54', '2023-06-01 14:17:54'),
(5, 'Nguyễn Huy Hoàng', '0867699706', 'huy43412@gmail.com', NULL, '$2y$10$.DhFRDQUwscC42KvVhXtQ./AR8ONDcQTeUdzhdSZAW9F1p6nBNQBy', 'HD', NULL, '2023-06-01 14:32:02', '2023-06-01 14:32:02'),
(6, 'Test', '0888888888', 'test@gmail.com', NULL, '$2y$10$BecTIxSAOZsU3z4GN39zFOm6qdI6q5Xy09Yh69.lZ./QQ3unAO.yW', 'HN', NULL, '2023-10-05 10:25:15', '2023-10-05 10:25:15'),
(7, 'tesst', '0899999999', 'tesst@gmail.cm', NULL, '$2y$10$eliPRDpKBRzBaeXhemg8fu0TyS.wOJ5.ANeA7TlpAmjIwG31hutTu', 'HN', NULL, '2023-10-05 14:49:28', '2023-10-05 14:49:28'),
(8, 'test', '0987654322', 'test9933@gmail.com', NULL, '$2y$10$.7otuEpQ/VtfNU9Od94ewusJVCwNPNikKMEK40R2peTzKo0TfVuKi', 'hd', NULL, '2023-10-05 15:37:14', '2023-10-05 15:37:14'),
(9, 'test', '0977777777', 'test1@gmail.com', NULL, '$2y$10$xNhddpfP9InUjlq.1RFEke.4kHUc9VxZ.TEJnLL551q649pmKjNIi', 'HN', NULL, '2023-10-05 15:38:41', '2023-10-05 15:38:41'),
(10, 'Nguyệt Minh', '0983797737', 'mmnguyet22@gmail.com', NULL, '$2y$10$BWzdN28cI2VG07vB6FmB1OREL2YpvDx9YAfCeiyEhAg0MQZbFHLXC', 'Toà VMT, ngõ 82 Duy Tân, Dịch Vọng Hậu, Cầu Giấy', NULL, '2024-01-13 07:49:04', '2024-01-13 07:49:04'),
(11, 'Thu Hà', '0345876925', 'hihi@gmail.com', NULL, '$2y$10$pwSASuPlUYfNd5G5BSdgS.N3cLexrmgD/CPVbBA8H25AM6bQZ2qZG', 'Toà mm, ngõ 86 Duy Tân, Dịch Vọng Hậu, Cầu Giấy', NULL, '2024-01-13 07:53:00', '2024-01-13 07:53:00'),
(12, 'hải yến', '0338173427', 'tyen@gmail.com', NULL, '$2y$10$cXgEsOEGLxpDdi2dXdgtfec5tzzVEiao4FlWyvqRvrGt.8a3gNn/e', 'Yên lạc, vĩnh phúc', NULL, '2024-01-14 06:54:09', '2024-01-14 06:54:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_04_025709_create_members_table', 2),
(7, '2023_05_04_042609_update_users_table', 3),
(8, '2023_05_08_023912_create_products_table', 4),
(9, '2023_05_08_024901_create_categories_table', 4),
(12, '2023_05_12_034930_update_product_table', 5),
(14, '2023_05_15_151047_update_categories_table', 6),
(19, '2023_05_16_142817_create_carts_table', 7),
(20, '2023_05_17_103736_update_members_table', 7),
(21, '2023_05_17_105229_create_transports_table', 8),
(22, '2023_05_17_110831_update_carts_table', 9),
(23, '2023_05_17_111142_create_cart_detail_table', 10),
(26, '2023_05_19_103229_update_trasport_table', 11),
(27, '2023_05_19_140111_update_trasport_table', 12),
(28, '2023_05_19_152806_update_product_table', 13),
(29, '2023_05_19_154026_update_cart_table', 14),
(30, '2023_06_01_082038_update_carts_table', 15),
(31, '2023_06_01_082509_update_products_table', 15),
(32, '2023_06_01_082651_update_transports_table', 15),
(33, '2023_06_01_083702_update_users_table', 16),
(34, '2023_12_19_164208_update_table_products', 17),
(35, '2023_12_19_165338_create_stock_transactions_table', 17),
(36, '2023_12_19_165500_create_suppliers_table', 17),
(37, '2023_12_19_165621_create_cart_status_histories_table', 17),
(38, '2023_12_19_170602_update_table_products', 18),
(41, '2023_12_19_211411_update_table_products', 19),
(42, '2023_12_19_211553_update_table_stock_transactions', 19),
(43, '2023_12_19_212530_update_table_cart_status_history', 19),
(44, '2023_12_19_213317_update_table_carts', 20),
(45, '2023_12_20_105243_update_table_stock_transactions', 21),
(47, '2023_12_22_154047_update_table_stock_transactions', 22),
(48, '2023_12_22_170026_update_table_stock_transactions', 23),
(49, '2023_12_22_172240_update_table_products', 24),
(51, '2023_12_22_172549_update_table_stock_transactions', 25),
(52, '2023_12_23_152816_update_table_carts', 26),
(53, '2023_12_23_172150_create_bill_histories_table', 26),
(54, '2023_12_23_194846_update_table_carts', 27),
(55, '2023_12_23_203221_update_table_bill_history', 28),
(56, '2023_12_23_204632_update_table_cart_status_history', 29),
(57, '2023_12_24_203123_update_table_cart_status_history', 30),
(58, '2023_12_24_213619_update_table_bill_stock_transaction', 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) NOT NULL,
  `masp` varchar(255) NOT NULL,
  `giathuong` decimal(65,0) NOT NULL,
  `giakm` decimal(65,0) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `hinhanh` text NOT NULL,
  `images` text DEFAULT NULL,
  `chitiet` text DEFAULT NULL,
  `id_danhmuc` bigint(20) UNSIGNED NOT NULL,
  `status` smallint(6) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `ten`, `masp`, `giathuong`, `giakm`, `soluong`, `hinhanh`, `images`, `chitiet`, `id_danhmuc`, `status`, `reorder_level`, `created_at`, `updated_at`) VALUES
(3, 'Áo thun ngắn tay', '010S3', 395000, NULL, 46, 'product/hinhanh/1685590911__TC_9864x900x900x4.webp', 'product/images/1685590911-_TC_9858x900x900x4.webp,product/images/1685590911-_TC_9862x900x900x4.webp,product/images/1685590911-_TC_9866x900x900x4.webp,product/images/1685590911-_TC_9868x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T.shirt phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn t&ocirc;n d&aacute;ng người mặc.<br />\r\n- Thiết kế cổ tr&ograve;n dệt rib dễ mặc. Họa tiết in trước ngực mang đến cho người mặc diện mạo ấn tượng. M&agrave;u sắc nam t&iacute;nh dễ kết hợp c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton đem đến độ xốp nhẹ, đứng d&aacute;ng vừa đủ.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o c&oacute; m&agrave;u sắc n&eacute;t v&agrave; giữ m&agrave;u theo thời gian.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 03:41:51', '2023-12-23 14:58:54'),
(4, 'Áo T-shirt ngắn tay', '008S3', 350000, NULL, 49, 'product/hinhanh/1685591871__TC_9837x900x900x4.webp', 'product/images/1685591871-_TC_9836x900x900x4.webp,product/images/1685591871-_TC_9841x900x900x4.webp,product/images/1685591871-_TC_9842x900x900x4.webp,product/images/1685591871-_TC_9843x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T.shirt phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn t&ocirc;n d&aacute;ng người mặc.<br />\r\n- Thiết kế cổ tr&ograve;n dệt rib dễ mặc. Họa tiết in chữ trước ngực mang đến cho người mặc diện mạo ấn tượng. M&agrave;u sắc nam t&iacute;nh dễ kết hợp c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton đem đến độ xốp nhẹ, đứng d&aacute;ng vừa đủ.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o c&oacute; m&agrave;u sắc n&eacute;t v&agrave; giữ m&agrave;u theo thời gian.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 03:57:51', '2024-01-14 08:38:38'),
(5, 'Áo thun ngắn tay', '006S3', 375000, NULL, 47, 'product/hinhanh/1685592302__TC_9841x900x900x4.webp', 'product/images/1685592302-_TC_9836x900x900x4.webp,product/images/1685592302-_TC_9837x900x900x4.webp,product/images/1685592302-_TC_9842x900x900x4.webp,product/images/1685592302-_TC_9843x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o thun ngắn tay phom Slim Fit &ocirc;m nhẹ vừa vặn m&agrave; vẫn thoải m&aacute;i vận động<br />\r\n- Thiết kế khỏe khoắn, m&agrave;u sắc cơ bản dễ kết hợp với nhiều trang phục kh&aacute;c mang tới diện mạo trẻ trung, lịch l&atilde;m cho người mặc. Họa tiết logo Aristino sắp xếp ấn tượng tạo điểm nhấn ấn tượng cho to&agrave;n bộ trang phục<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 95% Cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;<br />\r\n- 5% Spandex tạo độ co gi&atilde;n thoải m&aacute;i khi mặc.</p>', 1, 1, 10, '2023-06-01 04:05:02', '2024-01-14 08:40:34'),
(6, 'Áo T-shirt ngắn tay', '028S3', 375000, NULL, 49, 'product/hinhanh/1685592707_Teal_028S3_1.jpg', 'product/images/1685592707-Teal_028S3_2.jpg,product/images/1685592708-Teal_028S3_3.jpg,product/images/1685592708-Teal_028S3_4.jpg,product/images/1685592708-Teal_028S3_5.jpg', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T-shirt phom Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn số đo h&igrave;nh thể<br />\r\n- Thiết kế cổ tr&ograve;n basic v&agrave; nam t&iacute;nh. M&agrave;u sắc trung t&iacute;nh, mang đến nhiều lựa chọn kết hợp trang phục.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 87,697% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ<br />\r\n- 12,4% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 04:11:48', '2024-01-14 08:39:35'),
(7, 'Áo thun nam', 'AC22', 105000, NULL, 50, 'product/hinhanh/1685592838_ao-thun-nam-aristino-AC22-09x900x900x4.webp', 'product/images/1685592838-ao-thun-nam-aristino-AC22-06x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22-08x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22-10x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22x900x900x4.webp', '<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o T-shirt su&ocirc;ng nhẹ dễ chịu, thiết kế basic dễ d&agrave;ng kết hợp với trang phục kh&aacute;c</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>Chất liệu 100% Cotton tự nhi&ecirc;n gi&uacute;p &aacute;o mềm mại, xốp nhẹ, khả năng thấm h&uacute;t tốt, tho&aacute;ng kh&iacute; d&ugrave; ở m&ugrave;a n&agrave;o trong năm, đồng thời vẫn giữ được độ đứng d&aacute;ng vừa đủ.</p>', 1, 1, 10, '2023-06-01 04:13:58', '2023-12-24 06:31:54'),
(8, 'Quần short nam', '010S4', 695000, 300000, 49, 'product/hinhanh/1685593793__TC_5443x900x900x4.webp', 'product/images/1685593793-_TC_5437x900x900x4.webp,product/images/1685593793-_TC_5443x900x900x4.webp,product/images/1685593793-_TC_5446x900x900x4.webp,product/images/1685593793-_TC_5447x900x900x4.webp,product/images/1685593793-IMG_5492_1x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần shorts &acirc;u phom d&aacute;ng Regular fit với độ su&ocirc;ng rộng vừa phải, tạo sự thoải m&aacute;i cho người mặc.<br />\r\n- Quần được thiết kế cơ bản với m&agrave;u sắc trung t&iacute;nh, gi&uacute;p c&aacute;c anh dễ d&agrave;ng phối hợp với nhiều kiểu trang phục kh&aacute;c nhau, mang lại diện mạo khỏe khoắn, trẻ trung khi mặc.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 70% Polyester gi&uacute;p quần bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 27% Viscose mịn mượt, gi&uacute;p quần nhẹ, tho&aacute;ng m&aacute;t tối đa<br />\r\n- 3% Spandex tạo độ co gi&atilde;n nhẹ</p>', 2, 1, 10, '2023-06-01 04:29:53', '2024-01-14 08:40:38'),
(9, 'Quần short nam', '009S3', 650000, NULL, 50, 'product/hinhanh/1685595176_IMG_3939_1x900x900x4.webp', 'product/images/1685595176-IMG_3939x900x900x4.webp,product/images/1685595176-IMG_3941x900x900x4.webp,product/images/1685595176-IMG_3942x900x900x4.webp,product/images/1685595176-IMG_3943x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short &acirc;u phom d&aacute;ng regular fit với độ su&ocirc;ng rộng vừa phải, tạo n&ecirc;n sự thoải m&aacute;i trong mọi hoạt động.<br />\r\n- Quần được thiết kế cơ bản với m&agrave;u trắng lịch l&atilde;m, gi&uacute;p c&aacute;c anh dễ d&agrave;ng phối hợp với nhiều kiểu trang phục kh&aacute;c nhau, mang lại diện mạo khỏe khoắn, trẻ trung khi mặc.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 77% Polyester gi&uacute;p quần bền m&agrave;u, sắc n&eacute;t, mặt vải trơn trượt, mỏng nhẹ.<br />\r\n- 21% Rayon gi&uacute;p bộ suit c&oacute; độ mềm mại, m&aacute;t mẻ v&agrave; bay rũ tự nhi&ecirc;n<br />\r\n- 2% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 2, 1, 10, '2023-06-01 04:52:56', '2023-12-24 06:32:27'),
(10, 'Quần short nam', '025S3', 450000, NULL, 49, 'product/hinhanh/1685602111_NTC_7031x900x900x4.webp', 'product/images/1685602111-IMG_4790_1x900x900x4.webp,product/images/1685602111-NTC_7029x900x900x4.webp,product/images/1685602111-NTC_7032x900x900x4.webp,product/images/1685602111-NTC_7033x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short thể thao phom Regular Fit su&ocirc;ng nhẹ v&agrave; thoải m&aacute;i vận động.<br />\r\n- Kiểu d&aacute;ng thể thao với độ d&agrave;i vừa phải ph&ugrave; hợp với hoạt động thể thao, thiết kế tối giản kết hợp t&uacute;i 2 b&ecirc;n tiện lợi đựng đồ c&aacute; nh&acirc;n khi vận động thể thaoPhần đai quần c&oacute; d&acirc;y chun k&eacute;o gi&uacute;p chỉnh được độ co gi&atilde;n, ph&ugrave; hợp với v&ograve;ng bụng<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 100% Polyester mang đến độ b&oacute;ng sắc n&eacute;t, kh&ocirc;ng bị bai d&atilde;o, lu&ocirc;n bền m&agrave;u. Quần c&ograve;n c&oacute; khả năng chống b&aacute;m bụi, chống nhăn, hạn chế thấm nước, độ bền cao.</p>', 2, 1, 10, '2023-06-01 06:48:31', '2024-01-14 08:40:45'),
(11, 'Quần short nam', '017S3', 495000, NULL, 49, 'product/hinhanh/1685602287__TC_5695x900x900x4.webp', 'product/images/1685602287-_TC_5693x900x900x4.webp,product/images/1685602287-_TC_5697x900x900x4.webp,product/images/1685602287-_TC_5698x900x900x4.webp,product/images/1685602287-IMG_9738x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short thể thao phom Regular Fit su&ocirc;ng nhẹ v&agrave; thoải m&aacute;i vận động.<br />\r\n- Thiết kế basic khỏe khoắn với t&uacute;i quần tiện lợi. Họa tiết h&igrave;nh học in ch&igrave;m tr&agrave;n quần ấn tượng. M&agrave;u sắc cơ bản dễ d&agrave;ng kết hợp với c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 92% Polyester mang đến độ b&oacute;ng sắc n&eacute;t, kh&ocirc;ng bị bai d&atilde;o, lu&ocirc;n bền m&agrave;u. Quần&nbsp;c&ograve;n c&oacute; khả năng chống b&aacute;m bụi, chống nhăn, hạn chế thấm nước, độ bền cao.<br />\r\n- 8% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 2, 1, 10, '2023-06-01 06:51:27', '2024-01-13 07:55:56'),
(12, 'Áo sơ mi ngắn tay nam', '101S1', 695000, 556000, 50, 'product/hinhanh/1685602508_ao-so-mi-aristino-ASS101S1-02x900x900x4.webp', 'product/images/1685602508-ao-so-mi-aristino-ASS101S1-01x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1-03x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1-04x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom perfect fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&agrave; bằng thoải m&aacute;i. Cổ &aacute;o đứng lịch sự c&ugrave;ng t&uacute;i ngực tiện lợi. &Aacute;o in họa tiết sắc n&eacute;t tr&ecirc;n nền trắng tinh t&ecirc; mang đến diện mạo thu h&uacute;t cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:&nbsp;</strong></p>\r\n\r\n<p>- Chất liệu 50% Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.</p>\r\n\r\n<p>- Kết hợp 50% Polyspun gi&uacute;p tiết kiệm tối đa thời gian cho chuyện l&agrave; ủi nhờ khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 06:55:08', '2023-12-24 06:33:08'),
(13, 'Áo sơ mi nam ngắn tay', '315S2', 750000, 600000, 48, 'product/hinhanh/1685602803_ao-so-mi-nam-aristino-ASS315S2-02x900x900x4.webp', 'product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-01x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-03x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-08x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom Perfect fit su&ocirc;ng rộng, t&agrave; bằng, độ d&agrave;i &aacute;o vừa phải để mặc thả ngo&agrave;i trong m&ocirc;i trường c&ocirc;ng sở.</p>\r\n\r\n<p>- &Aacute;o thiết kế t&agrave; bằng, c&oacute; t&uacute;i ngực, m&agrave;u xanh đậm với họa tiết kẻ nổi bật, đem lại vẻ ngo&agrave;i trẻ trung nhưng vẫn rất lịch l&atilde;m cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- 50% Modal gi&uacute;p &aacute;o mềm mại v&agrave; thấm h&uacute;t tốt.</p>\r\n\r\n<p>- 50% Polyspun mang đến khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 07:00:03', '2024-01-14 08:38:38'),
(14, 'Áo sơ mi ngắn tay nam', '016S2', 795000, 636000, 48, 'product/hinhanh/1685603198_ao-so-mi-ngan-tay-nam-aristino-ass016s2-4x900x900x4.webp', 'product/images/1685603198-ao-so-mi-ngan-tay-nam-aristino-ass016s2-1x900x900x4.webp,product/images/1685603198-ao-so-mi-ngan-tay-nam-aristino-ass016s2x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>Perfect Fit</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom Perfect Fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&agrave; bằng thoải m&aacute;i. Cổ &aacute;o đứng lịch sự c&ugrave;ng t&uacute;i ngực tiện lợi. Hiệu ứng xanh t&iacute;m than kẻ dobby lịch l&atilde;m, thời thượng tạo n&ecirc;n dấu ấn thanh lịch cho qu&yacute; &ocirc;ng.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- 50% Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.<br />\r\n- 50% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ.</p>', 3, 1, 10, '2023-06-01 07:06:38', '2024-01-14 08:38:38'),
(15, 'Áo sơ mi ngắn tay nam', '172S1', 695000, 556000, 48, 'product/hinhanh/1685603810_ao-so-mi-nam-aristino-ASS172S1-04x900x900x4.webp', 'product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-02x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-03x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-05x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom perfect fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&uacute;i ngực tiện lợi v&agrave; t&agrave; bằng thoải m&aacute;i. &Aacute;o dệt dobby họa tiết kẻ trắng tr&ecirc;n nền xanh nam t&iacute;nh mang đến diện mạo ấn tượng cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.</p>\r\n\r\n<p>- Kết hợp Polyspun gi&uacute;p tiết kiệm tối đa thời gian cho chuyện l&agrave; ủi nhờ khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 07:16:50', '2023-12-24 14:38:04'),
(16, 'Áo polo nam có cổ ngắn tay', '064S3', 695000, NULL, 50, 'product/hinhanh/1685606060__TC_9283x900x900x4.webp', 'product/images/1685606060-_TC_9274x900x900x4.webp,product/images/1685606060-_TC_9277x900x900x4.webp,product/images/1685606060-_TC_9286x900x900x4.webp,product/images/1685606060-_TC_9289x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o polo phom d&aacute;ng Slim Fit &ocirc;m nhẹ vừa vặn m&agrave; vẫn thoải m&aacute;i linh hoạt khi vận động.<br />\r\n- Thiết kế &aacute;o ấn tượng với họa tiết logo Aristino xếp chồng chỉn chu theo chiều ngang ngực &aacute;o mang tới hiệu ứng thị gi&aacute;c bắt mắt. Đồng thời thiết kế c&ograve;n tả n&ecirc;n điểm nhấn khỏe khoắn, trẻ trung cho người mặc<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 96,5% cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ, khả năng thấm h&uacute;t tốt, tho&aacute;ng kh&iacute; d&ugrave; ở m&ugrave;a n&agrave;o trong năm, đồng thời vẫn giữ được độ đứng d&aacute;ng vừa đủ.<br />\r\n- 3,5% spandex tăng độ co gi&atilde;n</p>', 4, 1, 10, '2023-06-01 07:54:20', '2023-12-24 06:34:38'),
(17, 'Áo polo nam có cổ ngắn tay', '115S3', 650000, NULL, 50, 'product/hinhanh/1685607056__TC_9262x900x900x4.webp', 'product/images/1685607056-_TC_9261x900x900x4.webp,product/images/1685607056-_TC_9266x900x900x4.webp,product/images/1685607056-_TC_9267x900x900x4.webp,product/images/1685607056-_TC_9270x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Polo phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ nhưng vẫn vừa vặn, t&ocirc;n d&aacute;ng tối đa khi mặc.<br />\r\n- Thiết kế basic với cổ dệt lịch sự kết hợp họa tiết th&ecirc;u chữ k&yacute; Aristino trước ngực, đem đến diện mạo thời thượng cho người mặc&quot;<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 48% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 47% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex gi&uacute;p &aacute;o co gi&atilde;n thoải m&aacute;i</p>', 4, 1, 10, '2023-06-01 08:10:56', '2023-12-24 06:35:10'),
(18, 'Áo polo nam cổ ngắn tay', '046S3', 595000, NULL, 50, 'product/hinhanh/1685607220__TC_9581x900x900x4.webp', 'product/images/1685607220-_TC_9582x900x900x4.webp,product/images/1685607220-_TC_9591x900x900x4.webp,product/images/1685607220-_TC_9592x900x900x4.webp,product/images/1685607220-IMG_1752_1x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o polo phom Slim fit &ocirc;m vừa mang lại vẻ ngo&agrave;i lịch l&atilde;m cho qu&yacute; &ocirc;ng<br />\r\n- Thiết kế basic với cổ dệt lịch sự kết hợp họa tiết những đường kẻ c&aacute;ch điệu trẻ trung, đem đến diện mạo thời thượng cho người mặc&quot;<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex gi&uacute;p &aacute;o co gi&atilde;n thoải m&aacute;i</p>', 4, 1, 10, '2023-06-01 08:13:40', '2023-12-24 06:35:22'),
(19, 'Áo thun có cổ ngắn tay', '157S3', 595000, NULL, 50, 'product/hinhanh/1685607465__TC_9678x900x900x4.webp', 'product/images/1685607465-_TC_9174x900x900x4.webp,product/images/1685607465-_TC_9179x900x900x4.webp,product/images/1685607465-_TC_9182x900x900x4.webp,product/images/1685607465-_TC_9183x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Polo phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ nhưng vẫn vừa vặn, t&ocirc;n d&aacute;ng tối đa khi mặc<br />\r\n- Thiết kế được lấy cảm hứng từ họa tiết logo Aristino c&aacute;ch điệu tạo n&ecirc;n ấn tượng mạnh mẽ. M&agrave;u sắc nam t&iacute;nh dễ d&agrave;ng phối hợp với c&aacute;c trang phục kh&aacute;c nhau để tạo n&ecirc;n diện mạo lịch l&atilde;m<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 87.6% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ<br />\r\n- 12.4% Spandex tạo độ co gi&atilde;n nhẹ</p>', 4, 1, 10, '2023-06-01 08:17:45', '2023-12-24 06:35:45'),
(20, 'Áo thun dài tay', '009W2', 395000, NULL, 49, 'product/hinhanh/1685607703_Ao-thu-dong-Aristino-ALT009W2-6-x900x900x4.webp', 'product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-5-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-7-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-8-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-9-x900x900x4.webp', '<p><strong>Kiểu d&aacute;ng</strong>:&nbsp;Body Fit</p>\r\n\r\n<p><strong>Thiết kế</strong>:<br />\r\n- &Aacute;o gữ nhiệt phom d&aacute;ng Body Fit &ocirc;m s&aacute;t cơ thể, gọn g&agrave;ng, thoải m&aacute;i v&agrave; giữ ấm tối đa khi mặc.<br />\r\n- &Aacute;o thiết đơn giản với 2 gam m&agrave;u trung t&iacute;nh đem lại nhiều lựa chọn kết hợp m&agrave;u sắc v&agrave; trang phục.</p>\r\n\r\n<p><strong>Chất liệu</strong>:<br />\r\n- 95% Heatmax gi&uacute;p giữ ấm tối ưu với c&aacute;c loại sợi cao cấp, th&ocirc;ng tho&aacute;ng kh&iacute; v&agrave; mềm mại với da<br />\r\n- 5% Spandex giữ độ co gi&atilde;n tốt, tạo sự thoải m&aacute;i</p>', 5, 1, 10, '2023-06-01 08:21:43', '2024-01-14 08:40:29'),
(22, 'Áo thun dài tay', '006W2', 495000, NULL, 50, 'product/hinhanh/1685608671_Ao-thun-Aristini-ALT006W2-12-x900x900x4.webp', 'product/images/1685608671-Ao-thun-Aristini-ALT006W2-11-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-13-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-14-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-15-x900x900x4.webp', '<p>Kiểu d&aacute;ng:&nbsp;Regular fit</p>\r\n\r\n<p>Thiết kế:<br />\r\n- &Aacute;o thun d&agrave;i tay phom Regular fit su&ocirc;ng vừa, thoải m&aacute;i tuyệt đối khi mặc.<br />\r\n- &Aacute;o thiết kế đơn giản với gam m&agrave;u tối hiện đại, c&ugrave;ng họa tiết in ngực tr&aacute;i đem đến diện mạo thời thượng cho người mặc.</p>\r\n\r\n<p>Chất liệu:&nbsp;<br />\r\n- 57% Cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester cho bề mặt vải b&oacute;ng mịn, sắc n&eacute;t, &iacute;t nhăn nh&agrave;u.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 5, 1, 10, '2023-06-01 08:37:51', '2023-12-24 06:36:32'),
(23, 'Áo thun dài tay', '002W9', 375000, NULL, 50, 'product/hinhanh/1685608833_ao-thu-dong-nam-aristino-ALT002W9-05x900x900x4.webp', 'product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-01x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-02x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-03x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-04x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:</strong>&nbsp;CASUAL FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o T-shirt d&agrave;i tay phom d&aacute;ng Casual fit su&ocirc;ng rộng, mang đến vẻ ngo&agrave;i thời thượng v&agrave; ph&oacute;ng kho&aacute;ng.</p>\r\n\r\n<p>- Thiết kế cơ bản với cổ tr&ograve;n, m&agrave;u sắc trung t&iacute;nh. Điểm nhấn của &aacute;o nằm ở chữ k&yacute; lớn c&aacute;ch điệu từ logo Aristino được in ở phần ngực phải. &Aacute;o th&iacute;ch hợp để mặc c&ugrave;ng quần d&agrave;i thu đ&ocirc;ng để đi dạo, tập thể thao v&agrave;o m&ugrave;a lạnh.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu CVC mang đến những ưu điểm vượt trội l&agrave; sự mềm mại, xốp nhẹ, tho&aacute;ng kh&iacute;, bền đẹp v&agrave; giữ m&agrave;u sắc n&eacute;t theo thời gian.</p>', 5, 1, 10, '2023-06-01 08:40:33', '2023-12-24 06:36:52'),
(24, 'Áo thun dài tay nam', '004W9', 375000, NULL, 50, 'product/hinhanh/1685609113_ao-thu-dong-nam-aristino-ALT004W9-03x900x900x4.webp', 'product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9-01x900x900x4.webp,product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9-02x900x900x4.webp,product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>CASUAL FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o thun d&agrave;i tay phom Casual Fit c&oacute; độ su&ocirc;ng rộng vừa đủ đồng thời vẫn đảm bảo vừa vặn số đo h&igrave;nh thể nam giới Việt.</p>\r\n\r\n<p>- Thiết kế tối giản ở phần cổ v&agrave; được tạo điểm nhấn nhờ in họa tiết chữ độc nhất v&agrave; đầy ấn tượng. &Aacute;o m&agrave;u sắc trung t&iacute;nh, c&oacute; thể kết hợp với quần jean, quần khaki v&agrave; &aacute;o jacket để c&oacute; vẻ ngo&agrave;i năng động, trẻ trung m&agrave; vẫn ấm &aacute;p.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu CVC cao cấp đem đến những sự kết hợp ưu điểm của sợi cotton tự nhi&ecirc;n v&agrave; sợi nh&acirc;n tạo. Đ&oacute; l&agrave; độ mềm mại, tho&aacute;ng m&aacute;t, xốp nhẹ, đồng thời lại bền chắc v&agrave; m&agrave;u sắc sắc n&eacute;t.</p>', 5, 1, 10, '2023-06-01 08:45:13', '2023-12-24 06:37:05'),
(25, 'Áo tanktop', '009S4', 350000, NULL, 50, 'product/hinhanh/1685611411__TC_9811x900x900x4.webp', 'product/images/1685611411-_TC_9810x900x900x4.webp,product/images/1685611411-_TC_9814x900x900x4.webp,product/images/1685611411-_TC_9818x900x900x4.webp,product/images/1685611411-_TC_9819x900x900x4.webp', '<p>THIẾT KẾ:<br />\r\n- &Aacute;o tanktop thiết kế basic ph&ugrave; hợp với mọi d&aacute;ng người. &Aacute;o th&iacute;ch hợp để mặc ở nh&agrave; lẫn ph&ograve;ng tập.<br />\r\n- Họa tiết in ấn tượng trước ngực tạo điểm nhấn độc đ&aacute;o. M&agrave;u sắc nam t&iacute;nh mang đến diện mạo thu h&uacute;t cho người mặc<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Modal cho bề mặt vải mềm mại, nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 6, 1, 10, '2023-06-01 09:23:31', '2023-12-24 06:37:16'),
(26, 'Áo tanktop', '008S4', 295000, NULL, 50, 'product/hinhanh/1685611573__TC_0092x900x900x4.webp', 'product/images/1685611573__TC_0084x900x900x4.webp,product/images/1685611573__TC_0087x900x900x4.webp,product/images/1685611573__TC_0095x900x900x4.webp,product/images/1685611573_IMG_1591x900x900x4.webp', '<p>FORM D&Aacute;NG:&nbsp;Tanktop<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Tanktop (ba lỗ) thiết kế khỏe khoắn, m&agrave;u sắc cơ bản m&agrave; đa dạng, gi&uacute;p người mặc thoải m&aacute;i trong mọi vận động bất kể thời tiết m&ugrave;a n&agrave;o..<br />\r\n- Cổ &aacute;o vẫn l&agrave; dạng cổ tr&ograve;n quen thuộc, trước ngực in th&ecirc;m chi tiết nhỏ tạo điểm nhấn.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 6, 1, 10, '2023-06-01 09:25:39', '2023-12-24 06:37:30'),
(27, 'Áo tanktop', '003S3', 295000, NULL, 50, 'product/hinhanh/1685611704_Ao-tanktop-Aristino-ATT003S3-5-x900x900x4.webp', 'product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-6-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-7-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-8-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-9-x900x900x4.webp', '<p>THIẾT KẾ:<br />\r\n- &Aacute;o Tank top (ba lỗ) thiết kế khỏe khoắn, m&agrave;u sắc cơ bản m&agrave; đa dạng, mang đến nhiều lựa chọn kết hợp trang phục cho m&ocirc;i trường ngo&agrave;i c&ocirc;ng sở.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton gi&uacute;p quần mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester cho bề mặt vải b&oacute;ng mịn, sắc n&eacute;t, &iacute;t nhăn co<br />\r\n- 5% Spandex tạo độ co gi&atilde;n thoải m&aacute;i khi mặc</p>', 6, 1, 10, '2023-06-01 09:28:24', '2023-12-24 06:37:45'),
(28, 'Áo tank-top', 'TTR06', 295000, NULL, 50, 'product/hinhanh/1685611812_ao-tank-top-nam-aristino-ATTR06-07x900x900x4.webp', 'product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-06x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-08x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-09x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-10x900x900x4.webp', '<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o Tank-top c&oacute; thiết kế cơ bản v&agrave; khỏe khoắn. M&agrave;u sắc &aacute;o trung t&iacute;nh c&oacute; thể mặc khi tham gia c&aacute;c hoạt động thể thao hoặc mặc layer cho phong c&aacute;ch ngo&agrave;i c&ocirc;ng sở.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu Supima Cotton cao cấp - một trong những loại cotton tốt nhất tr&ecirc;n thế giới. Sợi b&ocirc;ng si&ecirc;u d&agrave;i cho bề mặt vải b&oacute;ng đẹp, mềm mịn như lụa v&agrave; hạn chế v&oacute;n cục. Độ bền cao v&agrave; b&oacute;ng đẹp hơn sau mỗi lần giặt. Kết hợp 5% Spandex tạo n&ecirc;n độ co d&atilde;n vừa phải cho &aacute;o.</p>', 6, 1, 10, '2023-06-01 09:30:12', '2023-12-24 06:39:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `stock_in_price` decimal(65,0) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `note` text DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `product_id`, `cart_id`, `supplier_id`, `user_id`, `type`, `stock_in_price`, `quantity`, `transaction_date`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 1, 1, 'in', 100000, 50, '2023-12-23', NULL, 1, '2023-12-23 14:56:02', '2023-12-23 14:56:02'),
(2, NULL, 1, NULL, 1, 'out', NULL, NULL, '2023-12-23', NULL, 1, '2023-12-23 14:58:54', '2023-12-23 14:58:54'),
(3, 4, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:28:52', '2023-12-24 06:28:52'),
(4, 5, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:30:16', '2023-12-24 06:30:16'),
(5, 6, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:31:41', '2023-12-24 06:31:41'),
(6, 7, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:31:54', '2023-12-24 06:31:54'),
(7, 8, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:32:09', '2023-12-24 06:32:09'),
(8, 9, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:32:27', '2023-12-24 06:32:27'),
(9, 10, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:32:42', '2023-12-24 06:32:42'),
(10, 11, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:32:57', '2023-12-24 06:32:57'),
(11, 12, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:33:09', '2023-12-24 06:33:09'),
(12, 13, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:33:32', '2023-12-24 06:33:32'),
(13, 14, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:33:59', '2023-12-24 06:33:59'),
(14, 15, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:34:10', '2023-12-24 06:34:10'),
(15, 16, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:34:38', '2023-12-24 06:34:38'),
(16, 17, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:35:10', '2023-12-24 06:35:10'),
(17, 18, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:35:22', '2023-12-24 06:35:22'),
(18, 19, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:35:45', '2023-12-24 06:35:45'),
(19, 20, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:36:04', '2023-12-24 06:36:04'),
(20, 22, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:36:32', '2023-12-24 06:36:32'),
(21, 23, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:36:52', '2023-12-24 06:36:52'),
(22, 24, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:37:05', '2023-12-24 06:37:05'),
(23, 25, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:37:17', '2023-12-24 06:37:17'),
(24, 26, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:37:30', '2023-12-24 06:37:30'),
(25, 27, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:37:45', '2023-12-24 06:37:45'),
(26, 28, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 06:39:29', '2023-12-24 06:39:29'),
(27, NULL, 3, NULL, 1, 'out', NULL, NULL, '2023-12-24', NULL, 1, '2023-12-24 14:38:05', '2023-12-24 14:38:05'),
(28, NULL, 4, NULL, 1, 'out', NULL, NULL, '2023-12-24', NULL, 1, '2023-12-24 14:42:04', '2023-12-24 14:42:04'),
(29, NULL, 9, NULL, 1, 'out', NULL, NULL, '2024-01-13', NULL, 1, '2024-01-13 07:55:56', '2024-01-13 07:55:56'),
(30, NULL, 5, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:38:38', '2024-01-14 08:38:38'),
(31, NULL, 6, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:39:35', '2024-01-14 08:39:35'),
(32, NULL, 7, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:40:29', '2024-01-14 08:40:29'),
(33, NULL, 10, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:40:34', '2024-01-14 08:40:34'),
(34, NULL, 11, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:40:38', '2024-01-14 08:40:38'),
(35, NULL, 12, NULL, 9, 'out', NULL, NULL, '2024-01-14', NULL, 1, '2024-01-14 08:40:45', '2024-01-14 08:40:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 'Aristino', 'Aristino', '0988776655', '2023-12-19 16:01:11', '2023-12-19 16:01:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `transports`
--

INSERT INTO `transports` (`id`, `member_id`, `name`, `phone`, `email`, `address`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trung Anh', '0977324362', 'trunganh9933@gmail.com', 'Hải Dương', NULL, '2023-05-19 07:49:20', '2023-05-26 08:43:09'),
(2, 3, 'Lộc', '0374729196', 'luuloc.02102001@gmail.com', 'giao yến giao thủy', NULL, '2023-06-01 14:17:04', '2023-06-01 14:17:04'),
(3, 4, 'Đỗ Huyền', '0327328369', 'minmin38012001@gmail.com', 'Giao Tác, Liên Hà, Đông Anh, Hà Nội', NULL, '2023-06-01 14:19:19', '2023-06-01 14:19:19'),
(4, 5, 'Nguyễn Huy Hoàng', '0867699706', 'huy43412@gmail.com', 'HD', NULL, '2023-06-01 14:33:18', '2023-06-01 14:33:18'),
(5, 6, 'Test', '0888888888', 'test@gmail.com', 'HN', NULL, '2023-10-06 09:43:56', '2023-10-06 09:43:56'),
(6, 10, 'Nguyệt Minh', '0983797737', 'mmnguyet22@gmail.com', 'Toà VMT, ngõ 82 Duy Tân, Dịch Vọng Hậu, Cầu Giấy', NULL, '2024-01-13 07:49:20', '2024-01-13 07:49:20'),
(7, 11, 'hihi', '0345876925', 'hihi@gmail.com', 'Toà mm, ngõ 86 Duy Tân, Dịch Vọng Hậu, Cầu Giấy', NULL, '2024-01-13 07:53:22', '2024-01-13 07:53:22'),
(8, 12, 'hải yến', '0338173427', 'tyen@gmail.com', 'Yên lạc, vĩnh phúc', NULL, '2024-01-14 06:54:27', '2024-01-14 06:54:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '0987654321', 'admin@gmail.com', NULL, '$2y$10$MLmefJTJ2Lv..7aNB.HoyOtLDZHPE1O69cQLQm7jpVkgaYlprRq0C', 1, 1, 'IIMjPtliYgmuGdEXrhJs2G6aawjpJAL80eow8ticZSlv5lMFzwMvuhIvd1jz', '2023-05-04 05:00:00', '2023-05-15 07:02:01'),
(6, 'viet', '0988775544', 'viet@gmail.com', NULL, '$2y$10$ID4MXujIIB/1mM7OcOpdleJNFJVH88Hy1/9Lwl2zhcakJELNW2vK6', 2, 0, NULL, '2023-05-24 13:23:06', '2023-05-24 13:23:06'),
(7, 'hoàng', '0983412310', 'hoang@gmail.com', NULL, '$2y$10$GtMe7c9GKnvAI2hkULWfBewlBTzqoyMWYbuuXadLXMnoHne05kvdu', 1, 1, NULL, '2023-05-24 13:23:37', '2023-06-01 15:48:45'),
(8, 'lộc', '0912367823', 'loc@gmail.com', NULL, '$2y$10$60tYZ1vVxt9IFiuLxSMzHOLJjVLR3D6z1oAY7wt8wOOHEh0qzmvJ.', 2, 1, NULL, '2023-06-01 03:09:07', '2023-06-01 15:48:40'),
(9, 'Nhân Viên A', '0926826868', 'nhanvien@gmail.com', NULL, '$2y$10$yXUYOi4M0MA6tvcHEU5omOVH1UMlLONbPn3NGxgozbYn8b390e1p6', 2, 1, 'sASRntWcmS6FF0Kj8rnGK62VqWQKFavEle7tmoWEWTIZtVTjIc8OXUyji6sp', '2024-01-13 07:47:10', '2024-01-14 08:39:19');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill_histories`
--
ALTER TABLE `bill_histories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `cart_status_history`
--
ALTER TABLE `cart_status_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `members_email_unique` (`email`) USING BTREE;

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`) USING BTREE,
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`) USING BTREE;

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill_histories`
--
ALTER TABLE `bill_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `cart_status_history`
--
ALTER TABLE `cart_status_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
