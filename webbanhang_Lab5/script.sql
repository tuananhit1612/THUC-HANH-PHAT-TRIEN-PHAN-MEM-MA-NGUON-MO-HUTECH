-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.account: ~3 rows (approximately)
INSERT INTO `account` (`id`, `username`, `password`, `role`, `created_at`) VALUES
	(1, 'tta', '$2y$10$HKQafzNx37tTjekn/XTobeSa/DAlACjxkfwHc0b/dyc9.X4BoBQLm', 'user', '2025-03-18 01:52:41'),
	(2, 'admin', '$2y$10$UuFTF5ZOw7Qei94qGkkxqevlzhIFVysWtympKUUC6.3jm.qgqFW6a', 'admin', '2025-03-18 03:12:35'),
	(4, 'user', '$2y$10$.AJ6wR3iNaO3twKHGi73ROKM5q4htILH/32Rv4oxOVothzREF.GKa', 'user', '2025-03-25 03:19:49');

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~3 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Các loại điện thoại thông minh'),
	(2, 'Laptop', 'Các dòng máy tính xách tay'),
	(3, 'Phụ kiện', 'Phụ kiện điện tử như tai nghe, sạc, cáp');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Chờ xử lý','Đang giao','Hoàn thành','Đã hủy') DEFAULT 'Chờ xử lý',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~2 rows (approximately)
INSERT INTO `orders` (`id`, `account_id`, `name`, `phone`, `address`, `created_at`, `status`) VALUES
	(15, 1, 'tta', '123', '123', '2025-03-25 02:58:28', 'Hoàn thành'),
	(16, 4, 'Dat Ngu', '123', '123', '2025-03-25 03:24:53', 'Hoàn thành');

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~2 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(11, 15, 3, 2, 27990000.00),
	(12, 16, 3, 2, 27990000.00),
	(13, 16, 1, 1, 19990000.00);

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~5 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(1, 'iPhone 14', 'Điện thoại Apple iPhone 14, màn hình 6.1 inch        2   1     ', 19990000.00, 'uploads/iphone-14-plus-128gb-tim-quocte-phuckhangmobile-26958j.png', 1),
	(3, 'MacBook Air M22', '            Laptop Apple MacBook Air M2, RAM 8GB, SSD 256GB        ', 27990000.00, 'uploads/iphone-14-plus-128gb-tim-quocte-phuckhangmobile-26958j.png', 2),
	(4, 'Dell XPS 13', 'Laptop Dell XPS 13, Intel i7, RAM 16GB, SSD 512GB', 32990000.00, 'uploads/images (4).jpg', 2),
	(5, 'Tai nghe AirPods Pro', 'Tai nghe không dây chống ồn AirPods Pro', 5490000.00, 'uploads/images (5).jpg', 3),
	(6, 'Sạc nhanh 65W', 'Củ sạc nhanh 65W hỗ trợ nhiều thiết bị', 990000.00, 'uploads/z3749006978466_67e95a9cb49feb0030478005c44b0f82_e90ac1adcd0d4ecb81aca187085e0ed0 (1).png', 3);

-- Dumping structure for table my_store.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `account_id`, `name`, `phone`, `address`, `created_at`) VALUES
	(1, 1, 'tta', '123', '123', '2025-03-18 02:51:16'),
	(2, 4, 'Dat Ngu', '123', '123', '2025-03-25 03:24:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
