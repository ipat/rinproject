-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2014 at 04:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rinproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$GX7hMhUBzx2Z9YcOliK/DOnjt2gba7WcLEY8PPDWoV3ZCH4bQqjJe', 'ร้านริน', 'ขนมหวาน', '2014-06-15 07:31:29', '2014-06-17 08:38:35', 'uCC9GSfmYiwM9LkE52WNSEzfh4zbnRJuLTOKcxksmdEEsFXTymv97lt57ZLF');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_name`) VALUES
(0, 'ธนาคารธนชาติ'),
(1, 'ธนาคารไทยพาณิชย์'),
(2, 'ธนาคารกสิกรไทย'),
(3, 'ธนาคารกรุงเทพ'),
(4, 'ธนาคารกรุงไทย'),
(5, 'ธนาคารเพื่อการเกษตรและสหกรณ์');

-- --------------------------------------------------------

--
-- Table structure for table `bank-account`
--

CREATE TABLE IF NOT EXISTS `bank-account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `bank_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bank-account`
--

INSERT INTO `bank-account` (`id`, `bank_name`, `bank_id`) VALUES
(1, 'ธนาคารไทยสงเคราะห์', '111-11-111111-1'),
(2, 'ธนาคารสยามกัมมาจลน์', '212-224236-248');

-- --------------------------------------------------------

--
-- Table structure for table `confirm-transfer`
--

CREATE TABLE IF NOT EXISTS `confirm-transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `sent_from` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `amount` float NOT NULL,
  `picture_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `submitted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `confirm-transfer`
--

