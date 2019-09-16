-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 16 sep. 2019 à 17:00
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony-demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'Titre de l\'article n°1', '<p>Contenu de l\'article n°1</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(2, 'Titre de l\'article n°2', '<p>Contenu de l\'article n°2</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(3, 'Titre de l\'article n°3', '<p>Contenu de l\'article n°3</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(4, 'Titre de l\'article n°4', '<p>Contenu de l\'article n°4</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(5, 'Titre de l\'article n°5', '<p>Contenu de l\'article n°5</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(6, 'Titre de l\'article n°6', '<p>Contenu de l\'article n°6</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(7, 'Titre de l\'article n°7', '<p>Contenu de l\'article n°7</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(8, 'Titre de l\'article n°8', '<p>Contenu de l\'article n°8</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40'),
(9, 'Titre de l\'article n°9', '<p>Contenu de l\'article n°9</p>', 'https://placehold.it/350x150', '2019-09-16 14:59:40');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190916125018', '2019-09-16 12:52:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
