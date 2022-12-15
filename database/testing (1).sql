-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 08:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `email`, `status`) VALUES
(12, 'note-thanun-RUiGsJlkkRo-unsplash.jpg', 'Ram@gmail.com', 1),
(13, 'nadia-sitova-Ickv8N13YEA-unsplash.jpg', 'Ram@gmail.com', 1),
(14, 'andrew-knechel-gG6yehL64fo-unsplash.jpg', 'Ram@gmail.com', 1),
(15, 'jakob-dalbjorn-cuKJre3nyYc-unsplash.jpg', 'Ram@gmail.com', 1),
(16, 'aranxa-esteve-S5DEUg2yUVU-unsplash.jpg', 'Ram@gmail.com', 0),
(17, 'kane-reinholdtsen-LETdkk7wHQk-unsplash.jpg', 'Ram@gmail.com', 1),
(18, 'dylan-gillis-KdeqA3aTnBY-unsplash.jpg', 'Ram@gmail.com', 1),
(19, 'chuttersnap-Q_KdjKxntH8-unsplash.jpg', 'Ram@gmail.com', 1),
(20, 'the-climate-reality-project-Hb6uWq0i4MI-unsplash.jpg', 'Ram@gmail.com', 1),
(21, 'andrei-stratu-kcJsQ3PJrYU-unsplash.jpg', 'Ram@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered_admin`
--

CREATE TABLE `registered_admin` (
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_admin`
--

INSERT INTO `registered_admin` (`full_name`, `username`, `email`, `password`) VALUES
('Admin OP', 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `referral_code` varchar(200) NOT NULL,
  `referral_point` int(200) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`full_name`, `username`, `email`, `password`, `referral_code`, `referral_point`) VALUES
('Ram', 'Ram123', 'Ram@gmail.com', '$2y$10$SrppVNaastCqDFKR65JD9.FLLuQx/x7/2v6HVuhAYlaH8UQqwIBJe', 'CA46C933', 240),
('Shreenath updated', 'Shree123', 'shree@gmail.com', '$2y$10$wAhOBtppWyM9303zbiSPPe8WlqVwAp4KZow0HuxUu3hmOFN7tWN.6', '78C8F617', 250),
('touseef', 'touseef', 'touseef@gmail.com', '$2y$10$phqcewHKDnaxektLaTiYOeVvRgsg2MnFCW/TEVdfbicV2UmPqOCny', '10922A46', 10),
('webdev', 'webdev', 'webdev@gmail.com', '$2y$10$GsG7wVVcNsEsqIhCj3JCjOxyaXq.MIq73USzmY1p2cC8rqGfgT7he', '84E4B10D', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