INSERT INTO `confirm-transfer` (`id`, `order_id`, `sent_from`, `sent_to`, `amount`, `picture_url`, `date`, `time`, `submitted_time`) VALUES
(1, 1, 2, 1, 230.1, '', '2014-07-18', '11:11:00', '2014-07-04 11:12:02'),
(2, 10, 0, 1, 62, 'http://localhost/rinproject/public/upload/transfer/RIN6915.jpg', '2014-07-03', '13:21:00', '2014-07-04 11:12:59'),
(3, 6, 0, 1, 190, 'http://localhost/rinproject/public/upload/transfer/RIN8285.jpg', '2014-07-18', '12:12:00', '2014-07-05 14:24:50'),
(4, 12, 0, 1, 3, 'http://localhost/rinproject/public/upload/transfer/RIN9239.jpg', '2014-07-19', '11:11:00', '2014-07-05 14:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `dessert`
--

CREATE TABLE IF NOT EXISTS `dessert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dessert`
--

INSERT INTO `dessert` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(1, 'ฝอยทอง', 'หวานอร่อย สุดๆอะ', 30, 'http://localhost/rinproject/public/upload/images/1.jpg'),
(2, 'ข้าวมันไก่', 'ของหวานถูกใจ ใช่หรอ?', 40, 'http://localhost/rinproject/public/upload/images/2.jpg'),
(3, 'ขนมชั้น', 'ขนมอร่อย หลากสีหลายสไตล์ เหมาะกะวัยว่้าวุ่มมากอะ', 30, 'http://localhost/rinproject/public/upload/images/3.jpg'),
(4, 'ขนมกล้วย', 'ทำเองอร่อยมาก', 10, 'http://localhost/rinproject/public/upload/images/4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_06_15_142611_create_admin_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสการสั่งสินค้า',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้สั่ง',
  `address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่ผู้สั่ง',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรผู้สั่ง',
  `order` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายการที่สั่งเป็น JSON',
  `total_price` int(11) NOT NULL COMMENT 'ราคารวม',
  `seen` tinyint(1) NOT NULL COMMENT 'เห็นแล้วหรือไม่',
  `transfer` tinyint(1) NOT NULL COMMENT 'แจ้งโอนเงินกลับมาแล้วหรือไม่',
  `confirm` tinyint(1) NOT NULL COMMENT 'ยืนยันการส่งสินค้าแล้วหรือไม่',
  `submitted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `name`, `address`, `phone`, `order`, `total_price`, `seen`, `transfer`, `confirm`, `submitted_time`) VALUES
(1, 'RIN1642', 'asdf', 'dfdasafas', '081-1111111', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":4},{"id":3,"name":"\\u0e02\\u0e19\\u0e21\\u0e0a\\u0e31\\u0e49\\u0e19","description":"\\u0e02\\u0e19\\u0e21\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2b\\u0e25\\u0e32\\u0e01\\u0e2a\\u0e35\\u0e2b\\u0e25\\u0e32\\u0e22\\u0e2a\\u0e44\\u0e15\\u0e25\\u0e4c \\u0e40\\u0e2b\\u0e21\\u0e32\\u0e30\\u0e01\\u0e30\\u0e27\\u0e31\\u0e22\\u0e27\\u0e48\\u0e49\\u0e32\\u0e27\\u0e38\\u0e48\\u0e21\\u0e21\\u0e32\\u0e01\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/3.jpg","amount":2},{"id":4,"name":"\\u0e02\\u0e19\\u0e21\\u0e01\\u0e25\\u0e49\\u0e27\\u0e22","description":"\\u0e17\\u0e33\\u0e40\\u0e2d\\u0e07\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01","price":10,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/4.jpg","amount":5}]', 230, 0, 1, 0, '2014-07-04 10:53:35'),
(5, 'RIN3703', 'นางไก่กา อาราเล่', 'บ้านเดอกเตอร์สลัม', '080-0000000', '[{"id":4,"name":"\\u0e02\\u0e19\\u0e21\\u0e01\\u0e25\\u0e49\\u0e27\\u0e22","description":"\\u0e17\\u0e33\\u0e40\\u0e2d\\u0e07\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01","price":10,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/4.jpg","amount":4}]', 40, 0, 0, 0, '2014-07-04 10:53:35'),
(6, 'RIN8285', 'นายทอง ดีออก', 'บ้านดีออก', '012-3456789', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":5}]', 150, 0, 1, 0, '2014-07-04 10:53:35'),
(7, 'RIN5180', 'นายฝอยทอง ขนมชั้น', 'ทุกที่', '080-0000000', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":2},{"id":3,"name":"\\u0e02\\u0e19\\u0e21\\u0e0a\\u0e31\\u0e49\\u0e19","description":"\\u0e02\\u0e19\\u0e21\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2b\\u0e25\\u0e32\\u0e01\\u0e2a\\u0e35\\u0e2b\\u0e25\\u0e32\\u0e22\\u0e2a\\u0e44\\u0e15\\u0e25\\u0e4c \\u0e40\\u0e2b\\u0e21\\u0e32\\u0e30\\u0e01\\u0e30\\u0e27\\u0e31\\u0e22\\u0e27\\u0e48\\u0e49\\u0e32\\u0e27\\u0e38\\u0e48\\u0e21\\u0e21\\u0e32\\u0e01\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/3.jpg","amount":2}]', 120, 0, 0, 0, '2014-07-04 10:53:35'),
(8, 'RIN1342', 'ฝอยทอง', 'aaaaaaaaaaaaa', '080-0000000', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":5},{"id":4,"name":"\\u0e02\\u0e19\\u0e21\\u0e01\\u0e25\\u0e49\\u0e27\\u0e22","description":"\\u0e17\\u0e33\\u0e40\\u0e2d\\u0e07\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01","price":10,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/4.jpg","amount":2}]', 170, 0, 0, 0, '2014-07-04 10:53:35'),
(9, 'RIN5683', 'จริงดี อร่อยหวะ', 'อร่อยนะ', '080-0000000', '[{"id":4,"name":"\\u0e02\\u0e19\\u0e21\\u0e01\\u0e25\\u0e49\\u0e27\\u0e22","description":"\\u0e17\\u0e33\\u0e40\\u0e2d\\u0e07\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01","price":10,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/4.jpg","amount":2},{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":6}]', 200, 0, 0, 0, '2014-07-04 10:53:35'),
(10, 'RIN6915', 'กรุงเทพ มหานคร', 'อมรรัตนโกสินทร์', '012-3456789', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":2}]', 60, 0, 1, 0, '2014-07-04 10:53:35'),
(11, 'RIN3676', 'นางสาวโดเรมี โอโห', '123 บ้านแมว หนูมา', '012-3456789', '[{"id":2,"name":"\\u0e02\\u0e49\\u0e32\\u0e27\\u0e21\\u0e31\\u0e19\\u0e44\\u0e01\\u0e48","description":"\\u0e02\\u0e2d\\u0e07\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e16\\u0e39\\u0e01\\u0e43\\u0e08 \\u0e43\\u0e0a\\u0e48\\u0e2b\\u0e23\\u0e2d?","price":40,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/2.jpg","amount":2},{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":2},{"id":4,"name":"\\u0e02\\u0e19\\u0e21\\u0e01\\u0e25\\u0e49\\u0e27\\u0e22","description":"\\u0e17\\u0e33\\u0e40\\u0e2d\\u0e07\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22\\u0e21\\u0e32\\u0e01","price":10,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/4.jpg","amount":4}]', 180, 0, 0, 0, '2014-07-05 14:27:49'),
(12, 'RIN9239', 'ฝอยทอง', '1111', '012-3456789', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":2}]', 60, 0, 1, 0, '2014-07-05 14:30:21'),
(13, 'RIN2144', 'asd', 'ๅๅๅๅๅ', '081-1111111', '[{"id":1,"name":"\\u0e1d\\u0e2d\\u0e22\\u0e17\\u0e2d\\u0e07","description":"\\u0e2b\\u0e27\\u0e32\\u0e19\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2a\\u0e38\\u0e14\\u0e46\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/1.jpg","amount":2},{"id":3,"name":"\\u0e02\\u0e19\\u0e21\\u0e0a\\u0e31\\u0e49\\u0e19","description":"\\u0e02\\u0e19\\u0e21\\u0e2d\\u0e23\\u0e48\\u0e2d\\u0e22 \\u0e2b\\u0e25\\u0e32\\u0e01\\u0e2a\\u0e35\\u0e2b\\u0e25\\u0e32\\u0e22\\u0e2a\\u0e44\\u0e15\\u0e25\\u0e4c \\u0e40\\u0e2b\\u0e21\\u0e32\\u0e30\\u0e01\\u0e30\\u0e27\\u0e31\\u0e22\\u0e27\\u0e48\\u0e49\\u0e32\\u0e27\\u0e38\\u0e48\\u0e21\\u0e21\\u0e32\\u0e01\\u0e2d\\u0e30","price":30,"image_url":"http:\\/\\/localhost\\/rinproject\\/public\\/upload\\/images\\/3.jpg","amount":2}]', 120, 0, 0, 0, '2014-07-05 14:34:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
