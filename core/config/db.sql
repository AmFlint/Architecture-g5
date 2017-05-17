-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mer 17 Mai 2017 à 12:47
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `architecture`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE `actualites` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_short` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_full` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `actualites`
--

INSERT INTO `actualites` (`id`, `title`, `slug`, `content_short`, `content_full`, `date`) VALUES
  (1, 'L''Architecture Moderne', 'architecture-moderne', 'Au cours des siècles, l''Homme a su montrer une certaine maîtrise de l''architecture, en effet ...', 'Le full content qu''on va utiliser pour cette première actualité', '2017-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `raison_sociale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activite` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_geographique` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revue` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `date_add` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `raison_sociale`, `activite`, `nom`, `prenom`, `fonction`, `adresse`, `code_postal`, `ville`, `pays`, `telephone`, `fax`, `mail`, `zone_geographique`, `revue`, `quantite`, `commande_id`, `date_add`) VALUES
  (1, 'mas', 'mas', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'masselot@hotmail.com', 'france_metropolitaine', '280', 1, 1, '2017-02-12'),
  (2, 'mas', 'mas', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'masselot@hotmail.com', 'france_metropolitaine', '280', 1, 1, '0000-00-00'),
  (3, 'mas', 'mas', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'm', 'masselot@hotmail.com', 'france_metropolitaine', '280', 1, 1, '2017-05-16');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `raison_sociale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `object` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `raison_sociale`, `nom`, `telephone`, `mail`, `service`, `message`, `date`, `object`) VALUES
  (1, 'test', 'Salut', '0920', 'amasselot@hotmail.com', 'redactionnel/publicite', 'test test', '0000-00-00', ''),
  (2, 'new', 'check', '0920', 'amasselot@hotmail.com', 'redactionnel/publicite', 'un message', '0000-00-00', ''),
  (3, 'test', 'masselot lol', 'loezgjief', 'ioejg@mail.test', 'commerciale', 'Le message de test', '2017-05-17', 'masselot a faim');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
  (1, 'Val de Loire'),
  (2, 'Saint-Barthelemy'),
  (3, 'Belgique'),
  (4, 'Alsace'),
  (5, 'Nouméa'),
  (6, 'empty'),
  (7, 'Alsaca'),
  (8, 'Espagne'),
  (9, 'Allemagne'),
  (10, 'Paris'),
  (13, 'Noum&eacute;a');

-- --------------------------------------------------------

--
-- Structure de la table `magazines`
--

CREATE TABLE `magazines` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` year(4) NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `secondary_location` int(11) NOT NULL DEFAULT '6'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `magazines`
--

INSERT INTO `magazines` (`id`, `title`, `synopsis`, `image`, `secondary_image`, `date`, `link`, `location_id`, `secondary_location`) VALUES
  (1, 'Centre Val de Loire', 'L''Architecture dans le Centre Val de Loire est très maîtrisée...', 'magazine-269.jpg', 'magazine-276.jpg', 2017, 'http://fr.calameo.com/read/001121299ba572cf53fca', 1, 4),
  (2, 'Belgique', 'L''Architecture au coeur de la Belgique, une aventure ...', 'magazine_278.jpg', '', 2017, 'http://fr.calameo.com/read/00112129970991e922bc3', 3, 2),
  (3, 'Alsace', 'L''Alsace et l''architecture sa fait 1', 'magazine_279.jpg', '', 2017, 'http://fr.calameo.com/read/0011212993e4406f651e8', 4, 6),
  (4, 'Saint-Barthelemy', 'L''Architecture dans la ville de Saint-Barthelemy', 'magazine_270.jpg', '', 2017, 'http://fr.calameo.com/read/0011212990739cc3f4df6', 2, 6),
  (5, 'Ile de France', 'L''Architecture en Ile de France, notamment à Paris, est très développé, effectivement ...', 'magazine_269.jpg', '', 2017, 'http://fr.calameo.com/read/001121299eae418c77d3a', 6, 6),
  (6, 'Europe', 'L''europe', 'Capture-d-Aoe-Acran-2016-11-02-a-A-13.19.31.png', '', 2016, 'http://lol', 5, 10),
  (7, 'Nouméa test', 'test de nouméa', 'news-illustre-1390512142-664.jpg', '0825-walkingdead.jpg', 2014, 'lol', 10, 11),
  (8, 'test figma', 'Le petit synopsis qui fait plaisir', 'rick.jpg', '', 2010, 'mariecharles.com', 10, 6);

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `visible_front` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `name`, `link`, `location_id`, `visible_front`) VALUES
  (1, 'Belgique Ciment', 'http://vivianebadach.eu/', 5, 0),
  (2, 'Architecte Als', '', 4, 0),
  (3, 'Architecture de Saint-Barthelemy', '', 2, 0),
  (4, 'Val de Loire archi', 'https', 5, 1),
  (5, 'Cabinet du val de loire', '', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `partenariat`
--

CREATE TABLE `partenariat` (
  `id` int(11) NOT NULL,
  `partenaire_id` int(11) NOT NULL,
  `magazine_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `partenariat`
--

INSERT INTO `partenariat` (`id`, `partenaire_id`, `magazine_id`) VALUES
  (1, 5, 1),
  (2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_commande`
--

CREATE TABLE `type_commande` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `type_commande`
--

INSERT INTO `type_commande` (`id`, `type`) VALUES
  (1, 'commande'),
  (2, 'abonnement');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actualites`
--
ALTER TABLE `actualites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenariat`
--
ALTER TABLE `partenariat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_commande`
--
ALTER TABLE `type_commande`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actualites`
--
ALTER TABLE `actualites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `partenariat`
--
ALTER TABLE `partenariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_commande`
--
ALTER TABLE `type_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;