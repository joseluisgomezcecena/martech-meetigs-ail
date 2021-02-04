-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 02:59 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `martech_ail`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `action_project_id` int(11) NOT NULL,
  `action_phase` int(11) NOT NULL,
  `action_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `action_description` text COLLATE utf8_spanish2_ci NOT NULL,
  `action_department` int(11) NOT NULL,
  `action_start_date` date NOT NULL,
  `action_promise_date` date NOT NULL,
  `action_end_date` date NOT NULL,
  `action_status` int(1) NOT NULL,
  `action_percent` int(3) NOT NULL,
  `action_complete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`action_id`, `action_project_id`, `action_phase`, `action_name`, `action_description`, `action_department`, `action_start_date`, `action_promise_date`, `action_end_date`, `action_status`, `action_percent`, `action_complete`) VALUES
(20, 15, 38, 'Design UI', 'Design UI using Bootstrap 4', 1, '2021-01-11', '2021-01-15', '0000-00-00', 0, 0, 0),
(21, 14, 34, 'Create Flowchart', 'Create Flowchart for pseudocode followup', 1, '2021-01-12', '2021-01-13', '2021-01-13', 0, 100, 1),
(22, 14, 34, 'Write Pseudo Code', 'Write pseudo code for review', 1, '2021-01-13', '2021-01-13', '2021-01-13', 0, 100, 1),
(23, 14, 34, 'Review pseudocode and flowchart with team', 'Review work for approval ', 1, '2021-01-13', '2021-01-13', '2021-01-14', 0, 100, 1),
(24, 14, 35, 'SQL Database Design', 'Create Tables needed for application on development server (Local XAMPP Installation)', 1, '2021-01-13', '2021-01-14', '2021-01-14', 0, 100, 1),
(25, 14, 35, 'Develop Users Module', 'Develop Users Module With CRUD Operations', 1, '2021-01-14', '2021-01-15', '2021-01-16', 0, 100, 1),
(26, 14, 35, 'Develop Projects Module', 'Develop Projects Module UI and Backend Classes', 1, '2021-01-14', '2021-01-17', '0000-00-00', 0, 0, 0),
(27, 14, 35, 'Develop Actions Module', 'Develop Actions Module With CRUD operations and sync with projects Module', 1, '2021-01-17', '2021-01-19', '0000-00-00', 0, 0, 0),
(28, 14, 35, 'Develop Updates, File Uploads And Progress Modules', 'Develop modules for updates on projects and actions, the actions module should contain a file upload module with validations', 1, '2021-01-18', '2021-01-21', '0000-00-00', 0, 0, 0),
(29, 14, 35, 'Develop AJAX alert system', 'Ajax alert system for cleaner and faster performance', 1, '2021-01-21', '2021-01-23', '0000-00-00', 0, 0, 0),
(30, 14, 35, 'Develop Reports Modules With Export Functions', 'Reporting capabilities will be added as well as export modules for EXCEL CSV and PDF files', 1, '2021-01-22', '2021-01-26', '0000-00-00', 0, 0, 0),
(31, 14, 35, 'Add Security based on user level', 'Users will be separated by level granting permissions for different views', 1, '2021-01-26', '2021-01-28', '0000-00-00', 0, 0, 0),
(32, 14, 35, 'Internal Testing', 'Test App internally', 1, '2021-01-27', '2021-01-30', '0000-00-00', 0, 0, 0),
(33, 14, 36, 'Pilot Run', 'Test prototype version', 2, '2021-01-30', '2021-02-05', '0000-00-00', 0, 0, 0),
(34, 14, 37, 'Push to Production Server', 'Push source code to production server mxmtsvrandon1 and Build SQL Database tables.', 1, '2021-02-08', '2021-02-09', '0000-00-00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `action_files`
--

CREATE TABLE `action_files` (
  `file_id` int(11) NOT NULL,
  `file_project_id` int(11) NOT NULL,
  `file_action_id` int(11) NOT NULL,
  `file_user_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `file_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `action_files`
--

INSERT INTO `action_files` (`file_id`, `file_project_id`, `file_action_id`, `file_user_id`, `file_name`, `file_url`, `file_active`) VALUES
(32, 0, 25, 21, 'Snapshot of users module UI', 'uploads/actions/2021-01-16938572758Capture.PNG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `action_responsible`
--

CREATE TABLE `action_responsible` (
  `a_responsible_id` int(11) NOT NULL,
  `a_action_id` int(11) NOT NULL,
  `a_responsible_user` int(11) NOT NULL,
  `a_responsible_main` int(1) NOT NULL DEFAULT 0,
  `a_responsible_added_by` int(11) NOT NULL,
  `a_responsible_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `action_responsible`
--

INSERT INTO `action_responsible` (`a_responsible_id`, `a_action_id`, `a_responsible_user`, `a_responsible_main`, `a_responsible_added_by`, `a_responsible_date`) VALUES
(235, 20, 21, 1, 21, '2021-01-11'),
(236, 21, 21, 1, 21, '2021-01-15'),
(237, 22, 21, 1, 21, '2021-01-15'),
(238, 23, 21, 1, 21, '2021-01-15'),
(239, 23, 129, 0, 21, '2021-01-15'),
(240, 23, 143, 0, 21, '2021-01-15'),
(241, 24, 21, 1, 21, '2021-01-15'),
(242, 25, 21, 1, 21, '2021-01-15'),
(243, 26, 21, 1, 21, '2021-01-15'),
(244, 27, 21, 1, 21, '2021-01-15'),
(245, 28, 21, 1, 21, '2021-01-15'),
(246, 29, 21, 1, 21, '2021-01-15'),
(247, 30, 21, 1, 21, '2021-01-15'),
(248, 31, 21, 1, 21, '2021-01-15'),
(249, 32, 21, 1, 21, '2021-01-15'),
(250, 32, 144, 0, 21, '2021-01-15'),
(251, 33, 151, 1, 21, '2021-01-15'),
(252, 33, 21, 0, 21, '2021-01-15'),
(253, 33, 129, 0, 21, '2021-01-15'),
(254, 33, 143, 0, 21, '2021-01-15'),
(255, 33, 144, 0, 21, '2021-01-15'),
(256, 33, 145, 0, 21, '2021-01-15'),
(257, 33, 146, 0, 21, '2021-01-15'),
(258, 33, 147, 0, 21, '2021-01-15'),
(259, 34, 21, 1, 21, '2021-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `action_updates`
--

CREATE TABLE `action_updates` (
  `a_update_id` int(11) NOT NULL,
  `a_update_action_id` int(11) NOT NULL,
  `a_update_descr` text COLLATE utf8_spanish2_ci NOT NULL,
  `a_update_user` int(11) NOT NULL,
  `a_update_date` date NOT NULL,
  `a_update_percent` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `action_updates`
--

INSERT INTO `action_updates` (`a_update_id`, `a_update_action_id`, `a_update_descr`, `a_update_user`, `a_update_date`, `a_update_percent`) VALUES
(26, 20, 'Update number 1 ', 21, '2021-01-15', 0),
(27, 20, 'update number 2 ', 21, '2021-01-15', 0),
(28, 21, 'ACTION COMPLETED! - 2021-01-15: Flow Chart was created with no issues', 21, '2021-01-15', 1),
(29, 22, 'ACTION COMPLETED! - 2021-01-15: Pseudo Code was written based on flowchart', 21, '2021-01-15', 1),
(30, 23, 'ACTION COMPLETED! - 2021-01-15: Held a meeting with team and flowchart was approved as well as pseudo code', 21, '2021-01-15', 1),
(31, 24, 'ACTION COMPLETED! - 2021-01-15: Relational SQL Database created, contains  12 tables.  this database was backed up to GIT profile', 21, '2021-01-15', 1),
(32, 25, 'ACTION COMPLETED! - 2021-01-15: Users module was completed with no issues', 21, '2021-01-15', 1),
(33, 21, 'new update', 21, '2021-01-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `department_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_active`) VALUES
(1, 'C.I', 1),
(2, 'Administration', 1),
(3, 'Production', 1),
(4, 'Engineering', 1),
(5, 'Quality', 1),
(6, 'R&D', 1),
(7, 'Incoming Inspection', 1),
(8, 'Customs', 1),
(9, 'Planning', 1),
(10, 'H.R.', 1),
(11, 'Warehouse', 1),
(12, 'Logistics', 1),
(13, 'Document Control', 1),
(14, 'EHS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL,
  `meeting_action_id` int(11) NOT NULL,
  `meeting_project_id` int(11) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_update` text COLLATE utf8_spanish2_ci NOT NULL,
  `meeting_reason` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_responsible`
--

CREATE TABLE `meeting_responsible` (
  `meeting_responsible_id` int(11) NOT NULL,
  `m_r_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notpermitted`
--

CREATE TABLE `notpermitted` (
  `perm_id` int(11) NOT NULL,
  `perm_user_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_a` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `notpermitted`
--

INSERT INTO `notpermitted` (`perm_id`, `perm_user_id`, `p_id`, `p_a`, `date`) VALUES
(1, 145, 15, 0, '2021-01-15 00:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `project_description` text COLLATE utf8_spanish2_ci NOT NULL,
  `project_department` int(11) NOT NULL,
  `project_owner` int(11) NOT NULL,
  `project_support` int(11) NOT NULL,
  `project_start_date` date NOT NULL,
  `project_promise_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `project_status` int(1) NOT NULL COMMENT '0 cancelled\r\n1 complete\r\n2 suspended',
  `project_active` int(1) NOT NULL DEFAULT 1,
  `project_complete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_description`, `project_department`, `project_owner`, `project_support`, `project_start_date`, `project_promise_date`, `project_end_date`, `project_status`, `project_active`, `project_complete`) VALUES
(14, 'Develop AIL App', 'Develop an application to track projects and actions as well as ECD\'s, this app will send notifications for late promise dates, the app will be a complete project management tool and should replace all spreadsheets used for project management', 1, 135, 21, '2021-01-08', '2021-03-31', '0000-00-00', 0, 1, 0),
(15, 'Develop Purchase Requests Visual', 'Develop a visual for the purchase requests App, so users can look up status of their purchase requests', 1, 135, 144, '2021-01-08', '2021-04-30', '0000-00-00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_phase`
--

CREATE TABLE `project_phase` (
  `phase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `phase_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `project_phase`
--

INSERT INTO `project_phase` (`phase_id`, `project_id`, `phase_name`, `phase_active`) VALUES
(34, 14, 'Analysis', 1),
(35, 14, 'Development', 1),
(36, 14, 'Prototype', 1),
(37, 14, 'Implementation', 1),
(38, 15, 'Analysis', 1),
(39, 15, 'Development', 1),
(40, 15, 'Prototype', 1),
(41, 15, 'Implementation', 1),
(42, 14, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_employee_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_department` int(11) NOT NULL,
  `user_date` datetime DEFAULT NULL,
  `user_last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_phone` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_areacode` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` int(1) NOT NULL DEFAULT 0,
  `user_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uploads/user_img/noimage.png',
  `user_locked` int(1) NOT NULL DEFAULT 0,
  `user_suspend` int(1) NOT NULL DEFAULT 0,
  `user_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_first_name`, `user_last_name`, `user_employee_number`, `user_department`, `user_date`, `user_last_update`, `user_phone`, `user_areacode`, `user_level`, `user_image`, `user_locked`, `user_suspend`, `user_active`) VALUES
(21, 'jgomez', '$2y$10$RGMkMwWiYmbJZjU/vzpOaOC4JAFxKiCV/rCpmE40wwBo.31MGhCTK', 'jgomez@martechmedical.com', 'Jose Luis', 'Gomez Ceceña', '43044', 1, '2018-08-09 00:00:00', '2021-01-18 23:08:31', '(686)259-4318', '+52', 2, 'uploads/user_img/17074115591410280743profile.jpg', 0, 0, 1),
(129, 'jmorimoto', '$2y$10$D5JHU5GkhlCki.eeBtcQP.0iTUAcFwxLnDKx6TEl/Q2A0SKfSvY.u', 'jmorimoto@martechmedical.com', 'Jose Francisco', 'Morimoto', '44312', 1, '2020-10-24 01:39:00', '2021-01-12 00:46:59', '6862594318', '+52', 0, 'uploads/user_img/noimage.jpg', 0, 0, 1),
(135, 'avalle', '$2y$10$Z9u3eVP2JSiClBQGJwRR6.D4XvZsEED0vnYyKjo7UIYeZlifdZVES', 'avalle@martechmedical.com', 'Anabel', 'Valle', '1', 2, '2020-11-06 15:40:51', '2021-01-18 23:25:26', '6862594318', '+52', 1, 'uploads/user_img/877324661685686452Anabel Valle.png', 0, 0, 1),
(143, 'jvargas', '$2y$10$Z9u3eVP2JSiClBQGJwRR6.D4XvZsEED0vnYyKjo7UIYeZlifdZVES', 'jvargas@martechmedical.com', 'Javier', 'Vargas', '1', 1, '2020-11-06 15:40:51', '2021-01-12 00:47:07', '6862594318', '+52', 0, 'uploads/user_img/123909636192934652noimage.jpg', 0, 0, 1),
(144, 'mespericueta', '$2y$10$Z9u3eVP2JSiClBQGJwRR6.D4XvZsEED0vnYyKjo7UIYeZlifdZVES', 'mespericueta@martechmedical.com', 'Martin Mateo', 'Espericueta Gomez', '1', 1, '2020-11-06 15:40:51', '2021-01-12 00:47:09', '6862594318', '+52', 0, 'uploads/user_img/192934652noimage.jpg', 0, 0, 1),
(145, 'jesquer', '$2y$10$T8mSmhcuJTQIBtyaz5.GE.2KpmCgDL8FvYRw/oB6ymN0IXzrMvYHa', 'jesquer@martechmedical.com', 'Juan Carlos', 'Esquer', '43047', 1, '2021-01-11 16:41:04', '2021-01-12 00:47:11', '', '', 0, 'uploads/user_img/noimage.png', 0, 0, 1),
(146, 'msalazar', '$2y$10$IFq8u4tIQ4HYe6bUsXDHhuspys1/dNWQT7JnEstD7SgVXoeZn0laS', 'msalazar@martechmedical.com', 'Myrna Araceli', 'Salazar', '43566', 1, '2021-01-11 16:42:05', '2021-01-12 00:47:14', '', '', 0, 'uploads/user_img/646166708951055819people.png', 0, 0, 1),
(147, 'jruiz1', '$2y$10$YRAfe4xwql.zv8BBKjRsF.y/dWAa6ElnzxZl.gNCdFQcu59CafjJe', 'jruiz1@martechmedical.com', 'Julio', 'Ruiz', '495215', 1, '2021-01-11 16:46:32', '2021-01-12 00:46:32', '', '+52', 0, 'uploads/user_img/noimage.png', 0, 0, 1),
(151, 'cobregon', '$2y$10$V7s2qXvNnAa6Wpj8/URoCOpa89OV4aCfygivHtZ6.cnG2t7V9yh1a', 'cobregon@martechmedical.com', 'Carolina', 'Obregon', '12235', 2, '2021-01-15 17:31:28', '2021-01-18 23:25:47', '', '+52', 1, 'uploads/user_img/noimage.png', 0, 0, 1),
(152, 'fnava', '$2y$10$GQ7GsOrBj1kO8c9aW98p7.s12MY05NQro3Ib3tuNoCdDT..eDPwNu', 'fnava@martechmedical.com', 'Edmundo', 'Nava', '1000', 2, '2021-01-18 11:11:41', '2021-01-18 23:18:39', '', '+52', 1, 'uploads/user_img/noimage.png', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `user_action_id` int(11) NOT NULL,
  `user_action` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_action_project` int(11) NOT NULL,
  `user_action_action` int(11) NOT NULL,
  `user_action_file` int(11) NOT NULL,
  `user_action_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `action_files`
--
ALTER TABLE `action_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `action_responsible`
--
ALTER TABLE `action_responsible`
  ADD PRIMARY KEY (`a_responsible_id`);

--
-- Indexes for table `action_updates`
--
ALTER TABLE `action_updates`
  ADD PRIMARY KEY (`a_update_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_responsible`
--
ALTER TABLE `meeting_responsible`
  ADD PRIMARY KEY (`meeting_responsible_id`);

--
-- Indexes for table `notpermitted`
--
ALTER TABLE `notpermitted`
  ADD PRIMARY KEY (`perm_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_phase`
--
ALTER TABLE `project_phase`
  ADD PRIMARY KEY (`phase_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`user_action_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `action_files`
--
ALTER TABLE `action_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `action_responsible`
--
ALTER TABLE `action_responsible`
  MODIFY `a_responsible_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `action_updates`
--
ALTER TABLE `action_updates`
  MODIFY `a_update_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_responsible`
--
ALTER TABLE `meeting_responsible`
  MODIFY `meeting_responsible_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notpermitted`
--
ALTER TABLE `notpermitted`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_phase`
--
ALTER TABLE `project_phase`
  MODIFY `phase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `user_action_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
