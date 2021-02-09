-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 11:24 PM
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
-- Database: `martech_ail_meetings`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `action_meeting_id` int(11) NOT NULL,
  `action_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `action_description` text COLLATE utf8_spanish2_ci NOT NULL,
  `action_department` int(11) NOT NULL,
  `action_promise_date` date NOT NULL,
  `action_end_date` date NOT NULL,
  `action_status` int(1) NOT NULL,
  `action_complete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`action_id`, `action_meeting_id`, `action_name`, `action_description`, `action_department`, `action_promise_date`, `action_end_date`, `action_status`, `action_complete`) VALUES
(3, 5, 'Re-escribir aplicación AIL', 'La aplicación AIL no tiene los campos requeridos', 1, '2021-02-11', '2021-02-09', 0, 1),
(4, 5, 'Review de aplicacion', 'Aprobar la aplicacion para su uso ', 2, '2021-02-15', '2021-02-08', 0, 1),
(5, 6, 'TMP module rewrite', 'Rewrite tpm module so system does not crash when too many requests are made', 1, '2021-02-19', '0000-00-00', 0, 0),
(6, 7, 'Confirm email reception', 'Testing of email sending functions, all recipients must confirm they received an email from the AIL program on 2/5/20201 at 3:10pm', 1, '2021-02-05', '0000-00-00', 0, 0),
(7, 8, 'Create new account on server', 'The previous account was suspended because it was detected as spam', 1, '2021-02-11', '0000-00-00', 0, 0),
(8, 8, 'Review with results with team', 'Review and share evidence of new account, as well as delivering documentation', 1, '2021-02-12', '0000-00-00', 0, 0);

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
(2, 0, 6, 21, 'Blocked emails error ', 'uploads/actions/2021-02-061259177719Capture.PNG', 1);

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
(14, 5, 21, 0, 21, '2021-02-04'),
(15, 6, 21, 0, 21, '2021-02-05'),
(16, 6, 143, 0, 21, '2021-02-05'),
(17, 6, 144, 0, 21, '2021-02-05'),
(18, 7, 21, 0, 21, '2021-02-08'),
(19, 8, 21, 0, 21, '2021-02-08'),
(20, 8, 135, 0, 21, '2021-02-08'),
(21, 8, 143, 0, 21, '2021-02-08'),
(23, 3, 21, 0, 21, '2021-02-08'),
(36, 4, 21, 0, 21, '2021-02-08'),
(37, 4, 135, 0, 21, '2021-02-08'),
(38, 4, 143, 0, 21, '2021-02-08'),
(39, 4, 151, 0, 21, '2021-02-08');

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
(4, 5, 'ACTION ON GOING - 2021-02-04: Cleaned up server log files, this will help the server be in an optimal condition for testing/development', 21, '2021-02-04', 1),
(5, 6, 'ACTION ON GOING - 2021-02-05: Email Sender is working correctly but server blocked our smtp server account, sent a ticket to it to unblock and waiting for confirmation', 21, '2021-02-05', 1),
(6, 6, 'ACTION ON GOING - 2021-02-05: Anabel and Javier Contacted IT, they are checking the problem. All testing is halted until smtp blocking is resolved', 21, '2021-02-05', 1),
(7, 6, 'ACTION ON GOING - 2021-02-05: Testing is being done', 21, '2021-02-05', 1),
(8, 3, 'ACTION COMPLETED! - 2021-02-08: Completed rewriting app', 21, '2021-02-08', 1),
(9, 4, 'ACTION COMPLETED! - 2021-02-08: Completed review, the app was accepted', 21, '2021-02-08', 1),
(10, 3, 'ACTION ON GOING - 2021-02-08: changed to on going to make changes requested', 21, '2021-02-08', 1),
(11, 3, 'ACTION COMPLETED! - 2021-02-09: this action has been completed', 21, '2021-02-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `mail_alerts` int(1) NOT NULL DEFAULT 0,
  `sms_alerts` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
-- Table structure for table `ecd_changes`
--

CREATE TABLE `ecd_changes` (
  `ecd_id` int(11) NOT NULL,
  `ecd_action_id` int(11) NOT NULL,
  `ecd_date` date NOT NULL,
  `ecd_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `ecd_changes`
--

INSERT INTO `ecd_changes` (`ecd_id`, `ecd_action_id`, `ecd_date`, `ecd_user_id`) VALUES
(2, 4, '2021-02-14', 21);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` int(11) NOT NULL,
  `meeting_department_id` int(11) NOT NULL,
  `meeting_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `meeting_description` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_active` int(1) NOT NULL DEFAULT 1,
  `meeting_complete` int(1) NOT NULL,
  `meeting_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `meeting_department_id`, `meeting_name`, `meeting_description`, `meeting_date`, `meeting_active`, `meeting_complete`, `meeting_user_id`) VALUES
(5, 2, 'Aplicacion AIL', '', '2021-01-20', 1, 0, 151),
(6, 1, 'Andon System Changes', '', '2021-02-04', 1, 0, 143),
(7, 1, 'Test AIL Email', '', '2021-02-05', 1, 0, 21),
(8, 1, 'Configure new Email', '', '2021-02-08', 1, 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendees`
--

CREATE TABLE `meeting_attendees` (
  `meeting_attendee_id` int(11) NOT NULL,
  `m_a_meeting_id` int(11) NOT NULL,
  `meeting_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `meeting_attendees`
--

INSERT INTO `meeting_attendees` (`meeting_attendee_id`, `m_a_meeting_id`, `meeting_user_id`) VALUES
(16, 5, 21),
(17, 5, 135),
(18, 5, 143),
(19, 5, 144),
(20, 5, 151),
(21, 6, 21),
(22, 6, 143),
(23, 6, 144),
(24, 7, 21),
(25, 7, 143),
(26, 7, 144),
(27, 8, 21),
(28, 8, 135),
(29, 8, 143);

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
(152, 'fnava', '$2y$10$GQ7GsOrBj1kO8c9aW98p7.s12MY05NQro3Ib3tuNoCdDT..eDPwNu', 'fnava@martechmedical.com', 'Edmundo', 'Nava', '1000', 2, '2021-01-18 11:11:41', '2021-01-18 23:18:39', '', '+52', 1, 'uploads/user_img/noimage.png', 0, 0, 1),
(153, 'jruiz', '$2y$10$QQKjFQ0HB1.kSpGsxOFUeuz3bv/6JMYXS1Zzo3wNPREl2WvQIh/Pi', 'jruiz@martechmedical.com', 'Jesus', 'Ruiz', '1', 2, '2021-02-04 17:57:54', '2021-02-05 01:57:54', '', '+52', 1, 'uploads/user_img/noimage.png', 0, 0, 1),
(154, 'rgodoy', '$2y$10$Pp4OmeAWMYlRuSDCe/SfIuLVnOSj3suZciAmH2zDoh3a1EF16JJiO', 'rgodoy@martechmedical.com', 'Ruben', 'Godoy', '5555', 2, '2021-02-08 16:43:05', '2021-02-09 00:43:05', '', '', 1, 'uploads/user_img/noimage.png', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `user_action_id` int(11) NOT NULL,
  `u_a_description` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `u_a_meeting_id` int(11) NOT NULL,
  `u_a_action_id` int(11) NOT NULL,
  `u_a_date_time` datetime NOT NULL,
  `u_a_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `ecd_changes`
--
ALTER TABLE `ecd_changes`
  ADD PRIMARY KEY (`ecd_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  ADD PRIMARY KEY (`meeting_attendee_id`);

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
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `action_files`
--
ALTER TABLE `action_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `action_responsible`
--
ALTER TABLE `action_responsible`
  MODIFY `a_responsible_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `action_updates`
--
ALTER TABLE `action_updates`
  MODIFY `a_update_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ecd_changes`
--
ALTER TABLE `ecd_changes`
  MODIFY `ecd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  MODIFY `meeting_attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `user_action_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
