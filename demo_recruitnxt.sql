-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2022 at 12:01 PM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.3.33-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_recruitnxt`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`c_id`, `c_name`, `s_id`) VALUES
(2, 'Gadag', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gl_id` int(11) NOT NULL,
  `gl_title` varchar(255) NOT NULL,
  `gl_type` varchar(255) NOT NULL,
  `gl_date` datetime DEFAULT NULL,
  `gl_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image`
--

CREATE TABLE `gallery_image` (
  `gi_id` int(11) NOT NULL,
  `gl_id` int(11) NOT NULL,
  `gi_title` varchar(255) NOT NULL,
  `gi_img` varchar(255) NOT NULL,
  `gi_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_img` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`s_id`, `s_name`, `s_img`) VALUES
(1, 'Karnataka', '1763951869_karnataka.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `au_id` int(11) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `au_email` varchar(255) NOT NULL,
  `au_password` text NOT NULL,
  `au_name` varchar(255) NOT NULL,
  `au_contact` varchar(255) NOT NULL,
  `au_date` datetime NOT NULL,
  `au_last_login` datetime NOT NULL,
  `au_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`au_id`, `user_role`, `au_email`, `au_password`, `au_name`, `au_contact`, `au_date`, `au_last_login`, `au_status`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$6F/BYqfP9RYymBcZZAv5Gu8T/akR4/a7HXfl2dg24/7fUprAYLvwC', 'Kiran_admin', '9999988888', '2015-05-18 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'manager', 'manager@example.com', '$2y$10$rvD0qx.jKvMchquI7H8eJudg4y8QijX18riPRH/2JhpyTQwWRiBfq', 'Rnxt_manager', '', '2022-03-28 00:00:00', '2022-03-28 00:00:00', 1),
(3, 'operator', 'operator@example.com', '$2y$10$kyS6lATkC3ys7vFySo2My.L2qi8zLGUZDBEJbsI4erZsHScUrGv62', 'Rnxt_operator', '', '2022-03-28 00:00:00', '2022-03-28 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_state_id` (`s_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gl_id`);

--
-- Indexes for table `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`gi_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_name` (`s_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`au_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `gi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `au_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_state_id` FOREIGN KEY (`s_id`) REFERENCES `states` (`s_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
