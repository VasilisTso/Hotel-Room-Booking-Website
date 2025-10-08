-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 09:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelbookingwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'bill', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`) VALUES
(1, 1, 'Single Room', 150, 300, NULL, 'bill', '6940050060'),
(2, 2, 'Luxury Room', 500, 2000, '2A', 'bill', '6940050060'),
(3, 3, '\r\nDeluxe Room', 300, 600, NULL, 'bill', '6940050060'),
(4, 4, 'Deluxe Room', 300, 3600, NULL, 'bill', '6940050060'),
(5, 5, 'Single Room', 150, 150, NULL, 'bill', '6940050060'),
(6, 6, 'Luxury Room', 500, 1500, NULL, 'bill', '6940050060'),
(8, 8, 'Luxury Room', 500, 1500, NULL, 'bill', '6940050060'),
(9, 9, 'Single Room', 150, 150, NULL, 'bill', '6940050060');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(200) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `rate_review`, `datentime`) VALUES
(1, 8, 6, '2024-08-23', '2024-08-25', 0, NULL, 'pending', 'ORD_21055700', NULL, 0, 'pending', NULL, NULL, '2024-08-23 19:16:11'),
(2, 8, 8, '2024-08-26', '2024-08-30', 1, NULL, 'booked', 'ORD_24215693', '20240826111212800110168128204225276', 2000, 'TXN_SUCCESS', 'Txn Success', 1, '2024-08-23 19:23:27'),
(3, 8, 7, '2024-08-29', '2024-08-31', 0, NULL, 'payment failed', 'ORD_28394638', '20240829111212800110168372503893816', 600, 'TXN_FAILED', 'Your payment has been declined. Please contact your bank.', NULL, '2024-08-23 19:27:48'),
(4, 8, 7, '2024-09-13', '2024-09-25', 0, NULL, 'booked', 'ORD_27241583', '20240826111212800110161542598662457', 3600, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-08-26 21:47:52'),
(5, 8, 6, '2024-08-28', '2024-08-29', 0, NULL, 'booked', 'ORD_27568923', '20240828111212800110164569857512231', 150, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-08-24 22:50:52'),
(6, 8, 8, '2024-08-28', '2024-08-31', 0, NULL, 'booked', 'ORD_27568869', '20240828111212800110164569857512231', 1500, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-08-25 22:53:35'),
(8, 8, 8, '2024-08-29', '2024-09-01', 0, 0, 'cancelled', 'ORD_27568453', '20240828111212800110164569857515689', 1500, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-08-27 16:48:35'),
(9, 8, 6, '2024-08-28', '2024-08-29', 0, NULL, 'booked', 'ORD_10568923', '20240828111212800110164569857512231', 150, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-08-24 22:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn` bigint(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn`, `email`, `tw`, `insta`, `fb`, `iframe`) VALUES
(1, 'Αγίου Σπυρίδωνος, Αιγάλεω 12243', 'https://maps.app.goo.gl/u91RWbiPcDYaFR4KA', 302105385100, 'ice20390247@uniwa.gr', 'https://x.com/?lang=en', 'https://www.instagram.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1571.9635679428827!2d23.676385!3d38.00216!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bd7c9d3d1ec3:0xc22b2daf23732b47!2sDepartment of Informatics and Computer Engineering!5e0!3m2!1sen!2sgr!4v1723647106792!5m2!1sen!2sgr');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `descr` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `descr`) VALUES
(9, 'IMG_80546.svg', 'Wi-Fi', '1 Gigabit Internet speeds both on wifi and ethernet for work and entertainment purposes for all of our guests'),
(10, 'IMG_31273.svg', 'AC', 'AC units for cool summers and warm winter'),
(11, 'IMG_30708.svg', 'TV', 'Smart TVs for relaxing in the room watching the news, your favorite show on streaming platforms or even playing games from the provided PC or console'),
(12, 'IMG_79517.svg', 'SPA', 'Spa services from licensed masseur to relax on your trip as you have all your worries dissapear'),
(13, 'IMG_59463.svg', 'Infinity Pool', 'Our large infinity pool for swimming, grabing a drink by the pool at our bar and relaxing under the sun'),
(14, 'IMG_59148.svg', 'Gym', 'Our gym has equipment for every exersice that you can imagine for staying healthy even on your vacation'),
(15, 'IMG_92906.svg', 'Theater Room', 'Our hotel has a dedicated theater room that you can rent for the best movie nights with your company');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(19, 'Bedroom'),
(20, 'Bathroom'),
(21, 'Kitchen'),
(22, 'Balcony'),
(24, 'King-sized Bed'),
(25, 'Sofa'),
(26, 'WC'),
(27, 'Workspace'),
(28, 'Living Room'),
(29, 'Desk');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(3, 2, 8, 8, 5, 'the room is perfect as well as the service', 0, '2024-08-25 14:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `descr` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `descr`, `status`, `removed`) VALUES
(1, 'simple room', 15125, 100, 5, 2, 1, 'This is a descr for the room', 1, 1),
(2, 'One Person Room', 60, 75, 12, 2, 0, 'budget option', 1, 0),
(3, 'simple room +', 120, 130, 2, 3, 2, 'economy plus style room(scam)', 0, 0),
(4, 'simple room', 75, 100, 6, 2, 1, 'simple room', 0, 0),
(5, 'simple room test', 445, 4848, 4848, 784984, 48489, 'dadawdawd', 1, 1),
(6, 'Single Room', 80, 150, 15, 2, 1, 'This is the perfect room for a family of three to spend their holidays.', 1, 0),
(7, 'Deluxe Room', 130, 300, 10, 4, 2, 'This is a more luxurious room compared to the single room for anyone willing to spend a little bit more money, for more space, features and facilities.', 1, 0),
(8, 'Luxury Room', 250, 500, 2, 8, 4, 'Our most luxurious room. With this room people can feel like home with its huge space and enjoy all the facilities our hotel has to offer.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(69, 4, 9),
(70, 4, 10),
(71, 4, 11),
(72, 3, 9),
(73, 3, 10),
(74, 3, 11),
(75, 3, 13),
(76, 3, 14),
(91, 7, 9),
(92, 7, 10),
(93, 7, 11),
(94, 7, 14),
(108, 6, 9),
(109, 6, 10),
(110, 6, 11),
(166, 2, 9),
(167, 2, 11),
(180, 8, 9),
(181, 8, 10),
(182, 8, 11),
(183, 8, 12),
(184, 8, 13),
(185, 8, 14);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(39, 4, 19),
(40, 4, 20),
(41, 4, 21),
(42, 3, 19),
(43, 3, 20),
(44, 3, 21),
(45, 3, 22),
(63, 7, 19),
(64, 7, 20),
(65, 7, 22),
(66, 7, 26),
(67, 7, 27),
(81, 6, 19),
(82, 6, 20),
(83, 6, 25),
(84, 6, 29),
(147, 2, 19),
(148, 2, 20),
(165, 8, 19),
(166, 8, 20),
(167, 8, 21),
(168, 8, 22),
(169, 8, 24),
(170, 8, 26),
(171, 8, 27),
(172, 8, 28);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(11, 2, 'IMG_42291.jpg', 0),
(12, 3, 'IMG_20079.jpg', 0),
(13, 4, 'IMG_34943.jpg', 0),
(14, 6, 'IMG_94075.jpg', 1),
(15, 7, 'IMG_78612.jpg', 1),
(16, 8, 'IMG_42742.jpg', 1),
(17, 6, 'IMG_98358.jpg', 0),
(18, 7, 'IMG_23415.jpg', 0),
(19, 8, 'IMG_99062.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Hotel BND', 'Αυτή είναι η εργασίας μας για το μάθημα: Τεχνολογία Λογισμικού.\nΗ ιστοσελίδα είναι έχει ως θέμα: Διαχείριση κρατήσεων ξενοδοχείου.\nΤσομάκας Βασίλειος(20390247)\nΠαρασκευάς Νίκος(21390183)\nΣιώρος Δημήτριος(21390204)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `phonenum`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(8, 'bill', 'billthetso@gmail.com', '6940050060', '2019-02-05', 'IMG_53581.jpeg', '$2y$10$hzEgAs1d1GCTwcNdEvuxeuj7r2lm8SZyX017kWu1LqORBLgDOgs26', 1, NULL, NULL, 1, '2024-08-21 18:11:15'),
(10, 'test account', 'test@gmail.com', '6930030030', '2016-07-22', 'IMG_31497.jpeg', '$2y$10$VxCzMlzOp/u4XwxNrJVNQO3qit6P3XEaj.6TSdYQyXq6IT4iHNlTe', 0, '6e9b5c7057dbf6f0469be3eba0737519', NULL, 0, '2024-08-22 17:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
(14, 'bill', 'ice20390247@uniwa.gr', 'testing', 'testing the backend', '2024-08-16 00:00:00', 0),
(15, 'adwadAW', 'daDA@gmail.com', 'WDawdaw', 'dadawawd', '2024-08-16 00:00:00', 0),
(16, 'bill', 'ice20390247@uniwa.gr', 'another test', 'dWDawdawDAWD', '2024-08-16 00:00:00', 0),
(17, 'bill', 'ice20390247@uniwa.gr', 'dwaDAWdawDpassthemathima', 'adwadadadpleaseasperaso', '2024-08-16 00:00:00', 0),
(18, 'dadWdwada', 'adawdaw@gmail.com', 'dwwadawdaW', 'daDwadaWDAWD', '2024-08-16 00:00:00', 0),
(19, 'bill', 'ice20390247@uniwa.gr', 'testing', 'testing the backend', '2024-08-16 00:00:00', 0),
(20, 'adwadAW', 'daDA@gmail.com', 'WDawdaw', 'dadawawd', '2024-08-16 00:00:00', 0),
(21, 'bill', 'ice20390247@uniwa.gr', 'another test', 'dWDawdawDAWD', '2024-08-16 00:00:00', 0),
(22, 'bill', 'ice20390247@uniwa.gr', 'dwaDAWdawDpassthemathima', 'adwadadadpleaseasperaso', '2024-08-16 00:00:00', 0),
(23, 'dadWdwada', 'adawdaw@gmail.com', 'dwwadawdaW', 'daDwadaWDAWD', '2024-08-16 00:00:00', 0),
(24, 'dadWdwada', 'adawdaw@gmail.com', 'dwwadawdaW', 'daDwadaWDAWD', '2024-08-16 00:00:00', 0),
(25, 'dadWdwada', 'adawdaw@gmail.com', 'dwwadawdaW', 'daDwadaWDAWD', '2024-08-16 00:00:00', 0),
(26, 'testing dashboard', 'testd@gmail.com', 'TESTING DYNAMIC DASHBOARD', 'HELLO JUST TESTING', '2024-08-25 00:00:00', 0),
(27, 'testing dashboard', 'testd@gmail.com', 'TESTING DYNAMIC DASHBOARD', 'HELLO JUST TESTING', '2024-08-25 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
