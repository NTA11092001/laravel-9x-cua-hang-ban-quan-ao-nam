/*
 Navicat Premium Data Transfer

 Source Server         : localhost3306
 Source Server Type    : MySQL
 Source Server Version : 50739
 Source Host           : localhost:3306
 Source Schema         : cua_hang_ban_quan_ao_nam

 Target Server Type    : MySQL
 Target Server Version : 50739
 File Encoding         : 65001

 Date: 27/12/2023 15:33:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bill_histories
-- ----------------------------
DROP TABLE IF EXISTS `bill_histories`;
CREATE TABLE `bill_histories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `bill_status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bill_histories
-- ----------------------------
INSERT INTO `bill_histories` VALUES (1, 1, 0, '2023-12-23 21:57:25', '2023-12-23 21:57:25');
INSERT INTO `bill_histories` VALUES (2, 2, 0, '2023-12-24 19:56:25', '2023-12-24 19:56:25');
INSERT INTO `bill_histories` VALUES (3, 2, 0, '2023-12-24 20:21:53', '2023-12-24 20:21:53');
INSERT INTO `bill_histories` VALUES (4, 1, 1, '2023-12-24 21:08:24', '2023-12-24 21:08:24');
INSERT INTO `bill_histories` VALUES (5, 3, 0, '2023-12-24 21:13:00', '2023-12-24 21:13:00');
INSERT INTO `bill_histories` VALUES (6, 4, 0, '2023-12-24 21:33:47', '2023-12-24 21:33:47');
INSERT INTO `bill_histories` VALUES (7, 5, 0, '2023-12-27 14:53:47', '2023-12-27 14:53:47');

-- ----------------------------
-- Table structure for cart_detail
-- ----------------------------
DROP TABLE IF EXISTS `cart_detail`;
CREATE TABLE `cart_detail`  (
  `cart_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` decimal(65, 0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cart_detail
-- ----------------------------
INSERT INTO `cart_detail` VALUES (1, 3, 4, 38, 395000);
INSERT INTO `cart_detail` VALUES (2, 12, 1, 38, 556000);
INSERT INTO `cart_detail` VALUES (3, 15, 1, 38, 556000);
INSERT INTO `cart_detail` VALUES (4, 13, 1, 38, 600000);
INSERT INTO `cart_detail` VALUES (5, 13, 1, 38, 600000);
INSERT INTO `cart_detail` VALUES (5, 14, 2, 38, 636000);
INSERT INTO `cart_detail` VALUES (5, 4, 1, 38, 350000);

-- ----------------------------
-- Table structure for cart_status_history
-- ----------------------------
DROP TABLE IF EXISTS `cart_status_history`;
CREATE TABLE `cart_status_history`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `cart_status` smallint(6) NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart_status_history
-- ----------------------------
INSERT INTO `cart_status_history` VALUES (1, 1, -1, NULL, '2023-12-23 21:57:25', '2023-12-23 21:57:25');
INSERT INTO `cart_status_history` VALUES (2, 1, 0, 1, '2023-12-23 21:58:54', '2023-12-23 21:58:54');
INSERT INTO `cart_status_history` VALUES (3, 1, 1, 1, '2023-12-24 19:52:56', '2023-12-24 19:52:56');
INSERT INTO `cart_status_history` VALUES (4, 2, -1, 1, '2023-12-24 19:56:25', '2023-12-24 19:56:25');
INSERT INTO `cart_status_history` VALUES (5, 2, -2, NULL, '2023-12-24 20:22:44', '2023-12-24 20:22:44');
INSERT INTO `cart_status_history` VALUES (6, 1, 2, 1, '2023-12-24 20:33:59', '2023-12-24 20:33:59');
INSERT INTO `cart_status_history` VALUES (7, 1, 3, NULL, '2023-12-24 21:08:24', '2023-12-24 21:08:24');
INSERT INTO `cart_status_history` VALUES (8, 3, -1, NULL, '2023-12-24 21:13:00', '2023-12-24 21:13:00');
INSERT INTO `cart_status_history` VALUES (9, 4, -1, NULL, '2023-12-24 21:33:47', '2023-12-24 21:33:47');
INSERT INTO `cart_status_history` VALUES (11, 3, 0, 1, '2023-12-24 21:38:05', '2023-12-24 21:38:05');
INSERT INTO `cart_status_history` VALUES (12, 4, 0, 1, '2023-12-24 21:42:04', '2023-12-24 21:42:04');
INSERT INTO `cart_status_history` VALUES (13, 5, -1, NULL, '2023-12-27 14:53:47', '2023-12-27 14:53:47');

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `cart_date` date NOT NULL,
  `estimated_arrival_date` date NULL DEFAULT NULL,
  `actual_arrival_date` date NULL DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total` decimal(65, 0) NOT NULL,
  `status` smallint(6) NOT NULL,
  `bill_status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES (1, 1, '2023-12-23', '2023-12-25', NULL, 'cod', 1580000, 3, 1, '2023-12-23 21:57:25', '2023-12-24 21:08:24');
INSERT INTO `carts` VALUES (2, 1, '2023-12-24', '2023-12-26', NULL, 'vnpay', 556000, -2, 0, '2023-12-24 19:56:25', '2023-12-24 20:22:44');
INSERT INTO `carts` VALUES (3, 1, '2023-12-24', '2023-12-26', NULL, 'cod', 556000, 0, 0, '2023-12-24 21:13:00', '2023-12-24 21:34:11');
INSERT INTO `carts` VALUES (4, 1, '2023-12-24', '2023-12-26', NULL, 'cod', 600000, 0, 0, '2023-12-24 21:33:47', '2023-12-24 21:42:04');
INSERT INTO `carts` VALUES (5, 1, '2023-12-27', '2023-12-29', NULL, 'cod', 2222000, -1, 0, '2023-12-27 14:53:47', '2023-12-27 14:53:47');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thutu` int(11) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'ÁO T-SHIRT', 1, 1, '2023-05-08 04:41:26', '2023-06-01 10:35:19');
INSERT INTO `categories` VALUES (2, 'QUẦN SHORT', 2, 1, '2023-05-08 10:07:02', '2023-06-01 11:14:43');
INSERT INTO `categories` VALUES (3, 'ÁO SƠ MI', 3, 1, '2023-05-08 10:07:20', '2023-06-01 11:14:50');
INSERT INTO `categories` VALUES (4, 'ÁO POLO', 4, 1, '2023-05-08 10:08:15', '2023-06-01 14:27:56');
INSERT INTO `categories` VALUES (5, 'ÁO THUN DÀI TAY', 5, 1, '2023-05-08 10:08:37', '2023-06-01 15:19:40');
INSERT INTO `categories` VALUES (6, 'ÁO TANK-TOP', 6, 1, '2023-05-08 10:11:33', '2023-05-15 16:52:24');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `members_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (1, 'Trung Anh', '0977324362', 'trunganh9933@gmail.com', NULL, '$2y$10$IXSLQ9mhD.Vrsv1LYGhsru7gVRo/CTmBx0NgStIA7bE50wHUquQla', 'Hải Dương', 'fzI7NggolDjYPsXaixl3hgqB6MB5LRPNXsklPsjfjzsbMdRouV5mPthq3YcJ', '2023-05-17 11:31:12', '2023-05-26 17:07:01');
INSERT INTO `members` VALUES (3, 'Lộc', '0374729196', 'luuloc.02102001@gmail.com', NULL, '$2y$10$RnGw/XciC8WfhZEbZvpdEeomu32e1veJuOrAuu7BxUZC60Yf9HEH6', 'giao yến giao thủy', 'hk5fZapMaUoyu1XB6Ynw9I5P8GMh5RaCV5FSOZlepTw7MuBLDcmA5kMTTzeg', '2023-06-01 21:16:09', '2023-06-01 21:16:09');
INSERT INTO `members` VALUES (4, 'Đỗ Huyền', '0327328369', 'minmin38012001@gmail.com', NULL, '$2y$10$1hVT5v3H7QHQKuiVNkOIqOzcUGttfyhziwZcTxvyM.9bQh0res.ru', 'Giao Tác, Liên Hà, Đông Anh, Hà Nội', NULL, '2023-06-01 21:17:54', '2023-06-01 21:17:54');
INSERT INTO `members` VALUES (5, 'Nguyễn Huy Hoàng', '0867699706', 'huy43412@gmail.com', NULL, '$2y$10$.DhFRDQUwscC42KvVhXtQ./AR8ONDcQTeUdzhdSZAW9F1p6nBNQBy', 'HD', NULL, '2023-06-01 21:32:02', '2023-06-01 21:32:02');
INSERT INTO `members` VALUES (6, 'Test', '0888888888', 'test@gmail.com', NULL, '$2y$10$BecTIxSAOZsU3z4GN39zFOm6qdI6q5Xy09Yh69.lZ./QQ3unAO.yW', 'HN', NULL, '2023-10-05 17:25:15', '2023-10-05 17:25:15');
INSERT INTO `members` VALUES (7, 'tesst', '0899999999', 'tesst@gmail.cm', NULL, '$2y$10$eliPRDpKBRzBaeXhemg8fu0TyS.wOJ5.ANeA7TlpAmjIwG31hutTu', 'HN', NULL, '2023-10-05 21:49:28', '2023-10-05 21:49:28');
INSERT INTO `members` VALUES (8, 'test', '0987654322', 'test9933@gmail.com', NULL, '$2y$10$.7otuEpQ/VtfNU9Od94ewusJVCwNPNikKMEK40R2peTzKo0TfVuKi', 'hd', NULL, '2023-10-05 22:37:14', '2023-10-05 22:37:14');
INSERT INTO `members` VALUES (9, 'test', '0977777777', 'test1@gmail.com', NULL, '$2y$10$xNhddpfP9InUjlq.1RFEke.4kHUc9VxZ.TEJnLL551q649pmKjNIi', 'HN', NULL, '2023-10-05 22:38:41', '2023-10-05 22:38:41');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_05_04_025709_create_members_table', 2);
INSERT INTO `migrations` VALUES (7, '2023_05_04_042609_update_users_table', 3);
INSERT INTO `migrations` VALUES (8, '2023_05_08_023912_create_products_table', 4);
INSERT INTO `migrations` VALUES (9, '2023_05_08_024901_create_categories_table', 4);
INSERT INTO `migrations` VALUES (12, '2023_05_12_034930_update_product_table', 5);
INSERT INTO `migrations` VALUES (14, '2023_05_15_151047_update_categories_table', 6);
INSERT INTO `migrations` VALUES (19, '2023_05_16_142817_create_carts_table', 7);
INSERT INTO `migrations` VALUES (20, '2023_05_17_103736_update_members_table', 7);
INSERT INTO `migrations` VALUES (21, '2023_05_17_105229_create_transports_table', 8);
INSERT INTO `migrations` VALUES (22, '2023_05_17_110831_update_carts_table', 9);
INSERT INTO `migrations` VALUES (23, '2023_05_17_111142_create_cart_detail_table', 10);
INSERT INTO `migrations` VALUES (26, '2023_05_19_103229_update_trasport_table', 11);
INSERT INTO `migrations` VALUES (27, '2023_05_19_140111_update_trasport_table', 12);
INSERT INTO `migrations` VALUES (28, '2023_05_19_152806_update_product_table', 13);
INSERT INTO `migrations` VALUES (29, '2023_05_19_154026_update_cart_table', 14);
INSERT INTO `migrations` VALUES (30, '2023_06_01_082038_update_carts_table', 15);
INSERT INTO `migrations` VALUES (31, '2023_06_01_082509_update_products_table', 15);
INSERT INTO `migrations` VALUES (32, '2023_06_01_082651_update_transports_table', 15);
INSERT INTO `migrations` VALUES (33, '2023_06_01_083702_update_users_table', 16);
INSERT INTO `migrations` VALUES (34, '2023_12_19_164208_update_table_products', 17);
INSERT INTO `migrations` VALUES (35, '2023_12_19_165338_create_stock_transactions_table', 17);
INSERT INTO `migrations` VALUES (36, '2023_12_19_165500_create_suppliers_table', 17);
INSERT INTO `migrations` VALUES (37, '2023_12_19_165621_create_cart_status_histories_table', 17);
INSERT INTO `migrations` VALUES (38, '2023_12_19_170602_update_table_products', 18);
INSERT INTO `migrations` VALUES (41, '2023_12_19_211411_update_table_products', 19);
INSERT INTO `migrations` VALUES (42, '2023_12_19_211553_update_table_stock_transactions', 19);
INSERT INTO `migrations` VALUES (43, '2023_12_19_212530_update_table_cart_status_history', 19);
INSERT INTO `migrations` VALUES (44, '2023_12_19_213317_update_table_carts', 20);
INSERT INTO `migrations` VALUES (45, '2023_12_20_105243_update_table_stock_transactions', 21);
INSERT INTO `migrations` VALUES (47, '2023_12_22_154047_update_table_stock_transactions', 22);
INSERT INTO `migrations` VALUES (48, '2023_12_22_170026_update_table_stock_transactions', 23);
INSERT INTO `migrations` VALUES (49, '2023_12_22_172240_update_table_products', 24);
INSERT INTO `migrations` VALUES (51, '2023_12_22_172549_update_table_stock_transactions', 25);
INSERT INTO `migrations` VALUES (52, '2023_12_23_152816_update_table_carts', 26);
INSERT INTO `migrations` VALUES (53, '2023_12_23_172150_create_bill_histories_table', 26);
INSERT INTO `migrations` VALUES (54, '2023_12_23_194846_update_table_carts', 27);
INSERT INTO `migrations` VALUES (55, '2023_12_23_203221_update_table_bill_history', 28);
INSERT INTO `migrations` VALUES (56, '2023_12_23_204632_update_table_cart_status_history', 29);
INSERT INTO `migrations` VALUES (57, '2023_12_24_203123_update_table_cart_status_history', 30);
INSERT INTO `migrations` VALUES (58, '2023_12_24_213619_update_table_bill_stock_transaction', 31);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `masp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `giathuong` decimal(65, 0) NOT NULL,
  `giakm` decimal(65, 0) NULL DEFAULT NULL,
  `soluong` int(11) NULL DEFAULT NULL,
  `hinhanh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `chitiet` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `id_danhmuc` bigint(20) UNSIGNED NOT NULL,
  `status` smallint(6) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (3, 'Áo thun ngắn tay', '010S3', 395000, NULL, 46, 'product/hinhanh/1685590911__TC_9864x900x900x4.webp', 'product/images/1685590911-_TC_9858x900x900x4.webp,product/images/1685590911-_TC_9862x900x900x4.webp,product/images/1685590911-_TC_9866x900x900x4.webp,product/images/1685590911-_TC_9868x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T.shirt phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn t&ocirc;n d&aacute;ng người mặc.<br />\r\n- Thiết kế cổ tr&ograve;n dệt rib dễ mặc. Họa tiết in trước ngực mang đến cho người mặc diện mạo ấn tượng. M&agrave;u sắc nam t&iacute;nh dễ kết hợp c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton đem đến độ xốp nhẹ, đứng d&aacute;ng vừa đủ.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o c&oacute; m&agrave;u sắc n&eacute;t v&agrave; giữ m&agrave;u theo thời gian.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 10:41:51', '2023-12-23 21:58:54');
INSERT INTO `products` VALUES (4, 'Áo T-shirt ngắn tay', '008S3', 350000, NULL, 50, 'product/hinhanh/1685591871__TC_9837x900x900x4.webp', 'product/images/1685591871-_TC_9836x900x900x4.webp,product/images/1685591871-_TC_9841x900x900x4.webp,product/images/1685591871-_TC_9842x900x900x4.webp,product/images/1685591871-_TC_9843x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T.shirt phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn t&ocirc;n d&aacute;ng người mặc.<br />\r\n- Thiết kế cổ tr&ograve;n dệt rib dễ mặc. Họa tiết in chữ trước ngực mang đến cho người mặc diện mạo ấn tượng. M&agrave;u sắc nam t&iacute;nh dễ kết hợp c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton đem đến độ xốp nhẹ, đứng d&aacute;ng vừa đủ.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o c&oacute; m&agrave;u sắc n&eacute;t v&agrave; giữ m&agrave;u theo thời gian.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 10:57:51', '2023-12-24 13:28:52');
INSERT INTO `products` VALUES (5, 'Áo thun ngắn tay', '006S3', 375000, NULL, 50, 'product/hinhanh/1685592302__TC_9841x900x900x4.webp', 'product/images/1685592302-_TC_9836x900x900x4.webp,product/images/1685592302-_TC_9837x900x900x4.webp,product/images/1685592302-_TC_9842x900x900x4.webp,product/images/1685592302-_TC_9843x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim fit<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o thun ngắn tay phom Slim Fit &ocirc;m nhẹ vừa vặn m&agrave; vẫn thoải m&aacute;i vận động<br />\r\n- Thiết kế khỏe khoắn, m&agrave;u sắc cơ bản dễ kết hợp với nhiều trang phục kh&aacute;c mang tới diện mạo trẻ trung, lịch l&atilde;m cho người mặc. Họa tiết logo Aristino sắp xếp ấn tượng tạo điểm nhấn ấn tượng cho to&agrave;n bộ trang phục<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 95% Cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;<br />\r\n- 5% Spandex tạo độ co gi&atilde;n thoải m&aacute;i khi mặc.</p>', 1, 1, 10, '2023-06-01 11:05:02', '2023-12-24 13:30:16');
INSERT INTO `products` VALUES (6, 'Áo T-shirt ngắn tay', '028S3', 375000, NULL, 50, 'product/hinhanh/1685592707_Teal_028S3_1.jpg', 'product/images/1685592707-Teal_028S3_2.jpg,product/images/1685592708-Teal_028S3_3.jpg,product/images/1685592708-Teal_028S3_4.jpg,product/images/1685592708-Teal_028S3_5.jpg', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o T-shirt phom Regular Fit su&ocirc;ng nhẹ thoải m&aacute;i m&agrave; vẫn đảm bảo vừa vặn số đo h&igrave;nh thể<br />\r\n- Thiết kế cổ tr&ograve;n basic v&agrave; nam t&iacute;nh. M&agrave;u sắc trung t&iacute;nh, mang đến nhiều lựa chọn kết hợp trang phục.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 87,697% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ<br />\r\n- 12,4% Spandex tạo độ co gi&atilde;n nhẹ</p>', 1, 1, 10, '2023-06-01 11:11:48', '2023-12-24 13:31:41');
INSERT INTO `products` VALUES (7, 'Áo thun nam', 'AC22', 105000, NULL, 50, 'product/hinhanh/1685592838_ao-thun-nam-aristino-AC22-09x900x900x4.webp', 'product/images/1685592838-ao-thun-nam-aristino-AC22-06x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22-08x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22-10x900x900x4.webp,product/images/1685592838-ao-thun-nam-aristino-AC22x900x900x4.webp', '<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o T-shirt su&ocirc;ng nhẹ dễ chịu, thiết kế basic dễ d&agrave;ng kết hợp với trang phục kh&aacute;c</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>Chất liệu 100% Cotton tự nhi&ecirc;n gi&uacute;p &aacute;o mềm mại, xốp nhẹ, khả năng thấm h&uacute;t tốt, tho&aacute;ng kh&iacute; d&ugrave; ở m&ugrave;a n&agrave;o trong năm, đồng thời vẫn giữ được độ đứng d&aacute;ng vừa đủ.</p>', 1, 1, 10, '2023-06-01 11:13:58', '2023-12-24 13:31:54');
INSERT INTO `products` VALUES (8, 'Quần short nam', '010S4', 695000, 300000, 50, 'product/hinhanh/1685593793__TC_5443x900x900x4.webp', 'product/images/1685593793-_TC_5437x900x900x4.webp,product/images/1685593793-_TC_5443x900x900x4.webp,product/images/1685593793-_TC_5446x900x900x4.webp,product/images/1685593793-_TC_5447x900x900x4.webp,product/images/1685593793-IMG_5492_1x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần shorts &acirc;u phom d&aacute;ng Regular fit với độ su&ocirc;ng rộng vừa phải, tạo sự thoải m&aacute;i cho người mặc.<br />\r\n- Quần được thiết kế cơ bản với m&agrave;u sắc trung t&iacute;nh, gi&uacute;p c&aacute;c anh dễ d&agrave;ng phối hợp với nhiều kiểu trang phục kh&aacute;c nhau, mang lại diện mạo khỏe khoắn, trẻ trung khi mặc.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 70% Polyester gi&uacute;p quần bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 27% Viscose mịn mượt, gi&uacute;p quần nhẹ, tho&aacute;ng m&aacute;t tối đa<br />\r\n- 3% Spandex tạo độ co gi&atilde;n nhẹ</p>', 2, 1, 10, '2023-06-01 11:29:53', '2023-12-24 13:32:09');
INSERT INTO `products` VALUES (9, 'Quần short nam', '009S3', 650000, NULL, 50, 'product/hinhanh/1685595176_IMG_3939_1x900x900x4.webp', 'product/images/1685595176-IMG_3939x900x900x4.webp,product/images/1685595176-IMG_3941x900x900x4.webp,product/images/1685595176-IMG_3942x900x900x4.webp,product/images/1685595176-IMG_3943x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short &acirc;u phom d&aacute;ng regular fit với độ su&ocirc;ng rộng vừa phải, tạo n&ecirc;n sự thoải m&aacute;i trong mọi hoạt động.<br />\r\n- Quần được thiết kế cơ bản với m&agrave;u trắng lịch l&atilde;m, gi&uacute;p c&aacute;c anh dễ d&agrave;ng phối hợp với nhiều kiểu trang phục kh&aacute;c nhau, mang lại diện mạo khỏe khoắn, trẻ trung khi mặc.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 77% Polyester gi&uacute;p quần bền m&agrave;u, sắc n&eacute;t, mặt vải trơn trượt, mỏng nhẹ.<br />\r\n- 21% Rayon gi&uacute;p bộ suit c&oacute; độ mềm mại, m&aacute;t mẻ v&agrave; bay rũ tự nhi&ecirc;n<br />\r\n- 2% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 2, 1, 10, '2023-06-01 11:52:56', '2023-12-24 13:32:27');
INSERT INTO `products` VALUES (10, 'Quần short nam', '025S3', 450000, NULL, 50, 'product/hinhanh/1685602111_NTC_7031x900x900x4.webp', 'product/images/1685602111-IMG_4790_1x900x900x4.webp,product/images/1685602111-NTC_7029x900x900x4.webp,product/images/1685602111-NTC_7032x900x900x4.webp,product/images/1685602111-NTC_7033x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short thể thao phom Regular Fit su&ocirc;ng nhẹ v&agrave; thoải m&aacute;i vận động.<br />\r\n- Kiểu d&aacute;ng thể thao với độ d&agrave;i vừa phải ph&ugrave; hợp với hoạt động thể thao, thiết kế tối giản kết hợp t&uacute;i 2 b&ecirc;n tiện lợi đựng đồ c&aacute; nh&acirc;n khi vận động thể thaoPhần đai quần c&oacute; d&acirc;y chun k&eacute;o gi&uacute;p chỉnh được độ co gi&atilde;n, ph&ugrave; hợp với v&ograve;ng bụng<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 100% Polyester mang đến độ b&oacute;ng sắc n&eacute;t, kh&ocirc;ng bị bai d&atilde;o, lu&ocirc;n bền m&agrave;u. Quần c&ograve;n c&oacute; khả năng chống b&aacute;m bụi, chống nhăn, hạn chế thấm nước, độ bền cao.</p>', 2, 1, 10, '2023-06-01 13:48:31', '2023-12-24 13:32:42');
INSERT INTO `products` VALUES (11, 'Quần short nam', '017S3', 495000, NULL, 50, 'product/hinhanh/1685602287__TC_5695x900x900x4.webp', 'product/images/1685602287-_TC_5693x900x900x4.webp,product/images/1685602287-_TC_5697x900x900x4.webp,product/images/1685602287-_TC_5698x900x900x4.webp,product/images/1685602287-IMG_9738x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\nTHIẾT KẾ:<br />\r\n- Quần short thể thao phom Regular Fit su&ocirc;ng nhẹ v&agrave; thoải m&aacute;i vận động.<br />\r\n- Thiết kế basic khỏe khoắn với t&uacute;i quần tiện lợi. Họa tiết h&igrave;nh học in ch&igrave;m tr&agrave;n quần ấn tượng. M&agrave;u sắc cơ bản dễ d&agrave;ng kết hợp với c&aacute;c trang phục kh&aacute;c.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 92% Polyester mang đến độ b&oacute;ng sắc n&eacute;t, kh&ocirc;ng bị bai d&atilde;o, lu&ocirc;n bền m&agrave;u. Quần&nbsp;c&ograve;n c&oacute; khả năng chống b&aacute;m bụi, chống nhăn, hạn chế thấm nước, độ bền cao.<br />\r\n- 8% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 2, 1, 10, '2023-06-01 13:51:27', '2023-12-24 13:32:57');
INSERT INTO `products` VALUES (12, 'Áo sơ mi ngắn tay nam', '101S1', 695000, 556000, 50, 'product/hinhanh/1685602508_ao-so-mi-aristino-ASS101S1-02x900x900x4.webp', 'product/images/1685602508-ao-so-mi-aristino-ASS101S1-01x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1-03x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1-04x900x900x4.webp,product/images/1685602508-ao-so-mi-aristino-ASS101S1x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom perfect fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&agrave; bằng thoải m&aacute;i. Cổ &aacute;o đứng lịch sự c&ugrave;ng t&uacute;i ngực tiện lợi. &Aacute;o in họa tiết sắc n&eacute;t tr&ecirc;n nền trắng tinh t&ecirc; mang đến diện mạo thu h&uacute;t cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:&nbsp;</strong></p>\r\n\r\n<p>- Chất liệu 50% Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.</p>\r\n\r\n<p>- Kết hợp 50% Polyspun gi&uacute;p tiết kiệm tối đa thời gian cho chuyện l&agrave; ủi nhờ khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 13:55:08', '2023-12-24 13:33:08');
INSERT INTO `products` VALUES (13, 'Áo sơ mi nam ngắn tay', '315S2', 750000, 600000, 49, 'product/hinhanh/1685602803_ao-so-mi-nam-aristino-ASS315S2-02x900x900x4.webp', 'product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-01x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-03x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2-08x900x900x4.webp,product/images/1685602803-ao-so-mi-nam-aristino-ASS315S2x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom Perfect fit su&ocirc;ng rộng, t&agrave; bằng, độ d&agrave;i &aacute;o vừa phải để mặc thả ngo&agrave;i trong m&ocirc;i trường c&ocirc;ng sở.</p>\r\n\r\n<p>- &Aacute;o thiết kế t&agrave; bằng, c&oacute; t&uacute;i ngực, m&agrave;u xanh đậm với họa tiết kẻ nổi bật, đem lại vẻ ngo&agrave;i trẻ trung nhưng vẫn rất lịch l&atilde;m cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- 50% Modal gi&uacute;p &aacute;o mềm mại v&agrave; thấm h&uacute;t tốt.</p>\r\n\r\n<p>- 50% Polyspun mang đến khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 14:00:03', '2023-12-24 21:42:03');
INSERT INTO `products` VALUES (14, 'Áo sơ mi ngắn tay nam', '016S2', 795000, 636000, 50, 'product/hinhanh/1685603198_ao-so-mi-ngan-tay-nam-aristino-ass016s2-4x900x900x4.webp', 'product/images/1685603198-ao-so-mi-ngan-tay-nam-aristino-ass016s2-1x900x900x4.webp,product/images/1685603198-ao-so-mi-ngan-tay-nam-aristino-ass016s2x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>Perfect Fit</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom Perfect Fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&agrave; bằng thoải m&aacute;i. Cổ &aacute;o đứng lịch sự c&ugrave;ng t&uacute;i ngực tiện lợi. Hiệu ứng xanh t&iacute;m than kẻ dobby lịch l&atilde;m, thời thượng tạo n&ecirc;n dấu ấn thanh lịch cho qu&yacute; &ocirc;ng.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- 50% Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.<br />\r\n- 50% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ.</p>', 3, 1, 10, '2023-06-01 14:06:38', '2023-12-24 13:33:59');
INSERT INTO `products` VALUES (15, 'Áo sơ mi ngắn tay nam', '172S1', 695000, 556000, 48, 'product/hinhanh/1685603810_ao-so-mi-nam-aristino-ASS172S1-04x900x900x4.webp', 'product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-02x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-03x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1-05x900x900x4.webp,product/images/1685603810-ao-so-mi-nam-aristino-ASS172S1x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>PERFECT FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o sơ mi ngắn tay phom perfect fit su&ocirc;ng rộng mặc thả ngo&agrave;i m&agrave; vẫn đảm bảo độ lịch sự chỉn chu cho người mặc.</p>\r\n\r\n<p>- Thiết kế basic với t&uacute;i ngực tiện lợi v&agrave; t&agrave; bằng thoải m&aacute;i. &Aacute;o dệt dobby họa tiết kẻ trắng tr&ecirc;n nền xanh nam t&iacute;nh mang đến diện mạo ấn tượng cho người mặc.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu Bamboo từ sợi tre thi&ecirc;n nhi&ecirc;n mang đến sự tho&aacute;ng m&aacute;t, thấm h&uacute;t tốt v&agrave; tạo cảm gi&aacute;c thoải m&aacute;i.</p>\r\n\r\n<p>- Kết hợp Polyspun gi&uacute;p tiết kiệm tối đa thời gian cho chuyện l&agrave; ủi nhờ khả năng đ&agrave;n hồi tự nhi&ecirc;n v&agrave; &iacute;t nhăn co trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>', 3, 1, 10, '2023-06-01 14:16:50', '2023-12-24 21:38:04');
INSERT INTO `products` VALUES (16, 'Áo polo nam có cổ ngắn tay', '064S3', 695000, NULL, 50, 'product/hinhanh/1685606060__TC_9283x900x900x4.webp', 'product/images/1685606060-_TC_9274x900x900x4.webp,product/images/1685606060-_TC_9277x900x900x4.webp,product/images/1685606060-_TC_9286x900x900x4.webp,product/images/1685606060-_TC_9289x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o polo phom d&aacute;ng Slim Fit &ocirc;m nhẹ vừa vặn m&agrave; vẫn thoải m&aacute;i linh hoạt khi vận động.<br />\r\n- Thiết kế &aacute;o ấn tượng với họa tiết logo Aristino xếp chồng chỉn chu theo chiều ngang ngực &aacute;o mang tới hiệu ứng thị gi&aacute;c bắt mắt. Đồng thời thiết kế c&ograve;n tả n&ecirc;n điểm nhấn khỏe khoắn, trẻ trung cho người mặc<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 96,5% cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ, khả năng thấm h&uacute;t tốt, tho&aacute;ng kh&iacute; d&ugrave; ở m&ugrave;a n&agrave;o trong năm, đồng thời vẫn giữ được độ đứng d&aacute;ng vừa đủ.<br />\r\n- 3,5% spandex tăng độ co gi&atilde;n</p>', 4, 1, 10, '2023-06-01 14:54:20', '2023-12-24 13:34:38');
INSERT INTO `products` VALUES (17, 'Áo polo nam có cổ ngắn tay', '115S3', 650000, NULL, 50, 'product/hinhanh/1685607056__TC_9262x900x900x4.webp', 'product/images/1685607056-_TC_9261x900x900x4.webp,product/images/1685607056-_TC_9266x900x900x4.webp,product/images/1685607056-_TC_9267x900x900x4.webp,product/images/1685607056-_TC_9270x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Polo phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ nhưng vẫn vừa vặn, t&ocirc;n d&aacute;ng tối đa khi mặc.<br />\r\n- Thiết kế basic với cổ dệt lịch sự kết hợp họa tiết th&ecirc;u chữ k&yacute; Aristino trước ngực, đem đến diện mạo thời thượng cho người mặc&quot;<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 48% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 47% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex gi&uacute;p &aacute;o co gi&atilde;n thoải m&aacute;i</p>', 4, 1, 10, '2023-06-01 15:10:56', '2023-12-24 13:35:10');
INSERT INTO `products` VALUES (18, 'Áo polo nam cổ ngắn tay', '046S3', 595000, NULL, 50, 'product/hinhanh/1685607220__TC_9581x900x900x4.webp', 'product/images/1685607220-_TC_9582x900x900x4.webp,product/images/1685607220-_TC_9591x900x900x4.webp,product/images/1685607220-_TC_9592x900x900x4.webp,product/images/1685607220-IMG_1752_1x900x900x4.webp', '<p>FORM D&Aacute;NG: Slim Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o polo phom Slim fit &ocirc;m vừa mang lại vẻ ngo&agrave;i lịch l&atilde;m cho qu&yacute; &ocirc;ng<br />\r\n- Thiết kế basic với cổ dệt lịch sự kết hợp họa tiết những đường kẻ c&aacute;ch điệu trẻ trung, đem đến diện mạo thời thượng cho người mặc&quot;<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex gi&uacute;p &aacute;o co gi&atilde;n thoải m&aacute;i</p>', 4, 1, 10, '2023-06-01 15:13:40', '2023-12-24 13:35:22');
INSERT INTO `products` VALUES (19, 'Áo thun có cổ ngắn tay', '157S3', 595000, NULL, 50, 'product/hinhanh/1685607465__TC_9678x900x900x4.webp', 'product/images/1685607465-_TC_9174x900x900x4.webp,product/images/1685607465-_TC_9179x900x900x4.webp,product/images/1685607465-_TC_9182x900x900x4.webp,product/images/1685607465-_TC_9183x900x900x4.webp', '<p>FORM D&Aacute;NG: Regular Fit<br />\r\n<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Polo phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ nhưng vẫn vừa vặn, t&ocirc;n d&aacute;ng tối đa khi mặc<br />\r\n- Thiết kế được lấy cảm hứng từ họa tiết logo Aristino c&aacute;ch điệu tạo n&ecirc;n ấn tượng mạnh mẽ. M&agrave;u sắc nam t&iacute;nh dễ d&agrave;ng phối hợp với c&aacute;c trang phục kh&aacute;c nhau để tạo n&ecirc;n diện mạo lịch l&atilde;m<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 87.6% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ<br />\r\n- 12.4% Spandex tạo độ co gi&atilde;n nhẹ</p>', 4, 1, 10, '2023-06-01 15:17:45', '2023-12-24 13:35:45');
INSERT INTO `products` VALUES (20, 'Áo thun dài tay', '009W2', 395000, NULL, 50, 'product/hinhanh/1685607703_Ao-thu-dong-Aristino-ALT009W2-6-x900x900x4.webp', 'product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-5-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-7-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-8-x900x900x4.webp,product/images/1685607703-Ao-thu-dong-Aristino-ALT009W2-9-x900x900x4.webp', '<p><strong>Kiểu d&aacute;ng</strong>:&nbsp;Body Fit</p>\r\n\r\n<p><strong>Thiết kế</strong>:<br />\r\n- &Aacute;o gữ nhiệt phom d&aacute;ng Body Fit &ocirc;m s&aacute;t cơ thể, gọn g&agrave;ng, thoải m&aacute;i v&agrave; giữ ấm tối đa khi mặc.<br />\r\n- &Aacute;o thiết đơn giản với 2 gam m&agrave;u trung t&iacute;nh đem lại nhiều lựa chọn kết hợp m&agrave;u sắc v&agrave; trang phục.</p>\r\n\r\n<p><strong>Chất liệu</strong>:<br />\r\n- 95% Heatmax gi&uacute;p giữ ấm tối ưu với c&aacute;c loại sợi cao cấp, th&ocirc;ng tho&aacute;ng kh&iacute; v&agrave; mềm mại với da<br />\r\n- 5% Spandex giữ độ co gi&atilde;n tốt, tạo sự thoải m&aacute;i</p>', 5, 1, 10, '2023-06-01 15:21:43', '2023-12-24 13:36:04');
INSERT INTO `products` VALUES (22, 'Áo thun dài tay', '006W2', 495000, NULL, 50, 'product/hinhanh/1685608671_Ao-thun-Aristini-ALT006W2-12-x900x900x4.webp', 'product/images/1685608671-Ao-thun-Aristini-ALT006W2-11-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-13-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-14-x900x900x4.webp,product/images/1685608671-Ao-thun-Aristini-ALT006W2-15-x900x900x4.webp', '<p>Kiểu d&aacute;ng:&nbsp;Regular fit</p>\r\n\r\n<p>Thiết kế:<br />\r\n- &Aacute;o thun d&agrave;i tay phom Regular fit su&ocirc;ng vừa, thoải m&aacute;i tuyệt đối khi mặc.<br />\r\n- &Aacute;o thiết kế đơn giản với gam m&agrave;u tối hiện đại, c&ugrave;ng họa tiết in ngực tr&aacute;i đem đến diện mạo thời thượng cho người mặc.</p>\r\n\r\n<p>Chất liệu:&nbsp;<br />\r\n- 57% Cotton gi&uacute;p &aacute;o mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester cho bề mặt vải b&oacute;ng mịn, sắc n&eacute;t, &iacute;t nhăn nh&agrave;u.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ.</p>', 5, 1, 10, '2023-06-01 15:37:51', '2023-12-24 13:36:32');
INSERT INTO `products` VALUES (23, 'Áo thun dài tay', '002W9', 375000, NULL, 50, 'product/hinhanh/1685608833_ao-thu-dong-nam-aristino-ALT002W9-05x900x900x4.webp', 'product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-01x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-02x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-03x900x900x4.webp,product/images/1685608833-ao-thu-dong-nam-aristino-ALT002W9-04x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:</strong>&nbsp;CASUAL FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o T-shirt d&agrave;i tay phom d&aacute;ng Casual fit su&ocirc;ng rộng, mang đến vẻ ngo&agrave;i thời thượng v&agrave; ph&oacute;ng kho&aacute;ng.</p>\r\n\r\n<p>- Thiết kế cơ bản với cổ tr&ograve;n, m&agrave;u sắc trung t&iacute;nh. Điểm nhấn của &aacute;o nằm ở chữ k&yacute; lớn c&aacute;ch điệu từ logo Aristino được in ở phần ngực phải. &Aacute;o th&iacute;ch hợp để mặc c&ugrave;ng quần d&agrave;i thu đ&ocirc;ng để đi dạo, tập thể thao v&agrave;o m&ugrave;a lạnh.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu CVC mang đến những ưu điểm vượt trội l&agrave; sự mềm mại, xốp nhẹ, tho&aacute;ng kh&iacute;, bền đẹp v&agrave; giữ m&agrave;u sắc n&eacute;t theo thời gian.</p>', 5, 1, 10, '2023-06-01 15:40:33', '2023-12-24 13:36:52');
INSERT INTO `products` VALUES (24, 'Áo thun dài tay nam', '004W9', 375000, NULL, 50, 'product/hinhanh/1685609113_ao-thu-dong-nam-aristino-ALT004W9-03x900x900x4.webp', 'product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9-01x900x900x4.webp,product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9-02x900x900x4.webp,product/images/1685609113-ao-thu-dong-nam-aristino-ALT004W9x900x900x4.webp', '<p><strong>KIỂU D&Aacute;NG:&nbsp;</strong>CASUAL FIT</p>\r\n\r\n<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o thun d&agrave;i tay phom Casual Fit c&oacute; độ su&ocirc;ng rộng vừa đủ đồng thời vẫn đảm bảo vừa vặn số đo h&igrave;nh thể nam giới Việt.</p>\r\n\r\n<p>- Thiết kế tối giản ở phần cổ v&agrave; được tạo điểm nhấn nhờ in họa tiết chữ độc nhất v&agrave; đầy ấn tượng. &Aacute;o m&agrave;u sắc trung t&iacute;nh, c&oacute; thể kết hợp với quần jean, quần khaki v&agrave; &aacute;o jacket để c&oacute; vẻ ngo&agrave;i năng động, trẻ trung m&agrave; vẫn ấm &aacute;p.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu CVC cao cấp đem đến những sự kết hợp ưu điểm của sợi cotton tự nhi&ecirc;n v&agrave; sợi nh&acirc;n tạo. Đ&oacute; l&agrave; độ mềm mại, tho&aacute;ng m&aacute;t, xốp nhẹ, đồng thời lại bền chắc v&agrave; m&agrave;u sắc sắc n&eacute;t.</p>', 5, 1, 10, '2023-06-01 15:45:13', '2023-12-24 13:37:05');
INSERT INTO `products` VALUES (25, 'Áo tanktop', '009S4', 350000, NULL, 50, 'product/hinhanh/1685611411__TC_9811x900x900x4.webp', 'product/images/1685611411-_TC_9810x900x900x4.webp,product/images/1685611411-_TC_9814x900x900x4.webp,product/images/1685611411-_TC_9818x900x900x4.webp,product/images/1685611411-_TC_9819x900x900x4.webp', '<p>THIẾT KẾ:<br />\r\n- &Aacute;o tanktop thiết kế basic ph&ugrave; hợp với mọi d&aacute;ng người. &Aacute;o th&iacute;ch hợp để mặc ở nh&agrave; lẫn ph&ograve;ng tập.<br />\r\n- Họa tiết in ấn tượng trước ngực tạo điểm nhấn độc đ&aacute;o. M&agrave;u sắc nam t&iacute;nh mang đến diện mạo thu h&uacute;t cho người mặc<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Modal cho bề mặt vải mềm mại, nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ.<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 6, 1, 10, '2023-06-01 16:23:31', '2023-12-24 13:37:16');
INSERT INTO `products` VALUES (26, 'Áo tanktop', '008S4', 295000, NULL, 50, 'product/hinhanh/1685611573__TC_0092x900x900x4.webp', 'product/images/1685611573__TC_0084x900x900x4.webp,product/images/1685611573__TC_0087x900x900x4.webp,product/images/1685611573__TC_0095x900x900x4.webp,product/images/1685611573_IMG_1591x900x900x4.webp', '<p>FORM D&Aacute;NG:&nbsp;Tanktop<br />\r\nTHIẾT KẾ:<br />\r\n- &Aacute;o Tanktop (ba lỗ) thiết kế khỏe khoắn, m&agrave;u sắc cơ bản m&agrave; đa dạng, gi&uacute;p người mặc thoải m&aacute;i trong mọi vận động bất kể thời tiết m&ugrave;a n&agrave;o..<br />\r\n- Cổ &aacute;o vẫn l&agrave; dạng cổ tr&ograve;n quen thuộc, trước ngực in th&ecirc;m chi tiết nhỏ tạo điểm nhấn.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton mềm mịn, tho&aacute;ng kh&iacute;, thấm mồ h&ocirc;i vượt trội v&agrave; th&acirc;n thiện với l&agrave;n da<br />\r\n- 38% Polyester gi&uacute;p &aacute;o bền m&agrave;u, sắc n&eacute;t v&agrave; độ trơn trượt, mỏng nhẹ<br />\r\n- 5% Spandex tạo độ co gi&atilde;n nhẹ</p>', 6, 1, 10, '2023-06-01 16:25:39', '2023-12-24 13:37:30');
INSERT INTO `products` VALUES (27, 'Áo tanktop', '003S3', 295000, NULL, 50, 'product/hinhanh/1685611704_Ao-tanktop-Aristino-ATT003S3-5-x900x900x4.webp', 'product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-6-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-7-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-8-x900x900x4.webp,product/images/1685611704-Ao-tanktop-Aristino-ATT003S3-9-x900x900x4.webp', '<p>THIẾT KẾ:<br />\r\n- &Aacute;o Tank top (ba lỗ) thiết kế khỏe khoắn, m&agrave;u sắc cơ bản m&agrave; đa dạng, mang đến nhiều lựa chọn kết hợp trang phục cho m&ocirc;i trường ngo&agrave;i c&ocirc;ng sở.<br />\r\n<br />\r\nCHẤT LIỆU:<br />\r\n- 57% Cotton gi&uacute;p quần mềm mại, xốp nhẹ v&agrave; tho&aacute;ng kh&iacute;.<br />\r\n- 38% Polyester cho bề mặt vải b&oacute;ng mịn, sắc n&eacute;t, &iacute;t nhăn co<br />\r\n- 5% Spandex tạo độ co gi&atilde;n thoải m&aacute;i khi mặc</p>', 6, 1, 10, '2023-06-01 16:28:24', '2023-12-24 13:37:45');
INSERT INTO `products` VALUES (28, 'Áo tank-top', 'TTR06', 295000, NULL, 50, 'product/hinhanh/1685611812_ao-tank-top-nam-aristino-ATTR06-07x900x900x4.webp', 'product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-06x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-08x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-09x900x900x4.webp,product/images/1685611812-ao-tank-top-nam-aristino-ATTR06-10x900x900x4.webp', '<p><strong>CHI TIẾT:</strong></p>\r\n\r\n<p>- &Aacute;o Tank-top c&oacute; thiết kế cơ bản v&agrave; khỏe khoắn. M&agrave;u sắc &aacute;o trung t&iacute;nh c&oacute; thể mặc khi tham gia c&aacute;c hoạt động thể thao hoặc mặc layer cho phong c&aacute;ch ngo&agrave;i c&ocirc;ng sở.</p>\r\n\r\n<p><strong>CHẤT LIỆU:</strong></p>\r\n\r\n<p>- Chất liệu Supima Cotton cao cấp - một trong những loại cotton tốt nhất tr&ecirc;n thế giới. Sợi b&ocirc;ng si&ecirc;u d&agrave;i cho bề mặt vải b&oacute;ng đẹp, mềm mịn như lụa v&agrave; hạn chế v&oacute;n cục. Độ bền cao v&agrave; b&oacute;ng đẹp hơn sau mỗi lần giặt. Kết hợp 5% Spandex tạo n&ecirc;n độ co d&atilde;n vừa phải cho &aacute;o.</p>', 6, 1, 10, '2023-06-01 16:30:12', '2023-12-24 13:39:29');
INSERT INTO `products` VALUES (29, 'test', 'ad123', 111500, 111111, 1, 'product/hinhanh/1703664066_ao-thun-nam-aristino-AC22x900x900x4.webp', NULL, NULL, 1, 1, 10, '2023-12-27 15:01:06', '2023-12-27 15:01:06');

-- ----------------------------
-- Table structure for stock_transactions
-- ----------------------------
DROP TABLE IF EXISTS `stock_transactions`;
CREATE TABLE `stock_transactions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `cart_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_in_price` decimal(65, 0) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stock_transactions
-- ----------------------------
INSERT INTO `stock_transactions` VALUES (1, 3, NULL, 1, 1, 'in', 100000, 50, '2023-12-23', NULL, 1, '2023-12-23 21:56:02', '2023-12-23 21:56:02');
INSERT INTO `stock_transactions` VALUES (2, NULL, 1, NULL, 1, 'out', NULL, NULL, '2023-12-23', NULL, 1, '2023-12-23 21:58:54', '2023-12-23 21:58:54');
INSERT INTO `stock_transactions` VALUES (3, 4, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:28:52', '2023-12-24 13:28:52');
INSERT INTO `stock_transactions` VALUES (4, 5, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:30:16', '2023-12-24 13:30:16');
INSERT INTO `stock_transactions` VALUES (5, 6, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:31:41', '2023-12-24 13:31:41');
INSERT INTO `stock_transactions` VALUES (6, 7, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:31:54', '2023-12-24 13:31:54');
INSERT INTO `stock_transactions` VALUES (7, 8, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:32:09', '2023-12-24 13:32:09');
INSERT INTO `stock_transactions` VALUES (8, 9, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:32:27', '2023-12-24 13:32:27');
INSERT INTO `stock_transactions` VALUES (9, 10, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:32:42', '2023-12-24 13:32:42');
INSERT INTO `stock_transactions` VALUES (10, 11, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:32:57', '2023-12-24 13:32:57');
INSERT INTO `stock_transactions` VALUES (11, 12, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:33:09', '2023-12-24 13:33:09');
INSERT INTO `stock_transactions` VALUES (12, 13, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:33:32', '2023-12-24 13:33:32');
INSERT INTO `stock_transactions` VALUES (13, 14, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:33:59', '2023-12-24 13:33:59');
INSERT INTO `stock_transactions` VALUES (14, 15, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:34:10', '2023-12-24 13:34:10');
INSERT INTO `stock_transactions` VALUES (15, 16, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:34:38', '2023-12-24 13:34:38');
INSERT INTO `stock_transactions` VALUES (16, 17, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:35:10', '2023-12-24 13:35:10');
INSERT INTO `stock_transactions` VALUES (17, 18, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:35:22', '2023-12-24 13:35:22');
INSERT INTO `stock_transactions` VALUES (18, 19, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:35:45', '2023-12-24 13:35:45');
INSERT INTO `stock_transactions` VALUES (19, 20, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:36:04', '2023-12-24 13:36:04');
INSERT INTO `stock_transactions` VALUES (20, 22, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:36:32', '2023-12-24 13:36:32');
INSERT INTO `stock_transactions` VALUES (21, 23, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:36:52', '2023-12-24 13:36:52');
INSERT INTO `stock_transactions` VALUES (22, 24, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:37:05', '2023-12-24 13:37:05');
INSERT INTO `stock_transactions` VALUES (23, 25, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:37:17', '2023-12-24 13:37:17');
INSERT INTO `stock_transactions` VALUES (24, 26, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:37:30', '2023-12-24 13:37:30');
INSERT INTO `stock_transactions` VALUES (25, 27, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:37:45', '2023-12-24 13:37:45');
INSERT INTO `stock_transactions` VALUES (26, 28, NULL, 1, 1, 'in', 100000, 50, '2023-12-24', NULL, 1, '2023-12-24 13:39:29', '2023-12-24 13:39:29');
INSERT INTO `stock_transactions` VALUES (27, NULL, 3, NULL, 1, 'out', NULL, NULL, '2023-12-24', NULL, 1, '2023-12-24 21:38:05', '2023-12-24 21:38:05');
INSERT INTO `stock_transactions` VALUES (28, NULL, 4, NULL, 1, 'out', NULL, NULL, '2023-12-24', NULL, 1, '2023-12-24 21:42:04', '2023-12-24 21:42:04');

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'Aristino', 'Aristino', '0988776655', '2023-12-19 23:01:11', '2023-12-19 23:01:11');

-- ----------------------------
-- Table structure for transports
-- ----------------------------
DROP TABLE IF EXISTS `transports`;
CREATE TABLE `transports`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transports
-- ----------------------------
INSERT INTO `transports` VALUES (1, 1, 'Trung Anh', '0977324362', 'trunganh9933@gmail.com', 'Hải Dương', NULL, '2023-05-19 14:49:20', '2023-05-26 15:43:09');
INSERT INTO `transports` VALUES (2, 3, 'Lộc', '0374729196', 'luuloc.02102001@gmail.com', 'giao yến giao thủy', NULL, '2023-06-01 21:17:04', '2023-06-01 21:17:04');
INSERT INTO `transports` VALUES (3, 4, 'Đỗ Huyền', '0327328369', 'minmin38012001@gmail.com', 'Giao Tác, Liên Hà, Đông Anh, Hà Nội', NULL, '2023-06-01 21:19:19', '2023-06-01 21:19:19');
INSERT INTO `transports` VALUES (4, 5, 'Nguyễn Huy Hoàng', '0867699706', 'huy43412@gmail.com', 'HD', NULL, '2023-06-01 21:33:18', '2023-06-01 21:33:18');
INSERT INTO `transports` VALUES (5, 6, 'Test', '0888888888', 'test@gmail.com', 'HN', NULL, '2023-10-06 16:43:56', '2023-10-06 16:43:56');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '0987654321', 'admin@gmail.com', NULL, '$2y$10$MLmefJTJ2Lv..7aNB.HoyOtLDZHPE1O69cQLQm7jpVkgaYlprRq0C', 1, 1, '06JPcQDPzeIEgBDDjD8NDO0n0Ux6fMzrms8zI7NA8FXv5A79TQ19A5zMxonn', '2023-05-04 12:00:00', '2023-05-15 14:02:01');
INSERT INTO `users` VALUES (6, 'viet', '0988775544', 'viet@gmail.com', NULL, '$2y$10$ID4MXujIIB/1mM7OcOpdleJNFJVH88Hy1/9Lwl2zhcakJELNW2vK6', 2, 0, NULL, '2023-05-24 20:23:06', '2023-05-24 20:23:06');
INSERT INTO `users` VALUES (7, 'hoàng', '0983412310', 'hoang@gmail.com', NULL, '$2y$10$GtMe7c9GKnvAI2hkULWfBewlBTzqoyMWYbuuXadLXMnoHne05kvdu', 1, 1, NULL, '2023-05-24 20:23:37', '2023-06-01 22:48:45');
INSERT INTO `users` VALUES (8, 'lộc', '0912367823', 'loc@gmail.com', NULL, '$2y$10$60tYZ1vVxt9IFiuLxSMzHOLJjVLR3D6z1oAY7wt8wOOHEh0qzmvJ.', 2, 1, NULL, '2023-06-01 10:09:07', '2023-06-01 22:48:40');

SET FOREIGN_KEY_CHECKS = 1;
