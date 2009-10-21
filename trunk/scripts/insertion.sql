--
-- Serveur: sql2.power-heberg.net
-- Base de données: `adriangaudebert3`
-- Script d'insertion dans les tables
--

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`) VALUES
(1, 'Test', 'Ah que c''est un projet de test', NULL),
(6, 'Projet test équipes', 'PROUT', '2009-10-04 17:37:52');

-- --------------------------------------------------------

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'site_user'),
(2, 'site_admin'),
(3, 'team_administrator'),
(4, 'team_user');

-- --------------------------------------------------------

--
-- Contenu de la table `tasks`
--

-- --------------------------------------------------------

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `project_id`, `created`, `modified`) VALUES
(1, 'aaaaa', 'abcdefghijklmnopqrstuvwxyz', 0, '2009-10-11 19:51:19', '2009-10-11 19:51:19'),
(2, 'Jonlajoie', 'I kill people with gun !', 0, '2009-10-09 22:22:16', '2009-10-09 22:22:16'),
(3, 'MC UFF', 'I come from behind and make you suffer !!!', 0, '2009-10-11 19:50:10', '2009-10-11 19:50:10'),
(4, 'MC Motherfucker', 'I''m in your house and I''m screwin'' your mum''s ass !', 0, '2009-10-11 19:51:19', '2009-10-11 19:52:50');

-- --------------------------------------------------------

--
-- Contenu de la table `tasks_teams`
--

-- --------------------------------------------------------

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `role_id`) VALUES
(1, 'root', 'PROUT', 'Projet Regroupant Les Outils Utiles a Tous', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 2);

-- --------------------------------------------------------

--
-- Contenu de la table `teams_users`
--
