-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2016 at 12:02 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `griweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attivazioni`-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2016 at 12:09 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `griweb`
--
CREATE DATABASE IF NOT EXISTS `griweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `griweb`;

-- --------------------------------------------------------

--
-- Table structure for table `attivazioni`
--

CREATE TABLE `attivazioni` (
  `ID_Da_Attivare` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Codice` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ricette`
--

CREATE TABLE `ricette` (
  `id_ricetta` int(11) NOT NULL,
  `nome_ricetta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ricette`
--

INSERT INTO `ricette` (`id_ricetta`, `nome_ricetta`) VALUES
(22, 'ricetta2');

-- --------------------------------------------------------

--
-- Table structure for table `sessioni`
--

CREATE TABLE `sessioni` (
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `hash` varchar(256) CHARACTER SET utf8 NOT NULL,
  `addr` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sostituzioni`
--

CREATE TABLE `sostituzioni` (
  `id_sub` int(11) NOT NULL,
  `nome_sub` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sostituzioni`
--

INSERT INTO `sostituzioni` (`id_sub`, `nome_sub`) VALUES
(1, 'sub1');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `ID_Utente` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pwd` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `Attivo` tinyint(1) NOT NULL DEFAULT '0',
  `Is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Email`, `Pwd`, `Attivo`, `Is_admin`) VALUES
