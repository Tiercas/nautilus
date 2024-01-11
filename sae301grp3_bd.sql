-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 09 jan. 2024 à 15:43
-- Version du serveur :  10.5.21-MariaDB-0+deb11u1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae301grp3_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `CAR_BOAT`
--

CREATE TABLE `CAR_BOAT` (
  `BO_ID` int(11) NOT NULL,
  `BO_NAME` char(32) DEFAULT NULL,
  `BO_NUMBER_OF_SEATS` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_BOAT`
--

INSERT INTO `CAR_BOAT` (`BO_ID`, `BO_NAME`, `BO_NUMBER_OF_SEATS`) VALUES
(1, 'Le dauphin', '25'),
(2, 'L\'Estellen', '12'),
(3, 'LE BEKLEM', '35'),
(4, 'Ocean Adventure', '50');

-- --------------------------------------------------------

--
-- Structure de la table `CAR_DIVING_GROUP`
--

CREATE TABLE `CAR_DIVING_GROUP` (
  `DS_CODE` char(32) NOT NULL,
  `DG_NUMBER` char(32) NOT NULL,
  `DG_MAX_DURATION` int(11) DEFAULT NULL,
  `DG_BEGINNING_OF_DIVING_HOUR` time DEFAULT NULL,
  `DG_END_OF_DIVING_HOUR` time DEFAULT NULL,
  `DG_MAX_EFFECTIVE_DEPTH` double(5,2) DEFAULT NULL,
  `DG_EFFECTIVE_DIVING_DURATION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_DIVING_GROUP`
--

INSERT INTO `CAR_DIVING_GROUP` (`DS_CODE`, `DG_NUMBER`, `DG_MAX_DURATION`, `DG_BEGINNING_OF_DIVING_HOUR`, `DG_END_OF_DIVING_HOUR`, `DG_MAX_EFFECTIVE_DEPTH`, `DG_EFFECTIVE_DIVING_DURATION`) VALUES
('DS1', 'DG1', 60, '10:00:00', '12:00:00', 20.50, 55),
('DS2', 'DG2', 90, '14:30:00', '16:00:00', 29.70, 85),
('DS3', 'DG3', 95, '09:30:00', '11:00:00', 33.50, 90),
('DS4', 'DG4', 120, '07:30:00', '09:00:00', 38.50, 115);

-- --------------------------------------------------------

--
-- Structure de la table `CAR_DIVING_LOCATION`
--

CREATE TABLE `CAR_DIVING_LOCATION` (
  `DL_ID` int(11) NOT NULL,
  `DL_NAME` char(32) DEFAULT NULL,
  `DL_LATITUDE` char(15) DEFAULT NULL,
  `DL_LONGITUDE` char(15) DEFAULT NULL,
  `DL_DEPTH` double(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_DIVING_LOCATION`
--

INSERT INTO `CAR_DIVING_LOCATION` (`DL_ID`, `DL_NAME`, `DL_LATITUDE`, `DL_LONGITUDE`, `DL_DEPTH`) VALUES
(1, 'new_name', 'new_latitude', 'new_longitude', 30.00),
(2, 'Astan', '48.44450', '47.57461', 50.00),
(3, 'Chateau du taureau', '48.40318', '3.53032', 30.00),
(4, 'Le paradis', '48.44498', '3.46116', 30.00),
(5, 'Le pot de fer', '48.44498', '3.46116', 60.00),
(6, 'L\'ile verte', '48.44498', '3.46116', 20.00),
(7, 'Archodonou', '48.44498', '3.46116', 30.00),
(8, 'Stolvezen', '48.44498', '3.46116', 40.00),
(9, 'Les trepieds', '48.44498', '3.46116', 40.00),
(10, 'Henri James', '48.44498', '3.46116', 60.00),
(11, 'L\'Aboukir', '48.44498', '3.46116', 30.00),
(12, 'Corbeau-CALIG', '48.44498', '3.46116', 30.00),
(13, 'Corbeau', '48.44498', '3.46116', 30.00);

-- --------------------------------------------------------

--
-- Structure de la table `CAR_DIVING_SESSION`
--

CREATE TABLE `CAR_DIVING_SESSION` (
  `DS_CODE` char(32) NOT NULL,
  `US_ID` int(11) NOT NULL,
  `DL_ID` int(11) NOT NULL,
  `BO_ID` int(11) NOT NULL,
  `US_ID_CAR_SECURE` int(11) NOT NULL,
  `US_ID_CAR_DIRECT` int(11) NOT NULL,
  `DS_DATE` date NOT NULL,
  `CAR_SCHEDULE` char(10) DEFAULT NULL,
  `DS_OBSERVATION_FIELD` varchar(255) DEFAULT NULL,
  `DS_ACTIVE` tinyint(1) NOT NULL,
  `DS_MAX_DEPTH` int(11) DEFAULT NULL,
  `DS_MAX_DIVERS` int(11) DEFAULT NULL,
  `DS_DIVERS_COUNT` int(11) NOT NULL DEFAULT 0,
  `DS_LEVEL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_DIVING_SESSION`
--

INSERT INTO `CAR_DIVING_SESSION` (`DS_CODE`, `US_ID`, `DL_ID`, `BO_ID`, `US_ID_CAR_SECURE`, `US_ID_CAR_DIRECT`, `DS_DATE`, `CAR_SCHEDULE`, `DS_OBSERVATION_FIELD`, `DS_ACTIVE`, `DS_MAX_DEPTH`, `DS_MAX_DIVERS`, `DS_DIVERS_COUNT`, `DS_LEVEL`) VALUES
('DS1', 4, 1, 1, 1, 2, '2022-10-01', 'Matin', 'Clear visibility', 0, 100, NULL, 0, 0),
('DS2', 4, 2, 2, 1, 2, '2022-11-01', 'Apres-midi', 'Lots of marine life', 1, 30, NULL, 0, 0),
('DS3', 4, 3, 3, 1, 2, '2022-12-01', 'Soir', 'Water temperature was warm', 1, 35, NULL, 0, 0),
('DS4', 4, 4, 4, 1, 2, '2023-01-01', 'Matin', 'Slight current', 1, 40, NULL, 0, 0);

--
-- Déclencheurs `CAR_DIVING_SESSION`
--
DELIMITER $$
CREATE TRIGGER `TRIGG_CAR_DIVING_SESSION_INTEGRITY` BEFORE INSERT ON `CAR_DIVING_SESSION` FOR EACH ROW BEGIN
        DECLARE var INT;
        SELECT count(*) into var from CAR_ROLE_ATTRIBUTIONWHERE CAR_ROLE_ATTRIBUTION.US_ID=NEW.US_ID and ROL_CODE='PIL';
        if (var=0) then
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'the person you''re trying to add as a pilot is not a pilot';
        end if;
        SELECT count(*) into var from CAR_ROLE_ATTRIBUTIONWHERE CAR_ROLE_ATTRIBUTION.US_ID=NEW.US_ID_CAR_SECURE and ROL_CODE='SEC';
        if (var=0) then
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'the person you''re trying to add as Surface Security is not Surface Security';
        end if;
        SELECT count(*) into var from CAR_ROLE_ATTRIBUTIONWHERE CAR_ROLE_ATTRIBUTION.US_ID=NEW.US_ID_CAR_DIRECT and ROL_CODE='Director';
        if (var=0) then
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'the person you''re trying to add as a Diving Director is not a Director';
        end if;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `CAR_PREROGATIVE`
--

CREATE TABLE `CAR_PREROGATIVE` (
  `PRE_CODE` char(10) NOT NULL,
  `PRE_LEVEL` int(11) DEFAULT NULL,
  `PRE_MAX_DEPTH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_PREROGATIVE`
--

INSERT INTO `CAR_PREROGATIVE` (`PRE_CODE`, `PRE_LEVEL`, `PRE_MAX_DEPTH`) VALUES
('PA', 0, 6),
('PA-12', 1, 20),
('PA-20', 2, 40),
('PA-40', 2, 40),
('PA-60', 3, 60),
('PA-60-GP', 4, 60),
('PB', 0, 6),
('PE-20', 1, 20),
('PE-40', 1, 40),
('PE-60', 2, 60),
('PO-12m', 0, 12),
('PO-20m', 0, 20);

-- --------------------------------------------------------

--
-- Structure de la table `CAR_REGISTRATION`
--

CREATE TABLE `CAR_REGISTRATION` (
  `US_ID` int(11) NOT NULL,
  `DS_CODE` char(32) NOT NULL,
  `DG_NUMBER` char(32) DEFAULT NULL,
  `REG_ACTIVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_REGISTRATION`
--

INSERT INTO `CAR_REGISTRATION` (`US_ID`, `DS_CODE`, `DG_NUMBER`, `REG_ACTIVE`) VALUES
(1, 'DS1', 'DG1', 1),
(2, 'DS2', 'DG2', 1),
(3, 'DS2', NULL, 1),
(3, 'DS3', 'DG3', 1),
(4, 'DS4', 'DG4', 1),
(5, 'DS4', 'DG4', 1);

-- --------------------------------------------------------

--
-- Structure de la table `CAR_ROLE`
--

CREATE TABLE `CAR_ROLE` (
  `ROL_CODE` char(32) NOT NULL,
  `ROL_LABEL` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_ROLE`
--

INSERT INTO `CAR_ROLE` (`ROL_CODE`, `ROL_LABEL`) VALUES
('DIR', 'Director'),
('DIV', 'Diver'),
('PIL', 'Boat pilot'),
('SEC', 'Surface Security');

-- --------------------------------------------------------

--
-- Structure de la table `CAR_ROLE_ATTRIBUTION`
--

CREATE TABLE `CAR_ROLE_ATTRIBUTION` (
  `ROL_CODE` char(32) NOT NULL,
  `US_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_ROLE_ATTRIBUTION`
--

INSERT INTO `CAR_ROLE_ATTRIBUTION` (`ROL_CODE`, `US_ID`) VALUES
('DIR', 2),
('DIV', 3),
('PIL', 4),
('SEC', 1);

-- --------------------------------------------------------

--
-- Structure de la table `CAR_USER`
--

CREATE TABLE `CAR_USER` (
  `US_ID` int(11) NOT NULL,
  `PRE_CODE` char(10) DEFAULT NULL,
  `US_PASSWORD` char(32) DEFAULT NULL,
  `US_NAME` char(32) DEFAULT NULL,
  `US_FIRST_NAME` char(32) DEFAULT NULL,
  `US_EMAIL` char(32) DEFAULT NULL,
  `US_ADDRESS` char(32) DEFAULT NULL,
  `US_POSTCODE` char(10) DEFAULT NULL,
  `US_TOWN` char(50) DEFAULT NULL,
  `US_SUB_DATE` date DEFAULT NULL,
  `US_SUB_TYPE` char(32) DEFAULT NULL,
  `US_LICENCE_ID` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAR_USER`
--

INSERT INTO `CAR_USER` (`US_ID`, `PRE_CODE`, `US_PASSWORD`, `US_NAME`, `US_FIRST_NAME`, `US_EMAIL`, `US_ADDRESS`, `US_POSTCODE`, `US_TOWN`, `US_SUB_DATE`, `US_SUB_TYPE`, `US_LICENCE_ID`) VALUES
(1, 'PB', 'securepassword', 'Doe', 'John', 'john.doe@gmail.com', '123 Dive Street', '12345', 'Dive Town', '2022-11-11', 'Adult', '98765'),
(2, 'PA', 'password123', 'Smith', 'Jane', 'jane.smith@gmail.com', '456 Ocean Avenue', '67890', 'Sea City', '2022-11-12', 'Adult', '12345'),
(3, 'PO-12m', 'pass1234', 'Williams', 'Peter', 'peter.williams@gmail.com', '789 Deep Road', '11223', 'Shark Town', '2022-01-11', 'Adult', '54321'),
(4, 'PE-20', 'secure123', 'Brown', 'Emily', 'emily.brown@gmail.com', '159 Sea Street', '54321', 'Ocean Town', '2022-10-11', 'Child', '23456'),
(5, 'PA-60-GP', 'password1234', 'Johnson', 'Robert', 'robert.johnson@gmail.com', '789 Ocean Avenue', '87654', 'Dive City', '2022-11-11', 'Adult', '34567');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CAR_BOAT`
--
ALTER TABLE `CAR_BOAT`
  ADD PRIMARY KEY (`BO_ID`);

--
-- Index pour la table `CAR_DIVING_GROUP`
--
ALTER TABLE `CAR_DIVING_GROUP`
  ADD PRIMARY KEY (`DS_CODE`,`DG_NUMBER`),
  ADD KEY `I_FK_CAR_DIVING_GROUP_CAR_DIVING_SESSION` (`DS_CODE`);

--
-- Index pour la table `CAR_DIVING_LOCATION`
--
ALTER TABLE `CAR_DIVING_LOCATION`
  ADD PRIMARY KEY (`DL_ID`);

--
-- Index pour la table `CAR_DIVING_SESSION`
--
ALTER TABLE `CAR_DIVING_SESSION`
  ADD PRIMARY KEY (`DS_CODE`),
  ADD KEY `I_FK_CAR_DIVING_SESSION_CAR_USER` (`US_ID`),
  ADD KEY `I_FK_CAR_DIVING_SESSION_CAR_DIVING_LOCATION` (`DL_ID`),
  ADD KEY `I_FK_CAR_DIVING_SESSION_CAR_BOAT` (`BO_ID`),
  ADD KEY `I_FK_CAR_DIVING_SESSION_CAR_USER1` (`US_ID_CAR_SECURE`),
  ADD KEY `I_FK_CAR_DIVING_SESSION_CAR_USER2` (`US_ID_CAR_DIRECT`);

--
-- Index pour la table `CAR_PREROGATIVE`
--
ALTER TABLE `CAR_PREROGATIVE`
  ADD PRIMARY KEY (`PRE_CODE`);

--
-- Index pour la table `CAR_REGISTRATION`
--
ALTER TABLE `CAR_REGISTRATION`
  ADD PRIMARY KEY (`US_ID`,`DS_CODE`),
  ADD KEY `I_FK_CAR_REGISTRATION_CAR_USER` (`US_ID`),
  ADD KEY `I_FK_CAR_REGISTRATION_CAR_DIVING_SESSION` (`DS_CODE`),
  ADD KEY `I_FK_CAR_REGISTRATION_CAR_DIVING_GROUP` (`DS_CODE`,`DG_NUMBER`);

--
-- Index pour la table `CAR_ROLE`
--
ALTER TABLE `CAR_ROLE`
  ADD PRIMARY KEY (`ROL_CODE`);

--
-- Index pour la table `CAR_ROLE_ATTRIBUTION`
--
ALTER TABLE `CAR_ROLE_ATTRIBUTION`
  ADD PRIMARY KEY (`ROL_CODE`,`US_ID`),
  ADD KEY `I_FK_CAR_ROLE_ATTRIBUTION_CAR_ROLE` (`ROL_CODE`),
  ADD KEY `I_FK_CAR_ROLE_ATTRIBUTION_CAR_USER` (`US_ID`);

--
-- Index pour la table `CAR_USER`
--
ALTER TABLE `CAR_USER`
  ADD PRIMARY KEY (`US_ID`),
  ADD KEY `I_FK_CAR_USER_CAR_PREROGATIVE` (`PRE_CODE`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `CAR_DIVING_GROUP`
--
ALTER TABLE `CAR_DIVING_GROUP`
  ADD CONSTRAINT `FK_CAR_DIVING_GROUP_CAR_DIVING_SESSION` FOREIGN KEY (`DS_CODE`) REFERENCES `CAR_DIVING_SESSION` (`DS_CODE`);

--
-- Contraintes pour la table `CAR_DIVING_SESSION`
--
ALTER TABLE `CAR_DIVING_SESSION`
  ADD CONSTRAINT `FK_CAR_DIVING_SESSION_CAR_BOAT` FOREIGN KEY (`BO_ID`) REFERENCES `CAR_BOAT` (`BO_ID`),
  ADD CONSTRAINT `FK_CAR_DIVING_SESSION_CAR_DIVING_LOCATION` FOREIGN KEY (`DL_ID`) REFERENCES `CAR_DIVING_LOCATION` (`DL_ID`),
  ADD CONSTRAINT `FK_CAR_DIVING_SESSION_CAR_USER` FOREIGN KEY (`US_ID`) REFERENCES `CAR_USER` (`US_ID`),
  ADD CONSTRAINT `FK_CAR_DIVING_SESSION_CAR_USER2` FOREIGN KEY (`US_ID_CAR_SECURE`) REFERENCES `CAR_USER` (`US_ID`),
  ADD CONSTRAINT `FK_CAR_DIVING_SESSION_CAR_USER3` FOREIGN KEY (`US_ID_CAR_DIRECT`) REFERENCES `CAR_USER` (`US_ID`);

--
-- Contraintes pour la table `CAR_REGISTRATION`
--
ALTER TABLE `CAR_REGISTRATION`
  ADD CONSTRAINT `FK_CAR_REGISTRATION_CAR_DIVING_GROUP` FOREIGN KEY (`DS_CODE`,`DG_NUMBER`) REFERENCES `CAR_DIVING_GROUP` (`DS_CODE`, `DG_NUMBER`),
  ADD CONSTRAINT `FK_CAR_REGISTRATION_CAR_DIVING_SESSION` FOREIGN KEY (`DS_CODE`) REFERENCES `CAR_DIVING_SESSION` (`DS_CODE`),
  ADD CONSTRAINT `FK_CAR_REGISTRATION_CAR_USER` FOREIGN KEY (`US_ID`) REFERENCES `CAR_USER` (`US_ID`);

--
-- Contraintes pour la table `CAR_ROLE_ATTRIBUTION`
--
ALTER TABLE `CAR_ROLE_ATTRIBUTION`
  ADD CONSTRAINT `FK_CAR_ROLE_ATTRIBUTION_CAR_ROLE` FOREIGN KEY (`ROL_CODE`) REFERENCES `CAR_ROLE` (`ROL_CODE`),
  ADD CONSTRAINT `FK_CAR_ROLE_ATTRIBUTION_CAR_USER` FOREIGN KEY (`US_ID`) REFERENCES `CAR_USER` (`US_ID`);

--
-- Contraintes pour la table `CAR_USER`
--
ALTER TABLE `CAR_USER`
  ADD CONSTRAINT `FK_CAR_USER_CAR_PREROGATIVE` FOREIGN KEY (`PRE_CODE`) REFERENCES `CAR_PREROGATIVE` (`PRE_CODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
