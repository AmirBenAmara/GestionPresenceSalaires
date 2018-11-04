-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2018 at 05:14 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fridavert`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `idEmployee` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CIN` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `numTel` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idEmployee`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idEmployee`, `nom`, `prenom`, `CIN`, `numTel`) VALUES
(1, 'Mhamdi', 'Oussama', '123456', '132456'),
(2, 'Dhif', 'Abdelmlak', '123456', '123465'),
(3, 'BenAmara', 'Amir', '123456', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

DROP TABLE IF EXISTS `presence`;
CREATE TABLE IF NOT EXISTS `presence` (
  `idPresence` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `montant_day` int(11) DEFAULT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `idWeek` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPresence`),
  KEY `IDX_9001A5F3E3C5FFA` (`idEmployee`),
  KEY `IDX_9001A5F328A7375E` (`idWeek`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`idPresence`, `date`, `status`, `lieu`, `montant_day`, `idEmployee`, `idWeek`) VALUES
(20, '2018-11-03', 'Absent', 'Tunis', 0, 1, 41),
(21, '2018-11-03', 'Present', 'Tunis', 0, 2, 41),
(22, '2018-11-03', 'Absent', 'Tunis', 0, 3, 41),
(23, '2018-11-03', 'Present', 'Tunis', 30, 1, 41),
(24, '2018-11-03', 'Present', 'Tunis', 80, 2, 41),
(25, '2018-11-03', 'Absent', 'Tunis', 50, 3, 41),
(29, '2018-11-04', 'Absent', 'Sousse', 30, 1, 41),
(30, '2018-11-04', 'Absent', 'Sousse', 20, 2, 41),
(31, '2018-11-04', 'Absent', 'Sousse', 0, 3, 41);

-- --------------------------------------------------------

--
-- Table structure for table `salaire`
--

DROP TABLE IF EXISTS `salaire`;
CREATE TABLE IF NOT EXISTS `salaire` (
  `idSalaire` int(11) NOT NULL AUTO_INCREMENT,
  `datePayment` date DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `avance` int(11) DEFAULT NULL,
  `idEmployee` int(11) DEFAULT NULL,
  `idWeek` int(11) DEFAULT NULL,
  `isPaid` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pas encore payé',
  PRIMARY KEY (`idSalaire`),
  KEY `IDX_F476848DE3C5FFA` (`idEmployee`),
  KEY `IDX_F476848D28A7375E` (`idWeek`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salaire`
--

INSERT INTO `salaire` (`idSalaire`, `datePayment`, `montant`, `avance`, `idEmployee`, `idWeek`, `isPaid`) VALUES
(21, '2018-11-04', 60, 50, 1, 41, 'payé'),
(22, '2018-11-04', 100, 60, 2, 41, 'pas encore payé'),
(23, '2018-11-04', 50, 20, 3, 41, 'pas encore payé');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

DROP TABLE IF EXISTS `week`;
CREATE TABLE IF NOT EXISTS `week` (
  `idWeek` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`idWeek`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`idWeek`, `date_debut`, `date_fin`) VALUES
(41, '2018-10-20', '2018-11-04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `FK_9001A5F328A7375E` FOREIGN KEY (`idWeek`) REFERENCES `week` (`idWeek`),
  ADD CONSTRAINT `FK_9001A5F3E3C5FFA` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idEmployee`);

--
-- Constraints for table `salaire`
--
ALTER TABLE `salaire`
  ADD CONSTRAINT `FK_F476848D28A7375E` FOREIGN KEY (`idWeek`) REFERENCES `week` (`idWeek`),
  ADD CONSTRAINT `FK_F476848DE3C5FFA` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idEmployee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
