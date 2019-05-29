-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql300.byethost.com
-- Generation Time: Mar 09, 2018 at 02:33 PM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b33_21591493_sajtphp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE IF NOT EXISTS `anketa` (
  `id_anketa` int(2) NOT NULL AUTO_INCREMENT,
  `q1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `q2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `q3` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `q4` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_anketa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_anketa`, `q1`, `q2`, `q3`, `q4`) VALUES
(1, 'How did you find out about us?', 'Did you already travel with us?', 'Would you travel with us?', 'Would you recomend us to your friends?');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `id_kategorija` int(2) NOT NULL,
  `id_drzava` int(2) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `title`, `picture`, `text`, `id_kategorija`, `id_drzava`) VALUES
(15, 'Belgrade', 'img/c46a913927bdaa037d6664edd09fb868.jpg', 'Belgrade is the capital and largest city of Serbia. It is located at the confluence of the Sava and Danube rivers, where the Pannonian Plain meets the Balkans.', 2, 6),
(18, 'Lefkada', 'img/lefkada.jpg', 'Lefkada is the fourth largest island in the Ionian Sea with a total area of about 300 kilometers square, complementing over twenty small islands scattered all over the archipelago. Situated south of Corfu and northeast of Cephalonia, the continental part of Greece shares only a coating and a moving bridge, which makes it a rare island that can be reached by land.', 1, 1),
(19, 'Madrid', 'img/madrid.jpg', 'Madrid is the capital and largest city of Spain, as well as the capital of the autonomous community of the same name (Comunidad de Madrid). Madrid is best known for its great cultural and artistic heritage, a good example of which is the El Prado Museum. Madrid also boasts some of the liveliest nightlife in the world.', 2, 2),
(20, 'Prague', 'img/prague.jpg', 'Prague is the capital city and largest city of the Czech Republic. It is one of the largest cities of Central Europe and has served as the capital of the historic region of Bohemia for centuries.', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `drzave`
--

CREATE TABLE IF NOT EXISTS `drzave` (
  `id_drzava` int(2) NOT NULL AUTO_INCREMENT,
  `naziv_drzava` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_drzava`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `drzave`
--

INSERT INTO `drzave` (`id_drzava`, `naziv_drzava`) VALUES
(1, 'Greece'),
(2, 'Spain'),
(3, 'Italy'),
(4, 'Czech Republic'),
(6, 'Serbia');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE IF NOT EXISTS `kategorije` (
  `id_kategorija` int(2) NOT NULL AUTO_INCREMENT,
  `naziv_kategorija` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategorija`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_kategorija`, `naziv_kategorija`) VALUES
(1, 'Summer2018'),
(2, 'Spring2018');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id_korisnika` int(4) NOT NULL AUTO_INCREMENT,
  `kor_ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `uloga` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_korisnika`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `kor_ime`, `lozinka`, `uloga`) VALUES
(48, 'dedaTripko', '91431a4286e7e68cd59873c0e11aafb8', 'user'),
(18, 'dragan', 'c4b4d6433ee2d175052b82d5dd4220f0', 'user'),
(25, 'nikola', '9365ea12b2d910e1aceaac190fbc97a5', 'admin'),
(27, 'Jovana', '067a9d48f2884037e1320ac03b18e86f', 'user'),
(31, 'student', 'cd73502828457d15655bbd7a63fb0bc8', 'user'),
(33, 'Aladin', '0773b3e396571c1bddf5023fc788ad2e', 'user'),
(34, 'Pera', 'b99e13c64f2f82d7357c6f5a8281e966', 'user'),
(45, 'kiza', 'f8e597ad874f063803419dd79ca7d7a2', 'user'),
(47, 'calabija', '274e66053c0a409503f93022a962c032', 'user'),
(49, 'bataDjosa', 'e4203d85f7d5f5017c288fac0a4ea9c4', 'user'),
(50, 'Djape123', 'e657dc083000b10f3b64d6671b3eecee', 'user'),
(51, 'Aaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'user'),
(52, 'srdjanTrojanac', '2162e6b221a56dd50a056a817bf70c98', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE IF NOT EXISTS `odgovori` (
  `id_odgovor` int(2) NOT NULL AUTO_INCREMENT,
  `id_korisnik` int(2) NOT NULL,
  `id_anketa` int(2) NOT NULL,
  `a1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a2` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `a3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `a4` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_odgovor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`id_odgovor`, `id_korisnik`, `id_anketa`, `a1`, `a2`, `a3`, `a4`) VALUES
(1, 31, 1, 'friend', 'yes', 'yes', 'yes'),
(3, 18, 1, 'school', 'no', 'yes', 'no'),
(4, 47, 1, 'Nisam saznao', 'no', 'no', 'no'),
(5, 52, 1, 'Caffee', 'yes', 'yes', 'yes'),
(6, 53, 1, 'school', 'no', 'no', 'yes'),
(7, 25, 1, '', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

CREATE TABLE IF NOT EXISTS `poruka` (
  `id_poruka` int(2) NOT NULL AUTO_INCREMENT,
  `kor_ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `poruka` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_poruka`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `poruka`
--

INSERT INTO `poruka` (`id_poruka`, `kor_ime`, `naslov`, `poruka`) VALUES
(1, 'student', 'Neki naslov', 'Poruka1'),
(4, 'not_registered', 'WOW', 'This is the best site about traveling! I hope you will get max points on college! '),
(14, 'calabija', 'Jbmlg', '1204199648748961574\r\n'),
(15, 'Djape123', 'Ocena sajta:', ' Za trud , zalaganje , ideju i posvecenost dajem ocenu 10 .\r\n Srecno â˜º'),
(16, 'Aaa', 'Rajka', 'Ibica je top samo im fali prodavnica sa vinjakom'),
(19, 'not_registered', 'Naslov', 'Poruka'),
(18, 'not_registered', 'Bulgaria', 'Nije los sajt, samo napred, bice covek od tebe.');

-- --------------------------------------------------------

--
-- Table structure for table `putanjedostranica`
--

CREATE TABLE IF NOT EXISTS `putanjedostranica` (
  `id_putanja` int(2) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_putanja`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `putanjedostranica`
--

INSERT INTO `putanjedostranica` (`id_putanja`, `naziv`, `putanja`) VALUES
(1, 'Home', 'index.php?page=1'),
(2, 'About', 'index.php?page=2'),
(3, 'Contact', 'index.php?page=3 '),
(4, 'Login', 'index.php?page=4'),
(5, 'Register', 'index.php?page=5'),
(6, 'Author', 'index.php?page=6'),
(8, 'logout', 'index.php?page=8'),
(9, 'users', 'index.php?page=9'),
(10, 'new_destination', 'index.php?page=10'),
(11, 'del_destination', 'index.php?page=11'),
(12, 'edt_destination', 'index.php?page=12'),
(13, 'destinations', 'index.php?page=13'),
(14, 'country', 'index.php?page=14'),
(15, 'rm_country', 'index.php?page=15'),
(16, 'edt_country', 'index.php?page=16'),
(17, 'new_season', 'index.php?page=17'),
(18, 'rm_season', 'index.php?page=18'),
(19, 'edt_season', 'index.php?page=19'),
(20, 'survey', 'index.php?page=20'),
(21, 'message', 'index.php?page=21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
