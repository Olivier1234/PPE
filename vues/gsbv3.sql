-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Septembre 2015 à 15:35
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gsbv2`
--
CREATE DATABASE IF NOT EXISTS `gsbv2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gsbv2`;

-- --------------------------------------------------------

--
-- Structure de la table `comptable`
--

CREATE TABLE IF NOT EXISTS `comptable` (
  `id` char(4) COLLATE utf8_bin NOT NULL,
  `nom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `prenom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `login` char(20) COLLATE utf8_bin DEFAULT NULL,
  `mdp` char(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `comptable`
--

INSERT INTO `comptable` (`id`, `nom`, `prenom`, `login`, `mdp`) VALUES
('a001', 'Dmin', 'Albert', 'Admin', 'dcddb75469b4b4875094e14561e573d8'),
('z007', 'NICOLAS', 'Gary', 'gary', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id` char(2) COLLATE utf8_bin NOT NULL,
  `libelle` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE IF NOT EXISTS `fichefrais` (
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `nbJustificatifs` int(11) DEFAULT NULL,
  `montantValide` decimal(10,2) DEFAULT NULL,
  `dateModif` date DEFAULT NULL,
  `idEtat` char(2) COLLATE utf8_bin DEFAULT 'CR',
  PRIMARY KEY (`idVisiteur`,`mois`),
  KEY `idEtat` (`idEtat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) VALUES
('a131', '201408', 0, '0.00', '2014-09-29', 'VA'),
('a131', '201409', 0, '0.00', '2014-11-24', 'CL'),
('b19', '201408', 0, '0.00', '2014-11-23', 'VA'),
('b19', '201409', 0, '0.00', '2014-09-29', 'CL'),
('c3', '201408', 0, '0.00', '2014-09-29', 'RB'),
('c3', '201409', 0, '0.00', '2014-09-29', 'CR');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `id` char(3) COLLATE utf8_bin NOT NULL,
  `libelle` char(20) COLLATE utf8_bin DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `idFraisForfait` char(3) COLLATE utf8_bin NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVisiteur`,`mois`,`idFraisForfait`),
  KEY `idFraisForfait` (`idFraisForfait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES
('a131', '201409', 'ETP', 2),
('a131', '201409', 'KM', 12),
('a131', '201409', 'NUI', 2),
('a131', '201409', 'REP', 5);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `libelle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idVisiteur` (`idVisiteur`,`mois`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idVisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(4, 'a131', '201409', 'aa1', '2014-08-12', '1.00'),
(6, 'a131', '201409', 'aa3', '2014-10-12', '3.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfaitrefuse`
--

CREATE TABLE IF NOT EXISTS `lignefraishorsforfaitrefuse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVisiteur` char(4) COLLATE utf8_bin NOT NULL,
  `mois` char(6) COLLATE utf8_bin NOT NULL,
  `libelle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idVisiteur` (`idVisiteur`,`mois`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `lignefraishorsforfaitrefuse`
--

INSERT INTO `lignefraishorsforfaitrefuse` (`id`, `idVisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(7, 'a131', '201409', 'aa', '2014-08-12', '1.00');

--
-- Déclencheurs `lignefraishorsforfaitrefuse`
--
DROP TRIGGER IF EXISTS `dellignefraishorsforfaitrefuse`;
DELIMITER //
CREATE TRIGGER `dellignefraishorsforfaitrefuse` BEFORE DELETE ON `lignefraishorsforfaitrefuse`
 FOR EACH ROW BEGIN
   DECLARE nb INTEGER ;
   SELECT COUNT(*) INTO nb
   FROM lignefraishorsforfait
   WHERE id = OLD.id 
   AND idVisiteur = OLD.idVisiteur
   AND mois = OLD.mois;
   IF (nb = 1) THEN
      SIGNAL SQLSTATE "45002" 
      SET MESSAGE_TEXT = "operation impossible : la ligne hors forfait existe déjà" ; 
   END IF ;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `dellignefraishorsforfaitrefuse2`;
DELIMITER //
CREATE TRIGGER `dellignefraishorsforfaitrefuse2` AFTER DELETE ON `lignefraishorsforfaitrefuse`
 FOR EACH ROW BEGIN
   INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES
(OLD.id, OLD.idVisiteur,  OLD.mois,  OLD.libelle,  OLD.date, OLD.montant);

END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `inslignefraishorsforfaitrefuse`;
DELIMITER //
CREATE TRIGGER `inslignefraishorsforfaitrefuse` BEFORE INSERT ON `lignefraishorsforfaitrefuse`
 FOR EACH ROW BEGIN
   DECLARE nb INTEGER ;
   SELECT COUNT(*) INTO nb
   FROM lignefraishorsforfait
   WHERE id = NEW.id 
   AND idVisiteur = NEW.idVisiteur
   AND mois = NEW.mois
   AND libelle = NEW.libelle
   AND date = NEW.date
   AND montant = NEW.montant ;
   IF (nb = 0) THEN
      SIGNAL SQLSTATE "45000" 
      SET MESSAGE_TEXT = "operation impossible : la ligne hors forfait n'existe pas" ; 
   END IF ;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `inslignefraishorsforfaitrefuse2`;
DELIMITER //
CREATE TRIGGER `inslignefraishorsforfaitrefuse2` AFTER INSERT ON `lignefraishorsforfaitrefuse`
 FOR EACH ROW BEGIN
   DELETE FROM lignefraishorsforfait
   WHERE id = NEW.id ;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` char(4) COLLATE utf8_bin NOT NULL,
  `nom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `prenom` char(30) COLLATE utf8_bin DEFAULT NULL,
  `login` char(20) COLLATE utf8_bin DEFAULT NULL,
  `mdp` char(50) COLLATE utf8_bin DEFAULT NULL,
  `adresse` char(30) COLLATE utf8_bin DEFAULT NULL,
  `cp` char(5) COLLATE utf8_bin DEFAULT NULL,
  `ville` char(30) COLLATE utf8_bin DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateEmbauche`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', 'dcddb75469b4b4875094e14561e573d8', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21','commercial'),
('a17', 'Andre', 'David', 'dandre', '37f2381c9a729782c38410b1ea5b8191', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23','commercial'),
('a55', 'Bedos', 'Christian', 'cbedos', '26ec3c585ee973005c2744742d920dc3', '1 rue Peranud', '46250', 'Montcuq', '1995-01-12','commercial'),
('a93', 'Tusseau', 'Louis', 'ltusseau', 'f85f3127fc55f0ad7433b6879bc05f4e', '22 rue des Ternes', '46123', 'Gramat', '2000-05-01','commercial'),
('b13', 'Bentot', 'Pascal', 'pbentot', 'ae5d0d7637be4083a245f980a2189d97', '11 allée des Cerises', '46512', 'Bessines', '1992-07-09','commercial'),
('b16', 'Bioret', 'Luc', 'lbioret', '566ea5a9b3a6f186928cc20711f13fa8', '1 Avenue gambetta', '46000', 'Cahors', '1998-05-11','commercial'),
('b19', 'Bunisset', 'Francis', 'fbunisset', '969c2fe5ac918a86a664b2041d5bc295', '10 rue des Perles', '93100', 'Montreuil', '1987-10-21','commercial'),
('b25', 'Bunisset', 'Denise', 'dbunisset', '03b01d4e2f53d838a2228e6cd57b8578', '23 rue Manin', '75019', 'paris', '2010-12-05','commercial'),
('b28', 'Cacheux', 'Bernard', 'bcacheux', 'f6b78ee75c60c4becd5ed3daaca14127', '114 rue Blanche', '75017', 'Paris', '2009-11-12','commercial'),
('b34', 'Cadic', 'Eric', 'ecadic', '36b98727aece53010ddde58639294427', '123 avenue de la République', '75011', 'Paris', '2008-09-23','commercial'),
('b4', 'Charoze', 'Catherine', 'ccharoze', 'fce14894825737b9850d2bfccf0adf02', '100 rue Petit', '75019', 'Paris', '2005-11-12','commercial'),
('b50', 'Clepkens', 'Christophe', 'cclepkens', '9ac1d70eef6e5f225b1db64eabaa4374', '12 allée des Anges', '93230', 'Romainville', '2003-08-11','commercial'),
('b59', 'Cottin', 'Vincenne', 'vcottin', 'e509e3ed6ac643ac405aba9c40ebc591', '36 rue Des Roches', '93100', 'Monteuil', '2001-11-18','commercial'),
('c14', 'Daburon', 'François', 'fdaburon', '44fda4ffdcf80a5f0c07fd0c82dafa4b', '13 rue de Chanzy', '94000', 'Créteil', '2002-02-11','commercial'),
('c3', 'De', 'Philippe', 'pde', 'd5d01f0959b81d8e99e0ff5ecec858f7', '13 rue Barthes', '94000', 'Créteil', '2010-12-14','commercial'),
('c54', 'Debelle', 'Michel', 'mdebelle', '5583dc317a2427151176da897d02847c', '181 avenue Barbusse', '93210', 'Rosny', '2006-11-23','commercial'),
('d13', 'Debelle', 'Jeanne', 'jdebelle', 'b7d60232b71cf9cbbfffa53cac58c2b6', '134 allée des Joncs', '44000', 'Nantes', '2000-05-11','commercial'),
('d51', 'Debroise', 'Michel', 'mdebroise', '7101579c34d26bb94798fa096c577a8b', '2 Bld Jourdain', '44000', 'Nantes', '2001-04-17','commercial'),
('e22', 'Desmarquest', 'Nathalie', 'ndesmarquest', '77f0798fb878eba2d41a92187db41370', '14 Place d Arc', '45000', 'Orléans', '2005-11-12','commercial'),
('e24', 'Desnost', 'Pierre', 'pdesnost', 'f22a9af3e65d9b3942f242cb559374ae', '16 avenue des Cèdres', '23200', 'Guéret', '2001-02-05','commercial'),
('e39', 'Dudouit', 'Frédéric', 'fdudouit', '09723e8247fbdda4d2dda2d15d160dfd', '18 rue de l église', '23120', 'GrandBourg', '2000-08-01','commercial'),
('e49', 'Duncombe', 'Claude', 'cduncombe', '4b66fd37213456e6d58e79993a446241', '19 rue de la tour', '23100', 'La souteraine', '1987-10-10','commercial'),
('e5', 'Enault-Pascreau', 'Céline', 'cenault', '8c2cfac2fc5e3b1100842b3573720cc8', '25 place de la gare', '23200', 'Gueret', '1995-09-01','commercial'),
('e52', 'Eynde', 'Valérie', 'veynde', 'ea33b05db1515b43c387050ef64e687b', '3 Grand Place', '13015', 'Marseille', '1999-11-01','commercial'),
('f21', 'Finck', 'Jacques', 'jfinck', 'ec5014f6a2f2631952b6c677409a29fe', '10 avenue du Prado', '13002', 'Marseille', '2001-11-10','commercial'),
('f39', 'Frémont', 'Fernande', 'ffremont', 'xs5tq8774099cc05fd213276773425739ed85', '4 route de la mer', '13012', 'Allauh', '1998-10-01','commercial'),
('f4', 'Gest', 'Alain', 'agest', 'dywvt8167f1d92b7c2666aaf0d6f77cbc761d', '30 avenue de la mer', '13025', 'Berre', '1985-11-01','commercial');
('compt', 'LeBlanc', 'Juste', 'JLeblanc', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '10 rue de la paix', '75015', 'Paris', '1985-11-01','comptable');

-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`idVisiteur`) REFERENCES `visiteur` (`id`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`idVisiteur`, `mois`) REFERENCES `fichefrais` (`idVisiteur`, `mois`),
  ADD CONSTRAINT `lignefraisforfait_ibfk_2` FOREIGN KEY (`idFraisForfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`idVisiteur`, `mois`) REFERENCES `fichefrais` (`idVisiteur`, `mois`);

--
-- Contraintes pour la table `lignefraishorsforfaitrefuse`
--
ALTER TABLE `lignefraishorsforfaitrefuse`
  ADD CONSTRAINT `lignefraishorsforfaitrefuse_ibfk_1` FOREIGN KEY (`idVisiteur`, `mois`) REFERENCES `fichefrais` (`idVisiteur`, `mois`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
