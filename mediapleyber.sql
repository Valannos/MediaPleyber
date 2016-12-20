-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 20 Décembre 2016 à 16:52
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mediapleyber`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `id_media` int(11) DEFAULT NULL,
  `genre` varchar(30) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `book`
--

INSERT INTO `book` (`id`, `id_media`, `genre`, `author`) VALUES
(1, 29, 'Fantasy', 'J.R.R Tolkien'),
(2, 30, 'Fantastique', 'Kafka'),
(3, 31, 'Autobiographie', 'Jean-Paule Sartre'),
(4, 33, 'Fantastique', 'Guy de Maupassant');

-- --------------------------------------------------------

--
-- Structure de la table `cd`
--

CREATE TABLE `cd` (
  `id` int(11) NOT NULL,
  `id_media` int(11) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cd`
--

INSERT INTO `cd` (`id`, `id_media`, `author`, `genre`) VALUES
(1, 34, 'Venom', 'Heavy Metal'),
(2, 35, 'Antonio Vivaldi', 'Musique Baroque'),
(3, 36, 'Georges Brassens', 'Chanson Française');

-- --------------------------------------------------------

--
-- Structure de la table `comic`
--

CREATE TABLE `comic` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `drawer` varchar(255) NOT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comic`
--

INSERT INTO `comic` (`id`, `author`, `drawer`, `media_id`) VALUES
(1, 'Goscinny', 'Uderzo', 32),
(2, 'Hergé', 'Hergé', 37);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `lieu`, `date`) VALUES
(39, 'Bourse aux livres', 'Vente de livres pour la rentrée 2017, niveau lycée et supérieur', 'Mediathèque de Pleyber', '2017-08-20 14:00:00'),
(40, 'Lectures de Noël', 'Lecture de contes de Noël pour les tout-petits', 'Mediathèque de Pleyber', '2017-12-20 16:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `return_date` date DEFAULT NULL,
  `loan_date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `isReturned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `loan`
--

INSERT INTO `loan` (`id`, `return_date`, `loan_date`, `user_id`, `media_id`, `isReturned`) VALUES
(21, '2016-12-19', '2016-12-19', 22, 30, 1),
(22, '2016-12-20', '2016-12-19', 22, 31, 1),
(23, '2016-12-20', '2016-12-19', 22, 30, 1),
(24, '2016-12-20', '2016-12-20', 24, 29, 1),
(25, '2016-12-20', '2016-12-20', 23, 30, 1),
(26, NULL, '2016-12-20', 23, 33, 0),
(27, NULL, '2016-12-20', 24, 29, 0);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `title` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `statut` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`title`, `type`, `date`, `id`, `statut`, `cover`) VALUES
('Le Seigneur des Anneaux - Les Deux Tours', 0, '2016-10-06 00:00:00', 29, 3, 'deux_tour_1.jpeg'),
('La méthamorphose', 0, '2016-10-02 00:00:00', 30, 2, 'meta_kafka.jpg'),
('Les Mots', 0, '2016-04-19 00:00:00', 31, 2, 'les_mots_sartre.jpg'),
('Asterix chez les Helvètes', 2, '2016-05-26 00:00:00', 32, 1, 'asterix_helvetes_cover.jpg'),
('Le Horla', 0, '2016-04-18 00:00:00', 33, 3, 'horlacouv-couleur.jpg'),
('Black Metal', 1, '2016-08-17 00:00:00', 34, 1, 'black_metal_cover.jpg'),
('Suites pour Violoncelles', 1, '2016-10-05 00:00:00', 35, 1, 'cello_vivaldi.jpg'),
('Mourir pour des idées', 1, '2015-02-18 00:00:00', 36, 1, 'brassens_mourir_pour_des_idees.jpg'),
('Objectif Lune', 2, '2015-02-03 00:00:00', 37, 1, 'herge-objectif_lune.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `user_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `borrowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`user_id`, `media_id`, `date`, `id`, `statut`, `borrowed`) VALUES
(22, 33, '2016-12-19', 40, 0, 0),
(22, 30, '2016-12-19', 41, 1, 1),
(22, 30, '2016-12-19', 42, 1, 1),
(22, 31, '2016-12-19', 43, 1, 1),
(22, 29, '2016-12-20', 44, 0, 0),
(22, 29, '2016-12-20', 45, 0, 0),
(23, 33, '2016-12-20', 46, 0, 0),
(23, 29, '2016-12-20', 47, 0, 0),
(23, 33, '2016-12-20', 48, 0, 0),
(23, 33, '2016-12-20', 49, 0, 0),
(23, 29, '2016-12-20', 50, 0, 0),
(24, 33, '2016-12-20', 51, 0, 0),
(24, 29, '2016-12-20', 52, 0, 0),
(24, 29, '2016-12-20', 53, 0, 0),
(24, 29, '2016-12-20', 54, 0, 0),
(24, 30, '2016-12-20', 55, 0, 0),
(24, 29, '2016-12-20', 56, 0, 0),
(24, 29, '2016-12-20', 57, 1, 1),
(24, 30, '2016-12-20', 58, 0, 0),
(24, 31, '2016-12-20', 59, 0, 0),
(24, 30, '2016-12-20', 60, 0, 0),
(24, 29, '2016-12-20', 61, 0, 0),
(24, 29, '2016-12-20', 62, 0, 0),
(24, 29, '2016-12-20', 63, 0, 0),
(24, 29, '2016-12-20', 64, 0, 0),
(24, 29, '2016-12-20', 65, 0, 0),
(24, 29, '2016-12-20', 66, 0, 0),
(24, 29, '2016-12-20', 67, 0, 0),
(24, 29, '2016-12-20', 68, 0, 0),
(24, 30, '2016-12-20', 69, 0, 0),
(22, 30, '2016-12-20', 70, 0, 0),
(22, 31, '2016-12-20', 71, 0, 0),
(22, 31, '2016-12-20', 72, 0, 0),
(23, 30, '2016-12-20', 73, 0, 0),
(23, 29, '2016-12-20', 74, 0, 0),
(23, 30, '2016-12-20', 75, 0, 0),
(23, 30, '2016-12-20', 76, 1, 1),
(23, 33, '2016-12-20', 77, 1, 1),
(24, 29, '2016-12-20', 78, 1, 1),
(22, 30, '2016-12-20', 79, 0, 0),
(22, 30, '2016-12-20', 80, 1, 0),
(22, 31, '2016-12-20', 81, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `username`, `password`, `roles`, `salt`) VALUES
(22, 'Messager', 'Alain', 'Messager', '$2y$13$iaUXONZeKM260E8/J9cg5OeWWr0rANz/4fsb2V5Zw9K68AZSOIzxy', 'a:1:{i:0;s:12:"ROLE_GESTION";}', ''),
(23, 'Le Floc\'h', 'Anne', 'Le Floc\'h', '$2y$13$y2ekoIlPywiO3IG/suOGC.W7YRgl/XyrBtQA7uNhW1qjLoeqkLlgO', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(24, 'Le Goff', 'Jean', 'Le Goff', '$2y$13$c4krOvmun/hCT4Mi5.QeOuNnsqdN9F2Sa4AEqF0lHgDQx8hUhE7ZW', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id_media`);

--
-- Index pour la table `cd`
--
ALTER TABLE `cd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id_media`);

--
-- Index pour la table `comic`
--
ALTER TABLE `comic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`,`media_id`),
  ADD KEY `media_coderef` (`media_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `cd`
--
ALTER TABLE `cd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `comic`
--
ALTER TABLE `comic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_media`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `cd`
--
ALTER TABLE `cd`
  ADD CONSTRAINT `cd_ibfk_1` FOREIGN KEY (`id_media`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `comic`
--
ALTER TABLE `comic`
  ADD CONSTRAINT `comic_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `FK_C5D30D03A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_C5D30D03EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
