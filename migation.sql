-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 22 fév. 2026 à 22:55
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `filmId` varchar(50) COLLATE latin1_bin NOT NULL,
  `filmTitle` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `filmAuthor` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `filmDetail` text CHARACTER SET latin1 COLLATE latin1_bin,
  `filmCategory` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  `filmTime` smallint DEFAULT NULL,
  `filmPoster` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`filmId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`filmId`, `filmTitle`, `filmAuthor`, `filmDetail`, `filmCategory`, `filmTime`, `filmPoster`) VALUES
('1', 'Marsupilami', 'Philippe Lacheau', 'Pour sauver son emploi, David accepte un plan foireux : ramener un mystérieux colis d’Amérique du Sud.\r\nIl se retrouve à bord d’une croisière avec son ex Tess, son fils Léo, et son collègue Stéphane, aussi benêt que maladroit, dont David se sert pour transporter le colis à sa place.\r\nTout dérape lorsque ce dernier l’ouvre accidentellement : un adorable bébé Marsupilami apparait et le voyage vire au chaos !\r\nLa bande à Fifi est de retour et elle s’est fait un nouveau copain…', 'Comédie', 99, 'marsupilami.jpg'),
('FILM_699f3a63550db', 'CHERS PARENTS', 'Emmanuel Patron', 'Alice et Vincent Gauthier convoquent en urgence leurs trois enfants. La fratrie débarque affolée, craignant le pire… mais, bonne nouvelle, leurs parents ont en fait touché le jackpot ! Le problème : ils ne comptent pas leur donner un centime...', 'Comédie', 86, 'chersParents.jpg'),
('FILM_699f3c816da03', 'MARTY SUPREME', 'Josh Safdie', 'Marty Mauser, un jeune homme à l’ambition démesurée, est prêt à tout pour réaliser son rêve et prouver au monde entier que rien ne lui est impossible.', 'Biopic / Drame', 150, 'martySupreme.jpg'),
('FILM_699f4b45077bc', 'Gourou', 'Yann Gozlan', 'Matt est le coach en développement personnel le plus suivi de France. Dans une société en quête de sens où la réussite individuelle est devenue sacrée, il propose à ses adeptes une catharsis qui électrise les foules autant qu\'elle inquiète les autorités. Sous le feu des critiques, Matt va s\'engager dans une fuite en avant qui le mènera aux frontières de la folie et peut-être de la gloire...', 'Drame / Thriller', 126, 'gourou.jpg'),
('FILM_699f4f1053d48', 'Coutures', 'Alice Winocour', 'A Paris, dans le tumulte de la Fashion Week, Maxine, une réalisatrice américaine apprend une nouvelle qui va bouleverser sa vie. Elle croise alors le chemin d’Ada, une jeune mannequin sud-soudanaise ayant quitté son pays, et Angèle, une maquilleuse française aspirant à une autre vie. Entre ces trois femmes aux horizons pourtant si différents se tisse une solidarité insoupçonnée. Sous le vernis glamour se révèle une forme de révolte silencieuse : celle de femmes qui recousent, chacune à leur manière, les fils de leur propre histoire.', 'Drame', 103, 'coutures.jpg'),
('FILM_699f4f8b3cd39', 'Le Rêve américain', 'Anthony Marciano', 'Personne n\'aurait parié sur Jérémy, coincé derrière le comptoir d’un vidéo club à Amiens, ou sur Bouna, lorsqu\'il faisait des ménages à l’aéroport d’Orly. Sans contacts, sans argent et avec un niveau d\'anglais plus qu’approximatif, rien ne les prédestinait à devenir des agents qui comptent en NBA.\r\nInspiré d’une histoire vraie, ce film raconte le parcours de deux outsiders qui, grâce à leur passion absolue pour le basket et leur amitié indéfectible, ont bravé tous les obstacles pour réaliser leur Rêve Américain.', 'Comédie', 125, 'leReveAmericain.avif'),
('FILM_699f5033ce9b4', 'Le Son des souvenirs', 'Oliver Hermanus', 'En 1917, Lionel, étudiant talentueux au conservatoire de Boston, y rencontre David. Les deux jeunes gens se retrouvent autour d’une passion commune pour les chansons traditionnelles. Quelques années plus tard, Lionel reçoit une lettre de David l’invitant à le rejoindre au pied levé pour une expédition de collectage de chansons à travers les forêts du Maine. Ces retrouvailles inattendues et la musique que les deux hommes enregistrent vont façonner le cours de la vie de Lionel au-delà de ce qu’il peut alors imaginer.', 'Drame / Historique / Romance', 128, 'leSonDesSouvenirs.avif'),
('FILM_699f50c01ad6b', 'LOL 2.0', 'Lisa Azuelos', 'revient vivre chez elle après un échec professionnel et sentimental. Et comme une surprise n’arrive jamais seule, son fils Théo lui annonce qu’elle va devenir grand-mère ! Entre chocs générationnels, rêves en mutation et nouveaux élans amoureux… Anne comprend que la vie ne suit jamais tout à fait le plan prévu, et qu’à tout âge, on continue toujours d’apprendre à grandir.', 'Comédie', 105, 'LOL2.0.jpg'),
('FILM_699f514640daf', '\"Hurlevent\"', 'Emerald Fennell', 'Vision moderne de la passion absolue unissant Heathcliff et Catherine, une romance légendaire qui défie le temps et la raison.', 'Drame / Romance', 136, 'hurlevent.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `userId` varchar(50) COLLATE latin1_bin NOT NULL,
  `roomId` int NOT NULL,
  `seatId` int NOT NULL,
  `sceanceId` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`userId`,`roomId`,`seatId`,`sceanceId`),
  KEY `roomId` (`roomId`,`seatId`),
  KEY `sceanceId` (`sceanceId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`userId`, `roomId`, `seatId`, `sceanceId`) VALUES
