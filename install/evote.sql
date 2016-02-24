-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Värd: oddput
-- Skapad: 24 februari 2016 kl 18:04
-- Serverversion: 5.1.73
-- PHP-version: 5.3.3-7+squeeze19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `evote`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `pass` varchar(254) COLLATE utf8_swedish_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `tot_votes` int(11) DEFAULT NULL,
  `nbr_choices` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `elections_alternatives`
--

CREATE TABLE IF NOT EXISTS `elections_alternatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `election_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `nbr_votes` int(11) DEFAULT NULL,
  `hash` varchar(256) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `elections_codes`
--

CREATE TABLE IF NOT EXISTS `elections_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `elections_usage`
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
-- Struktur för tabell `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `password` varchar(512) COLLATE utf8_swedish_ci DEFAULT NULL,
  `privilege` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=21 ;
