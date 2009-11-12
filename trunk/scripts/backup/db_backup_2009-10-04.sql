-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Host: sql2.power-heberg.net
-- Generation Time: Oct 04, 2009 at 05:10 PM
-- Server version: 5.0.32
-- PHP Version: 5.2.6-1+lenny3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `adriangaudebert3`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `created` datetime default NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`, `user_id`) VALUES
(1, 'Test', 'Ah que c''est un projet de test', NULL, 3),
(2, 'Temps !!!', 'Test de temps', NULL, 2),
(3, 'Test owner', 'test owner... eh ouais', NULL, 10),
(4, 'Test encore', 'encore un test owner', NULL, 342),
(5, 'ARGH', 'pff...', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `add_account` tinyint(1) NOT NULL,
  `delete_account` tinyint(1) NOT NULL,
  `modify_account` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL auto_increment,
  `task_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'durée en jours',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tasks`
--


-- --------------------------------------------------------
--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `teams`
--


-- --------------------------------------------------------

--
-- Table structure for table `teams_users`
--

CREATE TABLE IF NOT EXISTS `teams_users` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`team_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teams_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `nickname` varchar(30) collate utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `password` varchar(30) collate utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickname`, `first_name`, `last_name`, `password`, `role_id`) VALUES
(1, 'Nick', 'Jack', 'O''neil', 'test', 3);
