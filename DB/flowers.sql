-- CREATE DATABASE flower_shop;
-- use flower_shop; 
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(10) NOT NULL,
    address VARCHAR(100) NOT NULL,
    role VARCHAR(10) DEFAULT "user"
);
CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
CREATE TABLE Flowers (
    flower_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    discount INT NOT NULL,
    stock INT NOT NULL,
    image_url VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2) NOT NULL,
    address VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
CREATE TABLE Order_Items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    flower_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (flower_id) REFERENCES Flowers(flower_id)
);
CREATE TABLE SPCart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flower_id int not null,
    user_id int not null,
    quantity int not null,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (flower_id) REFERENCES Flowers(flower_id)
);

CREATE TABLE Favourites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flower_id int not null,
    user_id int not null,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (flower_id) REFERENCES Flowers(flower_id)
);
CREATE TABLE Message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(10),
    email text,
    name VARCHAR(30),
    message text
);


INSERT INTO Categories (name) VALUES
('Hoa Cưới'),
('Hoa Sinh Nhật'),
('Hoa Kỷ Niệm'),
('Hoa Tặng Bạn Bè'),
('Hoa Văn Phòng');

INSERT INTO Flowers (name, description, price, discount, stock, image_url, category_id) VALUES
-- Hoa Cưới
('Hồng Đỏ', 'Hoa hồng đỏ tươi đẹp thường được sử dụng trong đám cưới.', 150000.00, 15, 50, 'link_to_image1.jpg', 1),
('Lily Trắng', 'Thể hiện sự thanh khiết và trong sáng.', 160000.00, 10, 30, 'link_to_image2.jpg', 1),
('Cẩm Chướng', 'Được yêu thích vì vẻ đẹp và độ bền.', 140000.00, 5, 25, 'link_to_image3.jpg', 1),
('Lan Hồ Điệp', 'Sang trọng và quý phái.', 180000.00, 0, 20, 'link_to_image4.jpg', 1),
('Tulip', 'Nhiều màu sắc tươi sáng, mang lại không khí vui tươi.', 120000.00, 10, 40, 'link_to_image5.jpg', 1),
('Baby''s Breath', 'Thường đi kèm hoa chính để tạo sự nhẹ nhàng.', 90000.00, 5, 15, 'link_to_image6.jpg', 1),

-- Hoa Sinh Nhật
('Hướng Dương', 'Mang lại niềm vui và năng lượng tích cực.', 110000.00, 5, 45, 'link_to_image7.jpg', 2),
('Cúc Vạn Thọ', 'Thể hiện sự trường thọ và hạnh phúc.', 100000.00, 5, 50, 'link_to_image8.jpg', 2),
('Đồng Tiền', 'Đầy màu sắc, thích hợp cho món quà sinh nhật.', 130000.00, 10, 35, 'link_to_image9.jpg', 2),
('Hồng Phấn', 'Dịu dàng và ngọt ngào, thể hiện tình cảm.', 160000.00, 10, 20, 'link_to_image10.jpg', 2),
('Cẩm Tú Cầu', 'Đa dạng màu sắc, thể hiện sự chân thành.', 150000.00, 5, 30, 'link_to_image11.jpg', 2),
('Nhài', 'Có hương thơm ngọt ngào, thích hợp cho dịp đặc biệt.', 140000.00, 5, 25, 'link_to_image12.jpg', 2),

-- Hoa Kỷ Niệm
('Mẫu Đơn', 'Mang ý nghĩa sự sang trọng và kỷ niệm đáng nhớ.', 250000.00, 10, 10, 'link_to_image13.jpg', 3),
('Thạch Thảo', 'Biểu tượng cho những kỷ niệm đẹp.', 120000.00, 5, 22, 'link_to_image14.jpg', 3),
('Lan', 'Thể hiện sự quý phái và tình cảm sâu sắc.', 200000.00, 10, 15, 'link_to_image15.jpg', 3),
('Hồng Trắng', 'Tượng trưng cho tình yêu vĩnh cửu.', 170000.00, 5, 14, 'link_to_image16.jpg', 3),
('Hồng Xanh', 'Hoa hồng xanh độc đáo, thể hiện tình yêu khác biệt.', 190000.00, 15, 9, 'link_to_image17.jpg', 3),
('Bách Hợp', 'Mang đến cảm xúc nhẹ nhàng và thanh thoát.', 180000.00, 10, 8, 'link_to_image18.jpg', 3),

-- Hoa Tặng Bạn Bè
('Cúc', 'Tươi vui và thân thiện, thích hợp cho bạn bè.', 80000.00, 5, 50, 'link_to_image19.jpg', 4),
('Hồng Vàng', 'Thể hiện tình bạn và sự quý mến.', 140000.00, 5, 30, 'link_to_image20.jpg', 4),
('Phong Lữ', 'Mang lại không khí dễ chịu, thích hợp để tặng.', 120000.00, 5, 35, 'link_to_image21.jpg', 4),
('Cát Tường', 'Tượng trưng cho sự tốt đẹp trong tình bạn.', 110000.00, 5, 28, 'link_to_image22.jpg', 4),
('Nhung Đỏ', 'Độc đáo và quyến rũ, thể hiện sự khác biệt.', 175000.00, 5, 11, 'link_to_image23.jpg', 4),
('Sen Trắng', 'Nhiều màu sắc, dễ dàng để lựa chọn.', 130000.00, 5, 22, 'link_to_image24.jpg', 4),

-- Hoa Văn Phòng
('Lan Địa', 'Sang trọng và dễ chăm sóc, thích hợp cho văn phòng.', 200000.00, 10, 5, 'link_to_image25.jpg', 5),
('Sen Hồng', 'Mang lại không khí tươi vui cho văn phòng.', 110000.00, 0, 15, 'link_to_image26.jpg', 5),
('Oải Hương', 'Dễ chăm sóc và trang trí văn phòng.', 90000.00, 0, 25, 'link_to_image27.jpg', 5),
('Orchid', 'Có hương thơm nhẹ nhàng, thích hợp cho không gian làm việc.', 140000.00, 5, 20, 'link_to_image28.jpg', 5),
('Iris', 'Mang lại vẻ đẹp thanh lịch cho văn phòng.', 130000.00, 0, 10, 'link_to_image29.jpg', 5),
('Đỗ Quyên', 'Thể hiện sự thanh lịch và trang nhã.', 160000.00, 0, 8, 'link_to_image30.jpg', 5);

