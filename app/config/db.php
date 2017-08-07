-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 07 août 2017 à 08:40
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `project3`
--

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

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `episode_id`, `name`, `email`, `text`, `publish_datetime`, `modification_datetime`, `nbr_signals`, `status`, `approved`, `trash`) VALUES
(53, 6, 'Souhail Moussaoui', 'smsouhail@gmail.com', 'Le nom ne doit comporter que des lettres et espaces. Sa longueur doit être comprise entre 5 et 50 caractères. La longueur du commentaire doit être comprise entre 140 et 1400 caractères', '2017-08-06 06:08:43', '2017-08-07 04:49:59', 7, 'publish', b'0', b'0'),
(54, 6, 'Souhail Moussaoui', 'smsouhail@gmail.com', 'Le nom ne doit comporter que des lettres et espaces. Sa longueur doit être comprise entre 5 et 50 caractères. La longueur du commentaire doit être comprise entre 140 et 1400 caractères, La longueur du commentaire doit être comprise entre 140 et 1400 caractères', '2017-08-06 06:21:44', '2017-08-07 04:50:28', 2, 'publish', b'0', b'0');

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
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `number`, `part`, `title`, `text`, `publish_datetime`, `modification_datetime`, `nbr_comments`, `slug`, `status`, `trash`) VALUES
(1, 1, 0, 'Titre du premier &eacute;pisode', '<p>Texte du premier &eacute;pisode</p>', '2017-07-07 05:20:32', '2017-08-06 06:04:04', 0, 'titre-du-premier-episode', 'publish', b'0'),
(2, 2, 0, 'Un second &eacute;pisode !', '<p>Texte du deuxi&egrave;me &eacute;pisode !!</p>', '2017-07-28 14:01:37', '2017-07-28 14:01:37', 0, 'un-second-episode', 'publish', b'0'),
(3, 3, 0, 'Ceci est le troisième épisode', 'Texte du troisième épisode', '2017-07-08 12:28:17', '2017-07-21 21:41:14', 0, 'ceci-est-le-troisieme-episode-1', 'publish', b'0'),
(4, 4, 0, 'Petit essai avec un long titre, &agrave; rallonge, et surement sur deux lignes.', '<p>Texte du quatri&egrave;me &eacute;pisode</p>', '2017-07-28 15:08:11', '2017-07-28 15:08:11', 0, 'petit-essai-avec-un-long-titre-a-rallonge-et-surement-sur-deux-lignes-1', 'publish', b'0'),
(5, 5, 0, 'Mon billet retour', '<blockquote>Texte du <em>cinqui&egrave;me</em> &eacute;pisode !</blockquote>', '2017-07-12 07:14:32', '2017-08-02 13:31:05', 0, 'mon-billet-retour', 'publish', b'0'),
(6, 6, 0, 'Je n\'ai plus d\'id&eacute;e !', '<p>Texte du sixi&egrave;me &eacute;pisode !!</p>', '2017-07-15 17:13:43', '2017-08-06 22:49:07', 2, 'je-nai-plus-didee', 'publish', b'0'),
(10, 7, 0, 'Titre du premier &eacute;pisode', '<p>Texte du premier &eacute;pisode</p>', '2017-07-07 05:20:32', '2017-08-07 07:36:28', 0, 'titre-du-premier-episode-1', 'publish', b'0'),
(11, 8, 0, 'Un second &eacute;pisode !', '<p>Texte du deuxi&egrave;me &eacute;pisode !!</p>', '2017-07-28 14:01:37', '2017-08-07 07:36:28', 0, 'un-second-episode-1', 'publish', b'0'),
(12, 9, 0, 'Ceci est le troisième épisode', 'Texte du troisième épisode', '2017-07-08 12:28:17', '2017-08-07 07:36:28', 0, 'ceci-est-le-troisieme-episode-1-1', 'publish', b'0'),
(13, 10, 0, 'Petit essai avec un long titre, &agrave; rallonge, et surement sur deux lignes.', '<p>Texte du quatri&egrave;me &eacute;pisode</p>', '2017-07-28 15:08:11', '2017-08-07 07:36:28', 0, 'petit-essai-avec-un-long-titre-a-rallonge-et-surement-sur-deux-lignes-1-1', 'publish', b'0'),
(14, 11, 0, 'Mon billet retour', '<blockquote>Texte du <em>cinqui&egrave;me</em> &eacute;pisode !</blockquote>', '2017-07-12 07:14:32', '2017-08-07 07:36:28', 0, 'mon-billet-retour-1', 'publish', b'0'),
(15, 12, 0, 'Je n\'ai plus d\'id&eacute;e !', '<p>Texte du sixi&egrave;me &eacute;pisode !!</p>', '2017-07-15 17:13:43', '2017-08-07 08:04:31', 2, 'je-nai-plus-didee-1', 'publish', b'0'),
(16, 0, 0, 'Votre titre', '<p>Il &eacute;tait une fois ...</p>', NULL, '2017-08-07 08:16:25', 0, 'votre-titre', 'draft', b'0'),
(17, 0, 0, 'Votre titre', '<p>Il &eacute;tait une fois ... 222</p>', NULL, '2017-08-07 08:28:14', 0, 'votre-titre-1', 'draft', b'0');

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

--
-- Déchargement des données de la table `signals`
--

INSERT INTO `signals` (`id`, `comment_id`, `ip_address`) VALUES
(1, 53, '127.0.0.1'),
(2, 54, '127.0.0.1');

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
	MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
	MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `signals`
--
ALTER TABLE `signals`
	MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
