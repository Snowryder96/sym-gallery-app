-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 22 fév. 2021 à 10:05
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `patriciaartstudio`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Portrait'),
(2, 'Paysage'),
(3, 'Illustration');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201127120927', '2020-11-27 12:11:57', 42),
('DoctrineMigrations\\Version20201127125110', '2020-11-27 12:51:20', 78),
('DoctrineMigrations\\Version20201127130552', '2020-11-27 13:06:02', 64),
('DoctrineMigrations\\Version20201127160806', '2020-11-27 16:08:11', 75),
('DoctrineMigrations\\Version20201127175827', '2020-11-27 17:58:33', 75),
('DoctrineMigrations\\Version20201129055338', '2020-11-29 05:53:51', 92),
('DoctrineMigrations\\Version20201129061455', '2020-11-29 06:15:02', 73),
('DoctrineMigrations\\Version20201202133205', '2020-12-02 13:32:15', 752),
('DoctrineMigrations\\Version20201202133946', '2020-12-02 13:39:51', 64),
('DoctrineMigrations\\Version20201207234140', '2020-12-07 23:41:50', 626),
('DoctrineMigrations\\Version20201207234444', '2020-12-07 23:44:53', 80),
('DoctrineMigrations\\Version20201207235208', '2020-12-07 23:52:13', 173),
('DoctrineMigrations\\Version20201208020739', '2020-12-08 02:07:44', 159),
('DoctrineMigrations\\Version20201208021033', '2020-12-08 02:10:36', 119),
('DoctrineMigrations\\Version20201208125505', '2020-12-08 12:55:10', 126),
('DoctrineMigrations\\Version20201208130712', '2020-12-08 13:07:15', 181),
('DoctrineMigrations\\Version20210106182450', '2021-01-06 18:25:01', 127),
('DoctrineMigrations\\Version20210106203604', '2021-01-06 20:36:12', 81);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `painting_id` int(11) NOT NULL,
  `buyer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398B00EB939` (`painting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `painting_id`, `buyer`, `email`, `created_at`) VALUES
(10, 20, 'alexis', 'masuyalex@hotmail.com', '2021-01-07 03:28:49');

-- --------------------------------------------------------

--
-- Structure de la table `painting`
--

DROP TABLE IF EXISTS `painting`;
CREATE TABLE IF NOT EXISTS `painting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legende` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `painting_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `technic_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `availability` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_66B9EBA0FAAE137C` (`technic_id`),
  KEY `IDX_66B9EBA012469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `painting`
--

INSERT INTO `painting` (`id`, `title`, `description`, `legende`, `created_at`, `slug`, `width`, `height`, `painting_filename`, `technic_id`, `category_id`, `availability`) VALUES
(12, 'Webscraping', 'scraping data off the wikidsfgdgqdgfsdfsdfgsdgfdghfdgbvfvsdfvfd fgqdfgqfdg fqdg qdfgqdfgq', 'une bonne legende', '2020-12-02 20:15:46', 'jhkghljkgikg', 150, 120, 'webscrapppingExemple1-5fc7f5f2cc492.png', 3, 1, 1),
(14, 'hgfhfghs', 'gfshfghfsh', 'sghsfgh', '2020-12-07 15:41:32', 'hgfhfghs', 150, 900, '42b6cd4f0c49e4edb4a64c64d05183fa-5fce4d2cb8a5d.jpeg', 2, 2, 0),
(20, 'gfhgfhfgh', 'fdgqdfg', 'fdgdfqg', '2020-12-09 21:21:32', 'gfhgfhfgh', 200, 100, 'ferrari-458-liberty-walk-wide-1920x1200-5fd13fdc8ee71.jpeg', 2, 1, 1),
(21, 'gfhgfhfghfghfhfghfgh', 'fdgqdfg', 'fdgdfqg', '2020-12-09 21:24:47', 'gfhgfhfghfghfhfghfgh', 200, 100, 'bg-grad1-5fd1409f433ae.png', 2, 1, 1),
(22, 'gfhfsgjsdjkfh', 'gfhfs gjsdj kfhgfhfs gjsdjkfhgf hfsgjs djkfhgfhfsgjsdjkfh', 'gfhfsgjsdjkfhgfhfsgjsdjkfh', '2020-12-09 21:41:28', 'gfhfsgjsdjkfh', 800, 900, 'cover-r4x3w1000-5de550e886958-dsc-0406-jpg-5fd14488e3fbf.jpeg', 2, 2, 1),
(23, 'une bonne descutyjgyjg', 'gfhgfjfgh', 'hfghfgjkghkgh', '2020-12-11 23:27:00', 'une-bonne-descutyjgyjg', 800, 900, 'EmQNkpSVoAMhLiq-5fd4004450373.jpeg', 2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `technic`
--

DROP TABLE IF EXISTS `technic`;
CREATE TABLE IF NOT EXISTS `technic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `technic`
--

INSERT INTO `technic` (`id`, `name`) VALUES
(1, 'Aquarelle'),
(2, 'Huile'),
(3, 'Dessin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(13, 'masuyalex@hotmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$N2hTR05MUi50YlNEWmpKeA$BYhUMuL1iBaD351QPxQlFJtdIUU5H0CKNxLWT4vF2bs'),
(14, 'patou.masuy@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TFdKMUltT1REdXU4bno5NQ$45XtDNTW4PSOh5/jQ76c+19CfkIAtMaXioAyVhHAdyk'),
(15, 'jury@3wa.io', '[]', '$argon2id$v=19$m=65536,t=4,p=1$R0JCOFFDZng2djdRSy5WSw$SQ9uXrq+KRKtv3fHWoL9RhCwOfTE9el4v3y4/ebsJBs');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398B00EB939` FOREIGN KEY (`painting_id`) REFERENCES `painting` (`id`);

--
-- Contraintes pour la table `painting`
--
ALTER TABLE `painting`
  ADD CONSTRAINT `FK_66B9EBA012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_66B9EBA0FAAE137C` FOREIGN KEY (`technic_id`) REFERENCES `technic` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
