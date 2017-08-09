-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2017 at 10:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branchs`
--

CREATE TABLE `tbl_branchs` (
  `branchId` tinyint(4) NOT NULL COMMENT 'role id',
  `name_branch` varchar(100) NOT NULL COMMENT 'role text',
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `info` text NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `updatedDtm` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_branchs`
--

INSERT INTO `tbl_branchs` (`branchId`, `name_branch`, `address`, `phone`, `info`, `isDeleted`, `createdDtm`, `createdBy`, `updatedBy`, `updatedDtm`) VALUES
(1, '1', '1', '1234567890', '1', 1, '2017-06-30 15:52:59', 0, 1, '2017-07-01 10:47:50'),
(2, 'Gading Serpong', 'Ruko Golden 8, E/19, Jl. Ki Hajar Dewantoro,, Pakulonan Bar., Klp. Dua, Gading Serpong, Jawa Barat 15810', '0215421134', 'info@kodekiddo.com', 0, '2017-07-01 09:58:05', 1, 5, '2017-07-11 12:01:14'),
(3, 'Permata Buana', 'Rukan Taman Permata Buana  Jln. Pulau Bira Raya  Blok B9/23, Jakarta Barat', '16507049934 ', 'info@kodekiddo.com', 0, '2017-07-01 10:00:23', 1, 5, '2017-07-11 11:34:10'),
(4, 'Bandung', 'Jln. Pager Gunung no. 13  Bandung, Jawa Barat', '089659038554', 'infodago@kodekiddo.com', 0, '2017-07-08 10:55:51', 5, 5, '2017-07-11 11:58:47'),
(6, 'Jakarta Timur', 'Jakarta Timur', '0987654321', 'cabang ke 4', 1, '2017-08-01 11:41:16', 5, 5, '2017-08-01 11:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `itemId` int(11) NOT NULL,
  `itemHeader` varchar(512) NOT NULL COMMENT 'Heading',
  `itemSub` varchar(1021) NOT NULL COMMENT 'sub heading',
  `itemDesc` text COMMENT 'content or description',
  `itemImage` varchar(80) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`itemId`, `itemHeader`, `itemSub`, `itemDesc`, `itemImage`, `isDeleted`, `createdBy`, `createdDtm`, `updatedDtm`, `updatedBy`) VALUES
