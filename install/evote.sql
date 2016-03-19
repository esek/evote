-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 19 mars 2016 kl 11:54
-- Serverversion: 5.5.47-0ubuntu0.14.04.1
-- PHP-version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `evote`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_swedish_ci NOT NULL,
  `pass` varchar(254) COLLATE utf8_swedish_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `tot_votes` int(11) DEFAULT NULL,
  `nbr_choices` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `elections_alternatives`
--

CREATE TABLE IF NOT EXISTS `elections_alternatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `nbr_votes` int(11) DEFAULT NULL,
  `hash` varchar(256) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `elections_codes`
--

CREATE TABLE IF NOT EXISTS `elections_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `elections_usage`
--

CREATE TABLE IF NOT EXISTS `elections_usage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `alternative_id` int(11) NOT NULL,
  `code_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `password` varchar(512) COLLATE utf8_swedish_ci DEFAULT NULL,
  `privilege` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=20 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
