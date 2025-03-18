CREATE DATABASE my_store;
USE my_store;

CREATE TABLE category ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    description TEXT 
);

CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,       
    price DECIMAL(10, 2) NOT NULL,  
    image VARCHAR(255) DEFAULT NULL,      
    category_id INT,     
    FOREIGN KEY (category_id) REFERENCES category(id) 
);

-- Thêm dữ liệu vào bảng category
INSERT INTO category (name, description) VALUES
('Điện thoại', 'Các loại điện thoại thông minh'),
('Laptop', 'Các dòng máy tính xách tay'),
('Phụ kiện', 'Phụ kiện điện tử như tai nghe, sạc, cáp');

-- Thêm dữ liệu vào bảng product
INSERT INTO product (name, description, price, image, category_id) VALUES
('iPhone 14', 'Điện thoại Apple iPhone 14, màn hình 6.1 inch', 19990000, 'iphone14.jpg', 1),
('Samsung Galaxy S23', 'Điện thoại Samsung Galaxy S23, camera 50MP', 21990000, 'samsung_s23.jpg', 1),
('MacBook Air M2', 'Laptop Apple MacBook Air M2, RAM 8GB, SSD 256GB', 27990000, 'macbook_air_m2.jpg', 2),
('Dell XPS 13', 'Laptop Dell XPS 13, Intel i7, RAM 16GB, SSD 512GB', 32990000, 'dell_xps_13.jpg', 2),
('Tai nghe AirPods Pro', 'Tai nghe không dây chống ồn AirPods Pro', 5490000, 'airpods_pro.jpg', 3),
('Sạc nhanh 65W', 'Củ sạc nhanh 65W hỗ trợ nhiều thiết bị', 990000, 'sac_65w.jpg', 3);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Chờ xử lý','Đang giao','Hoàn thành','Đã hủy') DEFAULT 'Chờ xử lý',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~5 rows (approximately)
INSERT INTO `orders` (`id`, `account_id`, `name`, `phone`, `address`, `created_at`, `status`) VALUES
	(1, 0, 'TTA', '0764926052', 'Đồng Nai', '2025-03-11 01:19:06', 'Đã hủy'),
	(2, 0, 'TTA', '123', '123', '2025-03-11 02:51:44', 'Chờ xử lý'),
	(3, 0, 'TTA', '0764926053', 'TPHCM', '2025-03-11 04:15:50', 'Đang giao'),
	(4, 0, 'TTA', '0764', 'DONG NAI', '2025-03-11 04:30:12', 'Hoàn thành'),
	(5, 0, 'Tuan Anh', '123', '123', '2025-03-11 04:30:59', 'Chờ xử lý');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~10 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 1, 4, 19990000.00),
	(2, 1, 10, 2, 1.00),
	(3, 1, 11, 1, 1.00),
	(4, 2, 5, 1, 5490000.00),
	(5, 2, 1, 1, 19990000.00),
	(6, 2, 4, 1, 32990000.00),
	(7, 3, 3, 1, 27990000.00),
	(8, 3, 1, 1, 19990000.00),
	(9, 4, 4, 2, 32990000.00),
	(10, 5, 4, 5, 32990000.00);
-- Tạo bảng account trước
CREATE TABLE account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng users sau khi đã có bảng account
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES account(id) ON DELETE CASCADE
);

