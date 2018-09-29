-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2018 at 01:39 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stmatthew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--
-- Creation: Aug 18, 2018 at 04:44 PM
--

CREATE TABLE `admin_panel` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `admin_panel`:
--

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(66, 'August-28-2018 23:38:29', 'Carlos page', 'Motivational Talks', 'Carlos S. Nah Jr.', 'benjamin bacon.jpg', 'gsn;sninjbnigsigfnhgjthiehah;algh;agairha;ngnhf;jaa;;ghgh'),
(67, 'September-13-2018 08:41:23', 'Why ASMUMSA?', 'Motivational Talks', 'Carlos S. Nah Jr.', 'IMG_20180214_001043.jpg', 'Nothing can\'t stop our shine we are making progress'),
(68, 'August-28-2018 01:50:36', 'Working Portfolio', 'Motivational Talks', 'Carlos S. Nah Jr.', 'img.jpg', 'Breaking the barriers for human orderly percision&amp;nbsp;'),
(69, 'August-28-2018 01:22:32', 'Nice Work Done', 'Motivational Talks', 'Carlos S. Nah Jr.', '29.jpg', 'I admire your courage for the bold step you guys have taken in this Association.'),
(70, 'September-14-2018 14:26:56', 'MEETING', 'Events / Programs', 'Carlos S. Nah Jr.', 'img2.jpg', 'Please be informed that this organization primarily goal is unity and success. we are urging every member to please be &amp;nbsp;in or on time for meeting.');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Aug 17, 2018 at 09:41 AM
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `category`:
--

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(12, 'August-17-2018 14:50:39', 'News and Announcements', 'Carlos S. Nah Jr.'),
(13, 'August-21-2018 15:59:26', 'Motivational Talks', 'Carlos S. Nah Jr.'),
(14, 'August-29-2018 09:05:50', 'Events / Programs ', 'Carlos S. Nah Jr.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Creation: Sep 13, 2018 at 10:03 AM
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(200) NOT NULL,
  `status` varchar(5) NOT NULL,
  `admin_panel_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `comments`:
--   `admin_panel_id`
--       `admin_panel` -> `id`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `avatar`, `comment`, `approvedby`, `status`, `admin_panel_id`) VALUES
(5, 'September-13-2018 10:44:21', 'Carlos Rademe Nah Jr.', 'cnah27@gmail.gmail.com', 'Carlos.png', 'Great work', 'Carlos S. Nah Jr.', 'ON', 69);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Aug 12, 2018 at 10:28 PM
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `roles` varchar(20) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `options` varchar(100) NOT NULL,
  `sdob` varchar(50) NOT NULL,
  `ldob` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `roles`, `dob`, `options`, `sdob`, `ldob`, `password`, `address`, `date`) VALUES
(5, 'Daniel', 'Toe', 'dedortee', 'dedortee@gmail.com', 'Admin', '2018-08-15', 'Working', '2014-09-17', '2018-08-23', 'c413741786cb9e1c18edafc365a27313', 'Logan Town ,Board Street', '2018-09-22 19:29:54'),
(7, 'Daoh', 'Dukuly', 'dvarane', 'ddukuly24@yahoo.com', 'Member', ' 1996-04-15', 'Working', '2014-09-08', '2016-07-29', 'a007f5f838ac3b9ebf5d908dff42707c', 'Caldwell', '2018-08-16 18:17:33'),
(8, 'John', 'Miller', 'jmiller', 'jmiller@gmail.com', 'Admin', '1999-09-17', 'Student/ studying', '2014-09-08', '2016-07-29', 'f0af962ddbc82430e947390b2f3f6e49', 'Jamaica Road', '2018-09-14 14:09:07'),
(9, 'Carlos S.', 'Nah Jr.', 'ra9', 'cnah27@gmail.com', 'Admin', ' 1998-10-09', 'Student/ studying', '2015-09-15', '2017-07-29', 'dc599a9972fde3045dab59dbd1ae170b', 'Jamaica Road', '2018-08-17 15:21:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_panel_id` (`admin_panel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign Key to admin_panel table` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
