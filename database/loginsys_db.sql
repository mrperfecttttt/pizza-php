-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 03:12 PM
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
-- Database: `loginsys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `order_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `product_1` int(11) NOT NULL,
  `product_2` int(11) NOT NULL,
  `product_3` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `line_address1` varchar(255) DEFAULT NULL,
  `line_address2` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `card_num` varchar(16) DEFAULT NULL,
  `card_expired` varchar(5) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0= unavailable, 2 Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(1, 3, 'Sicilian Pizza (Traditional Toppings)', 'Sicilian pizza with bits of tomato, onion, anchovies, and herbs toppings.', 350, '1676512620_Sicilian.jpg', 1),
(2, 1, 'Pepperoni Thin', 'Pepperoni thin-crust', 380, '1676512800_thin-pepperoni.png', 1),
(3, 2, 'Detroit Style', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent suscipit porttitor dui, a accumsan metus molestie vel. Quisque luctus eros interdum, facilisis lectus at, aliquam lacus.', 360, '1676512980_detroit-style-thick.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `secret_question` varchar(255) NOT NULL,
  `secret_answer` varchar(255) NOT NULL,
  `encryption_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `email`, `secret_question`, `secret_answer`, `encryption_key`) VALUES
(10, 'admin', '0e7517141fb53f21ee439b355b5a1d0a', 'admin', '', 'What is your pet&#039;s name?', 'QE8snFu5r8petRiRnWf/sTlrWXlvQUVJNGVmYnZNclRjUHl2N2c9PQ==', '107475b036cc610aae5610e6fae9c7ea'),
(11, 'testt', '029db36a20d7a35c4cc93f6f9457f74c', 'testt', '', 'What is your pet&#039;s name?', '12vNyFU=', 'testt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
