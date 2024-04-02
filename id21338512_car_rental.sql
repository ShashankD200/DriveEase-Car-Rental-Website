-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2024 at 09:32 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u816661453_driveEase`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `booking_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NULL DEFAULT current_timestamp(),
  `booking_from` date DEFAULT NULL,
  `booking_till` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Inprocess',
  `des` varchar(500) DEFAULT NULL,
  `drivingLicense` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`booking_id`, `car_id`, `dealer_id`, `user_id`, `booking_date`, `booking_from`, `booking_till`, `status`, `des`, `drivingLicense`, `mobile`, `total_amount`, `days`) VALUES
(19, 25, 9, 16, '2023-10-07 18:30:00', '2023-10-08', '2023-10-11', 'Cancelled', 'Family Vacation', 'asdasdsda', '2342342323', '3900', NULL),
(20, 20, 8, 16, '2023-10-07 18:30:00', '2023-10-07', '2023-10-15', 'Inprocess', 'Family Tour to GOA', 'dfsdf234234', '234234324', '20800', NULL),
(21, 23, 9, 16, '2023-10-07 18:30:00', '2023-10-14', '2023-10-21', 'Confirm', 'Raipur to Pune', 'fdfgfdg34', '35343444', '17500', 7),
(24, 22, 9, 22, '2023-10-08 17:37:06', '2023-10-08', '2023-10-11', 'Confirm', 'Aisi Ghumne jana hai', 'addfsd2332', '8585963210', '9000', 3),
(25, 25, 9, 23, '2023-10-13 15:33:54', '2023-10-14', '2023-10-15', 'Inprocess', 'Timepass', 'Hhhhh', '665566', '1300', 1),
(26, 22, 9, 23, '2023-10-15 10:16:16', '2023-10-16', '2023-10-17', 'Inprocess', 'Dddd', 'Dddddd', '55225525', '3000', 1),
(27, 22, 9, 25, '2023-10-16 19:12:37', '2023-10-14', '2023-10-15', 'Inprocess', 'SAAAAAAAAAAAAAAA', 'sdfsdfsdfsdf', '4534545345', '3000', 1),
(28, 22, 9, 24, '2023-10-16 19:44:59', '2023-10-13', '2023-10-25', 'Cancelled', 'dafdfsdfsdfsd', 'dfsdsdsdfsdf', '4674474457', '36000', 12),
(29, 18, 8, 24, '2023-10-20 21:50:32', '2023-10-21', '2023-10-22', 'Inprocess', 'fgn', 'adsdas242', '434534435', '2200', 1),
(30, 25, 9, 23, '2023-12-06 07:49:49', '2023-12-06', '2023-12-07', 'Inprocess', 'Fcf', 'Ff', '858', '1300', 1),
(31, 26, 9, 18, '2024-01-07 12:25:53', '2024-01-07', '2024-01-08', 'Cancelled', 'Family urgent ', 'Hfjfjcjvii', '7725008610', '500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `id` int(11) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `rent_per_day` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `car_image_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`id`, `vehicle_model`, `vehicle_number`, `seating_capacity`, `rent_per_day`, `dealer_id`, `created_at`, `car_image_url`) VALUES
(16, 'Hyundai I20', 'CG 04 AA 5656', 5, 1500, 8, '2023-09-30 16:37:00', 'CG 04 AA 5656_i20.png'),
(17, 'Toyota Camry', 'MH12AB1234', 5, 2500, 8, '2023-10-01 00:29:09', 'Toyota-Camry.png'),
(18, 'Honda Accord', 'DL10XY5678', 4, 2200, 8, '2023-10-01 00:29:09', 'honda-accord.png'),
(19, 'Ford Mustang', 'KA03CD9876', 2, 3000, 8, '2023-10-01 00:29:09', 'ford-mustang.jpg'),
(20, 'Chevrolet Cruze', 'TN07EF5432', 5, 2600, 8, '2023-10-01 00:29:09', 'cruze.png'),
(21, 'Nissan Altima', 'GJ14GH8765', 4, 2200, 8, '2023-10-01 00:29:09', 'nissan.png'),
(22, 'Innova Crysta', 'CG 04 AA 8522', 8, 3000, 9, '2023-10-01 11:52:59', 'CG 04 AA 8522_innova.png'),
(23, 'Ertiga', 'CG 08 EE 8975', 8, 2500, 9, '2023-10-01 11:55:05', 'CG 08 EE 8975_ertiga.png'),
(25, 'Swift Dzire', 'DL 04 DE 7879', 4, 1300, 9, '2023-10-01 16:29:27', 'DL 04 DE 7879_swift_dzire.png'),
(26, 'Ghhj', 'Hfjfjcjci', 5, 500, 9, '2024-01-07 12:25:18', 'Hfjfjcjci_Screenshot_2024-01-06-20-19-28-37_1c337646f29875672b5a61192b9010f9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_details`
--

CREATE TABLE `dealer_details` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `owner_email` varchar(50) DEFAULT NULL,
  `owner_password` varchar(100) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` varchar(100) DEFAULT NULL,
  `company_logo_url` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dealer_details`
--

INSERT INTO `dealer_details` (`id`, `owner_name`, `owner_email`, `owner_password`, `company_name`, `company_address`, `company_logo_url`, `created_at`, `user_id`) VALUES
(1, 'sadasdsad', 'shashank26dewangan@gmail.com', 'asdsaasd234', 'Chrevolet', 'ascasd', '65174dcc9b3ca_Chrevolet', '2023-09-29 22:29:11', NULL),
(2, 'Shashank ', 'sdd@ff.com', 'asdsdfsdf234', 'BMW', 'Shanti Nagar', 'BMW_C:xampp	mpphp8AC9.tmp', '2023-09-29 22:29:11', NULL),
(3, 'aasdasasd', 'asdasda@ff.dg', 'fsdfsdfdsfsf3445', 'Chrevolet', 'Ssdsdeereerere', 'Chrevolet_undraw_playing_cards_cywn.svg', '2023-09-29 22:29:11', NULL),
(4, 'Raj yadav', 'Raj.yadav@gmail.co', '$2y$10$uT7dWke0h5kZZQYL5IWRTOZ57YZmIIgthaZn0Ww.nyNOXXqt1M9ma', 'Raj Dealers', 'Kargil Chowk', 'Raj Dealers_—Pngtree—car dealer showroom flat illustration_5426815.png', '2023-09-29 23:10:05', NULL),
(5, 'Raj Dealers', 'Raj@kk.com', '$2y$10$EO/C2oWxTnhFACiTLj/dBesWcMreiovWYkTmCy0xO2TOHpFhFJUfe', 'Jaguar', 'Kargil Chowkk', 'Jaguar__Pngtree_car_dealer_showroom_flat_illustration_5426815-removebg-preview.png', '2023-09-29 23:11:26', NULL),
(6, 'asdsa', 'shashank26dasdsaewangan@gmail.com', '$2y$10$0kK6leTcS42twiPifEGy.eYTNvuo.rJpERfg3V4BStrTL6HeIGpLW', 'asdasdsa', 'asdasd', 'asdasdsa_—Pngtree—car dealer showroom flat illustration_5426815.png', '2023-09-29 23:12:53', NULL),
(7, 'asdasd', 'sddasdsad@ff.com', '$2y$10$DlxhP.u7SXvWuVughjJmtOWWqlMdtmzmyJc/CxR4fvQ5E96Taehyu', 'Chrevolet', 'SDSSDSD', 'Chrevolet_undraw_co_workers_re_1i6i.svg', '2023-09-29 23:13:56', NULL),
(8, 'Test ', 'Test@test.com', '$2y$10$KcgeBMW3DYaMIZrnrnEkIOVjeR4Jn1vPk59wtrqxQz9QI7f8Hq4XG', 'Test Dealers', 'Test 787, Test , Test', 'Test Dealers__Pngtree_car_dealer_showroom_flat_illustration_5426815-removebg-preview.png', '2023-09-30 15:57:22', 17),
(9, 'Anish Nayak', 'anish@123.com', '$2y$10$S8NfysUxKgfcHAC3MFSoyuhDrcDRYg44girhkn0CW7XzZjtXsPp4a', 'Luxury Car Dealers', 'Near Shanti chowk, Raipur', 'Luxury Car Dealers_i20.png', '2023-10-01 11:46:08', 18),
(11, 'Chandar Bhoi', 'chandar@123.com', '$2y$10$ipn5g0t4Tw9LACC.I8J38eNkFYdxPEc8l1TiWyOP.rGZpG5uLYBVS', 'Chandar Dealer', 'Raipura', 'Chandar Dealer_Color Hunt Palette f6f1f119a7ce146c94000000.png', '2023-10-08 15:46:21', 19),
(12, 'Lallu', 'lallu@123.com', '$2y$10$aHZ1pkKfZZH2C24sU/RhbOxruc7fQmf8TCWG/Wj6akJ9ihte43bba', 'Lallu', 'aslds', 'Lallu_Color Hunt Palette f6f1f119a7ce146c94000000.png', '2023-10-08 15:50:58', 20),
(13, 'dfsdfd', 'sdfds!@dd.com', '$2y$10$r8fQ7WT4CJRrVCKPJTFnlO/Rmv6uq.QjQChJtFY6saPQhIwmGrf5C', 'adsdas', 'dfdsfs', 'adsdas_Color Hunt Palette f6f1f119a7ce146c94000000.png', '2023-10-08 15:52:54', 21);

-- --------------------------------------------------------

--
-- Table structure for table `old_booking_table`
--

CREATE TABLE `old_booking_table` (
  `booking_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT current_timestamp(),
  `booking_from` date DEFAULT NULL,
  `booking_till` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Inprocess'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `old_booking_table`
--

INSERT INTO `old_booking_table` (`booking_id`, `car_id`, `dealer_id`, `user_id`, `booking_date`, `booking_from`, `booking_till`, `status`) VALUES
(10, 16, 8, 16, '2023-10-01', '2023-10-01', '2023-10-03', 'Inprocess'),
(11, 23, 9, 16, '2023-10-01', '2023-10-01', '2023-10-02', 'Confirm'),
(12, 22, 9, 16, '2023-10-01', '2023-10-03', '2023-10-05', 'Confirm'),
(13, 24, 9, 16, '2023-10-01', '2023-10-04', '2023-10-05', 'Confirm'),
(14, 24, 9, 19, '2023-10-01', '2023-10-04', '2023-10-05', 'Confirm'),
(15, 17, 8, 19, '2023-10-01', '2023-10-04', '2023-10-05', 'Inprocess'),
(16, 26, 9, 20, '2023-10-02', '2023-10-07', '2023-10-10', 'Inprocess'),
(17, 16, 8, 19, '2023-10-03', '2023-10-06', '2023-10-07', 'Inprocess'),
(18, 28, 10, 21, '2023-10-04', '2023-10-01', '2023-10-16', 'Inprocess'),
(19, 26, 9, 22, '2023-10-04', '2023-10-17', '2023-10-21', 'Inprocess'),
(20, 23, 9, 21, '2023-10-04', '2023-10-01', '2023-10-02', 'Inprocess'),
(21, 28, 10, 22, '2023-10-04', '2023-10-11', '2023-10-19', 'Inprocess'),
(22, 29, 11, 24, '2023-10-04', '2023-10-06', '2023-10-07', 'Confirm'),
(23, 19, 8, 25, '2023-10-04', '2023-10-06', '2023-10-08', 'Inprocess'),
(24, 30, 12, 19, '2023-10-04', '2023-10-08', '2023-10-09', 'Confirm'),
(25, 19, 8, 27, '2023-10-06', '2023-10-07', '2023-10-08', 'Inprocess'),
(26, 26, 9, 27, '2023-10-06', '2023-10-07', '2023-10-08', 'Inprocess');

-- --------------------------------------------------------

--
-- Table structure for table `old_car_details`
--

CREATE TABLE `old_car_details` (
  `id` int(11) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `rent_per_day` int(11) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `car_image_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `old_car_details`
--

INSERT INTO `old_car_details` (`id`, `vehicle_model`, `vehicle_number`, `seating_capacity`, `rent_per_day`, `dealer_id`, `created_at`, `car_image_url`) VALUES
(16, 'Hyundai I20', 'CG 04 AA 5656', 5, 1500, 8, '2023-09-30 16:37:00', 'CG 04 AA 5656_i20.png'),
(17, 'Toyota Camry', 'MH12AB1234', 5, 2500, 8, '2023-10-01 00:29:09', 'Toyota-Camry.png'),
(18, 'Honda Accord', 'DL10XY5678', 4, 2200, 8, '2023-10-01 00:29:09', 'honda-accord.png'),
(19, 'Ford Mustang', 'KA03CD9876', 2, 3000, 8, '2023-10-01 00:29:09', 'ford-mustang.jpg'),
(20, 'Chevrolet Cruze', 'TN07EF5432', 5, 2600, 8, '2023-10-01 00:29:09', 'cruze.png'),
(21, 'Nissan Altima', 'GJ14GH8765', 4, 2200, 8, '2023-10-01 00:29:09', 'nissan.png'),
(22, 'Innova Crysta', 'CG 04 AA 8522', 8, 3000, 9, '2023-10-01 11:52:59', 'CG 04 AA 8522_innova.png'),
(23, 'Ertiga', 'CG 08 EE 8975', 8, 2500, 9, '2023-10-01 11:55:05', 'CG 08 EE 8975_ertiga.png'),
(24, 'Swift ', 'CG 04 AA 7878', 4, 1000, 9, '2023-10-01 16:28:45', 'CG 04 AA 7878_swift.png'),
(25, 'Swift Dzire', 'DL 04 DE 7879', 4, 1300, 9, '2023-10-01 16:29:27', 'DL 04 DE 7879_swift_dzire.png'),
(26, 'Creta 2018', 'CG 07 DD 0001', 5, 2200, 9, '2023-10-02 20:45:27', 'CG 07 DD 0001_images.jpeg'),
(27, 'xyz', 'xyz', 1, 1, 10, '2023-10-04 09:51:17', 'xyz_test.jpg'),
(28, 'xyz', 'xyz', 1, 1, 10, '2023-10-04 09:51:31', 'xyz_test.jpg'),
(29, 'Hyundai I20 Active ', 'CG 04 AA 0001', 5, 2000, 11, '2023-10-04 19:35:36', 'CG 04 AA 0001_Screenshot_2023-10-04-21-29-38-35_1c337646f29875672b5a61192b9010f9.jpg'),
(30, 'destini', 'CG04NH9803', 1, 50, 12, '2023-10-04 20:09:51', 'CG04NH9803_images.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `old_dealer_details`
--

CREATE TABLE `old_dealer_details` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `owner_email` varchar(50) DEFAULT NULL,
  `owner_password` varchar(100) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` varchar(100) DEFAULT NULL,
  `company_logo_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `old_dealer_details`
--

INSERT INTO `old_dealer_details` (`id`, `owner_name`, `owner_email`, `owner_password`, `company_name`, `company_address`, `company_logo_url`, `created_at`) VALUES
(1, 'sadasdsad', 'shashank26dewangan@gmail.com', 'asdsaasd234', 'Chrevolet', 'ascasd', '65174dcc9b3ca_Chrevolet', '2023-09-29 22:29:11'),
(2, 'Shashank ', 'sdd@ff.com', 'asdsdfsdf234', 'BMW', 'Shanti Nagar', 'BMW_C:xampp	mpphp8AC9.tmp', '2023-09-29 22:29:11'),
(3, 'aasdasasd', 'asdasda@ff.dg', 'fsdfsdfdsfsf3445', 'Chrevolet', 'Ssdsdeereerere', 'Chrevolet_undraw_playing_cards_cywn.svg', '2023-09-29 22:29:11'),
(4, 'Raj yadav', 'Raj.yadav@gmail.co', '$2y$10$uT7dWke0h5kZZQYL5IWRTOZ57YZmIIgthaZn0Ww.nyNOXXqt1M9ma', 'Raj Dealers', 'Kargil Chowk', 'Raj Dealers_—Pngtree—car dealer showroom flat illustration_5426815.png', '2023-09-29 23:10:05'),
(5, 'Raj Dealers', 'Raj@kk.com', '$2y$10$EO/C2oWxTnhFACiTLj/dBesWcMreiovWYkTmCy0xO2TOHpFhFJUfe', 'Jaguar', 'Kargil Chowkk', 'Jaguar__Pngtree_car_dealer_showroom_flat_illustration_5426815-removebg-preview.png', '2023-09-29 23:11:26'),
(6, 'asdsa', 'shashank26dasdsaewangan@gmail.com', '$2y$10$0kK6leTcS42twiPifEGy.eYTNvuo.rJpERfg3V4BStrTL6HeIGpLW', 'asdasdsa', 'asdasd', 'asdasdsa_—Pngtree—car dealer showroom flat illustration_5426815.png', '2023-09-29 23:12:53'),
(7, 'asdasd', 'sddasdsad@ff.com', '$2y$10$DlxhP.u7SXvWuVughjJmtOWWqlMdtmzmyJc/CxR4fvQ5E96Taehyu', 'Chrevolet', 'SDSSDSD', 'Chrevolet_undraw_co_workers_re_1i6i.svg', '2023-09-29 23:13:56'),
(8, 'Test ', 'Test@test.com', '$2y$10$KcgeBMW3DYaMIZrnrnEkIOVjeR4Jn1vPk59wtrqxQz9QI7f8Hq4XG', 'Test Dealers', 'Test 787, Test , Test', 'Test Dealers__Pngtree_car_dealer_showroom_flat_illustration_5426815-removebg-preview.png', '2023-09-30 15:57:22'),
(9, 'Anish Nayak', 'anish@123.com', '$2y$10$S8NfysUxKgfcHAC3MFSoyuhDrcDRYg44girhkn0CW7XzZjtXsPp4a', 'Luxury Car Dealers', 'Near Shanti chowk, Raipur', 'Luxury Car Dealers_i20.png', '2023-10-01 11:46:08'),
(10, 'dealer', 'dealer@test.com', '$2y$10$e2VWBZp1m8YqejrknqztbumcRbj.GuUeCbj0PrnM2F/g60AxMwl8.', 'dealer', 'dealer', 'dealer_test.jpg', '2023-10-04 09:50:00'),
(11, 'Shreyansh dewangan ', 'shreyansh@123.com', '$2y$10$9eyerEr7YwdwiVVYl7rfGuYpIMs0dXgOiGaxQOp3Ltf6f3iduwBfW', 'Unique Cars', 'Sunder Nagar', 'Unique Cars_Screenshot_2023-10-04-21-29-38-35_1c337646f29875672b5a61192b9010f9.jpg', '2023-10-04 19:33:49'),
(12, 'mera naam', 'mera@email', '$2y$10$xv9YEG8F/K7dQ.SD5ik/N.XFm2tzxd4zmHmGLwL83U/bNKKIwevii', 'mera company', 'mera address', 'mera company_WhatsApp Image 2022-11-17 at 00.20.17.jpg', '2023-10-04 20:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `old_users`
--

CREATE TABLE `old_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `old_users`
--

INSERT INTO `old_users` (`user_id`, `full_name`, `password`, `email`, `created_at`, `user_type`) VALUES
(1, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:45:08', NULL),
(2, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:46:02', NULL),
(3, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:48:36', NULL),
(4, 'IT_040_ShashankDewangan', 'asdfghjkl', 'sdd@ff.com', '2023-09-29 19:49:05', NULL),
(5, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:53:46', NULL),
(6, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:57:34', NULL),
(7, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:59:07', NULL),
(8, 'Shashank Dewangan', '$2y$10$S8NfysUxKgfcHAC3MFSoyuhDrcDRYg44girhkn0CW7XzZjtXsPp4a', 'shashank26dewangan@gmail.com', '2023-09-29 20:00:23', 'Dealer'),
(9, 'Shreya DSfsdf', 'asdfghjkl', 'sdd@ff.com', '2023-09-29 20:00:53', NULL),
(10, 'Shashank Dewangan', 'sdfsdfsdfsd3243', 'wdas@ff.com', '2023-09-29 20:01:58', NULL),
(11, 'Shashank Dewangan', '$2y$10$u2O.qSUWGK/sePYsadCMCuzXhzmoDBkc23hi/RPn20QyhE6qb16RG', 'Abhinav@gmail.com', '2023-09-29 20:24:36', NULL),
(12, 'Shashank Dewangan', '$2y$10$.V7Up5yHZ2p/UtHQe.mgBOPjPpXblBvUAZJsXjIznv0KovcVSJXLy', 'shashankdewangan93@gmail.com', '2023-09-29 22:31:21', NULL),
(13, 'Shashank Dewangan', '$2y$10$dUrV5Mj5SfiSio7cg/K33Ot9Qg/78vcMDr/sNWWMyRzsBEnZQOgR.', 'shashankdewangan11193@gmail.com', '2023-09-29 22:32:39', NULL),
(14, 'Shreya DSfsdf', '$2y$10$KqbS4Nf5qDnyAA6HXbZzL.VVtK6N22ZY.Gj7k0ZVVBUuOL./vemDS', 'sddssssss@ff.com', '2023-09-29 22:34:32', NULL),
(15, 'asdasd', '$2y$10$DlxhP.u7SXvWuVughjJmtOWWqlMdtmzmyJc/CxR4fvQ5E96Taehyu', 'sddasdsad@ff.com', '2023-09-29 23:13:56', 'Dealer'),
(16, 'Raj Yadav', '$2y$10$mN5onlReIhOAnvAz0NVkKuF3YY9ktdRLA2ZzP0MW8be8sCEXkj6Yy', 'raj.yadav@gmail.com', '2023-09-30 13:02:01', 'Customer'),
(17, 'Test ', '$2y$10$KcgeBMW3DYaMIZrnrnEkIOVjeR4Jn1vPk59wtrqxQz9QI7f8Hq4XG', 'Test@test.com', '2023-09-30 15:57:22', 'Dealer'),
(18, 'Anish Nayak', '$2y$10$S8NfysUxKgfcHAC3MFSoyuhDrcDRYg44girhkn0CW7XzZjtXsPp4a', 'anish@123.com', '2023-10-01 11:46:08', 'Dealer'),
(19, 'Prachee Mandhre ', '$2y$10$ms4gKKqZXXwDdHpN2H0XD.eGyYF9zWdUUOfV07JE2YKB4/2Yba9mK', 'prachree@gmail.com', '2023-10-01 21:34:27', 'Customer'),
(20, 'Chandar Bhoi', '$2y$10$SvB8AE2fE6NssGnMCVk7j.kWLr0wbOGDOiTIdZyAY29jc8zKNUqse', 'chandar@123.com', '2023-10-02 20:46:25', 'Customer'),
(21, 'agency', '$2y$10$DhT1.qDiw7r0HbMNCk53.ebzRvPYKIB4PWICnFE3QAP/6tCyOQFkW', 'agency@test.com', '2023-10-04 09:48:25', 'Customer'),
(22, 'dealer', '$2y$10$e2VWBZp1m8YqejrknqztbumcRbj.GuUeCbj0PrnM2F/g60AxMwl8.', 'dealer@test.com', '2023-10-04 09:50:00', 'Dealer'),
(23, 'Shreyansh dewangan ', '$2y$10$9eyerEr7YwdwiVVYl7rfGuYpIMs0dXgOiGaxQOp3Ltf6f3iduwBfW', 'shreyansh@123.com', '2023-10-04 19:33:49', 'Dealer'),
(24, 'Sneha Sahu', '$2y$10$ke8STSOKV1pLwAoheW75g.sMVckCfPr.dGwv0d.hHY0.bmuQtixqa', 'sneha@123.com', '2023-10-04 19:36:54', 'Customer'),
(25, 'Prachee the great Mandhre', '$2y$10$M9zFWQ7HIf5lzfnOse2lA.OGFrGUJbB4loh/3LlMuyPwQhsPIZuzK', 'prachee.mandhre@gmail.com', '2023-10-04 19:49:06', 'Customer'),
(26, 'mera naam', '$2y$10$xv9YEG8F/K7dQ.SD5ik/N.XFm2tzxd4zmHmGLwL83U/bNKKIwevii', 'mera@email', '2023-10-04 20:03:09', 'Dealer'),
(27, 'Akhilesh Sharma', '$2y$10$OLKAdonVdMGzA5ltEECrVevlnVnpP2COrK0kv.RWOzwr1oCdKV3RS', 'akhilesh2002.2002@gmail.com', '2023-10-06 15:46:28', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `created_at`) VALUES
(20, '0', 'Task 1', 'Description for Task 1bubub', '2023-11-10 19:28:48'),
(29, NULL, 'ubuhuh', 'hvuvubu', '2023-11-10 23:29:37'),
(30, NULL, 'ubub', 'jvjv', '2023-11-10 23:30:53'),
(33, NULL, 'ffjjd', 'vvgh', '2023-11-11 10:49:13'),
(36, 'bfzg5yusxwfSbouSHsOH7xnsqM13', 'all ', 'dddddsdasfdg', '2023-11-12 00:13:37'),
(37, NULL, 'ff', 'ff', '2023-11-12 00:24:13'),
(48, 'zD3FlnsO7ybLz2BKpmRsFPmRID43', 'ghhiofdc', 'vvv', '2023-11-16 21:48:56'),
(49, '7IrqimTkC8VM0VMIau9kETBoxXM2', 'jcjcjc', 'jvjg', '2023-11-16 21:56:30'),
(50, '7IrqimTkC8VM0VMIau9kETBoxXM2', ' kbb', 'bibi', '2023-11-16 22:00:31'),
(51, 'QEvs5dPEmBb7gbIlFsF9iuvHEfL2', 'bfjfjfj', 'hdfudufuf', '2023-11-18 10:35:53'),
(55, 'MRDqpeVweMR5woHoIuyp774tgp72', 'hchchf', 'ncjcu', '2023-11-18 20:52:31'),
(58, 'MRDqpeVweMR5woHoIuyp774tgp72', 'sdf', 'sdfdf', '2023-11-19 22:03:32'),
(60, 'MRDqpeVweMR5woHoIuyp774tgp72', 'huh', 'huuu', '2023-11-20 21:11:06'),
(61, 'MRDqpeVweMR5woHoIuyp774tgp72', 'ybbu', 'hg', '2023-11-20 21:11:15'),
(63, 'MRDqpeVweMR5woHoIuyp774tgp72', 'ghshs', 'dddhdhs', '2023-11-22 21:39:09'),
(64, 'MRDqpeVweMR5woHoIuyp774tgp72', 'hshs', 'dhdh', '2023-11-22 21:39:15'),
(65, 'MRDqpeVweMR5woHoIuyp774tgp72', 'Homework ', 'Science ', '2023-11-22 21:39:56'),
(67, 'MRDqpeVweMR5woHoIuyp774tgp72', 'Fucn', 'ncjcjvhc', '2023-11-23 16:06:24'),
(69, 'MRDqpeVweMR5woHoIuyp774tgp72', 'hello', 'jjjj', '2024-01-07 19:55:19'),
(71, 'MRDqpeVweMR5woHoIuyp774tgp72', 'Shopping', '1 Shirt and 1 Jeans', '2024-01-11 21:50:04'),
(74, 'bSUaQ6zchFNSQhoQfbW3ipVNXYH3', 'Shopping ', 'Bag, Pantry ,cakes', '2024-01-13 23:00:24'),
(76, 'jt15QF6YkhPMWU5JIY8uKBYA8Ex2', 'Shopping ', 'Biscuits ', '2024-03-01 18:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `user_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, '', '', '', '$2y$10$phy26vgxHpQ/nveIsMz04OKcYvbhvk1r51hXw8WNt3lSIktr35xqC', '2023-11-10 22:38:19'),
(2, '', '', '', '$2y$10$yW7AsWLlLUGj1q.i63O/luWiNEa0N6Rn1NIR.e0XUBSrrT/F6E7Le', '2023-11-10 22:38:57'),
(3, '', '', '', '$2y$10$aaalZmpfandoxEGrZakESel/yF/gOT0zOhAo/I03CTrKlHRVwjVhO', '2023-11-10 22:43:32'),
(4, '', '', '', '$2y$10$aqAxaxWTBSfVfz2IVAmvE.Bl4ogiTqsquhrIuuGzRypbqfeaB2BVW', '2023-11-10 22:56:39'),
(5, '', '', '', '$2y$10$3P2xqno8dZMHij/huK5EYeepAZjcv4wAfSEnPbB5NIECpSxShBHnO', '2023-11-10 22:57:54'),
(6, '', '', '', '$2y$10$V8wrLOxi2Vk5O5RRIqXeeOSmK/dkX/y/vJKDm6xfJjwuG39ZK6K.W', '2023-11-10 23:04:10'),
(7, 'HTKlqIUTk9gU4IoH0mVi4tJPOKg1', 'jvjvuvu', 'vuvug@chcyucuc.cpm', '$2y$10$qGiCF4Xae0NwvarHM3QLUO6pnEmwTwKBvY.8qU.9UY01N4okmUGUm', '2023-11-16 22:37:40'),
(8, 'QEvs5dPEmBb7gbIlFsF9iuvHEfL2', 'test123', 'test12345@q.com', '$2y$10$RzZ6KvDHiDmZFHbrBOioXO7bnxHT8yXpq1uolbDaQ7jjqW9Cyll.O', '2023-11-16 22:39:33'),
(9, 'YnRDDYSfE4eZXi59j0i81ZV3bkf1', 'test@12222', 'test@12222.com', '$2y$10$Lc.5iTrsqETLmGqY7ZdluuNbFy88lIhADY5BWfQ1dQPiRLGMGXGIC', '2023-11-18 10:57:45'),
(10, 'kSWjrob2bpZysrKmE2dW9ICuQvy1', 'Prachee', 'prachee@gmail.com', '$2y$10$zgxQQDRuh7G.hmGAMX2w5.IWsbYuoNSzteprhMMJvpZwC.qE0A8Em', '2023-11-19 20:47:03'),
(11, 'MRDqpeVweMR5woHoIuyp774tgp72', 'admin_test', 'admin@123.com', '$2y$10$bxHExw5ApHpJ3U18guhB4uZObOTBQX.wU/ffk7DKuOnhbJmIAXl/6', '2023-11-19 20:48:16'),
(12, 'ylMXVAAF40cPdmUOEu6Z4W4YjeR2', 'shashank', 'admin@avc.com', '$2y$10$cMp/xc8wTD.QIg9jpUVk/OUq6Rphc.5z..OIhleJchVv9rxpimt8K', '2024-01-13 22:58:46'),
(13, 'bSUaQ6zchFNSQhoQfbW3ipVNXYH3', 'Test-123', 'test@gmail.com', '$2y$10$6tVHgYHsZQmvdVSmdsvyc.Qdc6cEa0RhXqJ80QIGmbPOe4TVtz502', '2024-01-13 22:59:31'),
(14, 'jt15QF6YkhPMWU5JIY8uKBYA8Ex2', 'shashank', 'aaaja@gmail.com', '$2y$10$BLkCECAjPMW0hBFoJrj3E.YCSJ/jEL5TJGSePnsDQY0OVoj49H/.W', '2024-03-01 18:45:37'),
(15, 'mcH11xRi8QZS56YyXLCBoJQWwPT2', 'test', 'test1234@gmail.com', '$2y$10$MvwaAiqXrTzwoko2UjxU0.xEdH3Aqp3fKREqHQqrY0Dhz9a5dTDM2', '2024-03-01 18:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `user_type` varchar(50) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `password`, `email`, `created_at`, `user_type`, `dealer_id`) VALUES
(1, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:45:08', NULL, NULL),
(2, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:46:02', NULL, NULL),
(3, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:48:36', NULL, NULL),
(4, 'IT_040_ShashankDewangan', 'asdfghjkl', 'sdd@ff.com', '2023-09-29 19:49:05', NULL, NULL),
(5, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:53:46', NULL, NULL),
(6, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:57:34', NULL, NULL),
(7, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 19:59:07', NULL, NULL),
(8, 'Shashank Dewangan', 'asdfghjkl', 'shashank26dewangan@gmail.com', '2023-09-29 20:00:23', NULL, NULL),
(9, 'Shreya DSfsdf', 'asdfghjkl', 'sdd@ff.com', '2023-09-29 20:00:53', NULL, NULL),
(10, 'Shashank Dewangan', 'sdfsdfsdfsd3243', 'wdas@ff.com', '2023-09-29 20:01:58', NULL, NULL),
(11, 'Shashank Dewangan', '$2y$10$u2O.qSUWGK/sePYsadCMCuzXhzmoDBkc23hi/RPn20QyhE6qb16RG', 'Abhinav@gmail.com', '2023-09-29 20:24:36', NULL, NULL),
(12, 'Shashank Dewangan', '$2y$10$.V7Up5yHZ2p/UtHQe.mgBOPjPpXblBvUAZJsXjIznv0KovcVSJXLy', 'shashankdewangan93@gmail.com', '2023-09-29 22:31:21', NULL, NULL),
(13, 'Shashank Dewangan', '$2y$10$dUrV5Mj5SfiSio7cg/K33Ot9Qg/78vcMDr/sNWWMyRzsBEnZQOgR.', 'shashankdewangan11193@gmail.com', '2023-09-29 22:32:39', NULL, NULL),
(14, 'Shreya DSfsdf', '$2y$10$KqbS4Nf5qDnyAA6HXbZzL.VVtK6N22ZY.Gj7k0ZVVBUuOL./vemDS', 'sddssssss@ff.com', '2023-09-29 22:34:32', NULL, NULL),
(15, 'asdasd', '$2y$10$DlxhP.u7SXvWuVughjJmtOWWqlMdtmzmyJc/CxR4fvQ5E96Taehyu', 'sddasdsad@ff.com', '2023-09-29 23:13:56', 'Dealer', NULL),
(16, 'Raj Yadav', '$2y$10$mN5onlReIhOAnvAz0NVkKuF3YY9ktdRLA2ZzP0MW8be8sCEXkj6Yy', 'raj.yadav@gmail.com', '2023-09-30 13:02:01', 'Customer', NULL),
(17, 'Test ', '$2y$10$KcgeBMW3DYaMIZrnrnEkIOVjeR4Jn1vPk59wtrqxQz9QI7f8Hq4XG', 'Test@test.com', '2023-09-30 15:57:22', 'Dealer', 8),
(18, 'Anish Nayak', '$2y$10$S8NfysUxKgfcHAC3MFSoyuhDrcDRYg44girhkn0CW7XzZjtXsPp4a', 'anish@123.com', '2023-10-01 11:46:08', 'Dealer', 9),
(19, 'Chandar Bhoi', '$2y$10$ipn5g0t4Tw9LACC.I8J38eNkFYdxPEc8l1TiWyOP.rGZpG5uLYBVS', 'chandar@123.com', '2023-10-08 15:46:21', 'Dealer', NULL),
(20, 'Lallu', '$2y$10$aHZ1pkKfZZH2C24sU/RhbOxruc7fQmf8TCWG/Wj6akJ9ihte43bba', 'lallu@123.com', '2023-10-08 15:50:59', 'Dealer', NULL),
(21, 'dfsdfd', '$2y$10$r8fQ7WT4CJRrVCKPJTFnlO/Rmv6uq.QjQChJtFY6saPQhIwmGrf5C', 'sdfds!@dd.com', '2023-10-08 15:52:54', 'Dealer', 13),
(22, 'Shashank Dewangan', '$2y$10$l/L.0Va5XrQRZ38u8v/C3upv/Xxen2s9QgdJoWubTakPl7vcxdGg2', 'shashank@123.com', '2023-10-08 17:35:41', 'Customer', NULL),
(23, 'ShanshankDewangan_040', '$2y$10$SOI1VGuHyVLA7zZA8RUGWeZ//wM3SqbZF./H2UhozJlZ6LZsAP61q', 'dewangan@123.com', '2023-10-12 18:11:59', 'Customer', NULL),
(24, 'Shashank Dewangan', '$2y$10$D8uZU.yjU.F/mRcfMIess.6k8AeFcMID7I5sjJcfO7fAqOcFqdlae', 'shashank11@123.com', '2023-10-13 14:25:24', 'Customer', NULL),
(25, 'Raj Yadav', '$2y$10$O9U4n24LHPFCV7PqV7CEQu2i2vQHYXnEdF61PtfrM.Ome7WWQIR4C', 'raj@123.com', '2023-10-16 19:03:47', 'Customer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_erp`
--

CREATE TABLE `users_erp` (
  `user_id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_erp`
--

INSERT INTO `users_erp` (`user_id`, `role`, `email`, `password`) VALUES
(1, 'Student', 'student1@example.com', 'password1'),
(2, 'Teacher', 'teacher1@example.com', 'password2'),
(3, 'Admin', 'admin1@example.com', 'password3'),
(4, 'Student', 'student2@example.com', 'password4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_details`
--
ALTER TABLE `dealer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_booking_table`
--
ALTER TABLE `old_booking_table`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `old_car_details`
--
ALTER TABLE `old_car_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_dealer_details`
--
ALTER TABLE `old_dealer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_users`
--
ALTER TABLE `old_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_erp`
--
ALTER TABLE `users_erp`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `car_details`
--
ALTER TABLE `car_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dealer_details`
--
ALTER TABLE `dealer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `old_booking_table`
--
ALTER TABLE `old_booking_table`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `old_car_details`
--
ALTER TABLE `old_car_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `old_dealer_details`
--
ALTER TABLE `old_dealer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `old_users`
--
ALTER TABLE `old_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_erp`
--
ALTER TABLE `users_erp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD CONSTRAINT `booking_table_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car_details` (`id`),
  ADD CONSTRAINT `booking_table_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealer_details` (`id`),
  ADD CONSTRAINT `booking_table_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `old_booking_table`
--
ALTER TABLE `old_booking_table`
  ADD CONSTRAINT `old_booking_table_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `old_car_details` (`id`),
  ADD CONSTRAINT `old_booking_table_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `old_dealer_details` (`id`),
  ADD CONSTRAINT `old_booking_table_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `old_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
