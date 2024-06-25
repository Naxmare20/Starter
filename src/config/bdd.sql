-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 20 juin 2024 à 18:46
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todo`
--

-- --------------------------------------------------------

--
-- Structure de la table `todolist`
--

CREATE TABLE `todolist` (
                            `id` int(10) UNSIGNED NOT NULL,
                            `task` varchar(255) NOT NULL,
                            `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `todolist`
--

INSERT INTO `todolist` (`id`, `task`, `user_id`) VALUES
                                                     (1, 'Sweets', 1),
                                                     (2, 'Books', 2),
                                                     (3, 'Movies', 3),
                                                     (4, 'Strawberries', 3),
                                                     (5, 'Books', 2),
                                                     (6, 'Wand', 4),
                                                     (7, 'Croquettes', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
                        `id` int(10) UNSIGNED NOT NULL,
                        `username` varchar(255) NOT NULL,
                        `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
                                                      (1, 'HarryPotter', '1234'),
                                                      (2, 'HermioneGranger', '1234'),
                                                      (3, 'RonWeasley', '1234'),
                                                      (4, 'AlbusDumbledore', '1234'),
                                                      (5, 'Merlin', '$2y$10$rUgRa0Gl9CYb2CBKEX7RCO02sr.sZmuCnhfFJIwZcvv1BUO.sUwKS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `todolist`
--
ALTER TABLE `todolist`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `todolist`
--
ALTER TABLE `todolist`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
