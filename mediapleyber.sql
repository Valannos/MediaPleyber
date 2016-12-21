-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 21 Décembre 2016 à 21:04
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mediaplayber`
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
(1, 1, 'Fantasy', 'J.R.R Tolkien'),
(2, 2, 'Fantastique', 'Kafka'),
(3, 3, 'Roman autobiographique', 'Jean-Paule Sartre'),
(4, 5, 'Fantastique', 'Guy de Maupassant');

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
(1, 6, 'Venom', 'Heavy Metal'),
(2, 7, 'Antonio Vivaldi', 'Musique Baroque'),
(3, 8, 'Georges Brassens', 'Chanson Française'),
(4, 10, 'The Beatles', 'Rock');

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
(1, 'Goscinny', 'Uderzo', 4),
(2, 'Hergé', 'Hergé', 9),
(3, 'René Pétillon', 'René Pétillon', 11);

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
(19, 'Bourse aux livres', 'Vente de livres pour la rentrée 2017, niveau lycée et supérieur', 'Mediathèque de Pleyber', '2017-08-20 14:00:00'),
(20, 'Lectures de Noël', 'Lecture de contes de Noël pour les tout-petits', 'Mediathèque de Pleyber', '2017-12-20 16:00:00');

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
('Le Seigneur des Anneaux - Les Deux Tours', 0, '2016-10-06 00:00:00', 1, 1, 'deux_tour_1.jpeg'),
('La méthamorphose', 0, '2016-10-02 00:00:00', 2, 1, 'meta_kafka.jpg'),
('Les Mots', 0, '2016-04-19 00:00:00', 3, 1, 'les_mots_sartre.jpg'),
('Astérix chez les Helvètes', 2, '2016-05-26 00:00:00', 4, 1, 'asterix_helvetes_cover.jpg'),
('Le Horla', 0, '2016-04-18 00:00:00', 5, 1, 'horlacouv-couleur.jpg'),
('Black Metal', 1, '2016-08-17 00:00:00', 6, 1, 'black_metal_cover.jpg'),
('Suites pour Violoncelles', 1, '2016-10-05 00:00:00', 7, 1, 'cello_vivaldi.jpg'),
('Mourir pour des idées', 1, '2015-02-18 00:00:00', 8, 1, 'brassens_mourir_pour_des_idees.jpg'),
('Objectif Lune', 2, '2015-02-03 00:00:00', 9, 1, 'herge-objectif_lune.jpg'),
('The Beatles', 1, '2016-12-20 00:00:00', 10, 1, 'The_White_Album.svg.png'),
('L\'enquête corse', 2, '2016-12-07 00:00:00', 11, 1, 'enquete_corse.jpg');

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
(27, 'Messager', 'Alain', 'Messager', '$2y$13$G3ssWTK0K3Qj.cHaR5fKbu/J7tVXGVr3oAxu03fFLTv7stU2i310K', 'a:1:{i:0;s:12:"ROLE_GESTION";}', ''),
(28, 'Le Floc\'h', 'Anne', 'Le Floc\'h', '$2y$13$fUmbnRCAZhGQH86trsjAB.yAJfIAPoJcze5PzWQQjsqeOlfyiTc8.', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(29, 'Le Goff', 'Jean', 'Le Goff', '$2y$13$iv51xelbdCY/.PwCnlgA9OF/tnLUA2k6xbFdr1UWOQ3TSabwjeuFK', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(30, 'Le Gall', 'Marie', 'Le Gall', '$2y$13$tuLnxH4eJgusbeEzdEIIfuRBwKJhzZ3A37AOF33sL3fi0OOkbdsIq', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(31, 'admin', 'admin', 'admin', '$2y$13$nOgNwuWcj3AW550XtCImUuPgrYPmfqwrFkp45a5f6Uetu0EfP2jPG', 'a:1:{i:0;s:12:"ROLE_GESTION";}', ''),
(32, 'user', 'user', 'user', '$2y$13$LxdiAMnkCNKOcS02khKKEOd/lTEW8eIkWmCSuh7Rhy6v7Mebpl6j2', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `comic`
--
ALTER TABLE `comic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
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
