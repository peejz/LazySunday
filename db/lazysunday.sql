-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2012 at 02:53 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lazysunday`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `data`, `resultado`, `estado`, `created`, `modified`) VALUES
(8, '2012-02-05 18:30:00', '0-1', '2', '2012-02-24 01:52:32', '2012-03-05 02:47:13'),
(9, '2012-02-12 18:30:00', '1-0', '2', '2012-02-24 02:01:42', '2012-03-05 02:47:08'),
(10, '2012-02-19 18:30:00', '1-0', '2', '2012-02-24 02:02:17', '2012-03-05 02:46:52'),
(11, '2012-02-26 18:30:00', '10-8', '2', '2012-02-24 02:02:53', '2012-03-05 02:46:46'),
(23, '2012-03-04 18:30:00', '7-10', '2', '2012-03-05 02:47:50', '2012-03-05 02:48:31'),
(24, '2012-03-11 18:30:00', '', '0', '2012-03-05 03:17:55', '2012-03-05 03:18:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

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
(35, 22, 23, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

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
(54, 24, 14, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(55, 24, 15, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(56, 24, 16, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(57, 24, 18, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(58, 24, 19, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(59, 24, 20, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(60, 24, 21, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(61, 24, 22, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(62, 24, 24, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55'),
(63, 24, 25, NULL, '2012-03-05 03:17:55', '2012-03-05 03:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `presencas` int(11) NOT NULL,
  `ranking` float NOT NULL,
  `vitorias` int(11) NOT NULL,
  `golos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `nome`, `presencas`, `ranking`, `vitorias`, `golos`, `created`, `modified`) VALUES
(14, 'Peej', 0, 0, 0, 0, '2012-02-24 01:46:18', '2012-02-24 01:46:18'),
(15, 'AndrÃ©', 0, 0, 0, 0, '2012-02-24 01:46:31', '2012-02-24 01:46:31'),
(16, 'Vitorino', 0, 0, 0, 0, '2012-02-24 01:46:43', '2012-02-24 01:46:43'),
(17, 'Vazantes', 0, 0, 0, 0, '2012-02-24 01:46:58', '2012-02-24 01:46:58'),
(18, 'Ricardo', 0, 0, 0, 0, '2012-02-24 01:47:08', '2012-02-24 01:47:08'),
(19, 'Fresco', 0, 0, 0, 0, '2012-02-24 01:47:21', '2012-02-24 01:47:21'),
(20, 'Far', 0, 0, 0, 0, '2012-02-24 01:47:37', '2012-02-24 01:47:37'),
(21, 'Barroso', 0, 0, 0, 0, '2012-02-24 01:47:45', '2012-02-24 01:47:45'),
(22, 'Anselmo', 0, 0, 0, 0, '2012-02-24 01:48:03', '2012-02-24 01:48:03'),
(23, 'Bruno Gomes', 0, 0, 0, 0, '2012-02-24 01:48:21', '2012-02-24 01:48:21'),
(24, 'NunÃ£o', 0, 0, 0, 0, '2012-02-24 01:48:32', '2012-02-24 01:48:32'),
(25, 'Louie', 0, 0, 0, 0, '2012-02-24 01:49:04', '2012-02-24 01:49:04'),
(26, 'Ico', 0, 0, 0, 0, '2012-02-24 01:49:22', '2012-02-24 01:49:22'),
(27, 'JÃºlio', 0, 0, 0, 0, '2012-02-24 01:49:38', '2012-02-24 01:49:38'),
(28, 'Nuno Anselmo', 0, 0, 0, 0, '2012-02-24 01:49:53', '2012-02-24 01:49:53'),
(29, 'Gaspar', 0, 0, 0, 0, '2012-02-24 01:50:02', '2012-02-24 01:50:02'),
(30, 'Afonso', 0, 0, 0, 0, '2012-02-24 01:50:15', '2012-02-24 01:50:15'),
(31, 'MDK', 0, 0, 0, 0, '2012-02-24 01:50:23', '2012-02-24 01:50:23'),
(32, 'Rui', 0, 0, 0, 0, '2012-03-05 02:42:43', '2012-03-05 02:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `players_teams`
--

CREATE TABLE IF NOT EXISTS `players_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

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
(67, 15, 9),
(68, 21, 9),
(69, 22, 9),
(70, 24, 9),
(71, 30, 9),
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
(96, 25, 14);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(11) unsigned NOT NULL,
  `golos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `game_id`, `golos`, `created`, `modified`) VALUES
(5, 8, 0, '2012-02-24 01:53:59', '2012-03-05 02:34:35'),
(6, 8, 1, '2012-02-24 01:54:32', '2012-03-05 02:34:52'),
(7, 9, 1, '2012-02-24 02:07:07', '2012-03-05 02:35:07'),
(8, 9, 0, '2012-02-24 02:07:34', '2012-03-05 02:35:14'),
(9, 10, 1, '2012-02-24 02:08:20', '2012-03-05 02:40:34'),
(10, 10, 0, '2012-02-24 02:08:43', '2012-03-05 02:41:06'),
(11, 11, 10, '2012-03-05 02:44:56', '2012-03-05 02:44:56'),
(12, 11, 8, '2012-03-05 02:45:39', '2012-03-05 02:45:39'),
(13, 23, 7, '2012-03-05 02:55:38', '2012-03-05 02:55:38'),
(14, 23, 10, '2012-03-05 02:56:10', '2012-03-05 02:56:10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
