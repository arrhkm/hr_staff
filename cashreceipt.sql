-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2015 at 09:10 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hr_staff`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashreceipt`
--

CREATE TABLE IF NOT EXISTS `cashreceipt` (
  `emp_id` varchar(15) CHARACTER SET utf8 NOT NULL,
  `period_id` int(11) NOT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`emp_id`,`period_id`),
  KEY `cr_fk_period` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashreceipt`
--
ALTER TABLE `cashreceipt`
  ADD CONSTRAINT `cr_fk_emp` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`),
  ADD CONSTRAINT `cr_fk_period` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
