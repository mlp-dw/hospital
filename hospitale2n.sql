-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 23 fév. 2022 à 12:21
-- Version du serveur : 5.7.33
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hospitale2n`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `dateHour` datetime NOT NULL,
  `idPatients` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `dateHour`, `idPatients`) VALUES
(5, '2022-03-15 12:00:00', 2),
(6, '2022-01-29 12:06:00', 26);

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES
(2, 'ULLUSTE', 'Frederic 1er', '1996-12-20', '0641001008', 'fredericulluste@gmail.com'),
(6, 'BENALI', 'Riad', '1976-11-15', '0612457812', 'riad@gmail.com'),
(7, 'DEVEAUX', 'Sarah', '1987-04-12', '0321548721', 'sarah@gmail.com'),
(9, 'PERRIN', 'Miharu', '1996-04-04', '0612948197', 'mlp.dwwb@gmail.com'),
(10, 'BOURGEOIS', 'Marc', '2000-01-01', '0606060606', 'marc@gmail.com'),
(11, 'CONEN-CORBO', 'Xavier', '1985-02-15', '0612542565', 'xav@gmail.com'),
(12, 'D\'ANTONIO', 'Dylan', '1995-06-25', '0214759862', 'dylan@gmail.com'),
(13, 'GASPARI', 'Romain', '2004-08-31', '2157963214', 'romain@gmail.com'),
(14, 'GRILLO', 'Benjamin', '1985-02-28', '0614785426', 'benji@gmail.com'),
(15, 'LAMURE', 'Hugo', '1994-09-15', '0685214796', 'hugo@gmail.com'),
(16, 'MAURICE', 'Axel', '1997-05-05', '0712589632', 'axel@gmail.com'),
(17, 'PRINCE', 'Benjamin', '1995-11-15', '0725896412', 'prince@gmail.com'),
(18, 'THOMAS', 'Adrien', '2004-10-24', '0745269842', 'adrien@gmail.com'),
(19, 'DEBORD', 'Mathis', '2003-07-19', '0715963248', 'mathis@gmail.com'),
(20, 'KARFA', 'Hamza', '1996-12-29', '06 06 06 06 06 ', 'hamza@gmail.com'),
(21, 'SALAÜN', 'Étienne', '1991-05-22', '0612952110', 'nours@gmail.com'),
(26, 'VINSMOKE', 'Sanji', '2022-01-29', '0612948197', 'sanji@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_appointments_id_patients` (`idPatients`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_appointments_id_patients` FOREIGN KEY (`idPatients`) REFERENCES `patients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