(1, 'jquery.validation.js', 'Contribution towards jquery.validation.js', 'jquery.validation.js is the client side javascript validation library authored by Jörn Zaefferer hosted on github for us and we are trying to contribute to it. Working on localization now', 'validation.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL),
(2, 'CodeIgniter User Management', 'Demo for user management system', 'This the demo of User Management System (Admin Panel) using CodeIgniter PHP MVC Framework and AdminLTE bootstrap theme. You can download the code from the repository or forked it to contribute. Usage and installation instructions are provided in ReadMe.MD', 'cias.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_milestone`
--

CREATE TABLE `tbl_milestone` (
  `milestoneId` int(11) NOT NULL,
  `description` text NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_milestone`
--

INSERT INTO `tbl_milestone` (`milestoneId`, `description`, `isDeleted`) VALUES
(1, 'Ini', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_history`
--

CREATE TABLE `tbl_payment_history` (
  `paymentId` int(11) NOT NULL,
  `studentId` text NOT NULL,
  `note` text NOT NULL,
  `method` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `allocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_history`
--

INSERT INTO `tbl_payment_history` (`paymentId`, `studentId`, `note`, `method`, `createdBy`, `createdDate`, `nominal`, `allocation`) VALUES
(1, 'Murid_perbu', 'Permbayaran pertama', 'Cash', 5, '08/01/2017', 500000, 4);

--
-- Triggers `tbl_payment_history`
--
DELIMITER $$
CREATE TRIGGER `total_paid` AFTER INSERT ON `tbl_payment_history` FOR EACH ROW BEGIN
    UPDATE tbl_students SET total_paid=total_paid+NEW.allocation WHERE name = NEW.studentId;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_point_expense`
--

CREATE TABLE `tbl_point_expense` (
  `expenseId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_point_expense`
--

INSERT INTO `tbl_point_expense` (`expenseId`, `studentId`, `nominal`, `note`, `createdBy`, `createdDate`) VALUES
(1, 2, 20, 'Kartu Uno', 5, '2017-08-01 12:41:17'),
(2, 2, 10, 'Chess Board', 5, '2017-08-01 12:42:48');

--
-- Triggers `tbl_point_expense`
--
DELIMITER $$
CREATE TRIGGER `expense` BEFORE INSERT ON `tbl_point_expense` FOR EACH ROW BEGIN
    UPDATE tbl_students SET total_point=total_point-NEW.nominal WHERE studentId = NEW.studentId;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progress`
--

CREATE TABLE `tbl_progress` (
  `id` int(11) NOT NULL,
  `Student_name` text NOT NULL,
  `class` int(11) NOT NULL,
  `absent` int(128) DEFAULT NULL,
  `date` text,
  `teacher` int(11) NOT NULL,
  `teacher_note` longtext NOT NULL,
  `online` longtext NOT NULL,
  `milestone` int(11) NOT NULL,
  `unplugged` longtext NOT NULL,
  `point` int(11) NOT NULL,
  `group_project` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_progress`
--

INSERT INTO `tbl_progress` (`id`, `Student_name`, `class`, `absent`, `date`, `teacher`, `teacher_note`, `online`, `milestone`, `unplugged`, `point`, `group_project`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'Murid_perbu', 0, 1, '08/01/2017', 0, 'a', 'a', 1, 'a', 40, 'a', 0, 5, '2017-08-01 12:35:12', NULL, NULL),
(2, 'Murid_perbu', 0, 1, '08/02/2017', 0, '', '', 0, '', 0, '', 0, 5, '2017-08-09 10:00:53', NULL, NULL),
(3, 'Murid_perbu', 0, 1, '08/03/2017', 0, '', '', 0, '', 0, '', 0, 5, '2017-08-09 10:01:10', NULL, NULL);

--
-- Triggers `tbl_progress`
--
DELIMITER $$
CREATE TRIGGER `attedance` BEFORE INSERT ON `tbl_progress` FOR EACH ROW BEGIN
    UPDATE tbl_students SET total_attedance = total_attedance + 1, total_point=total_point+NEW.point WHERE name = NEW.Student_name;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Branch Admin'),
(3, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedules`
--

CREATE TABLE `tbl_schedules` (
  `scheduleId` int(11) NOT NULL,
  `day` text NOT NULL,
  `schedule` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `branchId` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedules`
--

INSERT INTO `tbl_schedules` (`scheduleId`, `day`, `schedule`, `branchId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'Saturday', '10.00-15.30', 3, 0, 5, '2017-08-01 11:55:21', 5, '2017-08-01 11:56:36'),
(2, 'Monday', '10.00-12.00', 2, 0, 5, '2017-08-05 08:19:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

CREATE TABLE `tbl_source` (
  `sourceId` int(11) NOT NULL,
  `source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_source`
--

INSERT INTO `tbl_source` (`sourceId`, `source`) VALUES
(1, 'Facebook'),
(2, 'Magazine');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `statusId` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`statusId`, `status`) VALUES
(1, 'Aktif'),
(2, 'Non-aktif'),
(3, 'Cuti'),
(4, 'Trial'),
(5, 'Special Class');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_log`
--

CREATE TABLE `tbl_status_log` (
  `statusid` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `new_status` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_status_log`
--

INSERT INTO `tbl_status_log` (`statusid`, `studentId`, `new_status`, `createdBy`, `createdDate`) VALUES
(1, 0, 5, 5, '2017-08-01 12:00:33'),
(2, 1, 1, 0, '0000-00-00 00:00:00'),
(3, 0, 1, 5, '2017-08-01 12:14:19'),
(4, 1, 1, 5, '2017-08-01 12:14:29'),
(5, 2, 3, 5, '2017-08-01 12:18:05'),
(6, 2, 1, 5, '2017-08-01 12:18:18'),
(7, 2, 1, 5, '2017-08-01 12:18:18'),
(8, 2, 1, 5, '2017-08-01 12:18:18'),
(9, 2, 1, 5, '2017-08-01 12:18:18'),
(10, 2, 1, 5, '2017-08-01 12:18:18'),
(11, 2, 1, 5, '2017-08-01 12:18:18'),
(12, 3, 1, 5, '2017-08-05 08:21:45'),
(13, 2, 1, 5, '2017-08-01 12:18:18'),
(14, 2, 1, 5, '2017-08-01 12:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `studentId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `scheduleId` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `parent_name` text NOT NULL,
  `parent_email` text NOT NULL,
  `branchId` int(11) NOT NULL,
  `address` longtext NOT NULL,
  `age` int(11) NOT NULL,
  `kelas` text NOT NULL,
  `school` text NOT NULL,
  `source` text NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `total_point` int(11) NOT NULL,
  `total_attedance` int(11) NOT NULL,
  `total_paid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`studentId`, `status`, `scheduleId`, `name`, `mobile`, `parent_name`, `parent_email`, `branchId`, `address`, `age`, `kelas`, `school`, `source`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`, `total_point`, `total_attedance`, `total_paid`) VALUES
(2, 1, 1, 'Murid_perbu', '1234567890', 'Ortu_Perbu', 'murid_perbu@gmail.com', 3, 'Perbu', 12, 'IX', 'SMP Kartini', '2', 0, 5, '2017-08-01 12:14:19', 5, '2017-08-01 12:18:18', 10, 3, 1),
(3, 1, 2, 'Murid_gs', '1234567890', 'ortu_gs', 'gs@gmail.com', 2, 'GS', 12, 'VI', 'SD Katini', '0', 0, 5, '2017-08-05 08:21:45', NULL, NULL, 60, 2, 0);

--
-- Triggers `tbl_students`
--
DELIMITER $$
CREATE TRIGGER `insert_status` AFTER INSERT ON `tbl_students` FOR EACH ROW BEGIN
    INSERT Into tbl_status_log SET studentId = NEW.studentId, new_status = NEW.status ,createdBy =NEW.createdBy , createdDate =NEW.createdDtm ;
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status` AFTER UPDATE ON `tbl_students` FOR EACH ROW BEGIN
    INSERT Into tbl_status_log SET studentId = NEW.studentId, new_status = NEW.status ,createdBy =NEW.updatedBy , createdDate =NEW.updatedDtm ;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `status` int(11) NOT NULL DEFAULT '1',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `branchId` int(11) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `status`, `name`, `mobile`, `address`, `branchId`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@codeinsect.com', '$2y$10$0hloYe5EFrhG11njWqIn0uK4iSpOSmeln2j9l58Ae4PLTmwnJrVay', 1, 'System Administrator', '9890098900', '', 0, 1, 0, 0, '2015-07-01 18:56:49', 1, '2017-07-05 09:28:50'),
(5, 'admin_system@kodekiddo.com', '$2y$10$.8FzniEaFrVXA2tyoEe8AelBQyrt8rH/y0UGighfkUpFFO89gd3dS', 1, 'Admin_system', '1234567890', 'admin_system', 1, 1, 0, 1, '2017-07-08 10:31:01', NULL, NULL),
(14, 'admin_perbu@kodekiddo.com', '$2y$10$OCdlVZ9BeEuZrc1M7LrNbeYcf42FqyGXLoRq54vu2aZhyGZbWOcBq', 1, 'Admin_perbu', '0987654321', 'perbu', 3, 2, 0, 5, '2017-08-01 11:42:43', 5, '2017-08-01 11:48:37'),
(15, 'admin_gs@kodekiddo.com', '$2y$10$PuLvc6b/xw9H5ppuY.yCROIj8KVI1.295/EVUIBnRV8kDTkbvzvh6', 1, 'Admin_gs', '1234567890', 'Gading Serpong', 2, 2, 0, 5, '2017-08-01 12:51:33', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_branchs`
--
ALTER TABLE `tbl_branchs`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `tbl_milestone`
--
ALTER TABLE `tbl_milestone`
  ADD PRIMARY KEY (`milestoneId`),
  ADD UNIQUE KEY `statusId` (`milestoneId`);

--
-- Indexes for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `tbl_point_expense`
--
ALTER TABLE `tbl_point_expense`
  ADD PRIMARY KEY (`expenseId`);

--
-- Indexes for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  ADD PRIMARY KEY (`scheduleId`);

--
-- Indexes for table `tbl_source`
--
ALTER TABLE `tbl_source`
  ADD PRIMARY KEY (`sourceId`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`statusId`),
  ADD UNIQUE KEY `statusId` (`statusId`);

--
-- Indexes for table `tbl_status_log`
--
ALTER TABLE `tbl_status_log`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_branchs`
--
ALTER TABLE `tbl_branchs`
  MODIFY `branchId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_milestone`
--
ALTER TABLE `tbl_milestone`
  MODIFY `milestoneId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_point_expense`
--
ALTER TABLE `tbl_point_expense`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_progress`
--
ALTER TABLE `tbl_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_schedules`
--
ALTER TABLE `tbl_schedules`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_source`
--
ALTER TABLE `tbl_source`
  MODIFY `sourceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_status_log`
--
ALTER TABLE `tbl_status_log`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
