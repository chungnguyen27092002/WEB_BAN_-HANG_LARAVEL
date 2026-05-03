-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2024 at 12:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_ban_tra_sua`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id_admin_roles` int NOT NULL,
  `admin_admin_id` int UNSIGNED NOT NULL,
  `roles_id_roles` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id_admin_roles`, `admin_admin_id`, `roles_id_roles`) VALUES
(205, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `attr_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_29_121022_add_google_columns_to_customers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policy_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sumary` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `title`, `image`, `sumary`, `content`, `created_at`, `updated_at`) VALUES
(15, 'Vận Chuyển', 'Capture1522.PNG', '<p><strong>Dịch vụ giao h&agrave;ng tận nh&agrave; hoặc giao h&agrave;ng v&agrave;o thời gian cụ thể.</strong></p>', '<p>Ch&iacute;nh s&aacute;ch n&agrave;y chi tiết c&aacute;c loại ph&iacute; vận chuyển, cũng như dịch vụ bổ sung cho kh&aacute;ch h&agrave;ng, v&iacute; dụ như dịch vụ giao h&agrave;ng tận nh&agrave; hoặc giao h&agrave;ng v&agrave;o thời gian cụ thể.</p>', '2024-12-31 10:20:23', '2024-12-31 03:20:23'),
(16, 'Phí Vận Chuyển', 'Capture4042.PNG', '<p><strong>Ch&iacute;nh s&aacute;ch n&agrave;y đưa ra quy định chi tiết về việc giao h&agrave;ng cho kh&aacute;ch h&agrave;ng ở c&aacute;c khu vực kh&aacute;c nhau, từ nội th&agrave;nh đến ngoại tỉnh.</strong></p>', '<p>Ch&iacute;nh s&aacute;ch n&agrave;y đưa ra quy định chi tiết về việc giao h&agrave;ng cho kh&aacute;ch h&agrave;ng ở c&aacute;c khu vực kh&aacute;c nhau, từ nội th&agrave;nh đến ngoại tỉnh.</p>', '2024-12-31 10:19:20', '2024-12-31 03:19:20'),
(14, 'Chất Lượng Sản Phẩm', 'Capture33916.PNG', '<p><strong>Đảm bảo chất lượng sản phẩm, với tem bảo đảm v&agrave; m&atilde; vạch từ NC Việt Nam.</strong></p>', '<p>Ch&iacute;nh s&aacute;ch n&agrave;y tập trung v&agrave;o việc đảm bảo chất lượng sản phẩm của Buona, bao gồm c&aacute;c y&ecirc;u cầu về tem bảo đảm, m&atilde; vạch, v&agrave; hạn sử dụng. Sản phẩm chỉ được bảo h&agrave;nh trong những trường hợp lỗi do nh&agrave; sản xuất v&agrave; khi sản phẩm kh&ocirc;ng bị hỏng do t&aacute;c động b&ecirc;n ngo&agrave;i.<strong>Chi tiết:</strong></p>\r\n\r\n<ul>\r\n	<li>Sản phẩm phải c&oacute; tem bảo đảm của NC Việt Nam v&agrave; m&atilde; vạch.</li>\r\n	<li>Hạn sử dụng l&agrave; 02 năm kể từ ng&agrave;y sản xuất in tr&ecirc;n bao b&igrave;.</li>\r\n	<li>Qu&aacute; tr&igrave;nh đổi sản phẩm chỉ được &aacute;p dụng trong 1 tuần đầu nếu c&oacute; lỗi từ nh&agrave; sản xuất.</li>\r\n	<li>C&aacute;c trường hợp kh&ocirc;ng được bảo h&agrave;nh: hỏng do va đập, bảo quản sai c&aacute;ch, hoặc sản phẩm hết hạn.</li>\r\n</ul>', '2024-12-31 10:13:01', '2024-12-31 03:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `attr_id` int UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`attr_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(29, 'size', 'S', '2024-12-29 13:59:07', '2021-06-28 03:11:17'),
(30, 'size', 'M', '2024-12-29 13:59:12', '2021-06-28 21:18:28'),
(31, 'size', 'L', '2024-12-29 13:59:14', '2021-07-07 19:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `images` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(434, 236, '6573.jpg', '2024-12-31 02:59:56', '2024-12-31 02:59:56'),
(435, 236, '8327.jpg', '2024-12-31 03:00:01', '2024-12-31 03:00:01'),
(436, 237, '7553.jpg', '2024-12-31 03:35:10', '2024-12-31 03:35:10'),
(437, 237, '8738.jpg', '2024-12-31 03:35:19', '2024-12-31 03:35:19'),
(438, 238, '997.jpg', '2024-12-31 03:56:20', '2024-12-31 03:56:20'),
(439, 238, '8586.jpg', '2024-12-31 03:56:25', '2024-12-31 03:56:25'),
(440, 239, '2036.jpg', '2024-12-31 04:12:39', '2024-12-31 04:12:39'),
(441, 240, '8974.jpg', '2024-12-31 05:05:58', '2024-12-31 05:05:58'),
(442, 240, '7137.jpg', '2024-12-31 05:06:07', '2024-12-31 05:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addvertised`
--

CREATE TABLE `tbl_addvertised` (
  `quangcao_id` int NOT NULL,
  `quangcao_name` varchar(255) NOT NULL,
  `hinh_quangcao` varchar(255) NOT NULL,
  `quangcao_status` int NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_addvertised`
--

INSERT INTO `tbl_addvertised` (`quangcao_id`, `quangcao_name`, `hinh_quangcao`, `quangcao_status`, `link`, `created_at`, `updated_at`) VALUES
(8, 'banner1', 'slider_218.jpg', 0, 'https://www.youtube.com/', '2024-12-31 09:29:28', '2024-12-31 02:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `created_at`, `updated_at`, `status`, `email`, `password`, `name`, `phone`) VALUES
(5, '2021-06-08 01:56:57', '2021-06-08 01:56:57', 1, 'admin@gmail.com', '$2y$10$EQEqaY0mtni5ZCLKsc2E.ee2P5h7w1wDZgd2cRrCOgMNtff/eOv0K', 'ADMIN', '0585861855');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_post`
--

CREATE TABLE `tbl_category_post` (
  `cate_post_id` int UNSIGNED NOT NULL,
  `cate_post_name` tinytext NOT NULL,
  `cate_post_status` int NOT NULL,
  `cate_post_slug` varchar(255) NOT NULL,
  `cate_post_desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_category_post`
--

INSERT INTO `tbl_category_post` (`cate_post_id`, `cate_post_name`, `cate_post_status`, `cate_post_slug`, `cate_post_desc`, `created_at`, `updated_at`) VALUES
(8, 'Tin tức mỹ phẩm', 0, 'tra-sua-va-suc-khoe', 'Trà sữa là một thức uống phổ biến và được ưa thích hiện nay. Tuy nhiên, uống quá nhiều trà sữa sẽ có nhiều ảnh hưởng nguy hiểm đến sức khỏe.', '2024-12-31 11:08:20', '2021-07-03 02:02:42'),
(9, 'Mỹ Phẩm', 0, 'quan-tra-sua', 'Hầu hết ai cũng vứt bỏ thứ này khi uống trà sữa trân châu, giờ biết được công dụng thật của nó mới bất ngờ', '2024-12-31 11:08:26', '2021-10-30 20:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int UNSIGNED NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`, `created_at`, `updated_at`) VALUES
(4, 'Chăm sóc da mặt', '<p>Chăm sóc da mặt</p>', 1, '2021-06-27 07:04:12', '2021-11-06 21:35:51'),
(5, 'Chăm sóc cơ thể', 'Chăm sóc cơ thể', 1, '2021-06-27 07:05:13', '2021-06-27 07:05:13'),
(6, 'Chăm sóc tóc', 'Chăm sóc tóc', 1, '2021-06-27 07:05:25', '2021-06-27 07:05:25'),
(7, 'Trang điểm', 'Trang điểm', 1, '2021-06-27 07:05:37', '2021-06-27 07:05:37'),
(8, 'Chăm sóc da dành cho nam', 'Chăm sóc da dành cho nam', 1, '2021-06-27 07:05:49', '2021-06-27 07:05:49'),
(9, 'Thực phẩm chức năng', 'Thực phẩm chức năng', 1, '2021-06-27 07:06:08', '2021-06-27 07:06:08'),
(10, 'Phụ kiện làm đẹp & tiện ích', '<p>Phụ kiện làm đẹp & tiện ích</p>', 1, '2021-06-27 07:06:19', '2021-09-09 18:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_product_id` int UNSIGNED NOT NULL,
  `comment_parent_comment` int NOT NULL,
  `comment_status` int NOT NULL,
  `comment_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `coupon_id` int NOT NULL,
  `coupon_name` varchar(150) NOT NULL,
  `coupon_time` int NOT NULL,
  `coupon_condition` int NOT NULL,
  `coupon_number` int NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `start_day` varchar(50) DEFAULT NULL,
  `end_day` varchar(50) DEFAULT NULL,
  `coupon_status` int DEFAULT '1',
  `coupon_used` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code_active` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `custommer_vip` int DEFAULT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `code_time` timestamp NULL DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_infomation`
--

CREATE TABLE `tbl_infomation` (
  `info_id` int NOT NULL,
  `info_contact` mediumtext NOT NULL,
  `info_map` text NOT NULL,
  `info_logo` varchar(255) NOT NULL,
  `info_fanpage` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_infomation`
--

INSERT INTO `tbl_infomation` (`info_id`, `info_contact`, `info_map`, `info_logo`, `info_fanpage`, `created_at`, `updated_at`) VALUES
(1, '<p><span style=\"font-size:18px\">Địa chỉ: </span>31/15 Nguyễn Cảnh Ch&acirc;n, Phường Nguyễn Cư Trinh, Quận 1, Tp. HCM</p>\r\n\r\n<p><span style=\"font-size:18px\">Email: </span>&nbsp;<a href=\"mailto:example@mail.com\">hebestores.vn@gmail.com</a></p>\r\n\r\n<p><span style=\"font-size:18px\">Hotline: </span>0932621188<span style=\"font-size:18px\"> hoặc </span>&nbsp;0932621188</p>\r\n\r\n<p><span style=\"font-size:18px\">Website: http://google.com.vn.</span></p>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.074425170947!2d106.69275991474917!3d10.80561179230171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528c6b3087445%3A0x9f9e59544876ddf!2zMzU2LCA3IE7GoSBUcmFuZyBMb25nLCBwaMaw4budbmcgNywgQsOsbmggVGjhuqFuaCwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1625906869368!5m2!1svi!2s\" width=\"1250\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'gettyimages-1157712696-2048x204819.jpg', '<div id=\"fb-root\"></div>\r\n            <script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=2339123679735877&autoLogAppEvents=1\" nonce=\"2RfDRhZm\"></script>\r\n<div class=\"fb-page\" \r\ndata-tabs=\"timeline,events,messages\"\r\ndata-href=\"https://www.facebook.com/trasuafeelingtea/\"\r\ndata-width=\"380\" \r\ndata-hide-cover=\"false\"></div>', '2024-12-31 11:49:35', '2021-06-11 04:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intro`
--

CREATE TABLE `tbl_intro` (
  `intro_id` int NOT NULL,
  `intro_title` varchar(100) NOT NULL,
  `intro_desc` text NOT NULL,
  `intro_content` text NOT NULL,
  `intro_image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_intro`
--

INSERT INTO `tbl_intro` (`intro_id`, `intro_title`, `intro_desc`, `intro_content`, `intro_image`, `created_at`, `updated_at`) VALUES
(1, 'Các Loại Mỹ Phẩm Chất Lượng Cao', '<p>Kh&aacute;m ph&aacute; thế giới mỹ phẩm cao cấp với những sản phẩm chăm s&oacute;c sắc đẹp chất lượng h&agrave;ng đầu, gi&uacute;p bạn tỏa s&aacute;ng v&agrave; tự tin mỗi ng&agrave;y.</p>', '<p style=\"text-align:justify\">Kh&aacute;m ph&aacute; thế giới mỹ phẩm cao cấp với những sản phẩm chăm s&oacute;c sắc đẹp chất lượng h&agrave;ng đầu, gi&uacute;p bạn tỏa s&aacute;ng v&agrave; tự tin mỗi ng&agrave;y.</p>', 'anh19.jpg', '2024-12-31 11:47:36', '2024-12-31 04:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `order_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_id` int UNSIGNED NOT NULL,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_destroy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` bigint UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_feeship` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_coupon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sales_quantity` int NOT NULL,
  `product_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int NOT NULL,
  `post_title` tinytext NOT NULL,
  `post_views` varchar(50) DEFAULT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_desc` text NOT NULL,
  `post_meta_desc` text NOT NULL,
  `post_meta_keywords` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `cate_post_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_title`, `post_views`, `post_slug`, `post_content`, `post_desc`, `post_meta_desc`, `post_meta_keywords`, `post_image`, `cate_post_id`, `created_at`, `updated_at`, `post_status`) VALUES
(26, '10 Bí Quyết Chọn Serum Dưỡng Da Phù Hợp', NULL, '10-bi-quyet-chon-serum-duong-da-phu-hop', '<p>Ng&agrave;y nay, serum đ&atilde; trở th&agrave;nh một trong những sản phẩm kh&ocirc;ng thể thiếu trong quy tr&igrave;nh chăm s&oacute;c da của ph&aacute;i đẹp. Tuy nhi&ecirc;n, kh&ocirc;ng phải ai cũng biết c&aacute;ch lựa chọn serum ph&ugrave; hợp với l&agrave;n da của m&igrave;nh.</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>X&aacute;c định loại da của bạn</strong></p>\r\n\r\n	<ul>\r\n		<li>Da dầu: Chọn serum chứa BHA hoặc niacinamide để kiểm so&aacute;t dầu nhờn.</li>\r\n		<li>Da kh&ocirc;: Ưu ti&ecirc;n serum chứa axit hyaluronic hoặc glycerin gi&uacute;p dưỡng ẩm s&acirc;u.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Đọc kỹ bảng th&agrave;nh phần</strong></p>\r\n\r\n	<ul>\r\n		<li>Tr&aacute;nh c&aacute;c th&agrave;nh phần dễ g&acirc;y k&iacute;ch ứng như cồn hoặc hương liệu đối với da nhạy cảm.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Quan t&acirc;m đến vấn đề da đang gặp phải</strong></p>\r\n\r\n	<ul>\r\n		<li>Nếu bạn đang cần l&agrave;m s&aacute;ng da, h&atilde;y chọn serum chứa vitamin C.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Độ uy t&iacute;n của thương hiệu</strong></p>\r\n\r\n	<ul>\r\n		<li>Lựa chọn những thương hiệu c&oacute; cam kết về an to&agrave;n v&agrave; chất lượng.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>Đừng qu&ecirc;n bảo quản serum đ&uacute;ng c&aacute;ch v&agrave; thực hiện đầy đủ c&aacute;c bước chăm s&oacute;c da để đạt hiệu quả tối ưu nh&eacute;!</p>', '<p>B&agrave;i viết hướng dẫn chi tiết c&aacute;ch chọn serum dưỡng da ph&ugrave; hợp với từng loại da, gi&uacute;p bạn đạt hiệu quả tối ưu trong qu&aacute; tr&igrave;nh chăm s&oacute;c da mặt.</p>', 'Tìm hiểu cách chọn serum dưỡng da phù hợp nhất với loại da của bạn, với các bí quyết và hướng dẫn chi tiết từ chuyên gia.', 'serum dưỡng da, cách chọn serum, mỹ phẩm chăm sóc da, bí quyết làm đẹp, dưỡng da hiệu quả', 'anh198.jpg', 9, '2024-12-31 04:53:12', '2024-12-31 04:53:12', 0),
(27, '7 Sản Phẩm Kem Dưỡng Chống Lão Hóa Tốt Nhất Hiện Nay', '1', '7-san-pham-kem-duong-chong-lao-hoa-tot-nhat-hien-nay', '<p>L&atilde;o h&oacute;a l&agrave; qu&aacute; tr&igrave;nh tự nhi&ecirc;n m&agrave; ai cũng phải trải qua. Tuy nhi&ecirc;n, bạn c&oacute; thể l&agrave;m chậm qu&aacute; tr&igrave;nh n&agrave;y bằng c&aacute;ch sử dụng kem dưỡng da chống l&atilde;o h&oacute;a ph&ugrave; hợp. Dưới đ&acirc;y l&agrave; 7 sản phẩm được ưa chuộng:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Kem chống l&atilde;o h&oacute;a Ohui Prime Advancer</strong></p>\r\n\r\n	<ul>\r\n		<li>Th&agrave;nh phần: Tinh chất hoa sen tuyết.</li>\r\n		<li>C&ocirc;ng dụng: Tăng cường t&aacute;i tạo da, giảm nếp nhăn hiệu quả.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>L&#39;Or&eacute;al Revitalift Night Cream</strong></p>\r\n\r\n	<ul>\r\n		<li>Th&agrave;nh phần: Retinol v&agrave; vitamin E.</li>\r\n		<li>C&ocirc;ng dụng: L&agrave;m săn chắc da v&agrave; phục hồi l&agrave;n da khi ngủ.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Estee Lauder Advanced Night Repair</strong></p>\r\n\r\n	<ul>\r\n		<li>Th&agrave;nh phần: Hyaluronic acid, peptide.</li>\r\n		<li>C&ocirc;ng dụng: Cải thiện độ đ&agrave;n hồi v&agrave; t&aacute;i tạo tế b&agrave;o da.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Shiseido Benefiance Wrinkle Smoothing Cream</strong></p>\r\n\r\n	<ul>\r\n		<li>Th&agrave;nh phần: Collagen, chiết xuất tảo biển.</li>\r\n		<li>C&ocirc;ng dụng: L&agrave;m mờ nếp nhăn v&agrave; cải thiện độ mịn m&agrave;ng của da.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>H&atilde;y chọn sản phẩm ph&ugrave; hợp nhất với nhu cầu của bạn v&agrave; đừng qu&ecirc;n sử dụng đ&uacute;ng c&aacute;ch để đạt hiệu quả tối ưu nh&eacute;!</p>', '<p>B&agrave;i viết tổng hợp 7 loại kem dưỡng chống l&atilde;o h&oacute;a nổi bật, được c&aacute;c chuy&ecirc;n gia đ&aacute;nh gi&aacute; cao về chất lượng v&agrave; hiệu quả.</p>', 'Tìm hiểu 7 loại kem chống lão hóa da được yêu thích nhất hiện nay, với hướng dẫn chọn sản phẩm phù hợp và cách sử dụng hiệu quả.', 'kem chống lão hóa, chống lão hóa da, sản phẩm làm đẹp da, bí quyết trẻ hóa da, mỹ phẩm chống lão hóa', 'df46b58ab41a12444b0b_d412903cbf0549a1b1e196d64bb98583_1024x102467.jpg', 8, '2024-12-31 11:54:39', '2024-12-31 04:54:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `product_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(10,0) NOT NULL,
  `gia_km` int DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` int NOT NULL,
  `soluong` int NOT NULL,
  `product_sold` int DEFAULT NULL,
  `pro_rating_number` int DEFAULT NULL,
  `pro_rating` int DEFAULT NULL,
  `product_view` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_cost` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `category_id`, `product_desc`, `product_price`, `gia_km`, `product_image`, `product_status`, `soluong`, `product_sold`, `pro_rating_number`, `pro_rating`, `product_view`, `created_at`, `updated_at`, `price_cost`) VALUES
(236, 'Tinh Chất Cân Bằng Hệ Vi Sinh Ohui The First Geniture Sym-Micro Essence 50ml', 4, '<h3><strong>Tinh Chất Si&ecirc;u Vi Chống L&atilde;o H&oacute;a Ohui The First Geniture Sym-Micro Essence</strong><br />\r\nGi&uacute;p ngăn ngừa l&atilde;o h&oacute;a, chăm s&oacute;c to&agrave;n diện v&agrave; duy tr&igrave; trạng th&aacute;i c&acirc;n bằng Hệ vi sinh da, tăng cường đề kh&aacute;ng.</h3>\r\n\r\n<h3><strong>Th&agrave;nh Phần</strong></h3>\r\n\r\n<p>- Signature 29 Cell &trade;: Đ&aacute;nh thức tế b&agrave;o gốc im lặng v&agrave; tăng số lượng l&ecirc;n gấp 1.3 lần, đồng thời gia tăng P63 marker (chỉ c&oacute; trong tế b&agrave;o gốc khỏe mạnh)<br />\r\n- Nước chiết xuất hoa mẫu đơn: tăng hoạt t&iacute;nh tế b&agrave;o gốc, l&agrave;m dịu, dưỡng ẩm<br />\r\n- Gen-Biotics&trade; (3 Pro-biotics &amp; 4 Pre-biotics): Cải thiện sức khỏe hệ vi sinh da, tăng cường đề kh&aacute;ng da, tăng 17 lần hoạt t&iacute;nh của tế b&agrave;o gốc</p>\r\n\r\n<h3><strong>C&ocirc;ng Dụng</strong></h3>\r\n\r\n<p>- Ngăn ngừa l&atilde;o h&oacute;a&nbsp;<br />\r\n- Dưỡng ẩm, dưỡng s&aacute;ng da<br />\r\n- Tăng cường đề kh&aacute;ng da<br />\r\n- Bảo về da khỏi c&aacute;c t&aacute;c nh&acirc;n c&oacute; hại từ m&ocirc;i trường</p>\r\n\r\n<h3><strong>Hướng Dẫn Sử Dụng</strong></h3>\r\n\r\n<p>&nbsp;D&ugrave;ng sau bước ampoule hoặc serum, &nbsp;lấy 1 lượng sản phẩm vừa đủ, d&agrave;n trải đều theo cấu tr&uacute;c da v&agrave; thoa nhẹ nh&agrave;ng bằng cả 2 tay để sản phẩm thẩm thấu s&acirc;u v&agrave;o trong da.</p>', 1900000, 200000, '1735637811.webp', 1, 100, NULL, NULL, NULL, 11, '2024-12-31 02:36:51', '2024-12-31 05:10:26', '1700000'),
(237, 'Bộ 3 Sản phẩm dưỡng da body Beyond Travel Kit', 4, '<p><strong>Bộ sản phẩm gồm:</strong></p>\r\n\r\n<ol>\r\n	<li>Sữa dưỡng thể dưỡng ẩm s&acirc;u 60ml</li>\r\n	<li>Sữa tắm Deep Moisture Body Wash 60ml</li>\r\n	<li>Dầu gội Professional Defense 60ml</li>\r\n</ol>\r\n\r\n<p><strong>1.Sữa dưỡng thể dưỡng ẩm s&acirc;u:</strong></p>\r\n\r\n<p>Sữa dưỡng thể gi&uacute;p cung cấp độ ẩm cho da, bảo vệ da khỏi c&aacute;c k&iacute;ch ứng b&ecirc;n ngo&agrave;i.</p>\r\n\r\n<p>Chứa phức hợp Skin-Mimic Ceramide Complex v&agrave; Natural Oil Complex.</p>\r\n\r\n<p>Điều đ&oacute; gi&uacute;p bổ sung độ ẩm cho da, củng cố h&agrave;ng r&agrave;o bảo vệ da v&agrave; bảo vệ da khỏi c&aacute;c t&aacute;c nh&acirc;n &ocirc; nhiễm b&ecirc;n ngo&agrave;i.</p>\r\n\r\n<p>C&oacute; một m&ugrave;i hương bột xạ hương.</p>\r\n\r\n<p><strong>2.Sữa tắm dưỡng ẩm s&acirc;u:</strong></p>\r\n\r\n<p>Sữa tắm gi&uacute;p loại bỏ bụi bẩn, tạp chất tr&ecirc;n da, cung cấp độ ẩm cho da.</p>\r\n\r\n<p>Chứa phức hợp Skin-Mimic Ceramide Complex v&agrave; Natural Oil Complex.</p>\r\n\r\n<p>Điều đ&oacute; gi&uacute;p bổ sung độ ẩm cho da, củng cố h&agrave;ng r&agrave;o bảo vệ da v&agrave; bảo vệ da khỏi c&aacute;c t&aacute;c nh&acirc;n &ocirc; nhiễm b&ecirc;n ngo&agrave;i.</p>\r\n\r\n<p>C&oacute; một m&ugrave;i hương bột xạ hương.</p>\r\n\r\n<p><strong>3.Dầu gội ph&ograve;ng vệ chuy&ecirc;n nghiệp:</strong></p>\r\n\r\n<p>L&agrave; loại dầu gội đầu h&agrave;ng ng&agrave;y gi&uacute;p loại bỏ bụi bẩn v&agrave; dưỡng ẩm cho da đầu.</p>\r\n\r\n<p>Chứa th&agrave;nh phần được cấp bằng s&aacute;ng chế, Eco Farming Complex, gi&uacute;p l&agrave;m dịu v&agrave; dưỡng ẩm da đầu.</p>\r\n\r\n<p>C&oacute; m&ugrave;i hương quả mọng tươi m&aacute;t.</p>\r\n\r\n<p><strong>C&aacute;ch sử dụng:</strong></p>\r\n\r\n<p>Sử dụng theo tr&igrave;nh tự Dầu gội, Sữa tắm v&agrave; Sữa dưỡng thể.</p>', 400000, 210000, '1735641276.webp', 1, 300, NULL, NULL, NULL, 9, '2024-12-31 03:34:37', '2024-12-31 03:51:50', '190000'),
(238, 'Bộ Dầu Gội và Dầu Xả Giảm Gàu Và Gãy Rụng Beyond Healing Force Hair Set 800ml', 4, '<p><strong>Bộ sản phẩm bao gồm:</strong></p>\r\n\r\n<p><strong>Dạng fullsize</strong></p>\r\n\r\n<p>Dầu gội dạng gel Beyond Healing Force Scalp Clinic Shampoo 500ml</p>\r\n\r\n<p>Dầu xả l&agrave;m mềm mượt Beyond Healing Force Scalp Clinic Treatment 300ml</p>\r\n\r\n<p><strong>Dạng Mini d&ugrave;ng thử</strong></p>\r\n\r\n<p>Dầu gội dạng gel Beyond Healing Force Scalp Clinic Shampoo 100ml</p>\r\n\r\n<p>Dầu xả l&agrave;m mềm mượt Beyond Healing Force Scalp Clinic Treatment 100ml</p>\r\n\r\n<p><strong>TH&Ocirc;NG TIN SẢN PHẨM</strong></p>\r\n\r\n<h4><strong>1. Đặc điểm nổi bật</strong></h4>\r\n\r\n<p>&ndash; Th&agrave;nh phần thuần chay chống rụng t&oacute;c v&agrave; l&agrave;m sạch g&agrave;u</p>\r\n\r\n<p>&ndash; Kh&ocirc;ng chứa 20 th&agrave;nh phần c&oacute; hại</p>\r\n\r\n<p>&ndash; Ho&agrave;n th&agrave;nh thử nghiệm da liễu</p>\r\n\r\n<p>&ndash; Hương thơm thanh m&aacute;t</p>\r\n\r\n<p>&ndash; An to&agrave;n với v&ugrave;ng da mắt (HET-CAM)</p>\r\n\r\n<h4><strong>2. Th&agrave;nh phần ch&iacute;nh</strong></h4>\r\n\r\n<p>&ndash; Vegan Biotin: Th&agrave;nh phần thuần chay ng,ăn rụng t&oacute;c hiệu qu,ả, k&iacute;ch th&iacute;ch mọc t&oacute;c, phục hồi hang r&agrave;o bảo vệ da</p>\r\n\r\n<p>&ndash; Phức hợp l&agrave;m dịu Black Green: Chứa phức hợp Blackfood ( c&aacute;c loại đậu m&agrave;u đen) v&agrave; l&aacute; ngải cứu gi&uacute;p loại bỏ g&agrave;u, giảm ngứa da đầu</p>\r\n\r\n<p>&ndash; BHA, NIACINAMIDE, PANTHENOL: Loại bỏ g&agrave;u v&agrave; k&iacute;ch th&iacute;ch mọc t&oacute;c</p>\r\n\r\n<h4><strong>3. Hướng dẫn sử dụng</strong></h4>\r\n\r\n<p>&ndash; Sau khi gội đầu, lấy một lượng vừa đủ ra tay</p>\r\n\r\n<p>&ndash; Massage l&ecirc;n t&oacute;c v&agrave; da đầu</p>\r\n\r\n<p>&ndash; Xả sạch lại bằng nước</p>\r\n\r\n<h4><strong>4. Cảm nhận sử dụng</strong></h4>\r\n\r\n<p><strong>Dầu gội</strong></p>\r\n\r\n<p>&ndash; Dạng gel m&agrave;u n&acirc;u, tạo bọt mịn, kh&ocirc;ng kh&ocirc; t&oacute;c</p>\r\n\r\n<p>&ndash; Giảm rụng t&oacute;c, l&agrave;m sạch g&agrave;u v&agrave; da đầu</p>\r\n\r\n<p>&ndash; L&agrave;m dịu da đầu k&iacute;ch ứng</p>\r\n\r\n<p><strong>Dầu xả</strong></p>\r\n\r\n<p>&ndash; Dạng kem m&agrave;u n&acirc;u sữa</p>\r\n\r\n<p>&ndash; T&oacute;c mượt, giảm rụng</p>\r\n\r\n<p>&ndash; L&agrave;m dịu da đầu k&iacute;ch ứng</p>', 760000, 270000, '1735642571.webp', 1, 100, NULL, NULL, NULL, 3, '2024-12-31 03:56:11', '2024-12-31 04:06:13', '490000'),
(239, 'Miếng Dán Mụn CNP Laboratory Anti-Blemish Spot Patch (60 Miếng)', 10, '<h3><strong>Th&agrave;nh Phần</strong></h3>\r\n\r\n<p>Propylene Glycol, Water, Alcohol Denat., Butylene Glycol, Vitis Vinifera (Grape) Seed Extract, Melaleuca Alternifolia (Tea Tree) Leaf Oil, Polysorbate 80, Sodium Hyaluronate, Phytosphingosine, Allantoin, Salicylic Acid, Methylparaben.</p>\r\n\r\n<h3><strong>C&ocirc;ng Dụng</strong></h3>\r\n\r\n<p>C&oacute; t&aacute;c dụng điều trị mụn chuy&ecirc;n s&acirc;u.</p>\r\n\r\n<p>L&agrave;m dịu da, giảm k&iacute;ch ứng gi&uacute;p da khỏe mạnh.</p>\r\n\r\n<p>Thiết kế h&igrave;nh tr&ograve;n vừa với nốt mụn gi&uacute;p ngăn chặn kh&oacute;i bụi, &ocirc; nhiễm, cho ph&eacute;p da thở. Đồng thời cung cấp dưỡng chất điều trị mụn.&nbsp;</p>\r\n\r\n<p>Miếng d&aacute;n trong suốt, b&aacute;m chặt tr&ecirc;n da, kh&ocirc;ng tr&ocirc;i khi tiếp x&uacute;c với nước hoặc trang điểm.</p>\r\n\r\n<h3><strong>Hướng Dẫn Sử Dụng</strong></h3>\r\n\r\n<p>&nbsp;L&agrave;m sạch da mặt với sữa rửa mặt, đặc biệt l&agrave; những v&ugrave;ng dễ bị mụn trứng c&aacute;.- Nhẹ nh&agrave;ng gỡ miếng d&aacute;n ra khỏi m&agrave;ng nhựa v&agrave; đặt l&ecirc;n nốt mụn (Đảm bảo da kh&ocirc; tho&aacute;ng trước khi sử dụng miếng d&aacute;n mụn).- Để trong khoảng từ 8-12 tiếng, sử dụng khi đang ngủ sẽ cho kết quả tốt hơn- Để đạt được hiệu quả cao hơn, h&atilde;y kết hợp sử dụng Gel mụn giảm k&iacute;ch ứng CNP Anti-Blemish Spot Solution trước khi sử dụng Miếng d&aacute;n mụn Anti-blemish Spot Patch.</p>', 340000, 76000, '1735643518.webp', 1, 100, NULL, NULL, NULL, 1, '2024-12-31 04:11:58', '2024-12-31 04:16:29', '264000'),
(240, 'Bộ Kem Dưỡng Ẩm Ohui Miracle Moisture Ceramide Boosting Cream 60ml Special Set', 4, '<h3><strong>Bộ Kem Dưỡng Ẩm Ohui Miracle Moisture Ceramide Boosting Cream 60ml Special Set</strong></h3>\r\n\r\n<h3>&ndash; Kh&ocirc;ng những mang lại m&ugrave;i hương tươi m&aacute;t, nhẹ nh&agrave;ng, tinh khiết của mẫu đơn. M&agrave; c&ograve;n bổ sung ẩm cho l&agrave;n da, mang lại l&agrave;n da đầy sinh kh&iacute; &ldquo;như b&ocirc;ng hoa được tưới nước&rdquo;. Cảm gi&aacute;c kh&ocirc; r&aacute;t, mệt mỏi, &aacute;p lực được xua tan nhanh ch&oacute;ng.<br />\r\n&ndash; Kết cấu kem cho cảm gi&aacute;c mềm mại d&agrave;i l&acirc;u. Khả năng hấp thụ mạnh mẽ d&ugrave; thời gian tr&ocirc;i qua l&acirc;u nhưng l&agrave;n da vẫn ẩm mượt.<br />\r\n&ndash; Chứa nhiều dưỡng chất v&agrave; độ ẩm dồi d&agrave;o gi&uacute;p da trẻ trung, tăng cường đ&agrave;n hồi, s&aacute;ng v&agrave; rạng rỡ.<br />\r\n&ndash; Với c&aacute;c th&agrave;nh phần thi&ecirc;n nhi&ecirc;n, sản phẩm th&acirc;n thiện với mọi l&agrave;n da. Đặc biệt với cả những l&agrave;n da nhạy cảm, dễ mẫn cảm, mẫn ngứa với mỹ phẩm.<br />\r\n&ndash; Kem dưỡng kh&aacute; l&agrave; đậm đặc. Nhưng kh&ocirc;ng v&igrave; thế m&agrave; tạo sự kh&oacute; chịu. Tr&aacute;i lại kem thẩm thấu nhanh, m&aacute;t mịn v&agrave; kh&ocirc;ng g&acirc;y b&oacute;ng hay nhờn.</h3>\r\n\r\n<h2><strong><strong><strong>Bộ set bao gồm:</strong></strong></strong></h2>\r\n\r\n<p>Kem Dưỡng Ẩm Ohui Miracle Moisture Cream 60ml + 25 ml</p>\r\n\r\n<p>Sữa rửa mặt Ohui dưỡng ẩm 40ml</p>\r\n\r\n<p>Hoa hồng dưỡng ẩm 20ml</p>\r\n\r\n<p>Sữa dưỡng dưỡng ẩm 20ml</p>\r\n\r\n<p>Tinh chất dưỡng ẩm 3ml</p>', 1900000, 100000, '1735646747.webp', 1, 30, NULL, NULL, NULL, NULL, '2024-12-31 05:05:47', '2024-12-31 05:05:47', '1800000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id_roles` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_roles`, `name`) VALUES
(4, 'admin'),
(5, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int UNSIGNED NOT NULL,
  `shipping_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_method` int NOT NULL,
  `shipping_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shipping_address2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int NOT NULL,
  `slider_name` varchar(100) DEFAULT NULL,
  `slider_status` int DEFAULT NULL,
  `slider_desc` varchar(100) DEFAULT NULL,
  `slider_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_name`, `slider_status`, `slider_desc`, `slider_image`) VALUES
(19, 'Slide1', 0, '<p>Slide1</p>', 'slider_169.webp'),
(20, 'Slide2', 0, '<p>Slide2</p>', 'slider_366.jpg'),
(21, 'Slide3', 0, '<p>Slide3</p>', 'slider_253.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE `tbl_social` (
  `user_id` int NOT NULL,
  `provider_user_id` varchar(100) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `user` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statistical`
--

CREATE TABLE `tbl_statistical` (
  `id_statistical` int NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `sales` varchar(200) NOT NULL,
  `profit` varchar(200) NOT NULL,
  `quantity` int NOT NULL,
  `total_order` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_statistical`
--

INSERT INTO `tbl_statistical` (`id_statistical`, `order_date`, `sales`, `profit`, `quantity`, `total_order`, `created_at`, `updated_at`) VALUES
(114, '2024-12-31', '105000', '15000', 3, 1, '2024-12-31 02:04:19', '2024-12-31 02:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitors`
--

CREATE TABLE `tbl_visitors` (
  `id_visitors` int NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date_visitor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_visitors`
--

INSERT INTO `tbl_visitors` (`id_visitors`, `ip_address`, `date_visitor`) VALUES
(28, '127.0.0.1', '2024-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id_admin_roles`),
  ADD KEY `admin_admin_id` (`admin_admin_id`,`roles_id_roles`),
  ADD KEY `roles_id_roles` (`roles_id_roles`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attr_id` (`attr_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_addvertised`
--
ALTER TABLE `tbl_addvertised`
  ADD PRIMARY KEY (`quangcao_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category_post`
--
ALTER TABLE `tbl_category_post`
  ADD PRIMARY KEY (`cate_post_id`);

--
-- Indexes for table `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_product_id` (`comment_product_id`);

--
-- Indexes for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_infomation`
--
ALTER TABLE `tbl_infomation`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `tbl_intro`
--
ALTER TABLE `tbl_intro`
  ADD PRIMARY KEY (`intro_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`,`shipping_id`),
  ADD KEY `shipping_id` (`shipping_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `cate_post_id` (`cate_post_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  ADD PRIMARY KEY (`id_statistical`);

--
-- Indexes for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  ADD PRIMARY KEY (`id_visitors`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id_admin_roles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `attr_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `tbl_addvertised`
--
ALTER TABLE `tbl_addvertised`
  MODIFY `quangcao_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_category_post`
--
ALTER TABLE `tbl_category_post`
  MODIFY `cate_post_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `coupon_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_infomation`
--
ALTER TABLE `tbl_infomation`
  MODIFY `info_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_intro`
--
ALTER TABLE `tbl_intro`
  MODIFY `intro_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_roles` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_social`
--
ALTER TABLE `tbl_social`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_statistical`
--
ALTER TABLE `tbl_statistical`
  MODIFY `id_statistical` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  MODIFY `id_visitors` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD CONSTRAINT `admin_roles_ibfk_1` FOREIGN KEY (`admin_admin_id`) REFERENCES `tbl_admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_roles_ibfk_2` FOREIGN KEY (`roles_id_roles`) REFERENCES `tbl_roles` (`id_roles`);

--
-- Constraints for table `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `attribute_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attribute_ibfk_2` FOREIGN KEY (`attr_id`) REFERENCES `product_attribute` (`attr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`comment_product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `tbl_shipping` (`shipping_id`);

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD CONSTRAINT `tbl_post_ibfk_1` FOREIGN KEY (`cate_post_id`) REFERENCES `tbl_category_post` (`cate_post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category_product` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD CONSTRAINT `tbl_rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD CONSTRAINT `tbl_social_ibfk_1` FOREIGN KEY (`user`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