('1', 3, 3014, 'SCEANCE_699f81eabc6c3'),
('1', 3, 3015, 'SCEANCE_699f81eabc6c3');

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `roomId` int NOT NULL,
  `roomNumberOfSeats` smallint DEFAULT NULL,
  `roomCharacteristic` varchar(50) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`roomId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`roomId`, `roomNumberOfSeats`, `roomCharacteristic`) VALUES
(1, 50, 'CLASSIQUE'),
(2, 20, 'LUXE'),
(3, 100, 'ECONOMIC');

-- --------------------------------------------------------

--
-- Structure de la table `sceance`
--

DROP TABLE IF EXISTS `sceance`;
CREATE TABLE IF NOT EXISTS `sceance` (
  `sceanceId` varchar(50) COLLATE latin1_bin NOT NULL,
  `sceanceDate` datetime DEFAULT NULL,
  `filmId` varchar(50) COLLATE latin1_bin NOT NULL,
  `roomId` int NOT NULL,
  PRIMARY KEY (`sceanceId`),
  KEY `filmId` (`filmId`),
  KEY `roomId` (`roomId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `sceance`
--

INSERT INTO `sceance` (`sceanceId`, `sceanceDate`, `filmId`, `roomId`) VALUES
('SCEANCE_699f81a903ecf', '2027-01-26 06:00:00', 'FILM_699f514640daf', 1),
('SCEANCE_699f81d195335', '2026-12-26 08:17:00', 'FILM_699f3a63550db', 2),
('SCEANCE_699f81eabc6c3', '2026-11-26 20:12:00', 'FILM_699f3a63550db', 3);

-- --------------------------------------------------------

--
-- Structure de la table `seat`
--

