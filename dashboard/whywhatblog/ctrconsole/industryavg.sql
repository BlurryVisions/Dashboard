-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2020 at 04:52 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcurve`
--

-- --------------------------------------------------------

--
-- Table structure for table `industryavg`
--

CREATE TABLE `industryavg` (
  `vertical` varchar(100) NOT NULL,
  `hcctr` float NOT NULL,
  `avgctr` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industryavg`
--

INSERT INTO `industryavg` (`vertical`, `hcctr`, `avgctr`) VALUES
('Banking', 0.72, 0.2),
('Classifieds', 0.38, 0.3),
('consumer goods', 0.98, 0.2),
('E-Commerce', 1.11, 0.45),
('Education', 0.17, 0.22),
('Employment Services', 0.36, 0.13),
('Entertainment', 0.49, 0.4),
('Event', 0.19, 0.1),
('Finance & Insurance', 0.23, 0.33),
('Food', 0.61, 0.2),
('Games', 0.43, 0.3),
('Health & Medical', 0.42, 0.31),
('Hosting', 0.28, 0.2),
('OTT', 1.08, 0.4),
('Real Estate', 0.38, 0.24),
('sports', 0.99, 0.4),
('Travel & Hospitality', 1.37, 0.47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `industryavg`
--
ALTER TABLE `industryavg`
  ADD PRIMARY KEY (`vertical`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
