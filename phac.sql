-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 06:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phac`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `forum_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `forum_id`) VALUES
(1, 'General', 'qrUmqJNW'),
(2, 'PCA', 'NveVPVLS'),
(3, 'ARC', 'lVSQBbwo'),
(4, 'Security', 'BOqobVvo'),
(5, 'Impact', 'ABzYFyQx'),
(6, 'Finance', 'NbBfQVHE'),
(7, 'Golf', 'KKEXVecK'),
(8, 'Clubhouse', 'yJcgmXwm'),
(9, 'Fitness', 'tCnSNHbd');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(0, '60e6c8fe879c670e3d45f747c250b3914ff7b8cc', '1Hovw2l3'),
(0, 'bb06ff839dd4e87f7dd4c3d9310d9281d5985e1e', '1Hovw2l3'),
(0, '158b4e076e418146fd80a1a5bb6d6ced61f26a53', 'S92ksGgh'),
(0, '9a6ca55e28e2e6255dc52789d464531c886c623e', 'S92ksGgh'),
(0, '6c2c7f83ef64366459d286dc834790e947b988d0', '1Hovw2l3'),
(0, 'e4e00d9d5c73fa0c021de1dfc515bf3270713335', '1Hovw2l3');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `forum_id` varchar(8) NOT NULL,
  `post_id` varchar(8) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `title` text NOT NULL,
  `message` longtext NOT NULL,
  `pinned` tinyint(1) NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `post_img` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `forum_id`, `post_id`, `user_id`, `title`, `message`, `pinned`, `upvotes`, `downvotes`, `post_img`, `date`) VALUES
(1, '', 'qEZS47RV', '1Hovw2l3', '', '', 0, 0, 0, '', '2019-04-19 04:23:00'),
(2, 'qrUmqJNW', 'cnVPLfsI', '1Hovw2l3', 'sdfsdf', 'sdfsd', 0, 0, 0, '', '2019-04-19 04:28:00'),
(3, 'qrUmqJNW', 'WXuSCUaq', '1Hovw2l3', 'sdfsdf', 'sdfsf', 0, 0, 0, 'uploads/1Hovw2l3/Fr4DeQSker.png', '2019-04-19 04:28:13'),
(4, 'qrUmqJNW', 'WfDj5PMn', '1Hovw2l3', 'fdsgf', 'sdfsdf', 0, 0, 0, 'uploads/1Hovw2l3/NmPIVtnkch.png', '2019-04-19 10:32:58'),
(5, 'lVSQBbwo', 'CRAazp6W', '1Hovw2l3', 'adasd', 'asdasd', 0, 0, 0, 'uploads/1Hovw2l3/7V0zXFNzh2.png', '2019-04-19 12:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `profile_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `email`, `password`, `firstname`, `lastname`, `verified`, `profile_img`) VALUES
(4, '1Hovw2l3', 'kaifergerstrom@gmail.com', '$2y$10$qKjLqZ1BrsH/W3kjemKrheCynUBe3GdpaLHBxl7HkBMbm5zdtO0ae', 'Kai', 'Fergerstrom', 1, 'default.png'),
(7, 'S92ksGgh', 'paola@lavu.net', '$2y$10$qKjLqZ1BrsH/W3kjemKrheCynUBe3GdpaLHBxl7HkBMbm5zdtO0ae', 'Paola', 'Fergerstrom', 1, 'default.png'),
(8, '0hZ7DK4e', 'asdasda@asdasd.asd', '$2y$10$vJvmj1XTvOZs8n9q/Y4qp.T3cX72sXy4OY2HQF1NFFvbMeEdFFgJa', 'asdasd', 'asdasd', 0, 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memberid` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
