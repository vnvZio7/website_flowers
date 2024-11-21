-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 01:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Hoa Cưới'),
(2, 'Hoa Sinh Nhật'),
(3, 'Hoa Kỷ Niệm'),
(4, 'Hoa Tặng Bạn Bè'),
(5, 'Hoa Văn Phòng');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `flower_id`, `user_id`) VALUES
(1, 6, 2),
(4, 5, 2),
(6, 4, 2),
(8, 22, 2),
(9, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `flower_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`flower_id`, `name`, `description`, `price`, `discount`, `stock`, `image_url`, `category_id`) VALUES
(1, 'Hồng Đỏ', 'Hoa hồng đỏ tươi đẹp thường được sử dụng trong đám cưới.', 150000.00, 15, 50, 'link_to_image1.jpg', 1),
(2, 'Lily Trắng', 'Thể hiện sự thanh khiết và trong sáng.', 160000.00, 10, 30, 'link_to_image2.jpg', 1),
(3, 'Cẩm Chướng', 'Được yêu thích vì vẻ đẹp và độ bền.', 140000.00, 5, 25, 'link_to_image3.jpg', 1),
(4, 'Lan Hồ Điệp', 'Sang trọng và quý phái.', 180000.00, 0, 20, 'link_to_image4.jpg', 1),
(5, 'Tulip', 'Nhiều màu sắc tươi sáng, mang lại không khí vui tươi.', 120000.00, 10, 40, 'link_to_image5.jpg', 1),
(6, 'Baby\'s Breath', 'Thường đi kèm hoa chính để tạo sự nhẹ nhàng.', 90000.00, 5, 15, 'link_to_image6.jpg', 1),
(7, 'Hướng Dương', 'Mang lại niềm vui và năng lượng tích cực.', 110000.00, 5, 45, 'link_to_image7.jpg', 2),
(8, 'Cúc Vạn Thọ', 'Thể hiện sự trường thọ và hạnh phúc.', 100000.00, 5, 50, 'link_to_image8.jpg', 2),
(9, 'Đồng Tiền', 'Đầy màu sắc, thích hợp cho món quà sinh nhật.', 130000.00, 10, 35, 'link_to_image9.jpg', 2),
(10, 'Hồng Phấn', 'Dịu dàng và ngọt ngào, thể hiện tình cảm.', 160000.00, 10, 20, 'link_to_image10.jpg', 2),
(11, 'Cẩm Tú Cầu', 'Đa dạng màu sắc, thể hiện sự chân thành.', 150000.00, 5, 30, 'link_to_image11.jpg', 2),
(12, 'Nhài', 'Có hương thơm ngọt ngào, thích hợp cho dịp đặc biệt.', 140000.00, 5, 25, 'link_to_image12.jpg', 2),
(13, 'Mẫu Đơn', 'Mang ý nghĩa sự sang trọng và kỷ niệm đáng nhớ.', 250000.00, 10, 10, 'link_to_image13.jpg', 3),
(14, 'Thạch Thảo', 'Biểu tượng cho những kỷ niệm đẹp.', 120000.00, 5, 22, 'link_to_image14.jpg', 3),
(15, 'Lan', 'Thể hiện sự quý phái và tình cảm sâu sắc.', 200000.00, 10, 15, 'link_to_image15.jpg', 3),
(16, 'Hồng Trắng', 'Tượng trưng cho tình yêu vĩnh cửu.', 170000.00, 5, 14, 'link_to_image16.jpg', 3),
(17, 'Hồng Xanh', 'Hoa hồng xanh độc đáo, thể hiện tình yêu khác biệt.', 190000.00, 15, 9, 'link_to_image17.jpg', 3),
(18, 'Bách Hợp', 'Mang đến cảm xúc nhẹ nhàng và thanh thoát.', 180000.00, 10, 8, 'link_to_image18.jpg', 3),
(19, 'Cúc', 'Tươi vui và thân thiện, thích hợp cho bạn bè.', 80000.00, 5, 50, 'link_to_image19.jpg', 4),
(20, 'Hồng Vàng', 'Thể hiện tình bạn và sự quý mến.', 140000.00, 5, 30, 'link_to_image20.jpg', 4),
(21, 'Phong Lữ', 'Mang lại không khí dễ chịu, thích hợp để tặng.', 120000.00, 5, 35, 'link_to_image21.jpg', 4),
(22, 'Cát Tường', 'Tượng trưng cho sự tốt đẹp trong tình bạn.', 110000.00, 5, 28, 'link_to_image22.jpg', 4),
(23, 'Nhung Đỏ', 'Độc đáo và quyến rũ, thể hiện sự khác biệt.', 175000.00, 5, 11, 'link_to_image23.jpg', 4),
(24, 'Sen Trắng', 'Nhiều màu sắc, dễ dàng để lựa chọn.', 130000.00, 5, 22, 'link_to_image24.jpg', 4),
(25, 'Lan Địa', 'Sang trọng và dễ chăm sóc, thích hợp cho văn phòng.', 200000.00, 10, 5, 'link_to_image25.jpg', 5),
(26, 'Sen Hồng', 'Mang lại không khí tươi vui cho văn phòng.', 110000.00, 0, 15, 'link_to_image26.jpg', 5),
(27, 'Oải Hương', 'Dễ chăm sóc và trang trí văn phòng.', 90000.00, 0, 25, 'link_to_image27.jpg', 5),
(28, 'Orchid', 'Có hương thơm nhẹ nhàng, thích hợp cho không gian làm việc.', 140000.00, 5, 20, 'link_to_image28.jpg', 5),
(29, 'Iris', 'Mang lại vẻ đẹp thanh lịch cho văn phòng.', 130000.00, 0, 10, 'link_to_image29.jpg', 5),
(30, 'Đỗ Quyên', 'Thể hiện sự thanh lịch và trang nhã.', 160000.00, 0, 8, 'link_to_image30.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `phone_number`, `email`, `name`, `message`) VALUES
(1, '0387216391', 'ptx@gmail.com', 'Phạm Xuân Trường', 'Hoa rất đẹp');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `address`, `created_at`) VALUES
(26, 2, 410000.00, 'Ngõ 218 Đường Lĩnh Nam, Quận Hoàng Mai, TP.Hà Nội', '2024-11-21 11:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `flower_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `flower_id`, `quantity`, `price`) VALUES
(48, 26, 3, 2, 266000.00),
(49, 26, 2, 1, 144000.00);

-- --------------------------------------------------------

--
-- Table structure for table `spcart`
--

CREATE TABLE `spcart` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spcart`
--

INSERT INTO `spcart` (`id`, `flower_id`, `user_id`, `quantity`) VALUES
(10, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `phone_number`, `address`, `role`) VALUES
(1, 'Admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@gmail.com', '0987654321', 'Admin', 'admin'),
(2, 'Phạm Xuân Trường', '827ccb0eea8a706c4c34a16891f84e7b', 'ptx@gmail.com', '0387216391', 'Ngõ 218 Đường Lĩnh Nam, Quận Hoàng Mai, TP.Hà Nội', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`flower_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- Indexes for table `spcart`
--
ALTER TABLE `spcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `flowers`
--
ALTER TABLE `flowers`
  MODIFY `flower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `spcart`
--
ALTER TABLE `spcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`flower_id`);

--
-- Constraints for table `flowers`
--
ALTER TABLE `flowers`
  ADD CONSTRAINT `flowers_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`flower_id`);

--
-- Constraints for table `spcart`
--
ALTER TABLE `spcart`
  ADD CONSTRAINT `spcart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `spcart_ibfk_2` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`flower_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
