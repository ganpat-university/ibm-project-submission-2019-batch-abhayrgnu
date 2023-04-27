-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 03:26 PM
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
-- Database: `dac`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(6) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `addrs` varchar(191) NOT NULL,
  `pincode` varchar(191) NOT NULL,
  `state` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `phone`, `addrs`, `pincode`, `state`, `country`, `user_id_fk`) VALUES
(20, 'Meh ', '9662804073', 'ss', '360015', 'gg', 'gg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saltvalue` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`first_name`, `last_name`, `pincode`, `email`, `id`, `password`, `saltvalue`, `verified`) VALUES
('Abhay', 'Ruparel', '380015', 'abhay@gmail.com', 8, '9f8191dc3b3f7b107a03bb96669157beca73b76f86387d0c733720bdb19debbd', 'e734b97e41a4c55b87324134dd76e5e1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `saltvalue` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`first_name`, `last_name`, `address`, `id`, `pincode`, `email`, `password`, `verified`, `saltvalue`) VALUES
('Ramesh', 'Patel', '', 1, 0, 'abhay@gmail.com', '8c48369056e7a63f16ce5ccc8c61c0259ed6d5153412b8d7a602b92951bb873a', 0, '973fb80bc6622f4025147f4753f83831');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `saltvalue` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `manager_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`first_name`, `last_name`, `pincode`, `email`, `password`, `id`, `saltvalue`, `verified`, `manager_id_fk`) VALUES
('mesh', 'ss', 0, 'ss@gmail.com', '138d8867c1bc5cfbfaa11258f434517f18c52324e0ca7b95fc65b15f334d708a', 1, '8a187734ff80070155556f04e264a64f', 0, NULL),
('Raj', 'Patel', 0, 'raj@gmail.com', '407b4bd88d8b1cfad5678687be62ed9e9eae20c0dc2b803848d5d983c3c874e0', 2, '93d6dfee8a57d11142069ba74d3ae927', 0, NULL),
('Ramesh', 'ss', 0, 'ramesh@gmail.com', '3e488e81a390d73a3cc3a56f159e84a06ffe97cbf0364b37e619fc5129221515', 3, '502e44f99b3b9f608c3ea9e937ac9d0a', 0, NULL),
('a', 'a', 0, 'a@gmail.com', '7d39279ec2eb20c079453524b9f969104ea30bf7f90a4cbf2b84ee88ecd9bc3f', 4, 'ab3c60c1773f575fb7b14556330feefc', 0, NULL),
('Abhay', 'Ruparel', 0, 'abhay@gmail.com', '9cf81ef3f38c537e9940cd770d2513ac9025eb35d027f44ed4372b175032fd80', 5, '47f46dac131a8d7ae24982d2b9e468be', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id_fk`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_manager_fk` (`manager_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id_fk`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_manager_fk` FOREIGN KEY (`manager_id_fk`) REFERENCES `manager` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
