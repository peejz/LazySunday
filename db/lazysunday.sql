-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2012 at 03:24 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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

CREATE TABLE `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `resultado` text NOT NULL,
  `estado` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` VALUES(8, '2012-02-05 18:30:00', '0-1', '2', '2012-02-24 01:52:32', '2012-03-05 02:47:13');
INSERT INTO `games` VALUES(9, '2012-02-12 18:30:00', '1-0', '2', '2012-02-24 02:01:42', '2012-03-05 02:47:08');
INSERT INTO `games` VALUES(10, '2012-02-19 18:30:00', '1-0', '2', '2012-02-24 02:02:17', '2012-03-05 02:46:52');
INSERT INTO `games` VALUES(11, '2012-02-26 18:30:00', '10-8', '2', '2012-02-24 02:02:53', '2012-03-05 02:46:46');
INSERT INTO `games` VALUES(23, '2012-03-04 18:30:00', '7-10', '2', '2012-03-05 02:47:50', '2012-03-05 02:48:31');
INSERT INTO `games` VALUES(24, '2012-03-11 18:30:00', '10-5', '2', '2012-03-05 03:17:55', '2012-03-05 03:18:13');
INSERT INTO `games` VALUES(25, '2012-03-18 18:30:00', '20-15', '2', '2012-03-16 20:00:54', '2012-03-25 15:25:20');
INSERT INTO `games` VALUES(26, '2012-03-25 18:30:00', '14-11', '2', '2012-03-25 16:23:40', '2012-03-25 21:52:54');
INSERT INTO `games` VALUES(29, '2012-04-01 18:30:00', '', '', '2012-03-26 04:47:02', '2012-03-31 03:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(10) unsigned NOT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `golos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` VALUES(16, 32, 11, 1);
INSERT INTO `goals` VALUES(17, 14, 11, 1);
INSERT INTO `goals` VALUES(18, 19, 11, 3);
INSERT INTO `goals` VALUES(19, 18, 11, 3);
INSERT INTO `goals` VALUES(20, 23, 11, 2);
INSERT INTO `goals` VALUES(21, 21, 11, 2);
INSERT INTO `goals` VALUES(22, 15, 11, 3);
INSERT INTO `goals` VALUES(23, 20, 11, 3);
INSERT INTO `goals` VALUES(24, 25, 11, 0);
INSERT INTO `goals` VALUES(25, 22, 11, 0);
INSERT INTO `goals` VALUES(26, 16, 23, 2);
INSERT INTO `goals` VALUES(27, 14, 23, 0);
INSERT INTO `goals` VALUES(28, 19, 23, 2);
INSERT INTO `goals` VALUES(29, 20, 23, 2);
INSERT INTO `goals` VALUES(30, 23, 23, 1);
INSERT INTO `goals` VALUES(31, 21, 23, 5);
INSERT INTO `goals` VALUES(32, 15, 23, 1);
INSERT INTO `goals` VALUES(33, 18, 23, 2);
INSERT INTO `goals` VALUES(34, 25, 23, 2);
INSERT INTO `goals` VALUES(35, 22, 23, 0);
INSERT INTO `goals` VALUES(36, 14, 24, 1);
INSERT INTO `goals` VALUES(37, 15, 24, 3);
INSERT INTO `goals` VALUES(38, 16, 24, 0);
INSERT INTO `goals` VALUES(39, 17, 24, 3);
INSERT INTO `goals` VALUES(40, 18, 24, 1);
INSERT INTO `goals` VALUES(41, 19, 24, 0);
INSERT INTO `goals` VALUES(42, 20, 24, 3);
INSERT INTO `goals` VALUES(43, 22, 24, 1);
INSERT INTO `goals` VALUES(44, 25, 24, 3);
INSERT INTO `goals` VALUES(45, 30, 24, 0);
INSERT INTO `goals` VALUES(66, 15, 25, 4);
INSERT INTO `goals` VALUES(67, 21, 25, 6);
INSERT INTO `goals` VALUES(68, 20, 25, 4);
INSERT INTO `goals` VALUES(69, 16, 25, 6);
INSERT INTO `goals` VALUES(70, 19, 25, 0);
INSERT INTO `goals` VALUES(71, 22, 25, 0);
INSERT INTO `goals` VALUES(72, 30, 25, 7);
INSERT INTO `goals` VALUES(73, 17, 25, 3);
INSERT INTO `goals` VALUES(74, 23, 25, 3);
INSERT INTO `goals` VALUES(75, 14, 25, 2);
INSERT INTO `goals` VALUES(76, 21, 26, 3);
INSERT INTO `goals` VALUES(77, 16, 26, 6);
INSERT INTO `goals` VALUES(78, 18, 26, 3);
INSERT INTO `goals` VALUES(79, 19, 26, 0);
INSERT INTO `goals` VALUES(80, 14, 26, 2);
INSERT INTO `goals` VALUES(81, 20, 26, 4);
INSERT INTO `goals` VALUES(82, 22, 26, 0);
INSERT INTO `goals` VALUES(83, 24, 26, 1);
INSERT INTO `goals` VALUES(84, 17, 26, 4);
INSERT INTO `goals` VALUES(85, 25, 26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` VALUES(13, 11, 14, 1, '2012-03-02 16:09:34', '2012-03-02 16:09:34');
INSERT INTO `invites` VALUES(14, 11, 15, 1, '2012-03-02 16:09:40', '2012-03-02 16:09:40');
INSERT INTO `invites` VALUES(15, 11, 16, 1, '2012-03-02 16:09:44', '2012-03-02 16:09:44');
INSERT INTO `invites` VALUES(16, 11, 17, 1, '2012-03-02 16:09:50', '2012-03-02 16:09:50');
INSERT INTO `invites` VALUES(17, 11, 18, 1, '2012-03-02 16:09:55', '2012-03-02 16:09:55');
INSERT INTO `invites` VALUES(18, 11, 19, 1, '2012-03-02 16:10:03', '2012-03-02 16:10:03');
INSERT INTO `invites` VALUES(20, 11, 20, 1, '2012-03-02 16:10:29', '2012-03-02 16:10:29');
INSERT INTO `invites` VALUES(21, 11, 29, 0, '2012-03-03 23:25:05', '2012-03-03 23:25:05');
INSERT INTO `invites` VALUES(22, 11, 28, 0, '2012-03-03 23:27:30', '2012-03-03 23:27:30');
INSERT INTO `invites` VALUES(42, 22, 14, 0, '2012-03-04 01:31:25', '2012-03-04 01:31:25');
INSERT INTO `invites` VALUES(43, 22, 15, 1, '2012-03-04 01:31:25', '2012-03-04 01:31:25');
INSERT INTO `invites` VALUES(44, 22, 16, NULL, '2012-03-04 01:31:25', '2012-03-04 01:31:25');
INSERT INTO `invites` VALUES(45, 0, 0, 0, '2012-03-04 17:51:51', '2012-03-04 17:51:51');
INSERT INTO `invites` VALUES(46, 0, 0, 0, '2012-03-04 17:52:22', '2012-03-04 17:52:22');
INSERT INTO `invites` VALUES(47, 0, 0, 0, '2012-03-04 17:52:43', '2012-03-04 17:52:44');
INSERT INTO `invites` VALUES(48, 0, 0, 0, '2012-03-04 17:53:15', '2012-03-04 17:53:15');
INSERT INTO `invites` VALUES(49, 0, 0, 0, '2012-03-04 17:53:47', '2012-03-04 17:53:48');
INSERT INTO `invites` VALUES(50, 0, 0, 0, '2012-03-04 17:54:00', '2012-03-04 17:54:01');
INSERT INTO `invites` VALUES(51, 22, 17, NULL, '2012-03-04 18:06:55', '2012-03-04 18:06:55');
INSERT INTO `invites` VALUES(52, 22, 19, 1, '2012-03-04 18:06:55', '2012-03-04 18:06:55');
INSERT INTO `invites` VALUES(53, 22, 18, 1, '2012-03-04 18:07:06', '2012-03-04 18:07:06');
INSERT INTO `invites` VALUES(54, 24, 14, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(55, 24, 15, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(56, 24, 16, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(57, 24, 18, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(58, 24, 19, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(59, 24, 20, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(60, 24, 21, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(61, 24, 22, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(62, 24, 24, 1, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(63, 24, 25, 0, '2012-03-05 03:17:55', '2012-03-05 03:17:55');
INSERT INTO `invites` VALUES(64, 24, 17, 0, '2012-03-16 02:55:14', '2012-03-16 02:55:14');
INSERT INTO `invites` VALUES(65, 25, 14, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(66, 25, 16, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(67, 25, 17, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(68, 25, 18, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(69, 25, 19, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(70, 25, 20, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(71, 25, 21, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(72, 25, 22, 1, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(73, 25, 24, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(74, 25, 25, 0, '2012-03-16 20:00:54', '2012-03-16 20:00:54');
INSERT INTO `invites` VALUES(75, 25, 15, 1, '2012-03-17 01:58:22', '2012-03-17 01:58:22');
INSERT INTO `invites` VALUES(76, 25, 30, 1, '2012-03-17 02:22:30', '2012-03-17 02:22:30');
INSERT INTO `invites` VALUES(77, 25, 26, NULL, '2012-03-17 02:54:05', '2012-03-17 02:54:05');
INSERT INTO `invites` VALUES(78, 25, 23, 1, '2012-03-17 02:58:53', '2012-03-17 02:58:53');
INSERT INTO `invites` VALUES(79, 25, 27, NULL, '2012-03-17 02:58:53', '2012-03-17 02:58:53');
INSERT INTO `invites` VALUES(80, 25, 32, NULL, '2012-03-18 04:26:24', '2012-03-18 04:26:24');
INSERT INTO `invites` VALUES(81, 26, 14, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(82, 26, 16, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(83, 26, 17, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(84, 26, 18, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(85, 26, 19, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(86, 26, 20, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(87, 26, 21, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(88, 26, 22, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(89, 26, 24, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(90, 26, 25, 1, '2012-03-25 16:23:40', '2012-03-25 16:23:40');
INSERT INTO `invites` VALUES(91, 27, 14, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(92, 27, 16, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(93, 27, 17, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(94, 27, 18, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(95, 27, 19, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(96, 27, 20, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(97, 27, 21, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(98, 27, 22, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(99, 27, 24, 0, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(100, 27, 25, 1, '2012-03-25 23:01:39', '2012-03-25 23:01:39');
INSERT INTO `invites` VALUES(101, 27, 15, 1, '2012-03-25 23:03:30', '2012-03-25 23:03:30');
INSERT INTO `invites` VALUES(102, 27, 23, NULL, '2012-03-25 23:03:30', '2012-03-25 23:03:30');
INSERT INTO `invites` VALUES(114, 29, 14, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(115, 29, 16, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(116, 29, 17, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(117, 29, 18, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(118, 29, 19, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(119, 29, 20, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(120, 29, 21, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(121, 29, 22, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(122, 29, 24, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');
INSERT INTO `invites` VALUES(123, 29, 25, NULL, '2012-03-31 03:17:57', '2012-03-31 03:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `presencas` int(11) NOT NULL,
  `ranking` float NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` VALUES(14, 'Peej', 8, 0.356, 3, 0.375, 6, 1.2, 51, 10.2, 59, 11.8, '2012-02-24 01:46:18', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(15, 'Andre', 7, 0.707, 5, 0.714, 11, 2.75, 48, 12, 37, 9.25, '2012-02-24 01:46:31', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(16, 'Vitorino', 7, 0.647, 4, 0.571, 14, 3.5, 51, 12.75, 41, 10.25, '2012-02-24 01:46:43', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(17, 'Vazantes', 4, 0.396, 1, 0.25, 10, 3.33, 36, 12, 39, 13, '2012-02-24 01:46:58', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(18, 'Ricardo', 6, 0.516, 3, 0.5, 9, 2.25, 39, 9.75, 36, 9, '2012-02-24 01:47:08', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(19, 'Fresco', 7, 0.384, 3, 0.429, 5, 1, 56, 11.2, 54, 10.8, '2012-02-24 01:47:21', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(20, 'Far', 8, 0.575, 4, 0.5, 16, 3.2, 56, 11.2, 54, 10.8, '2012-02-24 01:47:37', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(21, 'Barroso', 7, 0.786, 5, 0.714, 16, 4, 52, 13, 43, 10.75, '2012-02-24 01:47:45', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(22, 'Anselmo', 8, 0.388, 4, 0.5, 1, 0.2, 54, 10.8, 56, 11.2, '2012-02-24 01:48:03', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(23, 'Bruno Gomes', 5, 0.425, 2, 0.4, 6, 2, 32, 10.67, 38, 12.67, '2012-02-24 01:48:21', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(24, 'Nunao', 3, 0.312, 1, 0.333, 1, 1, 11, 11, 14, 14, '2012-02-24 01:48:32', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(25, 'Louie', 4, 0.297, 1, 0.25, 7, 1.75, 34, 8.5, 41, 10.25, '2012-02-24 01:49:04', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(26, 'Ico', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-24 01:49:22', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(27, 'Julio', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-24 01:49:38', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(28, 'Nuno Anselmo', 1, 0.75, 1, 1, 0, 0, 0, 0, 0, 0, '2012-02-24 01:49:53', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(29, 'Gaspar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-24 01:50:02', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(30, 'Afonso', 4, 0.594, 2, 0.5, 7, 3.5, 20, 10, 30, 15, '2012-02-24 01:50:15', '2012-03-31 03:13:34');
INSERT INTO `players` VALUES(31, 'MDK', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012-02-24 01:50:23', '2012-03-31 03:13:35');
INSERT INTO `players` VALUES(32, 'Rui', 1, 0.813, 1, 1, 1, 1, 10, 10, 8, 8, '2012-03-05 02:42:43', '2012-03-31 03:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `players_teams`
--

CREATE TABLE `players_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Dumping data for table `players_teams`
--

INSERT INTO `players_teams` VALUES(47, 14, 5);
INSERT INTO `players_teams` VALUES(48, 15, 5);
INSERT INTO `players_teams` VALUES(49, 17, 5);
INSERT INTO `players_teams` VALUES(50, 18, 5);
INSERT INTO `players_teams` VALUES(51, 21, 5);
INSERT INTO `players_teams` VALUES(52, 16, 6);
INSERT INTO `players_teams` VALUES(53, 20, 6);
INSERT INTO `players_teams` VALUES(54, 22, 6);
INSERT INTO `players_teams` VALUES(55, 23, 6);
INSERT INTO `players_teams` VALUES(56, 24, 6);
INSERT INTO `players_teams` VALUES(57, 14, 7);
INSERT INTO `players_teams` VALUES(58, 15, 7);
INSERT INTO `players_teams` VALUES(59, 20, 7);
INSERT INTO `players_teams` VALUES(60, 21, 7);
INSERT INTO `players_teams` VALUES(61, 30, 7);
INSERT INTO `players_teams` VALUES(62, 16, 8);
INSERT INTO `players_teams` VALUES(63, 18, 8);
INSERT INTO `players_teams` VALUES(64, 19, 8);
INSERT INTO `players_teams` VALUES(65, 22, 8);
INSERT INTO `players_teams` VALUES(66, 24, 8);
INSERT INTO `players_teams` VALUES(72, 14, 10);
INSERT INTO `players_teams` VALUES(73, 16, 10);
INSERT INTO `players_teams` VALUES(74, 19, 10);
INSERT INTO `players_teams` VALUES(75, 20, 10);
INSERT INTO `players_teams` VALUES(76, 23, 10);
INSERT INTO `players_teams` VALUES(77, 14, 11);
INSERT INTO `players_teams` VALUES(78, 18, 11);
INSERT INTO `players_teams` VALUES(79, 19, 11);
INSERT INTO `players_teams` VALUES(80, 23, 11);
INSERT INTO `players_teams` VALUES(81, 32, 11);
INSERT INTO `players_teams` VALUES(82, 15, 12);
INSERT INTO `players_teams` VALUES(83, 20, 12);
INSERT INTO `players_teams` VALUES(84, 21, 12);
INSERT INTO `players_teams` VALUES(85, 22, 12);
INSERT INTO `players_teams` VALUES(86, 25, 12);
INSERT INTO `players_teams` VALUES(87, 14, 13);
INSERT INTO `players_teams` VALUES(88, 16, 13);
INSERT INTO `players_teams` VALUES(89, 19, 13);
INSERT INTO `players_teams` VALUES(90, 20, 13);
INSERT INTO `players_teams` VALUES(91, 23, 13);
INSERT INTO `players_teams` VALUES(92, 15, 14);
INSERT INTO `players_teams` VALUES(93, 18, 14);
INSERT INTO `players_teams` VALUES(94, 21, 14);
INSERT INTO `players_teams` VALUES(95, 22, 14);
INSERT INTO `players_teams` VALUES(96, 25, 14);
INSERT INTO `players_teams` VALUES(97, 15, 30);
INSERT INTO `players_teams` VALUES(98, 16, 30);
INSERT INTO `players_teams` VALUES(99, 17, 30);
INSERT INTO `players_teams` VALUES(100, 20, 30);
INSERT INTO `players_teams` VALUES(101, 22, 30);
INSERT INTO `players_teams` VALUES(102, 14, 31);
INSERT INTO `players_teams` VALUES(103, 18, 31);
INSERT INTO `players_teams` VALUES(104, 19, 31);
INSERT INTO `players_teams` VALUES(105, 25, 31);
INSERT INTO `players_teams` VALUES(106, 30, 31);
INSERT INTO `players_teams` VALUES(107, 15, 9);
INSERT INTO `players_teams` VALUES(108, 21, 9);
INSERT INTO `players_teams` VALUES(109, 22, 9);
INSERT INTO `players_teams` VALUES(110, 28, 9);
INSERT INTO `players_teams` VALUES(111, 30, 9);
INSERT INTO `players_teams` VALUES(132, 15, 32);
INSERT INTO `players_teams` VALUES(133, 21, 32);
INSERT INTO `players_teams` VALUES(134, 20, 32);
INSERT INTO `players_teams` VALUES(135, 16, 32);
INSERT INTO `players_teams` VALUES(136, 19, 32);
INSERT INTO `players_teams` VALUES(137, 22, 33);
INSERT INTO `players_teams` VALUES(138, 30, 33);
INSERT INTO `players_teams` VALUES(139, 17, 33);
INSERT INTO `players_teams` VALUES(140, 23, 33);
INSERT INTO `players_teams` VALUES(141, 14, 33);
INSERT INTO `players_teams` VALUES(142, 21, 34);
INSERT INTO `players_teams` VALUES(143, 16, 34);
INSERT INTO `players_teams` VALUES(144, 18, 34);
INSERT INTO `players_teams` VALUES(145, 19, 34);
INSERT INTO `players_teams` VALUES(146, 14, 34);
INSERT INTO `players_teams` VALUES(147, 20, 35);
INSERT INTO `players_teams` VALUES(148, 22, 35);
INSERT INTO `players_teams` VALUES(149, 24, 35);
INSERT INTO `players_teams` VALUES(150, 17, 35);
INSERT INTO `players_teams` VALUES(151, 25, 35);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(11) unsigned NOT NULL,
  `golos` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` VALUES(5, 8, 0, '2012-02-24 01:53:59', '2012-03-05 02:34:35');
INSERT INTO `teams` VALUES(6, 8, 1, '2012-02-24 01:54:32', '2012-03-05 02:34:52');
INSERT INTO `teams` VALUES(7, 9, 1, '2012-02-24 02:07:07', '2012-03-05 02:35:07');
INSERT INTO `teams` VALUES(8, 9, 0, '2012-02-24 02:07:34', '2012-03-05 02:35:14');
INSERT INTO `teams` VALUES(9, 10, 1, '2012-02-24 02:08:20', '2012-03-17 01:51:42');
INSERT INTO `teams` VALUES(10, 10, 0, '2012-02-24 02:08:43', '2012-03-05 02:41:06');
INSERT INTO `teams` VALUES(11, 11, 10, '2012-03-05 02:44:56', '2012-03-05 02:44:56');
INSERT INTO `teams` VALUES(12, 11, 8, '2012-03-05 02:45:39', '2012-03-05 02:45:39');
INSERT INTO `teams` VALUES(13, 23, 7, '2012-03-05 02:55:38', '2012-03-05 02:55:38');
INSERT INTO `teams` VALUES(14, 23, 10, '2012-03-05 02:56:10', '2012-03-05 02:56:10');
INSERT INTO `teams` VALUES(30, 24, 10, '2012-03-16 04:42:18', '2012-03-16 20:02:40');
INSERT INTO `teams` VALUES(31, 24, 5, '2012-03-16 04:42:18', '2012-03-16 20:03:14');
INSERT INTO `teams` VALUES(32, 25, 20, '2012-03-16 20:12:37', '2012-03-16 20:12:37');
INSERT INTO `teams` VALUES(33, 25, 15, '2012-03-16 20:12:37', '2012-03-16 20:12:37');
INSERT INTO `teams` VALUES(34, 26, 14, '2012-03-25 16:23:50', '2012-03-25 16:23:50');
INSERT INTO `teams` VALUES(35, 26, 11, '2012-03-25 16:23:50', '2012-03-25 16:23:50');
INSERT INTO `teams` VALUES(38, 29, 0, '2012-03-26 04:47:06', '2012-03-26 04:47:06');
INSERT INTO `teams` VALUES(39, 29, 0, '2012-03-26 04:47:06', '2012-03-26 04:47:06');
