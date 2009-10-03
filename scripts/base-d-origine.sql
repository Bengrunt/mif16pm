-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Serveur: sql2.power-heberg.net
-- Généré le : Sam 03 Octobre 2009 à 16:19
-- Version du serveur: 5.0.32
-- Version de PHP: 5.2.6-1+lenny3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `adriangaudebert3`
--

-- --------------------------------------------------------

--
-- Structure de la table `Projects`
--

CREATE TABLE IF NOT EXISTS `Projects` (
  `project_id` int(11) NOT NULL auto_increment,
  `project_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `project_description` text collate utf8_unicode_ci NOT NULL,
  `project_creation_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `project_owner_id` int(11) NOT NULL,
  PRIMARY KEY  (`project_id`),
  KEY `owner_idfk` (`project_owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Projects`
--

INSERT INTO `Projects` (`project_id`, `project_name`, `project_description`, `project_creation_date`, `project_owner_id`) VALUES
(1, 'Test', 'Ah que c''est un projet de test', '0000-00-00 00:00:00', 3),
(2, 'Temps !!!', 'Test de temps', '2009-10-01 15:13:02', 2),
(3, 'Test owner', 'test owner... eh ouais', '2009-10-01 15:15:26', 10),
(4, 'Test encore', 'encore un test owner', '2009-10-01 15:19:01', 342),
(5, 'ARGH', 'pff...', '2009-10-01 15:19:20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `role_id` int(11) NOT NULL auto_increment,
  `role_name` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `delete_account` tinyint(1) NOT NULL,
  `modify_account` tinyint(1) NOT NULL,
  `add_account` tinyint(1) NOT NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Roles`
--


-- --------------------------------------------------------

--
-- Structure de la table `Tasks`
--

CREATE TABLE IF NOT EXISTS `Tasks` (
  `task_id` int(11) NOT NULL auto_increment,
  `task_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `task_project_id` int(11) NOT NULL,
  `unknown_field` int(11) NOT NULL,
  `task_duration` int(11) NOT NULL COMMENT 'durée en jour',
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Tasks`
--


-- --------------------------------------------------------

--
-- Structure de la table `Tasks_Teams`
--

CREATE TABLE IF NOT EXISTS `Tasks_Teams` (
  `task_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY  (`task_id`,`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Tasks_Teams`
--


-- --------------------------------------------------------

--
-- Structure de la table `Teams`
--

CREATE TABLE IF NOT EXISTS `Teams` (
  `team_id` int(11) NOT NULL auto_increment,
  `team_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `team_description` text collate utf8_unicode_ci NOT NULL,
  `team_project_id` int(11) NOT NULL,
  `team_mother_id` int(11) NOT NULL,
  `team_leader` int(11) NOT NULL,
  PRIMARY KEY  (`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Teams`
--


-- --------------------------------------------------------

--
-- Structure de la table `Teams_Users`
--

CREATE TABLE IF NOT EXISTS `Teams_Users` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_role` int(11) NOT NULL,
  PRIMARY KEY  (`team_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Teams_Users`
--


-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_nickname` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_first_name` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_password` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Users`
--

INSERT INTO `Users` (`user_id`, `user_nickname`, `user_first_name`, `user_last_name`, `user_password`, `role_id`) VALUES
(1, 'Nick', 'Jack', 'O''neil', 'test', 3);
