-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 09:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinbech_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'admin', 'admin12');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(1, 'Electronic Devices'),
(2, 'Electronic Accessories'),
(3, 'Home Appliances'),
(4, 'Babies & Toys'),
(5, 'Groceries'),
(6, 'Men\'s Wear'),
(7, 'Women\'s Wear'),
(8, 'Watches & Accessories'),
(9, 'Sports & Outdoor'),
(10, 'Automobiles');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_product`
--

CREATE TABLE `ordered_product` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `payment` varchar(20) NOT NULL,
  `invoice` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `fp_id` int(11) NOT NULL,
  `fp_name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `fp_price` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `fp_category` varchar(100) NOT NULL,
  `fp_amount` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `description` text NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `featured` int(11) NOT NULL DEFAULT 0,
  `delivery_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`fp_id`, `fp_name`, `brand`, `fp_price`, `price`, `fp_category`, `fp_amount`, `image`, `discount`, `description`, `delivery`, `featured`, `delivery_charge`) VALUES
(8, 'Laptop - Lenovo Thinkpad T430', 'Lenovo Co.', 48000, 60000, 'Electronic Devices', 4, '1636176797', 20, 'lenovo thinkpad t430... RAM: 4gb ... SSD:128gb ... HDD:320gb', 'Delivery Charge Included', 0, 100),
(9, 'T Shirt', 'No Brand', 335, 345, 'Men\'s Wear', 1, '1636177030', 3, 'Black and white Shirt', 'Free Delivery', 0, 0),
(10, 'Food Warmer', 'CG', 2330, 2589, 'Home Appliances', 6, '1636177200', 10, 'Warm your food any time.', 'Delivery Charge Included', 1, 100),
(11, ' Mosquito Coil', 'Good Knight', 62, 65, 'Groceries', 5, '1636177287', 5, 'Mosquito coil for repelling the mosquito', 'Delivery Charge Included', 0, 100),
(12, 'Black T-Shirt for Men', 'Vans', 760, 760, 'Men\'s Wear', 6, '1636177543', 0, 'Black t shirt', 'Delivery Charge Included', 0, 100),
(13, 'Grinder', 'CG', 5406, 5690, 'Home Appliances', 9, '1636177632', 5, 'Mixer for grinding', 'Delivery Charge Included', 1, 100),
(14, 'Refrigerator', 'Goderige', 23301, 25890, 'Home Appliances', 5, '1636177727', 10, 'Fridge and deep fridger', 'Delivery Charge Included', 0, 100),
(15, 'Blue T- Shirt', 'Adidas', 476, 560, 'Men\'s Wear', 6, '1636177802', 15, 'Blue red shirt', 'Delivery Charge Included', 0, 100),
(16, 'Formal Shirt ', 'Nike', 2250, 2500, 'Men\'s Wear', 7, '1636177889', 10, 'Formal purple and other shirts', 'Free Delivery', 0, 0),
(17, 'Blue Shirt', 'No Brand', 4655, 4900, 'Men\'s Wear', 4, '1636177973', 5, 'khoi k lekhum', 'Delivery Charge Included', 0, 100),
(18, 'Redmi Note10', 'Redmi', 38800, 40000, 'Electronic Devices', 8, '1636181221', 3, 'Redmi note10 at your disposal', 'Delivery Charge Included', 1, 100),
(19, 'Microsoft Tab', 'Microsoft Co.', 66300, 78000, 'Electronic Devices', 4, '1636181323', 15, 'qweerrdfg ghjhh yyy yyn5 es', 'Delivery Charge Included', 1, 100),
(20, 'I phone 13 pro', 'Apple Co.', 97500, 130000, 'Electronic Devices', 11, '1636181398', 25, 'i phone  at your hand', 'Delivery Charge Included', 1, 100),
(21, 'Lava x10', 'Lava Co.', 45000, 50000, 'Electronic Devices', 11, '1636181514', 10, 'lava x10 ram:8 rom:128 snapdragoln', 'Delivery Charge Included', 0, 100),
(22, 'Black T-Shirt Gold', 'Adidas', 855, 900, 'Men\'s Wear', 2, '1636181586', 5, 'Golden striped shirt', 'Delivery Charge Included', 0, 100),
(23, 'White Shits', 'Vans', 808, 850, 'Men\'s Wear', 7, '1636181661', 5, 'white t shirts', 'Delivery Charge Included', 0, 100),
(24, 'Winter Jacket For Women', 'Adidas', 5130, 5700, 'Women\'s Wear', 11, '1636181736', 10, 'winter jacket for omen', 'Delivery Charge Included', 0, 100),
(25, 'Cotton Pant', 'No Brand', 1150, 2300, 'Men\'s Wear', 6, '1636181816', 50, '...................................... ^--^........', 'Delivery Charge Included', 0, 100),
(26, 'Trecking jacket', 'No Brand', 6300, 7000, 'Sports & Outdoor', 4, '1636181909', 10, '!!!!!! yes go treking with this javkry', 'Delivery Charge Included', 0, 100),
(27, 'Check Shirt ', 'Vans', 2550, 3000, 'Sports & Outdoor', 1, '1636181974', 15, 'kya karu marjaun', 'Delivery Charge Included', 1, 100),
(28, 'Baby Girl', 'No Brand', 225, 250, 'Babies & Toys', 3, '1636182051', 10, 'Get tops for your little princess', 'Delivery Charge Included', 0, 100),
(29, 'Baby clothe', 'No Brand', 405, 450, 'Babies & Toys', 6, '1636182144', 10, 'Give a perfect gift to your daughter', 'Delivery Charge Included', 0, 100),
(30, 'White Dog', 'No Brand', 485, 500, 'Babies & Toys', 1, '1636182213', 3, 'White fluffy dog toy', 'Delivery Charge Included', 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `email`, `password`, `address`, `contact`, `gender`) VALUES
(7, 'Haresh Chyase', 'haresh@gmail.com', '807034c386763cad02253762dda79952', 'Chyasal, Lalitpur', 9860689987, 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_product`
--
ALTER TABLE `ordered_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`fp_id`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ordered_product`
--
ALTER TABLE `ordered_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `temporary`
--
ALTER TABLE `temporary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
