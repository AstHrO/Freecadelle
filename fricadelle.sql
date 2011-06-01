-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 01 Juin 2011 à 23:13
-- Version du serveur: 5.5.12
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `fricadelle`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_ARTISTE` int(11) NOT NULL DEFAULT '0',
  `ALBUM_NAME` varchar(200) NOT NULL,
  `CODE_GENRE` bigint(20) DEFAULT NULL,
  `DESC_SHORT` text,
  `DESC_LONG` text,
  PRIMARY KEY (`ID`),
  KEY `aname` (`ALBUM_NAME`),
  KEY `artiste` (`CODE_ARTISTE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`ID`, `CODE_ARTISTE`, `ALBUM_NAME`, `CODE_GENRE`, `DESC_SHORT`, `DESC_LONG`) VALUES
(1, 1, '-Be A King (Budabeats)', NULL, NULL, NULL),
(2, 2, '!F*cked Up Trax', NULL, NULL, NULL),
(3, 3, 'AXMusique', NULL, NULL, NULL),
(4, 4, 'Nicolas Falco', NULL, NULL, NULL),
(5, 5, '+Into Gay Pride Ride', NULL, NULL, NULL),
(6, 6, 'COLL.of COLL.', NULL, NULL, NULL),
(7, 7, 'Heroical', NULL, NULL, NULL),
(8, 8, 'Bipolarity', NULL, NULL, NULL),
(9, 9, '/Siberian Jungle Vol.2', NULL, NULL, NULL),
(10, 10, '32010 *MirRah* (limited)', NULL, NULL, NULL),
(11, 11, 'Soonrise', NULL, NULL, NULL),
(12, 12, '', NULL, NULL, NULL),
(13, 13, '%Nesta Talmadge 1', NULL, NULL, NULL),
(14, 14, 'Premiers Pas', NULL, NULL, NULL),
(15, 15, 'Soul Africa', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_GENRE` bigint(20) DEFAULT NULL,
  `ARTISTE_NOM` varchar(200) NOT NULL,
  `DESC_COURT` text,
  `DESC_LONG` text,
  PRIMARY KEY (`ID`),
  KEY `pname` (`ARTISTE_NOM`),
  KEY `CODE_GENRE` (`CODE_GENRE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `artiste`
--

INSERT INTO `artiste` (`ID`, `CODE_GENRE`, `ARTISTE_NOM`, `DESC_COURT`, `DESC_LONG`) VALUES
(1, NULL, 'Metaharmoniks', NULL, NULL),
(2, NULL, 'Dr. Wanker', NULL, NULL),
(3, NULL, 'AXMusique', NULL, NULL),
(4, NULL, 'Nicolas Falco', NULL, NULL),
(5, NULL, 'NanowaR', NULL, NULL),
(6, NULL, '!roberto daglio', NULL, NULL),
(7, NULL, 'MG-Rizzello', NULL, NULL),
(8, NULL, 'Dave Imbernn', NULL, NULL),
(9, NULL, 'GTunguska Electronic Music Society', NULL, NULL),
(10, NULL, 'Sinestesia', NULL, NULL),
(11, NULL, 'Absent Feet', NULL, NULL),
(12, NULL, '', NULL, NULL),
(13, NULL, '!Nesta Talmadge', NULL, NULL),
(14, NULL, '%La Fougre Bleue', NULL, NULL),
(15, NULL, 'Juanitos', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `CODE_CLIENT` int(11) NOT NULL,
  `CODE_LISTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`CODE_CLIENT`, `CODE_LISTE`) VALUES
(1, 25),
(2, 0),
(3, 0),
(4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_GENRE` varchar(50) NOT NULL,
  `VOLUME` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `LIBELLE_GENRE` (`LIBELLE_GENRE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`ID`, `LIBELLE_GENRE`, `VOLUME`) VALUES
(1, 'Non Classé', 0),
(2, 'Electronic', 0),
(3, 'Indie', 0),
(4, 'Soundtrack', 0),
(5, 'Dub', 0),
(6, 'Pop', 0),
(7, 'Français', 0),
(8, 'Lounge', 0);

-- --------------------------------------------------------

--
-- Structure de la table `morceau`
--

DROP TABLE IF EXISTS `morceau`;
CREATE TABLE IF NOT EXISTS `morceau` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CODE_ARTISTE` int(11) DEFAULT NULL,
  `CODE_ALBUM` int(11) DEFAULT NULL,
  `NO_PISTE` smallint(6) DEFAULT NULL,
  `MORCEAU_NOM` varchar(200) NOT NULL,
  `DUREE` varchar(6) DEFAULT NULL,
  `CODE_GENRE` bigint(20) DEFAULT NULL,
  `NB_JOUEE` int(11) NOT NULL DEFAULT '0',
  `ANNEE` varchar(4) DEFAULT NULL,
  `STR_CHEMIN` text,
  `STR_POCHETTE` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `album_id` (`CODE_ALBUM`),
  KEY `name` (`MORCEAU_NOM`),
  KEY `year` (`ANNEE`),
  KEY `CODE_ARTISTE` (`CODE_ARTISTE`),
  KEY `CODE_GENRE` (`CODE_GENRE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Contenu de la table `morceau`
--

INSERT INTO `morceau` (`ID`, `CODE_ARTISTE`, `CODE_ALBUM`, `NO_PISTE`, `MORCEAU_NOM`, `DUREE`, `CODE_GENRE`, `NB_JOUEE`, `ANNEE`, `STR_CHEMIN`, `STR_POCHETTE`) VALUES
(1, 1, 1, 0, 'e A King', '', 1, 0, '', NULL, 0),
(2, 2, 2, 0, 'he Trip', '226000', 5, 0, '', NULL, 0),
(3, 3, 3, 0, 'TS', '', 5, 0, '', NULL, 0),
(4, 4, 4, 0, 'hat I Know About Yo', '142153', 4, 0, '201', NULL, 0),
(5, 5, 5, 0, 'Odino & Valhalla ', '349000', 7, 0, '', NULL, 0),
(6, 6, 6, 0, '"BackStep"from album:JazzFriends-by:Creative Workshop', '339000', 5, 0, '', NULL, 0),
(7, 7, 7, 0, 'Last Hero Chronicles', '296000', 4, 0, '', NULL, 0),
(8, 5, 5, 0, 'The Forest of Magnaccions', '166000', 7, 0, '', NULL, 0),
(9, 8, 8, 0, 'Pain & Madness', '322000', 0, 0, '', NULL, 0),
(10, 9, 9, 0, 'N-box - Beautiful Moments', '441000', 4, 0, '', NULL, 0),
(11, 5, 5, 0, 'Nanowarrior''s Prayer', '97000', 6, 0, '', NULL, 0),
(12, 7, 7, 0, 'Arrival of the Crusader', '116000', 0, 0, '', NULL, 0),
(13, 9, 9, 0, 'Seldome - Matvey', '348000', 7, 0, '', NULL, 0),
(14, 8, 8, 0, 'losed ', '262000', 2, 0, '', NULL, 0),
(15, 8, 8, 0, 'In my fragile mind ( band version)', '388000', 5, 0, '', NULL, 0),
(16, 10, 10, 0, 'Abroad of Waters (Ulver Theme)', '487000', 5, 0, '', NULL, 0),
(17, 11, 11, 0, 'Absent Feet - In cold water', '205000', 1, 0, '', NULL, 0),
(18, 12, 12, 0, '', '', 7, 0, '', NULL, 0),
(19, 13, 13, 0, 'Nesta Talmadge - El-Ofeke', '509000', 0, 0, '', NULL, 0),
(20, 6, 6, 0, 'A beatiful day (be happy)"from album:Wolfsong''s-by: the Wolfpack', '324000', 3, 0, '', NULL, 0),
(21, 14, 14, 0, 'Ide Qui Tache', '258000', 6, 0, '', NULL, 0),
(22, 5, 5, 0, 'Stormlord of power', '171000', 0, 0, '', NULL, 0),
(23, 8, 8, 0, 'i  soledad', '265000', 6, 0, '', NULL, 0),
(24, 15, 15, 0, 'Ooh La La Boogaloo', '144000', 6, 0, '', NULL, 0),
(25, 5, 5, 0, 'AP-sody', '113000', 4, 0, '', NULL, 0),
(26, 11, 11, 0, 'Absent Feet - Weakened bones', '268000', 3, 0, '', NULL, 0),
(27, 10, 10, 0, 'Undenied (Pands Mix)', '481000', 5, 0, '', NULL, 0),
(28, 13, 13, 0, 'Nesta Talmadge - Life', '277000', 0, 0, '', NULL, 0),
(29, 13, 13, 0, 'Nesta Talmadge - Sao Mot Lo Dubstep (Promesse d''une date)', '354000', 0, 0, '', NULL, 0),
(30, 5, 5, 0, 'Lamento Erotico', '341000', 3, 0, '', NULL, 0),
(31, 14, 14, 0, 'morial', '225000', 6, 0, '', NULL, 0),
(32, 15, 15, 0, 'lack Samba', '162000', 4, 0, '', NULL, 0),
(33, 7, 7, 0, 'Grief and Hope', '136000', 5, 0, '', NULL, 0),
(34, 15, 15, 0, 'Brasilian Reggae', '176000', 4, 0, '', NULL, 0),
(35, 7, 7, 0, 'ells Gate', '48000', 5, 0, '', NULL, 0),
(36, 14, 14, 0, 'Orange et Blanc', '157000', 7, 0, '', NULL, 0),
(37, 10, 10, 0, 'Law of Time (13-20 Mix)', '239000', 4, 0, '', NULL, 0),
(38, 9, 9, 0, 'Smoki Jay - Blueberry', '418000', 6, 0, '', NULL, 0),
(39, 7, 7, 0, 'Aurora Movietrailer', '80000', 3, 0, '', NULL, 0),
(40, 15, 15, 0, 'Do The Kangaroo', '198000', 7, 0, '', NULL, 0),
(41, 11, 11, 0, 'Absent feet - Dorian''s in bloom', '273000', 1, 0, '', NULL, 0),
(42, 7, 7, 0, 'Last Hero Maintheme', '256000', 2, 0, '', NULL, 0),
(43, 9, 9, 0, 'PIANOCHOCOLATE - Not Too Late', '295000', 7, 0, '', NULL, 0),
(44, 7, 7, 0, 'nights Tale', '72000', 5, 0, '', NULL, 0),
(45, 9, 9, 0, 'CHOOGA - I Remember All', '363000', 6, 0, '', NULL, 0),
(46, 7, 7, 0, 'Prepare to Battle', '146000', 4, 0, '', NULL, 0),
(47, 7, 7, 0, 'Mondays Rays of Glance', '242000', 6, 0, '', NULL, 0),
(48, 13, 13, 0, 'Nesta Talmadge - Prayer', '559000', 3, 0, '', NULL, 0),
(49, 8, 8, 0, 'closed (band version)', '267000', 6, 0, '', NULL, 0),
(50, 5, 5, 0, 'DJ Fernanduzzo', '49000', 3, 0, '', NULL, 0),
(51, 9, 9, 0, 'DJ DED - Just Funk', '288000', 5, 0, '', NULL, 0),
(52, 5, 5, 0, 'Karkagnor''s Song - In The Forest', '11000', 2, 0, '', NULL, 0),
(53, 8, 8, 0, 'ast word', '314000', 4, 0, '', NULL, 0),
(54, 13, 13, 0, 'Nesta Talmadge - The Khmu, Ritual Song Dub', '457000', 0, 0, '', NULL, 0),
(55, 13, 13, 0, 'Nesta Talmadge - Song For Mozambique (& World)', '464000', 3, 0, '', NULL, 0),
(56, 5, 5, 0, 'Radio Grafia II', '57000', 0, 0, '', NULL, 0),
(57, 5, 5, 0, 'urprise Love', '394000', 7, 0, '', NULL, 0),
(58, 7, 7, 0, 'Last Hero Prelude', '46000', 6, 0, '', NULL, 0),
(59, 7, 7, 0, 'oldenhorn', '194000', 6, 0, '', NULL, 0),
(60, 14, 14, 0, 'aston', '215000', 6, 0, '', NULL, 0),
(61, 14, 14, 0, 'Mauvaise Nouvelle', '141000', 5, 0, '', NULL, 0),
(62, 6, 6, 0, 'Gipsy Princess" from album: In this World-by: Babel sin Fronteras', '235000', 7, 0, '', NULL, 0),
(63, 15, 15, 0, 'ondo Wack', '100000', 3, 0, '', NULL, 0),
(64, 10, 10, 0, 'Landslip of Empires (Loop&Toop Live)', '247000', 2, 0, '', NULL, 0),
(65, 14, 14, 0, 'J''Veux Que a Tonne', '221000', 3, 0, '', NULL, 0),
(66, 8, 8, 0, 'unrise', '211000', 7, 0, '', NULL, 0),
(67, 10, 10, 0, 'Time, Thank You! (Empty Hills Live Act)', '333000', 6, 0, '', NULL, 0),
(68, 8, 8, 0, 'ipolarity', '279000', 0, 0, '', NULL, 0),
(69, 14, 14, 0, 'Comptoir Irlandais', '255000', 1, 0, '', NULL, 0),
(70, 9, 9, 0, 'Susanin - Rain', '263000', 2, 0, '', NULL, 0),
(71, 15, 15, 0, 'The Smoking Sound', '129000', 1, 0, '', NULL, 0),
(72, 9, 9, 0, 'Seldome - Mies.N', '346000', 0, 0, '', NULL, 0),
(73, 7, 7, 0, 'March to Middle East', '150000', 6, 0, '', NULL, 0),
(74, 11, 11, 0, 'Absent Feet - Poor Joe', '210000', 6, 0, '', NULL, 0),
(75, 8, 8, 0, 'Bye bye reason', '373000', 3, 0, '', NULL, 0),
(76, 15, 15, 0, 'eartbeat Dub', '264000', 7, 0, '', NULL, 0),
(77, 10, 10, 0, 'Outness (Part I)', '507000', 4, 0, '', NULL, 0),
(78, 13, 13, 0, 'Nesta Talmadge - P''tit Truc Pour Thavisouk Phrasavath', '358000', 6, 0, '', NULL, 0),
(79, 15, 15, 0, 'La Black Mustang Foursuite', '135000', 3, 0, '', NULL, 0),
(80, 13, 13, 0, 'Nesta Talmadge - Hommage', '641000', 6, 0, '', NULL, 0),
(81, 9, 9, 0, 'N-box - Fallen Angel', '325000', 7, 0, '', NULL, 0),
(82, 10, 10, 0, 'Outness (Part II)', '501000', 0, 0, '', NULL, 0),
(83, 11, 11, 0, 'Absent Feet - It''s just one thing', '255000', 3, 0, '', NULL, 0),
(84, 7, 7, 0, 'Mysterious Orchestra', '43000', 6, 0, '', NULL, 0),
(85, 9, 9, 0, 'Celestial Spirit - Mescalito', '401000', 0, 0, '', NULL, 0),
(86, 14, 14, 0, 'yez Peur!', '229000', 4, 0, '', NULL, 0),
(87, 8, 8, 0, 'Fairy Tears (remastered track)', '246000', 7, 0, '', NULL, 0),
(88, 14, 14, 0, 'La Plus Belle des Femmes', '197000', 0, 0, '', NULL, 0),
(89, 15, 15, 0, 'oul Walking', '203000', 4, 0, '', NULL, 0),
(90, 9, 9, 0, '-dahn - Cray', '400000', 2, 0, '', NULL, 0),
(91, 5, 5, 0, ' Vs. 100', '78000', 0, 0, '', NULL, 0),
(92, 15, 15, 0, 'Cool Reggae Party', '183000', 4, 0, '', NULL, 0),
(93, 15, 15, 0, 'oul Africa', '160000', 4, 0, '', NULL, 0),
(94, 5, 5, 0, 'Metropolis Part 3 - The legacy', '10000', 7, 0, '', NULL, 0),
(95, 13, 13, 0, 'Nesta Talmadge - Espoir', '534000', 7, 0, '', NULL, 0),
(96, 5, 5, 0, 'anowar', '245000', 0, 0, '', NULL, 0),
(97, 8, 8, 0, 'In my fragile mind', '382000', 5, 0, '', NULL, 0),
(98, 5, 5, 0, 'Look at Two Reels', '251000', 0, 0, '', NULL, 0),
(99, 9, 9, 0, 'Peter Zanegin - Sun Force', '339000', 2, 0, '', NULL, 0),
(100, 13, 13, 0, 'Nesta Talmadge - Dubstep Interlude', '133000', 1, 0, '', NULL, 0),
(101, 7, 7, 0, 'Biohazardous Hope Battle', '103000', 1, 0, '', NULL, 0),
(102, 15, 15, 0, 'l Rtmo', '162000', 2, 0, '', NULL, 0),
(103, 7, 7, 0, 'Last Hero Mystical Venue', '286000', 7, 0, '', NULL, 0),
(104, 14, 14, 0, 'a Danseuse', '230000', 4, 0, '', NULL, 0),
(105, 8, 8, 0, 'n me', '333000', 0, 0, '', NULL, 0),
(106, 8, 8, 0, 'Revolution 2011 (remastered track)', '346000', 4, 0, '', NULL, 0),
(107, 5, 5, 0, 'Blood of the Queens', '462000', 5, 0, '', NULL, 0),
(108, 9, 9, 0, 'DJ DED - Autumn is Back', '412000', 6, 0, '', NULL, 0),
(109, 5, 5, 0, 'Karkagnor''s Song - The Hobbit', '389000', 0, 0, '', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USER_NOM` varchar(80) NOT NULL,
  `STATUT` bigint(20) NOT NULL DEFAULT '1',
  `DATE_MAJ` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `user_name` (`USER_NOM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `playlist`
--

INSERT INTO `playlist` (`ID`, `USER_NOM`, `STATUT`, `DATE_MAJ`) VALUES
(25, '1', 10, '2011-06-01 22:14:41'),
(24, '1', 10, '2011-06-01 22:11:50'),
(23, '1', 0, '2011-06-01 12:38:12'),
(20, '1', 0, '2011-05-28 14:17:07'),
(22, '1', 10, '2011-05-28 15:06:06'),
(21, '1', 10, '2011-05-28 14:47:06');

-- --------------------------------------------------------

--
-- Structure de la table `playlist_content`
--

DROP TABLE IF EXISTS `playlist_content`;
CREATE TABLE IF NOT EXISTS `playlist_content` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CODE_MORCEAU` bigint(20) NOT NULL DEFAULT '0',
  `CODE_PLAYLIST` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `pcid` (`ID`),
  KEY `CODE_MORCEAU` (`CODE_MORCEAU`),
  KEY `CODE_PLAYLIST` (`CODE_PLAYLIST`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `playlist_content`
--

INSERT INTO `playlist_content` (`ID`, `CODE_MORCEAU`, `CODE_PLAYLIST`) VALUES
(2, 7, 17),
(3, 23, 21),
(4, 31, 21),
(5, 49, 21),
(6, 21, 21),
(7, 47, 21),
(8, 36, 22),
(9, 62, 22),
(10, 87, 22),
(11, 66, 22),
(12, 8, 22),
(13, 27, 24),
(14, 24, 25),
(15, 21, 25),
(16, 45, 25),
(17, 31, 25);
