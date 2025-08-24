-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 04:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_stock_dclick`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom_article` varchar(50) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `date_fabrication` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `nom_article`, `id_categorie`, `quantite`, `prix_unitaire`, `date_fabrication`, `date_expiration`, `images`) VALUES
(1, 'HP', 1, 19, 200000, '2022-09-15 22:32:00', '2022-09-18 19:36:00', NULL),
(2, 'Imprimante scanner', 2, 11, 50000, '2022-09-09 20:41:00', '2022-10-02 19:47:00', NULL),
(3, 'Cable VGA', 3, 84, 1500, '2022-09-18 18:55:00', '2022-09-16 18:57:00', NULL),
(4, 'souris', 3, 151, 6000, '2022-09-16 19:58:00', '2022-09-16 19:02:00', NULL),
(5, 'Ecouteur', 3, 10, 1000, '2022-09-23 00:26:00', '2022-09-23 20:33:00', NULL),
(6, 'Chargeur', 3, 80, 500, '2022-09-23 22:27:00', '2022-09-23 01:27:00', NULL),
(7, 'HP 15', 1, 7, 7888, '2023-03-04 18:13:00', '2023-03-04 18:13:00', NULL),
(8, 'Télécommande', 3, 10, 1000, '2023-03-03 18:35:00', '2023-04-09 18:35:00', '../public/images/WhatsApp Image 2023-01-23 at 12.57.19.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_article`
--

CREATE TABLE `categorie_article` (
  `id` int(11) NOT NULL,
  `libelle_categorie` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie_article`
--

INSERT INTO `categorie_article` (`id`, `libelle_categorie`) VALUES
(1, 'Ordinateur'),
(2, 'Imprimante'),
(3, 'Accessoire');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'mili', 'ali', '+216 54789654', 'sousse'),
(2, 'ali', 'mouhamed', '+22758907514', 'monastir'),
(3, 'charrada', 'alaeddine', '55694703', 'Jemmal'),
(4, 'charrada', 'douaa', '55630789', 'jemmal'),
(5, 'nasri ', 'salah', '55987456', 'jemmel'),
(6, 'charrada', 'alaeddine', '55694703', 'سليم شرادة حي الياسمين-طريق الطيايرة');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `id_article`, `id_fournisseur`, `quantite`, `prix`, `date_commande`) VALUES
(1, 2, 2, 4, 200000, '2022-09-23 17:54:48'),
(2, 4, 1, 5, 30000, '2022-09-23 17:56:45'),
(3, 1, 2, 12, 2400000, '2022-09-23 19:23:07'),
(4, 4, 2, 56, 336000, '2022-09-24 10:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(2) NOT NULL,
  `prenom` varchar(3) NOT NULL,
  `email` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `adresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `prenom`, `telephone`, `adresse`) VALUES
(1, 'bakkouch', 'Issa', '21784596', 'france'),
(2, 'brahem', 'HASSAN', '21547126', 'belgium');

-- --------------------------------------------------------

--
-- Table structure for table `vente`
--

CREATE TABLE `vente` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_vente` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vente`
--

INSERT INTO `vente` (`id`, `id_article`, `id_client`, `quantite`, `prix`, `date_vente`, `etat`) VALUES
(3, 1, 2, 1, 200000, '2022-09-21 06:31:25', '0'),
(4, 2, 1, 5, 230000, '2022-09-21 06:35:14', '0'),
(5, 4, 1, 2, 12000, '2022-09-21 18:24:18', '0'),
(6, 3, 2, 6, 9000, '2022-09-23 19:24:12', '0'),
(7, 1, 2, 10, 2000000, '2022-09-23 19:25:08', '0'),
(8, 4, 1, 20, 120000, '2022-09-23 19:25:17', '0'),
(9, 5, 1, 5, 5000, '2022-09-23 19:31:02', '0'),
(10, 1, 1, 5, 1000000, '2022-09-23 19:48:16', '0'),
(11, 2, 2, 3, 150000, '2022-09-23 19:48:23', '0'),
(12, 5, 1, 2, 2000, '2022-09-23 19:48:29', '0'),
(13, 6, 1, 40, 20000, '2022-09-23 19:48:37', '0'),
(14, 4, 1, 15, 90000, '2022-09-23 19:48:46', '0'),
(15, 6, 2, 5, 2500, '2022-09-23 19:49:01', '0'),
(16, 3, 1, 13, 19500, '2022-09-23 19:49:07', '0'),
(17, 1, 2, 1, 200000, '2022-09-23 19:49:12', '0'),
(18, 4, 2, 3, 18000, '2022-09-23 19:49:20', '0'),
(19, 4, 2, 8, 48000, '2022-09-24 09:07:14', '0'),
(20, 2, 1, 3, 150000, '2022-09-24 10:23:57', '0'),
(21, 1, 2, 1, 200000, '2024-06-13 13:32:36', '0'),
(22, 2, 4, 1, 50000, '2024-06-19 17:50:38', '1'),
(23, 1, 2, 1, 200000, '2024-11-14 19:32:39', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Indexes for table `categorie_article`
--
ALTER TABLE `categorie_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_fournisseur` (`id_fournisseur`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categorie_article`
--
ALTER TABLE `categorie_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vente`
--
ALTER TABLE `vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id`);

--
-- Constraints for table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
