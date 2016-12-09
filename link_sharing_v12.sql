-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2016 at 10:12 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `link_sharing_v12`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `position`, `visible`) VALUES
(1, 'App Dev', 1, 1),
(2, 'Interactive Dev', 2, 1),
(3, 'UI & UX', 3, 1),
(4, 'Web Design', 4, 1),
(5, 'Tech Studio', 5, 1),
(6, 'Project Management', 6, 1),
(7, 'Audio & Video', 7, 1),
(8, 'Test', 8, 1),
(9, 'Test Course', 9, 1),
(10, 'My New Course', 10, 1),
(11, 'Another New Course', 11, 1),
(12, 'Yet Another Course', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) NOT NULL,
  `url` varchar(2083) NOT NULL,
  `source` varchar(253) NOT NULL,
  `title` varchar(500) NOT NULL,
  `course_id` tinyint(4) NOT NULL,
  `position` smallint(6) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `url`, `source`, `title`, `course_id`, `position`, `visible`, `date_posted`, `user_id`) VALUES
(1, 'http://interfacemaster.ca/', '', 'Mikhail''s Portfolio Site', 1, 1, 1, '2016-11-28 05:41:24', 2),
(2, 'https://validator.w3.org/', '', 'W3C Markup Validation Service', 1, 2, 1, '2016-11-28 05:44:48', 2),
(3, 'https://modernizr.com/', '', 'Modernizr', 1, 3, 1, '2016-11-28 05:45:21', 2),
(4, 'https://www.youtube.com/channel/UC-64_fxYNrytp5O0LL8G1rw/videos?shelf_id=0&view=0&sort=dd', '', 'Mikhail''s YouTube Channel', 1, 4, 1, '2016-11-28 05:45:45', 2),
(5, 'https://dev.fast.sheridanc.on.ca:2083/cpsess1293805444/frontend/paper_lantern/index.html?login=1&post_login=29629775697120', '', 'Sheridan cPanel', 1, 5, 1, '2016-11-28 05:46:06', 2),
(6, 'http://www.dot.tk/en/index.html?lang=en', '', '.TK Domains', 1, 6, 1, '2016-11-28 05:46:48', 1),
(7, 'http://i.stack.imgur.com/QdcG2.gif', '', 'Pass by Reference vs. Value (GIF)', 1, 7, 1, '2016-11-28 05:47:14', 1),
(8, 'http://zimjs.com/code/', '', 'ZIMjs', 2, 1, 1, '2016-11-28 05:51:13', 2),
(9, 'http://zimjs.com/code/bits.html', '', 'ZIM Bits', 2, 2, 1, '2016-11-28 05:53:31', 2),
(10, 'http://www.createjs.com/docs/easeljs/classes/Graphics.html', '', 'EiselJS', 2, 3, 1, '2016-11-28 05:53:50', 2),
(11, 'https://www.youtube.com/playlist?list=PLfzKgAP3NhxBuY5nRZMJVNYzwxo2odq-X', '', 'ZIM Capture (Dan Zen''s YouTube Channel)', 2, 4, 1, '2016-11-28 05:54:20', 2),
(12, 'https://github.com/CreateJS/EaselJS/issues/59', '', 'Understanding Rotation vs. Registration Point', 2, 5, 1, '2016-11-28 05:55:06', 1),
(13, 'http://2016.makemepulse.com/', '', 'Make Me Pulse (Inspiration)', 2, 6, 1, '2016-11-28 05:55:30', 1),
(14, 'http://alistapart.com/blog/post/variable-fonts-for-responsive-design', '', 'Variable Fonts for Responsive Design', 3, 1, 1, '2016-11-28 05:57:26', 2),
(15, 'http://imm.sheridancollege.ca/2017/id/lesson02/illustrator_explained.pdf', '', 'Adobe Illustrator Explained', 3, 2, 1, '2016-11-28 05:57:44', 2),
(16, 'https://speckyboy.com/a-collection-of-printable-web-browser-sketching-and-wireframe-templates/', '', 'A Collection of Printable Web Browser Sketching and Wireframe Templates', 3, 3, 1, '2016-11-28 05:57:58', 2),
(17, 'http://intersog.com/blog/zero-ui-the-most-natural-way-of-building-product-user-interfaces/', '', 'Zero UI: The Most Natural Way of Building Product User Interfaces', 3, 4, 1, '2016-11-28 05:58:26', 2),
(18, 'https://www.youtube.com/watch?v=Ovj4hFxko7c', '', 'What the #$%@ is UX Design?', 3, 5, 1, '2016-11-28 05:59:18', 1),
(19, 'http://designsojourn.com/dieter-rams-and-his-10-design-commandments/', '', 'Dieter Rams and His 10 Design Commandments', 3, 6, 1, '2016-11-28 05:59:55', 1),
(20, 'https://www.crazyegg.com/', '', 'CrazyEgg: Track Your Visitors', 3, 7, 1, '2016-11-28 06:00:21', 1),
(21, 'http://pttrns.com/', '', 'Mobile Design Patterns', 4, 1, 1, '2016-11-28 06:01:59', 2),
(22, 'https://www.uplabs.com/', '', 'UPlabs: Design Inspiration, Tools, Products & More...', 4, 2, 1, '2016-11-28 06:02:58', 2),
(23, 'http://mydevice.io/devices/', '', 'mydevice.io - Dimensions for Mobile Devices', 4, 3, 1, '2016-11-28 06:03:48', 2),
(24, 'http://necolas.github.io/normalize.css/', '', 'Normalize.css: A Modern, HTML5-Ready Alternative to CSS Resets', 4, 4, 1, '2016-11-28 06:04:36', 1),
(25, 'http://www.vanschneider.com/colors/', '', 'Color Claim', 4, 5, 1, '2016-11-28 06:05:11', 1),
(26, 'https://www.arduino.cc/en/Reference/Board', '', 'Introduction to the Arduino Board', 5, 1, 1, '2016-11-28 06:06:39', 2),
(27, 'http://www.exploringarduino.com/parts/', '', 'Arduino Parts', 5, 2, 1, '2016-11-28 06:06:56', 2),
(28, 'http://sayal.com/zinc/index.asp', '', 'SAYAL Electronics', 5, 3, 1, '2016-11-28 06:07:14', 2),
(29, 'http://breakoutjs.com/', '', 'BreakoutJS for Arduino', 5, 4, 1, '2016-11-28 06:07:57', 1),
(30, 'https://asana.com/guide/help/fundamentals/dashboards', '', 'Asana Dashboards', 6, 1, 1, '2016-11-28 06:09:02', 2),
(31, 'https://www.quora.com/How-do-I-manage-a-freelance-project', '', 'Quora: How do I manage a freelance project?', 6, 2, 1, '2016-11-28 06:10:04', 1),
(32, 'http://www.adobe.com/ca/products/premiere.html', '', 'Adobe Premiere', 7, 1, 1, '2016-11-28 06:10:47', 2),
(35, 'https://www.arduino.cc/en/Reference/LiquidCrystal', '', 'LiquidCrystal Library', 5, 5, 1, '2016-12-03 01:29:06', 2),
(36, 'https://asana.com/product', '', 'Asana Features', 6, 3, 1, '2016-12-03 01:34:25', 2),
(37, 'https://sourceforge.net/projects/audacity/', '', 'Audacity', 7, 2, 1, '2016-12-03 01:40:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `bio` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hashed_password`, `username`, `bio`, `date_created`, `type`) VALUES
(1, 'student@college.com', '$2y$10$NGU4ODRiZmZiZTNjNmZhYe4rwhutRNJ02zms6zs.AezZcA8pNQJta', 'student', 'I''m a student.', '2016-11-28 05:35:03', 'standard'),
(2, 'prof@college.com', '$2y$10$NTIxNzc4MjQ3ZDhmMjFjM.IeYaIpUbF3RQhxnYsDgi96IDA/aFlzK', 'prof', 'I''m a prof.', '2016-11-28 05:35:32', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
