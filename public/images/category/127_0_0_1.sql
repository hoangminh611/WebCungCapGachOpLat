-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 10, 2017 lúc 08:33 AM
-- Phiên bản máy phục vụ: 10.1.22-MariaDB
-- Phiên bản PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vlxdhungminh`
--
CREATE DATABASE IF NOT EXISTS `vlxdhungminh` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vlxdhungminh`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 1000, 34235, '2017-07-19 09:18:00', '2017-06-15 00:38:08'),
(2, 1, 13, 1000, 34235, '2017-06-19 09:17:56', '2017-06-13 00:38:08'),
(3, 1, 12, 10000, 34235, '2017-06-19 09:17:43', '2017-06-13 00:38:08'),
(4, 2, 12, 10000, 423423, '2017-07-12 09:17:48', '2017-06-13 00:38:08'),
(5, 2, 13, 1000, 246534, '2017-06-19 09:17:52', '2017-06-13 00:38:08'),
(6, 2, 12, 342, 246534, '2017-06-22 06:44:37', '2017-06-15 00:38:08'),
(7, 2, 12, 354, 246534, '2017-07-20 07:19:31', '2017-06-15 00:38:08'),
(8, 1, 12, 213, 34235, '2017-06-21 07:19:42', '2017-08-13 00:38:08'),
(9, 1, 12, 213, 34235, '2017-06-22 06:45:24', '2017-07-13 00:38:08'),
(10, 1, 12, 213, 34235, '2017-06-23 06:45:24', '2017-07-13 00:38:08'),
(11, 1, 12, 213, 34235, '2017-06-24 06:45:24', '2017-07-13 00:38:08'),
(12, 1, 12, 213, 34235, '2017-06-25 06:45:24', '2017-07-13 00:38:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user_customer` int(11) DEFAULT NULL,
  `name_user_customer` varchar(100) NOT NULL,
  `email_user_customer` varchar(100) NOT NULL,
  `add_user_customer` varchar(100) NOT NULL,
  `phone_user_customer` int(20) NOT NULL,
  `date_order` date DEFAULT NULL,
  `total` double DEFAULT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id`, `id_user_customer`, `name_user_customer`, `email_user_customer`, `add_user_customer`, `phone_user_customer`, `date_order`, `total`, `payment`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', '', 0, '2017-06-13', 211, 'tt', '23sadasfd', '2017-06-13 00:38:08', '2017-06-13 00:38:08'),
(2, 2, '', '', '', 0, '2017-06-13', 2112, 'tt', '23sadasfd', '2017-06-13 00:38:08', '2017-06-13 00:38:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `title` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `description` text COLLATE utf8_vietnamese_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `id_user`, `title`, `image`, `description`, `created_at`) VALUES
(1, 1, 'abcdef', 'abcde.img', 'abcdefghdsakaksidjalkasdnasksdklasdjasnaajsd.ajuenuenchdkdnhdncdmckdsusmc.mdhusmckdmcv,d.', '2017-07-10 06:10:48'),
(2, 1, 'abcdef', 'abcde.img', 'abcdefghdsakaksidjalkasdnasksdklasdjasnaajsd.ajuenuenchdkdnhdncdmckdsusmc.mdhusmckdmcv,d.', '2017-07-10 06:10:51'),
(3, 1, 'abcdef', 'abcde.img', '1231321456457891231.sdncuaiwnkasc1321s65qwgcuiaqwn,, ciquwhfewnfiaqlr\r\nahdcfwik,vsd.', '2017-07-10 06:10:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_khong_dau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_type` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `unit_price` float DEFAULT NULL,
  `promotion_price` float DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view` int(100) NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `name_khong_dau`, `id_type`, `description`, `unit_price`, `promotion_price`, `image`, `unit`, `view`, `created_at`, `updated_at`) VALUES
(1, 'Ván gỗ công nghệ Đức CND9', 'Van-go-cong-nghe-Duc-CND9', 2, 'abcdef', 899000, 15000, '3128139201302004055-121616-2044353-jpeg.jpg', 'm2', 40, NULL, NULL),
(2, 'Ván gỗ công nghệ Đức CND8', 'Van-go-cong-nghe-Duc-CND8', 2, 'abcdef', 799000, 10000, '3128139201302004055-121616-2044353-jpeg.jpg', 'm2', 10, NULL, NULL),
(3, 'Ván gỗ công nghệ Đức CND10', 'Van-go-cong-nghe-Duc-CND10', 2, NULL, 1099000, NULL, '3128139201302004055-121616-2044353-jpeg.jpg', 'm2', 10, NULL, NULL),
(4, 'Ván gỗ công nghệ Đức CND11', 'Van-go-cong-nghe-Duc-CND11', 2, 'acacsad', 1199000, 150000, '3128139201302004055-121616-2044353-jpeg.jpg', 'm2', 10, NULL, NULL),
(5, 'Sàn gỗ công nghiệp CN8', 'San-go-cong-nghiep-CN8', 2, 'adsadsa', 2090000, 1890000, '063510838-1803923-1.jpg', 'm2', 10, NULL, NULL),
(6, 'Sàn gỗ ngoài trời NT3', 'San-go-ngoai-troi-NT3', 2, NULL, 900000, 750000, '1001943ac7-2-1.jpg', 'm2', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `hinh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `hinh`) VALUES
(1, 'vlxdhungminh_files/slider-re1.jpg'),
(2, 'vlxdhungminh_files/slider-re2.jpg'),
(3, 'vlxdhungminh_files/slider-re3.jpg'),
(10, 'vlxdhungminh_files/layer-46.jpg'),
(11, 'vlxdhungminh_files/layer-45.jpg'),
(12, 'vlxdhungminh_files/layer-47.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `social_provider`
--

CREATE TABLE `social_provider` (
  `id` int(11) NOT NULL,
  `provider_id` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) NOT NULL,
  `id_bill` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `payment` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_info` text COLLATE utf8_bin NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `security` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_products`
--

CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_khong_dau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `name_khong_dau`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Cát', 'Cat', '', '', NULL, NULL),
(2, 'Gỗ', 'Go', '', '', NULL, NULL),
(3, 'Sắt', 'Sat', '', '', NULL, NULL),
(4, 'Sỏi Đá', 'Soi-Da', '', '', NULL, NULL),
(5, 'Xi Măng', 'Xi-Mang', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(10) NOT NULL DEFAULT '0',
  `group` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`, `active`, `group`) VALUES
(1, 'hưng', 'heodat234@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, '1'),
(4, 'nam', 'dsas@gamil.com', '213253', '12343252436', 'sádahfghf', NULL, NULL, NULL, 0, ''),
(5, 'nam', 'dsass@gamil.com', '213253', 'sadasf34', 'sádahfghf', NULL, NULL, NULL, 0, ''),
(7, 'nams', 'dsaass@gamil.com', '213253', 'sadasf34', 'sádahfghf', NULL, NULL, NULL, 0, ''),
(8, 'hưng', 'heodat2345@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(9, 'hưng', 'heodat2346@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(10, 'hưng', 'heodat23sd4@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(11, 'hưng', 'heodat23ads4@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(12, 'hưng', 'heodat234dsd@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(13, 'hưng', 'heodat23âff4@gmail.com', '12345678', '21423543', 'sfsdagdfh', NULL, NULL, NULL, 0, ''),
(14, 'minh', 'minh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0'),
(15, 'asdas', 'asdas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0'),
(17, 'hoashdaosd', '123@gmail.com', '$2y$10$int7y8MOSVBWXXgm3gEUsusBQ9ZpE936oOBSuXh7BS0HPT2XPskWq', '02123523651', '123/456', '5d42K3pebvBXeA1iheGKarZ7Weu16cAeZdcBD8nEZyEzsPHnckzE7ykJ4wjK', '2017-06-29 03:26:36', '2017-06-29 03:26:36', 0, '1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_user_customer`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_type_foreign` (`id_type`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `social_provider`
--
ALTER TABLE `social_provider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provider_id` (`provider_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bill` (`id_bill`);

--
-- Chỉ mục cho bảng `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `social_provider`
--
ALTER TABLE `social_provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_type_foreign` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
