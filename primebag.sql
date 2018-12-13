-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 11 déc. 2018 à 15:53
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
  `discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `brand_id`, `article_color_id`, `name`, `poster`, `alt_picture1`, `alt_picture2`, `alt_picture3`, `price`, `reference`, `description`, `stock`, `matter`, `discount`) VALUES
(1, 1, 5, 'SAC TROTTEUR À RABAT', 'sac1.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 50, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 10, 'Cuir', 0),
(2, 1, 5, 'BEAU SAC', 'sac2.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 150, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 10, 'Cuir', 0),
(3, 2, 2, 'SAC QUIL EST BEAU', 'sac3.jpg', 'sac3_m.jpg', 'sac3_m.jpg', 'sac3_m.jpg', 200, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 0, 'Tissu', 0),
(4, 4, 7, 'SAC PRATIQUE', 'sac1.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 200, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Cuir', 0),
(5, 2, 5, 'THE SAC', 'sac2.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 150, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Cuir', 0),
(7, 2, 5, 'SAC A MAIN', 'sac2.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 150, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Cuir', 0),
(8, 3, 7, 'SAC DELUXE', 'sac3.jpg', 'sac3_m.jpg', 'sac3_m.jpg', 'sac3_m.jpg', 250, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Tissus', 0),
(9, 2, 7, 'SAC PRATIQUE', 'sac1.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 200, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 40, 'Tissus', 0),
(10, 3, 7, 'SAC DESIGNE', 'sac2.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 250, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 50, 'Cuir', 0),
(11, 2, 7, 'SAC TAS VU', 'sac1.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 'sac1_m.jpg', 200, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Cuir', 0),
(12, 1, 4, 'SAC PRATIQUE', 'sac2.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 'sac2_m.jpg', 300, 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 20, 'Cuir', 0);

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Amethyste'),
(2, 'Bordeaux'),
(3, 'Camel'),
(4, 'Noir'),
(5, 'Blanc'),
(6, 'Rouge'),
(7, 'Bleu');

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
(1, 'Lancaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras condimentum arcu dui, a rhoncus est molestie ornare. Aliquam iaculis magna lorem, nec ultrices quam blandit eu. Pellentesque pharetra, magna vel porttitor ultrices, augue diam gravida quam, eget consectetur mi turpis in est. Pellentesque consequat, ex id dapibus efficitur, quam dui blandit dolor, non lacinia sapien ipsum id turpis. Etiam et est quis quam viverra laoreet in nec augue. Aliquam euismod, orci non efficitur pulvinar, velit erat aliquet diam, a mattis lectus mi vel quam. Etiam porttitor nisi nec odio suscipit, non malesuada ipsum pulvinar. Vestibulum laoreet tempor elementum. Sed varius congue diam, ac sagittis mi venenatis facilisis.'),
(2, 'Nafnaf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras condimentum arcu dui, a rhoncus est molestie ornare. Aliquam iaculis magna lorem, nec ultrices quam blandit eu. Pellentesque pharetra, magna vel porttitor ultrices, augue diam gravida quam, eget consectetur mi turpis in est. Pellentesque consequat, ex id dapibus efficitur, quam dui blandit dolor, non lacinia sapien ipsum id turpis. Etiam et est quis quam viverra laoreet in nec augue. Aliquam euismod, orci non efficitur pulvinar, velit erat aliquet diam, a mattis lectus mi vel quam. Etiam porttitor nisi nec odio suscipit, non malesuada ipsum pulvinar. Vestibulum laoreet tempor elementum. Sed varius congue diam, ac sagittis mi venenatis facilisis.'),
(3, 'Lacoste', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras condimentum arcu dui, a rhoncus est molestie ornare. Aliquam iaculis magna lorem, nec ultrices quam blandit eu. Pellentesque pharetra, magna vel porttitor ultrices, augue diam gravida quam, eget consectetur mi turpis in est. Pellentesque consequat, ex id dapibus efficitur, quam dui blandit dolor, non lacinia sapien ipsum id turpis. Etiam et est quis quam viverra laoreet in nec augue. Aliquam euismod, orci non efficitur pulvinar, velit erat aliquet diam, a mattis lectus mi vel quam. Etiam porttitor nisi nec odio suscipit, non malesuada ipsum pulvinar. Vestibulum laoreet tempor elementum. Sed varius congue diam, ac sagittis mi venenatis facilisis.'),
(4, 'Sansonite', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras condimentum arcu dui, a rhoncus est molestie ornare. Aliquam iaculis magna lorem, nec ultrices quam blandit eu. Pellentesque pharetra, magna vel porttitor ultrices, augue diam gravida quam, eget consectetur mi turpis in est. Pellentesque consequat, ex id dapibus efficitur, quam dui blandit dolor, non lacinia sapien ipsum id turpis. Etiam et est quis quam viverra laoreet in nec augue. Aliquam euismod, orci non efficitur pulvinar, velit erat aliquet diam, a mattis lectus mi vel quam. Etiam porttitor nisi nec odio suscipit, non malesuada ipsum pulvinar. Vestibulum laoreet tempor elementum. Sed varius congue diam, ac sagittis mi venenatis facilisis.');

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
(1, 'Femme', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer congue ut nibh ac blandit. Maecenas blandit enim et elit porttitor euismod. Donec vel leo a libero egestas pellentesque at id nisi. Curabitur at massa efficitur, porta justo a, egestas dui. In ex massa, tincidunt ut ex a, vehicula scelerisque augue. Praesent ultricies laoreet ligula, id aliquet ante luctus vel. Nam ornare tellus et justo fringilla feugiat. Nullam in euismod urna, id vulputate nisl. Donec quis imperdiet odio. Maecenas rhoncus diam augue, in cursus lacus ultrices in. Etiam malesuada finibus malesuada. Suspendisse purus arcu, hendrerit nec est sodales, laoreet accumsan justo. Donec et sodales ante. Nullam mauris est, varius at quam ac, cursus lacinia nulla. Aenean eleifend arcu et bibendum mollis. Nulla gravida dolor mauris, vel ultricies massa bibendum eget.', 'http://placehold.it/350x150'),
(2, 'Homme', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. ', 'http://placehold.it/350x150'),
(3, 'Scolaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'http://placehold.it/350x150'),
(4, 'Bagages', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere tempus felis vitae feugiat. Aliquam erat volutpat. Donec mollis lacus sit amet tellus eleifend finibus. Praesent nec commodo leo. Etiam sit amet laoreet magna. Ut auctor tristique erat in vestibulum. Nunc enim nisl, interdum eget fringilla eget, malesuada vitae enim. Nunc et placerat felis, in eleifend leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris tempor mi magna, quis placerat nulla elementum et. Aliquam et urna sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut at tincidunt neque. Nunc eget imperdiet metus. Ut sit amet nisl non ligula mollis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'http://placehold.it/350x150');

-- --------------------------------------------------------

--
-- Structure de la table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_ref_id` int(11) NOT NULL,
  `carrier_id` int(11) NOT NULL,
  `sent_at` datetime NOT NULL,
  `shipping_cost` double DEFAULT NULL,
  `tracking_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('20181211110922');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `order_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_reference` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6644F5D008` (`brand_id`),
  ADD KEY `IDX_23A0E662F32EBDE` (`article_color_id`);

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
-- Index pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3781EC10E238517C` (`order_ref_id`),
  ADD KEY `IDX_3781EC1021DFC797` (`carrier_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F52993985AA1164F` (`payment_method_id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`),
  ADD KEY `IDX_F5299398D7707B45` (`order_status_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `article_color`
--
ALTER TABLE `article_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E662F32EBDE` FOREIGN KEY (`article_color_id`) REFERENCES `article_color` (`id`),
  ADD CONSTRAINT `FK_23A0E6644F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Contraintes pour la table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `FK_53A4EDAA12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_53A4EDAA7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `FK_3781EC1021DFC797` FOREIGN KEY (`carrier_id`) REFERENCES `carrier` (`id`),
  ADD CONSTRAINT `FK_3781EC10E238517C` FOREIGN KEY (`order_ref_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993985AA1164F` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F5299398D7707B45` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`);

--
-- Contraintes pour la table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `FK_8BF99E24B70D629` FOREIGN KEY (`article_ref_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_8BF99E2E238517C` FOREIGN KEY (`order_ref_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
