-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2016 at 07:13 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `kr_article`
--

CREATE TABLE IF NOT EXISTS `kr_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo` text NOT NULL,
  `file_path` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `kr_article`
--

INSERT INTO `kr_article` (`id`, `memo`, `file_path`, `user_id`) VALUES
(1, '', '', 1),
(2, '', '', 2),
(3, 'tetts', '', 3),
(4, 'tetts', '', 4),
(5, '', '', 5),
(6, '', '', 6),
(7, '', '', 7),
(8, '', '', 8),
(9, 'test', '', 9),
(10, 'test', '', 10),
(11, 'test', '', 11),
(12, 'test', '', 12),
(13, 'test', '', 13),
(14, '', '', 14),
(15, 'file', '', 15),
(16, 'file', '', 16),
(17, 'file', '', 17),
(18, 'file', '', 18),
(19, 'test new file', 'article_upload/1464414539doc', 19),
(20, 'test new file', 'article_upload/1464414569.doc', 20),
(21, 'test mail memo', '', 21),
(22, 'test mail memo', '', 22),
(23, 'test mail memo', '', 23),
(24, 'test mail with attachment', 'article_upload/1464423060.doc', 24),
(25, 'test', '', 25),
(26, 'test', '', 26),
(27, 'test', '', 27),
(28, 'test', '', 28),
(29, 'test', '', 29),
(30, 'test', '', 30),
(31, 'test123', '', 31),
(32, 'test123', '', 32),
(33, 'test123', 'article_upload/1464693945.doc', 33),
(34, 'test123', 'article_upload/1464694430.doc', 34),
(35, 'test123', 'article_upload/1464694451.doc', 35),
(36, 'test123', 'article_upload/1464694568.doc', 36),
(37, 'test', 'article_upload/1464694656.doc', 37),
(38, 'test', 'article_upload/1464694716.doc', 38),
(39, 'test', 'article_upload/1464694865.doc', 39);

-- --------------------------------------------------------

--
-- Table structure for table `kr_discount`
--

