-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 نوفمبر 2019 الساعة 16:22
-- إصدار الخادم: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `big_step3`
--

-- --------------------------------------------------------

--
-- بنية الجدول `artist_entity`
--

CREATE TABLE `artist_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `story` longtext COLLATE utf8mb4_unicode_ci,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `updated_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `facebook` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `artist_entity`
--

INSERT INTO `artist_entity` (`id`, `name`, `nationality`, `residence`, `birth_date`, `story`, `details`, `created_by`, `create_date`, `updated_by`, `update_date`, `facebook`, `twitter`, `linkedin`, `instagram`, `active`) VALUES
(1, 'Douaa', 'Syrian', 'Syria', '2015-10-06', 'big', NULL, NULL, NULL, NULL, NULL, 'facebook', NULL, NULL, NULL, 1),
(2, 'Bashar Barazi', 'syrian', 'syria', '1965-05-05', 'A Syrian artist who graduated in 1986 from Arts Faculty, Sculpture Department. For personal reasons, he didn’t work as a sculptor until ten years later in 1996.\nThroughout the years, Bashar has become an experienced sculptor. Mastering his work made him a famous Syrian sculptor. \nUnfortunately, Barazi stopped working when the war started in Aleppo in 2015. His workshop destruction and dim sightedness made the situation even worse. Due to such circumstances, he was forced to stay away from the sculpture.\nHowever, he never wanted to surrender to his bad conditions. He started drawing amazing paintings by feather. In addition to his success as a sculptor, his career as a painter made him another success.\n', 'Fine Art', NULL, NULL, NULL, NULL, 'Bashar', 'Bashar', 'Bashar', 'Bashar', NULL),
(3, 'Buthina Orabi', 'syrian', 'syria', '1985-06-06', 'A Syrian artist who was  born in Damascus. Her innate formative art has transformed her into a mass of intermingled emotions. She says her hands are skillful enough to translate her feelings into artworks. Although a white piece of paper is her usual start, yet she finds refuge in colors. For her, colors are a way of expressing what she cannot tell. \nButhaina says that her childhood is enjoyable, but her youth isn\'t. \nThroughout her childhood, Buthaina lived pleasurable moments. Right now, such past memories enable her to live her exhausting youth with a sense of childhood inside. As a beholder, you can see the child Buthaina reflected in her artworks. \nButhaina\'s youth, the period of time she is living right now, has created paradoxical situations within her. Some of which are anger, tremendous maturity, and a great deal of questions. She says, \"Such perplexing situations are crystal clear in some of my artworks. Actually, I convey this message using  red, blue, and dark colors but with a childish sensation.\"\nButhaina loves art in general, but she prefers the formative schools. Also, expressionism is embedded within some of her works. \n', 'Nothing', NULL, NULL, NULL, NULL, 'Buthina', 'Buthina', 'Buthina', 'Buthina', NULL),
(4, 'Karam AL-Nizamy ', 'syrian', 'syria', '1955-03-03', 'Karam is a Syrian artist. He works as an abstract painter. His art has something special because he draws using a knife instead of a feather. Such tool is the first point in his creativity.\nMoreover, what plays a role in his creativity is his interest in nature drawing and metaphysics. He insists also on the harmony between color and music on a classic cardboard, polished paper or MDF wood. This is  clear when anyone sees his paintings. ', 'nothing', NULL, NULL, NULL, NULL, 'Karam ', 'Karam ', 'Karam ', 'Karam ', NULL),
(5, 'Nedal Khweiss', 'syrian', 'syria', '1960-02-02', 'In nedal\'s own point of view, an artist  gains credibility from his permanent passion for hard work. His artworks present the concept of belonging to his environment along with its cultural and aesthetic heritage. For him, any artist is free in his depiction of artworks. Some artists portray their feelings directly. Others add symbols to their works such as patriotism especially during war times like Syria today. Their main goal is widening the horizon of the beholder\'s mind to the possibility of hope, peace and love.', 'nothing', NULL, NULL, NULL, NULL, 'Nedal', 'Nedal', 'Nedal', 'Nedal', NULL),
(6, 'Seham Hunidi', 'syrian', 'syria', '1970-07-11', 'The artist is identified by his paintings. All the details that form his inner world, his dreams, aspirations and interactions with the society are quite clear in what he paints. Art works present an attractive summary of the reality that any artist is struggling with, his ideas and attitude of what is happening in the world. ', 'nothing', NULL, NULL, NULL, NULL, 'Seham', 'Seham', 'Seham', 'Seham', NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `art_type_entity`
--

CREATE TABLE `art_type_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `history` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `updated_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `art_type_entity`
--

INSERT INTO `art_type_entity` (`id`, `name`, `history`, `created_by`, `create_date`, `updated_by`, `update_date`) VALUES
(1, '3D', 'Big History', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `auction_client_entity`
--

CREATE TABLE `auction_client_entity` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `application_date` date DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `auction_entity`
--

CREATE TABLE `auction_entity` (
  `id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `auction_painting_entity`
--

CREATE TABLE `auction_painting_entity` (
  `id` int(11) NOT NULL,
  `painting_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_price` decimal(10,0) NOT NULL,
  `final_price` decimal(10,0) DEFAULT NULL,
  `highiest_price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `clap_entity`
--

CREATE TABLE `clap_entity` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `clap_entity`
--

INSERT INTO `clap_entity` (`id`, `client_id`, `entity_id`, `row`, `value`, `date`) VALUES
(1, 1, 1, 10, 24, '2019-11-07 20:09:56'),
(2, 9, 1, 5, 0, '2019-11-09 07:43:21'),
(3, 9, 1, 5, 0, '2019-11-09 07:43:24'),
(4, 9, 1, 5, 0, '2019-11-09 07:43:25'),
(5, 9, 1, 5, 0, '2019-11-09 07:43:32'),
(6, 1, 1, 8, 26, '2019-11-19 15:15:34'),
(7, 1, 1, 8, 26, '2019-11-19 15:17:31'),
(8, 1, 1, 8, 26, '2019-11-19 15:18:40'),
(9, 1, 1, 8, 26, '2019-11-19 15:18:41'),
(10, 1, 1, 8, 26, '2019-11-19 15:18:41'),
(11, 1, 1, 8, 26, '2019-11-19 15:18:42'),
(12, 1, 1, 8, 26, '2019-11-19 15:18:42'),
(13, 1, 1, 8, 26, '2019-11-19 15:18:42'),
(14, 1, 1, 8, 26, '2019-11-19 15:18:43'),
(15, 1, 1, 8, 26, '2019-11-19 15:18:43'),
(16, 1, 1, 8, 26, '2019-11-19 15:18:43'),
(17, 1, 1, 8, 26, '2019-11-19 15:18:44'),
(18, 1, 1, 8, 26, '2019-11-19 15:18:44'),
(19, 1, 1, 8, 26, '2019-11-19 15:18:44'),
(20, 1, 1, 8, 26, '2019-11-19 15:18:45'),
(21, 1, 1, 8, 26, '2019-11-19 15:18:45'),
(22, 1, 1, 8, 26, '2019-11-19 15:18:45'),
(23, 1, 1, 8, 26, '2019-11-19 15:18:46'),
(24, 1, 1, 8, 26, '2019-11-19 15:18:46'),
(25, 1, 1, 8, 26, '2019-11-19 15:18:47'),
(26, 1, 1, 8, 26, '2019-11-19 15:18:47'),
(27, 1, 1, 8, 26, '2019-11-19 15:18:48');

-- --------------------------------------------------------

--
-- بنية الجدول `client_entity`
--

CREATE TABLE `client_entity` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `client_entity`
--

INSERT INTO `client_entity` (`id`, `username`, `password`, `is_active`, `email`, `phone`, `roles`, `created_by`, `create_date`, `updated_by`, `update_date`, `birth_date`, `full_name`) VALUES
(1, 'HammamZarefa@gmail.com', 'hhhhhhh', 1, 'HammamZarefa@gmail.com', NULL, '[\"ROLE_ADMIN\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Kenan Hussein', '$2y$13$z/Vl3I5naBUAa2BQ5dEWdOkh0Y40noivk0uSzEVmkD5Mh3xsoeaey', 1, 'kenanhussein1@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Qusai Ali', '$2y$13$njINueGZ4x5ZgwAMdGdiM.Slrc1SSFiLrj5Xcpb9XmisMZZ/mDwsy', 1, 'qusai.ali.93.qs@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Talal Danoon', '$2y$13$nsG5Y6zlBwzkmmKD6qAkl.WnwE5cQmGwNY9P9y6qlBxA.I4yDydHq', 1, 'talal.danoun@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Nisreen Abu Zidan', '$2y$13$cocd/WdEJbJU4VMUXV2WbOeGxz6TWiU9fYk5lyMOJi1s8pCPNKS6y', 1, 'nisreen.abuzidan@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Mujeeba Haj Najeeb', '$2y$13$Thr6sYmE7S.nwIAh7YAdDOFxp1fuObXMUTGGGxPqejZ6zw4PA4oom', 1, 'mujeeba.haj.najeeb@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Ghassan Alhamoud', '$2y$13$OkdiwivqImU.6VLG5fHeOu50tr8IrTtfWFVBRKYnfqFXXShuYe05W', 1, 'hamoudassan@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'osama alhamoud', '$2y$13$fEErnP.0YDChPJARyiWyzed0UpmW0P8fMfxTpUpMkeyeSB2UrwHcq', 1, 'osamaalhamoud2020@gmail.com', NULL, '[\"ROLE_USER\"]', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `comment_entity`
--

CREATE TABLE `comment_entity` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `last_edit` datetime DEFAULT NULL,
  `spacial` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `comment_entity`
--

INSERT INTO `comment_entity` (`id`, `client_id`, `entity_id`, `row`, `body`, `date`, `last_edit`, `spacial`) VALUES
(1, 1, 1, 1, 'hh', '2019-11-06 21:16:07', '2019-11-06 21:16:07', 1),
(2, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:17:32', NULL, 0),
(3, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:01', NULL, 0),
(4, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:02', NULL, 0),
(5, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:02', NULL, 0),
(6, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:03', NULL, 0),
(7, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:03', NULL, 0),
(8, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:03', NULL, 0),
(9, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:04', NULL, 0),
(10, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:04', NULL, 0),
(11, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:04', NULL, 0),
(12, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:05', NULL, 0),
(13, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:05', NULL, 0),
(14, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:05', NULL, 0),
(15, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:06', NULL, 0),
(16, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:06', NULL, 0),
(17, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:06', NULL, 0),
(18, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:07', NULL, 0),
(19, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:07', NULL, 0),
(20, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:07', NULL, 0),
(21, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:08', NULL, 0),
(22, 1, 1, 26, 'thank you nice painting', '2019-11-19 15:19:08', NULL, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `entity`
--

CREATE TABLE `entity` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `entity`
--

INSERT INTO `entity` (`id`, `name`) VALUES
(1, 'painting'),
(2, 'artist'),
(3, 'artType'),
(4, 'auction'),
(5, 'client'),
(6, 'statue');

-- --------------------------------------------------------

--
-- بنية الجدول `entity_art_type_entity`
--

CREATE TABLE `entity_art_type_entity` (
  `id` int(11) NOT NULL,
  `art_type_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `entity_art_type_entity`
--

INSERT INTO `entity_art_type_entity` (`id`, `art_type_id`, `entity_id`, `row`) VALUES
(1, 1, 2, 1),
(2, 1, 1, 1),
(3, 1, 2, 2),
(4, 1, 2, 3),
(5, 1, 2, 4),
(6, 1, 2, 5),
(7, 1, 2, 6),
(8, 1, 1, 4),
(9, 1, 1, 5),
(10, 1, 1, 6),
(11, 1, 1, 7),
(12, 1, 1, 8),
(13, 1, 1, 9),
(14, 1, 1, 10),
(15, 1, 1, 11),
(16, 1, 1, 12),
(17, 1, 1, 13),
(18, 1, 1, 14),
(19, 1, 1, 15),
(20, 1, 1, 16),
(21, 1, 1, 17),
(22, 1, 1, 18),
(23, 1, 1, 19),
(24, 1, 1, 20),
(25, 1, 1, 21),
(26, 1, 1, 22),
(27, 1, 1, 23),
(28, 1, 1, 24),
(29, 1, 1, 25),
(30, 1, 1, 26),
(31, 1, 1, 27),
(32, 1, 1, 28),
(33, 1, 1, 29),
(34, 1, 1, 30),
(35, 1, 1, 31),
(36, 1, 1, 32),
(37, 1, 1, 33),
(38, 1, 1, 34),
(39, 1, 1, 35);

-- --------------------------------------------------------

--
-- بنية الجدول `entity_interaction_entity`
--

CREATE TABLE `entity_interaction_entity` (
  `id` int(11) NOT NULL,
  `interaction_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `row` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `entity_interaction_entity`
--

INSERT INTO `entity_interaction_entity` (`id`, `interaction_id`, `entity_id`, `client_id`, `row`, `date`) VALUES
(1, 3, 1, 1, 1, '2019-11-06 20:30:25'),
(2, 3, 6, 5, 1, '2019-11-06 21:10:03'),
(3, 3, 6, 7, 3, '2019-11-07 20:06:15'),
(4, 3, 6, 7, 4, '2019-11-07 20:06:32'),
(5, 3, 6, 7, 7, '2019-11-07 20:06:38'),
(6, 3, 6, 7, 5, '2019-11-07 20:06:54'),
(7, 3, 1, 1, 9, '2019-11-07 20:09:17'),
(9, 1, 1, 1, 10, '2019-11-07 20:10:02'),
(10, 3, 1, 1, 10, '2019-11-07 20:10:22'),
(11, 3, 1, 9, 35, '2019-11-09 07:39:16'),
(12, 3, 1, 9, 33, '2019-11-09 07:39:40'),
(13, 3, 6, 9, 1, '2019-11-09 07:41:45'),
(14, 3, 1, 9, 6, '2019-11-09 07:42:25'),
(15, 3, 6, 9, 3, '2019-11-09 07:44:01'),
(16, 3, 6, 9, 6, '2019-11-09 07:44:55'),
(17, 3, 1, 5, 7, '2019-11-09 13:02:10'),
(18, 1, 1, 5, 7, '2019-11-09 13:03:34'),
(19, 3, 1, 5, 7, '2019-11-09 13:07:22'),
(20, 3, 2, 5, 3, '2019-11-09 13:11:35'),
(21, 3, 2, 5, 6, '2019-11-09 13:12:00'),
(22, 3, 2, 5, 6, '2019-11-09 23:40:24'),
(23, 1, 1, 1, 26, '2019-11-19 15:15:35'),
(24, 2, 2, 1, 5, '2019-11-19 15:15:35'),
(25, 1, 1, 1, 26, '2019-11-19 15:17:32'),
(26, 2, 2, 1, 5, '2019-11-19 15:17:32'),
(27, 1, 1, 1, 26, '2019-11-19 15:18:47'),
(28, 1, 1, 1, 26, '2019-11-19 15:18:48'),
(29, 1, 1, 1, 26, '2019-11-19 15:18:48'),
(30, 1, 1, 1, 26, '2019-11-19 15:18:49'),
(31, 1, 1, 1, 26, '2019-11-19 15:18:49'),
(32, 1, 1, 1, 26, '2019-11-19 15:18:49'),
(33, 1, 1, 1, 26, '2019-11-19 15:18:50'),
(34, 1, 1, 1, 26, '2019-11-19 15:18:50'),
(35, 1, 1, 1, 26, '2019-11-19 15:18:50'),
(36, 1, 1, 1, 26, '2019-11-19 15:18:51'),
(37, 1, 1, 1, 26, '2019-11-19 15:18:51'),
(38, 1, 1, 1, 26, '2019-11-19 15:18:51'),
(39, 1, 1, 1, 26, '2019-11-19 15:18:52'),
(40, 1, 1, 1, 26, '2019-11-19 15:18:52'),
(41, 1, 1, 1, 26, '2019-11-19 15:18:53'),
(42, 1, 1, 1, 26, '2019-11-19 15:18:53'),
(43, 1, 1, 1, 26, '2019-11-19 15:18:53'),
(44, 1, 1, 1, 26, '2019-11-19 15:18:54'),
(45, 1, 1, 1, 26, '2019-11-19 15:18:54'),
(46, 2, 2, 1, 5, '2019-11-19 15:18:54'),
(47, 1, 1, 1, 26, '2019-11-19 15:18:54'),
(48, 2, 2, 1, 5, '2019-11-19 15:18:55'),
(49, 2, 2, 1, 5, '2019-11-19 15:18:55'),
(50, 2, 2, 1, 5, '2019-11-19 15:18:55'),
(51, 2, 2, 1, 5, '2019-11-19 15:18:56'),
(52, 2, 2, 1, 5, '2019-11-19 15:18:56'),
(53, 2, 2, 1, 5, '2019-11-19 15:18:56'),
(54, 2, 2, 1, 5, '2019-11-19 15:18:57'),
(55, 2, 2, 1, 5, '2019-11-19 15:18:57'),
(56, 2, 2, 1, 5, '2019-11-19 15:18:58'),
(57, 2, 2, 1, 5, '2019-11-19 15:18:58'),
(58, 2, 2, 1, 5, '2019-11-19 15:18:58'),
(59, 2, 2, 1, 5, '2019-11-19 15:18:59'),
(60, 2, 2, 1, 5, '2019-11-19 15:18:59'),
(61, 2, 2, 1, 5, '2019-11-19 15:19:00'),
(62, 2, 2, 1, 5, '2019-11-19 15:19:00'),
(63, 2, 2, 1, 5, '2019-11-19 15:19:00'),
(64, 2, 2, 1, 5, '2019-11-19 15:19:01'),
(65, 2, 2, 1, 5, '2019-11-19 15:19:01'),
(66, 2, 2, 1, 5, '2019-11-19 15:19:02');

-- --------------------------------------------------------

--
-- بنية الجدول `entity_media_entity`
--

CREATE TABLE `entity_media_entity` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `row` int(11) NOT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `entity_media_entity`
--

INSERT INTO `entity_media_entity` (`id`, `entity_id`, `media_id`, `name`, `path`, `row`, `created_by`, `created_date`, `updated_by`, `update_date`) VALUES
(1, 3, 1, 'image', 'https://i.pinimg.com/originals/83/2d/5c/832d5c4c59ccc52b9ad0eca1ab1f8329.jpg', 1, NULL, NULL, NULL, NULL),
(2, 2, 1, 'image', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Douaa_Battikh_personal_photo-5dc435cdbb8be.jpeg', 1, NULL, NULL, NULL, NULL),
(3, 2, 1, 'Bashar Barazi', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Bashar_Barazi_personal_photo-5dc434e21eaa8.jpeg', 2, NULL, NULL, NULL, NULL),
(4, 2, 1, 'Buthina Orabi', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Buthina_Orabi_pesonal_photo_2-5dc4356ce1841.jpeg', 3, NULL, NULL, NULL, NULL),
(5, 2, 1, 'Karam AL-Nizamy ', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Karam_AlNizami_personal_photo-5dc4372417422.jpeg', 4, NULL, NULL, NULL, NULL),
(6, 2, 1, 'Nedal Khweiss', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Nedal_Khweiss_personal_photo-5dc437b4b4d5d.jpeg', 5, NULL, NULL, NULL, NULL),
(7, 2, 1, 'Seham Hunidi', 'http://dev-ishtar.96.lt/ImageUploads/ArtistImages/2019-10-18_14-40-34/Seham_Hunidi_personal_photo-5dc438324054f.jpeg', 6, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `favorite_entity`
--

CREATE TABLE `favorite_entity` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `painting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `gallery_entity`
--

CREATE TABLE `gallery_entity` (
  `id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `place` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `gallery_entity`
--

INSERT INTO `gallery_entity` (`id`, `artist_id`, `name`, `date`, `place`) VALUES
(1, 1, 'image', '2019-09-12', 'Kanwat');

-- --------------------------------------------------------

--
-- بنية الجدول `interaction_entity`
--

CREATE TABLE `interaction_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `interaction_entity`
--

INSERT INTO `interaction_entity` (`id`, `name`) VALUES
(1, 'like'),
(2, 'follow'),
(3, 'view');

-- --------------------------------------------------------

--
-- بنية الجدول `media_entity`
--

CREATE TABLE `media_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `media_entity`
--

INSERT INTO `media_entity` (`id`, `name`) VALUES
(1, 'image'),
(2, 'video');

-- --------------------------------------------------------

--
-- بنية الجدول `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191106182303', '2019-11-06 18:23:28'),
('20191119151447', '2019-11-19 15:14:58');

-- --------------------------------------------------------

--
-- بنية الجدول `painting_entity`
--

CREATE TABLE `painting_entity` (
  `id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `colors_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_words` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` decimal(6,0) NOT NULL,
  `width` decimal(6,0) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `updeted_by` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `painting_entity`
--

INSERT INTO `painting_entity` (`id`, `artist_id`, `gallery_id`, `name`, `state`, `colors_type`, `key_words`, `height`, `width`, `active`, `image`, `created_by`, `create_date`, `updeted_by`, `update_date`) VALUES
(3, 1, 1, 'image', 1, 'woody', 'woody', '23', '32', 0, 'https://i.pinimg.com/originals/83/2d/5c/832d5c4c59ccc52b9ad0eca1ab1f8329.jpg', NULL, NULL, NULL, NULL),
(4, 6, NULL, 'Shout', 1, 'oil', 'shout', '100', '80', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-10-18_14-41-58/02_Seham_Hunidi-5dc438f8be339.jpeg', NULL, NULL, NULL, NULL),
(5, 6, NULL, 'patience', 1, 'oil', 'nothing', '100', '80', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-10-18_14-41-58/05_Seham_Hunidi-5dc439546a399.jpeg', NULL, NULL, NULL, NULL),
(6, 6, NULL, 'Jasmin', 1, 'oil', 'nothing', '50', '50', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/08_Seham_Hunidi-5dc4399c7cdef.jpeg', NULL, NULL, NULL, NULL),
(7, 6, NULL, 'Sham', 1, 'oil', 'nothing', '50', '50', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/10_Seham_Hunidi-5dc43a0ad7000.jpeg', NULL, NULL, NULL, NULL),
(8, 6, NULL, 'Salam', 1, 'oil', 'nothing', '56', '45', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/11_Seham_Hunidi-5dc43a44737f0.jpeg', NULL, NULL, NULL, NULL),
(9, 6, NULL, 'pomegranate', 1, 'oil', 'nothing', '150', '50', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/17_Seham_Hunidi-5dc43aaab6b4e.jpeg', NULL, NULL, NULL, NULL),
(10, 6, NULL, 'storm', 1, 'oil', 'nothing', '100', '100', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/18_Seham_Hunidi-5dc43aecf1b15.jpeg', NULL, NULL, NULL, NULL),
(11, 6, NULL, 'fog', 1, 'oil', 'nothing', '120', '100', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/18_Seham_Hunidi-5dc43b2999283.jpeg', NULL, NULL, NULL, NULL),
(12, 6, NULL, 'rain', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/33_Seham_Hunidi-5dc43beeb7aba.jpeg', NULL, NULL, NULL, NULL),
(13, 6, NULL, 'children', 1, 'oil', 'nothing', '120', '200', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/30_Seham_Hunidi-5dc43cf43e624.jpeg', NULL, NULL, NULL, NULL),
(14, 2, NULL, 'soul', 1, 'oil', 'nothing', '100', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/01_Bashar_Barazi-5dc43d34da545.jpeg', NULL, NULL, NULL, NULL),
(15, 2, NULL, 'city', 1, 'oil', 'nothing', '90', '100', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-34-52/02_Bashar_Barazi-5dc43d960cef6.jpeg', NULL, NULL, NULL, NULL),
(16, 2, NULL, 'individual', 1, 'oil', 'nothing', '100', '122', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/03_Bashar_Barazi-5dc43df7c181f.jpeg', NULL, NULL, NULL, NULL),
(17, 2, NULL, 'red', 1, 'oil', 'nothing', '50', '50', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/06_Bashar_Barazi-5dc43f6bed221.jpeg', NULL, NULL, NULL, NULL),
(18, 4, NULL, 'harmony', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/01_Karam_ALNizami-5dc440150dc54.jpeg', NULL, NULL, NULL, NULL),
(19, 4, NULL, 'reddy', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/02_Karam_ALNizami-5dc4403e5eeac.jpeg', NULL, NULL, NULL, NULL),
(20, 4, NULL, 'nature', 1, 'oil', 'nothing', '120', '220', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/03_Karam_ALNizami-5dc440b1a65e4.jpeg', NULL, NULL, NULL, NULL),
(21, 4, NULL, 'beach', 1, 'oil', 'nothing', '150', '150', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/04_Karam_ALNizami-5dc4410131245.jpeg', NULL, NULL, NULL, NULL),
(22, 5, NULL, 'people', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/01_Nedal_Khweiss-5dc441aae36bd.jpeg', NULL, NULL, NULL, NULL),
(23, 5, NULL, 'women', 1, 'oil', 'nothing', '95', '95', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/04_Nedal_Khweiss-5dc4423212d89.jpeg', NULL, NULL, NULL, NULL),
(24, 5, NULL, 'girl with the dog', 1, 'oil', 'nothing', '95', '123', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/13_Nedal_Khweiss-5dc443153e859.jpeg', NULL, NULL, NULL, NULL),
(25, 5, NULL, 'naturetwo', 1, 'oil', 'nothing', '321', '123', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/15_Nedal_Khweiss-5dc4439eda43d.jpeg', NULL, NULL, NULL, NULL),
(26, 5, NULL, 'mountain', 1, 'oil', 'nothing', '45', '45', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/14_Nedal_Khweiss-5dc4457e79911.jpeg', NULL, NULL, NULL, NULL),
(27, 5, NULL, 'sea', 1, 'oil', 'nothing', '100', '123', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/20_Nedal_Khweiss-5dc4465d7aeba.jpeg', NULL, NULL, NULL, NULL),
(28, 1, NULL, 'tree1', 1, 'oil', 'nothing', '100', '200', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/01_Douaa_Battikh-5dc446d4191b5.jpeg', NULL, NULL, NULL, NULL),
(29, 1, NULL, 'tree2', 1, 'oil', 'nothing', '150', '150', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/02_Douaa_Battikh-5dc44706c92b9.jpeg', NULL, NULL, NULL, NULL),
(30, 1, NULL, 'tree3', 1, 'oil', 'nothing', '150', '150', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/03_Douaa_Battikh-5dc4473e4155e.jpeg', NULL, NULL, NULL, NULL),
(31, 1, NULL, 'tree4', 1, 'oil', 'nothing', '150', '150', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/04_Douaa_Battikh-5dc4478acb81e.jpeg', NULL, NULL, NULL, NULL),
(32, 1, NULL, 'window', 1, 'oil', 'nothing', '150', '150', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/08_Douaa_Battikh-5dc447e700823.jpeg', NULL, NULL, NULL, NULL),
(33, 3, NULL, 'child1', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/01_Buthina_Orabi-5dc448712ec27.jpeg', NULL, NULL, NULL, NULL),
(34, 3, NULL, 'doll', 1, 'oil', 'nothing', '120', '120', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/02_Buthina_Orabi-5dc448940db4b.jpeg', NULL, NULL, NULL, NULL),
(35, 3, NULL, 'toy', 1, 'oil', 'nothing', '120', '50', 1, 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_16-25-34/03_Buthina_Orabi-5dc44cf1458ef.jpeg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `painting_transaction_entity`
--

CREATE TABLE `painting_transaction_entity` (
  `id` int(11) NOT NULL,
  `painting_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `details` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `price_entity`
--

CREATE TABLE `price_entity` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `price_entity`
--

INSERT INTO `price_entity` (`id`, `entity_id`, `price`, `created_date`, `row`) VALUES
(1, 1, '300', '2019-11-06 20:26:35', 1),
(2, 6, '900', '2019-11-06 20:41:48', 1),
(3, 1, '900', '2019-11-06 20:52:17', 1),
(4, 1, '150', NULL, 4),
(5, 1, '150', NULL, 5),
(6, 1, '150', NULL, 6),
(7, 1, '100', NULL, 7),
(8, 1, '200', NULL, 8),
(9, 1, '250', NULL, 9),
(10, 1, '150', NULL, 10),
(11, 1, '100', NULL, 11),
(12, 1, '100', NULL, 12),
(13, 1, '150', NULL, 13),
(14, 1, '80', NULL, 14),
(15, 1, '150', NULL, 15),
(16, 1, '120', NULL, 16),
(17, 1, '150', NULL, 17),
(18, 1, '150', NULL, 18),
(19, 1, '120', NULL, 19),
(20, 1, '100', NULL, 20),
(21, 1, '90', NULL, 21),
(22, 1, '200', NULL, 22),
(23, 1, '65', NULL, 23),
(24, 1, '1450', NULL, 24),
(25, 1, '450', NULL, 25),
(26, 1, '456', NULL, 26),
(27, 1, '123', NULL, 27),
(28, 1, '150', NULL, 28),
(29, 1, '150', NULL, 29),
(30, 1, '150', NULL, 30),
(31, 1, '150', NULL, 31),
(32, 1, '150', NULL, 32),
(33, 1, '120', NULL, 33),
(34, 1, '120', NULL, 34),
(35, 1, '123', NULL, 35),
(36, 6, '120', NULL, 2),
(37, 6, '123', NULL, 3),
(38, 6, '250', NULL, 4),
(39, 6, '250', NULL, 5),
(40, 6, '700', NULL, 6),
(41, 6, '456', NULL, 7);

-- --------------------------------------------------------

--
-- بنية الجدول `refresh_tokens`
--

CREATE TABLE `refresh_tokens` (
  `id` int(11) NOT NULL,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `refresh_tokens`
--

INSERT INTO `refresh_tokens` (`id`, `refresh_token`, `username`, `valid`) VALUES
(3, '443d300eb5dd233663d9ba2e2e57eec431d412741a72ef0e5d47be3094a436e0690d8347db867a7a2d28fdb2a5585ba4ca48a2769bc1fa8d4d9102933cb72ebf', 'kenanhussein1@gmail.com', '2019-12-10 04:08:34'),
(4, 'd22254776349483d1f4168e2c759b546ca64dfa5594b5b9d5106d7a582812622739122c4017b855d8973ea7198346e12794c901dd68d856c478bd54612ccba9e', 'kenanhussein1@gmail.com', '2019-12-19 15:15:33'),
(5, 'cb3d8408f9ea95b2168036625a428e86b4a7f170730d8dc96876681015a36f060127f4e716dc4f0723c82bc544259dd9c6b2e0b53a8eabb8eb7e9ceeced012e6', 'kenanhussein1@gmail.com', '2019-12-19 15:17:29'),
(6, 'fb1abda17a9c4236218223d87193ef06f0976060b4b5f58490edc21ebfb7fd849d177285c7ce7b7d062c077f61ebd931d165eb977dec599e0abc3b8dfc74cd2c', 'kenanhussein1@gmail.com', '2019-12-19 15:18:03'),
(7, '6b13f921816d710b677ad1a2280cfa90c1160e6f3597fd41d967296ce08b830e629441935858762f10bbebc179043163f7c0188e2a2df1ef96a9b29bf05698fd', 'kenanhussein1@gmail.com', '2019-12-19 15:18:04'),
(8, '8d89f71ae841ce24d69f8cb80cfff75e5f2c35c0a9a0c9fd16995af103d13a85199a2c2c946d2f700db3c3cd8124207fc4ef2d81e70e1f564cea1c33b54adbc4', 'kenanhussein1@gmail.com', '2019-12-19 15:18:05'),
(9, '5916a0c411d3316546a947c36e191b31370a45f1dbb164358618a99cb5d75e9dc9285013648f64ea786be4ffff73e7811da5b47b46da2cf49c87f6ef1ac3f500', 'kenanhussein1@gmail.com', '2019-12-19 15:18:06'),
(10, '42815f02f0e9e4651d60df4475a8817ef783bb1381ab107380bddcfdd6babca70334ab500cfa3682f1b96437087dd44665106e1d82ed0c60e189aec10615cf49', 'kenanhussein1@gmail.com', '2019-12-19 15:18:06'),
(11, '09caa2df97efcd1f8ab710cdebad8b3f3d679040e169b54a1c5bb5bb5fe1633b9261029f24a1b0d1f944bd1fb37e5cdef6653665a506d762df8d3049fdf2eeae', 'kenanhussein1@gmail.com', '2019-12-19 15:18:07'),
(12, '4fb62d0e31f28ef5cc53ddab005ba42d8781fbce1c59bf0e19d5de853dbc4fe042010d77f496f435860202fc85a9dc8b916bf42e940917e42d4461a99d26c81a', 'kenanhussein1@gmail.com', '2019-12-19 15:18:08'),
(13, 'e95e28f655d9022a8f44c131e6122807395e4d8242aaf75d1f3575d6443cf741f2cd0590198dbad2067929de88cd68e9d3c790fe86e5d46cce15fb3ebb33628a', 'kenanhussein1@gmail.com', '2019-12-19 15:18:09'),
(14, 'b11244c2af6dc86361aa4e200a433d8327e097f3347e57517d38c1966aa09865a09a2e59c05e95de196573f36e345ba02a005707aed6869d04a8fb05a9a9dc49', 'kenanhussein1@gmail.com', '2019-12-19 15:18:10'),
(15, '38e48cb8e7b98d1a117ee5a4a84e12834c2f44e9781f0f451a093d00df7681dfb9ad95e695edcf7aa8ae75f906ce1aecf3c2c93310282587483f71e04809fbba', 'kenanhussein1@gmail.com', '2019-12-19 15:18:11'),
(16, 'cfeecae29bea44f5a22e02fbb508907fe286900e91c4c0168816d73f4843f817c354a9137bbb3bfb8a615e7be67e27530cd847fa7f955d972abdc7ef1de63670', 'kenanhussein1@gmail.com', '2019-12-19 15:18:12'),
(17, 'd4f771af88ede7020b2e0e2cba3e7176eafce9c531566e0689228ea12f4c64f5157f7f010e15f15cd7e41bf3eb27256d151d154757b2b8fa46d9c8ea10f75b80', 'kenanhussein1@gmail.com', '2019-12-19 15:18:12'),
(18, 'c685e31addb753502cb8f81878947314897b7c5996287e7017851d26cb426bd31e9a85ad93d2772db8a32486900b65b4206149c30871cef969da20595189fa14', 'kenanhussein1@gmail.com', '2019-12-19 15:18:13'),
(19, 'e5f0eeea8acce25ad34479a422e87c7b2baa3222d9bca9d48c87a5549ca1aa74ea867514eb2399dc8c8cf1e24240fc4a195ea79b949ec7ac811d3ade064b9bff', 'kenanhussein1@gmail.com', '2019-12-19 15:18:14'),
(20, '2ce4189dffbd2319d84e2baf0a76133ce5a2d2f4656737a9b734b6fc7432fae2e1148d6ea90f2e339d19bf8eafa218819b6835bead40adc8738d1a57e36b7ee1', 'kenanhussein1@gmail.com', '2019-12-19 15:18:15'),
(21, '6554849918a4694e18a4cdc486cf466884974ce0394d02086eca2b8559312586b7810fb352e8d858e0e55322d448616f3c47fff9dc41bed8c0800488c5a23f9e', 'kenanhussein1@gmail.com', '2019-12-19 15:18:15'),
(22, 'e18738006f3ef893c687c7cc2cb0584b8e9bf79190fb268a530e298298e3bc54ba88cfb7d16f58e14c0dc2c49bf09f528b995beec79c4d3b3d757f24aa56191a', 'kenanhussein1@gmail.com', '2019-12-19 15:18:16'),
(23, '468152f22012e3a4fc5c201b3ad2a130a9a6f0b95c69c72d1738e9a41756ae4e158dd450d7ab4da90c74b49c1324d05ac1600f2c7718a81e32c45e6a923683ad', 'kenanhussein1@gmail.com', '2019-12-19 15:18:17'),
(24, 'aaadd0d6a132ccbb4cf22f3ce684d0fba13a31f27782b08605959a2d9f785ee7d01e1ab0278f12c4999b8f547caa2371c3cf64feff28ef31bb581442b853f825', 'kenanhussein1@gmail.com', '2019-12-19 15:18:18'),
(25, '5c8b7a73654dd3fe45368319b9d9f7f7f8de7e144038ab7ea39288bcb5cd2a6dacc9892ea73052c35699e2c9a2ee1d0a9004b8d50c5a71b2764ef14055261673', 'kenanhussein1@gmail.com', '2019-12-19 15:18:19');

-- --------------------------------------------------------

--
-- بنية الجدول `statue_entity`
--

CREATE TABLE `statue_entity` (
  `id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` decimal(6,0) NOT NULL,
  `height` decimal(6,0) NOT NULL,
  `width` decimal(6,0) NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(6,0) DEFAULT NULL,
  `mediums` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `key_word` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `statue_entity`
--

INSERT INTO `statue_entity` (`id`, `artist_id`, `name`, `length`, `height`, `width`, `material`, `description`, `style`, `period`, `weight`, `mediums`, `features`, `image`, `active`, `key_word`, `create_date`, `created_by`, `updated_date`, `updated_by`, `state`) VALUES
(1, 1, 'statues', '32', '23', '32', 'n', 'n', 'n', 'n', '13', '1313', 'n', 'https://i.pinimg.com/originals/83/2d/5c/832d5c4c59ccc52b9ad0eca1ab1f8329.jpg', 1, 'j', NULL, NULL, NULL, NULL, 1),
(2, 1, 'Moai', '1', '1', '1', 'marble', 'nothing', 'moai', '1235', '10', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/acj-0805-statues-in-the-world-11-5dc477132f28f.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1),
(3, 2, 'Little Mermaid', '1', '2', '1', 'marble', 'nothing', 'moai', '1456', '23', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/acj-0805-statues-in-the-world-3-5dc4775415fa6.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1),
(4, 3, 'The Thinker', '1', '2', '1', 'marble', 'nothing', 'nothing', '1256', '25', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/The Thinker-5dc477d2bf43e.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1),
(5, 4, 'Terrace Of The Lions', '1', '12', '45', 'nothing', 'nothing', 'nothing', '1459', '30', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/Terrace Of The Lions-5dc4780b9ff4e.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1),
(6, 5, 'The Statues Of Mount Nemrut', '1', '2', '1', 'nothing', 'nothing', 'moai', '1495', '10', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/The Statues Of Mount Nemrut-5dc478695e814.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1),
(7, 6, 'The Motherland Calls', '1', '6', '3', 'marble', 'nothing', 'nothing', '0563', '98', 'nothing', 'nothing', 'http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_19-57-07/The Motherland Calls-5dc478ff8e535.jpeg', 1, 'nothing', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `story_entity`
--

CREATE TABLE `story_entity` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `story` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `story_entity`
--

INSERT INTO `story_entity` (`id`, `entity_id`, `story`, `row`) VALUES
(1, 1, 'jjjhh', 1),
(2, 1, 'Nothing important', 4),
(3, 1, 'nothing', 5),
(4, 1, 'nothing', 6),
(5, 1, 'nothing', 7),
(6, 1, 'nothing', 8),
(7, 1, 'nothing', 9),
(8, 1, 'nothing', 10),
(9, 1, 'nothing', 11),
(10, 1, 'nothing', 12),
(11, 1, 'nothing', 13),
(12, 1, 'nothing', 14),
(13, 1, 'nothing', 15),
(14, 1, 'nothing', 16),
(15, 1, 'nothing', 17),
(16, 1, 'nothing', 18),
(17, 1, 'nothing', 19),
(18, 1, 'nothing', 20),
(19, 1, 'nothing', 21),
(20, 1, 'nothing', 22),
(21, 1, 'nothing', 23),
(22, 1, 'nothing', 24),
(23, 1, 'nothing', 25),
(24, 1, 'nothing', 26),
(25, 1, 'nothing', 27),
(26, 1, 'nothing', 28),
(27, 1, 'nothing', 29),
(28, 1, 'nothing', 30),
(29, 1, 'nothing', 31),
(30, 1, 'nothing', 32),
(31, 1, 'nothing', 33),
(32, 1, 'nothing', 34),
(33, 1, 'nothing', 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_entity`
--
ALTER TABLE `artist_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `art_type_entity`
--
ALTER TABLE `art_type_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction_client_entity`
--
ALTER TABLE `auction_client_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7C75A80A57B8F0DE` (`auction_id`),
  ADD KEY `IDX_7C75A80A19EB6921` (`client_id`);

--
-- Indexes for table `auction_entity`
--
ALTER TABLE `auction_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction_painting_entity`
--
ALTER TABLE `auction_painting_entity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1F38BC90B00EB939` (`painting_id`),
  ADD UNIQUE KEY `UNIQ_1F38BC9057B8F0DE` (`auction_id`),
  ADD KEY `IDX_1F38BC9019EB6921` (`client_id`);

--
-- Indexes for table `clap_entity`
--
ALTER TABLE `clap_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E455DDC919EB6921` (`client_id`),
  ADD KEY `IDX_E455DDC981257D5D` (`entity_id`);

--
-- Indexes for table `client_entity`
--
ALTER TABLE `client_entity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5B8E0FDBE7927C74` (`email`);

--
-- Indexes for table `comment_entity`
--
ALTER TABLE `comment_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C43B1C7A19EB6921` (`client_id`),
  ADD KEY `IDX_C43B1C7A81257D5D` (`entity_id`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entity_art_type_entity`
--
ALTER TABLE `entity_art_type_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_261826B371088DEF` (`art_type_id`),
  ADD KEY `IDX_261826B381257D5D` (`entity_id`);

--
-- Indexes for table `entity_interaction_entity`
--
ALTER TABLE `entity_interaction_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_636E1C29886DEE8F` (`interaction_id`),
  ADD KEY `IDX_636E1C2981257D5D` (`entity_id`),
  ADD KEY `IDX_636E1C2919EB6921` (`client_id`);

--
-- Indexes for table `entity_media_entity`
--
ALTER TABLE `entity_media_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AD09678281257D5D` (`entity_id`),
  ADD KEY `IDX_AD096782EA9FDD75` (`media_id`);

--
-- Indexes for table `favorite_entity`
--
ALTER TABLE `favorite_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_329D289219EB6921` (`client_id`),
  ADD KEY `IDX_329D2892B00EB939` (`painting_id`);

--
-- Indexes for table `gallery_entity`
--
ALTER TABLE `gallery_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ACABA8CAB7970CF8` (`artist_id`);

--
-- Indexes for table `interaction_entity`
--
ALTER TABLE `interaction_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_entity`
--
ALTER TABLE `media_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `painting_entity`
--
ALTER TABLE `painting_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFA9597EB7970CF8` (`artist_id`),
  ADD KEY `IDX_CFA9597E4E7AF8F` (`gallery_id`);

--
-- Indexes for table `painting_transaction_entity`
--
ALTER TABLE `painting_transaction_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_586982CCB00EB939` (`painting_id`),
  ADD KEY `IDX_586982CC19EB6921` (`client_id`);

--
-- Indexes for table `price_entity`
--
ALTER TABLE `price_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_43B1EC3881257D5D` (`entity_id`);

--
-- Indexes for table `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`);

--
-- Indexes for table `statue_entity`
--
ALTER TABLE `statue_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B6D489B7970CF8` (`artist_id`);

--
-- Indexes for table `story_entity`
--
ALTER TABLE `story_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_412BF69A81257D5D` (`entity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_entity`
--
ALTER TABLE `artist_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `art_type_entity`
--
ALTER TABLE `art_type_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction_client_entity`
--
ALTER TABLE `auction_client_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_entity`
--
ALTER TABLE `auction_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_painting_entity`
--
ALTER TABLE `auction_painting_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clap_entity`
--
ALTER TABLE `clap_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `client_entity`
--
ALTER TABLE `client_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment_entity`
--
ALTER TABLE `comment_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `entity_art_type_entity`
--
ALTER TABLE `entity_art_type_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `entity_interaction_entity`
--
ALTER TABLE `entity_interaction_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `entity_media_entity`
--
ALTER TABLE `entity_media_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favorite_entity`
--
ALTER TABLE `favorite_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_entity`
--
ALTER TABLE `gallery_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interaction_entity`
--
ALTER TABLE `interaction_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media_entity`
--
ALTER TABLE `media_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `painting_entity`
--
ALTER TABLE `painting_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `painting_transaction_entity`
--
ALTER TABLE `painting_transaction_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_entity`
--
ALTER TABLE `price_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `statue_entity`
--
ALTER TABLE `statue_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `story_entity`
--
ALTER TABLE `story_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `auction_client_entity`
--
ALTER TABLE `auction_client_entity`
  ADD CONSTRAINT `FK_7C75A80A19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_7C75A80A57B8F0DE` FOREIGN KEY (`auction_id`) REFERENCES `auction_entity` (`id`);

--
-- القيود للجدول `auction_painting_entity`
--
ALTER TABLE `auction_painting_entity`
  ADD CONSTRAINT `FK_1F38BC9019EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_1F38BC9057B8F0DE` FOREIGN KEY (`auction_id`) REFERENCES `auction_entity` (`id`),
  ADD CONSTRAINT `FK_1F38BC90B00EB939` FOREIGN KEY (`painting_id`) REFERENCES `painting_entity` (`id`);

--
-- القيود للجدول `clap_entity`
--
ALTER TABLE `clap_entity`
  ADD CONSTRAINT `FK_E455DDC919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_E455DDC981257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`);

--
-- القيود للجدول `comment_entity`
--
ALTER TABLE `comment_entity`
  ADD CONSTRAINT `FK_C43B1C7A19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_C43B1C7A81257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`);

--
-- القيود للجدول `entity_art_type_entity`
--
ALTER TABLE `entity_art_type_entity`
  ADD CONSTRAINT `FK_261826B371088DEF` FOREIGN KEY (`art_type_id`) REFERENCES `art_type_entity` (`id`),
  ADD CONSTRAINT `FK_261826B381257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`);

--
-- القيود للجدول `entity_interaction_entity`
--
ALTER TABLE `entity_interaction_entity`
  ADD CONSTRAINT `FK_636E1C2919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_636E1C2981257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`),
  ADD CONSTRAINT `FK_636E1C29886DEE8F` FOREIGN KEY (`interaction_id`) REFERENCES `interaction_entity` (`id`);

--
-- القيود للجدول `entity_media_entity`
--
ALTER TABLE `entity_media_entity`
  ADD CONSTRAINT `FK_AD09678281257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`),
  ADD CONSTRAINT `FK_AD096782EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media_entity` (`id`);

--
-- القيود للجدول `favorite_entity`
--
ALTER TABLE `favorite_entity`
  ADD CONSTRAINT `FK_329D289219EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_329D2892B00EB939` FOREIGN KEY (`painting_id`) REFERENCES `painting_entity` (`id`);

--
-- القيود للجدول `gallery_entity`
--
ALTER TABLE `gallery_entity`
  ADD CONSTRAINT `FK_ACABA8CAB7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist_entity` (`id`);

--
-- القيود للجدول `painting_entity`
--
ALTER TABLE `painting_entity`
  ADD CONSTRAINT `FK_CFA9597E4E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `gallery_entity` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CFA9597EB7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist_entity` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `painting_transaction_entity`
--
ALTER TABLE `painting_transaction_entity`
  ADD CONSTRAINT `FK_586982CC19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client_entity` (`id`),
  ADD CONSTRAINT `FK_586982CCB00EB939` FOREIGN KEY (`painting_id`) REFERENCES `painting_entity` (`id`);

--
-- القيود للجدول `price_entity`
--
ALTER TABLE `price_entity`
  ADD CONSTRAINT `FK_43B1EC3881257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`);

--
-- القيود للجدول `statue_entity`
--
ALTER TABLE `statue_entity`
  ADD CONSTRAINT `FK_9B6D489B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist_entity` (`id`);

--
-- القيود للجدول `story_entity`
--
ALTER TABLE `story_entity`
  ADD CONSTRAINT `FK_412BF69A81257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
