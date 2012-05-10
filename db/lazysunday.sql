-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2012 at 08:41 PM
-- Server version: 5.5.21
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `joaofar_lazysunday`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `resultado` text NOT NULL,
  `estado` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `data`, `resultado`, `estado`, `created`, `modified`) VALUES
(8, '2012-02-05 18:30:00', '0-1', '2', '2012-02-24 01:52:32', '2012-03-05 02:47:13'),
(9, '2012-02-12 18:30:00', '1-0', '2', '2012-02-24 02:01:42', '2012-03-05 02:47:08'),
(10, '2012-02-19 18:30:00', '1-0', '2', '2012-02-24 02:02:17', '2012-03-05 02:46:52'),
(11, '2012-02-26 18:30:00', '10-8', '2', '2012-02-24 02:02:53', '2012-03-05 02:46:46'),
(23, '2012-03-04 18:30:00', '7-10', '2', '2012-03-05 02:47:50', '2012-03-05 02:48:31'),
(24, '2012-03-11 18:30:00', '10-5', '2', '2012-03-05 03:17:55', '2012-03-05 03:18:13'),
(25, '2012-03-18 18:30:00', '20-15', '2', '2012-03-16 20:00:54', '2012-03-25 15:25:20'),
(26, '2012-03-25 18:30:00', '14-11', '2', '2012-03-25 16:23:40', '2012-03-25 21:52:54'),
(29, '2012-04-01 18:30:00', '7-8', '2', '2012-03-26 04:47:02', '2012-04-01 15:49:07'),
(30, '2012-04-08 18:30:00', '9-14', '2', '2012-04-06 12:17:34', '2012-04-10 23:16:31'),
(31, '2012-04-15 18:30:00', '10-11', '2', '2012-04-13 10:45:42', '2012-04-15 15:29:07'),
(32, '2012-04-22 18:30:00', '7-13', '2', '2012-04-20 09:40:15', '2012-04-22 15:02:38'),
(33, '2012-04-29 18:30:00', '9-6', '2', '2012-04-27 15:06:31', '2012-04-29 15:09:06'),
(34, '2012-05-06 18:30:00', '8-9', '2', '2012-05-05 07:37:52', '2012-05-06 14:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE IF NOT EXISTS `goals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(10) unsigned NOT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `golos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `player_id`, `game_id`, `golos`) VALUES
(16, 32, 11, 1),
(17, 14, 11, 1),
(18, 19, 11, 3),
(19, 18, 11, 3),
(20, 23, 11, 2),
(21, 21, 11, 2),
(22, 15, 11, 3),
(23, 20, 11, 3),
(24, 25, 11, 0),
(25, 22, 11, 0),
(26, 16, 23, 2),
(27, 14, 23, 0),
(28, 19, 23, 2),
(29, 20, 23, 2),
(30, 23, 23, 1),
(31, 21, 23, 5),
(32, 15, 23, 1),
(33, 18, 23, 2),
(34, 25, 23, 2),
(35, 22, 23, 0),
(36, 14, 24, 1),
(37, 15, 24, 3),
(38, 16, 24, 0),
(39, 17, 24, 3),
(40, 18, 24, 1),
(41, 19, 24, 0),
(42, 20, 24, 3),
(43, 22, 24, 1),
(44, 25, 24, 3),
(45, 30, 24, 0),
(66, 15, 25, 4),
(67, 21, 25, 6),
(68, 20, 25, 4),
(69, 16, 25, 6),
(70, 19, 25, 0),
(71, 22, 25, 0),
(72, 30, 25, 7),
(73, 17, 25, 3),
(74, 23, 25, 3),
(75, 14, 25, 2),
(76, 21, 26, 3),
(77, 16, 26, 6),
(78, 18, 26, 3),
(79, 19, 26, 0),
(80, 14, 26, 2),
(81, 20, 26, 4),
(82, 22, 26, 0),
(83, 24, 26, 1),
(84, 17, 26, 4),
(85, 25, 26, 2),
(86, 21, 29, 1),
(87, 20, 29, 3),
(88, 22, 29, 1),
(89, 14, 29, 0),
(90, 25, 29, 2),
(91, 15, 29, 1),
(92, 16, 29, 2),
(93, 18, 29, 2),
(94, 19, 29, 2),
(95, 24, 29, 1),
(96, 15, 30, 1),
(97, 20, 30, 2),
(98, 23, 30, 3),
(99, 14, 30, 2),
(100, 33, 30, 1),
(101, 31, 30, 2),
(102, 21, 30, 1),
(103, 16, 30, 4),
(104, 17, 30, 6),
(105, 25, 30, 1),
(106, 16, 31, 4),
(107, 18, 31, 1),
(108, 17, 31, 2),
(109, 24, 31, 2),
(110, 22, 31, 1),
(111, 21, 31, 3),
(112, 15, 31, 2),
(113, 34, 31, 1),
(114, 19, 31, 1),
(115, 14, 31, 4),
(116, 21, 32, 2),
(117, 18, 32, 2),
(118, 19, 32, 1),
(119, 22, 32, 2),
(120, 16, 32, 4),
(121, 15, 32, 2),
(122, 17, 32, 5),
(123, 14, 32, 1),
(124, 25, 32, 1),
(125, 20, 32, 0),
(127, 17, 33, 4),
(128, 34, 33, 0),
(129, 18, 33, 2),
(130, 19, 33, 2),
(131, 14, 33, 1),
(132, 15, 33, 2),
(133, 35, 33, 2),
(134, 25, 33, 0),
(135, 23, 33, 1),
(136, 22, 33, 1),
(137, 16, 34, 1),
(138, 17, 34, 2),
(139, 19, 34, 2),
(140, 24, 34, 2),
(141, 23, 34, 1),
(142, 21, 34, 2),
(143, 15, 34, 2),
(144, 18, 34, 2),
(145, 14, 34, 1),
(146, 22, 34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE IF NOT EXISTS `invites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `game_id`, `player_id`, `available`, `created`, `modified`) VALUES
(13, 11, 14, 1, '2012-03-02 16:09:34', '2012-03-02 16:09:34'),
(14, 11, 15, 1, '2012-03-02 16:09:40', '2012-03-02 16:09:40'),
(15, 11, 16, 1, '2012-03-02 16:09:44', '2012-03-02 16:09:44'),
(16, 11, 17, 1, '2012-03-02 16:09:50', '2012-03-02 16:09:50'),
(17, 11, 18, 1, '2012-03-02 16:09:55', '2012-03-02 16:09:55'),
(18, 11, 19, 1, '2012-03-02 16:10:03', '2012-03-02 16:10:03'),
(20, 11, 20, 1, '2012-03-02 16:10:29', '2012-03-02 16:10:29'),
(21, 11, 29, 0, '2012-03-03 23:25:05', '2012-03-03 23:25:05'),
(22, 11, 28, 0, '2012-03-03 23:27:30', '2012-03-03 23:27:30'),
(42, 22, 14, 0, '2012-03-04 01:31:25', '2012-03-04 01:31:25'),
(43, 22, 15, 1, '2012-03-04 01:31:25', '2012-03-04 01:31:25'),
(44, 22, 16, NULL, '2012-03-04 01:31:25', '2012-03-04 01:31:25'),
(45, 0, 0, 0, '2012-03-04 17:51:51', '2012-03-04 17:51:51'),
(46, 0, 0, 0, '2012-03-04 17:52:22', '2012-03-04 17:52:22'),
(47, 0, 0, 0, '2012-03-04 17:52:43', '2012-03-04 17:52:44'),
(48, 0, 0, 0, '2012-03-04 17:53:15', '2012-03-04 17:53:15'),
(49, 0, 0, 0, '2012-03-04 17:53:47', '2012-03-04 17:53:48'),
(50, 0, 0, 0, '2012-03-04 17:54:00', '2012-03-04 17:54:01'),
(51, 22, 17, NULL, '2012-03-04 18:06:55', '2012-03-04 18:06:55'),
(52, 22, 19, 1, '2012-03-04 18:06:55', '2012-03-04 18:06:55'),
(53, 22, 18, 1, '2012-03-04 18:07:06', '2012-03-04 18:07:06'),
(54, 24, 14, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(55, 24, 15, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(56, 24, 16, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(57, 24, 18, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(58, 24, 19, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(59, 24, 20, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(60, 24, 21, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(61, 24, 22, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(62, 24, 24, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(63, 24, 25, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(64, 24, 17, 0, '2012-03-16 02:55:14', '2012-03-16 02:55:14'),
(65, 25, 14, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(66, 25, 16, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(67, 25, 17, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(68, 25, 18, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(69, 25, 19, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(70, 25, 20, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(71, 25, 21, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(72, 25, 22, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(73, 25, 24, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(74, 25, 25, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54'),
(75, 25, 15, 1, '2012-03-17 01:58:22', '2012-03-17 01:58:22'),
(76, 25, 30, 1, '2012-03-17 02:22:30', '2012-03-17 02:22:30'),
(77, 25, 26, NULL, '2012-03-17 02:54:05', '2012-03-17 02:54:05'),
(78, 25, 23, 1, '2012-03-17 02:58:53', '2012-03-17 02:58:53'),
(79, 25, 27, NULL, '2012-03-17 02:58:53', '2012-03-17 02:58:53'),
(80, 25, 32, NULL, '2012-03-18 04:26:24', '2012-03-18 04:26:24'),
(81, 26, 14, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(82, 26, 16, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(83, 26, 17, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(84, 26, 18, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(85, 26, 19, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(86, 26, 20, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(87, 26, 21, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(88, 26, 22, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(89, 26, 24, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(90, 26, 25, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40'),
(91, 27, 14, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(92, 27, 16, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(93, 27, 17, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(94, 27, 18, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(95, 27, 19, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(96, 27, 20, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(97, 27, 21, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(98, 27, 22, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(99, 27, 24, 0, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(100, 27, 25, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39'),
(101, 27, 15, 1, '2012-03-25 23:03:30', '2012-03-25 23:03:30'),
(102, 27, 23, NULL, '2012-03-25 23:03:30', '2012-03-25 23:03:30'),
(114, 29, 14, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(115, 29, 16, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(116, 29, 17, 0, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(117, 29, 18, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(118, 29, 19, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(119, 29, 20, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(120, 29, 21, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(121, 29, 22, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(122, 29, 24, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(123, 29, 25, 1, '2012-03-31 03:17:57', '2012-03-31 03:17:57'),
(124, 29, 15, 1, '2012-03-31 08:19:43', '2012-03-31 08:19:43'),
(125, 30, 14, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(126, 30, 15, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(127, 30, 16, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(128, 30, 17, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(129, 30, 18, 0, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(130, 30, 19, 0, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(131, 30, 20, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(132, 30, 21, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(133, 30, 23, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(134, 30, 25, 1, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(135, 30, 30, 0, '2012-04-06 12:17:34', '2012-04-06 12:17:34'),
(136, 30, 31, 1, '2012-04-08 06:40:05', '2012-04-08 06:40:05'),
(137, 30, 33, 1, '2012-04-08 08:23:48', '2012-04-08 08:23:48'),
(138, 31, 14, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(139, 31, 15, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(140, 31, 16, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(141, 31, 17, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(142, 31, 18, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(143, 31, 19, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(144, 31, 21, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(145, 31, 22, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(147, 31, 24, 1, '2012-04-13 10:45:42', '2012-04-13 10:45:42'),
(149, 31, 34, 1, '2012-04-13 17:17:26', '2012-04-13 17:17:26'),
(150, 32, 14, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(151, 32, 16, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(152, 32, 17, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(153, 32, 18, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(154, 32, 19, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(155, 32, 20, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(156, 32, 21, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(157, 32, 22, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(158, 32, 24, 0, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(159, 32, 25, 1, '2012-04-20 09:40:15', '2012-04-20 09:40:15'),
(160, 32, 15, 1, '2012-04-22 07:22:40', '2012-04-22 07:22:40'),
(161, 33, 14, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(162, 33, 16, 0, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(163, 33, 18, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(164, 33, 19, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(165, 33, 20, 0, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(166, 33, 21, 0, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(167, 33, 22, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(168, 33, 24, 0, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(169, 33, 25, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(170, 33, 17, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(171, 33, 15, 1, '2012-04-27 15:06:31', '2012-04-27 15:06:31'),
(172, 33, 23, 1, '2012-04-28 14:49:10', '2012-04-28 14:49:10'),
(173, 33, 34, 1, '2012-04-28 14:49:10', '2012-04-28 14:49:10'),
(174, 33, 30, 0, '2012-04-29 08:38:23', '2012-04-29 08:38:23'),
(175, 33, 35, 1, '2012-04-29 09:37:46', '2012-04-29 09:37:46'),
(176, 34, 14, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(177, 34, 16, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(178, 34, 18, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(179, 34, 19, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(180, 34, 21, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(181, 34, 22, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(182, 34, 24, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(183, 34, 17, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(184, 34, 15, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52'),
(185, 34, 23, 1, '2012-05-05 07:37:52', '2012-05-05 07:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` text,
  `conv` int(11) NOT NULL,
  `presencas` int(11) NOT NULL,
  `rating` float NOT NULL,
  `ratingElo` int(11) NOT NULL,
  `vitorias` int(11) NOT NULL,
  `vit_pre` float NOT NULL,
  `golos` int(11) NOT NULL,
  `golos_p_jogo` float NOT NULL,
  `equipa_m` int(6) NOT NULL,
  `equipa_m_p_jogo` float NOT NULL,
  `equipa_s` int(6) NOT NULL,
  `equipa_s_p_jogo` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `nome`, `email`, `conv`, `presencas`, `rating`, `ratingElo`, `vitorias`, `vit_pre`, `golos`, `golos_p_jogo`, `equipa_m`, `equipa_m_p_jogo`, `equipa_s`, `equipa_s_p_jogo`, `created`, `modified`) VALUES
(14, 'Peej', 'pedrorodrigues@gmail.com', 1, 14, 0.469, 1027, 7, 0.5, 15, 1.36, 109, 9.91, 112, 10.18, '2012-02-24 01:46:18', '2012-05-06 14:05:48'),
(15, 'André', 'asgomes@gmail.com', 11, 13, 0.664, 1768, 9, 0.692, 21, 2.1, 104, 10.4, 92, 9.2, '2012-02-24 01:46:31', '2012-05-06 14:05:48'),
(16, 'Vitorino', 'joaovitorino@msn.com', 2, 12, 0.659, 1661, 7, 0.583, 29, 3.22, 104, 11.56, 84, 9.33, '2012-02-24 01:46:43', '2012-05-06 14:05:48'),
(17, 'Vazantes', 'joao.vaz@gmail.com', 10, 9, 0.583, 1263, 4, 0.444, 29, 3.63, 90, 11.25, 81, 10.13, '2012-02-24 01:46:58', '2012-05-06 14:05:48'),
(18, 'Ricardo', 'ricardobelo@gmail.com', 3, 11, 0.546, 1114, 6, 0.545, 18, 2, 82, 9.11, 81, 9, '2012-02-24 01:47:08', '2012-05-06 14:05:48'),
(19, 'Fresco', 'joaosantos@gmail.com', 4, 12, 0.465, 917, 6, 0.5, 13, 1.3, 99, 9.9, 99, 9.9, '2012-02-24 01:47:21', '2012-05-06 14:05:48'),
(20, 'Far', 'mail@joaofarinha.eu', 5, 11, 0.454, 902, 4, 0.364, 21, 2.63, 79, 9.88, 89, 11.13, '2012-02-24 01:47:37', '2012-05-06 14:05:48'),
(21, 'Barroso', 'pedbar@gmail.com', 6, 12, 0.692, 1653, 8, 0.667, 25, 2.78, 100, 11.11, 91, 10.11, '2012-02-24 01:47:45', '2012-05-06 14:05:48'),
(22, 'Anselmo', 'anselmomanel@hotmail.com', 7, 13, 0.344, 887, 5, 0.385, 8, 0.8, 93, 9.3, 105, 10.5, '2012-02-24 01:48:03', '2012-05-06 14:05:48'),
(23, 'Bruno G.', 'bsmogues@hotmail.com', 13, 8, 0.314, 918, 2, 0.25, 11, 1.83, 55, 9.17, 70, 11.67, '2012-02-24 01:48:21', '2012-05-06 14:05:48'),
(24, 'Nunão', 'nmldfrancisco@gmail.com', 8, 6, 0.353, 963, 2, 0.333, 6, 1.5, 37, 9.25, 41, 10.25, '2012-02-24 01:48:32', '2012-05-06 14:05:48'),
(25, 'Louie', 'luismgpereira@gmail.com', 9, 8, 0.376, 1139, 3, 0.375, 11, 1.38, 74, 9.25, 74, 9.25, '2012-02-24 01:49:04', '2012-05-06 14:05:48'),
(28, 'Nuno A.', NULL, 16, 1, 0.45, 1282, 1, 0.6, 0, 0, 0, 0, 0, 0, '2012-02-24 01:49:53', '2012-05-06 14:05:48'),
(30, 'Afonso', 'afonso.lc@gmail.com', 12, 4, 0.616, 1101, 2, 0.5, 7, 3.5, 20, 10, 30, 15, '2012-02-24 01:50:15', '2012-05-06 14:05:48'),
(31, 'MDK', 'bruno.pires@gmail.com', 19, 1, 0.588, 1334, 1, 0.6, 2, 2, 14, 14, 9, 9, '2012-02-24 01:50:23', '2012-05-06 14:05:48'),
(32, 'Rui', 'rui_agapito@hotmail.com', 18, 1, 0.519, 1400, 1, 0.6, 1, 1, 10, 10, 8, 8, '2012-03-05 02:42:43', '2012-05-06 14:05:48'),
(33, 'Diogo (G.)', NULL, 20, 1, 0.369, 1066, 0, 0.4, 1, 1, 9, 9, 14, 14, '2012-04-08 00:00:00', '2012-05-06 14:05:48'),
(34, 'Lobão', 'luis.lobao@gmail.com', 21, 2, 0.559, 1205, 2, 0.7, 1, 0.5, 20, 10, 16, 8, '2012-04-13 17:04:32', '2012-05-06 14:05:48'),
(35, 'Roque', NULL, 22, 1, 0.438, 0, 0, 0.4, 2, 2, 6, 6, 9, 9, '2012-04-29 09:37:33', '2012-05-06 14:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `players_teams`
--

CREATE TABLE IF NOT EXISTS `players_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

--
-- Dumping data for table `players_teams`
--

INSERT INTO `players_teams` (`id`, `player_id`, `team_id`) VALUES
(47, 14, 5),
(48, 15, 5),
(49, 17, 5),
(50, 18, 5),
(51, 21, 5),
(52, 16, 6),
(53, 20, 6),
(54, 22, 6),
(55, 23, 6),
(56, 24, 6),
(57, 14, 7),
(58, 15, 7),
(59, 20, 7),
(60, 21, 7),
(61, 30, 7),
(62, 16, 8),
(63, 18, 8),
(64, 19, 8),
(65, 22, 8),
(66, 24, 8),
(72, 14, 10),
(73, 16, 10),
(74, 19, 10),
(75, 20, 10),
(76, 23, 10),
(77, 14, 11),
(78, 18, 11),
(79, 19, 11),
(80, 23, 11),
(81, 32, 11),
(82, 15, 12),
(83, 20, 12),
(84, 21, 12),
(85, 22, 12),
(86, 25, 12),
(87, 14, 13),
(88, 16, 13),
(89, 19, 13),
(90, 20, 13),
(91, 23, 13),
(92, 15, 14),
(93, 18, 14),
(94, 21, 14),
(95, 22, 14),
(96, 25, 14),
(97, 15, 30),
(98, 16, 30),
(99, 17, 30),
(100, 20, 30),
(101, 22, 30),
(102, 14, 31),
(103, 18, 31),
(104, 19, 31),
(105, 25, 31),
(106, 30, 31),
(107, 15, 9),
(108, 21, 9),
(109, 22, 9),
(110, 28, 9),
(111, 30, 9),
(132, 15, 32),
(133, 21, 32),
(134, 20, 32),
(135, 16, 32),
(136, 19, 32),
(137, 22, 33),
(138, 30, 33),
(139, 17, 33),
(140, 23, 33),
(141, 14, 33),
(142, 21, 34),
(143, 16, 34),
(144, 18, 34),
(145, 19, 34),
(146, 14, 34),
(147, 20, 35),
(148, 22, 35),
(149, 24, 35),
(150, 17, 35),
(151, 25, 35),
(152, 21, 38),
(153, 20, 38),
(154, 22, 38),
(155, 14, 38),
(156, 25, 38),
(157, 15, 39),
(158, 16, 39),
(159, 18, 39),
(160, 19, 39),
(161, 24, 39),
(162, 15, 40),
(163, 20, 40),
(164, 31, 41),
(165, 23, 40),
(166, 14, 40),
(167, 21, 41),
(168, 16, 41),
(169, 33, 40),
(170, 17, 41),
(171, 25, 41),
(172, 16, 42),
(173, 18, 42),
(174, 17, 42),
(175, 24, 42),
(176, 22, 42),
(177, 21, 43),
(178, 15, 43),
(179, 34, 43),
(180, 19, 43),
(181, 14, 43),
(182, 21, 44),
(183, 18, 44),
(184, 20, 44),
(185, 19, 44),
(186, 22, 44),
(187, 16, 45),
(188, 15, 45),
(189, 17, 45),
(190, 14, 45),
(191, 25, 45),
(192, 17, 46),
(193, 34, 46),
(194, 18, 46),
(195, 19, 46),
(196, 14, 46),
(197, 15, 47),
(198, 35, 47),
(199, 25, 47),
(200, 23, 47),
(201, 22, 47),
(202, 16, 48),
(203, 17, 48),
(204, 19, 48),
(205, 24, 48),
(206, 23, 48),
(207, 21, 49),
(208, 15, 49),
(209, 18, 49),
(210, 14, 49),
(211, 22, 49);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(11) unsigned NOT NULL,
  `winner` tinyint(4) DEFAULT NULL,
  `golos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `game_id`, `winner`, `golos`, `created`, `modified`) VALUES
(5, 8, 0, 0, '2012-02-24 01:53:59', '2012-03-05 02:34:35'),
(6, 8, 1, 1, '2012-02-24 01:54:32', '2012-03-05 02:34:52'),
(7, 9, 1, 1, '2012-02-24 02:07:07', '2012-03-05 02:35:07'),
(8, 9, 0, 0, '2012-02-24 02:07:34', '2012-03-05 02:35:14'),
(9, 10, 1, 1, '2012-02-24 02:08:20', '2012-03-17 01:51:42'),
(10, 10, 0, 0, '2012-02-24 02:08:43', '2012-03-05 02:41:06'),
(11, 11, 1, 10, '2012-03-05 02:44:56', '2012-03-05 02:44:56'),
(12, 11, 0, 8, '2012-03-05 02:45:39', '2012-03-05 02:45:39'),
(13, 23, 0, 7, '2012-03-05 02:55:38', '2012-03-05 02:55:38'),
(14, 23, 1, 10, '2012-03-05 02:56:10', '2012-03-05 02:56:10'),
(30, 24, 1, 10, '2012-03-16 04:42:18', '2012-03-16 20:02:40'),
(31, 24, 0, 5, '2012-03-16 04:42:18', '2012-03-16 20:03:14'),
(32, 25, 1, 20, '2012-03-16 20:12:37', '2012-03-16 20:12:37'),
(33, 25, 0, 15, '2012-03-16 20:12:37', '2012-03-16 20:12:37'),
(34, 26, 1, 14, '2012-03-25 16:23:50', '2012-03-25 16:23:50'),
(35, 26, 0, 11, '2012-03-25 16:23:50', '2012-03-25 16:23:50'),
(38, 29, 0, 7, '2012-03-26 04:47:06', '2012-04-01 15:49:07'),
(39, 29, 1, 8, '2012-03-26 04:47:06', '2012-04-01 15:49:07'),
(40, 30, 0, 9, '2012-04-06 12:17:45', '2012-04-10 23:16:31'),
(41, 30, 1, 14, '2012-04-06 12:17:45', '2012-04-10 23:16:31'),
(42, 31, 0, 10, '2012-04-13 10:45:48', '2012-04-15 15:29:07'),
(43, 31, 1, 11, '2012-04-13 10:45:48', '2012-04-15 15:29:07'),
(44, 32, 0, 7, '2012-04-20 09:40:39', '2012-04-22 15:02:38'),
(45, 32, 1, 13, '2012-04-20 09:40:39', '2012-04-22 15:02:38'),
(46, 33, 1, 9, '2012-04-27 15:06:34', '2012-04-29 15:09:06'),
(47, 33, 0, 6, '2012-04-27 15:06:34', '2012-04-29 15:09:06'),
(48, 34, 0, 8, '2012-05-05 07:37:55', '2012-05-06 14:05:47'),
(49, 34, 1, 9, '2012-05-05 07:37:55', '2012-05-06 14:05:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
