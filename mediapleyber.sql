-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 14 Décembre 2016 à 16:56
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
(1, 'Le Gall', 'Marie', 'marlegall', '', 'REGISTERED', ''),
(2, 'Le Goff', 'Jean', 'jealegoff', '', 'REGISTERED', ''),
(3, 'Le Floc\'h', 'Anne', 'annlefloch', '', 'REGISTERED', ''),
(4, 'Messager', 'Alain', 'alamessager', '', 'GESTION', ''),
(5, 'Messager', 'Messager', 'Messager', '$2y$13$ZLlRZtSWGC93aHtkglQxFe8l1xi3Qbz6gH8ujTzpEp9MEUGnp9sUS', 'a:1:{i:0;s:12:"ROLE_GESTION";}', ''),
(6, 'Le Floc\'h', 'Le Floc\'h', 'Le Floc\'h', '$2y$13$F/0WMvOnjroruGPb81Z4tuEkNqdhQbZwDqWeJWLTWK45BMDAtV4yK', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(7, 'Le Goff', 'Le Goff', 'Le Goff', '$2y$13$sk.iVGnevgAPV/GpfMF/7uRH947LldxAB0LM86ed26WpfmZROXnAO', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', ''),
(8, 'Le Gall', 'Le Gall', 'Le Gall', '$2y$13$cD4bLloLFP9EB.J6mJzC7u5/XgUEXlBfyGU8e9je.4O.oyNlepNZi', 'a:1:{i:0;s:15:"ROLE_REGISTERED";}', '');

--
-- Index pour les tables exportées
--

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
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
