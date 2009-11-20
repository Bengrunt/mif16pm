--
-- Serveur: sql2.power-heberg.net
-- Base de données: `adriangaudebert3`
-- Script d'insertion dans les tables
--

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created`) VALUES
(1, 'Fête de la saucisse', 'Projet d''organisation de la fête de la saucisse de Strasbourg à Muflin', '2009-09-01 15:32:52'),
(2, 'MIF12 : Compilateur CELL', 'Projet de développement d''un compilateur pour processeur CELL', '2009-10-15 22:18:00'),
(3, 'Championnats intercommunaux de course en sac','Organisation des championnats intercommunaux de course en sac', '2009-06-22'),
(4, 'Projet Historia', 'Mise en place de cérémonie pour l''anniversaire du débarquement','2009-11-20'),
(6, 'Projet MIF16 : PROUT', 'Amélioration du projet PROUT', '2009-11-20 6:45:23');

-- --------------------------------------------------------

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'site_user'),
(2, 'site_admin'),
(3, 'team_admin'),
(4, 'team_user'),
(5, 'project_admin'),
(6, 'project_user');


-- --------------------------------------------------------

--
-- Contenu de la table `tasks`
--

-- --------------------------------------------------------

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `project_id`, `created`, `modified`) VALUES
(1, 'Equipe Sauvigny', 'Gestion des stands', 1, '2009-09-11 19:51:19', '2009-10-11 12:51:19'),
(2, 'Equipe Tangerine', 'Gestion des entrées', 1, '2009-09-23 22:15:23', '2009-10-09 22:22:16'),
(3, 'Equipe Damoclès', 'Gestion de la sécurité', 1, '2009-09-16 13:48:03', '2009-09-16 13:48:03'),
(4, 'MIF12 : CELL', 'Les developpeurs du projet MIF12 : CELL', 2, '2009-10-15 23:12:36', '2009-11-20 19:50:10'),
(5, 'MC Motherfucker', 'I''m in your house and I''m screwin'' your mum''s ass !', 6, '2009-10-11 19:51:19', '2009-10-11 19:52:50');

-- --------------------------------------------------------

--
-- Contenu de la table `tasks_teams`
--

-- --------------------------------------------------------

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `lastname`, `password`, `role_id`) 
VALUES
(1, 'root', 'PROUT', 'Projet Regroupant Les Outils Utiles a Tous', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 2),
(2, 'mAn', 'Emmanuel', 'GAUDE', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(3, 'bengrunt', 'Benjamin', 'GUILLON', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(4, 'mafy', 'Mamy Tweek Faly', 'RAMINOSOA', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1),
(5, 'hbmanu', 'Manu', 'HATCHOUM', '0da5dbfe3807a49b6fa3a7c08e4ce9a7c9e096c6', 1);

-- --------------------------------------------------------

--
-- Contenu de la table `teams_users`
--
INSERT INTO `teams_users` (`team_id`, `user_id`, `role_id`) VALUES
(1, 3, 3), (1, 2, 4), (1, 4, 4), (1, 5, 4),
(2, 5, 3), (2, 2, 4), (2, 4, 4), (2, 3, 4),
(3, 4, 3),
(4, 3, 3), (4, 4, 4)
;

--
-- Contenu de la table `projects_users`
--
INSERT INTO `projects_users` (`project_id`, `user_id`, `role_id`) VALUES
(1, 3, 5), (1, 2, 6), (1, 4, 6), (1, 5, 6),
(6, 4, 5), (6, 3, 6)
;

--
-- Contenu de la table `tasks_users`
--

INSERT INTO `tasks_users` (`task_id`, `user_id`) VALUES
(1, 1), (1,3), (1,4), (1,5);
