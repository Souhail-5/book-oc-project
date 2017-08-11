-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 11 août 2017 à 15:48
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `project3`
--
CREATE DATABASE IF NOT EXISTS `project3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project3`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `episode_id` smallint(5) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(320) NOT NULL,
  `text` text NOT NULL,
  `publish_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nbr_signals` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('publish','pending') NOT NULL DEFAULT 'publish',
  `approved` bit(1) NOT NULL DEFAULT b'0',
  `trash` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `number` smallint(5) UNSIGNED NOT NULL,
  `part` smallint(5) UNSIGNED NOT NULL,
  `title` char(255) NOT NULL,
  `text` longtext NOT NULL,
  `publish_datetime` datetime DEFAULT NULL,
  `modification_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nbr_comments` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `slug` char(255) NOT NULL,
  `status` enum('publish','draft','pending') NOT NULL DEFAULT 'draft',
  `trash` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `episodes`
--
DELIMITER $$
CREATE TRIGGER `before_insert_episodes` BEFORE INSERT ON `episodes` FOR EACH ROW BEGIN
	declare original_slug char(128);
	declare slug_counter tinyint(2);
	set original_slug = new.slug;
	set slug_counter = 1;
	while exists (select true from episodes where slug = new.slug) do
		set new.slug = concat(original_slug, '-', slug_counter);
		set slug_counter = slug_counter + 1;
	end while;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_episodes` BEFORE UPDATE ON `episodes` FOR EACH ROW BEGIN
	DECLARE original_slug char(128);
	DECLARE slug_counter tinyint(2);
	SET original_slug = new.slug;
	SET slug_counter = 1;
	WHILE EXISTS (SELECT true FROM episodes WHERE slug = new.slug AND id <> new.id) do
		SET new.slug = concat(original_slug, '-', slug_counter);
		SET slug_counter = slug_counter + 1;
	END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `signals`
--

CREATE TABLE `signals` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `display_name`, `password`) VALUES
(1, 'demo@demo.com', 'Jean', '$2y$10$yNfm8dmTdA/aEXFUh.1Ye.G41bfDenn9bYZO.0UXeusvmTKpdNUea');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episode_id` (`episode_id`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signals`
--
ALTER TABLE `signals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `signals`
--
ALTER TABLE `signals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signals`
--
ALTER TABLE `signals`
  ADD CONSTRAINT `signals_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
