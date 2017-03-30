-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2015 at 12:11 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `date_job` date NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `h_in` time DEFAULT NULL,
  `h_out` time DEFAULT NULL,
  `dt_in` datetime DEFAULT NULL,
  `dt_out` datetime DEFAULT NULL,
  PRIMARY KEY (`date_job`,`emp_id`),
  KEY `fk_attendance_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` varchar(20) NOT NULL,
  `namebrach` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `date_create` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_card_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cardlsf`
--

CREATE TABLE IF NOT EXISTS `cardlsf` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `date_create` date DEFAULT NULL,
  `sensorid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `cicilan`
--

CREATE TABLE IF NOT EXISTS `cicilan` (
  `id` int(11) NOT NULL,
  `no_angsuran` int(11) DEFAULT NULL,
  `date_cicil` date DEFAULT NULL,
  `value_cicil` decimal(10,0) DEFAULT NULL,
  `kasbon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cicilan_kasbon1_idx` (`kasbon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE IF NOT EXISTS `cuti` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `des` varchar(45) NOT NULL,
  `accepted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`emp_id`),
  KEY `fk_cuti_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dayoff`
--

CREATE TABLE IF NOT EXISTS `dayoff` (
  `id` date NOT NULL,
  `period_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `describe_off` text,
  PRIMARY KEY (`id`),
  KEY `fk_dayoff_periode1_idx` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departement_manager1_idx` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detilcuti`
--

CREATE TABLE IF NOT EXISTS `detilcuti` (
  `id` int(11) NOT NULL,
  `cuti_id` int(11) NOT NULL,
  `cuti_emp_id` varchar(15) NOT NULL,
  `kodecuti_id` int(11) NOT NULL,
  `date_cuti` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detilcuti_cuti1_idx` (`cuti_id`,`cuti_emp_id`),
  KEY `fk_detilcuti_kodecuti1_idx` (`kodecuti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE IF NOT EXISTS `emp` (
  `id` varchar(15) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `start_job` date DEFAULT NULL,
  `warm_contract` tinyint(1) DEFAULT NULL,
  `warm_date` date DEFAULT NULL,
  `citizen_id` varchar(19) DEFAULT NULL,
  `jamsostek_id` varchar(45) DEFAULT NULL,
  `bank_account` varchar(45) DEFAULT NULL,
  `npwp` varchar(45) DEFAULT NULL,
  `gp` decimal(10,2) DEFAULT NULL,
  `tmasakerja` decimal(10,2) DEFAULT NULL,
  `tjabatan` decimal(10,2) DEFAULT NULL,
  `tfunctional` decimal(10,2) DEFAULT NULL,
  `allowance` decimal(10,2) DEFAULT NULL,
  `premi_hadir` decimal(10,2) NOT NULL,
  `uang_makan` decimal(10,2) NOT NULL,
  `dapen` decimal(10,2) DEFAULT NULL,
  `stock_cuti` int(3) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `partjob_id` int(11) DEFAULT NULL,
  `jobtitle_id` int(11) DEFAULT NULL,
  `officetime_id` int(11) NOT NULL DEFAULT '1',
  `non_aktif` tinyint(1) NOT NULL,
  `branch_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_emp_partjob1_idx` (`partjob_id`),
  KEY `fk_emp_jobtitle1_idx` (`jobtitle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emplate`
--

CREATE TABLE IF NOT EXISTS `emplate` (
  `period_id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `late_summary` int(11) DEFAULT NULL,
  `status_late` tinyint(1) DEFAULT NULL,
  `send_late` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`period_id`,`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `engineatt`
--

CREATE TABLE IF NOT EXISTS `engineatt` (
  `pin` int(11) NOT NULL,
  `dateatt` datetime NOT NULL,
  `verified` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`pin`,`dateatt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `engineatt2`
--

CREATE TABLE IF NOT EXISTS `engineatt2` (
  `pin` int(11) NOT NULL,
  `dateatt` datetime NOT NULL,
  `verified` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `engineattlsf`
--

CREATE TABLE IF NOT EXISTS `engineattlsf` (
  `pin` int(11) NOT NULL,
  `dateatt` datetime NOT NULL,
  `status` char(1) DEFAULT NULL,
  `machine_id` int(11) NOT NULL,
  PRIMARY KEY (`pin`,`dateatt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `insentif`
--

CREATE TABLE IF NOT EXISTS `insentif` (
  `id` int(11) NOT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `period_id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_insentif_period1_idx` (`period_id`),
  KEY `fk_insentif_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobtitle`
--

CREATE TABLE IF NOT EXISTS `jobtitle` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kasbon`
--

CREATE TABLE IF NOT EXISTS `kasbon` (
  `id` int(11) NOT NULL,
  `kasbon_date` date DEFAULT NULL,
  `kasbon_value` decimal(10,0) DEFAULT NULL,
  `kasbon_closing` tinyint(1) DEFAULT '0',
  `emp_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kasbon_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kodecuti`
--

CREATE TABLE IF NOT EXISTS `kodecuti` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `limit_cuti` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `emp_id` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_manager_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `officetime`
--

CREATE TABLE IF NOT EXISTS `officetime` (
  `id` int(11) NOT NULL,
  `name_time` varchar(32) DEFAULT NULL,
  `must_in` time DEFAULT NULL,
  `must_out` time DEFAULT NULL,
  `limit_in_start` time DEFAULT NULL,
  `limit_in_last` time DEFAULT NULL,
  `limit_out_start` time DEFAULT NULL,
  `limit_out_last` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `outarea_has_emp`
--

CREATE TABLE IF NOT EXISTS `outarea_has_emp` (
  `emp_id` varchar(15) NOT NULL,
  `dateout` date NOT NULL,
  `desout` varchar(50) NOT NULL,
  PRIMARY KEY (`emp_id`,`dateout`),
  KEY `fk_outarea_has_emp_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE IF NOT EXISTS `overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(15) NOT NULL,
  `date_ot` date DEFAULT NULL,
  `value_ot` int(11) DEFAULT NULL,
  `des` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`emp_id`),
  KEY `fk_overtime_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `partjob`
--

CREATE TABLE IF NOT EXISTS `partjob` (
  `id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_partjob_departement1_idx` (`departement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `id` int(11) NOT NULL,
  `period_id` int(11) DEFAULT NULL,
  `emp_id` varchar(15) DEFAULT NULL,
  `gpokok` decimal(10,2) DEFAULT NULL,
  `glembur` decimal(10,2) DEFAULT NULL,
  `tjabatan` decimal(10,2) DEFAULT NULL,
  `tfunctional` decimal(10,2) DEFAULT NULL,
  `allowence` decimal(10,2) DEFAULT NULL,
  `premi_hadir` decimal(10,2) DEFAULT NULL,
  `bank_account` varchar(45) DEFAULT NULL,
  `tkesehatan` decimal(10,2) DEFAULT NULL,
  `ntelat` smallint(6) DEFAULT NULL,
  `nhadir` smallint(6) DEFAULT NULL,
  `nalpha` smallint(6) DEFAULT NULL,
  `ncuti` smallint(6) DEFAULT NULL,
  `nsakit` smallint(6) DEFAULT NULL,
  `nijin` smallint(6) DEFAULT NULL,
  `ndinasluar` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payroll_periode1_idx` (`period_id`),
  KEY `fk_payroll_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
  `id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `period_name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_month_UNIQUE` (`period_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE IF NOT EXISTS `permit` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `need` varchar(45) DEFAULT NULL,
  `describe_need` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`emp_id`),
  KEY `fk_permit_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permitcode`
--

CREATE TABLE IF NOT EXISTS `permitcode` (
  `id` varchar(5) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permitdetil`
--

CREATE TABLE IF NOT EXISTS `permitdetil` (
  `id` int(11) NOT NULL,
  `date_permit` date DEFAULT NULL,
  `permit_id` int(11) NOT NULL,
  `permit_emp_id` varchar(15) NOT NULL,
  `permitcode_id` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_permitdetil_permit1_idx` (`permit_id`,`permit_emp_id`),
  KEY `fk_permitdetil_permitcode1_idx` (`permitcode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `premiperiod`
--

CREATE TABLE IF NOT EXISTS `premiperiod` (
  `emp_id` varchar(15) NOT NULL,
  `period_id` int(11) NOT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`emp_id`,`period_id`),
  KEY `period_id` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serviceout`
--

CREATE TABLE IF NOT EXISTS `serviceout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(15) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`emp_id`),
  KEY `fk_service_out_emp1_idx` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `shift_office`
--

CREATE TABLE IF NOT EXISTS `shift_office` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `must_on` time DEFAULT NULL,
  `must_off` time DEFAULT NULL,
  PRIMARY KEY (`id`,`emp_id`),
  KEY `fk_shift_office_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suratdokter`
--

CREATE TABLE IF NOT EXISTS `suratdokter` (
  `id` int(11) NOT NULL,
  `date_sick` date DEFAULT NULL,
  `no_surat` varchar(45) DEFAULT NULL,
  `dokter_name` varchar(45) DEFAULT NULL,
  `emp_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_suratdokter_emp1_idx` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terlambat`
--

CREATE TABLE IF NOT EXISTS `terlambat` (
  `date_terlambat` date NOT NULL,
  `emp_id` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `dt_in` datetime DEFAULT NULL,
  `dt_out` datetime DEFAULT NULL,
  `value_late` int(11) DEFAULT NULL,
  PRIMARY KEY (`date_terlambat`,`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `tolate`
--
CREATE TABLE IF NOT EXISTS `tolate` (
`date_job` date
,`emp_id` varchar(15)
,`h_in` time
,`h_out` time
,`dt_in` datetime
,`dt_out` datetime
,`jam` bigint(10)
,`batas` bigint(10)
,`telat` int(1)
,`name` varchar(45)
);
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_backup`
--

CREATE TABLE IF NOT EXISTS `user_backup` (
  `id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `tolate`
--
DROP TABLE IF EXISTS `tolate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tolate` AS select `a`.`date_job` AS `date_job`,`a`.`emp_id` AS `emp_id`,`a`.`h_in` AS `h_in`,`a`.`h_out` AS `h_out`,`a`.`dt_in` AS `dt_in`,`a`.`dt_out` AS `dt_out`,time_to_sec(cast(`a`.`dt_in` as time)) AS `jam`,time_to_sec('08:05:59') AS `batas`,if((time_to_sec(cast(`a`.`dt_in` as time)) > time_to_sec('08:05:59')),1,0) AS `telat`,`b`.`name` AS `name` from (`attendance` `a` join `emp` `b` on((`b`.`id` = `a`.`emp_id`))) where ((`a`.`date_job` = curdate()) and (if((time_to_sec(cast(`a`.`dt_in` as time)) > time_to_sec('08:05:59')),1,0) = 1)) order by time_to_sec(cast(`a`.`dt_in` as time)) desc;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cashreceipt`
--
ALTER TABLE `cashreceipt`
  ADD CONSTRAINT `cr_fk_emp` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`),
  ADD CONSTRAINT `cr_fk_period` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`);

--
-- Constraints for table `cicilan`
--
ALTER TABLE `cicilan`
  ADD CONSTRAINT `fk_cicilan_kasbon1` FOREIGN KEY (`kasbon_id`) REFERENCES `kasbon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `fk_cuti_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dayoff`
--
ALTER TABLE `dayoff`
  ADD CONSTRAINT `fk_dayoff_periode1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `fk_departement_manager1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detilcuti`
--
ALTER TABLE `detilcuti`
  ADD CONSTRAINT `fk_detilcuti_cuti1` FOREIGN KEY (`cuti_id`, `cuti_emp_id`) REFERENCES `cuti` (`id`, `emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detilcuti_kodecuti1` FOREIGN KEY (`kodecuti_id`) REFERENCES `kodecuti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp`
--
ALTER TABLE `emp`
  ADD CONSTRAINT `fk_emp_jobtitle1` FOREIGN KEY (`jobtitle_id`) REFERENCES `jobtitle` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emp_partjob1` FOREIGN KEY (`partjob_id`) REFERENCES `partjob` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `insentif`
--
ALTER TABLE `insentif`
  ADD CONSTRAINT `fk_insentif_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_insentif_period1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kasbon`
--
ALTER TABLE `kasbon`
  ADD CONSTRAINT `fk_kasbon_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `fk_manager_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `outarea_has_emp`
--
ALTER TABLE `outarea_has_emp`
  ADD CONSTRAINT `fk_outarea_has_emp_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `fk_overtime_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partjob`
--
ALTER TABLE `partjob`
  ADD CONSTRAINT `fk_partjob_departement1` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payroll_periode1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `fk_permit_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permitdetil`
--
ALTER TABLE `permitdetil`
  ADD CONSTRAINT `fk_permitdetil_permit1` FOREIGN KEY (`permit_id`, `permit_emp_id`) REFERENCES `permit` (`id`, `emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permitdetil_permitcode1` FOREIGN KEY (`permitcode_id`) REFERENCES `permitcode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `premiperiod`
--
ALTER TABLE `premiperiod`
  ADD CONSTRAINT `premiperiod_ibfk_1` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`);

--
-- Constraints for table `serviceout`
--
ALTER TABLE `serviceout`
  ADD CONSTRAINT `fk_service_out_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shift_office`
--
ALTER TABLE `shift_office`
  ADD CONSTRAINT `fk_shift_office_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `suratdokter`
--
ALTER TABLE `suratdokter`
  ADD CONSTRAINT `fk_suratdokter_emp1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
