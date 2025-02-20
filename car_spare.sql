-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 01:07 PM
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
-- Database: `car_spare (3)`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `namecar` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `namecar`, `image`) VALUES
(1, 'Kia', 'kia.png'),
(2, 'Bmw', 'bmw.png'),
(3, 'Mercedes', 'mar.png'),
(4, 'Audi', 'awdi.png'),
(5, 'FR', 'fr.jpg'),
(6, 'honda', 'honda.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `number_phone` int(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_price` int(100) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Shipped','Delivered') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `number_phone`, `address`, `total_price`, `order_date`, `status`) VALUES
(101, 1, 525364781, 'ardn', 1804000, '2023-08-04', 'Delivered'),
(102, 10, 59600300, 'bathan', 2700000, '2023-08-04', 'Pending'),
(103, 11, 65973523, 'ttt', 1800000, '2023-08-04', 'Pending'),
(104, 13, 59214786, 'jeneen', 600, '2023-08-04', 'Pending'),
(105, 15, 59544991, 'aman', 12000, '2023-08-04', 'Pending'),
(106, 16, 59824761, 'masakin', 900000, '2023-08-05', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(87, 101, 22, 1, 4000.00),
(88, 101, 28, 2, 900000.00),
(89, 101, 25, 3, 80000.00),
(90, 102, 28, 3, 900000.00),
(91, 103, 28, 2, 900000.00),
(92, 104, 25, 3, 200.00),
(93, 105, 22, 3, 4000.00),
(94, 106, 28, 1, 900000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `count` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `id_car` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `details`, `count`, `id_type`, `price`, `id_car`, `image`) VALUES
(22, 'Mercedes-Benz GLE 53 AMG', 'AMG GLE 53 Specs, Features and Price\nThe Petrol engine is 2999 cc . It is available with Automatic transmission.', 4, 1, 4000, 3, 'r.jpg'),
(25, 'Mercedes-Benz GLC63 S AMG (2018)', 'About the 2018 Mercedes-AMG GLC 63 S\nThe GLC is an all wheel drive 4 door with 5 seats, powered by a 4.0L TURBO V8 engine that has 375 kW of power (at 6250 rpm) and 700 Nm of torque (at 1750 rpm) via a Nine-speed Automatic', 12, 2, 200, 3, 'rr.jpg'),
(28, 'Mercedes-S', ' The S 65 AMG is powered by a handcrafted 6.0-liter V12 biturbo engine. It delivers an impressive output of around 621 horsepower and 738 lb-ft of torque. The engine is mated to a 7-speed automatic transmission.', 1, 3, 900000, 3, 'rrr.jpg'),
(29, 'Kia Sportage EX', 'Kia Sportage EX.jpg', 8, 11, 140000, 1, 'k1.jpg'),
(42, 'mmmm', 'very full power', 400, 1, 9800, 3, 'rrrrrrr.jpg'),
(43, 'marcedes', 'very full power', 14, 1, 180000, 3, 'Mercedes-Benz E-Class.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pr_cr`
--

CREATE TABLE `pr_cr` (
  `id` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pr_cr`
--

INSERT INTO `pr_cr` (`id`, `id_car`, `id_type`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 1, 2),
(8, 2, 2),
(9, 3, 2),
(10, 4, 2),
(11, 5, 2),
(12, 6, 2),
(13, 1, 3),
(14, 2, 3),
(15, 3, 3),
(16, 4, 3),
(17, 5, 3),
(18, 6, 3),
(19, 1, 4),
(20, 2, 4),
(21, 3, 4),
(22, 4, 4),
(23, 5, 4),
(24, 6, 4),
(25, 1, 5),
(26, 2, 5),
(27, 3, 5),
(28, 4, 5),
(29, 5, 5),
(30, 6, 5),
(31, 1, 6),
(32, 2, 6),
(33, 3, 6),
(34, 4, 6),
(35, 5, 6),
(36, 6, 6),
(37, 1, 7),
(38, 2, 7),
(39, 3, 7),
(40, 4, 7),
(41, 5, 7),
(42, 6, 7),
(43, 1, 8),
(44, 2, 8),
(45, 3, 8),
(46, 4, 8),
(47, 5, 8),
(48, 6, 8),
(49, 1, 9),
(50, 2, 9),
(51, 3, 9),
(52, 4, 9),
(53, 5, 9),
(54, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id_user` int(100) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id_user`, `pid`) VALUES
(1, 28),
(1, 25),
(5, 25),
(10, 28),
(11, 28),
(13, 25),
(1, 42),
(15, 22),
(16, 28);

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `id` int(10) NOT NULL,
  `nametype` varchar(50) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`id`, `nametype`, `image`, `id_car`) VALUES
(1, 'Mercedes-Benz GLE 53 AMG', 'r.jpg', 3),
(2, 'Mercedes-Benz GLC63 S AMG (2018)', 'rr.jpg', 3),
(3, '2021 Mercedes-Benz E350', 'rrr.jpg', 3),
(4, 'Mercedes-Benz G63 AMG Edition 55', 'rrrr.jpg', 3),
(5, 'Mercedes-Benz Classe C Berline', 'rrrrr.jpg', 3),
(6, 'Mercedes-Benz GLC\n', 'rrrrrrr.jpg', 3),
(7, 'Mercedes-Benz E-Class\n', 'Mercedes-Benz E-Class.jpg', 3),
(8, 'Mercedes-Benz S 65 AMG', 'Mercedes-Benz S 65 AMG.jpg', 3),
(9, 'Mercedes-Benz AMG S65 Coupe', 'Mercedes-Benz AMG S65 Coupe.jpg', 3),
(11, 'Kia Cadenza\n', 'k1.jpg', 1),
(12, 'Kia Sportage EX', 'Kia Sportage EX.jpg', 1),
(13, 'BMW', 'bb.webp', 2),
(14, 'FR', 'FR.jpg', 5),
(15, 'Honda Civic Sport Touring', 'Honda Civic Sport Touring.jpg', 6),
(16, 'audir8', 'audir8.webp', 4);

-- --------------------------------------------------------

--
-- Table structure for table `type_product2`
--

CREATE TABLE `type_product2` (
  `ID` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_product2`
--

INSERT INTO `type_product2` (`ID`, `name`, `image`) VALUES
(1, 'k1', 'k1.jpg'),
(14, 'Kia Sportage EX', 'Kia Sportage EX.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type_users` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type_users`) VALUES
(1, 'deyaa', 'deyaa@123', '123456', 'user'),
(5, 'muheeb', 'moheebhasan95@gmail.com', '102030', 'admin'),
(10, 'raneen', 'raneen@najah.edu', '1234567', 'user'),
(11, 'karam', 'karam@najah.edu', '14915', 'user'),
(13, 'abood', 'abood@najah.edu', '908070', 'user'),
(15, 'sufian', 'sufian@najah.edu', '4050', 'user'),
(16, 'batool', 'batool@najah.edu', '191618', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_cart` (`user_id`),
  ADD KEY `fk_product_car` (`pid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_product` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_car_id` (`id_car`),
  ADD KEY `fk_type_id` (`id_type`);

--
-- Indexes for table `pr_cr`
--
ALTER TABLE `pr_cr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkk` (`id_car`),
  ADD KEY `id_type` (`id_type`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD KEY `fk_user_id_id` (`id_user`),
  ADD KEY `fk_pid-pro` (`pid`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_product2`
--
ALTER TABLE `type_product2`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_user` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pr_cr`
--
ALTER TABLE `pr_cr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `type_product2`
--
ALTER TABLE `type_product2`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_car` FOREIGN KEY (`pid`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_user_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `item_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_car_id` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`),
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`id_type`) REFERENCES `type_product` (`id`);

--
-- Constraints for table `pr_cr`
--
ALTER TABLE `pr_cr`
  ADD CONSTRAINT `fkk` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_type` FOREIGN KEY (`id_type`) REFERENCES `type_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_pid-pro` FOREIGN KEY (`pid`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_user_id_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
