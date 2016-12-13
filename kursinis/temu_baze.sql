-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Spa 17 d. 13:31
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `temu_baze`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `active_guests`
--

CREATE TABLE IF NOT EXISTS `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `active_guests`
--

INSERT INTO `active_guests` (`ip`, `timestamp`) VALUES
('127.0.0.1', 1476703891);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `patvirtintos_temos`
--

CREATE TABLE IF NOT EXISTS `patvirtintos_temos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patvirtines_vadovas` varchar(50) COLLATE utf8_bin NOT NULL,
  `pavadinimas` varchar(50) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `stud_kiekis` int(5) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Sukurta duomenų kopija lentelei `patvirtintos_temos`
--

INSERT INTO `patvirtintos_temos` (`id`, `patvirtines_vadovas`, `pavadinimas`, `stud_kiekis`, `data`) VALUES
(11, 'Vadovas', 'Molekulinës sintezës tyrimai', 1, '2016-10-17 14:21:32'),
(12, 'Vadovas', 'Naujovës iðmaniojoje erdvëje', 1, '2016-10-17 14:21:33'),
(13, 'Vadovas', 'Programø sistemø inþineriniai sprendimai', 1, '2016-10-17 14:21:34'),
(16, 'AlgisVadovas', 'IOS privalumai ir trûkumai', 1, '2016-10-17 14:30:29'),
(17, 'AlgisVadovas', 'GPS modulio saugumo uþtikrinimas ir prieþiûra', 1, '2016-10-17 14:30:31');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `rezervuotos_temos`
--

CREATE TABLE IF NOT EXISTS `rezervuotos_temos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(50) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `pasirinkes_stud` varchar(50) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Sukurta duomenų kopija lentelei `rezervuotos_temos`
--

INSERT INTO `rezervuotos_temos` (`id`, `pavadinimas`, `pasirinkes_stud`, `data`) VALUES
(7, 'Degimo procesai', 'EmilisStudentas', '2016-10-17 14:21:55'),
(8, 'Programavimas kitaip', 'GedisStudentas', '2016-10-17 14:31:00'),
(9, 'Kibernetinio saugumo aktualijos', 'AndriusStudentas', '2016-10-17 14:31:12');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `siulomos_temos`
--

CREATE TABLE IF NOT EXISTS `siulomos_temos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(50) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `autorius` varchar(50) COLLATE utf8_bin NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=44 ;

--
-- Sukurta duomenų kopija lentelei `siulomos_temos`
--

INSERT INTO `siulomos_temos` (`id`, `pavadinimas`, `autorius`, `data`) VALUES
(35, 'Android OS apþvalga', 'AndriusStudentas', '2016-10-17 14:27:28'),
(38, 'Iteracijø kiekis skirtinguose rikiavimo algoritmuo', 'AndriusStudentas', '2016-10-17 14:28:02'),
(40, 'Nuotolinio valdymo moduliai ðiuolaikinëse technolo', 'GedisStudentas', '2016-10-17 14:29:05'),
(42, 'Mikroskopiniai junginiø sàveikos tyrimai', 'GedisStudentas', '2016-10-17 14:29:36'),
(43, 'Terðalø kiekis ore ir kaip tai sustabdyti', 'EmilisStudentas', '2016-10-17 14:30:08');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('AlgisVadovas', 'fe01ce2a7fbac8fafaed7c982a04e229', '76b3c688675103013924ff9723ad1803', 5, 'demo@ktu.lt', 1476703833),
('SimasAdministratorius', 'fe01ce2a7fbac8fafaed7c982a04e229', '01be830300efd6b1c31549c262ab5ce6', 9, 'demo@ktu.lt', 1476646462),
('Studentas', 'fe01ce2a7fbac8fafaed7c982a04e229', '52446295041a18ba59eb82308efa8429', 1, 'demo@ktu.lt', 1476646375),
('viliusStudentas', '0da16a4cbd8c9b69e58fc93de93c9662', 'a4b7aba573e75370cb5d8d425d76edff', 1, 'vilius@sdas.com', 1476396029),
('EmilisStudentas', '3d2eaf1439460848813ffa3010afe6a6', 'f8cd66755a1a242952638920069c2924', 1, 'Emilis@mail.com', 1476703849),
('AndriusStudentas', '3d2eaf1439460848813ffa3010afe6a6', 'a23adf1cac241bea26b33c635fa887a8', 1, 'stude@stude.com', 1476703891),
('GedisStudentas', '3d2eaf1439460848813ffa3010afe6a6', '70e3a8cb0f4fa5eb9f6c25bf511c7698', 1, 'gedis@mail.com', 1476703862);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
