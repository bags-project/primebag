-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 19 déc. 2018 à 16:49
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `primebag`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `article_color_id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_picture1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_picture2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_picture3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `stock` int(11) NOT NULL,
  `matter` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double DEFAULT NULL,
  `showcase` tinyint(1) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `brand_id`, `article_color_id`, `name`, `poster`, `alt_picture1`, `alt_picture2`, `alt_picture3`, `price`, `reference`, `description`, `stock`, `matter`, `discount`, `showcase`, `tag_id`) VALUES
(1, 2, 8, 'Bols mary jackson capri', '19SAXP23_7019.jpg', '19SAXP23_7019alt1.jpg', '', '', 99, '19SAXP23', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 10, 'polyurethane / polyester', 0, 1, 1),
(2, 2, 8, 'Bols mexican cards loverty', '19SAXPDP.jpg', '19SAXPDPalt1.jpg', '19SAXPDPalt2.jpg', '', 69, '19SAXPDP', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 10, 'polyurethane / polyester', 0, NULL, NULL),
(3, 2, 4, 'Bols abby siberia', '19SAXPGF.jpg', '19SAXPGFalt1.jpg', '19SAXPGFalt2.jpg', '19SAXPGFalt3.jpg', 69, '19SAXPGF', 'Extérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 1, 'polyurethane / polyester', NULL, 1, 3),
(4, 2, 8, 'Bols poppy flower', '19SAXFBB.jpg', '19SAXFBBalt1.jpg', '19SAXFBBalt2.jpg', '19SAXFBBalt3.jpg', 69, '19SAXFBB', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 20, 'polyurethane / polyester', 0, NULL, NULL),
(5, 2, 3, 'Bols summer caribou gela', '19SAXP84.jpg', '19SAXP84alt1.jpg', '19SAXP84alt2.jpg', '19SAXP84alt3.jpg', 69, '19SAXP84', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 20, 'polyurethane / polyester', 0, NULL, NULL),
(6, 2, 3, 'Bols summer caribou lima', '19SAXPE3.jpg', '19SAXPE3alt1.jpg', '19SAXPE3alt2.jpg', '19SAXPE3alt3.jpg', 79, '19SAXPE3', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 3, 'polyurethane / polyester', NULL, NULL, NULL),
(7, 2, 6, 'Bols chandy durban', '19SAXPB2.jpg', '19SAXPB2alt1.jpg', '19SAXPB2alt2.jpg', '19SAXPB2alt3.jpg', 59, '19SAXPB2', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 8, 'polyurethane / polyester', NULL, NULL, NULL),
(8, 2, 8, 'Bols alanis rotterdam', '19SAXF94.jpg', '19SAXF94alt1.jpg', '19SAXF94alt2.jpg', '19SAXF94alt3.jpg', 79, '19SAXF94', 'Sac reversible\r\nComposition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 2, 'polyurethane / polyester', NULL, 1, 3),
(9, 2, 4, 'Bols aliki espot', '19SAXF66.jpg', '19SAXF66alt1.jpg', '19SAXF66alt2.jpg', '19SAXF66alt3.jpg', 49, '19SAXF66', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 4, 'polyurethane / polyester', NULL, 1, 1),
(10, 2, 4, 'Bols chelsea florida', '19SAXFAB.jpg', '19SAXFABalt1.jpg', '19SAXFABalt2.jpg', '19SAXFABalt3.jpg', 79, '19SAXFAB', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 6, 'polyurethane / polyester', NULL, 1, 3),
(11, 2, 6, 'Bols hercules kiev mini', '19SAXPCO.jpg', '19SAXPCOalt1.jpg', '19SAXPCOalt2.jpg', '19SAXPCOalt3.jpg', 69, '19SAXPCO', 'Composition\r\nExtérieur : 100% polyurethane\r\nIntérieur : 100% polyester', 4, 'polyurethane / polyester', NULL, NULL, NULL),
(12, 5, 9, 'Padded Pak\'r Crushed Grey', 'EK62085T.jpg', 'EK62085Talt1.jpg', 'EK62085Talt2.jpg', 'EK62085Talt3.jpg', 57, 'EK62085T', 'Notre sac à dos classique : conçu pour le confort, pensé pour le style.\r\nDisponible dans le coloris élégant Crushed Grey.\r\n100% velours écrasé véritable, devenez le centre de l\'attention.\r\nNotre emblématique Padded Pak\'r, connu dans le monde entier.\r\nLe compartiment principal dispose d\'une fermeture à glissière pour garder vos affaires en toute sécurité.\r\n\r\nHauteur: 40 cm\r\nLargeur: 30 cm\r\nProfondeur: 18 cm\r\nVolume: 24 Litre\r\nPoids: 380 g\r\nGarantie: 2 ans\r\nMatériel: Polyester', 1, 'Polyester', NULL, 1, 3),
(13, 5, 7, 'Padded Pak\'r Monomel', 'K62060T.jpg', 'K62060Talt1.jpg', 'K62060Talt2.jpg', 'K62060Talt3.jpg', 50, 'K62060T', 'Notre sac à dos classique : conçu pour le confort, pensé pour le style.\r\nDisponible dans le coloris élégant Crushed Grey.\r\n100% velours écrasé véritable, devenez le centre de l\'attention.\r\nNotre emblématique Padded Pak\'r, connu dans le monde entier.\r\nLe compartiment principal dispose d\'une fermeture à glissière pour garder vos affaires en toute sécurité.\r\n\r\nHauteur: 40 cm\r\nLargeur: 30 cm\r\nProfondeur: 18 cm\r\nVolume: 24 Litre\r\nPoids: 380 g\r\nGarantie: 2 ans\r\nMatériel: Polyester', 4, 'Polyester', NULL, NULL, NULL),
(14, 5, 8, 'Padded Pak\'r Pink Ray', 'EK62099P.jpg', 'EK62099Palt1.jpg', 'EK62099Palt2.jpg', 'EK62099Palt3.jpg', 50, 'EA251H082', 'Notre sac à dos classique : conçu pour le confort, pensé pour le style.\r\nDisponible dans le coloris élégant Crushed Grey.\r\n100% velours écrasé véritable, devenez le centre de l\'attention.\r\nNotre emblématique Padded Pak\'r, connu dans le monde entier.\r\nLe compartiment principal dispose d\'une fermeture à glissière pour garder vos affaires en toute sécurité.\r\n\r\nHauteur: 40 cm\r\nLargeur: 30 cm\r\nProfondeur: 18 cm\r\nVolume: 24 Litre\r\nPoids: 380 g\r\nGarantie: 2 ans\r\nMatériel: Polyester', 3, 'Polyester', NULL, 1, 1),
(15, 5, 7, 'Provider Bike Blue', 'EK52043V.jpg', 'EK52043Valt1.jpg', 'EK52043Valt2.jpg', 'EK52043Valt3.jpg', 96, 'EK52043V', 'Double compartiment avec une housse rembourrée pour ordinateur jusqu\'à 15 pouces.\r\nHauteur : 44 cm, Largeur : 31 cm, Profondeur : 25 cm.\r\nTissu 100% nylon très résistant.\r\nPoignée trolley et base renforcée pour transporter vos livres.\r\nDos matelassé et bretelles ergonomiques pour plus de confort.', 2, 'Nylon', NULL, 1, 1),
(16, 5, 9, 'Floid Corlange Grey', 'EK20182M.jpg', 'EK20182Malt1.jpg', 'EK20182Malt2.jpg', 'EK20182Malt3.jpg', 72, 'EK20182M', 'Compartiment principal avec grande housse rembourrée pour accueillir un ordinateur de 4 x 26 cm de dimensions.\r\nDesign ergonomique et brides renforcées pour un sac confortable à porter.\r\nDos matelassé avec poches de sécurité pour un voyage confortable en toute sécurité.\r\nSangle de poitrine pour un porté plus confortable.\r\nPoches multiusage zippées pour emporter des petits objets.\r\nUn porte-clés pour toujours garder vos clés à portée de main.\r\nPoche latérale pour bouteille avec fermeture zippée facile.', 3, 'Polyester', NULL, 1, 2),
(18, 5, 4, 'Trans4 S Leaves Black', 'EK80L45T.jpg', 'EK80L45Talt1.jpg', 'EK80L45Talt2.jpg', 'EK80L45Talt3.jpg', 154, 'EK80L45T', 'Disponible dans l\'imprimé d\'inspiration hawaïenne Leaves Black.\r\nLe compartiment principal dispose d\'une fermeture éclair pour y ranger vos affaires en toute sécurité.\r\nDeux compartiments intérieurs zippés avec des sangles qui vous assurent de toujours tout retrouver bien à sa place.\r\nLes sangles de compression sont utiles pour ajuster le volume du sac selon vos besoins.\r\nLa poignée télescopique et les roulettes facilitent vos déplacements.', 1, 'Polyester', NULL, NULL, NULL),
(19, 5, 4, 'Tranverz M Opgrade Dark', 'EK62L45P.jpg', 'EK62L45Palt1.jpg', 'EK62L45Palt2.jpg', 'EK62L45Palt3.jpg', 172, 'EK62L45P', 'Large double compartiment avec un cadenas TSA intégré et une poche frontale zippée.\r\nHauteur : 67 cm, Largeur : 35,5 cm, Profondeur : 30 cm.\r\nFabriqué à partir de tissu polyester imitant la fibre naturelle dans un coloris Opgrade Dark.\r\nValise style trolley avec des poignées rembourrées antidérapantes et des roulettes lisses.\r\nRangez-le à plat lorsque vous ne l\'utilisez pas.', 2, 'Polyester', NULL, 1, 1),
(20, 5, 7, 'Tranzshell S Planet Blue', 'EK73F42U.jpg', 'EK73F42Ualt1.jpg', 'EK73F42Ualt2.jpg', 'EK73F42Ualt3.jpg', 190, 'EK73F42U', 'Deux compartiments intérieurs zippés avec des sangles pour maintenir vos affaires en place.\r\nHauteur : 54 cm, Largeur : 39 cm, Profondeur : 20 cm.\r\nFabriqué à partir d\'une mousse et d\'un tissu hybride innovants pour garder vos affaires en sécurité.\r\nUn système de roulettes à 360° facilite les déplacements.\r\nConçu pour faciliter vos déplacements grâce à ses poignées ergonomiques et son design autoporteur.', 3, 'Polyester', NULL, 1, 1),
(21, 5, 6, 'Tranverz S Blakout Stop', 'EK61L53V.jpg', 'EK61L53Valt1.jpg', 'EK61L53Valt2.jpg', 'EK61L53Valt3.jpg', 132, 'EK61L53', 'Double compartiment compact mais spacieux avec un cadenas TSA intégré.\r\nHauteur : 51 cm, Largeur : 32,5 cm, Profondeur : 24 cm.\r\nFabrication 100% polyester avec des bordures contrastantes bleu foncé.\r\nValise style trolley avec une poignée télescopique et un système de roues lisses.\r\nFacile à transporter, se range à plat lorsque vous ne l\'utilisez pas.', 1, 'Polyester', NULL, 1, 3),
(22, 3, 4, 'Sacoche plate Men\'s Classic en petit piq', 'NH2342HC.jpg', 'NH2342HCalt1.jpg', 'NH2342HCalt2.jpg', 'NH2342HCalt3.jpg', 105, 'NH2342HC', 'Un format plat ultra pratique pour cette sacoche réalisée en piqué et dotée de nombreuses poches. Cet accessoire élégant accueille vos essentiels au quotidien.\r\n\r\nExtérieur 1 poche intérieur 3 poches dont 1 zippée.\r\nBandoulière ajustable.\r\nCrocodile métal ton sur ton.\r\nDimensions 24,5 x 28 x 3 cm.\r\nExtérieur PVC petit piqué.\r\nExtérieur : Pvc (100%).', 3, 'PVC', NULL, NULL, NULL),
(23, 3, 4, 'Sacoche plate zippée Concept petit piqué', 'NH2715PO.jpg', 'NH2715POalt1.jpg', 'NH2715POalt2.jpg', 'NH2715POalt3.jpg', 65, 'NH2715PO', 'Cette sacoche réalisée en toile piquée monochrome est dotée d\'une bandoulière ajustable et d\'un format généreux. Un modèle résolument tendance, pensé pour le quotidien des hommes pressés.\r\n\r\nExtérieur 2 poches dont 1 zippée et intérieur 2 poches dont 1 zippée.\r\nBandoulière ajustable.\r\nCrocodile silicone ton sur ton avec contours contrastés.\r\nDimensions 15,5 x 20,5 x 2,5 cm.\r\nExtérieur PVC petit piqué.\r\nExtérieur : Pvc (100%).\r\n', 5, 'PVC', NULL, 1, 3),
(25, 4, 4, 'Cosmolite Valise 4 roues 55cm', '115312-2878.jpg', '115312-2878alt1.jpg', '115312-2878alt2.jpg', '115312-2878alt3.jpg', 405, '115312-2878.jpg', 'Fabriquée en matériau Curv : extrêmement résistante et incroyablement légère.\r\nGarantie 10 ans internationale.\r\nFermeture à combinaison TSA pour voyager en toute sécurité.\r\nLa valise iconique de la marque Samsonite.\r\nBagage cabine compatible avec les conditions Ryanair (dimensions max : 55x40x20 cm) et Easyjet (56x45x25 cm).', 6, 'Curv', NULL, 1, 3),
(27, 1, 4, 'Lancaster Grand cartable 2 soufflets Noi', '310-06.jpg', '310-06alt1.jpg', '310-06alt2.jpg', '310-06alt3.jpg', 239, '310-06', 'Ligne : Mathias\r\n\r\n    - Grand sac cartable\r\n    - Fermeture à rabat, à rabat avec fermoir, avec fermoir\r\n    - Matière : Refente de cuir de vachette finition grainée\r\n    - Doublure synthétique\r\n    - Finitions métal argenté brillant\r\n\r\nDimensions : 40.00 cm (L) x 30.00 cm (H) x 12.00 cm (l)\r\n\r\nDimensions des anses : 7.00 cm\r\n\r\nDimensions de la bandoulière : 78.00 / 130.00 cm', 5, 'Cuir', NULL, NULL, NULL),
(28, 3, 3, 'Cuir Business', 'XABEF23B.jpg', 'XABEF23Balt1.jpg', 'XABEF23Balt2.jpg', NULL, 150, 'XABEF23B', 'compatible système trolley\r\nfermeture éclair bidirectionnelle\r\ndeux anses en cuir (anse flèche 10 cm)\r\nune amovible, rembourré, réglable bandoulière (Longueur env. 60-120 cm)\r\nmétal argenté\r\nporté sur l\'épaule', 25, 'Cuir', NULL, 1, 2),
(30, 3, 4, 'Sac Chantaco en cuir piqué mat', 'XAB203EF.jpg', 'XAB203EFalt1.jpg', 'XAB203EFalt2.jpg', NULL, 180, 'XAB203EF', 'Intérieur 1 poche ordinateur, 1 poche et 2 poches zippées\r\nBandoulière ajustable\r\nCrocodile métal ton sur ton\r\nDimensions 39 x 27 x 7,5 cm\r\nExtérieur refente de cuir italien\r\nExtérieur : Refente de cuir vachette (100%)', 15, 'Cuir', NULL, 1, 1),
(31, 6, 9, 'Sac croisé porté GM', 'EKX210Z.jpg', 'EKX210Zalt1.jpg', 'EKX210Zalt2.jpg', NULL, 160, 'EKX210Z', 'Type de fermeture : Zippée, Rabat\r\nBandoulière ajustable\r\nUn compartiment principal\r\nTrois poches sous le rabat , Une poche frontale zippée sur le rabat, ', 10, 'Tissus', NULL, 1, 2),
(32, 6, 7, 'Sacs  Highway Hedgren', 'XEM222TR.jpg', 'XEM222TRalt1.jpg', 'XEM222TRalt2.jpg', 'XEM222TRalt3.jpg', 120, 'XEM222T', 'Compartiment principal dispose d\'une fermeture à glissière\r\n\r\nHauteur: 40 cm\r\nLargeur: 30 cm\r\nProfondeur: 18 cm\r\nVolume: 24 Litre\r\nPoids: 380 g\r\nGarantie: 2 ans\r\nMatériel: Polyester', 10, 'Polyester', NULL, NULL, NULL),
(33, 6, 3, 'Porte Documents Haskell', 'XAF222BF.jpg', 'XAF222BFalt1.jpg', 'XAF222BFalt2.jpg', NULL, 150, 'XAF222BF', 'Compatibilité: Ordinateur portable de 15 pouces\r\nMatière Extérieure: Cuir\r\nDétails intérieurs: 1 compartiment rembourré pour ordinateur portable\r\nplaquées, 1 poche zippée et 4 passants élastiques\r\nDimensions: 41 cm (L) x 8 cm (l) x 31,1 cm (H)\r\nPoignées/Sangles: 2 poignées et 1 bandoulière portée croisé ', 20, 'Cuir', NULL, 0, NULL),
(34, 6, 3, 'Sac bandoulière droit', 'XEF213AT.jpg', 'XEF213ATalt1.jpg', 'XEF213ATalt2.jpg', NULL, 130, 'XEF213AT', 'Besace - Marron\r\nToile\r\nType de fermeture : Zippée, Rabat\r\nBandoulière ajustable\r\nUn compartiment principal\r\nTrois poches sous le rabat ', 10, 'Cuir', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 2),
(23, 2),
(25, 4),
(27, 2),
(28, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2);

-- --------------------------------------------------------

--
-- Structure de la table `article_color`
--

CREATE TABLE `article_color` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_color`
--