DROP TABLE IF EXISTS `seat`;
CREATE TABLE IF NOT EXISTS `seat` (
  `roomId` int NOT NULL,
  `seatId` int NOT NULL,
  `seatRow` smallint DEFAULT NULL,
  `seatColumn` varchar(1) COLLATE latin1_bin DEFAULT NULL,
  PRIMARY KEY (`roomId`,`seatId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `seat`
--

INSERT INTO `seat` (`roomId`, `seatId`, `seatRow`, `seatColumn`) VALUES
(3, 3001, 1, 'A'),
(2, 2001, 1, 'A'),
(1, 1001, 1, 'A'),
(3, 3002, 1, 'B'),
(2, 2002, 1, 'B'),
(1, 1002, 1, 'B'),
(3, 3003, 1, 'C'),
(2, 2003, 1, 'C'),
(1, 1003, 1, 'C'),
(3, 3004, 1, 'D'),
(2, 2004, 1, 'D'),
(1, 1004, 1, 'D'),
(3, 3005, 1, 'E'),
(2, 2005, 1, 'E'),
(1, 1005, 1, 'E'),
(3, 3006, 1, 'F'),
(2, 2006, 1, 'F'),
(1, 1006, 1, 'F'),
(3, 3007, 1, 'G'),
(2, 2007, 1, 'G'),
(1, 1007, 1, 'G'),
(3, 3008, 1, 'H'),
(2, 2008, 1, 'H'),
(1, 1008, 1, 'H'),
(3, 3009, 1, 'I'),
(2, 2009, 1, 'I'),
(1, 1009, 1, 'I'),
(3, 3010, 1, 'J'),
(2, 2010, 1, 'J'),
(1, 1010, 1, 'J'),
(3, 3011, 2, 'A'),
(2, 2011, 2, 'A'),
(1, 1011, 2, 'A'),
(3, 3012, 2, 'B'),
(2, 2012, 2, 'B'),
(1, 1012, 2, 'B'),
(3, 3013, 2, 'C'),
(2, 2013, 2, 'C'),
(1, 1013, 2, 'C'),
(3, 3014, 2, 'D'),
(2, 2014, 2, 'D'),
(1, 1014, 2, 'D'),
(3, 3015, 2, 'E'),
(2, 2015, 2, 'E'),
(1, 1015, 2, 'E'),
(3, 3016, 2, 'F'),
(2, 2016, 2, 'F'),
(1, 1016, 2, 'F'),
(3, 3017, 2, 'G'),
(2, 2017, 2, 'G'),
(1, 1017, 2, 'G'),
(3, 3018, 2, 'H'),
(2, 2018, 2, 'H'),
(1, 1018, 2, 'H'),
(3, 3019, 2, 'I'),
(2, 2019, 2, 'I'),
(1, 1019, 2, 'I'),
(3, 3020, 2, 'J'),
(2, 2020, 2, 'J'),
(1, 1020, 2, 'J'),
(3, 3021, 3, 'A'),
(1, 1021, 3, 'A'),
(3, 3022, 3, 'B'),
(1, 1022, 3, 'B'),
(3, 3023, 3, 'C'),
(1, 1023, 3, 'C'),
(3, 3024, 3, 'D'),
(1, 1024, 3, 'D'),
(3, 3025, 3, 'E'),
(1, 1025, 3, 'E'),
(3, 3026, 3, 'F'),
(1, 1026, 3, 'F'),
(3, 3027, 3, 'G'),
(1, 1027, 3, 'G'),
(3, 3028, 3, 'H'),
(1, 1028, 3, 'H'),
(3, 3029, 3, 'I'),
(1, 1029, 3, 'I'),
(3, 3030, 3, 'J'),
(1, 1030, 3, 'J'),
(3, 3031, 4, 'A'),
(1, 1031, 4, 'A'),
(3, 3032, 4, 'B'),
(1, 1032, 4, 'B'),
(3, 3033, 4, 'C'),
(1, 1033, 4, 'C'),
(3, 3034, 4, 'D'),
(1, 1034, 4, 'D'),
(3, 3035, 4, 'E'),
(1, 1035, 4, 'E'),
(3, 3036, 4, 'F'),
(1, 1036, 4, 'F'),
(3, 3037, 4, 'G'),
(1, 1037, 4, 'G'),
(3, 3038, 4, 'H'),
(1, 1038, 4, 'H'),
(3, 3039, 4, 'I'),
(1, 1039, 4, 'I'),
(3, 3040, 4, 'J'),
(1, 1040, 4, 'J'),
(3, 3041, 5, 'A'),
(1, 1041, 5, 'A'),
(3, 3042, 5, 'B'),
(1, 1042, 5, 'B'),
(3, 3043, 5, 'C'),
(1, 1043, 5, 'C'),
(3, 3044, 5, 'D'),
(1, 1044, 5, 'D'),
(3, 3045, 5, 'E'),
(1, 1045, 5, 'E'),
(3, 3046, 5, 'F'),
(1, 1046, 5, 'F'),
(3, 3047, 5, 'G'),
(1, 1047, 5, 'G'),
(3, 3048, 5, 'H'),
(1, 1048, 5, 'H'),
(3, 3049, 5, 'I'),
(1, 1049, 5, 'I'),
(3, 3050, 5, 'J'),
(1, 1050, 5, 'J'),
(3, 3051, 6, 'A'),
(3, 3052, 6, 'B'),
(3, 3053, 6, 'C'),
(3, 3054, 6, 'D'),
(3, 3055, 6, 'E'),
(3, 3056, 6, 'F'),
(3, 3057, 6, 'G'),
(3, 3058, 6, 'H'),
(3, 3059, 6, 'I'),
(3, 3060, 6, 'J'),
(3, 3061, 7, 'A'),
(3, 3062, 7, 'B'),
(3, 3063, 7, 'C'),
(3, 3064, 7, 'D'),
(3, 3065, 7, 'E'),
(3, 3066, 7, 'F'),
(3, 3067, 7, 'G'),
(3, 3068, 7, 'H'),
(3, 3069, 7, 'I'),
(3, 3070, 7, 'J'),
(3, 3071, 8, 'A'),
(3, 3072, 8, 'B'),
(3, 3073, 8, 'C'),
(3, 3074, 8, 'D'),
(3, 3075, 8, 'E'),
(3, 3076, 8, 'F'),
(3, 3077, 8, 'G'),
(3, 3078, 8, 'H'),
(3, 3079, 8, 'I'),
(3, 3080, 8, 'J'),
(3, 3081, 9, 'A'),
(3, 3082, 9, 'B'),
(3, 3083, 9, 'C'),
(3, 3084, 9, 'D'),
(3, 3085, 9, 'E'),
(3, 3086, 9, 'F'),
(3, 3087, 9, 'G'),
(3, 3088, 9, 'H'),
(3, 3089, 9, 'I'),
(3, 3090, 9, 'J'),
(3, 3091, 10, 'A'),
(3, 3092, 10, 'B'),
(3, 3093, 10, 'C'),
(3, 3094, 10, 'D'),
(3, 3095, 10, 'E'),
(3, 3096, 10, 'F'),
(3, 3097, 10, 'G'),
(3, 3098, 10, 'H'),
(3, 3099, 10, 'I'),
(3, 3100, 10, 'J');

-- --------------------------------------------------------

--
-- Structure de la table `user_`
--

DROP TABLE IF EXISTS `user_`;
CREATE TABLE IF NOT EXISTS `user_` (
  `userId` varchar(50) COLLATE latin1_bin NOT NULL,
  `userPassword` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `userEmail` varchar(100) COLLATE latin1_bin DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `user_`
--

INSERT INTO `user_` (`userId`, `userPassword`, `userEmail`, `isAdmin`) VALUES
('1', '$2y$10$CvOLyCOE0vWWnYoLd0hduezHi5etiFYLfbKy0D0KooukCRoalGDoW', 'alexandre.charlier@ynov.com', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
