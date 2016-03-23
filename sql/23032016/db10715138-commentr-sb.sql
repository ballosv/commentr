-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 23. Mrz 2016 um 23:47
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `opinion_id`, `user_id`, `title`, `text`, `date`) VALUES
(10, 32, 5, 'Testtest', 'dfsfs', '2016-03-23 22:40:25'),
(11, 32, 5, 'Wieder ein Kommentar', 'fdfsdksd', '2016-03-23 22:41:41'),
(12, 31, 5, 'Hallo Welt', 'dfkjkskfölsd', '2016-03-23 22:44:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `opinions`
--

INSERT INTO `opinions` (`id`, `topic_id`, `user_id`, `title`, `text`, `date`, `status`, `comments`) VALUES
(26, 6, 5, 'testmeinung', 'fdflsdjflks\r\n', '2016-03-23 21:22:17', 1, 0),
(27, 1, 5, 'Noch eine Testmeinung', 'sdsfsdfs', '2016-03-23 21:30:47', 1, 0),
(28, 5, 5, 'dfsdfs', 'sdfsdf', '2016-03-23 21:31:34', 1, 0),
(29, 1, 5, 'Wieder eine neue Meinung', 'dfgfdgf', '2016-03-23 21:37:03', 1, 0),
(30, 1, 5, 'sdgfhgff', 'dsfsd', '2016-03-23 21:38:55', 1, 0),
(31, 7, 5, 'test', 'fdsfds', '2016-03-23 22:13:59', 1, 1),
(32, 7, 5, 'noch ein test', 'testdsfds', '2016-03-23 22:14:07', 1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `opinion_has_likes`
--

INSERT INTO `opinion_has_likes` (`id`, `opinion_id`, `user_id`, `like_status`, `date`) VALUES
(39, 32, 5, '1', '2016-03-23 22:20:03'),
(40, 31, 5, '0', '2016-03-23 22:34:26');

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
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `themes`
--

INSERT INTO `themes` (`id`, `link`, `name`, `parent`, `teaser`, `image`, `date`, `status`) VALUES
(1, 'fluechtlingskrise', 'Flüchtlingskrise', 0, 'Die Flüchtlingskrise gefährdet Europa.', '', '2016-03-02 23:00:00', 1),
(2, 'rechtsextremismus-in-deutschland', 'Rechtsextremismus in Deutschland', 0, 'Der Zulauf in der Bevölkerung zu rechtsextremen Gruppierungen ist erschreckend.', '', '2016-03-02 23:00:00', 1),
(3, 'bla', 'Bla', 0, 'Bla Bla Bla', '', '2016-03-02 23:00:00', 1),
(5, 'neuer-titel-mit-uemlaut', 'Neuer Titel mit Ümlaut', 0, 'fhslfdsalfjslkldfs', '', '2016-03-03 23:00:00', 1),
(6, 'neu', 'Neu', 0, 'Neues Thema', '', '2016-03-03 23:00:00', 1),
(7, 'noch-ein-test', 'Noch ein Test', 0, 'dflkdfjlkadjflksdjfladsö', '', '2016-03-07 14:00:43', 1),
(8, 'koeln', 'Köln', 1, 'Text zu Köln', '', '2016-03-04 14:19:49', 1),
(9, 'test', 'test', 2, 'fsfsdfs', '', '2016-03-07 14:23:47', 1),
(10, 'etsfdasfds', 'etsfdasfds', 4, 'dsfdsafsdfsdf', '', '2016-03-07 14:33:50', 1),
(11, 'etsfdsfs', 'etsfdsfs', 3, 'fsdfsdfasdf', '', '2016-03-07 14:46:08', 1),
(12, 'immer-mehr-fluechtlinge', 'Immer mehr Flüchtlinge', 1, 'fhslhfsdlkvlsdnlvsndlvnsalnds s   uhjkh   h oijhioj oij ij o', '', '2016-03-07 18:57:48', 1),
(13, 'diskussion-ueber-grenzschliessung', 'Diskussion über Grenzschließung', 1, 'jofsd  s ököl öl köl köl  h buzg uzbiu n ctz biu bzuh uin iuzgz hiu niu bi ni kop', '', '2016-03-07 18:58:20', 1),
(14, 'oesterreich-schliesst-seine-grenzen', 'Österreich schließt seine Grenzen', 1, 'fjkl kl kl i gsio joihv os ps skdklmvmoiv  o voa pemop ap mkm ssd ', '', '2016-03-07 19:00:35', 1),
(15, 'begrenzung-der-fluechtlingszahlen-beschlossen', 'Begrenzung der Flüchtlingszahlen beschlossen', 1, 'dsff sd fsd ö lka j kj idaijo isjfomiocm pmsdpof msdopfkpok fopkjfoiewf   if jaif jiosd jpofsjp o ', '', '2016-03-07 19:01:33', 1),
(18, 'neue-ueberschrift', 'Neue Überschrift', 1, 'dfsdfs', '', '2016-03-12 00:40:52', 1),
(19, 'wieder-ein-neues-thema', 'Wieder ein neues Thema', 0, 'sdfsdgfdds\r\n', '', '2016-03-15 17:33:15', 1),
(20, 'hallo-alle-zusammen', 'Hallo alle Zusammen', 0, 'dfsdfsdfs', '', '2016-03-15 17:33:29', 1),
(21, 'jdflfjlksd', 'jdflfjlksd', 0, 'fdsfsdfsd\r\n', '', '2016-03-15 17:33:42', 1),
(22, 'dsfdsfsd', 'dsfdsfsd', 0, 'dsfdfgghhjg', '', '2016-03-15 17:33:49', 1),
(23, 'dfgwdsa', 'dfgwdsa', 1, 'dggjhhhgfe', '', '2016-03-14 17:24:57', 1),
(24, 'mein-thema', 'Mein Thema', 0, 'fsdölköf  wfm w w', '', '2016-03-15 23:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `themes_has_categories`
--

CREATE TABLE `themes_has_categories` (
  `id` int(10) NOT NULL,
  `theme_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `themes_has_categories`
--

INSERT INTO `themes_has_categories` (`id`, `theme_id`, `category_id`) VALUES
(1, 11, 1),
(2, 12, 1),
(3, 13, 1),
(4, 14, 1),
(5, 15, 1),
(8, 18, 1),
(9, 19, 2),
(10, 20, 1),
(11, 21, 1),
(12, 22, 1),
(13, 23, 1),
(14, 24, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `topics`
--

INSERT INTO `topics` (`id`, `link`, `name`, `theme_id`, `teaser`, `image`, `date`, `status`) VALUES
(1, 'test', 'test', 1, 'text', 'boot-998966_1280.jpg', '2016-03-23 14:46:20', 1),
(2, 'immer-mehr-fluechtlinge', 'Immer mehr Flüchtlinge', 1, 'fsdjkldsjfkl', 'boot-998966_1280.jpg', '2016-03-23 14:47:48', 1),
(3, 'koeln', 'Köln', 1, 'fdfgdfsfsdf', 'boot-998966_1280.jpg', '2016-03-23 14:48:07', 1),
(4, 'grenzschliessung', 'Grenzschließung', 1, 'fsdfsdfsd', 'boot-998966_1280.jpg', '2016-03-23 14:48:31', 1),
(5, 'ein-ereignis', 'Ein Ereignis', 1, 'dsflsflsdfsd', 'boot-998966_1280.jpg', '2016-03-23 15:32:53', 1),
(6, 'noch-ein-ereignis', 'Noch ein Ereignis', 1, 'dfsdfhghg', 'boot-998966_1280.jpg', '2016-03-23 15:33:11', 1),
(7, 'test', 'test', 1, 'dfsdgfd', '', '2016-03-23 21:09:25', 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `opinions`
--
ALTER TABLE `opinions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT für Tabelle `opinion_has_likes`
--
ALTER TABLE `opinion_has_likes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT für Tabelle `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT für Tabelle `themes_has_categories`
--
ALTER TABLE `themes_has_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT für Tabelle `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