INSERT INTO `article_color` (`id`, `name`) VALUES
(3, 'Camel'),
(4, 'Noir'),
(5, 'Blanc'),
(6, 'Rouge'),
(7, 'Bleu'),
(8, 'Multi'),
(9, 'Gris');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `name`, `description`) VALUES
(1, 'Lancaster', 'Lancaster est une marque de maroquinerie française. Fondée en plein cœur de Paris au cours des années 1990, elle s’est développée sur l’ensemble de la France et aujourd’hui jusqu’à l’international. Les figures qui l’incarnent, notamment la directrice artistique, sont toujours les mêmes depuis sa création.'),
(2, 'Desigual', 'À chaque saison, la marque lance une collection basée sur un thème différent. Depuis la collection hiver 2011-2012, il existe également une ligne dessinée par le couturier français Christian Lacroix et intitulée « Desigual by Lacroix »'),
(3, 'Lacoste', 'Entre amour du jeu, passion de l\'innovation et élégance française. Depuis 1933, l\'histoire de la marque symbolise celle de son fondateur René Lacoste, légende du tennis français qui a révolutionné les vestiaires.'),
(4, 'Samsonite', 'Samsonite est une marque créée en 1910 quand Jess Shwayder fonda une fabrique de valises à Denver, Colorado, aux États-Unis. Le nom de la marque s\'inspire du personnage biblique Samson. Elle est le numéro 1 mondial des bagages et réalise en France en 2009 un chiffre d\'affaires de 40 millions d\'euros (soit 5 % de son CA mondial) contre 30 millions d\'euros pour son concurrent direct Delsey (25 % de son CA).'),
(5, 'Eastpak', 'Eastpak est une marque créée à Boston, États-Unis, spécialisée dans le design, la conception, la fabrication, la mercatique et la distribution à l\'échelle mondiale de produits parmi lesquels on trouve sacs, sac à dos, équipement de voyage et accessoires.'),
(6, 'Fossil', 'Fossil est une marque américaine de montres et d\'accessoires de mode inspirée par le style vintage ');

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `phone_number`, `email`) VALUES
(1, 'LaPoste', '3631', 'clientpro@laposte.net'),
(2, 'Magasin', '0669696996', 'primebag62@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `poster`) VALUES
(1, 'Femme', 'Sacs femme : faites vous plaisir en jouant avec les tendances grâce à nos sélections de sacs femme ! Des marques de luxe à la mode urbaine, trouvez votre bonheur sur Primebag !', 'http://placehold.it/350x150'),
(2, 'Homme', 'Sacs homme : faites vous plaisir en jouant avec les tendances grâce à nos sélections de sacs homme ! Des marques de luxe à la mode urbaine, trouvez votre style sur Primebag !', 'http://placehold.it/350x150'),
(3, 'Scolaire', 'Sacs à dos tendance pour toutes les activités, découvrez toutes les collections de sacs scolaires sur notre site Primebag.', 'http://placehold.it/350x150'),
(4, 'Bagage', 'Entrez dans l\'Univers La Bagagerie et découvrez toutes les dernières Collections de Bagages. Que vous voyagiez en train, en avion ou en voiture, nos bagages  rendront votre voyage plus facile.', 'http://placehold.it/350x150');

-- --------------------------------------------------------

--
-- Structure de la table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `carrier_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `order_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_reference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `tracking_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer_order`
--

INSERT INTO `customer_order` (`id`, `payment_method_id`, `user_id`, `order_status_id`, `carrier_id`, `created_at`, `order_number`, `payment_date`, `payment_reference`, `sent_at`, `shipping_cost`, `tracking_number`) VALUES
(1, 2, 1, 5, 1, '2018-12-19 00:00:00', 'REF2', '2018-12-19 00:00:00', 'REF2', '2018-12-19 00:00:00', 10, 'REF2');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181211110922'),
('20181214131121'),
('20181215201024'),
('20181217133217'),
('20181217162139'),
('20181219133909'),
('20181219143552');

-- --------------------------------------------------------

--
-- Structure de la table `order_content`
--

CREATE TABLE `order_content` (
  `order_ref_id` int(11) NOT NULL,
  `article_ref_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `exclusive_of_taxes` double NOT NULL,
  `inclusive_of_taxes` double NOT NULL,
  `taxe` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_content`
--

INSERT INTO `order_content` (`order_ref_id`, `article_ref_id`, `quantity`, `exclusive_of_taxes`, `inclusive_of_taxes`, `taxe`) VALUES
(1, 3, 4, 15, 18, 0.2),
(1, 8, 1, 18, 22, 0.2);

-- --------------------------------------------------------

--
-- Structure de la table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `icon`) VALUES
(5, 'Attente-traitement', 'attente de traitement'),
(6, 'Preparation', 'preparation'),
(7, 'Préparé', 'preparé'),
(8, 'Livré', 'livré');

-- --------------------------------------------------------

--
-- Structure de la table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(2, 'Visa');

-- --------------------------------------------------------

--
-- Structure de la table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`, `carrier_id`) VALUES
(8, 'Retrait magasin', 2),
(9, 'Colissimo', 1),
(10, 'ChronoPost', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `icon`) VALUES
(1, 'Tendance', 'mode'),
(2, 'Nouvelle gamme', 'new'),
(3, 'Fin de série', 'serie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_address` longtext COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `address`, `secondary_address`, `phone_number`, `email`, `password`, `city`, `zip_code`, `country_name`, `country_code`, `roles`, `reset_token`) VALUES
(1, 'haiou', 'king', '20 rue erftg', NULL, NULL, '1234@1234.fr', '$2y$13$0budA9b0KH0dVSAdVBg7P.WfAkawQjk8Rbgw/thx8iZmVpNdywTvO', 'Lille', '59000', 'France', 'ISO 3166-2:FR', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', NULL),
(9, 'toto', 'toto', '37 rue du parc', NULL, NULL, 'toto@gmail.com', '$2y$13$KL635Z66.TtYQtk.tEF/TOsCS3g92b67zUSPQxrny8ihQBv1Hgvtq', 'Forest-sur-Marque', '59510', 'France', 'ISO 3166-2:FR', 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL),
(10, 'toto2', 'toto2', '37 rue du parc', NULL, NULL, 'toto3@gmail.com', '$2y$13$nVk9jpZ7N1gte/Fbcwmd..wQJEVbVySpRAT4mbYY1x08Fnp5u.GTO', 'Hem', '59510', 'France', 'ISO 3166-2:FR', 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL),
(11, 'toto3', 'toto3', '37 rue du parc', NULL, NULL, 'toto70@gmail.com', '$2y$13$Fs0oDmyLT4XTVjLuxUJhOe7NEGRsUFfLSOluFGbeEREXJDMvzRNiW', 'Dainville', '62000', 'France', 'ISO 3166-2:FR', 'a:1:{i:0;s:9:\"ROLE_USER\";}', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6644F5D008` (`brand_id`),
  ADD KEY `IDX_23A0E662F32EBDE` (`article_color_id`),
  ADD KEY `IDX_23A0E66BAD26311` (`tag_id`);

--
-- Index pour la table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`),
  ADD KEY `IDX_53A4EDAA7294869C` (`article_id`),
  ADD KEY `IDX_53A4EDAA12469DE2` (`category_id`);

--
-- Index pour la table `article_color`
--
ALTER TABLE `article_color`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3B1CE6A35AA1164F` (`payment_method_id`),
  ADD KEY `IDX_3B1CE6A3A76ED395` (`user_id`),
  ADD KEY `IDX_3B1CE6A3D7707B45` (`order_status_id`),
  ADD KEY `IDX_3B1CE6A321DFC797` (`carrier_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`order_ref_id`,`article_ref_id`),
  ADD KEY `IDX_8BF99E2E238517C` (`order_ref_id`),
  ADD KEY `IDX_8BF99E24B70D629` (`article_ref_id`);

--
-- Index pour la table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7503FF2F21DFC797` (`carrier_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `article_color`
--
ALTER TABLE `article_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E662F32EBDE` FOREIGN KEY (`article_color_id`) REFERENCES `article_color` (`id`),
  ADD CONSTRAINT `FK_23A0E6644F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `FK_23A0E66BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `FK_53A4EDAA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_53A4EDAA7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `FK_3B1CE6A321DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carrier` (`id`),
  ADD CONSTRAINT `FK_3B1CE6A35AA1164F` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `FK_3B1CE6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3B1CE6A3D7707B45` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`);

--
-- Contraintes pour la table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `FK_8BF99E24B70D629` FOREIGN KEY (`article_ref_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_8BF99E2E238517C` FOREIGN KEY (`order_ref_id`) REFERENCES `customer_order` (`id`);

--
-- Contraintes pour la table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD CONSTRAINT `FK_7503FF2F21DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carrier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
