-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 01:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `crypto_transactions`
--

CREATE TABLE `crypto_transactions` (
  `id` int(11) NOT NULL,
  `title` varchar(66) NOT NULL,
  `amount` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `link` varchar(175) NOT NULL,
  `date` varchar(66) NOT NULL,
  `status` varchar(44) NOT NULL,
  `username` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(77) NOT NULL,
  `amount` varchar(33) NOT NULL,
  `currency` varchar(11) NOT NULL,
  `ref_id` varchar(77) NOT NULL,
  `wallet` varchar(99) NOT NULL,
  `private_key` varchar(225) NOT NULL,
  `points` varchar(99) NOT NULL,
  `rewards` varchar(99) NOT NULL,
  `customer` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `email`, `amount`, `currency`, `ref_id`, `wallet`, `private_key`, `points`, `rewards`, `customer`) VALUES
(1, 'Austin Andy', 'andybugz2000@gmail.com', '50000', 'USD', 'ch_3LCJXXFgEMBO9MVB1qKkBbay', '0x746EAC51fecf231Fca848dab36cE5eB1D9cB3746', '51358b93ae0d68ecb4e0be3ed89515b579c757d64f7310c9f6620fc1505e7312', '50', '0.005', 'cus_Lu7nh8ZRdvwgNs'),
(2, 'Sam ken', 'andybugz2000@gmail.com', '250', 'USD', 'ch_3LCJgaFgEMBO9MVB1tDIeOQR', '0xaccb9CF3916EbB714a47DEDdBA56B9EDd53C4C95', 'c71bf9c4f32c8449dff06d048a306166b6d8a8ba27e848ba00bd29cc4fed76da', '0.125', '0.00125', 'cus_Lu7wzLhMbBgfhU'),
(3, 'Ade', 'bug@bug.com', '9.5', 'USD', 'ch_3LCK6tFgEMBO9MVB1bBc96F0', '0xdB10B122671F43140FCF841628AA0Ca7B6E42D70', '4a5046d8187ba8a90e6dfaf786d745c2ebb641c9854a34ed31a68ac15e62de1d', '0.0475', '4.75E-5', 'cus_Lu8NQqEDfz387A'),
(4, 'Rasheed', 'bug@bug.com', '9.5', 'USD', 'ch_3LCfaKFgEMBO9MVB1pJqpFPh', '0x71E477D9C098f52860d430D952a7e6a72594b354', '5341afb8b081c5df06d7a09d25e17d0efd6458faca118ebd924a3bae8e692909', '0.0475', '4.75E-5', 'cus_LuUZUcxzDyLw0y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(77) NOT NULL,
  `password` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(13, 'Austin Andy', 'andybugz2000@gmail.com', '68e188e825d707bb0e'),
(14, 'Sam ken', 'andybugz2000@gmail.com', 'e5805c181650fc5420'),
(15, 'Ade', 'bug@bug.com', '2b1b3d411ee12cf223'),
(16, 'Rasheed', 'bug@bug.com', '40f9641c2a9df01a7f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_transactions`
--
ALTER TABLE `crypto_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crypto_transactions`
--
ALTER TABLE `crypto_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
