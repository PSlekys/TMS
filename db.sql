-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2016 at 07:09 PM
-- Server version: 10.0.28-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slscom_tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `programming_languages` varchar(225) NOT NULL COMMENT 'html=0,css=1,JavaScript=2,PHP=3,Ruby=4,java=5,c=6,c++=7,c#=8',
  `code` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `speaking` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `leadership` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `teaching_child` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `translating` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `organize` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `testing` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `talk` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `teach` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `support` tinyint(1) NOT NULL COMMENT 'yes=1,no=0',
  `org` tinyint(1) NOT NULL COMMENT 'yes=1,no=0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
