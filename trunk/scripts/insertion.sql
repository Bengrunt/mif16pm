--
-- Serveur: sql2.power-heberg.net
-- Base de données: `adriangaudebert3`
-- Script d'insertion dans les tables
--

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`, `user_id`) VALUES
(1, 'Test', 'Ah que c''est un projet de test', NULL, 3),
(2, 'Temps !!!', 'Test de temps', NULL, 2),
(3, 'Test owner', 'test owner... eh ouais', NULL, 10),
(4, 'Test encore', 'encore un test owner', NULL, 342),
(5, 'ARGH', 'pff...', NULL, 1);

-- --------------------------------------------------------

--
-- Contenu de la table `roles`
--

-- --------------------------------------------------------

--
-- Contenu de la table `tasks`
--

-- --------------------------------------------------------

--
-- Contenu de la table `teams`
--

-- --------------------------------------------------------

--
-- Contenu de la table `tasks_teams`
--

-- --------------------------------------------------------

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `first_name`, `last_name`, `password`, `role_id`) VALUES
(1, 'Nick', 'Jack', 'O''neil', 'test', 3);

-- --------------------------------------------------------

--
-- Contenu de la table `teams_users`
--