CREATE TABLE IF NOT EXISTS `kr_discount` (
  `id` int(11) NOT NULL,
  `above10` int(11) NOT NULL,
  `above20` int(11) NOT NULL,
  `above30` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kr_discount`
--

INSERT INTO `kr_discount` (`id`, `above10`, `above20`, `above30`) VALUES
(1, 10, 22, 50);

-- --------------------------------------------------------

--
-- Table structure for table `kr_distributers`
--

CREATE TABLE IF NOT EXISTS `kr_distributers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `First_name` text NOT NULL,
  `Last_name` text NOT NULL,
  `Mailing_address1` text NOT NULL,
  `Mailing_address2` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Zipcode` text NOT NULL,
  `Home_phone` text NOT NULL,
  `Cell_phone` text NOT NULL,
  `Email_address` text NOT NULL,
  `Volunteering` text NOT NULL,
  `Copies_requested` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `User_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Distributer_id` (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kr_distributers`
--

INSERT INTO `kr_distributers` (`id`, `First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`, `State`, `Zipcode`, `Home_phone`, `Cell_phone`, `Email_address`, `Volunteering`, `Copies_requested`, `created`, `User_id`) VALUES
(9, 'jithin', 'p', 'test address', 'test address', 'city', 'state', '12345', '4568998897', '1234567985', 'pjithin512@gmail.com', '1', '1234', '2016-06-15 15:08:00', 71);

-- --------------------------------------------------------

--
-- Table structure for table `kr_payment`
--

CREATE TABLE IF NOT EXISTS `kr_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Subscriber_id` int(11) NOT NULL,
  `Mode_of_pay` text NOT NULL,
  `paypal_status` text NOT NULL,
  `paid_amnt` int(11) NOT NULL,
  `txn_id` text NOT NULL,
  `payer_email` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Subscriber_id` (`Subscriber_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kr_payment`
--

INSERT INTO `kr_payment` (`id`, `Subscriber_id`, `Mode_of_pay`, `paypal_status`, `paid_amnt`, `txn_id`, `payer_email`) VALUES
(7, 41, 'cash', 'Pending', 25, '4UJ7805767094844T', ''),
(8, 42, 'cash', 'Pending', 25, '6MM9972445333470P', ''),
(9, 43, 'cash', 'Completed', 25, '34T64607KX5153056', '');

-- --------------------------------------------------------

--
-- Table structure for table `kr_permissions`
--

CREATE TABLE IF NOT EXISTS `kr_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `create_finance` int(11) NOT NULL,
  `create_national` int(11) NOT NULL,
  `create_zone` int(11) NOT NULL,
  `create_state` int(11) NOT NULL,
  `create_state_zone` int(11) NOT NULL,
  `create_county` int(11) NOT NULL,
  `create_distributor` int(11) NOT NULL,
  `create_subscriber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kr_permissions`
--

INSERT INTO `kr_permissions` (`id`, `type`, `create_finance`, `create_national`, `create_zone`, `create_state`, `create_state_zone`, `create_county`, `create_distributor`, `create_subscriber`) VALUES
(1, 'webadmin', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'finance', 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'national', 0, 0, 1, 1, 1, 1, 1, 1),
(4, 'zone', 0, 0, 0, 1, 1, 1, 1, 1),
(5, 'state', 0, 0, 0, 0, 1, 1, 1, 1),
(6, 'state_zone', 0, 0, 0, 0, 0, 1, 1, 1),
(7, 'county', 0, 0, 0, 0, 0, 0, 1, 1),
(8, 'distributer', 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kr_state`
--

CREATE TABLE IF NOT EXISTS `kr_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `State_name` text NOT NULL,
  `Zone_id` int(11) NOT NULL,
  `State_admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `kr_state`
--

INSERT INTO `kr_state` (`id`, `State_name`, `Zone_id`, `State_admin_id`) VALUES
(1, 'Alabama', 22, 0),
(2, 'Alaska', 22, 23),
(3, 'Arizona', 35, 0),
(4, 'Arkansas', 35, 0),
(5, 'California', 22, 0),
(6, 'Colorado', 42, 0),
(7, 'Connecticut', 42, 0),
(8, 'D.C.', 0, 0),
(9, 'Delaware', 0, 0),
(10, 'Florida', 0, 0),
(11, 'Georgia', 0, 0),
(12, 'Hawaii', 0, 0),
(13, 'Idaho', 0, 0),
(14, 'Illinois', 0, 0),
(15, 'Indiana', 0, 0),
(16, 'Iowa', 0, 0),
(17, 'Kansas', 0, 0),
(18, 'Kentucky', 0, 0),
(19, 'Louisiana', 0, 0),
(20, 'Maine', 0, 0),
(21, 'Maryland', 0, 0),
(22, 'Massachusetts', 0, 0),
(23, 'Michigan', 0, 0),
(24, 'Minnesota', 0, 0),
(25, 'Mississippi', 0, 0),
(26, 'Missouri', 0, 0),
(27, 'Montana', 0, 0),
(28, 'Nebraska', 0, 0),
(29, 'Nevada', 0, 0),
(30, 'New Hampshire', 0, 0),
(31, 'New Jersey', 0, 0),
(32, 'New Mexico', 0, 0),
(33, 'New York', 0, 0),
(34, 'North Carolina', 0, 0),
(35, 'North Dakota', 0, 0),
(36, 'Ohio', 0, 0),
(37, 'Oklahoma', 0, 0),
(38, 'Oregon', 0, 0),
(39, 'Pennsylvania', 0, 0),
(40, 'Rhode Island', 0, 0),
(41, 'South Carolina', 0, 0),
(42, 'South Dakota', 0, 0),
(43, 'Tennessee', 0, 0),
(44, 'Texas', 0, 0),
(45, 'Utah', 0, 0),
(46, 'Vermont', 0, 0),
(47, 'Virginia', 0, 0),
(48, 'Washington', 0, 0),
(49, 'West Virginia', 0, 0),
(50, 'Wisconsin', 0, 0),
(51, 'Wyoming', 0, 0),
(52, 'Other', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kr_style`
--

CREATE TABLE IF NOT EXISTS `kr_style` (
  `id` int(11) NOT NULL,
  `BackgroundImage` text NOT NULL,
  `BookImage` text NOT NULL,
  `MenuBackgorund` text NOT NULL,
  `MenuColor` text NOT NULL,
  `HeaderText` text NOT NULL,
  `FooterColor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kr_style`
--

INSERT INTO `kr_style` (`id`, `BackgroundImage`, `BookImage`, `MenuBackgorund`, `MenuColor`, `HeaderText`, `FooterColor`) VALUES
(1, 'background/backgroundimg.jpg', '/', '#000', 'red', '', 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `kr_subscribers`
--

CREATE TABLE IF NOT EXISTS `kr_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Subscriber_id` varchar(10) NOT NULL,
  `First_name` text NOT NULL,
  `Last_name` text NOT NULL,
  `Mailing_address1` text NOT NULL,
  `Mailing_address2` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Zipcode` text NOT NULL,
  `BillingAddress1` text NOT NULL,
  `BillingAddress2` text NOT NULL,
  `BillingCity` text NOT NULL,
  `BillingState` text NOT NULL,
  `BillingZip` text NOT NULL,
  `Home_phone` text NOT NULL,
  `Cell_phone` text NOT NULL,
  `Email_address` text NOT NULL,
  `Church_name` text NOT NULL,
  `Subscriptions` text NOT NULL,
  `No_of_copies` int(11) NOT NULL,
  `Total_amount` int(11) NOT NULL,
  `Enter_by` text NOT NULL,
  `Mode_of_payment` text NOT NULL,
  `Cash_Check_by` text NOT NULL,
  `comments` text NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Distributer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Distributer_id` (`Distributer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `kr_subscribers`
--

INSERT INTO `kr_subscribers` (`id`, `Subscriber_id`, `First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`, `State`, `Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`, `BillingState`, `BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`, `Church_name`, `Subscriptions`, `No_of_copies`, `Total_amount`, `Enter_by`, `Mode_of_payment`, `Cash_Check_by`, `comments`, `subscription_date`, `Distributer_id`) VALUES
(41, '', 'jithin', 'jithin', 'test mail', 'test', 'test', 'state', '123', 'test mail', 'test', 'test', 'state', '123', '9746911668', '9746911668', 'jithin@ksofttechnologies.com', 'test', '25', 0, 0, '', 'cash', '', '', '2016-06-16 03:58:16', 71),
(42, '', 'asdsd', 'jithin', 'jithin', 'rt', 'jithin', 'jithin', '123', 'jithin', 'rt', 'jithin', 'jithin', '123', '9746911668', '9746911668', 'jithin123@ksofttechnologies.com', 'test', '25', 0, 0, '', 'cash', '', '', '2016-06-16 04:02:29', 0),
(43, '', 'jithin', 'test', 'test mail', 'rt', 'jithin', 'state', '123', 'test mail', 'rt', 'jithin', 'state', '123', '9746911668', '9746911668', 'jithinjithin@ksofttechnologies.com', 'tets', '25', 0, 0, '', 'cash', '', '', '2016-06-15 15:26:03', 71);

-- --------------------------------------------------------

--
-- Table structure for table `kr_users`
--

CREATE TABLE IF NOT EXISTS `kr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Distributer_id` varchar(11) NOT NULL,
  `First_name` text NOT NULL,
  `Name` varchar(50) NOT NULL COMMENT 'to save co-ordinator name',
  `Email_address` text NOT NULL,
  `Password` text NOT NULL,
  `Address1` text NOT NULL,
  `Address2` text NOT NULL,
  `State` text NOT NULL,
  `Zip` text NOT NULL,
  `Phone_Home` text NOT NULL,
  `Phone_Cell` text NOT NULL,
  `National_admin_id` int(11) NOT NULL,
  `Zonal_admin_id` int(11) NOT NULL,
  `State_admin_id` int(11) NOT NULL,
  `State_zone_admin_id` int(11) NOT NULL,
  `County_admin_id` int(11) NOT NULL,
  `admin_type` text NOT NULL,
  `flag` enum('0','1') NOT NULL DEFAULT '0',
  `security_a` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `kr_users`
--

INSERT INTO `kr_users` (`id`, `Distributer_id`, `First_name`, `Name`, `Email_address`, `Password`, `Address1`, `Address2`, `State`, `Zip`, `Phone_Home`, `Phone_Cell`, `National_admin_id`, `Zonal_admin_id`, `State_admin_id`, `State_zone_admin_id`, `County_admin_id`, `admin_type`, `flag`, `security_a`, `created_date`) VALUES
(15, '', 'webadmin', '', 'webadmin@admin.com', '123', 'test', 'test', 'Alaska', '33', '33', '3', 0, 0, 0, 0, 0, 'webadmin', '0', 123, '2016-06-15 12:40:59'),
(69, '', 'financial', '', 'financial@admin.com', '123', 'address1', 'address2', 'Alabama', '123456', '7894561235', '7894568797', 0, 0, 0, 0, 0, 'finance', '0', 0, '2016-06-15 14:59:36'),
(70, '', 'national', '', 'national@admin.com', '123', 'address1', 'address2', 'Alabama', '123456', '9746911668', '974691168', 0, 0, 0, 0, 0, 'national', '0', 0, '2016-06-16 04:36:50'),
(71, '', 'jithin', '', 'pjithin512@gmail.com', '123', '', '', '', '', '', '', 70, 72, 73, 74, 0, 'Distributer', '1', 0, '2016-06-16 03:57:57'),
(72, '', 'zone A', 'zonal admin', 'zone@admin.com', '123', 'admin', 'admin', 'Alabama', '123456', '7894561235', '974691168', 70, 0, 0, 0, 0, 'zone', '0', 0, '2016-06-15 15:10:38'),
(73, '', 'Alabama', 'jithin state', 'email@email.com', '123', 'address1', 'address2', 'Alaska', '123456', '1234567890', '1234567789', 70, 72, 0, 0, 0, 'state', '0', 0, '2016-06-15 15:21:30'),
(74, '', 'new state zone', 'jithin', 'pjithin512@gmail.com', '123', 'jithin', 'address2', 'Alabama', '123456', '1231231231', '1231232132', 70, 72, 73, 0, 0, 'state_zone', '0', 0, '2016-06-15 15:23:23'),
(75, '', 'east zone', 'harish', 'harish@admin.com', '123', 'test', 'test', 'Alabama', '123456', '6589564562', '123', 70, 0, 0, 0, 0, 'zone', '0', 0, '2016-06-16 04:12:41'),
(76, '', 'west zone', 'test', 'test@test.com', '123', 'test', 'test', 'Arkansas', '5757', '757', '5675757', 70, 0, 0, 0, 0, 'zone', '0', 0, '2016-06-16 04:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `kr_vol_times`
--

CREATE TABLE IF NOT EXISTS `kr_vol_times` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day` varchar(15) NOT NULL,
  `tim` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`day`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kr_vol_times`
--

INSERT INTO `kr_vol_times` (`id`, `user_id`, `day`, `tim`) VALUES
(7, 59, '06/22/2016', '495'),
(8, 59, '06/21/2016', '195');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_config`
--

CREATE TABLE IF NOT EXISTS `smtp_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` text NOT NULL,
  `port` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `notify_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smtp_config`
--

INSERT INTO `smtp_config` (`id`, `host`, `port`, `username`, `password`, `from_name`, `from_email`, `notify_email`) VALUES
(1, 'mail.smtp2go.com', '2525', 'jithin@ksofttechnologies.com', 'iGhTsfkvcT3T', 'Sehion Usa', 'no-rply@sehionusa.org', 'harish@ksofttechnologies.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kr_payment`
--
ALTER TABLE `kr_payment`
  ADD CONSTRAINT `kr_payment_ibfk_1` FOREIGN KEY (`Subscriber_id`) REFERENCES `kr_subscribers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
