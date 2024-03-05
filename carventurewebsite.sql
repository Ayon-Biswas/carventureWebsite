-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 06:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carventurewebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin-cred`
--

CREATE TABLE `admin-cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin-cred`
--

INSERT INTO `admin-cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'ayon biswas', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `car_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `pickup` date NOT NULL,
  `dropoff` date NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `car_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`, `pickup`, `dropoff`, `status`, `datentime`) VALUES
(12, 'Hyundai Palisade', 3000, 6000, 'Boby', '01712140180', 'kajolshah,sylhet', '2024-02-10', '2024-02-12', 1, '2024-02-10 23:35:22'),
(14, 'Hyundai SUV', 2000, 8000, 'Ayon', '01712140810', 'kulaura', '2024-02-11', '2024-02-15', 0, '2024-02-11 22:34:44'),
(15, 'Hyundai SUV', 2000, 4000, 'Ayon', '01712140810', 'kulaura', '2024-02-19', '2024-02-21', 0, '2024-02-19 21:58:08'),
(16, 'Hyundai SUV Kona', 2500, 5000, 'Rudra', '01712140820', 'sylhet', '2024-02-22', '2024-02-24', 1, '2024-02-22 20:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(2, 'IMG_84123.jpg'),
(3, 'IMG_50374.jpg'),
(4, 'IMG_56320.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `milage` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `milage`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(7, 'Hyundai SUV', 12000, 2000, 5, 2, 2, 'lorem ipsum dolor set', 1, 0),
(8, 'Hyundai SUV Kona', 14000, 2500, 4, 2, 2, 'An excelent choice for the enthusiasts...one of a kind in SUV space', 0, 0),
(9, 'Hyundai Palisade', 19000, 3000, 2, 2, 2, 'lorem ipsum', 1, 0),
(10, 'Hyundai Aura', 20000, 3100, 2, 2, 3, 'One of the best model offerings from hyundai..the Aura', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_facilities`
--

CREATE TABLE `car_facilities` (
  `sr_no` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_facilities`
--

INSERT INTO `car_facilities` (`sr_no`, `car_id`, `facilities_id`) VALUES
(7, 7, 8),
(8, 7, 12),
(9, 7, 13),
(13, 9, 8),
(14, 9, 9),
(15, 9, 10),
(16, 9, 13),
(17, 10, 10),
(18, 10, 11),
(19, 10, 13);

-- --------------------------------------------------------

--
-- Table structure for table `car_features`
--

CREATE TABLE `car_features` (
  `sr_no` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_features`
--

INSERT INTO `car_features` (`sr_no`, `car_id`, `features_id`) VALUES
(7, 7, 2),
(8, 7, 3),
(12, 9, 2),
(13, 9, 3),
(14, 10, 2),
(15, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `car_images`
--

CREATE TABLE `car_images` (
  `sr_no` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_images`
--

INSERT INTO `car_images` (`sr_no`, `car_id`, `image`, `thumb`) VALUES
(8, 7, 'IMG_63757.webp', 1),
(9, 8, 'IMG_39114.jpg', 1),
(10, 9, 'IMG_21034.jpg', 1),
(11, 10, 'IMG_34738.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `git` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `tw`, `git`, `iframe`) VALUES
(1, 'Leading University,ragibnagar,kamalbazar,sylhet', 'https://maps.app.goo.gl/yVw4xcwGqYzAUtHg7', '01712140810', '01312892300', 'ayonshirsho@gmail.com', 'https://www.facebook.com/ayon.shirsho', 'twitter.com', 'https://github.com/Ayon-Biswas', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7239.67564602109!2d91.804922!3d24.869388!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3751015addbec3b7%3A0x9e87b7be58b5f67e!2sLeading%20University!5e0!3m2!1sen!2sbd!4v1706552460048!5m2!1sen!2sbd ');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(8, 'IMG_26732.svg', 'Android Auto', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!'),
(9, 'IMG_50437.svg', 'Apple Carplay', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!'),
(10, 'IMG_16212.svg', 'AC enabled', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!'),
(11, 'IMG_82900.svg', 'Bluetooth', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!'),
(12, 'IMG_77443.svg', 'Backup Camera', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!'),
(13, 'IMG_57426.svg', 'Blind Spot Monitoring', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi doloremque aperiam distinctio ducimus eaque hic facere!');

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
(2, '180hp'),
(3, '4 seater'),
(4, 'heated seats');

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
(1, 'Car Venture', 'Car Venture in Sylhet, Bangladesh offers a premier car rental service, providing convenient and reliable options for exploring the city. Experience the freedom of the road with our diverse fleet', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
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

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(2, 'Ayon', 'cse_2012020261@lus.ac.bd', 'kulaura', '01712140810', 3230, '2000-08-27', 'IMG_74602.jpeg', '$2y$10$F4zsW0iUdsUH06IkIHcZGuuP.IydVt9lC2qJ1IfT0m6pYJuWuofSC', 1, NULL, NULL, 1, '2024-02-07 21:09:29'),
(4, 'Boby', 'cse_2012020279@lus.ac.bd', 'kajolshah,sylhet', '01712140180', 3100, '2000-02-07', 'IMG_19887.jpeg', '$2y$10$ecnFXomm7viybXtt.RKLVOfhAFuaLgJlvARyrAEfCx8PSSrZYPG5u', 1, '9a62759b601cf243d40540d28bf38544', NULL, 1, '2024-02-10 04:33:02'),
(5, 'Rudra', 'mrwhostheboss81@gmail.com', 'sylhet', '01712140820', 3230, '2024-02-20', 'IMG_59523.jpeg', '$2y$10$5SNFAeblmokViNEBXKc53OSMsAbjHhYT0ymCIQ1ACr99VeeeN/iZ2', 1, 'd7b649c39fd274f25a8c0ad4aa5b5ee6', NULL, 1, '2024-02-22 20:16:29');

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
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin-cred`
--
ALTER TABLE `admin-cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_facilities`
--
ALTER TABLE `car_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `car id` (`car_id`),
  ADD KEY `facilities id` (`facilities_id`);

--
-- Indexes for table `car_features`
--
ALTER TABLE `car_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `cr id` (`car_id`);

--
-- Indexes for table `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `car_id` (`car_id`);

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
-- AUTO_INCREMENT for table `admin-cred`
--
ALTER TABLE `admin-cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `car_facilities`
--
ALTER TABLE `car_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `car_features`
--
ALTER TABLE `car_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_images`
--
ALTER TABLE `car_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_facilities`
--
ALTER TABLE `car_facilities`
  ADD CONSTRAINT `car id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `car_features`
--
ALTER TABLE `car_features`
  ADD CONSTRAINT `cr id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
