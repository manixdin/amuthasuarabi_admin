-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 08:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `log` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(250) DEFAULT NULL,
  `modify_log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modify_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `flag`, `log`, `created_by`, `modify_log`, `modify_by`) VALUES
(1, 'admin', 'admin', 1, '2022-01-09 16:59:53', 'admin', '2022-01-09 16:59:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city_master`
--

CREATE TABLE `tbl_city_master` (
  `city_id` int(11) NOT NULL,
  `state_id` varchar(250) NOT NULL,
  `city_name` varchar(250) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_city_master`
--

INSERT INTO `tbl_city_master` (`city_id`, `state_id`, `city_name`, `flag`, `log`) VALUES
(1, '1', 'Chennai', 1, '2022-02-02 18:42:24'),
(2, '2', 'Bangalore', 1, '2022-02-02 18:41:36'),
(3, '1', 'Coimbatore', 1, '2022-02-02 18:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_main_category`
--

CREATE TABLE `tbl_main_category` (
  `main_category_id` int(11) NOT NULL,
  `mc_name` varchar(255) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `active_flag` int(11) NOT NULL DEFAULT 1,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_main_category`
--

INSERT INTO `tbl_main_category` (`main_category_id`, `mc_name`, `img_url`, `active_flag`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'vegitable', 'uploads/MainCategory/veg.jpg', 0, 1, '2022-01-09 17:16:02', '2022-01-31 17:38:44'),
(2, 'non veg', 'uploads/MainCategory/meat.jpeg', 1, 1, '2022-01-09 18:10:53', '2022-01-31 17:39:01'),
(3, 'Drinks', 'uploads/MainCategory/drinks-to-avoid-1621959532.jpg', 1, 1, '2022-01-09 18:11:40', '2022-01-31 17:40:48'),
(4, 's', '', 1, 0, '2022-01-30 15:56:51', '2022-01-31 17:39:13'),
(5, 'e', '', 1, 0, '2022-01-30 15:57:43', '2022-01-31 17:39:18'),
(6, 'lll', 'uploads/MainCategory/Untitle1.jpg', 1, 0, '2022-01-31 16:52:17', '2022-01-31 17:39:22'),
(7, 'Fruits new', 'uploads/MainCategory/meat1.jpeg', 1, 1, '2022-02-02 18:23:41', '2022-02-02 18:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prod_id` int(11) NOT NULL,
  `mc_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` varchar(255) NOT NULL,
  `prod_quantity` varchar(255) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `prod_imgurl` varchar(1000) NOT NULL,
  `prod_info` text NOT NULL,
  `out_of_stack` int(11) NOT NULL DEFAULT 1,
  `best_offer` int(11) NOT NULL DEFAULT 0,
  `top_saver` int(11) NOT NULL DEFAULT 0,
  `brand` varchar(250) DEFAULT NULL,
  `active_flag` int(11) NOT NULL DEFAULT 1,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`prod_id`, `mc_id`, `sc_id`, `prod_name`, `prod_price`, `prod_quantity`, `unit_id`, `prod_imgurl`, `prod_info`, `out_of_stack`, `best_offer`, `top_saver`, `brand`, `active_flag`, `flag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'tomato', '70', '8', 'Kilogram', 'uploads/Products/11_img/veg.jpg', '<p>good&nbsp;for health</p>\r\n', 1, 0, 0, NULL, 1, 1, '2022-01-12 18:56:13', '2022-02-02 17:34:21'),
(2, 2, 2, 'fresh chicken', '500', '10', 'Kilogram', 'uploads/Products/11_img/veg.jpg', '<p>fresh chicken</p>\r\n', 1, 0, 0, NULL, 1, 1, '2022-01-13 11:19:38', '2022-02-02 17:34:38'),
(3, 2, 2, 'Appteq Apple test ', '100', '10', 'Box', 'uploads/Products/11_img/veg.jpg', '<p>ww</p>\r\n', 1, 1, 1, NULL, 1, 1, '2022-01-30 16:20:12', '2022-02-02 17:34:42'),
(4, 2, 2, 'asdasd', '12', '12', 'Liter', 'uploads/Products/11_img/veg.jpg', '<p>asdasdasd</p>\r\n', 1, 1, 1, NULL, 1, 1, '2022-01-31 13:18:27', '2022-02-02 17:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE `tbl_product_images` (
  `product_image_id` int(11) NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `product_image_url` varchar(500) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state_master`
--

CREATE TABLE `tbl_state_master` (
  `state_id` int(11) NOT NULL,
  `country` varchar(250) NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_state_master`
--

INSERT INTO `tbl_state_master` (`state_id`, `country`, `state_name`, `flag`, `log`) VALUES
(1, 'india', 'Tamilnadu', 1, '2022-02-02 18:20:54'),
(2, 'india', 'Karnataka', 1, '2022-02-02 18:21:39'),
(3, 'india', 'kerala', 0, '2022-02-02 18:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE `tbl_sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `main_category_id` varchar(10) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `active_flag` int(11) NOT NULL DEFAULT 1,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`sub_category_id`, `main_category_id`, `sub_category_name`, `img_url`, `active_flag`, `flag`, `created_at`, `updated_at`) VALUES
(1, '1', 'good', 'uploads/SubCategory/drinks-to-avoid-1621959532.jpg', 1, 1, '2022-01-12 03:25:18', '2022-01-31 18:10:35'),
(2, '2', 'meets', 'uploads/SubCategory/meat2.jpeg', 1, 1, '2022-01-12 04:19:55', '2022-01-31 18:09:12'),
(3, '1', 'qq', 'uploads/SubCategory/meat.jpeg', 1, 1, '2022-01-31 18:05:41', '2022-01-31 18:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `unit_name` varchar(500) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_id`, `unit`, `unit_name`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'box', 'Box', 1, '2020-09-14 10:49:51', '2021-05-04 05:07:24'),
(2, 'g', 'Grams', 1, '2020-09-24 12:27:03', '2021-05-04 05:07:29'),
(3, 'kg', 'Kilogram', 1, '2020-09-14 10:50:01', '2021-05-04 05:07:34'),
(4, 'lt', 'Liter', 1, '2020-09-14 10:50:06', '2021-05-04 05:07:40'),
(5, 'pcs', 'Piece', 1, '2020-09-24 12:28:50', '2021-05-04 05:07:47'),
(6, 'Bunch', 'Bunch', 1, '2020-09-24 12:28:19', '2021-05-04 05:07:58'),
(7, 'Pack', 'Pack', 1, '2020-09-24 12:29:03', '2021-05-04 05:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `default_address_id` varchar(100) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_unique_id`, `username`, `email`, `mobile_no`, `password`, `nationality`, `default_address_id`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'AS20210001', 'manivelan', 'manixdin@gmail.com', '8976897689', '1234', 'chennai', '1', 1, '2022-01-13 18:00:51', '2022-01-14 17:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_address`
--

CREATE TABLE `tbl_user_address` (
  `address_id` int(11) NOT NULL,
  `user_unique_id` varchar(500) DEFAULT NULL,
  `flat_no` varchar(100) NOT NULL,
  `building_name` varchar(250) NOT NULL,
  `landmark` varchar(250) NOT NULL,
  `city` varchar(250) DEFAULT NULL,
  `address_type` varchar(500) DEFAULT NULL,
  `pin` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_address`
--

INSERT INTO `tbl_user_address` (`address_id`, `user_unique_id`, `flat_no`, `building_name`, `landmark`, `city`, `address_type`, `pin`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'AS20210001', '123', 'powerhouse', 'tneb', 'voimedu, vedaranyam', 'home', '614714', 1, '2022-01-14 13:30:04', '2022-01-14 13:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_orders`
--

CREATE TABLE `tbl_user_orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(500) DEFAULT NULL,
  `user_unique_id` varchar(200) DEFAULT NULL,
  `address_id` varchar(50) DEFAULT NULL,
  `prod_id` varchar(500) DEFAULT NULL,
  `price` varchar(1000) DEFAULT NULL,
  `quantity` varchar(500) DEFAULT NULL,
  `unit_id` varchar(1000) DEFAULT NULL,
  `prod_total_price` varchar(1000) DEFAULT NULL,
  `prod_subtotal` varchar(100) DEFAULT NULL,
  `payment_type` varchar(100) DEFAULT NULL,
  `total_price` varchar(100) DEFAULT NULL,
  `order_current_status` varchar(150) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 1,
  `log` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_orders`
--

INSERT INTO `tbl_user_orders` (`order_id`, `order_code`, `user_unique_id`, `address_id`, `prod_id`, `price`, `quantity`, `unit_id`, `prod_total_price`, `prod_subtotal`, `payment_type`, `total_price`, `order_current_status`, `flag`, `log`) VALUES
(1, 'AS00001', 'AS20210001', '1', '1,2', '70,500', '2,1', 'Kilogram,Kilogram', '140,500', '640', 'cod', '640', 'order_outofdelivery', 1, '2022-01-13 18:28:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_main_category`
--
ALTER TABLE `tbl_main_category`
  ADD PRIMARY KEY (`main_category_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexes for table `tbl_state_master`
--
ALTER TABLE `tbl_state_master`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_user_orders`
--
ALTER TABLE `tbl_user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_city_master`
--
ALTER TABLE `tbl_city_master`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_main_category`
--
ALTER TABLE `tbl_main_category`
  MODIFY `main_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_state_master`
--
ALTER TABLE `tbl_state_master`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_orders`
--
ALTER TABLE `tbl_user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
