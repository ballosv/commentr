-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 01. Apr 2016 um 10:58
-- Server-Version: 5.5.42
-- PHP-Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db10715138-commentr`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`) VALUES
(1, 'Politik', 0),
(2, 'Sport', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `opinion_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `opinion_id`, `user_id`, `title`, `text`, `date`) VALUES
(10, 32, 5, 'Testtest', 'dfsfs', '2016-03-23 22:40:25'),
(11, 32, 5, 'Wieder ein Kommentar', 'fdfsdksd', '2016-03-23 22:41:41'),
(12, 31, 5, 'Hallo Welt', 'dfkjkskfölsd', '2016-03-23 22:44:26'),
(13, 32, 5, 'Kommentar', 'fgdssdfsd', '2016-03-24 09:28:59'),
(14, 31, 6, 'dfsdfsd', 'sfsdfsd', '2016-03-24 11:24:23'),
(15, 39, 5, 'dfsdghgf', 'dsfsdcsa', '2016-03-25 01:11:31'),
(16, 39, 5, 'ffhhgh', 'sdcsdcs', '2016-03-25 01:11:39'),
(17, 41, 5, 'fdsfss', 'fsddac', '2016-03-25 01:12:09'),
(18, 39, 6, 'dsfdsfsd', 'fsdfdsf', '2016-03-25 01:16:45'),
(19, 44, 6, 'sdfdsfsd', 'fsdfsdf', '2016-03-25 01:23:33'),
(20, 47, 6, 'fsdfsdf', 'fdsfsd', '2016-03-25 03:06:34'),
(21, 53, 5, 'dsfdsfds', 'dasdas', '2016-03-31 08:11:08');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opinions`
--

CREATE TABLE `opinions` (
  `id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `comments` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `opinions`
--

INSERT INTO `opinions` (`id`, `topic_id`, `user_id`, `title`, `text`, `date`, `status`, `comments`) VALUES
(26, 6, 5, 'testmeinung', 'fdflsdjflks\r\n', '2016-03-23 21:22:17', 1, 0),
(27, 1, 5, 'Noch eine Testmeinung', 'sdsfsdfs', '2016-03-23 21:30:47', 1, 0),
(28, 5, 5, 'dfsdfs', 'sdfsdf', '2016-03-23 21:31:34', 1, 0),
(29, 1, 5, 'Wieder eine neue Meinung', 'dfgfdgf', '2016-03-23 21:37:03', 1, 0),
(30, 1, 5, 'sdgfhgff', 'dsfsd', '2016-03-23 21:38:55', 1, 0),
(31, 7, 5, 'test', 'fdsfds', '2016-03-23 22:13:59', 1, 2),
(32, 7, 5, 'noch ein test', 'testdsfds', '2016-03-23 22:14:07', 1, 3),
(33, 3, 5, 'Eine Meinung', 'dsgfgdf', '2016-03-23 22:50:00', 1, 0),
(34, 3, 5, 'Noch eine Meinung', 'jfldjlksdjfsd', '2016-03-23 22:50:13', 1, 0),
(35, 3, 6, 'fdsfsdf', 'sdfsdf', '2016-03-23 22:54:32', 1, 0),
(36, 3, 6, 'ssdasd', 'dsfvc', '2016-03-23 22:54:55', 1, 0),
(37, 8, 5, 'Meinung', 'kdjlsfds', '2016-03-24 08:30:03', 1, 0),
(38, 11, 5, 'sdffdsf', 'sdfsda', '2016-03-25 01:11:06', 1, 0),
(39, 11, 5, 'ghghgf', 'sfadas', '2016-03-25 01:11:14', 1, 3),
(40, 10, 5, 'fghghfdgfd', 'dfsdsdcsd', '2016-03-25 01:11:53', 1, 0),
(41, 10, 5, 'vswesx', 'cvfvsdf', '2016-03-25 01:12:01', 1, 1),
(42, 11, 5, 'sdfgfdgdf', 'dasdsadas', '2016-03-25 01:15:24', 1, 0),
(43, 13, 6, 'sfgfdgdf', 'sdfdsafd', '2016-03-25 01:16:53', 1, 0),
(44, 12, 6, 'gfgfdgfd', 'dfdsafdc', '2016-03-25 01:17:00', 1, 1),
(45, 13, 6, 'fsdfdsf', 'fsdfsd', '2016-03-25 01:23:14', 1, 0),
(46, 8, 6, 'asdfdgffg', 'asdsada', '2016-03-25 01:23:54', 1, 0),
(47, 13, 6, 'dsadasdas', 'dasdasd', '2016-03-25 01:37:33', 1, 1),
(48, 13, 6, 'fdsfsdf', 'asdas', '2016-03-25 03:06:57', 1, 0),
(49, 13, 5, 'dsdas', 'asdasds', '2016-03-25 13:32:50', 1, 0),
(50, 15, 5, 'dsfsdfsd', 'sdas', '2016-03-30 21:45:54', 1, 0),
(51, 24, 5, 'dsfsdfsd', 'dfsdfs', '2016-03-31 07:41:46', 1, 0),
(52, 24, 5, 'fsdfsd', 'dfsdfsd', '2016-03-31 07:51:01', 1, 0),
(53, 24, 5, 'dgdfhgf', 'sfsdda', '2016-03-31 07:58:02', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opinion_has_likes`
--

CREATE TABLE `opinion_has_likes` (
  `id` int(10) NOT NULL,
  `opinion_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `like_status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `opinion_has_likes`
--

INSERT INTO `opinion_has_likes` (`id`, `opinion_id`, `user_id`, `like_status`, `date`) VALUES
(39, 32, 5, '1', '2016-03-23 22:20:03'),
(40, 31, 5, '0', '2016-03-23 22:34:26'),
(41, 34, 5, '1', '2016-03-23 22:50:56'),
(42, 33, 5, '1', '2016-03-23 22:51:01'),
(43, 34, 6, '1', '2016-03-23 22:51:21'),
(44, 33, 6, '0', '2016-03-23 22:51:25'),
(45, 35, 6, '1', '2016-03-23 22:54:58'),
(46, 31, 6, '1', '2016-03-24 10:43:03'),
(47, 39, 5, '1', '2016-03-25 01:11:19'),
(48, 38, 5, '1', '2016-03-25 01:11:21'),
(49, 49, 5, '1', '2016-03-26 01:06:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `themes`
--

CREATE TABLE `themes` (
  `id` int(10) NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) NOT NULL,
  `teaser` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `themes`
--

INSERT INTO `themes` (`id`, `link`, `name`, `parent`, `teaser`, `image`, `date`, `status`, `last_update`) VALUES
(1, 'fluechtlingskrise', 'Flüchtlingskrise', 0, 'Die Flüchtlingskrise gefährdet Europa.', '', '2016-03-02 23:00:00', 1, '2016-03-31 07:38:09'),
(2, 'rechtsextremismus-in-deutschland', 'Rechtsextremismus in Deutschland', 0, 'Der Zulauf in der Bevölkerung zu rechtsextremen Gruppierungen ist erschreckend.', '', '2016-03-02 23:00:00', 1, '0000-00-00 00:00:00'),
(30, 'vw-skandal', 'VW-Skandal', 0, 'dfsdfsd', '', '2016-03-25 14:00:09', 1, '2016-03-31 08:47:26'),
(29, 'ostern-2016', 'Ostern 2016', 0, 'dfdsfsd', '', '2016-03-25 13:59:21', 1, '0000-00-00 00:00:00'),
(28, 'testthema', 'testthema', 0, 'sdasdasd', 'whiteboard-849803_1920.jpg', '2016-03-25 01:04:06', 1, '0000-00-00 00:00:00'),
(27, 'westerwelle-ist-tot', 'Westerwelle ist tot', 0, 'dsfdsfsd', 'aptopix-apple-48714757.jpg', '2016-03-25 01:01:24', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `themes_has_categories`
--

CREATE TABLE `themes_has_categories` (
  `id` int(10) NOT NULL,
  `theme_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `themes_has_categories`
--

INSERT INTO `themes_has_categories` (`id`, `theme_id`, `category_id`) VALUES
(18, 27, 1),
(19, 1, 1),
(20, 2, 1),
(23, 28, 2),
(24, 29, 2),
(25, 30, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `themes_related`
--

CREATE TABLE `themes_related` (
  `id` int(10) NOT NULL,
  `parent_theme_id` int(10) NOT NULL,
  `child_theme_id` int(10) NOT NULL,
  `relation_text` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topics`
--

CREATE TABLE `topics` (
  `id` int(10) NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `theme_id` int(10) NOT NULL,
  `teaser` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `topics`
--

INSERT INTO `topics` (`id`, `link`, `name`, `theme_id`, `teaser`, `image`, `date`, `status`) VALUES
(1, 'test', 'test', 1, 'text', 'boot-998966_1280.jpg', '2016-03-23 14:46:20', 1),
(2, 'immer-mehr-fluechtlinge', 'Immer mehr Flüchtlinge', 1, 'fsdjkldsjfkl', 'boot-998966_1280.jpg', '2016-03-23 14:47:48', 1),
(3, 'koeln', 'Köln', 1, 'fdfgdfsfsdf', 'boot-998966_1280.jpg', '2016-03-16 14:48:07', 1),
(4, 'grenzschliessung', 'Grenzschließung', 1, 'fsdfsdfsd', 'boot-998966_1280.jpg', '2016-03-13 14:48:31', 1),
(5, 'ein-ereignis', 'Ein Ereignis', 1, 'dsflsflsdfsd', 'boot-998966_1280.jpg', '2016-03-24 15:32:53', 1),
(6, 'noch-ein-ereignis', 'Noch ein Ereignis', 1, 'dfsdfhghg', 'boot-998966_1280.jpg', '2016-03-23 15:33:11', 1),
(7, 'test', 'test', 1, 'dfsdgfd', '', '2016-03-23 21:09:25', 1),
(8, 'ein-ereignis', 'Ein Ereignis', 2, 'fgdfggfsdfs', 'boot-998966_1280.jpg', '2016-03-24 08:29:09', 1),
(9, 'topic-fuer-das-thema', 'Topic für das Thema', 28, 'dfsdfsd', 'whiteboard-849803_1920.jpg', '2016-03-25 01:09:35', 1),
(10, 'dasdasda', 'dasdasda', 2, 'adasda', 'graduation-995042-2.jpg', '2016-03-25 01:10:21', 1),
(11, 'adasfgfh', 'adasfgfh', 2, 'gdfghd', 'beetle-701623.jpg', '2016-03-25 01:10:40', 1),
(12, 'dfggfddf', 'dfggfddf', 2, 'fsdfdsgfdg', 'aptopix-apple-48714757.jpg', '2016-03-25 01:15:58', 1),
(13, 'dasdsadsa', 'dasdsadsa', 2, 'fdsfdgfdgd', 'whiteboard-849803_1920.jpg', '2016-03-25 01:16:12', 1),
(14, 'ein-topic', 'Ein Topic', 27, 'dsfsdfsd', 'beetle-701623.jpg', '2016-03-25 13:57:47', 1),
(15, 'dfdsfsd', 'dfdsfsd', 29, 'fdsfsd', '', '2016-03-25 13:59:32', 1),
(16, 'dsfsdfsd', 'dsfsdfsd', 30, 'fdsfdsfs', '', '2016-03-25 14:00:19', 1),
(17, 'fsdklfsdl', 'fsdklfsdl', 30, '', '', '2016-03-30 07:10:11', 1),
(18, 'dfsdfsd', 'dfsdfsd', 30, '', '', '2016-03-30 07:10:20', 1),
(19, 'jhhrt', 'jhhrt', 30, '', '', '2016-03-30 07:10:27', 1),
(20, 'dewfcsd', 'dewfcsd', 30, '', '', '2016-03-30 07:11:00', 1),
(21, 'aswyvd', 'aswyvd', 30, '', '', '2016-03-30 07:11:06', 1),
(22, 'juzjtz', 'juzjtz', 30, '', '', '2016-03-30 07:11:16', 1),
(23, 'dghjhhj', 'dghjhhj', 30, '', '', '2016-03-30 07:13:19', 1),
(24, 'fdghtrwe', 'fdghtrwe', 30, '', '', '2016-03-30 07:21:25', 1),
(25, 'dfdfgh', 'dfdfgh', 1, '', '', '2016-03-30 18:52:37', 1),
(26, 'dghjhj', 'dghjhj', 30, '', '', '2016-03-31 08:42:48', 1),
(27, 'dsfghhjzte', 'dsfghhjzte', 30, '', '', '2016-03-31 08:46:51', 1),
(28, 'fmsverrv', 'fmsverrv', 30, '', '', '2016-03-31 08:47:26', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topic_references`
--

CREATE TABLE `topic_references` (
  `id` int(10) NOT NULL,
  `topic_id` int(10) NOT NULL,
  `ref_src` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `newsletter` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `hash`, `role`, `newsletter`) VALUES
(4, 'asd', 'asd@asd.de', '441a93ba47095abb4221c05c0931e01d6c831e61700f0ecc94ce834143cc3c925a3581f7d2df7748c6c41bc73ef587fdad830e83a47971234f8768a4b0acc202', 'ab369cdeb1db75004dfcfdf0f067155da868d882690439c3ef217bdafb289accc8a4acb8ecce8701f9d1ff87b3ab4328580824eaa75bce4a14cfccf1122d59c4', 1, 1),
(5, 'sven', 'test@test.de', '7c96f2a4ac2788cb57458e6a500ed18f1dd477aeadce91ff20264b59bace781dc6c2050b5312a0a3453fad507d6aa7b658778c762d4ea9d7f56f9e4a3d55c8f1', 'a80bd62fcbbe86ff910e60bd5c09c831ccc5c2e5ac7dacafb4666e05ae0d6d372ea99905fb24dd31e75125aebfb6022aba34a90c94ba21bf70a7d5d540f34f09', 0, 1),
(6, 'freddy', 'freddy@freddy.de', '7c96f2a4ac2788cb57458e6a500ed18f1dd477aeadce91ff20264b59bace781dc6c2050b5312a0a3453fad507d6aa7b658778c762d4ea9d7f56f9e4a3d55c8f1', 'a80bd62fcbbe86ff910e60bd5c09c831ccc5c2e5ac7dacafb4666e05ae0d6d372ea99905fb24dd31e75125aebfb6022aba34a90c94ba21bf70a7d5d540f34f09', 0, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `opinions`
--
ALTER TABLE `opinions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `opinion_has_likes`
--
ALTER TABLE `opinion_has_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `themes_has_categories`
--
ALTER TABLE `themes_has_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `themes_related`
--
ALTER TABLE `themes_related`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `topic_references`
--
ALTER TABLE `topic_references`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT für Tabelle `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT für Tabelle `opinion_has_likes`
--
ALTER TABLE `opinion_has_likes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT für Tabelle `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT für Tabelle `themes_has_categories`
--
ALTER TABLE `themes_has_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT für Tabelle `themes_related`
--
ALTER TABLE `themes_related`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT für Tabelle `topic_references`
--
ALTER TABLE `topic_references`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
