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

