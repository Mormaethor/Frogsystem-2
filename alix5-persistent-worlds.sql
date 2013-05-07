
--
-- Tabellenstruktur für Tabelle `fs_persisinterview`
--
DROP TABLE IF EXISTS `fs_persisinterview`;
CREATE TABLE IF NOT EXISTS `fs_persisinterview` (
  `persisinterview_id` smallint(6) unsigned NOT NULL auto_increment,
  `persisinterview_spiel` smallint(1) unsigned NOT NULL default '0',
  `persisinterview_name` varchar(150) NOT NULL default '',
  `persisinterview_url` varchar(255) NOT NULL default '',
  `persisinterview_antwort01` text NOT NULL,
  `persisinterview_antwort02` text NOT NULL,
  `persisinterview_antwort03` text NOT NULL,
  `persisinterview_antwort04` text NOT NULL,
  `persisinterview_antwort05` text NOT NULL,
  `persisinterview_antwort06` text NOT NULL,
  `persisinterview_antwort07` text NOT NULL,
  `persisinterview_antwort08` text NOT NULL,
  `persisinterview_antwort09` text NOT NULL,
  `persisinterview_antwort10` text NOT NULL,
  `persisinterview_antwort11` text NOT NULL,
  `persisinterview_antwort12` text NOT NULL,
  `persisinterview_antwort13` text NOT NULL,
  `persisinterview_datum` int(11) unsigned NOT NULL default '0',
  `persisinterview_posterid` mediumint(8) unsigned NOT NULL default '0',
  `persisinterview_link` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`persisinterview_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fs_persistent`
--

DROP TABLE IF EXISTS `fs_persistent`;
CREATE TABLE `fs_persistent` (
  `persistent_id` smallint(6) unsigned NOT NULL auto_increment,
  `persistent_name` varchar(150) NOT NULL default '',
  `persistent_url` varchar(255) NOT NULL default '',
  `persistent_text` text NOT NULL,
  `persistent_spiel` tinyint(1) unsigned NOT NULL default '0',
  `persistent_setting_id` smallint(6) NOT NULL,
  `persistent_genre_id` smallint(6) NOT NULL,
  `persistent_termine` tinyint NOT NULL default '-1',
  `persistent_dlsize` int NOT NULL default '-1',
  `persistent_dlsvu` tinyint NOT NULL,
  `persistent_dlhdu` tinyint NOT NULL,
  `persistent_dlcep` tinyint NOT NULL,
  `persistent_dlmotb` tinyint NOT NULL,
  `persistent_dlsoz` tinyint NOT NULL,
  `persistent_anmeldung` tinyint NOT NULL default '-1',
  `persistent_handycap` text NOT NULL,
  `persistent_dm` int NOT NULL default '-1',
  `persistent_maxzahl` varchar(200) NOT NULL default '',
  `persistent_maxlevel` varchar(200) NOT NULL default '',
  `persistent_expcap` tinyint NOT NULL default '-1',
  `persistent_fights` tinyint NOT NULL default '-1',
  `persistent_traps` tinyint NOT NULL default '-1',
  `persistent_items` tinyint NOT NULL default '-1',
  `persistent_pvp` tinyint NOT NULL default '-1',
  `persistent_datum` int(11) unsigned NOT NULL default '0',
  `persistent_interview` varchar(200) NOT NULL default '',
  `persistent_posterid` mediumint(8) unsigned NOT NULL default '0',
  `persistent_link` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`persistent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fs_persistent_comments`
--

DROP TABLE IF EXISTS `fs_persistent_comments`;
CREATE TABLE IF NOT EXISTS `fs_persistent_comments` (
  `persistent_comment_id` mediumint(8) NOT NULL auto_increment,
  `persistent_id` smallint(6) unsigned NOT NULL,
  `comment_poster` varchar(32) default NULL,
  `comment_poster_id` mediumint(8) default NULL,
  `comment_date` int(11) default NULL,
  `comment_title` varchar(100) default NULL,
  `comment_text` text,
  PRIMARY KEY  (`persistent_comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fs_persistent_genre`
--

DROP TABLE IF EXISTS `fs_persistent_genre`;
CREATE TABLE `fs_persistent_genre` (
  `genre_id` smallint(6) NOT NULL auto_increment,
  `genre_name` char(100) default NULL,
  `genre_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`genre_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fs_persistent_genre`
--

INSERT INTO `fs_persistent_genre` (`genre_id`, `genre_name`, `genre_date`) VALUES
(9, 'Action', 1137801628),
(10, 'Rollenspiel', 1137801654),
(3, 'Alternativ', 1137790611),
(4, 'Geschichte', 1137790758),
(5, 'Solo', 1137790863),
(6, 'Team', 1137790872),
(7, 'zwangloses Treffen', 1137790883),
(8, 'k. A.', 1137790899);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fs_persistent_setting`
--

DROP TABLE IF EXISTS `fs_persistent_setting`;
CREATE TABLE IF NOT EXISTS `fs_persistent_setting` (
  `setting_id` smallint(6) NOT NULL auto_increment,
  `setting_name` char(100) default NULL,
  `setting_date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `fs_persistent_setting`
--

INSERT INTO `fs_persistent_setting` (`setting_id`, `setting_name`, `setting_date`) VALUES
(18, 'Forgotten Realms', 1137801705),
(17, 'Dark Sun', 1137801696),
(16, 'Birthright', 1137801687),
(5, 'Dragonlance', 1137790059),
(6, 'Das schwarze Auge', 1137790100),
(7, 'Eberron', 1137790143),
(8, 'Greyhawk', 1137790201),
(9, 'Planescape', 1137790216),
(10, 'Ravenloft', 1137790226),
(11, 'Shadowrun', 1137790238),
(12, 'Vampire', 1137790259),
(13, 'eigenes Setting', 1137790268),
(14, 'k. A.', 1137790277);

-- --------------------------------------------------------

--
-- Daten fuer neue Admin-CP-Gruppe
--

INSERT INTO `fs_admin_groups` (`group_id`, `group_title`, `menu_id`, `group_pos`)
VALUES ('30', 'Persistente Welten', 'interactive', '3');

-- --------------------------------------------------------

--
-- Daten fuer neue Admin-CP-Eintraege
--

INSERT INTO `fs_admin_cp` (`page_id`, `group_id`, `page_title`, `page_link`, `page_file`, `page_pos`, `page_int_sub_perm`) VALUES
('tpl_persistent', '22', 'Persistente Welt bearbeiten', 'Persistente Welten', 'admin_template_persistent.php', '27', '0'),
('persistentadd', '30', 'Persistente Welt hinzuf&uuml;gen', 'Pers. Welt hinzuf&uuml;gen', 'admin_persistentadd.php', '1', '0'),
('persistentedit', '30', 'Persistente Welt bearbeiten', 'bearbeiten', 'admin_persistentedit.php', '2', '0'),
('pwcommentedit', '30', 'Kommentare', 'Kommentare', 'admin_pwcommentedit.php', '2', '1'),
('persistentformadd', '30', 'Persistente Welten - Formular &auml;ndern', 'Formular erweitern', 'admin_persistentformadd.php', '3', '0'),
('persistentformdelete', '30', 'Persistente Welten - Formular &auml;ndern', 'Formular verkleinern', 'admin_persistentformdelete.php', '4', '0'),
('persinteredit', '30', 'Interview &Uuml;bersicht', 'Interview &auml;ndern', 'admin_persinteredit.php', '5', '0');
