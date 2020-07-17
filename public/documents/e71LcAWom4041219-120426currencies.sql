-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2019 at 09:51 AM
-- Server version: 5.6.43
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciprocur_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `cur_id` int(11) NOT NULL,
  `currency` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `curr_abrev` char(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `curr_symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `hundreds_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `auto_update` tinyint(1) NOT NULL DEFAULT '1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`cur_id`, `currency`, `curr_abrev`, `curr_symbol`, `country`, `hundreds_name`, `auto_update`, `inactive`) VALUES
(1, 'US Dollars', 'USD', '$', 'United States', 'Cents', 1, 0),
(2, 'Naira', 'NGN', '₦', 'Nigeria', 'Kobo', 1, 0),
(3, 'Pounds', 'GBP', '£', 'England', 'Pence', 1, 0),
(4, 'Euro', 'EUR', '€', 'Europe', 'Cents', 1, 0),
(5, 'CA Dollars', 'CAD', '$', 'Canada', 'Cents', 1, 0),
(6, 'YEN', 'YEN', '¥', 'Japan', 'Sen', 1, 0),
(7, 'AED', 'AED', 'AED', 'UAE', 'AED', 1, 0),
(8, ' Indian Rupee', 'INR', 'INR', 'India', 'INR', 1, 0),
(9, 'SA Rand', 'R', 'R', 'South Africa', 'R', 1, 0),
(10, 'SWISS FRANC', 'Fr', 'Franc', 'SWISS FRANC\r\n', 'Franc', 1, 0),
(11, 'CFA', 'CFA', 'CFA', 'CFA\r\n', 'CFA', 1, 0),
(12, 'SGD', 'SGD', 'SGD', 'Singapore', 'SGD', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`cur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
