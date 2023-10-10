-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 25 août 2023 à 00:29
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zap706559-3`
--

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `zap706559-3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `zap706559-3`;

--
-- Structure de la table `ennemies`
--

CREATE TABLE `ennemies` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `pv` int(11) DEFAULT NULL,
  `attk` int(11) DEFAULT NULL,
  `xp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ennemies`
--

INSERT INTO `ennemies` (`id`, `type`, `pv`, `attk`, `xp`, `created_at`, `updated_at`) VALUES
(1, 'zombie', 15, 3, NULL, '2023-08-24 22:12:03', NULL),
(2, 'troll', 11, 5, NULL, '2023-08-24 22:12:03', NULL),
(3, 'zombie', 5, 6, NULL, '2023-08-24 22:12:03', NULL),
(4, 'zombie', 5, 3, NULL, '2023-08-24 22:12:03', NULL),
(5, 'troll', 7, 6, NULL, '2023-08-24 22:12:03', NULL),
(6, 'orc', 8, 2, NULL, '2023-08-24 22:12:03', NULL),
(8, 'zombie', 12, 4, NULL, '2023-08-24 22:12:03', NULL),
(9, 'troll', 15, 6, NULL, '2023-08-24 22:12:03', NULL),
(10, 'zombie', 4, 5, NULL, '2023-08-24 22:12:03', NULL),
(12, 'troll', 8, 5, NULL, '2023-08-24 22:12:03', NULL),
(13, 'troll', 8, 4, NULL, '2023-08-24 22:12:03', NULL),
(14, 'goblin', 2, 5, NULL, '2023-08-24 22:12:03', NULL),
(15, 'troll', 9, 2, NULL, '2023-08-24 22:12:03', NULL),
(16, 'goblin', 3, 6, NULL, '2023-08-24 22:12:03', NULL),
(18, 'goblin', 5, 5, NULL, '2023-08-24 22:12:03', NULL),
(19, 'orc', 7, 2, NULL, '2023-08-24 22:12:03', NULL),
(20, 'skeleton', 12, 4, NULL, '2023-08-24 22:12:03', NULL),
(21, 'goblin', 12, 5, NULL, '2023-08-24 22:12:03', NULL),
(22, 'troll', 13, 3, NULL, '2023-08-24 22:12:03', NULL),
(23, 'troll', 3, 4, NULL, '2023-08-24 22:12:03', NULL),
(24, 'skeleton', 3, 5, NULL, '2023-08-24 22:12:03', NULL),
(25, 'skeleton', 5, 5, NULL, '2023-08-24 22:12:03', NULL),
(26, 'zombie', 4, 6, NULL, '2023-08-24 22:12:03', NULL),
(28, 'orc', 7, 6, NULL, '2023-08-24 22:12:03', NULL),
(29, 'troll', 8, 3, NULL, '2023-08-24 22:12:03', NULL),
(30, 'orc', 4, 4, NULL, '2023-08-24 22:12:03', NULL),
(31, 'orc', 14, 2, NULL, '2023-08-24 22:12:03', NULL),
(32, 'zombie', 15, 4, NULL, '2023-08-24 22:12:03', NULL),
(33, 'troll', 15, 4, NULL, '2023-08-24 22:12:03', NULL),
(34, 'goblin', 4, 5, NULL, '2023-08-24 22:12:03', NULL),
(35, 'goblin', 12, 4, NULL, '2023-08-24 22:12:03', NULL),
(36, 'troll', 9, 5, NULL, '2023-08-24 22:12:03', NULL),
(38, 'zombie', 6, 4, NULL, '2023-08-24 22:12:03', NULL),
(39, 'troll', 11, 6, NULL, '2023-08-24 22:12:03', NULL),
(41, 'goblin', 9, 6, NULL, '2023-08-24 22:12:03', NULL),
(42, 'goblin', 11, 4, NULL, '2023-08-24 22:12:03', NULL),
(43, 'orc', 12, 4, NULL, '2023-08-24 22:12:03', NULL),
(44, 'troll', 11, 3, NULL, '2023-08-24 22:12:03', NULL),
(45, 'troll', 6, 5, NULL, '2023-08-24 22:12:03', NULL),
(46, 'troll', 12, 3, NULL, '2023-08-24 22:12:03', NULL),
(47, 'zombie', 12, 6, NULL, '2023-08-24 22:12:03', NULL),
(48, 'troll', 3, 3, NULL, '2023-08-24 22:12:03', NULL),
(49, 'zombie', 11, 3, NULL, '2023-08-24 22:12:03', NULL),
(50, 'goblin', 6, 2, NULL, '2023-08-24 22:12:03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pv` int(11) NOT NULL,
   `lvl` int(11) NOT NULL,
  `attk` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `posx` int(11) NOT NULL DEFAULT 0,
  `posy` int(11) NOT NULL DEFAULT 0,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `pseudo`, `pv`, `attk`, `xp`, `created_at`, `updated_at`, `posx`, `posy`, `avatar`) VALUES
(1, 'Ououia', 10, 5, 21, '2023-08-24 22:12:03', NULL, 4, 7, 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Prescription01&hairColor=BrownDark&facialHairType=Blank&facialHairColor=Blonde&clotheType=ShirtCrewNeck&clotheColor=Gray02&eyeType=Wink&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Default');

-- --------------------------------------------------------

--
-- Structure de la table `treasures`
--

CREATE TABLE `treasures` (
  `id` int(11) NOT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `treasures`
--

INSERT INTO `treasures` (`id`, `posx`, `posy`, `created_at`, `updated_at`) VALUES
(1, 6, 7, '2023-08-24 22:12:03', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ennemies`
--
ALTER TABLE `ennemies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `treasures`
--
ALTER TABLE `treasures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ennemies`
--
ALTER TABLE `ennemies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `treasures`
--
ALTER TABLE `treasures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
