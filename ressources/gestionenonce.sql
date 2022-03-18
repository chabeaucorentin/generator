-- Base de donnees `gestionenonce`
-- --------------------------------------------------------
--
-- Structure de la table `champ`
--
CREATE TABLE `champ`
(
  `nom`         varchar(50)   COLLATE utf8_unicode_ci NOT NULL,
  `typechamp`   varchar(20)   COLLATE utf8_unicode_ci NOT NULL,
  `parametres`  varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`nom`),
    KEY `idx_type` (`typechamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
--
-- Structure de la table `enonce`
--
CREATE TABLE `enonce`
(
  `idEnonce`  int(11)         NOT NULL AUTO_INCREMENT,
  `contenu`   varchar(10000)  COLLATE utf8_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`idEnonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;