-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 01:38 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websitetintuc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `del_flag` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `del_flag`) VALUES
(1, 'Sự Kiện', 0),
(2, 'Ngôi Sao', 0),
(3, 'Thế Giới', 0),
(4, 'Thể Thao', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `post_id` int(10) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `del_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `del_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `title`, `content`, `image`, `createdate`, `del_flag`) VALUES
(40, 2, 'Chuyên gia phân tích tính minh bạch trong lùm xùm 13,7 tỷ của NS Hoài Linh trên sóng truyền hình: “Đó là sự không hiểu biết”', '<p>Theo lời chuy&ecirc;n gia c&oacute; thể l&yacute; do khiến NS Ho&agrave;i Linh vướng ồn &agrave;o như hiện tại l&agrave; do kh&ocirc;ng minh bạch trong 1 bước l&uacute;c bắt đầu k&ecirc;u gọi từ thiện cứu trợ miền Trung.</p>\r\n', 'hoailinh.jpg', '2021-06-02 02:13:18', 0),
(41, 1, 'Tết Thiếu nhi đặc biệt của ', '<p>B&eacute; trai g&acirc;y b&atilde;o MXH v&igrave; khoảnh khắc một m&igrave;nh tự ăn, tự chơi trong khu c&aacute;ch ly ng&agrave;y h&ocirc;m nay cũng đ&atilde; c&oacute; ng&agrave;y Quốc tế thiếu nhi hết sức đặc biệt</p>\r\n', 'boyandcachly.jpg', '2021-06-02 02:16:53', 0),
(42, 3, 'Tin tưởng gửi con gái ở trường nội trú, 1 năm sau cặp vợ chồng chết điếng nhìn thấy con như ', '<p>Khi được tới thăm con, cặp vợ chồng ho&agrave;n to&agrave;n bị sốc. Trước mắt họ l&agrave; đứa con g&aacute;i gầy g&ograve;, ốm yếu tr&ocirc;ng chẳng kh&aacute;c g&igrave; một &quot;x&aacute;c sống&quot; phải ngồi xe lăn.</p>\r\n', 'bikichtruongnoitru.jpg', '2021-06-02 02:21:58', 0),
(43, 4, 'Phân tích: Werner di chuyển thông minh, giúp Havertz ghi bàn mở tỉ số CK Champions League', '<p>Werner cho thấy gi&aacute; trị trong từng bước chạy ở b&agrave;n mở tỉ số của Chelsea.</p>\r\n', 'thethaobongda.jpg', '2021-06-02 02:26:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `permission` int(11) DEFAULT 0,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `del_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `permission`, `username`, `password`, `email`, `createdate`, `del_flag`) VALUES
(17, 0, 'b1812822', 'c3c4660901fa077a1633f3fd268e3be6', 'trinhb1812822@student.ctu.edu.vn', '2021-06-01 04:04:12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
