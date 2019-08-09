-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2014 at 07:06 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `private_dimas`
--
CREATE DATABASE IF NOT EXISTS `private_dimas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `private_dimas`;

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE IF NOT EXISTS `kandidat` (
  `kandidat_id` int(2) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`kandidat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`kandidat_id`, `kode`, `nama`) VALUES
(1, 'A1', 'Dimas'),
(2, 'A2', 'Seno'),
(3, 'A3', 'Eko'),
(4, 'A4', 'Nasir');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `bobot` int(3) NOT NULL,
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kriteria_id`, `kode`, `nama`, `bobot`) VALUES
(1, 'C1', 'Matematika', 35),
(2, 'C2', 'Bahasa Inggris', 25),
(3, 'C3', 'Agama', 25),
(4, 'C4', 'Ppkn', 15);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `angka` varchar(10) NOT NULL,
  PRIMARY KEY (`nilai_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`nilai_id`, `angka`) VALUES
(1, '70'),
(2, '50'),
(3, '85'),
(4, '82'),
(5, '50'),
(6, '60'),
(7, '55'),
(8, '70'),
(9, '80'),
(10, '82'),
(11, '80'),
(12, '65'),
(13, '60'),
(14, '70'),
(15, '75'),
(16, '85');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
