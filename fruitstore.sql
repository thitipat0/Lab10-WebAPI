-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 29, 2025 at 06:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruitstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `description`, `image_url`) VALUES
(2, 'Banana', 'Banana', 25.00, 200, 'กล้วยหอมทอง รสหวาน', 'https://example.com/banana.jpg'),
(3, 'Orange', 'Citrus', 35.00, 150, 'ส้มสายน้ำผึ้ง', 'https://example.com/orange.jpg'),
(4, 'Mango Namdokmai', 'Mango', 60.00, 120, 'มะม่วงน้ำดอกไม้สีทอง', 'https://example.com/mango-namdokmai.jpg'),
(5, 'Papaya', 'Papaya', 30.00, 80, 'มะละกอสุก หวานกำลังดี', 'https://example.com/papaya.jpg'),
(6, 'Watermelon', 'Melon', 40.00, 60, 'แตงโมหวานฉ่ำ', 'https://example.com/watermelon.jpg'),
(7, 'Pineapple', 'Pineapple', 55.00, 70, 'สับปะรดภูแล', 'https://example.com/pineapple.jpg'),
(8, 'Durian Monthong', 'Durian', 250.00, 40, 'ทุเรียนหมอนทอง', 'https://example.com/durian.jpg'),
(9, 'Mangosteen', 'Mangosteen', 80.00, 90, 'มังคุดหวานอมเปรี้ยว', 'https://example.com/mangosteen.jpg'),
(10, 'Rambutan', 'Rambutan', 50.00, 110, 'เงาะโรงเรียน', 'https://example.com/rambutan.jpg'),
(11, 'Lychee', 'Lychee', 120.00, 50, 'ลิ้นจี่คัดพิเศษ', 'https://example.com/lychee.jpg'),
(12, 'Longan', 'Longan', 70.00, 100, 'ลำไยอบแห้ง/สด', 'https://example.com/longan.jpg'),
(13, 'Grapes Red', 'Grapes', 150.00, 60, 'องุ่นแดงไร้เมล็ด', 'https://example.com/grapes-red.jpg'),
(14, 'Grapes Green', 'Grapes', 140.00, 65, 'องุ่นเขียวไร้เมล็ด', 'https://example.com/grapes-green.jpg'),
(15, 'Guava', 'Guava', 45.00, 85, 'ฝรั่งกิมจู กรอบหวาน', 'https://example.com/guava.jpg'),
(16, 'Dragon Fruit', 'Dragonfruit', 90.00, 75, 'แก้วมังกรเนื้อขาว', 'https://example.com/dragonfruit.jpg'),
(17, 'Strawberry', 'Berry', 200.00, 40, 'สตรอว์เบอร์รีสดจากเชียงใหม่', 'https://example.com/strawberry.jpg'),
(18, 'Blueberry', 'Berry', 250.00, 35, 'บลูเบอร์รีนำเข้า', 'https://example.com/blueberry.jpg'),
(19, 'Coconut', 'Coconut', 35.00, 95, 'มะพร้าวน้ำหอม', 'https://example.com/coconut.jpg'),
(20, 'Jackfruit', 'Jackfruit', 60.00, 55, 'ขนุนหวานกรอบ', 'https://example.com/jackfruit.jpg'),
(21, 'Peach', 'Stone Fruit', 120.00, 50, 'ลูกพีชหวานฉ่ำ', 'https://example.com/peach.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