(1, 'prova@prova', 'prova', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `votazioni_ricette`
--

CREATE TABLE `votazioni_ricette` (
  `id_votazione_ric` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_ricetta` int(11) NOT NULL,
  `voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votazioni_ricette`
--

INSERT INTO `votazioni_ricette` (`id_votazione_ric`, `id_utente`, `id_ricetta`, `voto`) VALUES
(38, 1, 20, 30),
(39, 1, 21, 30),
(40, 1, 22, 30);

-- --------------------------------------------------------

--
-- Table structure for table `votazioni_sostituzioni`
--

CREATE TABLE `votazioni_sostituzioni` (
  `id_votazione_sub` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votazioni_sostituzioni`
--

INSERT INTO `votazioni_sostituzioni` (`id_votazione_sub`, `id_utente`, `id_sub`, `voto`) VALUES
(2, 1, 1, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attivazioni`
--
ALTER TABLE `attivazioni`
  ADD PRIMARY KEY (`ID_Da_Attivare`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `ricette`
--
ALTER TABLE `ricette`
  ADD PRIMARY KEY (`id_ricetta`),
  ADD UNIQUE KEY `nome_ricetta` (`nome_ricetta`);

--
-- Indexes for table `sessioni`
--
ALTER TABLE `sessioni`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sostituzioni`
--
ALTER TABLE `sostituzioni`
  ADD PRIMARY KEY (`id_sub`),
  ADD UNIQUE KEY `nome_sub` (`nome_sub`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_Utente`),
  ADD UNIQUE KEY `Email_2` (`Email`);

--
-- Indexes for table `votazioni_ricette`
--
ALTER TABLE `votazioni_ricette`
  ADD PRIMARY KEY (`id_votazione_ric`);

--
-- Indexes for table `votazioni_sostituzioni`
--
ALTER TABLE `votazioni_sostituzioni`
  ADD PRIMARY KEY (`id_votazione_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ricette`
--
ALTER TABLE `ricette`
  MODIFY `id_ricetta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sessioni`
--
ALTER TABLE `sessioni`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sostituzioni`
--
ALTER TABLE `sostituzioni`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_Utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `votazioni_ricette`
--
ALTER TABLE `votazioni_ricette`
  MODIFY `id_votazione_ric` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `votazioni_sostituzioni`
--
ALTER TABLE `votazioni_sostituzioni`
  MODIFY `id_votazione_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attivazioni`
--
ALTER TABLE `attivazioni`
  ADD CONSTRAINT `attivazioni_ibfk_1` FOREIGN KEY (`ID_Da_Attivare`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessioni`
--
ALTER TABLE `sessioni`
  ADD CONSTRAINT `sessioni_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--

CREATE TABLE `attivazioni` (
  `ID_Da_Attivare` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Codice` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ricette`
--

CREATE TABLE `ricette` (
  `id_ricetta` int(11) NOT NULL,
  `nome_ricetta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ricette`
--

INSERT INTO `ricette` (`id_ricetta`, `nome_ricetta`) VALUES
(22, 'ricetta2');

-- --------------------------------------------------------

--
-- Table structure for table `sessioni`
--

CREATE TABLE `sessioni` (
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  `hash` varchar(256) CHARACTER SET utf8 NOT NULL,
  `addr` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sostituzioni`
--

CREATE TABLE `sostituzioni` (
  `id_sub` int(11) NOT NULL,
  `nome_sub` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sostituzioni`
--

INSERT INTO `sostituzioni` (`id_sub`, `nome_sub`) VALUES
(1, 'sub1');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `ID_Utente` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pwd` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `Attivo` tinyint(1) NOT NULL DEFAULT '0',
  `Is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`ID_Utente`, `Email`, `Pwd`, `Attivo`, `Is_admin`) VALUES
(1, 'prova@prova', 'prova', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `votazioni_ricette`
--

CREATE TABLE `votazioni_ricette` (
  `id_votazione_ric` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_ricetta` int(11) NOT NULL,
  `voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votazioni_ricette`
--

INSERT INTO `votazioni_ricette` (`id_votazione_ric`, `id_utente`, `id_ricetta`, `voto`) VALUES
(38, 1, 20, 30),
(39, 1, 21, 30),
(40, 1, 22, 30);

-- --------------------------------------------------------

--
-- Table structure for table `votazioni_sostituzioni`
--

CREATE TABLE `votazioni_sostituzioni` (
  `id_votazione_sub` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votazioni_sostituzioni`
--

INSERT INTO `votazioni_sostituzioni` (`id_votazione_sub`, `id_utente`, `id_sub`, `voto`) VALUES
(2, 1, 1, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attivazioni`
--
ALTER TABLE `attivazioni`
  ADD PRIMARY KEY (`ID_Da_Attivare`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `ricette`
--
ALTER TABLE `ricette`
  ADD PRIMARY KEY (`id_ricetta`),
  ADD UNIQUE KEY `nome_ricetta` (`nome_ricetta`);

--
-- Indexes for table `sessioni`
--
ALTER TABLE `sessioni`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `sostituzioni`
--
ALTER TABLE `sostituzioni`
  ADD PRIMARY KEY (`id_sub`),
  ADD UNIQUE KEY `nome_sub` (`nome_sub`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_Utente`),
  ADD UNIQUE KEY `Email_2` (`Email`);

--
-- Indexes for table `votazioni_ricette`
--
ALTER TABLE `votazioni_ricette`
  ADD PRIMARY KEY (`id_votazione_ric`);

--
-- Indexes for table `votazioni_sostituzioni`
--
ALTER TABLE `votazioni_sostituzioni`
  ADD PRIMARY KEY (`id_votazione_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ricette`
--
ALTER TABLE `ricette`
  MODIFY `id_ricetta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sessioni`
--
ALTER TABLE `sessioni`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sostituzioni`
--
ALTER TABLE `sostituzioni`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_Utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `votazioni_ricette`
--
ALTER TABLE `votazioni_ricette`
  MODIFY `id_votazione_ric` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `votazioni_sostituzioni`
--
ALTER TABLE `votazioni_sostituzioni`
  MODIFY `id_votazione_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attivazioni`
--
ALTER TABLE `attivazioni`
  ADD CONSTRAINT `attivazioni_ibfk_1` FOREIGN KEY (`ID_Da_Attivare`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessioni`
--
ALTER TABLE `sessioni`
  ADD CONSTRAINT `sessioni_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `utente` (`ID_Utente`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
