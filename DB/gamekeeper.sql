-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 22 mars 2026 à 18:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gamekeeper`
--

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `title`, `description`, `cover_image`, `release_date`, `created_at`) VALUES
(4, 'Cyberpunk 2077', 'RPG futuriste en monde ouvert, Night City', 'https://www.notebookcheck.biz/fileadmin/Notebooks/News/_nc3/FKVoOYOXoAABU4E.jpg', '2020-12-10', '2026-03-22 16:22:44'),
(5, 'Call of Duty: Warzone', 'Battle royale free-to-play', 'https://i.pinimg.com/736x/2c/f0/d8/2cf0d862006cbc7a0953ac248bc6f455.jpg', '2020-03-10', '2026-03-22 16:46:06'),
(6, 'Valorant', 'FPS tactique 5v5', 'https://i.pinimg.com/736x/5c/95/c3/5c95c35ce191a78b4564c3caf49720e1.jpg', '2020-06-02', '2026-03-22 16:53:27'),
(7, 'Apex Legends', 'Battle royale avec des légendes aux capacités uniques', 'https://i.pinimg.com/1200x/55/96/31/5596316c7b07d0a40705d6b44c39c936.jpg', '2019-02-04', '2026-03-22 16:54:53'),
(8, 'Fortnite', 'Battle royale avec construction', 'https://i.pinimg.com/736x/e6/e6/ab/e6e6abc5799bc473d8651fab80aa12a3.jpg', '2019-10-15', '2026-03-22 16:57:22'),
(9, 'Halo Infinite', 'FPS emblématique de Xbox', 'https://i.pinimg.com/736x/ac/28/13/ac2813911d927607d0ab0b0f0123f31b.jpg', '2021-12-08', '2026-03-22 17:03:25'),
(10, 'Elden Ring', 'RPG en monde ouvert, GOTY 2022', 'https://i.pinimg.com/1200x/c3/60/d1/c360d162805f59e5a8445df461b71590.jpg', '2022-02-25', '2026-03-22 17:05:53'),
(11, 'God of War: Ragnarök', 'Action-Aventure mythologie nordique', 'https://i.pinimg.com/1200x/32/de/f7/32def75422756fa965e62d7e49c8c19b.jpg', '2022-11-09', '2026-03-22 17:13:28'),
(12, 'EA FC 26', 'jeu vidéo de simulation de football', 'https://i.pinimg.com/736x/c7/17/1f/c7171fde719178ac257ca92a8bfe8966.jpg', '2025-09-26', '2026-03-22 17:15:11');

-- --------------------------------------------------------

--
-- Structure de la table `game_genres`
--

CREATE TABLE `game_genres` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `game_genres`
--

INSERT INTO `game_genres` (`id`, `game_id`, `genre_id`) VALUES
(4, 4, 2),
(5, 4, 11),
(6, 4, 3),
(12, 7, 6),
(13, 7, 17),
(14, 6, 3),
(15, 6, 17),
(16, 5, 6),
(17, 5, 3),
(18, 8, 6),
(24, 10, 21),
(25, 10, 22),
(26, 10, 23),
(27, 9, 20),
(28, 9, 3),
(29, 11, 2),
(31, 12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `game_platforms`
--

CREATE TABLE `game_platforms` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `game_platforms`
--

INSERT INTO `game_platforms` (`id`, `game_id`, `platform_id`) VALUES
(7, 4, 9),
(8, 4, 4),
(9, 4, 6),
(10, 4, 5),
(11, 4, 8),
(12, 4, 7),
(27, 7, 9),
(28, 7, 4),
(29, 7, 6),
(30, 7, 5),
(31, 7, 8),
(32, 7, 7),
(33, 6, 4),
(34, 6, 5),
(35, 6, 7),
(36, 5, 4),
(37, 5, 6),
(38, 5, 5),
(39, 5, 8),
(40, 5, 7),
(41, 8, 13),
(42, 8, 9),
(43, 8, 4),
(44, 8, 6),
(45, 8, 5),
(46, 8, 8),
(47, 8, 7),
(61, 10, 4),
(62, 10, 6),
(63, 10, 5),
(64, 10, 8),
(65, 10, 7),
(66, 9, 4),
(67, 9, 8),
(68, 9, 7),
(69, 11, 4),
(70, 11, 6),
(71, 11, 5),
(77, 12, 4),
(78, 12, 6),
(79, 12, 5),
(80, 12, 8),
(81, 12, 7);

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(20, 'Action'),
(2, 'Action-Aventure'),
(21, 'Action-RPG'),
(6, 'Battle Royale'),
(11, 'Combat'),
(8, 'Course'),
(3, 'FPS (First-Person-Shooter)'),
(17, 'Hero Shooter'),
(13, 'Horreur / Survival'),
(14, 'MMORPG (Massively-Multiplayer-Online-Role-Playing-Game) '),
(7, 'MOBA'),
(22, 'Monde ouvert'),
(12, 'Plateforme'),
(15, 'Puzzle'),
(4, 'RPG (Role Playing Game)'),
(16, 'Sandbox'),
(10, 'Simulation'),
(23, 'Soulslike'),
(5, 'Sport'),
(9, 'Stratégie'),
(18, 'TPS (Third-Person-Shooter)');

-- --------------------------------------------------------

--
-- Structure de la table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `platforms`
--

INSERT INTO `platforms` (`id`, `name`) VALUES
(13, 'Mobile'),
(12, 'Nintendo 3DS'),
(9, 'Nintendo Switch'),
(4, 'PC'),
(10, 'PlayStation 3'),
(6, 'PlayStation 4'),
(5, 'PlayStation 5'),
(11, 'Xbox 360'),
(8, 'Xbox One'),
(7, 'Xbox Series X');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(4, 'Admin', 'admingamekeeper@gmail.com', '$2y$10$dDjpWST8tB4NpWs2tV5Jk..oag0QZH8OXwP97FcJmZNgnyinAPf92', 'admin', '2026-03-18 13:55:17'),
(5, 'TheNotoriousTo', 'tommypsg04@gmail.com', '$2y$10$/9OxWS11H1TIqXTX389ise0WdjaW4rMYDpDMQDK/6lWJVfFcP4FDu', 'user', '2026-03-18 14:48:16'),
(6, 'TommyK04', 'tommykarotsch4@gmail.com', '$2y$10$1NKESU.TBLvW01r2C5WkSe9Et7wZQXScgdK4brr0ukudpG5vcedFG', 'user', '2026-03-18 14:50:31'),
(7, 'Bertrand Lamar', 'bertrandlamarinho@gmail.com', '$2y$10$NwCaPvOKxUTTtlfY.qS6UevSLPOMEvX5FNQnMvYkb9ImbUZQAmjee', 'user', '2026-03-19 10:32:01');

-- --------------------------------------------------------

--
-- Structure de la table `user_games`
--

CREATE TABLE `user_games` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `status` enum('wish_list','playing','completed','abandoned') NOT NULL DEFAULT 'wish_list',
  `playtime` int(11) NOT NULL DEFAULT 0,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_games`
--

INSERT INTO `user_games` (`id`, `user_id`, `game_id`, `status`, `playtime`, `added_at`) VALUES
(3, 5, 4, 'playing', 80, '2026-03-22 17:16:36'),
(4, 5, 6, 'playing', 30, '2026-03-22 17:16:38'),
(5, 5, 12, 'playing', 120, '2026-03-22 17:16:40');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Index pour la table `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_games`
--
ALTER TABLE `user_games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `game_genres`
--
ALTER TABLE `game_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `game_platforms`
--
ALTER TABLE `game_platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user_games`
--
ALTER TABLE `user_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `game_genres`
--
ALTER TABLE `game_genres`
  ADD CONSTRAINT `game_genres_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `game_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Contraintes pour la table `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD CONSTRAINT `game_platforms_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `game_platforms_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`);

--
-- Contraintes pour la table `user_games`
--
ALTER TABLE `user_games`
  ADD CONSTRAINT `fk_user_games_game_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `fk_user_games_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
