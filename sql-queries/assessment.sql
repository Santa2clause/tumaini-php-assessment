-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 10:31 AM
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
-- Database: `assessment`
--
CREATE DATABASE IF NOT EXISTS `assessment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `assessment`;

-- --------------------------------------------------------

--
-- Table structure for table `table_currencies`
--

DROP TABLE IF EXISTS `table_currencies`;
CREATE TABLE `table_currencies` (
  `sTicker` varchar(12) NOT NULL,
  `sName` varchar(224) NOT NULL,
  `sLName` varchar(244) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_currencies`
--

INSERT INTO `table_currencies` (`sTicker`, `sName`, `sLName`, `DateTime`) VALUES
('USD-AUD', 'C-$-AUS$', 'US DOLLAR / AUSTRALIAN DOLLAR', '2022-05-30 13:46:56'),
('C-$-BRL', 'C-$-BRL', 'US DOLLAR / BRAZILIAN REAL', '2022-05-30 13:46:56'),
('USDCAD', 'C-$-CAD', 'US DOLLAR / CANADIAN DOLLAR', '2022-05-30 13:46:56'),
('C-$-ETHER', 'C-$-ETHER', 'ETHEREUM CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('USDEUR', 'C-$-EURO', 'US DOLLAR / EURO', '2022-05-30 13:46:56'),
('C-$-GBP', 'C-$-GBP', 'US DOLLAR / BRITISH POUND', '2022-05-30 13:46:56'),
('USD-JPY', 'C-$-JYEN', 'US DOLLAR / JAPANESE YEN', '2022-05-30 13:46:56'),
('C-$-KRW', 'C-$-KRW', 'US DOLLAR / SOUTH KOREAN WON', '2022-05-30 13:46:56'),
('C-$-MEXP', 'C-$-MEXP', 'US DOLLAR / MEXICAN PESO', '2022-05-30 13:46:56'),
('C-$-PULA', 'C-$-PULA', 'US DOLLAR / BOTSWANA PULA', '2022-05-30 13:46:56'),
('USD-CHF', 'C-$-SWFR', 'US DOLLAR / SWISS FRANC', '2022-05-30 13:46:56'),
('C-$-TWD', 'C-$-TWD', 'US DOLLAR / TAIWANESE DOLLAR', '2022-05-30 13:46:56'),
('C-$BTCOIN', 'C-$BTCOIN', 'BITCOIN SPOT PRICE USD', '2022-05-30 13:46:56'),
('C-$DASH', 'C-$DASH', 'DASH CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('C-$LTCOIN', 'C-$LTCOIN', 'LITECOIN CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('C-$MONERO', 'C-$MONERO', 'MONERO CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('C-$RIPPLE', 'C-$RIPPLE', 'RIPPLE CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('USD-ZAR', 'C-$ZAR-AM', 'US DOLLAR / RAND - MORNING', '2022-05-30 13:46:56'),
('C-$ZAR-PM', 'C-$ZAR-PM', 'US DOLLAR / RAND - EVENING', '2022-05-30 13:46:56'),
('C-$ZCASH', 'C-$ZCASH', 'ZCASH CRYPTO CURRENCY USD', '2022-05-30 13:46:56'),
('AUDZAR', 'C-AUD$ZAR', 'AUSTRALIAN DOLLAR / SOUTH AFRICAN RAND', '2022-05-30 13:46:56'),
('EUR-USD', 'C-EUR-$', 'EURO/US DOLLAR', '2022-05-30 13:46:56'),
('EURCHF', 'C-EUR-CHF', 'EURO / SWISS FRANC', '2022-05-30 13:46:56'),
('EURGBP', 'C-EUR-GBP', 'EURO / BRITISH POUND', '2022-05-30 13:46:56'),
('EURJPY', 'C-EUR-YEN', 'EURO / YEN', '2022-05-30 13:46:56'),
('C-EUR-ZAR', 'C-EUR-ZAR', 'EURO/RAND', '2022-05-30 13:46:56'),
('C-GBP-$', 'C-GBP-$', 'UK POUND / US DOLLAR', '2022-05-30 13:46:56'),
('C-GBP-YEN', 'C-GBP-YEN', 'BRITISH POUND / JAPANESE YEN', '2022-05-30 13:46:56'),
('GBP-ZAR', 'C-GBP-ZAR', 'BRITISH POUND / RAND', '2022-05-30 13:46:56'),
('C-R-JYEN', 'C-R-JYEN', 'RAND / JAPANESE YEN', '2022-05-30 13:46:56'),
('C-R-SWFR', 'C-R-SWFR', 'RAND / SWISS FRANC', '2022-05-30 13:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `table_user_watchlist`
--

DROP TABLE IF EXISTS `table_user_watchlist`;
CREATE TABLE `table_user_watchlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `sTicker` varchar(24) NOT NULL,
  `sValue` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_user_watchlist`
--

INSERT INTO `table_user_watchlist` (`id`, `user_id`, `sTicker`, `sValue`) VALUES
(14, 1, 'USDEUR', '850.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_user_watchlist`
--
ALTER TABLE `table_user_watchlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique` (`sTicker`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_user_watchlist`
--
ALTER TABLE `table_user_watchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
