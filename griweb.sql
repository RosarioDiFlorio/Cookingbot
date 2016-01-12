-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Giu 24, 2015 alle 12:07
-- Versione del server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `griweb`
--
CREATE DATABASE IF NOT EXISTS `griweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `griweb`;

-- --------------------------------------------------------

--
-- Struttura della tabella `attivazioni`
--

DROP TABLE IF EXISTS `attivazioni`;
CREATE TABLE IF NOT EXISTS `attivazioni` (
  `ID_Da_Attivare` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Codice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_Da_Attivare`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessioni`
--

DROP TABLE IF EXISTS `sessioni`;
CREATE TABLE IF NOT EXISTS `sessioni` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `hash` varchar(256) CHARACTER SET utf8 NOT NULL,
  `addr` varchar(16) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
  `ID_Utente` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pwd` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `Attivo` tinyint(1) NOT NULL DEFAULT '0',
  `Is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Utente`),
  UNIQUE KEY `Email_2` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `attivazioni`
--
ALTER TABLE `attivazioni`
  ADD CONSTRAINT `attivazioni_ibfk_1` FOREIGN KEY (`ID_Da_Attivare`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sessioni`
--
ALTER TABLE `sessioni`
  ADD CONSTRAINT `sessioni_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
