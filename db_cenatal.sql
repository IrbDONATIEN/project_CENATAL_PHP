-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 07 nov. 2020 à 11:18
-- Version du serveur :  5.7.31
-- Version de PHP : 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_cenatal`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

DROP TABLE IF EXISTS `fiche`;
CREATE TABLE IF NOT EXISTS `fiche` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `poids` decimal(65,2) NOT NULL DEFAULT '2.00',
  `etat` varchar(100) NOT NULL,
  `lieuNais` varchar(100) NOT NULL,
  `dateNais` date NOT NULL,
  `heureNais` varchar(20) NOT NULL,
  `etatYeux` varchar(40) NOT NULL,
  `omblic` varchar(20) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_nouveaune` int(11) NOT NULL,
  `id_hopital` int(11) NOT NULL,
  PRIMARY KEY (`code`),
  KEY `id_nouveaune` (`id_nouveaune`),
  KEY `id_hopital` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche`
--

INSERT INTO `fiche` (`code`, `poids`, `etat`, `lieuNais`, `dateNais`, `heureNais`, `etatYeux`, `omblic`, `observation`, `date_creation`, `id_nouveaune`, `id_hopital`) VALUES
(1, '2.20', 'Vivant', 'test', '2020-10-15', '12:12', 'Normal', 'Oui', 'test', '2020-10-15 17:11:09', 2, 1),
(2, '2.30', 'Vivant', 'test', '2020-10-15', '12:01', 'Normal', 'Oui', 'Ok', '2020-10-15 17:12:51', 1, 1),
(3, '2.60', 'Vivant', 'test3', '2020-10-16', '12:12', 'Normal', 'Oui', 'OK', '2020-10-16 12:16:07', 4, 1),
(4, '3.40', 'Vivant', 'tess', '2020-10-16', '13:01', 'Normal', 'Oui', 'Ok', '2020-10-16 13:01:19', 3, 2),
(5, '2.20', 'Vivant', 'Kin1', '2020-10-17', '12:12', 'Normal', 'Oui', 'Ok', '2020-10-16 23:31:06', 5, 3),
(6, '3.20', 'Vivant', 'Kin2', '2020-10-16', '12:02', 'Normal', 'Oui', 'Ok', '2020-10-16 23:31:53', 6, 3),
(7, '2.40', 'Vivant', 'test', '2020-10-17', '12:11', 'Normal', 'Oui', 'Ok', '2020-10-17 00:08:02', 7, 1),
(8, '2.10', 'Vivant', 'TESSS', '2020-10-17', '12:02', 'Normal', 'Oui', 'Ok', '2020-10-17 00:12:38', 8, 1),
(9, '3.20', 'Vivant', 'kato', '2020-10-17', '12:12', 'Normal', 'Oui', 'Ok', '2020-10-17 00:25:26', 9, 1),
(10, '3.40', 'Vivant', 'test5', '2020-10-17', '12:12', 'Normal', 'Oui', 'Ok', '2020-10-17 00:28:16', 10, 1),
(11, '2.10', 'Vivant', 'test6', '2020-10-17', '12:12', 'Normal', 'Oui', 'Ok', '2020-10-17 00:31:12', 11, 1),
(12, '3.20', 'Vivant', 'GOMA', '2020-10-20', '04:20', 'Normal', 'Oui', 'OK', '2020-10-18 15:14:12', 12, 4);

-- --------------------------------------------------------

--
-- Structure de la table `hopital`
--

DROP TABLE IF EXISTS `hopital`;
CREATE TABLE IF NOT EXISTS `hopital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeHopital` varchar(100) NOT NULL,
  `nomHopital` varchar(100) NOT NULL,
  `loginHopital` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_zone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_zone` (`id_zone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hopital`
--

INSERT INTO `hopital` (`id`, `codeHopital`, `nomHopital`, `loginHopital`, `password`, `id_zone`) VALUES
(1, 'H80125', 'Hopital Radem', 'Radem', '1', 1),
(2, 'H90140', 'Hopital Kenya', 'Kenya', '2', 2),
(3, 'H6095', 'Hopital Kin', 'Ki', '22', 3),
(4, 'H86134', 'LM', 'GOMA', '1111', 4);

-- --------------------------------------------------------

--
-- Structure de la table `inspection`
--

DROP TABLE IF EXISTS `inspection`;
CREATE TABLE IF NOT EXISTS `inspection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeMat` varchar(100) NOT NULL,
  `nomInsp` varchar(100) NOT NULL,
  `loginInsp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_province` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_province` (`id_province`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inspection`
--

INSERT INTO `inspection` (`id`, `codeMat`, `nomInsp`, `loginInsp`, `password`, `date_creation`, `id_province`) VALUES
(1, '72-113', 'Inspection Lubumbashi', 'Lubu', '1', '2020-10-14 20:49:29', 1),
(2, '96-149', 'Inspection Kolwezi', 'Kol', '2', '2020-10-14 20:50:43', 15),
(3, '100-155', 'Inspection Provinciale Kinshasa', 'Kin', '12', '2020-10-16 23:16:29', 10),
(4, '52-83', 'Inspection Provinciale Goma', 'Goma', '1212', '2020-10-18 14:47:18', 19);

-- --------------------------------------------------------

--
-- Structure de la table `nouveau_ne`
--

DROP TABLE IF EXISTS `nouveau_ne`;
CREATE TABLE IF NOT EXISTS `nouveau_ne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_hopital` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_hopital` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nouveau_ne`
--

INSERT INTO `nouveau_ne` (`id`, `nom`, `prenom`, `sexe`, `service`, `date_creation`, `id_hopital`, `active`) VALUES
(1, 'test', 'test', 'Masculin', 'Service Accoucheuse', '2020-10-15 14:10:17', 1, 1),
(2, 'test2', 'test2', 'Masculin', 'Service Accoucheuse', '2020-10-15 14:11:45', 1, 1),
(3, 'TES', 'TES', 'Masculin', 'Service Accoucheuse', '2020-10-15 14:13:49', 2, 1),
(4, 'test3', 'test3', 'Feminin', 'Service Accoucheuse', '2020-10-16 12:15:04', 1, 1),
(5, 'Kin1', 'Kin1', 'Masculin', 'Service Accoucheuse', '2020-10-16 23:30:14', 3, 1),
(6, 'Kin2', 'Kin2', 'Feminin', 'Service Accoucheuse', '2020-10-16 23:30:27', 3, 1),
(7, 'test', 'test', 'Masculin', 'Service Accoucheuse', '2020-10-17 00:06:22', 1, 1),
(8, 'tesss', 'tesss', 'Feminin', 'Service Accoucheuse', '2020-10-17 00:11:44', 1, 1),
(9, 'test4', 'kato', 'Feminin', 'Service Accoucheuse', '2020-10-17 00:24:54', 1, 1),
(10, 'test5', 'test5', 'Feminin', 'Service Accoucheuse', '2020-10-17 00:27:46', 1, 1),
(11, 'test6', 'test6', 'Feminin', 'Service Accoucheuse', '2020-10-17 00:30:43', 1, 1),
(12, 'KASONGO', 'NATALIE', 'Feminin', 'Service Accoucheuse', '2020-10-18 15:08:37', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinces` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `province`
--

INSERT INTO `province` (`id`, `provinces`) VALUES
(1, 'Haut-Katanga'),
(2, 'Bas-Uele'),
(3, 'Equateur'),
(4, 'Haut-Lomami'),
(5, 'Haut-Uele'),
(6, 'Ituri'),
(7, 'Kasai'),
(8, 'Kasai-Central'),
(9, 'Kasai-Oriental'),
(10, 'Kinshasa'),
(11, 'Kongo-Central'),
(12, 'Kwango'),
(13, 'Kwilu'),
(14, 'Lomami'),
(15, 'Lualaba'),
(16, 'Mai-Ndombe'),
(17, 'Maniema'),
(18, 'Mongala'),
(19, 'Nord-Kivu'),
(20, 'Nord-Ubangi'),
(21, 'Sankuru'),
(22, 'Sud-Kivu'),
(23, 'Sud-Ubangi'),
(24, 'Tanganyika'),
(25, 'Tshopo'),
(26, 'Tshuapa');

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

DROP TABLE IF EXISTS `rapports`;
CREATE TABLE IF NOT EXISTS `rapports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nouveau_ne` int(11) NOT NULL,
  `id_hopital_id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `envoyer_hopital` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_nouveau_ne` (`id_nouveau_ne`),
  KEY `id_hopital_id` (`id_hopital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rapports`
--

INSERT INTO `rapports` (`id`, `id_nouveau_ne`, `id_hopital_id`, `date_create`, `envoyer_hopital`) VALUES
(1, 11, 1, '2020-10-17 00:31:12', 0),
(2, 12, 1, '2020-10-17 00:44:38', 0),
(3, 12, 4, '2020-10-18 15:14:11', 0);

-- --------------------------------------------------------

--
-- Structure de la table `service_national`
--

DROP TABLE IF EXISTS `service_national`;
CREATE TABLE IF NOT EXISTS `service_national` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `postnom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service_national`
--

INSERT INTO `service_national` (`id`, `nom`, `postnom`, `prenom`, `lieu`, `service`, `login`, `password`) VALUES
(1, 'MASANGU', 'MASANGU', 'LYDIA', 'KINSHASA', 'service National de Gestion de Natalite', 'LYDIA', '11111');

-- --------------------------------------------------------

--
-- Structure de la table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visitors`
--

INSERT INTO `visitors` (`id`, `hits`) VALUES
(0, 214);

-- --------------------------------------------------------

--
-- Structure de la table `zone_sante`
--

DROP TABLE IF EXISTS `zone_sante`;
CREATE TABLE IF NOT EXISTS `zone_sante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeZone` varchar(100) NOT NULL,
  `nomZone` varchar(100) NOT NULL,
  `loginZone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_inspection` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_inspection` (`id_inspection`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `zone_sante`
--

INSERT INTO `zone_sante` (`id`, `codeZone`, `nomZone`, `loginZone`, `password`, `id_inspection`, `date_create`) VALUES
(1, '106Z164', 'Zone de Sante Kampemba', 'Kamp', '1', 1, '2020-10-15 10:35:40'),
(2, '46Z74', 'Zone de Sante Kenya', 'Kenya', '1', 1, '2020-10-15 12:42:57'),
(3, '30Z50', 'Zone de sante Kinshasa', 'Kin', '11', 3, '2020-10-16 23:27:52'),
(4, '98Z152', 'Zone de sante Goma', 'NGK', '1111', 4, '2020-10-18 14:56:13');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fiche`
--
ALTER TABLE `fiche`
  ADD CONSTRAINT `fiche_ibfk_1` FOREIGN KEY (`id_nouveaune`) REFERENCES `nouveau_ne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fiche_ibfk_2` FOREIGN KEY (`id_hopital`) REFERENCES `hopital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `hopital`
--
ALTER TABLE `hopital`
  ADD CONSTRAINT `hopital_ibfk_1` FOREIGN KEY (`id_zone`) REFERENCES `zone_sante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`id_province`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `rapports_ibfk_1` FOREIGN KEY (`id_hopital_id`) REFERENCES `hopital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `zone_sante`
--
ALTER TABLE `zone_sante`
  ADD CONSTRAINT `zone_sante_ibfk_1` FOREIGN KEY (`id_inspection`) REFERENCES `inspection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
