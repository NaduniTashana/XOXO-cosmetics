-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 02:43 PM
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
-- Database: `shop_db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(57, 1, 'red lipstick', 560, 1, 'make-up.png'),
(59, 0, 'oil', 400, 1, '61LxVq4BtGS.jpg'),
(63, 0, 'sun & fun', 500, 1, '1_60cb0133d2ba7.png'),
(68, 0, 'eye lash curler', 2000, 1, 'Cala-Product-Iridescent-Lash-Curler-2__38008.jpg'),
(70, 0, 'nars', 5020, 1, '4_5_web-everyday_great_skin_foundation_300_beige_960023_ecom_WEB.jpg'),
(71, 7, 'sun & fun', 500, 1, '1_60cb0133d2ba7.png'),
(72, 7, 'oil', 400, 3, '61LxVq4BtGS.jpg'),
(83, 0, 'foundation', 5055, 1, 'warm_b_1800x1800.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 4, 'Hemapalage Uvini Dinanga Ranasinghe', 'uviniranasinghe21@gmail.com', '0778946673', 'hi oyalata kohomada\r\n'),
(12, 4, 'Uma', 'uma@gmail.com', '0778946673', 'Hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(10, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '0778946673', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 5555, ijj, Wattala, Sri Lanka - 11300', ', sun (1) , sun & fun (1) ', 1000, '16-Dec-2023', 'completed'),
(11, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '0778946673', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 11, oo, Wattala, Sri Lanka - 11300', ', oil (1) , sun & fun (1) ', 900, '16-Dec-2023', 'completed'),
(12, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '0778946673', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 555, hhdhj, Wattala, Sri Lanka - 11300', ', oil (3) , sun & fun (1) , nars (4) ', 21780, '17-Dec-2023', 'pending'),
(13, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '0778946673', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 123, wattala, Wattala, Sri Lanka - 11300', ', eye lash curler (10) , foundation (4) , nars (3) ', 55280, '17-Dec-2023', 'pending'),
(14, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '0778946673', 'uviniranasinghe21@gmail.com', 'paypal', 'flat no. 22, as, Wattala, Sri Lanka - 11300', ', oil (3) ', 1200, '17-Dec-2023', 'pending'),
(15, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '077888', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 22, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', sun & fun (1) ', 500, '18-Dec-2023', 'pending'),
(16, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '25222', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 55, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', oil (1) , sun & fun (1) ', 900, '18-Dec-2023', 'pending'),
(18, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 556, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', Hi Hi (3) ', 1665, '29-Jan-2024', 'pending'),
(19, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '52636', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 5665, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', Hi Hi (3) ', 1665, '29-Jan-2024', 'pending'),
(20, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '5655', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 565, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', Hi Hi (1) ', 555, '29-Jan-2024', 'pending'),
(21, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '112', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 899, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (1) ', 5055, '29-Jan-2024', 'pending'),
(22, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 23, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (1) ', 5055, '29-Jan-2024', 'pending'),
(23, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 34, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (1) ', 5055, '29-Jan-2024', 'pending'),
(24, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 54, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (1) ', 5055, '29-Jan-2024', 'pending'),
(25, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 55, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', oil (1) ', 400, '29-Jan-2024', 'pending'),
(26, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 11, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', Uvini (1) ', 55, '29-Jan-2024', 'pending'),
(27, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 44, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (1) ', 5055, '29-Jan-2024', 'pending'),
(28, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'cash on delivery', 'flat no. 78, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', oil (9) ', 3600, '29-Jan-2024', 'pending'),
(29, 5, 'Hemapalage Uvini Dinanga Ranasinghe', '52636', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 55, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', sun & fun (1) , foundation (1) ', 5555, '29-Jan-2024', 'pending'),
(30, 4, 'Hemapalage Uvini Dinanga Ranasinghe', '11232', 'uviniranasinghe21@gmail.com', 'credit card', 'flat no. 121, 65/7,Weliamuna Road, Hendala, Wattala, Sri Lanka - 11300', ', foundation (3) ', 15165, '07-Feb-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_1` varchar(100) NOT NULL,
  `category_2` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_1`, `category_2`, `price`, `image`, `description`, `quantity`) VALUES
(13, 'Hair Oil', 'haircare', 'naturaloil', 400, '61LxVq4BtGS.jpg', '\nTransform your locks with our luxurious hair oil, enriched with nourishing ingredients to promote shine, strength, and vitality.', 10),
(14, 'Sunscreen', 'skincare', 'sunprotection', 500, '1_60cb0133d2ba7.png', 'Shield your skin from harmful UV rays with our premium suncream, offering broad-spectrum protection for a worry-free day under the sun.', 0),
(15, 'Nars', 'makeup', 'face', 5020, '4_5_web-everyday_great_skin_foundation_300_beige_960023_ecom_WEB.jpg', 'Foundation cream', 1),
(17, 'Eye lash curler', 'tools', 'scissors', 2000, 'Cala-Product-Iridescent-Lash-Curler-2__38008.jpg', '\nEnhance your lashes effortlessly with our precision-designed eyelash curler, for eyes that captivate with a natural, beautiful curl.', 0),
(18, 'Foundation', 'makeup', 'face', 5055, 'warm_b_1800x1800.jpg', 'Discover flawless complexion perfection with our lightweight yet buildable foundation, designed to blend seamlessly for a natural, radiant finish.', 15),
(28, 'Beauty brush', 'tools', 'brushers', 600, 'brushes.jpg', 'Elevate your makeup routine with our professional-grade beauty brush, designed to effortlessly blend and sculpt for flawless, airbrushed results.', 5),
(29, 'Powder', 'makeup', 'face', 990, 'powder.jpg', 'Achieve a flawless, matte finish with our lightweight mattifying powder, perfect for controlling shine and prolonging your makeup\'s staying power.', 2),
(30, 'Acne care face wash', 'skincare', 'acnecare', 1500, 'acne face wash.png', '\r\nCombat acne and achieve clearer, smoother skin with our gentle yet effective face wash formulated to target blemishes and prevent future breakouts.', 6),
(31, 'Eye cream', 'skincare', 'eyecare', 2000, 'under eye cream.png', 'Revitalize tired eyes and diminish dark circles with our rejuvenating under eye cream, formulated to hydrate and brighten the delicate under-eye area.', 0),
(32, 'Fake nails', 'makeup', 'nails', 450, 'fake nails.png', 'Elevate your nail game effortlessly with our high-quality fake nails, designed for easy application and long-lasting glamour.', 10),
(33, 'Nail polish', 'makeup', 'nails', 550, 'nail polish.jpg', 'Elevate your manicure game with our vibrant nail polish collection, delivering long-lasting color and a flawless finish for every occasion.', 12),
(34, 'Eye lashes', 'makeup', 'eye', 250, 'eye lashes.jpg', '\r\nEnhance your natural beauty with our selection of high-quality false eyelashes, designed to add length, volume, and drama to your eyes effortlessly.', 25),
(35, 'Mascara', 'makeup', 'eye', 1200, 'eye2.jpg', 'Enhance your lashes with our volumizing mascara, designed to deliver bold and beautiful results for captivating eyes.', 12),
(36, 'Shampoo', 'haircare', 'shampoo', 680, 'shampoo.jpg', 'Elevate your hair care routine with our invigorating shampoo, crafted with botanical extracts to cleanse, hydrate, and revitalize your locks from root to tip.', 6),
(37, 'Lipsticks', 'makeup', 'lips', 250, 'lips1.jpeg', 'Enhance your pout with our vibrant collection of lipsticks, delivering long-lasting color and a velvety-smooth finish for all-day confidence.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `verification_code`, `is_verified`) VALUES
(1, 'naduni', 'n@gmail.com', 'a01610228fe998f515a72dd730294d87', 'user', '', 1),
(2, 'lakna', 'l@gmail.com', 'b139aeda1c2914e3b579aafd3ceeb1bd', 'admin', '', 1),
(3, 'Uvini', 'uvini@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '', 1),
(4, 'Dinali', 'dinali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '', 1),
(5, 'uma', 'uma@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(6, 0, 'oil', 400, 1, '61LxVq4BtGS.jpg'),
(7, 7, 'oil', 400, 1, '61LxVq4BtGS.jpg'),
(13, 5, 'Hi Hi', 555, 1, 'warm_b_1800x1800.jpg'),
(14, 5, 'sun & fun', 500, 1, '1_60cb0133d2ba7.png'),
(15, 20, 'oil', 400, 1, '61LxVq4BtGS.jpg'),
(16, 20, 'Uvini', 55, 1, 'Cala-Product-Iridescent-Lash-Curler-2__38008.jpg'),
(21, 4, 'Sunscreen', 500, 1, '1_60cb0133d2ba7.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
