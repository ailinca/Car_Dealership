-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2016 at 12:08 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masini`
--

-- --------------------------------------------------------

--
-- Table structure for table `areextraoptiune`
--

CREATE TABLE `areextraoptiune` (
  `IDExtraOptiune` int(11) NOT NULL,
  `IDVersiune` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areextraoptiune`
--

INSERT INTO `areextraoptiune` (`IDExtraOptiune`, `IDVersiune`) VALUES
(1, 5),
(1, 11),
(2, 2),
(2, 3),
(2, 4),
(2, 7),
(3, 8),
(3, 10),
(3, 12),
(4, 6),
(4, 9),
(5, 1),
(6, 11),
(7, 5),
(7, 12),
(9, 12),
(10, 1),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `caroserie`
--

CREATE TABLE `caroserie` (
  `IDCaroserie` int(11) NOT NULL,
  `Lungime` float NOT NULL COMMENT 'metri',
  `Latime` float NOT NULL COMMENT 'metri',
  `Inaltime` float NOT NULL COMMENT 'metri',
  `Greutate` int(11) NOT NULL COMMENT 'kg',
  `GreutateMaximaPermisa` int(11) NOT NULL COMMENT 'kg',
  `Portbagaj` int(11) NOT NULL COMMENT 'Litri',
  `Rezervor` int(11) NOT NULL COMMENT 'Litri'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caroserie`
--

INSERT INTO `caroserie` (`IDCaroserie`, `Lungime`, `Latime`, `Inaltime`, `Greutate`, `GreutateMaximaPermisa`, `Portbagaj`, `Rezervor`) VALUES
(1, 4.374, 1.801, 1.282, 1330, 1645, 280, 64),
(2, 4.374, 1.801, 1.281, 1340, 1655, 280, 64),
(3, 4.404, 1.801, 1.273, 1345, 1655, 280, 64),
(4, 4.414, 1.801, 1.262, 1315, 1650, 280, 54),
(5, 4.38, 1.801, 1.294, 1340, 1655, 425, 64),
(6, 4.38, 1.801, 1.295, 1340, 1665, 425, 64),
(7, 4.404, 1.801, 1.284, 1345, 1665, 425, 64),
(8, 4.438, 1.817, 1.266, 1340, 1640, 425, 54),
(9, 4.499, 1.808, 1.295, 1460, 1915, 145, 64),
(10, 4.449, 1.852, 1.288, 1590, 2015, 125, 68),
(11, 4.507, 1.88, 1.297, 1595, 2010, 115, 68),
(12, 4.545, 1.852, 1.269, 1430, 1720, 125, 64);

-- --------------------------------------------------------

--
-- Table structure for table `extraoptiuni`
--

CREATE TABLE `extraoptiuni` (
  `IDExtraOptiune` int(11) NOT NULL,
  `NumeOptiune` varchar(255) NOT NULL,
  `Categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extraoptiuni`
--

INSERT INTO `extraoptiuni` (`IDExtraOptiune`, `NumeOptiune`, `Categorie`) VALUES
(1, 'Senzor de presiune pt a calcula masa aerului', 'Condus'),
(2, 'Filtru de aer cu dublu-tub', 'Condus'),
(3, 'Transmisie spate', 'Condus'),
(4, 'Sistem ABS de franare cu siguranta anti-incuiere', 'Siguranta'),
(5, 'Frana de parcare electrica', 'Siguranta'),
(6, 'Centuri de siguranta cu prindere in 3 locuri', 'Siguranta'),
(7, 'Incalzirea banchetei ', 'Comfort'),
(8, 'Iluminare interioara cu reglare in trepte', 'Comfort'),
(9, 'Clima bizonala', 'Comfort'),
(10, 'Modul handsfree pt telefon', 'Media'),
(11, 'Display QHD 15inch', 'Media');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `IDModel` int(11) NOT NULL,
  `Nume` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`IDModel`, `Nume`) VALUES
(1, 'Boxter'),
(2, 'Cayman'),
(3, '911'),
(4, '918 Spyder sdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `IDMotor` int(11) NOT NULL,
  `TipMotor` enum('diesel','benzina') NOT NULL DEFAULT 'benzina',
  `NrCilindri` int(11) NOT NULL,
  `Putere` int(11) NOT NULL COMMENT 'cai putere',
  `ConsumMixt` float DEFAULT NULL COMMENT 'L/100km',
  `EmisiiCO2` float DEFAULT NULL COMMENT 'g/Km',
  `Volum` float DEFAULT NULL COMMENT 'cm^3',
  `TipCutieViteze` enum('manuala','automata') NOT NULL DEFAULT 'manuala' COMMENT 'manuala/ automata'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`IDMotor`, `TipMotor`, `NrCilindri`, `Putere`, `ConsumMixt`, `EmisiiCO2`, `Volum`, `TipCutieViteze`) VALUES
(1, 'benzina', 6, 265, 8.4, 195, 2706, 'manuala'),
(2, 'benzina', 6, 315, 9, 211, 3436, 'manuala'),
(3, 'benzina', 6, 330, 9, 211, 3436, 'manuala'),
(4, 'benzina', 6, 375, 9.9, 230, 3800, 'manuala'),
(5, 'benzina', 6, 275, 8.4, 195, 2706, 'manuala'),
(6, 'diesel', 6, 325, 9, 211, 3436, 'manuala'),
(7, 'diesel', 6, 340, 9, 211, 3436, 'manuala'),
(8, 'benzina', 6, 385, 10.3, 238, 3800, 'manuala'),
(9, 'benzina', 6, 420, 7.7, 174, 2981, 'automata'),
(10, 'diesel', 6, 370, 7.9, 182, 2981, 'automata'),
(11, 'diesel', 6, 540, 9.1, 212, 3800, 'automata'),
(12, 'benzina', 6, 475, 12.4, 289, 3799, 'automata');

-- --------------------------------------------------------

--
-- Table structure for table `performante`
--

CREATE TABLE `performante` (
  `IDPerformanta` int(11) NOT NULL,
  `Acceleratie100` float DEFAULT NULL COMMENT 'secunde intre 0-100km/h',
  `VitezaMaxima` int(11) DEFAULT NULL COMMENT 'km/h',
  `Acceleratie160` float DEFAULT NULL COMMENT 'secunde intre 0-160km/h'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `performante`
--

INSERT INTO `performante` (`IDPerformanta`, `Acceleratie100`, `VitezaMaxima`, `Acceleratie160`) VALUES
(1, 5.8, 264, 13.1),
(2, 5.1, 279, 11),
(3, 5, 281, NULL),
(4, 4.5, 290, 12.4),
(5, 5.7, 266, 12.9),
(6, 5, 283, 10.8),
(7, 4.9, 285, NULL),
(8, 4.4, 295, NULL),
(9, 4.1, 306, 8.5),
(10, 4.5, 287, 9.7),
(11, 3, 320, 6.8),
(12, 3.5, 315, 7.5);

-- --------------------------------------------------------

--
-- Table structure for table `versiune`
--

CREATE TABLE `versiune` (
  `IDVersiune` int(11) NOT NULL,
  `Nume` varchar(255) NOT NULL,
  `IDModel` int(11) NOT NULL,
  `IDPerformanta` int(11) NOT NULL,
  `IDMotor` int(11) NOT NULL,
  `IDCaroserie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `versiune`
--

INSERT INTO `versiune` (`IDVersiune`, `Nume`, `IDModel`, `IDPerformanta`, `IDMotor`, `IDCaroserie`) VALUES
(1, 'Boxter TBA Black Edition', 1, 1, 1, 1),
(2, 'Boxter S', 1, 2, 2, 2),
(3, 'Boxter GTS', 1, 3, 3, 3),
(4, 'Boxer TBA Spyder', 1, 4, 4, 4),
(5, 'Cayman TBA Black Edition', 2, 5, 5, 5),
(6, 'Cayman S', 2, 6, 6, 6),
(7, 'Cayman GTS', 2, 7, 7, 7),
(8, 'Cayman TBA GT4', 2, 8, 8, 8),
(9, '911 Carrera S', 3, 9, 9, 9),
(10, '911 Targa 4', 3, 10, 10, 10),
(11, '911 Turbo', 3, 11, 11, 11),
(12, '911 GT3', 3, 12, 12, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areextraoptiune`
--
ALTER TABLE `areextraoptiune`
  ADD PRIMARY KEY (`IDExtraOptiune`,`IDVersiune`),
  ADD KEY `IDVersiune` (`IDVersiune`);

--
-- Indexes for table `caroserie`
--
ALTER TABLE `caroserie`
  ADD PRIMARY KEY (`IDCaroserie`),
  ADD KEY `IDCaroserie` (`IDCaroserie`);

--
-- Indexes for table `extraoptiuni`
--
ALTER TABLE `extraoptiuni`
  ADD PRIMARY KEY (`IDExtraOptiune`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`IDModel`),
  ADD KEY `IDModel` (`IDModel`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`IDMotor`);

--
-- Indexes for table `performante`
--
ALTER TABLE `performante`
  ADD PRIMARY KEY (`IDPerformanta`);

--
-- Indexes for table `versiune`
--
ALTER TABLE `versiune`
  ADD PRIMARY KEY (`IDVersiune`),
  ADD KEY `IDModel` (`IDModel`),
  ADD KEY `IDPerformanta` (`IDPerformanta`),
  ADD KEY `IDMotor` (`IDMotor`),
  ADD KEY `IDPerformanta_2` (`IDPerformanta`),
  ADD KEY `IDCaroserie` (`IDCaroserie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caroserie`
--
ALTER TABLE `caroserie`
  MODIFY `IDCaroserie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `extraoptiuni`
--
ALTER TABLE `extraoptiuni`
  MODIFY `IDExtraOptiune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `IDModel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `IDMotor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `performante`
--
ALTER TABLE `performante`
  MODIFY `IDPerformanta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `versiune`
--
ALTER TABLE `versiune`
  MODIFY `IDVersiune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `areextraoptiune`
--
ALTER TABLE `areextraoptiune`
  ADD CONSTRAINT `areextraoptiune_ibfk_1` FOREIGN KEY (`IDVersiune`) REFERENCES `versiune` (`IDVersiune`),
  ADD CONSTRAINT `areextraoptiune_ibfk_2` FOREIGN KEY (`IDExtraOptiune`) REFERENCES `extraoptiuni` (`IDExtraOptiune`);

--
-- Constraints for table `versiune`
--
ALTER TABLE `versiune`
  ADD CONSTRAINT `versiune_ibfk_1` FOREIGN KEY (`IDMotor`) REFERENCES `motor` (`IDMotor`),
  ADD CONSTRAINT `versiune_ibfk_2` FOREIGN KEY (`IDPerformanta`) REFERENCES `performante` (`IDPerformanta`),
  ADD CONSTRAINT `versiune_ibfk_3` FOREIGN KEY (`IDModel`) REFERENCES `model` (`IDModel`),
  ADD CONSTRAINT `versiune_ibfk_4` FOREIGN KEY (`IDCaroserie`) REFERENCES `caroserie` (`IDCaroserie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
