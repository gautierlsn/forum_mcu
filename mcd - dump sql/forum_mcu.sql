-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 23 avr. 2022 à 20:51
-- Version du serveur : 8.0.27
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum_mcu`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  `date_creation_comment` datetime NOT NULL,
  `id_discussion` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_creation_comment_fr` varchar(50) NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `Message_Discussion_FK` (`id_discussion`),
  KEY `Message_Utilisateur0_FK` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `contenu`, `date_creation_comment`, `id_discussion`, `id_utilisateur`, `date_creation_comment_fr`) VALUES
(37, '<h2>C&#39;est tellement bien !</h2>\r\n', '2022-04-23 22:48:00', 34, 18, '23/04/2022 22h48'),
(38, '<p><strong>Un peu oui xD</strong></p>\r\n', '2022-04-23 22:48:00', 33, 18, '23/04/2022 22h48'),
(39, '<p>Mais tellement &lt;3</p>\r\n', '2022-04-23 22:49:00', 32, 18, '23/04/2022 22h49'),
(40, '<p>Meilleur film</p>\r\n', '2022-04-23 22:49:00', 34, 19, '23/04/2022 22h49'),
(41, '<p><strong>Carr&eacute;ement ouai&nbsp;</strong></p>\r\n', '2022-04-23 22:49:00', 33, 19, '23/04/2022 22h49'),
(42, '<p>Tu nous manques Iron man ...</p>\r\n', '2022-04-23 22:50:00', 32, 19, '23/04/2022 22h50');

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `id_discussion` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_creation_fr` varchar(50) NOT NULL,
  PRIMARY KEY (`id_discussion`),
  KEY `Discussion_Utilisateur_FK` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id_discussion`, `titre`, `date_creation`, `id_utilisateur`, `date_creation_fr`) VALUES
(32, 'Est ce qu\'Iron man est le meilleur super héros de l\'univers Marvel ?', '2022-04-23 22:44:00', 19, '23/04/2022 22h44'),
(33, 'Thanos est il vraiment fou ?', '2022-04-23 22:45:00', 19, '23/04/2022 22h45'),
(34, 'Les gardiens de la galaxie, c\'est cool non ?', '2022-04-23 22:47:00', 18, '23/04/2022 22h47');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `dateNaiss`, `email`, `mdp`, `role`) VALUES
(18, 'DUTRONC', 'Jean', '2000-01-11', 'jeandutronc@gmail.com', '$2y$10$cccc3wO.4o4BAbATCQM99.Rc05kw3jJuQIQdtmpBjNJGSTgpROKXC', 0),
(19, 'DUFOUR', 'Daniel', '1997-06-04', 'root@gmail.com', '$2y$10$7RDckJui2ycVmPlqkDuNk.tKGvCXaLd5.wUAGj2utEweDS0fBkFPq', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Message_Discussion_FK` FOREIGN KEY (`id_discussion`) REFERENCES `discussion` (`id_discussion`),
  ADD CONSTRAINT `Message_Utilisateur0_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `Discussion_Utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
