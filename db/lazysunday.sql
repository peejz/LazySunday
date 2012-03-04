-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2012 at 02:27 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `data`, `resultado`, `estado`, `created`, `modified`) VALUES
(8, '2012-02-05 18:30:00', '10-9', 'Concluido', '2012-02-24 01:52:32', '2012-02-24 01:52:32'),
(9, '2012-02-12 18:30:00', '15-12', 'ConcluÃ­do', '2012-02-24 02:01:42', '2012-02-24 02:01:42'),
(10, '2012-02-19 18:30:00', '7-6', 'ConcluÃ­do', '2012-02-24 02:02:17', '2012-02-24 02:02:17'),
(11, '2012-02-26 18:30:00', '', 'Por Realizar', '2012-02-24 02:02:53', '2012-02-24 02:02:53'),
(22, '2012-03-04 01:31:00', '', '', '2012-03-04 01:31:25', '2012-03-04 01:31:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `player_id`, `game_id`, `golos`) VALUES
(6, 14, 8, 2),
(7, 18, 8, 2),
(8, 17, 8, 2),
(9, 15, 8, 1),
(10, 21, 8, 2),
(11, 16, 8, 5),
(12, 20, 8, 3),
(13, 24, 8, 1),
(14, 23, 8, 1),
(15, 22, 8, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `game_id`, `player_id`, `available`, `created`, `modified`) VALUES
(13, 11, 14, 0, '2012-03-02 16:09:34', '2012-03-02 16:09:34'),
(14, 11, 15, 1, '2012-03-02 16:09:40', '2012-03-02 16:09:40'),
(15, 11, 16, 1, '2012-03-02 16:09:44', '2012-03-02 16:09:44'),
(16, 11, 17, 1, '2012-03-02 16:09:50', '2012-03-02 16:09:50'),
(17, 11, 18, 1, '2012-03-02 16:09:55', '2012-03-02 16:09:55'),
(18, 11, 19, 0, '2012-03-02 16:10:03', '2012-03-02 16:10:03'),
(20, 11, 20, 0, '2012-03-02 16:10:29', '2012-03-02 16:10:29'),
(21, 11, 29, 0, '2012-03-03 23:25:05', '2012-03-03 23:25:05'),
(22, 11, 28, NULL, '2012-03-03 23:27:30', '2012-03-03 23:27:30'),
(42, 22, 14, 1, '2012-03-04 01:31:25', '2012-03-04 01:31:25'),
(43, 22, 15, 0, '2012-03-04 01:31:25', '2012-03-04 01:31:25'),
(44, 22, 16, NULL, '2012-03-04 01:31:25', '2012-03-04 01:31:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

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
(31, 'MDK', 0, 0, 0, 0, '2012-02-24 01:50:23', '2012-02-24 01:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `players_teams`
--

CREATE TABLE IF NOT EXISTS `players_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `players_teams`
--

INSERT INTO `players_teams` (`id`, `player_id`, `team_id`) VALUES
(15, 14, 5),
(16, 15, 5),
(17, 17, 5),
(18, 18, 5),
(19, 21, 5),
(20, 16, 6),
(21, 20, 6),
(22, 22, 6),
(23, 23, 6),
(24, 24, 6),
(25, 14, 7),
(26, 15, 7),
(27, 20, 7),
(28, 21, 7),
(29, 30, 7),
(30, 16, 8),
(31, 18, 8),
(32, 19, 8),
(33, 22, 8),
(34, 24, 8),
(35, 24, 9),
(36, 30, 9),
(42, 14, 10),
(43, 16, 10),
(44, 19, 10),
(45, 20, 10),
(46, 23, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `game_id`, `golos`, `created`, `modified`) VALUES
(5, 8, 9, '2012-02-24 01:53:59', '2012-02-24 01:53:59'),
(6, 8, 10, '2012-02-24 01:54:32', '2012-02-24 01:54:32'),
(7, 9, 15, '2012-02-24 02:07:07', '2012-02-24 02:07:07'),
(8, 9, 12, '2012-02-24 02:07:34', '2012-02-24 02:07:34'),
(9, 10, 7, '2012-02-24 02:08:20', '2012-02-24 02:08:20'),
(10, 10, 6, '2012-02-24 02:08:43', '2012-02-24 02:09:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
