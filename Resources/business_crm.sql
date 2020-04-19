-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2020 at 12:04 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_management`
--

CREATE TABLE `admin_management` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Primary key, Auto increment',
  `is_super` tinyint(3) UNSIGNED NOT NULL COMMENT '1 : Super Admin 2 : Admin',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `password` varchar(250) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '1 Active 0 Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_management`
--

INSERT INTO `admin_management` (`id`, `is_super`, `first_name`, `last_name`, `email`, `mobile`, `password`, `profile_pic`, `created_date`, `created_by`, `modified_date`, `modified_by`, `status`) VALUES
(1, 1, 'dhaval', 'panchal', 'dhaval@topsinfosolutions.com', '8469195096', 'RkpPaGtLa2dNNVkwMjR3ZVEzOEZSZz09', '', '2017-02-13 14:49:12', 0, '2020-04-19 11:47:46', 0, 1),
(6, 0, 'meet', 'patel', 'mit@topsinfosolutions.com', '9876543210', 'RkpPaGtLa2dNNVkwMjR3ZVEzOEZSZz09', '', '2018-07-04 01:25:17', 0, '2020-04-19 11:48:50', 0, 1),
(7, 0, 'parag', 'joshir', 'parag@topsinfosolutions.com', '9876543210', 'RkpPaGtLa2dNNVkwMjR3ZVEzOEZSZz09', '1e7f134c43f41b96270f25cd2b7293e5_200419105904.jpeg', '2018-07-04 02:23:28', 0, '2020-04-19 11:48:53', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings_master`
--

CREATE TABLE `settings_master` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_paypal_email` varchar(100) NOT NULL,
  `admin_commission` tinyint(1) NOT NULL,
  `charity_commission` tinyint(1) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `protocol` varchar(20) NOT NULL,
  `smtp_port` varchar(20) NOT NULL,
  `smtp_timeout` varchar(20) NOT NULL,
  `current_version` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_master`
--

INSERT INTO `settings_master` (`id`, `sitename`, `address1`, `address2`, `contact_number`, `contact_email`, `admin_email`, `admin_paypal_email`, `admin_commission`, `charity_commission`, `smtp_host`, `smtp_user`, `smtp_pass`, `protocol`, `smtp_port`, `smtp_timeout`, `current_version`) VALUES
(1, 'Business CRM', 'NR SUPER HIGHSCHOOL', 'Ellisbridge, Ashram Road, Ahmedabad, Gujarat ,380006', '8469195096', 'pdpanchalmec@gmail.com', 'pdpanchalmec@gmail.com', 'sachin-facilitator@topsinfosolutions.com', 10, 5, 'ssl://smtp.googlemail.com', 'pdpanchalmec@gmail.com', 'RlRpU29CUWkvVVltVWt2emxEQ1FvQT09', 'smtp', '465', '60', 'v.1.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_management`
--
ALTER TABLE `admin_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `settings_master`
--
ALTER TABLE `settings_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_management`
--
ALTER TABLE `admin_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key, Auto increment', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `settings_master`
--
ALTER TABLE `settings_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
